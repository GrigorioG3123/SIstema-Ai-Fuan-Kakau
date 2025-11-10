@extends('layouts.app')

@section('title', 'Detalhes Kafé Tipu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detalhes Kafé Tipu</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kafe-tipu.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Fila ba Lista
                        </a>
                        <a href="{{ route('admin.kafe-tipu.edit', $kafeTipu) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edita
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Tipu:</label>
                                <p class="form-control-plaintext">{{ $kafeTipu->id_tipu }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Naran Tipu:</label>
                                <p class="form-control-plaintext">{{ $kafeTipu->naran_tipu }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Folin Base:</label>
                                <p class="form-control-plaintext">${{ number_format($kafeTipu->folin_base, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategoria:</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-{{ $kafeTipu->kategoria == 'Premium' ? 'success' : ($kafeTipu->kategoria == 'Standard' ? 'primary' : 'secondary') }}">
                                        {{ $kafeTipu->kategoria }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status:</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-{{ $kafeTipu->status == 'ativu' ? 'success' : 'danger' }}">
                                        {{ $kafeTipu->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Rejistu:</label>
                                <p class="form-control-plaintext">{{ $kafeTipu->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskrisaun:</label>
                                <p class="form-control-plaintext">{{ $kafeTipu->deskrisaun ?: 'La iha deskrisaun' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- Transasaun Relasionadu -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Transasaun Relasionadu</h3>
                </div>
                <div class="card-body">
                    @if($kafeTipu->transasauns->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Tipu</th>
                                    <th>Kilo</th>
                                    <th>Folin</th>
                                    <th>Produtór</th>
                                    <th>Armajen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kafeTipu->transasauns->take(10) as $transasaun)
                                <tr>
                                    <td>{{ $transasaun->data_transasaun->format('d/m/Y') }}</td>
                                    <td>{{ $transasaun->tipo }}</td>
                                    <td>{{ number_format($transasaun->kilo, 2) }} kg</td>
                                    <td>${{ number_format($transasaun->folin_unitariu, 2) }}</td>
                                    <td>{{ $transasaun->produtor ? $transasaun->produtor->naran_produtor : '-' }}</td>
                                    <td>{{ $transasaun->armajen->naran_armajen }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($kafeTipu->transasauns->count() > 10)
                            <div class="text-center">
                                <small class="text-muted">Hatudu 10 husi {{ $kafeTipu->transasauns->count() }} transasaun</small>
                            </div>
                        @endif
                    @else
                        <p class="text-center text-muted">La iha transasaun relasionadu ho tipu kafé ida-ne'e.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
