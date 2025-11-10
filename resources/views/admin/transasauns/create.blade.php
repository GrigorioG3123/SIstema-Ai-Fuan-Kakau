@extends('layouts.app')

@section('title', 'Kria Transasaun Foun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formuláriu Transasaun Foun</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.transasauns.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Fila ba Lista
                        </a>
                    </div>
                </div>
                <!-- form start -->
                <form action="{{ route('admin.transasauns.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo">Tipu Transasaun <span class="text-danger">*</span></label>
                                    <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                        <option value="">Hili Tipu Transasaun</option>
                                        <option value="produsaun" {{ old('tipo') == 'produsaun' ? 'selected' : '' }}>Produsaun</option>
                                        <option value="venda" {{ old('tipo') == 'venda' ? 'selected' : '' }}>Venda</option>
                                        <option value="transferensia" {{ old('tipo') == 'transferensia' ? 'selected' : '' }}>Transferensia</option>
                                    </select>
                                    @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_transasaun">Data Transasaun <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('data_transasaun') is-invalid @enderror" 
                                           id="data_transasaun" name="data_transasaun" 
                                           value="{{ old('data_transasaun', date('Y-m-d')) }}" required>
                                    @error('data_transasaun')
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
                                    <label for="id_produtor">Produtór</label>
                                    <select name="id_produtor" id="id_produtor" class="form-control @error('id_produtor') is-invalid @enderror">
                                        <option value="">Hili Produtór (ba Produsaun)</option>
                                        @foreach($produtors as $produtor)
                                            <option value="{{ $produtor->id_produtor }}" {{ old('id_produtor') == $produtor->id_produtor ? 'selected' : '' }}>
                                                {{ $produtor->naran_produtor }} - {{ $produtor->suku ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_produtor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="kliente_field" style="display: none;">
                                    <label for="naran_kliente">Naran Kliente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('naran_kliente') is-invalid @enderror" 
                                           id="naran_kliente" name="naran_kliente" 
                                           value="{{ old('naran_kliente') }}" placeholder="Naran kliente">
                                    @error('naran_kliente')
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
                                    <label for="id_tipu">Kafé Tipu <span class="text-danger">*</span></label>
                                    <select name="id_tipu" id="id_tipu" class="form-control @error('id_tipu') is-invalid @enderror" required>
                                        <option value="">Hili Kafé Tipu</option>
                                        @foreach($kafeTipus as $tipu)
                                            <option value="{{ $tipu->id_tipu }}" data-folin="{{ $tipu->folin_base }}" {{ old('id_tipu') == $tipu->id_tipu ? 'selected' : '' }}>
                                                {{ $tipu->naran_tipu }} - ${{ number_format($tipu->folin_base, 2) }} ({{ $tipu->kategoria }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_tipu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_armajen">Armajen <span class="text-danger">*</span></label>
                                    <select name="id_armajen" id="id_armajen" class="form-control @error('id_armajen') is-invalid @enderror" required>
                                        <option value="">Hili Armajen</option>
                                        @foreach($armajens as $armajen)
                                            <option value="{{ $armajen->id_armajen }}" {{ old('id_armajen') == $armajen->id_armajen ? 'selected' : '' }}>
                                                {{ $armajen->naran_armajen }} - {{ $armajen->lokalisasaun }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_armajen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kilo">Kilo <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('kilo') is-invalid @enderror" 
                                           id="kilo" name="kilo" value="{{ old('kilo') }}" 
                                           placeholder="0.00" min="0.01" required>
                                    @error('kilo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="folin_unitariu">Folin Unitáriu ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('folin_unitariu') is-invalid @enderror" 
                                           id="folin_unitariu" name="folin_unitariu" value="{{ old('folin_unitariu') }}" 
                                           placeholder="0.00" min="0" required>
                                    @error('folin_unitariu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_valor">Total Valór ($)</label>
                                    <input type="text" class="form-control" id="total_valor" readonly>
                                    <small class="form-text text-muted">Kalkulu automátiku: Kilo × Folin Unitáriu</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
                                        <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Kompleta</option>
                                        <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Kansela</option>
                                    </select>
                                    @error('status')
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
                            <i class="fas fa-save"></i> Rejistu Transasaun
                        </button>
                        <a href="{{ route('admin.transasauns.index') }}" class="btn btn-default">
                            <i class="fas fa-times"></i> Kansela
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Show/hide fields based on transaction type
    $('#tipo').change(function() {
        const tipo = $(this).val();
        
        if (tipo === 'produsaun') {
            $('#id_produtor').closest('.form-group').show();
            $('#kliente_field').hide();
            $('#naran_kliente').removeAttr('required');
        } else if (tipo === 'venda') {
            $('#id_produtor').closest('.form-group').hide();
            $('#kliente_field').show();
            $('#naran_kliente').attr('required', 'required');
        } else {
            $('#id_produtor').closest('.form-group').hide();
            $('#kliente_field').hide();
            $('#naran_kliente').removeAttr('required');
        }
    });

    // Auto-calculate total value
    function calculateTotal() {
        const kilo = parseFloat($('#kilo').val()) || 0;
        const folin = parseFloat($('#folin_unitariu').val()) || 0;
        const total = kilo * folin;
        $('#total_valor').val('$' + total.toFixed(2));
    }

    $('#kilo, #folin_unitariu').on('input', calculateTotal);

    // Auto-fill price when coffee type is selected
    $('#id_tipu').change(function() {
        const selectedOption = $(this).find('option:selected');
        const basePrice = selectedOption.data('folin');
        if (basePrice) {
            $('#folin_unitariu').val(basePrice);
            calculateTotal();
        }
    });

    // Trigger change event on page load
    $('#tipo').trigger('change');
    calculateTotal();
});
</script>
@endsection