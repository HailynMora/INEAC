@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Formulario Registro de Docentes
</div>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Datos Personales
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="formudatos" name="formudatos" method="post">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="tipodoc">Tipo de Documento</label>
                    <select id="tipodoc" class="form-control" name="tipodoc" required>
                      <option selected>Seleccionar</option>
                      @foreach($tipodoc as $t)
                      <option value="{{$t->id}}">{{$t->descripcion}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="numerodoc">Numero Documento</label>
                    <input type="number" class="form-control" id="numerodoc" name="numerodoc" placeholder="12345678" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="correo">Correo Electronico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="example@example.com" required>
                    <div id="respuesta" class="col-lg-5"></div>
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="form-control" id="telefono" name="telefono">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="fec_vinculacion">Fecha vinculación</label>
                    <input type="date" class="form-control" id="fec_vinculacion" name="fec_vinculacion" required>
                  </div>
                  <div class="form-group col-md-3" >
                  <label for="id_usuario">Usuario</label>
                  <select id="id_usuario" class="form-control" name="id_usuario" required>
                  <option selected>Seleccionar</option>
                  @foreach($user as $u)
                  <option value="{{$u->id}}">{{$u->name}}</option>
                  @endforeach
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="tipogen">Genero</label>
                    <select id="tipogen" class="form-control" name="tipogen" required>
                    @foreach($genero as $g)
                    <option value="{{$g->id}}">{{$g->descripcion}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
              </form>
        </div>
      </div>
    </div>
  </div>
  <!--instanciar el ajax para quitar el error no definido-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  

  $('#formudatos').submit(function(e){
            e.preventDefault();
            var nombre=$('#nombre').val();
            var apellido=$('#apellido').val();
            var direccion=$('#direccion').val();
            var telefono=$('#telefono').val();
            var correo=$('#correo').val();
            var numerodoc=$('#numerodoc').val();
            var fec_vinculacion=$('#fec_vinculacion').val();
            var id_usuario = $("#id_usuario").val();
            var tipodoc=$('#tipodoc').val();
            var tipogen=$('#tipogen').val();
            var _token = $('input[name=_token]').val(); //token de seguridad

            $.ajax({
              type: "POST",
              url: "{{route('datosdoc')}}",
              dataType: 'html',
              data:{
                nombre:nombre,
                apellido:apellido,
                direccion:direccion,
                telefono:telefono,
                correo:correo,
                numerodoc:numerodoc,
                fec_vinculacion:fec_vinculacion,
                id_usuario:id_usuario,
                tipodoc:tipodoc,
                tipogen:tipogen,
                _token:_token
              },
              success: function (response) {
                if(response){
                  $('#formudatos')[0].reset();
                  toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:1000});
                }
              },
              error: function(response){
                toastr.warning('Datos Repetidos (correo y/o Numero de documento)',{timeOut:1000});
              }
            });
          })
  
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] ,form input[type=date] , form input[type=email]").each(function() { this.value = '' });
     toastr.success('Campos Vacios', {timeOut:1000});
  }
</script>
@endsection