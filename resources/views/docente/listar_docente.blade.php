@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Listado de Docentes
</div>
<div>
    <!--<form class="form-inline my-6 my-lg-0 float-right mb-6">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Enviar</button>
    </form>-->
    <br><br>
    @csrf
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Tipo Doc</th>
        <th scope="col">Documento</th>
        <th scope="col">Nombres</th>
        <th scope="col">Fec. Vinculación</th>
        <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
      @foreach($docente as $d)
        <tr>
        <td>{{$d['descripcion']}}</td>
        <td>{{$d['num_doc']}}</td>
        <td>{{$d['nombre']}}  {{$d['apellido']}}</td>
        <td>{{$d['fec_vinculacion'] }}</td>
        <td>{{$d['id']}}</td>
        <td>
        <a href="{{route('actualizar_doc',$d['id'])}}" class="btn btn-success"><i class="nav-icon fas fa-edit" ></i></a>
        <button type="button" class="btn btn-info"><i class=" nav-icon fas fa-eye"></i></button>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script>
  function JsonDate(jsonDate) {
  var date = new Date(parseInt(jsonDate.substr(6)));
  return date ;
}
</script>
@endsection