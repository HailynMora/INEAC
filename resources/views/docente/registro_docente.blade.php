@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc103; color:#ffffff;">
 <h3 class="letra1">Registro de docentes</h3>
</div>
<br>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <!---->
        <div class="row">
           <div class="col-md-10">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Datos personales
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right alerta" type="button" href="/docente/listado_docente">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
      </div>
  
      <div id="collapseOne" class="collapse show letraf" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="formudatos" name="formudatos" method="post">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="tipodoc">Tipo de documento</label>
                    <select id="tipodoc" class="form-control" name="tipodoc" required>
                      @foreach($tipodoc as $t)
                      <option value="{{$t->id}}">{{$t->descripcion}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="numerodoc">Número de documento</label>
                    <input type="text" class="form-control" id="numerodoc" name="numerodoc" placeholder="12345678" minlength="5" maxlength="12" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required  onkeypress="return soloLetras(event)">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required  onkeypress="return soloLetras(event)">
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="example@example.com" required>
                    <div id="respuesta" class="col-lg-5"></div>
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="10" maxlength="10" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="fec_vinculacion">Fecha vinculación</label>
                     <input type="date" class="form-control" id="fec_vinculacion" name="fec_vinculacion" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="tipogen">Género</label>
                    <select id="tipogen" class="form-control" name="tipogen" required>
                    @foreach($genero as $g)
                    <option value="{{$g->id}}">{{$g->descripcion}}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="estado">Estado</label>
                    <select id="estado" class="form-control" name="estado" required>
                    @foreach($estado as $es)
                      <option value="{{$es->id}}">{{$es->descripcion}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                 <a  class="btn btn-danger" href="{{url('/docente/listado_docente')}}">Salir</a>
                 <button type="submit" class="btn btn-info"  onclick="resetform()">Limpiar</button>
                 <button type="submit" class="btn btn-success">Guardar</button>
               </div>
              </form>
        </div>
      </div>
    </div>
  </div>
  <!--instanciar el ajax para quitar el error no definido-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  function soloLetras(e) {
    var key = e.keyCode || e.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = " ñáéíóúabcdefghijklmnopqrstuvwxyz",
      especiales = [8, 37, 39, 46],
      tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = false;
        break;
      }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
  }

  $('#formudatos').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    var apellido=$('#apellido').val();
    var direccion=$('#direccion').val();
    var telefono=$('#telefono').val();
    var correo=$('#correo').val();
    var numerodoc=$('#numerodoc').val();
    var fec_vinculacion=$('#fec_vinculacion').val();
    var email = correo;
    var pass = numerodoc;
    var tipodoc=$('#tipodoc').val();
    var tipogen=$('#tipogen').val();
    var estado=$('#estado').val();
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
        email:email,
        pass:pass,
        tipodoc:tipodoc,
        tipogen:tipogen,
        estado:estado,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('Docente registrado correctamente.', 'Nuevo Registro', {timeOut:1000});
        }
      },
      error:function(jqXHR, response){
        if(jqXHR.status==422){
          toastr.warning('Datos Repetidos!.', 'El Numero de documento debe ser único!', {timeOut:3000});
        }else{
          if(jqXHR.status==423){
            toastr.warning('Datos Repetidos!.', 'El correo debe ser único!', {timeOut:3000});
          }
        }
      }
   }).fail(function(jqXHR, response){
        toastr.warning('Docente ya se encuentra registrado', 'Datos Duplicados!', {timeOut:3000});
        $('#formudatos')[0].reset();
	  });
  })
  
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] ,form input[type=date] , form input[type=email]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }

  //validar fecha
      /* Esperamos a la carga del DOM */
    window.addEventListener('DOMContentLoaded', (evento) => {
        /* Obtenemos la fecha de hoy en formato ISO */
        const hoy_fecha = new Date().toISOString().substring(0, 10);
        /* Buscamos la etiqueta, ya sea por ID (que no tiene) o por su selector */
        document.querySelector("input[name='fec_vinculacion']").max = hoy_fecha;
    });
</script>
@endsection