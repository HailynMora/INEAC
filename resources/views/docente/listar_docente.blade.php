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
        <td>{{date("Y-m-d", strtotime($d['fec_vinculacion']))}}</td>
        <td>
        <a href="{{route('actualizar_doc',$d['id'])}}" class="btn btn-success"><i class="nav-icon fas fa-edit" ></i></a>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-eye"></i></button>
      </td>
        </tr>
        @endforeach
    </tbody>
    </table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <div class="modal-body">
        <form id="formudatos" name="formudatos" method="post">
        @csrf
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="tipo_doc">Tipo Documento</label>
              <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" disabled value="tipo">
            </div>
            <div class="form-group col-md-3">
              <label for="num_doc">N° Documento</label>
              <input type="text" class="form-control" id="num_doc" name="num_doc" disabled value="num_doc">
            </div>
            <div class="form-group col-md-3">
              <label for="correo">Correo</label>
              <input type="text" class="form-control" id="correo" name="correo" disabled value="correo">
            </div>
            <div class="form-group col-md-3">
              <label for="telefono">Telefono</label>
              <input type="text" class="form-control" id="telefono" name="telefono" disabled value="telefono">
            </div>
            <div class="form-group col-md-4">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" id="direccion" name="direccion" disabled value="direccion">
            </div>
            <div class="form-group col-md-4">
              <label for="genero">Genero</label>
              <input type="text" class="form-control" id="genero" name="genero" disabled value="genero">
            </div>
            <div class="form-group col-md-4">
              <label for="fec_vinculacion">Fecha de Vinculacion</label>
              <input type="text" class="form-control" id="fec_vinculacion" name="fec_vinculacion" disabled value="genero">
            </div>
            <div class="form-group justify-content-center col-md-12 ">
              <label for="asig_dictadas">Asignaturas a Cargo</label>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Programa</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>codigo</td>
                    <td>Asignatura</td>
                    <td>Programa</td>
                  </tr>
                </tbody>
                </table>
            </div>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </form>
      </div>
    </div>
  </div>
</div>

</div>
<script>
  function JsonDate(jsonDate) {
  var date = new Date(parseInt(jsonDate.substr(6)));
  return date ;
}
</script>
@endsection