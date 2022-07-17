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
          <li class="nav-item">
            <a type="button" data-toggle="modal" data-target="#exampleModalListaB" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-book"></i>
                <p>
                   Estudiantes    
              </p>
            </a>
            @include('docente.listadoEstu')
          </li>                  
          <li class="nav-item">
            <a type="button" data-toggle="modal" data-target="#exampleModalnive" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-edit"></i>
                <p>
                   Nivelaciones    
              </p>
            </a>
            @include('nivelaciones.nivelacionesdoc')
          </li>
          <li class="nav-item">
            <a href="{{route('certifLaboral')}}" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Certificado Laboral
              </p>
            </a>
          </li>
          <br>
          

        </ul>
        <br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->