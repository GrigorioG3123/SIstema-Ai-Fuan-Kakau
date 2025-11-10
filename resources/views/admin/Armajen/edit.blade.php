@extends('layouts.app')

@section('title', 'Armajen Edita')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Armajen Edita</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.armajen.index') }}">Armajen</a></li>
                        <li class="breadcrumb-item active">Edita</li>
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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formuláriu Armajen Edita</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.armajen.update', $armajen) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="naran_armajen">Naran Armajen <span class="text-danger">*</span></label>
                                    <input type="text" name="naran_armajen" id="naran_armajen" class="form-control @error('naran_armajen') is-invalid @enderror" value="{{ old('naran_armajen', $armajen->naran_armajen) }}" placeholder="Hatama naran armajen" required>
                                    @error('naran_armajen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lokalisasaun">Lokalisasaun</label>
                                    <input type="text" name="lokalisasaun" id="lokalisasaun" class="form-control @error('lokalisasaun') is-invalid @enderror" value="{{ old('lokalisasaun', $armajen->lokalisasaun) }}" placeholder="Hatama lokalisasaun">
                                    @error('lokalisasaun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kapasidade_max">Kapasidade Máximu (kg) <span class="text-danger">*</span></label>
                                    <input type="number" name="kapasidade_max" id="kapasidade_max" class="form-control @error('kapasidade_max') is-invalid @enderror" value="{{ old('kapasidade_max', $armajen->kapasidade_max) }}" step="0.01" min="0" placeholder="0.00" required>
                                    @error('kapasidade_max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kapasidade_atual">Kapasidade Atual (kg)</label>
                                    <input type="number" name="kapasidade_atual" id="kapasidade_atual" class="form-control @error('kapasidade_atual') is-invalid @enderror" value="{{ old('kapasidade_atual', $armajen->kapasidade_atual) }}" step="0.01" min="0" placeholder="0.00">
                                    @error('kapasidade_atual')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="">Hili Status</option>
                                        <option value="ativu" {{ old('status', $armajen->status) == 'ativu' ? 'selected' : '' }}>Ativu</option>
                                        <option value="inativu" {{ old('status', $armajen->status) == 'inativu' ? 'selected' : '' }}>Inativu</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Atualiza</button>
                                <a href="{{ route('admin.armajen.index') }}" class="btn btn-secondary">Kansela</a>
                            </div>
                        </form>
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
