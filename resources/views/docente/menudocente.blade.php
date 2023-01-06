<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $idoc = auth()->user()->id;
  $valida = DB::table('docente')->where('id_usuario', '=', $idoc)->select('docente.id as idocente')->count();
  if($valida != 0){
  $valdoc= DB::table('docente')->where('id_usuario', '=', $idoc)->select('docente.id as idocente')->first();
  $asigbachi = DB::table('cursos')->where('cursos.id_docente', '=', $valdoc->idocente)->count();
  $asigtec = DB::table('asignaturas_tecnicos')->where('asignaturas_tecnicos.id_docente', '=', $valdoc->idocente)->count();
  }
?>
<style>
  nav ul li a:hover {
      /*background-color: #eca023;*/
      background-color:#6D6D6D;
    }
</style>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <div style="background-color:#eca023; margin-left:-6px; margin-right:-6px; margin-bottom:5px;"><br></div>
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="{{route('inicio')}}"  class="nav-link" style="color: white;">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                <!--end instancia-->
          </li>
         <!--perfil-->
         <li class="nav-item">
            <a href="{{route('regisperfil')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Perfil 
              </p>
            </a>
          </li>
         <!--end perfil-->
          <li class="nav-item">
            <a href="{{route('reporte_asigdocc')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Asignaturas
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{route('listado_doc')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Docentes
              </p>
            </a>
          </li>

          <!--estudiantes-->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" style="color:white;">
            <i class="nav-icon fas fa-university"></i>
              <p>
                Estudiantes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(isset($asigbachi))
            @if($asigbachi!=0)
              <li class="nav-item">
                <a type="button" data-toggle="modal" data-target="#exampleModalListaB" class="nav-link" style="color:white;">
                <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                    <p>
                      Bachillerato   
                  </p>
                </a>
                @include('docente.listadoEstu')
              </li> 
            @endif 
            @endif 
            @if(isset($asigtec))
            @if($asigtec !=0)
            <li class="nav-item">
                <a type="button" data-toggle="modal" data-target="#listaTec" class="nav-link" style="color:white;">
                <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                    <p>
                      Técnico  
                  </p>
                </a>
                @include('docente.listadoEstuTecnico')
              </li>
            @endif  
            @endif  
            </ul>
          </li>
          <!--end estudiantes-->
          <!---aqui-->
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
            @if(isset($asigbachi))
            @if($asigbachi!=0)
              <li class="nav-item">
                  <a type="button" data-toggle="modal" data-target="#exampleModalnive" class="nav-link" style="color:white;">
                  <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                    <p>
                      Bachillerato   
                  </p>
                </a>
                @include('nivelaciones.nivelacionesdoc')
              </li>
              @endif
              @endif
              @if(isset($asigtec))
              @if($asigtec !=0)
                <li class="nav-item">
                    <a type="button" data-toggle="modal" data-target="#nivTec" class="nav-link" style="color:white;">
                    <i class="far fa-circle nav-icon" style="margin-left:15px;"></i>
                        <p>
                          Técnico  
                      </p>
                    </a>
                    @include('nivelaciones.nivelacionesTec')
                  </li>
              @endif
              @endif  
            </ul>
          </li>
          <!--end nivelaciones-->
          <!--end aqui-->
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>

      <!-- /.sidebar-menu -->