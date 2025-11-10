<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - Sistema CCT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.css') }}">
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifikasaun</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 mensagen foun
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 pedidu foun
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Hare Notifikasaun Hotu</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="CCT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Sistema</b> CCT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name ?? 'Administrador' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Produtór Menu -->
          <li class="nav-item {{ Request::is('admin/produtors*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/produtors*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Produtór
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.produtors.index') }}" class="nav-link {{ Request::is('admin/produtors') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Produtór</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.produtors.create') }}" class="nav-link {{ Request::is('admin/produtors/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejistu Foun</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Kafé Tipu Menu -->
          <li class="nav-item {{ Request::is('admin/kafe-tipu*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/kafe-tipu*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-coffee"></i>
              <p>
                Kafé Tipu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.kafe-tipu.index') }}" class="nav-link {{ Request::is('admin/kafe-tipu') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Tipu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.kafe-tipu.create') }}" class="nav-link {{ Request::is('admin/kafe-tipu/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipu Foun</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Armajen Menu -->
          <li class="nav-item {{ Request::is('admin/armajens*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/armajens*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Armajen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.armajens.index') }}" class="nav-link {{ Request::is('admin/armajens') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Armajen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.armajens.create') }}" class="nav-link {{ Request::is('admin/armajens/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Armajen Foun</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Transasaun Menu -->
          <li class="nav-item {{ Request::is('admin/transasauns*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/transasauns*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Transasaun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.transasauns.index') }}" class="nav-link {{ Request::is('admin/transasauns') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Transasaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.transasauns.create') }}" class="nav-link {{ Request::is('admin/transasauns/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transasaun Foun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.transasauns.produsaun') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produsaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.transasauns.venda') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venda</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Relatóriu Menu -->
          <li class="nav-item {{ Request::is('admin/relatorios*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/relatorios*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Relatóriu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.relatorios.geral') }}" class="nav-link {{ Request::is('admin/relatorios/geral') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Geral</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.relatorios.anual') }}" class="nav-link {{ Request::is('admin/relatorios/anual') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Anual</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.relatorios.mensal') }}" class="nav-link {{ Request::is('admin/relatorios/mensal') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Mensál</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.relatorios.stock') }}" class="nav-link {{ Request::is('admin/relatorios/stock') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Stock</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Konfigurasaun Menu -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Konfigurasaun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Uzuáriu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sistema</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Susesu!</h5>
            {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Erru!</h5>
            {{ session('error') }}
          </div>
        @endif

        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">Sistema CCT - Café Timor</a>.</strong>
    Todos direitu reservadu.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versaun</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('vendor/adminlte/plugins/chart.js/Chart.min.js') }}"></script>

<script>
  $(function () {
    // Initialize DataTable
    $('.datatable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "search": "Buka:",
        "lengthMenu": "Hatudu _MENU_ rejistu",
        "info": "Hatudu _START_ to'o _END_ hosi _TOTAL_ rejistu",
        "paginate": {
          "previous": "Molok",
          "next": "Oinmai"
        }
      }
    });

    // Toastr notifications
    @if(session('success'))
      toastr.success('{{ session('success') }}');
    @endif

    @if(session('error'))
      toastr.error('{{ session('error') }}');
    @endif
  });
</script>

@yield('scripts')
</body>
</html>
