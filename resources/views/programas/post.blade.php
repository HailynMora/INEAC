<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning" style="background-color:#FFCC00;">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Codigo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                <tr style="background-color: #dcedc8;">
                  <th scope="row">{{$post->id}}</th>
                  <td>{{ $post->codigo }}</td>
                  <td>{{ $post->descripcion }}</td>
                  <td>{{ $post->id_estado }}</td>
                <td>
                <a href="{{route('actualizar_prog',$post->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>
                &nbsp&nbsp
                <a href="{{route('actualizar_prog',$post->id)}}" ><i class="fas fa-trash-alt" style="color:  red;" ></i></a>

                </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
            </tbody>
          </table>

        <!--end tabla-->
