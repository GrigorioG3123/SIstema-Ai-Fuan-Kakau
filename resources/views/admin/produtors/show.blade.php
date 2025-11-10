@extends('layouts.app')

@section('title', 'Detallu Produtór - ' . $produtor->naran_produtor)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Informasaun Produtór</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
                            <div class="image">
                                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                            </div>
                        </div>
                        <h4>{{ $produtor->naran_produtor }}</h4>
                        <p class="text-muted">Produtór Kafé</p>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-phone mr-2 text-primary"></i>Telefone</span>
                            <span class="font-weight-bold">
                                @if($produtor->telefone)
                                    {{ $produtor->telefone }}
                                @else
                                    <span class="text-muted">--</span>
                                @endif
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-map-marker-alt mr-2 text-success"></i>Suku/Distritu</span>
                            <span class="font-weight-bold">
                                {{ $produtor->suku ?? '--' }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-calendar-alt mr-2 text-info"></i>Data Rejistu</span>
                            <span class="font-weight-bold">
                                {{ $produtor->data_rejistu->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.produtors.edit', $produtor->id_produtor) }}" class="btn btn-warning btn-block">
                                <i class="fas fa-edit"></i> Edita
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.produtors.index') }}" class="btn btn-default btn-block">
                                <i class="fas fa-arrow-left"></i> Fila
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card card-custom mt-3">
                <div class="card-header">
                    <h3 class="card-title">Estatístika</h3>
                </div>
                <div class="card-body">
                    <div class="small-box bg-info mb-3">
                        <div class="inner">
                            <h3>{{ number_format($totalProdusaun, 2) }}<sup style="font-size: 20px">kg</sup></h3>
                            <p>Total Produsaun</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                    </div>

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($totalVenda, 2) }}<sup style="font-size: 20px">kg</sup></h3>
                            <p>Total Venda</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Transasaun History -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Históriku Transasaun</h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">
                            Total: {{ $produtor->transasauns->count() }} Transasaun
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    @if($produtor->transasauns->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Tipu</th>
                                    <th>Kafé Tipu</th>
                                    <th>Kilo</th>
                                    <th>Folin Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtor->transasauns as $transasaun)
                                <tr>
                                    <td>{{ $transasaun->data_transasaun->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transasaun->tipo == 'produsaun' ? 'success' : 'primary' }}">
                                            {{ $transasaun->tipo }}
                                        </span>
                                    </td>
                                    <td>{{ $transasaun->kafeTipu->naran_tipu }}</td>
                                    <td>{{ number_format($transasaun->kilo, 2) }} kg</td>
                                    <td>${{ number_format($transasaun->total_valor, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transasaun->status == 'complete' ? 'success' : ($transasaun->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ $transasaun->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Laiha Transasaun</h5>
                        <p class="text-muted">Produtór ida ne'e seidauk iha transasaun rejistadu.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
