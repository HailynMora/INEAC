<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
                <th scope="col">No. Documento</th>
                <th scope="col">Seleccionar</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <th scope="row">{{$post->id}}</th>
                  <td>{{ $post->nombre }}</td>
                  <td>{{ $post->apellido }}</td>
                  <td>{{ $post->direccion }}</td>
                  <td>{{ $post->telefono }}</td>
                  <td>{{ $post->num_doc }}</td>
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
