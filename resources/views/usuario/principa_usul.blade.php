<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INESUR</title>
  @include('usuario.stylecss')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/img/logo.png" alt="INESUR" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!---cerrar sesion-->
        <!--cerrar sesion-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user-circle fa-lg"></i>
        <!--pantallas pequeñas <span class="d-none d-lg-block"> --> 
      </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="dropdown-divider"></div>
             &nbsp;&nbsp;<b>{{ Auth::user()->name }}</b>
            <div class="dropdown-divider"></div>
            <a href="route('logout')" class="dropdown-item"  onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="fas fa-sign-out-alt fa-lg"></i> Cerrar sesión
            </a>
          </form>
      </li>
      <!----->
      <!--end cerrar sesion-->
    </ul>
  </nav>
  <!-- /.navbar -->

 
      

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!--<a href="index3.html" class="brand-link">-->
     <!-- <img src="img/inesur_logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>-->
     <a href="#"><img src="/img/inesur_logo.jpg" class="img-fluid" width="100%" height="40%"></a> 
    <!--</a>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
          use Illuminate\Support\Facades\DB;
          use Illuminate\Support\Facades\Auth;

           $id=auth()->id();
           $im= DB::table('perfil_docente')->where('id_usuario', '=', $id)->select('imagen')->first();
           $es= DB::table('estudiante')->where('id_usuario', '=', $id)->select('foto')->first();
          ?>
          @if(Auth::user()->id_rol==1) <!--Logeado como administrador-->
          @endif
          @if(Auth::user()->id_rol==2 || Auth::user()->id_rol==1) <!--Logeado como usuario-->
              @if(isset($im->imagen))
              <img src="{{asset('dist/perfil/'.$im->imagen)}}" class="img-circle elevation-2" alt="User Image">
              @endif
           @endif
          @if(Auth::user()->id_rol==3) <!--Logeado como jefe-->
             @if(isset($es->foto))
               <img src="{{asset('dist/perfil/'.$es->foto)}}" class="img-circle elevation-2" alt="User Image">
              @endif
          @endif
         
          </div>
        <div class="info">
          <a href="{{route('actuperfil')}}" class="d-block"><h6 style="color:white;">{{ Auth::user()->name }}</h6></a>
        </div>
      </div>
      <!--actualizar perfil-->
    
        <!--finalizar perfil-->
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    <!--Funcionar los roles--->
        @if(Auth::user()->id_rol==1) <!--Logeado como administrador-->
            @include('admin.menuadmin')
        @endif
        @if(Auth::user()->id_rol==2) <!--Logeado como usuario-->
            @include('docente.menudocente')
        @endif
        @if(Auth::user()->id_rol==3) <!--Logeado como jefe-->
            @include('estudiantes.menuestu')
        @endif
    <!--- finalizar funcionar roles-->
  
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>INEAC 2021 - 2022</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
@include('usuario.stylejs')

</body>
</html>