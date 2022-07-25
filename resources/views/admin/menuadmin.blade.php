
    <!-- Sidebar Menu -->
<?php

  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;

  $idusu = auth()->id();
   
  $per = DB::table('perfil_docente')->where('perfil_docente.id_usuario', '=', $idusu)->count();
  
?>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="{{route('inicio')}}" class="nav-link active" style="background-color:#6D6D6D;">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                <!--end instancia-->
          </li>
         <!--perfil-->
         <li class="nav-item">
            <a href="#" class="nav-link" style="color:#FFFFFF;" >
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Perfil 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($per==0) <!--valida si la persona ya tiene perfil o no -->
              <li class="nav-item">
                <a href="{{route('regisperfil')}}" class="nav-link" style="color:white;">
                <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                 <p>Registrar</p>
                </a>
              </li> 
              @endif 
              <li class="nav-item">
                <a href="{{route('actuperfil')}}" class="nav-link" style="color:white;">
                <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Actualizar Perfil</p>
                </a>
              </li>   
            </ul>
          </li>
         <!--end perfil-->
          <li class="nav-item">
            <a href="#" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Programas 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="{{route('registrarprog')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="{{route('reporte_tecnico')}}" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Técnicos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reporte_pro')}}" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Bachillerato</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('listado_docente')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Docentes
              </p>
            </a>
          <li class="nav-item">
            <a href="{{route('listarestu')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Estudiantes
              </p>
            </a>
          <li class="nav-item">
            <a href="{{route('matriculados_bach')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Reporte
              </p>
            </a>
          </li>
          <!--manejo de nivelaciones-->
          <li class="nav-item">
            <a href="#" class="nav-link" style="color:white;">
            <i class="nav-icon fas fa-edit"></i>
              <p>
               Nivelaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a type="button" data-toggle="modal" data-target="#exampleModalnotas" class="nav-link" style="color:white;">
               <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>
                    Bachillerato
                  </p>
                </a>
                @include('nivelaciones.nivelacionesadm')
              </li>
              <li class="nav-item">
                <a type="button" data-toggle="modal" data-target="#tecnicoRec" class="nav-link" style="color:white;">
                <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                    <p>
                      Técnicos
                    </p>
                  </a>
                  @include('nivelaciones.nivelacionTecnico')
                </li>
            </ul>
          </li>
          <!--end nivelaciones-->
          <!---manejo de usuarios--->
          <li class="nav-item">
            <a href="#" class="nav-link" style="color:white;">
            <i class="fas fa-users"></i>
              <p>
               &nbsp Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('listausu')}}" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Reporte</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('rolesvis')}}" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Roles</p><!--agregar descripcion para el certificados-->
                </a>
              </li>
            </ul>
          </li>
          <!---end manejo de usuarios--->
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->