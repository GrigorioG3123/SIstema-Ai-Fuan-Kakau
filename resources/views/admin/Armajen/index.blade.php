@extends('layouts.app')

@section('title', 'Lista Armajen')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista Armajen</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Armajen</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista Armajen</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.armajen.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Armajen Foun
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Susesu!</h5>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table id="armajen-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Naran Armajen</th>
                                        <th>Lokalisasaun</th>
                                        <th>Kapasidade Max</th>
                                        <th>Kapasidade Atual</th>
                                        <th>Status</th>
                                        <th>Aksaun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($armajens as $armajen)
                                    <tr>
                                        <td>{{ $armajen->id_armajen }}</td>
                                        <td>{{ $armajen->naran_armajen }}</td>
                                        <td>{{ $armajen->lokalisasaun ?? '-' }}</td>
                                        <td>{{ number_format($armajen->kapasidade_max, 2) }} kg</td>
                                        <td>{{ number_format($armajen->kapasidade_atual, 2) }} kg</td>
                                        <td>
                                            <span class="badge badge-{{ $armajen->status == 'ativu' ? 'success' : 'danger' }}">
                                                {{ $armajen->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.armajen.show', $armajen) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.armajen.edit', $armajen) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.armajen.destroy', $armajen) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ita hakarak hamos armajen ida ne\'e?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $armajens->links() }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
$(function () {
    $("#armajen-table").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#armajen-table_wrapper .col-md-6:eq(0)');
});
</script>
@endsection
