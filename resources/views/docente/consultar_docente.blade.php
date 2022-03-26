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
     
    </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection