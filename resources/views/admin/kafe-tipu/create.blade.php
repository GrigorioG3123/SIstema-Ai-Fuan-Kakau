@extends('layouts.app')

@section('title', 'Rejistu Kafé Tipu Foun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rejistu Kafé Tipu Foun</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kafe-tipu.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Fila ba Lista
                        </a>
                    </div>
                </div>
                <!-- form start -->
                <form action="{{ route('admin.kafe-tipu.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="naran_tipu">Naran Tipu <span class="text-danger">*</span></label>
                                    <input type="text" name="naran_tipu" id="naran_tipu" class="form-control @error('naran_tipu') is-invalid @enderror" value="{{ old('naran_tipu') }}" placeholder="Hatama naran tipu" required>
                                    @error('naran_tipu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="folin_base">Folin Base <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="folin_base" id="folin_base" class="form-control @error('folin_base') is-invalid @enderror" value="{{ old('folin_base') }}" placeholder="0.00" required>
                                    @error('folin_base')
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
                                    <label for="kategoria">Kategoria <span class="text-danger">*</span></label>
                                    <select name="kategoria" id="kategoria" class="form-control @error('kategoria') is-invalid @enderror" required>
                                        <option value="">Hili Kategoria</option>
                                        <option value="Premium" {{ old('kategoria') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                        <option value="Standard" {{ old('kategoria') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                        <option value="Economy" {{ old('kategoria') == 'Economy' ? 'selected' : '' }}>Economy</option>
                                    </select>
                                    @error('kategoria')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="ativu" {{ old('status', 'ativu') == 'ativu' ? 'selected' : '' }}>Ativu</option>
                                        <option value="inativu" {{ old('status') == 'inativu' ? 'selected' : '' }}>Inativu</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskrisaun">Deskrisaun</label>
                                    <textarea name="deskrisaun" id="deskrisaun" class="form-control @error('deskrisaun') is-invalid @enderror" rows="3" placeholder="Hatama deskrisaun">{{ old('deskrisaun') }}</textarea>
                                    @error('deskrisaun')
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
                        <a href="{{ route('admin.kafe-tipu.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Kansela
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
