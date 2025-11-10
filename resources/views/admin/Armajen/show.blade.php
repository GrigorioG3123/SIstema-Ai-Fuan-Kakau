@extends('layouts.app')

@section('title', 'Detallu Armajen')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detallu Armajen</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.armajen.index') }}">Armajen</a></li>
                        <li class="breadcrumb-item active">Detallu</li>
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
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasaun Armajen</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.armajen.edit', $armajen) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edita
                                </a>
                                <a href="{{ route('admin.armajen.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Fila
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">ID:</dt>
                                <dd class="col-sm-9">{{ $armajen->id_armajen }}</dd>

                                <dt class="col-sm-3">Naran Armajen:</dt>
                                <dd class="col-sm-9">{{ $armajen->naran_armajen }}</dd>

                                <dt class="col-sm-3">Lokalisasaun:</dt>
                                <dd class="col-sm-9">{{ $armajen->lokalisasaun ?? '-' }}</dd>

                                <dt class="col-sm-3">Kapasidade Máximu:</dt>
                                <dd class="col-sm-9">{{ number_format($armajen->kapasidade_max, 2) }} kg</dd>

                                <dt class="col-sm-3">Kapasidade Atual:</dt>
                                <dd class="col-sm-9">{{ number_format($armajen->kapasidade_atual, 2) }} kg</dd>

                                <dt class="col-sm-3">Status:</dt>
                                <dd class="col-sm-9">
                                    <span class="badge badge-{{ $armajen->status == 'ativu' ? 'success' : 'danger' }}">
                                        {{ $armajen->status }}
                                    </span>
                                </dd>

                                <dt class="col-sm-3">Data Kria:</dt>
                                <dd class="col-sm-9">{{ $armajen->created_at->format('d/m/Y H:i') }}</dd>

                                <dt class="col-sm-3">Data Atualiza:</dt>
                                <dd class="col-sm-9">{{ $armajen->updated_at->format('d/m/Y H:i') }}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Kapasidade</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="progress-group">
                                <span class="float-right"><b>{{ number_format($armajen->kapasidade_atual, 2) }}</b>/{{ number_format($armajen->kapasidade_max, 2) }} kg</span>
                                <span class="progress-text">Kapasidade Atual</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: {{ $armajen->kapasidade_max > 0 ? ($armajen->kapasidade_atual / $armajen->kapasidade_max) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
