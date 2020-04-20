<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name', 'Calificaciones') }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{!! asset('adminlte/plugins/fontawesome-free/css/all.min.css') !!}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('adminlte/dist/css/adminlte.min.css') !!}">

  <!-- DataTables -->
  <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css' />
  <link href='https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css' />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('select2-4.0.13/dist/css/select2.min.css') !!}">

  <!-- Chosen -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @if(auth()->check())
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('home') }}" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
    </ul>
  </nav>
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(auth()->check())
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
      <img src="{!! asset('adminlte/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Calificaciones') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Nombre del Usuario -->
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
      </a>    
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

        <!-- Logout -->
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>


      <!-- Sidebar Menu -->
        @include('includes.menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @endif

  <!-- Content Wrapper. Contains page content -->
  @if(auth()->check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  @endif
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('includes.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- jQuery -->
<script src="{!! asset('adminlte/plugins/jquery/jquery.min.js') !!}"></script>
<!-- DataTables -->
<script src='https://code.jquery.com/jquery-3.3.1.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js'></script>
<script>
<!-- Bootstrap 4 -->
<script src="{!! asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('adminlte/dist/js/adminlte.min.js') !!}"></script>
<!-- Selected Anidados -->
<script src="{!! asset('js/admin/denuncias/edit.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('select2-4.0.13/dist/js/select2.min.js') !!}"></script>

<!-- Chosen -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.min.js"></script>

<!-- Servidor LIve Dev -->
<script src="http://localhost:35729/livereload.js"></script>




</body>
</html>
