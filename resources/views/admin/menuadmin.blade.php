
    <!-- Sidebar Menu -->
<?php

  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;

  $idusu = auth()->id();
   
  $per = DB::table('perfil_docente')->where('perfil_docente.id_usuario', '=', $idusu)->count();
  
?>
<style>
  nav ul li a:hover {
      /*background-color: #eca023;*/
      background-color:#6D6D6D;
    }
</style>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <div style="background-color:#eca023; margin-left:-6px; margin-right:-6px; margin-bottom:5px;"><br></div>
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="{{route('inicio')}}" class="nav-link" style="color:#FFFFFF;">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                <!--end instancia-->
          </li>
         <!--perfil-->
         <li class="nav-item">
            <a href="{{route('regisperfil')}}" class="nav-link" style="color:#FFFFFF;" >
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Perfil 
              </p>
            </a>
          </li>
         <!--end perfil-->
          <!---manejo de usuarios--->
          <li class="nav-item">
            <a href="{{route('listausu')}}" class="nav-link" style="color:white;">
            <i class="fas fa-users" style="margin-left:2px;"></i>
              <p>
               &nbsp Usuarios
              </p>
            </a>
          </li>
          <!---end manejo de usuarios--->
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
              <li class="nav-item">
                <a href="{{route('publicidad')}}" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                  <p>Publicidad</p>
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
                Reportes
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
          <li class="nav-item">
              <a type="button" data-toggle="modal" data-target="#exampleModalcerti" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Certificado Laboral
              </p>
            </a>
            @include('docente.modalcertificado')
          </li>
          <!--end nivelaciones-->
         
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->