@extends('layouts.app')

@section('title', 'Rejistu Produtór Foun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rejistu Produtór Foun</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.produtors.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Fila ba Lista
                        </a>
                    </div>
                </div>
                <!-- form start -->
                <form action="{{ route('admin.produtors.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="naran_produtor">Naran Produtór <span class="text-danger">*</span></label>
                                    <input type="text" name="naran_produtor" id="naran_produtor" class="form-control @error('naran_produtor') is-invalid @enderror" value="{{ old('naran_produtor') }}" placeholder="Hatama naran produtór" required>
                                    @error('naran_produtor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}" placeholder="Hatama telefone">
                                    @error('telefone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suku">Suku</label>
                                    <input type="text" name="suku" id="suku" class="form-control @error('suku') is-invalid @enderror" value="{{ old('suku') }}" placeholder="Hatama suku">
                                    @error('suku')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Rejistu
                        </button>
                        <a href="{{ route('admin.produtors.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Kansela
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
