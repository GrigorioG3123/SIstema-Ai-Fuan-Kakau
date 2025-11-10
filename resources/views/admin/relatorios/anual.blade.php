@extends('layouts.app')

@section('title', 'Relatório Anual')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Relatório Anual - {{ $ano }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.relatorio.geral') }}">Relatórios</a></li>
                        <li class="breadcrumb-item active">Anual</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Year Selector -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.relatorio.anual') }}" class="form-inline">
                                <label for="ano" class="mr-2">Selecione o Ano:</label>
                                <select name="ano" id="ano" class="form-control mr-2" onchange="this.form.submit()">
                                    @for($year = date('Y') - 5; $year <= date('Y'); $year++)
                                        <option value="{{ $year }}" {{ $ano == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                <button type="button" class="btn btn-secondary ml-2" onclick="window.print()">
                                    <i class="fas fa-print"></i> Imprimir Relatório
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Report Layout -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card report-card">
                        <div class="card-header report-header">
                            <div class="report-title">
                                <h2 class="mb-0">RELATÓRIO ANUAL DE CAFÉ</h2>
                                <h4 class="mb-0 text-muted">Sistema de Gestão CCT - Timor Leste</h4>
                            </div>
                            <div class="report-info">
                                <p class="mb-0"><strong>Ano:</strong> {{ $ano }}</p>
                                <p class="mb-0"><strong>Data de Emissão:</strong> {{ date('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Executive Summary -->
                            <div class="report-section">
                                <h3 class="section-title">RESUMO EXECUTIVO</h3>
                                <div class="row">
                                    @php
                                        $produsaun = $dados->where('tipo', 'produsaun')->first();
                                        $venda = $dados->where('tipo', 'venda')->first();
                                        $totalProdusaun = $produsaun->total_kilo ?? 0;
                                        $totalVenda = $venda->total_kilo ?? 0;
                                        $totalValor = $venda->total_valor ?? 0;
                                        $stockAtual = $totalProdusaun - $totalVenda;
                                        $taxaConversao = $totalProdusaun > 0 ? ($totalVenda / $totalProdusaun) * 100 : 0;
                                    @endphp

                                    <div class="col-md-3">
                                        <div class="metric-card">
                                            <div class="metric-value">{{ number_format($totalProdusaun, 2) }} <small>kg</small></div>
                                            <div class="metric-label">Total Produção</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="metric-card">
                                            <div class="metric-value">{{ number_format($totalVenda, 2) }} <small>kg</small></div>
                                            <div class="metric-label">Total Vendas</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="metric-card">
                                            <div class="metric-value">{{ number_format($stockAtual, 2) }} <small>kg</small></div>
                                            <div class="metric-label">Stock Atual</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="metric-card">
                                            <div class="metric-value">$ {{ number_format($totalValor, 2) }}</div>
                                            <div class="metric-label">Receita Total</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Chart -->
                            <div class="report-section">
                                <h3 class="section-title">DESEMPENHO ANUAL</h3>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="chart-container">
                                            <canvas id="annualChart" style="max-height: 300px;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="performance-summary">
                                            <h5>Indicadores Chave</h5>
                                            <div class="performance-item">
                                                <span class="performance-label">Taxa de Conversão:</span>
                                                <span class="performance-value">{{ number_format($taxaConversao, 1) }}%</span>
                                            </div>
                                            <div class="performance-item">
                                                <span class="performance-label">Transações Produção:</span>
                                                <span class="performance-value">{{ $produsaun->total_transasaun ?? 0 }}</span>
                                            </div>
                                            <div class="performance-item">
                                                <span class="performance-label">Transações Venda:</span>
                                                <span class="performance-value">{{ $venda->total_transasaun ?? 0 }}</span>
                                            </div>
                                            <div class="performance-item">
                                                <span class="performance-label">Valor Médio por kg:</span>
                                                <span class="performance-value">$ {{ $totalVenda > 0 ? number_format($totalValor / $totalVenda, 2) : '0.00' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Breakdown -->
                            <div class="report-section">
                                <h3 class="section-title">QUEBRAS DETALHADAS POR TIPO</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered report-table">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Tipo de Transação</th>
                                                <th>Quantidade Total (kg)</th>
                                                <th>Valor Total ($)</th>
                                                <th>Número de Transações</th>
                                                <th>Média por Transação (kg)</th>
                                                <th>Valor Médio ($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dados as $dado)
                                            <tr>
                                                <td>
                                                    <span class="transaction-type {{ $dado->tipo }}">
                                                        {{ ucfirst($dado->tipo) }}
                                                    </span>
                                                </td>
                                                <td class="text-right">{{ number_format($dado->total_kilo, 2) }}</td>
                                                <td class="text-right">{{ number_format($dado->total_valor, 2) }}</td>
                                                <td class="text-center">{{ $dado->total_transasaun }}</td>
                                                <td class="text-right">{{ $dado->total_transasaun > 0 ? number_format($dado->total_kilo / $dado->total_transasaun, 2) : '0.00' }}</td>
                                                <td class="text-right">{{ $dado->total_transasaun > 0 ? number_format($dado->total_valor / $dado->total_transasaun, 2) : '0.00' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-footer">
                                            <tr>
                                                <td><strong>TOTAL GERAL</strong></td>
                                                <td class="text-right"><strong>{{ number_format($totalProdusaun + $totalVenda, 2) }}</strong></td>
                                                <td class="text-right"><strong>{{ number_format($totalValor, 2) }}</strong></td>
                                                <td class="text-center"><strong>{{ ($produsaun->total_transasaun ?? 0) + ($venda->total_transasaun ?? 0) }}</strong></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Report Footer -->
                        <div class="card-footer report-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-0"><strong>Relatório gerado por:</strong> Sistema CCT</p>
                                    <p class="mb-0"><strong>Data:</strong> {{ date('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="mb-0"><strong>CCT - Café Timor Leste</strong></p>
                                    <p class="mb-0">Sistema de Gestão de Café</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('styles')
<style>
@media print {
    .content-header, .card-header:not(.report-header), .card-footer:not(.report-footer),
    .breadcrumb, .btn, .form-inline, .navbar, .main-sidebar, .control-sidebar {
        display: none !important;
    }

    .content-wrapper {
        margin-left: 0 !important;
        background: white !important;
    }

    .report-card {
        border: none !important;
        box-shadow: none !important;
    }

    .report-title {
        text-align: center;
        border-bottom: 2px solid #333;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .metric-card {
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        background: #f8f9fa;
    }

    .report-table {
        font-size: 12px;
    }

    .report-table th, .report-table td {
        padding: 8px 12px;
        border: 1px solid #333 !important;
    }
}

.report-card {
    border: 1px solid #dee2e6;
    border-radius: 0;
}

.report-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 20px;
    border-bottom: none;
}

.report-title h2 {
    font-weight: bold;
    margin-bottom: 5px;
}

.report-info {
    text-align: right;
}

.report-section {
    margin-bottom: 40px;
    page-break-inside: avoid;
}

.section-title {
    font-size: 18px;
    font-weight: bold;
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.metric-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 15px;
}

.metric-value {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 5px;
}

.metric-value small {
    font-size: 14px;
    color: #6c757d;
}

.metric-label {
    font-size: 14px;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.chart-container {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.performance-summary {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.performance-summary h5 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: bold;
}

.performance-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.performance-item:last-child {
    border-bottom: none;
}

.performance-label {
    font-weight: 500;
    color: #495057;
}

.performance-value {
    font-weight: bold;
    color: #2c3e50;
}

.report-table {
    background: white;
    border-collapse: collapse;
}

.table-header th {
    background: #2c3e50;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.table-footer td {
    background: #f8f9fa;
    font-weight: bold;
}

.transaction-type {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.transaction-type.produsaun {
    background: #d4edda;
    color: #155724;
}

.transaction-type.venda {
    background: #fff3cd;
    color: #856404;
}

.report-footer {
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 20px;
    font-size: 12px;
    color: #6c757d;
}
</style>
@endsection

@section('scripts')
<script>
$(function () {
    // Annual Chart
    var ctx = document.getElementById('annualChart').getContext('2d');
    var annualChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Produção', 'Vendas'],
            datasets: [{
                label: 'Quantidade (kg)',
                data: [
                    {{ $totalProdusaun }},
                    {{ $totalVenda }}
                ],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' kg';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endsection
