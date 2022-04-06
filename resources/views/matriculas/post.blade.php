<!--tabla para ver los valores-->
<div class="container-fluid">
<table class="table">
<tr>

              <thead class="table-warning">
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
            <tbody>
                  <th scope="row">{{$post[0]->id}}</th>
                  <td>{{ $post[0]->nombre }}</td>
                  <td>{{ $post[0]->apellido }}</td>
                  <td>{{ $post[0]->direccion }}</td>
                  <td>{{ $post[0]->telefono }}</td>
                  <td>{{ $post[0]->num_doc }}</td>
                  <td>{{ $post[0]->descripcion }}</td>
                <td>
                 <!-- Button trigger modal -->
                    <a href="{{route('matricularadmin', $post[0]->id)}}" type="button" class="btn btn-primary" >
                    Matricular
                    </a> 
               </td>
            </tbody>
          </table>
        </div>
        <!--end tabla-->
