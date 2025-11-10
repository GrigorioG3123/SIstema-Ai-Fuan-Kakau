@extends('layouts.app')

@section('title', 'Lista Transasaun')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .filter-section {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .table-container {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .table-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
        color: white;
        padding: 1.5rem;
    }

    .table-title {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-complete { background: #d4edda; color: #155724; }
    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-cancel { background: #f8d7da; color: #721c24; }

    .type-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-produsaun { background: #e7f4e4; color: #2e7d32; border: 1px solid #c8e6c9; }
    .badge-venda { background: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
    .badge-transferensia { background: #f3e5f5; color: #7b1fa2; border: 1px solid #e1bee7; }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-view { background: #e3f2fd; color: #1976d2; }
    .btn-edit { background: #fff3e0; color: #f57c00; }
    .btn-delete { background: #ffebee; color: #d32f2f; }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #6c757d;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: white;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .summary-text {
        color: #6c757d;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="fas fa-exchange-alt text-primary me-2"></i>
                Lista Transasaun
            </h1>
            <p class="text-muted mb-0">Jere hotu-hotu transasaun produsaun no venda</p>
        </div>
        <div class="action-buttons">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-2"></i>Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i>PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i>CSV</a></li>
                </ul>
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Transasaun Foun
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form action="{{ route('admin.transasauns.index') }}" method="GET">
            <div class="filter-grid">
                <div>
                    <label class="form-label">Tipu Transasaun</label>
                    <select name="tipo" class="form-select">
                        <option value="">Hotu-Hotu</option>
                        <option value="produsaun" {{ request('tipo') == 'produsaun' ? 'selected' : '' }}>Produsaun</option>
                        <option value="venda" {{ request('tipo') == 'venda' ? 'selected' : '' }}>Venda</option>
                        <option value="transferensia" {{ request('tipo') == 'transferensia' ? 'selected' : '' }}>Transferensia</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Hotu-Hotu</option>
                        <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Kompleta</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Kansela</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Husi Data</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>

                <div>
                    <label class="form-label">To'o Data</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <div>
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter me-2"></i>Filtru
                        </button>
                        <a href="{{ route('admin.transasauns.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-refresh"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats Summary -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card primary">
                <div class="stat-header">
                    <div class="stat-icon primary">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $transasauns->total() }}</h3>
                        <p class="stat-label">Total Transasaun</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card success">
                <div class="stat-header">
                    <div class="stat-icon success">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ number_format($totalProdusaun, 1) }}<small>kg</small></h3>
                        <p class="stat-label">Total Produsaun</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card warning">
                <div class="stat-header">
                    <div class="stat-icon warning">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ number_format($totalVenda, 1) }}<small>kg</small></h3>
                        <p class="stat-label">Total Venda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card info">
                <div class="stat-header">
                    <div class="stat-icon info">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $pendingCount }}</h3>
                        <p class="stat-label">Pendente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="table-container">
        <div class="table-header">
            <h5 class="table-title">
                <i class="fas fa-list me-2"></i>
                Lista Transasaun
            </h5>
        </div>

        @if($transasauns->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Data</th>
                        <th>Tipu</th>
                        <th>Produtór/Kliente</th>
                        <th>Kafé Tipu</th>
                        <th>Kilo</th>
                        <th>Folin Total</th>
                        <th>Status</th>
                        <th width="120" class="text-center">Aksaun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transasauns as $transasaun)
                    <tr>
                        <td class="fw-bold text-muted">#{{ $transasaun->id_transasaun }}</td>
                        <td>
                            <div class="fw-semibold">{{ $transasaun->data_transasaun->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $transasaun->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <span class="type-badge badge-{{ $transasaun->tipo }}">
                                <i class="fas fa-{{ $transasaun->tipo == 'produsaun' ? 'seedling' : ($transasaun->tipo == 'venda' ? 'shopping-cart' : 'exchange-alt') }} me-1"></i>
                                {{ $transasaun->tipo }}
                            </span>
                        </td>
                        <td>
                            @if($transasaun->tipo == 'produsaun' && $transasaun->produtor)
                                <div class="fw-semibold">{{ $transasaun->produtor->naran_produtor }}</div>
                                <small class="text-muted">{{ $transasaun->produtor->suku ?? '--' }}</small>
                            @elseif($transasaun->tipo == 'venda')
                                <div class="fw-semibold">{{ $transasaun->naran_kliente ?? 'Kliente' }}</div>
                                <small class="text-muted">Venda direta</small>
                            @else
                                <span class="text-muted">--</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $transasaun->kafeTipu->naran_tipu }}</div>
                            <small class="text-muted">{{ $transasaun->kafeTipu->kategoria }}</small>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ number_format($transasaun->kilo, 2) }} kg</div>
                            <small class="text-muted">${{ number_format($transasaun->folin_unitariu, 2) }}/kg</small>
                        </td>
                        <td>
                            <div class="fw-bold text-success">${{ number_format($transasaun->total_valor, 2) }}</div>
                        </td>
                        <td>
                            <span class="status-badge badge-{{ $transasaun->status }}">
                                <i class="fas fa-{{ $transasaun->status == 'complete' ? 'check' : ($transasaun->status == 'pending' ? 'clock' : 'times') }} me-1"></i>
                                {{ $transasaun->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="#" class="btn-action btn-view" title="Detallu">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-action btn-edit" title="Edita">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn-action btn-delete"
                                        onclick="alert('Delete functionality not implemented yet')"
                                        title="Deleta">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="summary-text">
                Mostrando {{ $transasauns->firstItem() }} to {{ $transasauns->lastItem() }} of {{ $transasauns->total() }} rejistu
            </div>
            <div>
                {{ $transasauns->links() }}
            </div>
        </div>

        @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <h4 class="text-muted">Laiha Transasaun</h4>
            <p class="text-muted mb-4">Ita boot seidauk iha transasaun rejistadu iha sistema.</p>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Kria Transasaun Foun
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-submit form when filters change
    document.querySelectorAll('select[name="tipo"], select[name="status"]').forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });

    // Date range validation
    document.querySelector('input[name="start_date"]').addEventListener('change', function() {
        const endDate = document.querySelector('input[name="end_date"]');
        if (this.value && endDate.value && this.value > endDate.value) {
            endDate.value = this.value;
        }
    });

    // Export functionality
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const format = this.querySelector('i').classList[1].split('-').pop();
            alert(`Exportadu ba formatu ${format.toUpperCase()}!`);
        });
    });
