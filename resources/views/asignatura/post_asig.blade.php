<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning" style="background-color:#FFCC00;">
              <tr>
              <th scope="col">Código</th>
              <th scope="col">Asignatura</th>
              <th scope="col">Intensidad Horaria</th>
              <th scope="col">Val. Habilitación</th>
              <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
                <tr style="background-color: #dcedc8;">
                  <td>{{$post->codigo}}</td>
                  <td>{{$post->nombre}}</td>
                  <td>{{$post->intensidad_horaria}}</td>
                  <td>{{$post->val_habilitacion}}</td>
                <td>
                <a href="{{route('actualizar_asig',$post->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>             
                &nbsp&nbsp
                <?php
                  if($post->estado == 'Activo'){
                      ?>
                      <a href="#" ><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                      <?php
                  }else{
                      ?>
                      <a href="#" ><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                      <?php
                  }
                ?>
                &nbsp&nbsp
                <a href="#" ><i class="fas fa-trash-alt" style="color:  red;" ></i></a>
              </td>

                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
            </tbody>
          </table>

        <!--end tabla-->
