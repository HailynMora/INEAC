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
        <td>{{$d['num_doc']}}</td>
        <td>{{$d['nombre']}}  {{$d['apellido']}}</td>
        <td>{{date("Y-m-d", strtotime($d['fec_vinculacion']))}}</td>
        <td>
        <a href="{{route('actualizar_doc',$d['id'])}}" ><i class="nav-icon fas fa-edit" ></i></a>&nbsp&nbsp&nbsp
        <a type="button"  data-toggle="modal" data-target="#docente<?php echo $d['id'];?>">
        <i class="nav-icon fas fa-eye"></i>
        </a>
      <div class="modal fade" id="docente<?php echo $d['id'];?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                <div> DOCENTE:  {{$d['nombre']}}  {{$d['apellido']}}</div>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!---Mostrar datos-->
              <form id="formudatos" name="formudatos" method="post">
              @csrf
              <div class="form-row">
              <div class="form-group col-md-3">
                <label for="tipo_doc">Tipo Documento</label>
                <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" disabled value="{{$d['descripcion']}}">
              </div>
              <div class="form-group col-md-3">
                <label for="num_doc">N° Documento</label>
                <input type="text" class="form-control" id="num_doc" name="num_doc" disabled value="{{$d['num_doc']}}">
              </div>
              <div class="form-group col-md-3">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo" disabled value="{{$d['correo']}}">
              </div>
              <div class="form-group col-md-3">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" disabled value="{{$d['telefono']}}">
              </div>
              <div class="form-group col-md-4">
                <label for="direccion">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" disabled value="{{$d['direccion']}}">
              </div>
              <div class="form-group col-md-4">
                <label for="genero">Genero</label>
                <input type="text" class="form-control" id="genero" name="genero" disabled value="{{$d['genero']}}">
              </div>
              <div class="form-group col-md-4">
                <label for="fec_vinculacion">Fecha de Vinculacion</label>
                <input type="text" class="form-control" id="fec_vinculacion" name="fec_vinculacion" disabled value="{{date('Y-m-d', strtotime($d['fec_vinculacion']))}}">
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
                  </tr>
                </tbody>
                </table>
            </div>
          </div>
          

        </form>
              
              <!--end mostrar datos-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
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