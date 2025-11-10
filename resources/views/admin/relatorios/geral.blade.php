@extends('layouts.app')

@section('title', 'Relatóriu Geral')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Relatóriu Geral Sistema CCT
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-0">Resumu Geral Sistema</h5>
                            <p class="text-muted">Dadus konsolidadu hosi operasaun hotu-hotu</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-download mr-2"></i>Export Relatóriu
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="exportPdf">
                                        <i class="fas fa-file-pdf mr-2 text-danger"></i>PDF
                                    </a>
                                    <a class="dropdown-item" href="#" id="exportExcel">
                                        <i class="fas fa-file-excel mr-2 text-success"></i>Excel
                                    </a>
                                    <a class="dropdown-item" href="#" id="exportPrint">
                                        <i class="fas fa-print mr-2 text-info"></i>Imprime
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Stats Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_produtor'] }}</h3>
                    <p>Total Produtór</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.produtors.index') }}" class="small-box-footer">
                    Detallu liu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($stats['total_produsaun'], 1) }}<sup style="font-size: 20px">kg</sup></h3>
                    <p>Total Produsaun</p>
                </div>
                <div class="icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <a href="{{ route('admin.transasauns.produsaun') }}" class="small-box-footer">
                    Detallu liu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($stats['total_venda'], 1) }}<sup style="font-size: 20px">kg</sup></h3>
                    <p>Total Venda</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.transasauns.venda') }}" class="small-box-footer">
                    Detallu liu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>${{ number_format($stats['total_revenue'], 2) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="{{ route('admin.transasauns.index') }}" class="small-box-footer">
                    Detallu liu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts and Detailed Stats -->
    <div class="row">
        <!-- Left Column - Charts -->
        <div class="col-lg-8">
            <!-- Production vs Sales Chart -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Produsaun vs Venda (Últimu 6 Fulán)
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="productionSalesChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
            </div>

            <!-- Revenue Trend -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-2"></i>
                        Trend Revenue (Últimu 6 Fulán)
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Right Column - Stats and Info -->
        <div class="col-lg-4">
            <!-- Stock Summary -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-boxes mr-2"></i>
                        Sumáriu Stock
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Kafé Tipu</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockSummary as $stock)
                                <tr>
                                    <td>{{ $stock['tipu'] }}</td>
                                    <td>{{ number_format($stock['stock'], 2) }} kg</td>
                                    <td>
                                        @if($stock['stock'] > 100)
                                            <span class="badge badge-success">Diak</span>
                                        @elseif($stock['stock'] > 50)
                                            <span class="badge badge-warning">Alerta</span>
                                        @else
                                            <span class="badge badge-danger">Kraik</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Transaction Summary -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-exchange-alt mr-2"></i>
                        Sumáriu Transasaun
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="info-box bg-gradient-info">
                                <span class="info-box-icon"><i class="fas fa-seedling"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Produsaun</span>
                                    <span class="info-box-number">{{ $stats['total_transactions_prod'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box bg-gradient-success">
                                <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Venda</span>
                                    <span class="info-box-number">{{ $stats['total_transactions_venda'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pendente</span>
                                    <span class="info-box-number">{{ $stats['pending_transactions'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Producers -->
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trophy mr-2"></i>
                        Produtór Top 5
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produtór</th>
                                    <th>Produsaun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topProducers as $producer)
                                <tr>
                                    <td>
                                        <strong>{{ $producer->naran_produtor }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $producer->suku ?? '--' }}</small>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge badge-success">
                                            {{ number_format($producer->total_produsaun, 2) }} kg
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-table mr-2"></i>
                        Estatístika Detalladu
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box mb-3 bg-gradient-info">
                                <span class="info-box-icon"><i class="fas fa-coffee"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Kafé Tipu</span>
                                    <span class="info-box-number">{{ $stats['total_kafe_tipu'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box mb-3 bg-gradient-success">
                                <span class="info-box-icon"><i class="fas fa-warehouse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Armajen</span>
                                    <span class="info-box-number">{{ $stats['total_armajen'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box mb-3 bg-gradient-warning">
                                <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Transasaun Total</span>
                                    <span class="info-box-number">{{ $stats['total_transactions'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box mb-3 bg-gradient-danger">
                                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Lucru Total</span>
                                    <span class="info-box-number">${{ number_format($stats['total_profit'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Performance -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Desempenhu Mensál - {{ date('Y') }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Fulán</th>
                                            <th>Produsaun (kg)</th>
                                            <th>Venda (kg)</th>
                                            <th>Revenue ($)</th>
                                            <th>Lucru ($)</th>
                                            <th>Taxa Konversaun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($monthlyPerformance as $month)
                                        <tr>
                                            <td><strong>{{ $month['month'] }}</strong></td>
                                            <td>{{ number_format($month['produsaun'], 2) }}</td>
                                            <td>{{ number_format($month['venda'], 2) }}</td>
                                            <td>${{ number_format($month['revenue'], 2) }}</td>
                                            <td>
                                                <span class="badge badge-{{ $month['profit'] >= 0 ? 'success' : 'danger' }}">
                                                    ${{ number_format($month['profit'], 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-{{ $month['conversion_rate'] >= 70 ? 'success' : ($month['conversion_rate'] >= 50 ? 'warning' : 'danger') }}"
                                                         style="width: {{ $month['conversion_rate'] }}%"></div>
                                                </div>
                                                <small>{{ number_format($month['conversion_rate'], 1) }}%</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light">
                                            <td><strong>Total</strong></td>
                                            <td><strong>{{ number_format($stats['total_produsaun'], 2) }} kg</strong></td>
                                            <td><strong>{{ number_format($stats['total_venda'], 2) }} kg</strong></td>
                                            <td><strong>${{ number_format($stats['total_revenue'], 2) }}</strong></td>
                                            <td><strong>${{ number_format($stats['total_profit'], 2) }}</strong></td>
                                            <td>
                                                <strong>{{ number_format($stats['overall_conversion_rate'], 1) }}%</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
$(function () {
    // Production vs Sales Chart
    var productionSalesCtx = document.getElementById('productionSalesChart').getContext('2d');
    var productionSalesChart = new Chart(productionSalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['months']) !!},
            datasets: [
                {
                    label: 'Produsaun (kg)',
                    data: {!! json_encode($chartData['produsaun']) !!},
                    backgroundColor: 'rgba(40, 167, 69, 0.8)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Venda (kg)',
                    data: {!! json_encode($chartData['venda']) !!},
                    backgroundColor: 'rgba(0, 123, 255, 0.8)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Kilo (kg)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Fulán'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Produsaun vs Venda - Últimu 6 Fulán'
                }
            }
        }
    });

    // Revenue Chart
    var revenueCtx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['months']) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode($chartData['revenue']) !!},
                backgroundColor: 'rgba(255, 193, 7, 0.2)',
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Fulán'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Trend Revenue - Últimu 6 Fulán'
                }
            }
        }
    });

    // Export functionality
    $('#exportPdf').click(function(e) {
        e.preventDefault();
        toastr.success('Relatóriu PDF preparadu ba download!');
    });

    $('#exportExcel').click(function(e) {
        e.preventDefault();
        toastr.success('Relatóriu Excel preparadu ba download!');
    });

    $('#exportPrint').click(function(e) {
        e.preventDefault();
        window.print();
    });
});
</script>

<style>
    @media print {
        .btn, .card-tools, .small-box-footer, .dropdown, .main-header, .main-sidebar, .main-footer {
            display: none !important;
        }
        .card {
            border: 1px solid #000 !important;
            box-shadow: none !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
        }
    }

    .info-box {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 5px;
    }

    .table th {
        border-top: none;
    }
</style>
@endsection
