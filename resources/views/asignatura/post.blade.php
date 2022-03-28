<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Codigo</th>
                <th scope="col">Horas</th>
                <th scope="col">Val</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <th scope="row">{{$post->id}}</th>
                  <td>{{ $post->nombre }}</td>
                  <td>{{ $post->codigo }}</td>
                  <td>{{ $post->intensidad_horaria}}</td>
                  <td>{{ $post->val_habilitacion}}</td> 
                  <td>{{ $post->id_estado}}</td> 
                <td>
                <a style="text-decoration:none" type="button" class="btn btn-warning">Accion</a>
                </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
            </tbody>
          </table>

        <!--end tabla-->
