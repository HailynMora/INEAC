@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Registro de Acudientes
</div>
<form  method="post" id="formudatos" name="formudatos" method="post">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group col-md-6">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>
  </div>
  <div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" required >
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="telefono">Telefono o Celular</label>
    <input type="text" class="form-control" id="telefono" name="telefono" required>
  </div>
  <div class="form-group col-md-6">
      <label for="tipogen">Genero</label>
      <select id="tipogen" name="tipogen" class="form-control">
      <option selected>Seleccionar</option>
        @foreach($genero as $g)
        <option value="{{$g->id}}">{{$g->descripcion}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="tipodoc">Tipo Documento</label>
      <select id="tipodoc" name="tipodoc" class="form-control">
        <option selected>Seleccionar</option>
        @foreach($tipodoc as $t)
        <option value="{{$t->id}}">{{$t->descripcion}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="numerodoc">Número Documento</label>
      <input type="text" class="form-control" id="numerodoc" name="numerodoc" required> 
    </div>
    <div class="form-group col-md-4">
    <label for="parentesco">Parentesco</label>
      <select id="parentesco" name="parentesco" class="form-control">
        <option selected></option>
        @foreach($paren as $p)
        <option value="{{$p->id}}">{{$p->descripcion}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Registrar</button>
</form>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  /*tomamos la información del formulario y la enviamos a la ruta y de la ruta al controlador*/
  $('#formudatos').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    var apellido=$('#apellido').val();
    var direccion=$('#direccion').val();
    var telefono=$('#telefono').val();
    var genero=$('#tipogen').val();
    var tipodoc=$('#tipodoc').val();
    var numerodoc=$('#numerodoc').val();
    var parentesco=$('#parentesco').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url:"{{route('datosacu')}}",
      
      data:{
        nombre:nombre,
        apellido:apellido,
        direccion:direccion,
        telefono:telefono,
        genero:genero,
        tipodoc:tipodoc,
        numerodoc:numerodoc,
        parentesco:parentesco,
        _token:_token
      }, 
      success:function(response){
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      }
    });
  });
 </script> 
@endsection