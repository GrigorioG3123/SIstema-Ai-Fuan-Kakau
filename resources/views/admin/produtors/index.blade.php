@extends('layouts.app')

@section('title', 'Lista Produtór')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Lista Produtór</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.produtors.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Produtór Foun
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naran</th>
                                    <th>Telefone</th>
                                    <th>Suku</th>
                                    <th>Data Rejistu</th>
                                    <th>Total Produsaun</th>
                                    <th>Total Transasaun</th>
                                    <th>Aksaun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtors as $produtor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $produtor->naran_produtor }}</strong>
                                    </td>
                                    <td>
                                        @if($produtor->telefone)
                                            <a href="tel:{{ $produtor->telefone }}" class="text-primary">
                                                <i class="fas fa-phone mr-1"></i>{{ $produtor->telefone }}
                                            </a>
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                    <td>{{ $produtor->suku ?? '--' }}</td>
                                    <td>{{ $produtor->data_rejistu->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            <i class="fas fa-seedling mr-1"></i>
                                            {{ number_format($produtor->totalProdusaun(), 2) }} kg
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            <i class="fas fa-exchange-alt mr-1"></i>
                                            {{ $produtor->transasauns->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.produtors.show', $produtor->id_produtor) }}"
                                               class="btn btn-info btn-sm" title="Detallu">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.produtors.edit', $produtor->id_produtor) }}"
                                               class="btn btn-warning btn-sm" title="Edita">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#deleteModal{{ $produtor->id_produtor }}"
                                                    title="Deleta">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $produtor->id_produtor }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasaun</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Ita boot seguro atu delete produtór <strong>{{ $produtor->naran_produtor }}</strong>?</p>
                                                        <p class="text-danger"><small>Asaun ida ne'e la bele fila fali.</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kansela</button>
                                                        <form action="{{ route('admin.produtors.destroy', $produtor->id_produtor) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <strong>Total {{ $produtors->total() }} produtór</strong>
                    </div>
                    <div class="float-right">
                        {{ $produtors->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('.datatable')) {
        $('.datatable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Buka:",
                "lengthMenu": "Hatudu _MENU_ rejistu",
                "info": "Hatudu _START_ to'o _END_ hosi _TOTAL_ rejistu",
                "infoEmpty": "Hatudu 0 to'o 0 hosi 0 rejistu",
                "infoFiltered": "(filtradu hosi _MAX_ total rejistu)",
                "zeroRecords": "Laiha rejistu ne'ebé hetan",
                "paginate": {
                    "first": "Primeiru",
                    "last": "Ikus",
                    "next": "Oinmai",
                    "previous": "Molok"
                }
            }
        });
    }
});
</script>
@endsection
