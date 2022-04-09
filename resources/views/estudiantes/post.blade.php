<!--tabla para ver los valores-->
<table class="table" style="background-color:#FFCC00;">
<tr>

              <thead class="table-warning" >
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
                <th scope="col">No. Documento</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Seleccionar</th>
              </tr>
            </thead>
            <tbody style="background-color: #dcedc8;">
                  <th scope="row">{{$post[0]->id}}</th>
                  <td>{{ $post[0]->nombre }}</td>
                  <td>{{ $post[0]->apellido }}</td>
                  <td>{{ $post[0]->direccion }}</td>
                  <td>{{ $post[0]->telefono }}</td>
                  <td>{{ $post[0]->num_doc }}</td>
                  <td>{{ $post[0]->descripcion }}</td>
                <td>
                <a href="{{route('actualizar_est',$post[0]->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $post[0]->id;?>">
                <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
                </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
            </tbody>
          </table>

        <!--end tabla-->