</script>
@endsection
@extends('layouts.app')

@section('title', 'Lista Transasaun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-exchange-alt mr-2"></i>
                        Lista Transasaun
                    </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-primary btn-sm" onclick="alert('Create functionality not implemented yet')">
                            <i class="fas fa-plus"></i> Transasaun Foun
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form action="{{ route('admin.transasauns.index') }}" method="GET" class="form-inline">
                                <div class="form-group mr-2 mb-2">
                                    <label for="tipo" class="mr-2">Tipu:</label>
                                    <select name="tipo" id="tipo" class="form-control form-control-sm">
                                        <option value="">Hotu-Hotu</option>
                                        <option value="produsaun" {{ request('tipo') == 'produsaun' ? 'selected' : '' }}>Produsaun</option>
                                        <option value="venda" {{ request('tipo') == 'venda' ? 'selected' : '' }}>Venda</option>
                                        <option value="transferensia" {{ request('tipo') == 'transferensia' ? 'selected' : '' }}>Transferensia</option>
                                    </select>
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <label for="status" class="mr-2">Status:</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="">Hotu-Hotu</option>
                                        <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Kompleta</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
                                        <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Kansela</option>
                                    </select>
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <label for="start_date" class="mr-2">Husi Data:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <label for="end_date" class="mr-2">To'o Data:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-filter"></i> Filtru
                                    </button>
                                    <a href="{{ route('admin.transasauns.index') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Data</th>
                                    <th>Tipu</th>
                                    <th>Produtór/Kliente</th>
                                    <th>Kafé Tipu</th>
                                    <th>Armajen</th>
                                    <th>Kilo</th>
                                    <th>Folin Unitáriu</th>
                                    <th>Total Valór</th>
                                    <th>Status</th>
                                    <th>Data Rejistu</th>
                                    <th width="120">Aksaun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transasauns as $transasaun)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $transasaun->data_transasaun->format('d/m/Y') }}</strong>
                                    </td>
                                    <td>
                                        @if($transasaun->tipo == 'produsaun')
                                            <span class="badge badge-success">
                                                <i class="fas fa-seedling mr-1"></i>Produsaun
                                            </span>
                                        @elseif($transasaun->tipo == 'venda')
                                            <span class="badge badge-primary">
                                                <i class="fas fa-shopping-cart mr-1"></i>Venda
                                            </span>
                                        @else
                                            <span class="badge badge-info">
                                                <i class="fas fa-exchange-alt mr-1"></i>Transferensia
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transasaun->tipo == 'produsaun' && $transasaun->produtor)
                                            <strong>{{ $transasaun->produtor->naran_produtor }}</strong>
                                            @if($transasaun->produtor->suku)
                                                <br>
                                                <small class="text-muted">{{ $transasaun->produtor->suku }}</small>
                                            @endif
                                        @elseif($transasaun->tipo == 'venda')
                                            <strong>{{ $transasaun->naran_kliente ?? 'Kliente' }}</strong>
                                            <br>
                                            <small class="text-muted">Venda Direta</small>
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $transasaun->kafeTipu->naran_tipu }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $transasaun->kafeTipu->kategoria }}</small>
                                    </td>
                                    <td>
                                        {{ $transasaun->armajen->naran_armajen }}
                                        <br>
                                        <small class="text-muted">{{ $transasaun->armajen->lokalisasaun }}</small>
                                    </td>
                                    <td class="text-right">
                                        <strong>{{ number_format($transasaun->kilo, 2) }} kg</strong>
                                    </td>
                                    <td class="text-right">
                                        ${{ number_format($transasaun->folin_unitariu, 2) }}
                                    </td>
                                    <td class="text-right">
                                        <strong class="text-success">${{ number_format($transasaun->total_valor, 2) }}</strong>
                                    </td>
                                    <td>
                                        @if($transasaun->status == 'complete')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check mr-1"></i>Kompleta
                                            </span>
                                        @elseif($transasaun->status == 'pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock mr-1"></i>Pendente
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times mr-1"></i>Kansela
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $transasaun->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.transasauns.show', $transasaun->id_transasaun) }}" 
                                               class="btn btn-info btn-sm" title="Detallu">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.transasauns.edit', $transasaun->id_transasaun) }}" 
                                               class="btn btn-warning btn-sm" title="Edita">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" data-target="#deleteModal{{ $transasaun->id_transasaun }}"
                                                    title="Deleta">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $transasaun->id_transasaun }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasaun Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Ita boot seguro atu delete transasaun ida ne'e?</p>
                                                        <div class="alert alert-warning">
                                                            <strong>Detallu Transasaun:</strong><br>
                                                            Data: {{ $transasaun->data_transasaun->format('d/m/Y') }}<br>
                                                            Tipu: {{ $transasaun->tipo }}<br>
                                                            Kilo: {{ number_format($transasaun->kilo, 2) }} kg<br>
                                                            Total: ${{ number_format($transasaun->total_valor, 2) }}
                                                        </div>
                                                        <p class="text-danger"><small>Asaun ida ne'e la bele fila fali.</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kansela</button>
                                                        <form action="{{ route('admin.transasauns.destroy', $transasaun->id_transasaun) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <td colspan="6" class="text-right"><strong>Total:</strong></td>
                                    <td class="text-right"><strong>{{ number_format($totalKilo, 2) }} kg</strong></td>
                                    <td></td>
                                    <td class="text-right"><strong>${{ number_format($totalValor, 2) }}</strong></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="float-left">
                        <strong>Total {{ $transasauns->total() }} transasaun</strong>
                        <span class="text-muted">({{ $transasauns->count() }} iha pájina ida ne'e)</span>
                    </div>
                    <div class="float-right">
                        {{ $transasauns->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- Quick Stats Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stats['total_transactions'] }}</h3>
                            <p>Total Transasaun</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
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
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $stats['pending_count'] }}</h3>
                            <p>Transasaun Pendente</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "order": [[1, 'desc']], // Sort by date descending
        "language": {
            "search": "Buka:",
            "lengthMenu": "Hatudu _MENU_ rejistu",
            "info": "Hatudu _START_ to'o _END_ hosi _TOTAL_ rejistu",
            "infoEmpty": "Hatudu 0 to'o 0 hosi 0 rejistu",
            "infoFiltered": "(filtradu hosi _MAX_ total rejistu)",
            "zeroRecords": "Laiha rejistu ne'ebé hetan",
            "paginate": {
                "first": "Primeiru",
                "last": "Ikus",
                "next": "Oinmai",
                "previous": "Molok"
            }
        }
    });

    // Auto-submit form when select filters change
    $('#tipo, #status').change(function() {
        $(this).closest('form').submit();
    });

    // Date validation
    $('#start_date, #end_date').change(function() {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        
        if (startDate && endDate && startDate > endDate) {
            alert('Data husi tenke molok data to\'o!');
            $(this).val('');
        }
    });
});
</script>
@endsection