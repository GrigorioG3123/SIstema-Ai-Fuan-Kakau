@extends('layouts.app')

@section('title', 'Transasaun Produsaun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Transasaun Produsaun</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.transasauns.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Fila
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
                                    <th>Data</th>
                                    <th>Produtór</th>
                                    <th>Kafé Tipu</th>
                                    <th>Armajen</th>
                                    <th>Kilo</th>
                                    <th>Folin Unitáriu</th>
                                    <th>Total Valor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transasauns as $transasaun)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transasaun->data_transasaun->format('d/m/Y') }}</td>
                                    <td>{{ $transasaun->produtor->naran_produtor ?? '--' }}</td>
                                    <td>{{ $transasaun->kafeTipu->naran_tipu ?? '--' }}</td>
                                    <td>{{ $transasaun->armajen->naran_armajen ?? '--' }}</td>
                                    <td>{{ number_format($transasaun->kilo, 2) }} kg</td>
                                    <td>${{ number_format($transasaun->folin_unitariu, 2) }}</td>
                                    <td>${{ number_format($transasaun->total_valor, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transasaun->status == 'complete' ? 'success' : 'warning' }}">
                                            {{ $transasaun->status }}
                                        </span>
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
                        <strong>Total {{ $transasauns->total() }} transasaun produsaun</strong>
                    </div>
                    <div class="float-right">
                        {{ $transasauns->links() }}
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
