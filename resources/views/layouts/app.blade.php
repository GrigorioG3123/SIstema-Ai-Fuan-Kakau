<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - CCT Management System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Custom CSS -->
  <style>
    .bg-cct-primary { background-color: #2c3e50 !important; }
    .bg-cct-secondary { background-color: #34495e !important; }
    .text-cct { color: #2c3e50 !important; }
    .btn-cct { background-color: #2c3e50; border-color: #2c3e50; color: white; }
    .btn-cct:hover { background-color: #34495e; border-color: #34495e; }

    .sidebar-custom {
      background-color: #2c3e50;
      background-image: linear-gradient(180deg, #2c3e50 10%, #34495e 100%);
    }

    .brand-link-custom {
      border-bottom: 1px solid #4b6584;
    }

    .nav-sidebar > .nav-item > .nav-link.active {
      background-color: #3498db;
      border-left: 4px solid #2980b9;
    }

    .info-box-custom {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      border-left: 4px solid #3498db;
    }

    .card-custom {
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 10px;
      border-top: 3px solid #3498db;
    }

    .table-custom thead {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
      color: white;
    }
  </style>

  @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    <div class="mt-2">
      <strong>CCT System</strong>
    </div>
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Ajuda</a>
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
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Sair
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-custom">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link brand-link-custom">
      <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="CCT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>CCT</b> System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name ?? 'Administrador' }}</a>
          <small class="text-light">Admin</small>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buka" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
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
                <a href="{{ route('admin.kafe-tipu.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipu Foun</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Armajen Menu -->
          <li class="nav-item {{ Request::is('admin/armajen*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/armajen*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Armajen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.armajen.index') }}" class="nav-link {{ Request::is('admin/armajen') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Armajen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.armajen.create') }}" class="nav-link {{ Request::is('admin/armajen/create') ? 'active' : '' }}">
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
                <a href="{{ route('admin.transasauns.index') }}" class="nav-link {{ Request::is('admin/transasauns') && !Request::is('admin/transasauns/produsaun') && !Request::is('admin/transasauns/venda') && !Request::is('admin/transasauns/create') ? 'active' : '' }}">
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
                <a href="{{ route('admin.transasauns.produsaun') }}" class="nav-link {{ Request::is('admin/transasauns/produsaun') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Produsaun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.transasauns.venda') }}" class="nav-link {{ Request::is('admin/transasauns/venda') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista Venda</p>
                </a>
              </li>

            </ul>

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
                <a href="{{ route('admin.relatorio.geral') }}" class="nav-link {{ Request::is('admin/relatorio/geral') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Geral</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.relatorio.anual') }}" class="nav-link {{ Request::is('admin/relatorio/anual') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Anual</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.relatorio.mensal') }}" class="nav-link {{ Request::is('admin/relatorio/mensal') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Relatóriu Mensál</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

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

    // Initialize Select2
    $('.select2').select2();

    // Toastr notifications
    @if(session('success'))
      toastr.success('{{ session('success') }}');
    @endif

    @if(session('error'))
      toastr.error('{{ session('error') }}');
    @endif

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
      $('.alert').alert('close');
    }, 5000);
  });
</script>

@yield('scripts')
</body>
</html>
