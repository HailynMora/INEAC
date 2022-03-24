@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Consulta Docentes
</div>
<div>
    <form class="form-inline my-6 my-lg-0 float-right mb-6">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="buscar" name="buscar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Enviar</button>
    </form>
    <br><br>
    @csrf
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Tipo Doc</th>
        <th scope="col">Documento</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Fec. Vinculación</th>
        <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
      @foreach($docente as $d)
        <tr>
        <td>{{$d['descripcion']}}</td>
        <td>{{$d['num_doc']}}</td>
        <td>{{$d['nombre']}}</td>
        <td>{{$d['apellido']}}</td>
        <td>{{$d['fec_vinculacion']}}</td>
        <td></td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(function(buscar()));
    function buscar(consulta){
        $.$.ajax({
            type: "post",
            url: ""{{route('consuldoc')}}"",
            data: {consulta: consulta},
            dataType: "html"
        })
        .done(function(respuesta){
            $("#datos").html(respuesta);
        })
        .fail(function(){
            console.log("error");
        })
    }
</script><
@endsection