<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning">
              <tr>
              <th scope="col">Código</th>
              <th scope="col">Asignatura</th>
              <th scope="col">Intensidad Horaria</th>
              <th scope="col">Val. Habilitación</th>
              <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{$post->codigo}}</td>
                  <td>{{$post->nombre}}</td>
                  <td>{{$post->intensidad_horaria}}</td>
                  <td>{{$post->val_habilitacion}}</td>
                <td>
                <a href="{{route('actualizar_asig',$post->id)}}" ><i class="nav-icon fas fa-edit" ></i></a>&nbsp&nbsp&nbsp                </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
            </tbody>
          </table>

        <!--end tabla-->
