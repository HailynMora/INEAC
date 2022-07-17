<!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="{{route('inicio')}}" class="nav-link active" style="background-color:#6D6D6D; color: white;">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                <!--end instancia-->
          </li>
          <li class="nav-item">
            <a href="{{route('perfilEstu')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Perfil 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Programas 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('planEstudios')}}" class="nav-link" style="color:white; margin-left: 15px;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bachillerato</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('planEstudiosTec')}}" class="nav-link" style="color:white;margin-left: 15px;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Técnicos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('lis_docente')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Docentes
              </p>
            </a>
          </li>                
         
          <li class="nav-item">
          <a type="button" data-toggle="modal" data-target="#exampleModalnotas" class="nav-link" style="color:white;">
            <i class="nav-icon fas fa-book"></i>
              <p>
                  Calificaciones      
            </p>
          </a>
           @include('estudiantes.calificaciones')
          </li>
          
          <li class="nav-item">
            <a href="{{route('nivelacionEstudiantes')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Nivelaciones
              </p>
            </a>
          </li>
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->