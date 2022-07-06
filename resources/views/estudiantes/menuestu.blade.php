<!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="{{route('inicio')}}"  class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                <!--end instancia-->
          </li>
          <li class="nav-item">
            <a href="{{route('planEstudios')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Programas 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('lis_docente')}}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Docentes
              </p>
            </a>
          </li>                
         
          <li class="nav-item">
          <a type="button" data-toggle="modal" data-target="#exampleModalnotas" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
              <p>
                  Calificaciones      
            </p>
          </a>
           @include('estudiantes.calificaciones')
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Nivelaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--hasta aqui verificar-->
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Est. Reprobados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Valor habilitación</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('certifEstu')}}" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Certificado
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->