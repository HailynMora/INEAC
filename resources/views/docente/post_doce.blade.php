<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">N° Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Direccion</th>
        <th scope="col">Fec. Vinculación</th>
        <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
      
        <tr>
        <td>{{ $post->num_doc }}</td>
        <td>{{ $post->nombre }} {{ $post->apellido }}</td>
        <td>{{ $post->telefono }}</td>
        <td>{{ $post->direccion }}</td>
        <td>{{ $post->fec_vinculacion }}</td>
        
        <td>
        <a href="{{route('actualizar_doc',$post->id)}}" class="btn btn-success"><i class="nav-icon fas fa-edit" ></i></a>
        <button type="button" class="btn btn-info"><i class=" nav-icon fas fa-eye"></i></button>
        </td>
        </tr>
    </tbody>
</table>