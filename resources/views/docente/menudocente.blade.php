    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
             <!--instanciar la ruta de nav link-->   
                  <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Inicio
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <!--end instancia-->
            <ul class="nav nav-treeview">
            <li class="nav-item">
                  <a href="{{route('inicio')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                    Principal
                    </p>
                  </a>

              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                    Mision y Visión
                    </p>
                  </a>

              </li>
              <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
                    <p>
                    Historia
                    </p>
                  </a>
              </li>
            </ul>
          </li>
         <!--perfil-->
         <li class="nav-item">
            <a href="{{route('regisperfil')}}" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Perfil 
              </p>
            </a>
          </li>
         <!--end perfil-->
          <li class="nav-item">
            <a href="{{route('reporte_asigdocc')}}" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Asignaturas
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{route('listado_doc')}}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Docentes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('listarestudo')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Estudiantes
              </p>
            </a>
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
                <a href="{{route('valorHab')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Valor habilitación</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Certificados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('certifLaboral')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laboral</p>
                </a>
              </li>
            </ul>
          </li>
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->