@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<table class="table table-striped">
       <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Dirección</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Estrato</th>
        <th scope="col">Etnia</th>
        <th scope="col">Genero</th>
        <th scope="col">Tipo Doc</th>
        <th scope="col">Número</th>
        <th scope="col">Acudiente</th>
        <th scope="col">Usuario</th>
        <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
    @if($b == 1)
      @foreach($estudiante as $d)
        <tr>
        <td>{{$d->nombre}}</td>
        <td>{{$d->apellido}}</td>
        <td>{{$d->direccion}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->correo}}</td>
        <td>{{$d->estrato}}</td>
        <td>{{$d->id_etnia}}</td>
        <td>{{$d->id_genero}}</td>
        <td>{{$d->id_tipo_doc}}</td>
        <td>{{$d->num_doc}}</td>
        <td>{{$d->id_acudiente}}</td>
        <td>{{$d->id_usuario}}</td>
        <td>{{$d->id_estado}}</td>
        </tr>
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
               No Hay Registros
            </div>
        @endif
    </tbody>
    </table>
 <!--finalizar Tabla de informacion-->
@endsection