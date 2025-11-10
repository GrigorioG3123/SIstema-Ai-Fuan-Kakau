@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $totalProdutor }}</h3>
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
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ number_format($totalProdusaun, 1) }}<sup style="font-size: 20px">kg</sup></h3>
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
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ number_format($totalVenda, 1) }}<sup style="font-size: 20px">kg</sup></h3>
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
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $totalKafeTipu }}</h3>
          <p>Kafé Tipu</p>
        </div>
        <div class="icon">
          <i class="fas fa-coffee"></i>
        </div>
        <a href="{{ route('admin.kafe-tipu.index') }}" class="small-box-footer">
          Detallu liu <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card card-custom">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-line mr-1"></i>
            Produsaun vs Venda (Últimu 6 Fulán)
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Bar</a>
              </li>
            </ul>
          </div>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
              <canvas id="revenueChart" height="300" style="height: 300px;"></canvas>
            </div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
              <canvas id="salesChart" height="300" style="height: 300px;"></canvas>
            </div>
          </div>
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Transasaun Foun -->
      <div class="card card-custom">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-exchange-alt mr-1"></i>
            Transasaun Foun Sira
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Tipu</th>
                  <th>Produtór/Kliente</th>
                  <th>Kilo</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($recentTransasauns as $transasaun)
                <tr>
                  <td>{{ $transasaun->data_transasaun->format('d/m/Y') }}</td>
                  <td>
                    <span class="badge badge-{{ $transasaun->tipo == 'produsaun' ? 'success' : 'primary' }}">
                      {{ $transasaun->tipo }}
                    </span>
                  </td>
                  <td>{{ $transasaun->produtor->naran_produtor ?? $transasaun->naran_kliente ?? 'N/A' }}</td>
                  <td>{{ number_format($transasaun->kilo, 2) }} kg</td>
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
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.Left col -->

    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

      <!-- Stock Atual -->
      <div class="card card-custom">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Stock Atual
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Produtór Top -->
      <div class="card card-custom">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-trophy mr-1"></i>
            Produtór Top 5
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="list-group">
            @foreach($topProdutors as $produtor)
            <a href="{{ route('admin.produtors.show', $produtor->id_produtor) }}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1">{{ $produtor->naran_produtor }}</h6>
                <small class="text-success">{{ number_format($produtor->total_kilo, 1) }} kg</small>
              </div>
              <p class="mb-1">{{ $produtor->suku ?? '--' }}</p>
              <small>{{ $produtor->total_transasaun }} transasaun</small>
            </a>
            @endforeach
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Quick Actions -->
      <div class="card card-custom">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-bolt mr-1"></i>
            Asaun Lalais
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <a href="{{ route('admin.produtors.create') }}" class="btn btn-app bg-success">
                <i class="fas fa-user-plus"></i> Produtór
              </a>
            </div>
            <div class="col-6">
              <a href="{{ route('admin.transasauns.produsaun') }}" class="btn btn-app bg-primary">
                <i class="fas fa-plus-circle"></i> Transasaun
              </a>
            </div>
            <div class="col-6">
              <a href="#" class="btn btn-app bg-info">
                <i class="fas fa-chart-bar"></i> Relatóriu
              </a>
            </div>
            <div class="col-6">
              <a href="{{ route('admin.kafe-tipu.index') }}" class="btn btn-app bg-warning">
                <i class="fas fa-coffee"></i> Kafé
              </a>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
$(function () {
  // Revenue Chart
  var revenueChartCanvas = $('#revenueChart').get(0).getContext('2d')
  var revenueChartData = {
    labels: {!! json_encode($chartData['months']) !!},
    datasets: [
      {
        label: 'Produsaun',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: {!! json_encode($chartData['produsaun']) !!}
      },
      {
        label: 'Venda',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: {!! json_encode($chartData['venda']) !!}
      },
    ]
  }
  var revenueChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
        }
      }],
      yAxes: [{
        gridLines: {
          display: false,
        }
      }]
    }
  }
  var revenueChart = new Chart(revenueChartCanvas, {
    type: 'line',
    data: revenueChartData,
    options: revenueChartOptions
  })

  // Sales Chart
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
  var salesChartData = {
    labels: {!! json_encode($chartData['months']) !!},
    datasets: [
      {
        label: 'Produsaun',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        data: {!! json_encode($chartData['produsaun']) !!}
      },
      {
        label: 'Venda',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        data: {!! json_encode($chartData['venda']) !!}
      },
    ]
  }
  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
        }
      }],
      yAxes: [{
        gridLines: {
          display: false,
        }
      }]
    }
  }
  var salesChart = new Chart(salesChartCanvas, {
    type: 'bar',
    data: salesChartData,
    options: salesChartOptions
  })

  // Pie Chart
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData        = {
    labels: {!! json_encode($stockData['labels']) !!},
    datasets: [
      {
        data: {!! json_encode($stockData['data']) !!},
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      }
    ]
  }
  var pieOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  var pieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
  })
})
</script>
@endsection
