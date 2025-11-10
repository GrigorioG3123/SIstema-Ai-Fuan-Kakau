@extends('layouts.app')

@section('title', 'Lista Kafé Tipu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista Kafé Tipu</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kafe-tipu.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Tipu Foun
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naran Tipu</th>
                                <th>Deskrisaun</th>
                                <th>Folin Base</th>
                                <th>Kategoria</th>
                                <th>Status</th>
                                <th>Aksaun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kafeTipus as $kafeTipu)
                            <tr>
                                <td>{{ $kafeTipu->id_tipu }}</td>
                                <td>{{ $kafeTipu->naran_tipu }}</td>
                                <td>{{ $kafeTipu->deskrisaun }}</td>
                                <td>${{ number_format($kafeTipu->folin_base, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $kafeTipu->kategoria == 'Premium' ? 'success' : ($kafeTipu->kategoria == 'Standard' ? 'primary' : 'secondary') }}">
                                        {{ $kafeTipu->kategoria }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $kafeTipu->status == 'ativu' ? 'success' : 'danger' }}">
                                        {{ $kafeTipu->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.kafe-tipu.show', $kafeTipu) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.kafe-tipu.edit', $kafeTipu) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.kafe-tipu.destroy', $kafeTipu) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Konfirma delete?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="float-left">
                        {{ $kafeTipus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
