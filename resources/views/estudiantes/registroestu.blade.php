@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Registro de Estudiantes</h3>
</div>
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <!---->
        <div class="row">
           <div class="col-md-10">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Datos Personales
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right" type="button" href="/visualizar/estudiante">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <form id="matricula" name="matricula">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control" id="apellido" name="apellido" required onkeypress="return soloLetras(event)">
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Tipo Documento</label>
              <select id="tipodoc" name="tipodoc" class="form-control" required>
              <option selected>Seleccionar</option>
                @foreach($tipodoc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Número Documento</label>
              <input type="number" class="form-control" id="numero_doc" name="numero_doc" required>
            </div>
            <div class="form-group col-md-4">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
          </div>
          <!--aqui esta estrato-->
          <div class="form-row">
          <div class="form-group col-md-4">
          <label for="telefono">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group col-md-4">
            <label for="estrato">Estrato</label>
              <input type="number" class="form-control" id="estrato" name="estrato" required>
            </div>
          </div>
          <!---->
          <div class="form-row">
            <!--------->
            <div class="form-group col-md-6">
            <label for="genero">Genero</label>
              <select id="genero" class="form-control" name="genero" required>
              <option selected>Seleccionar</option>
                @foreach($genero as $g)
                <option value="{{$g->id}}">{{$g->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <!---->
            <div class="form-group col-md-6">
            <label for="etnia">Tipo Etnia</label>
              <select id="etnia" class="form-control" name="etnia" required> 
              @foreach($etnia as $e)
                <option value="{{$e->id}}">{{$e->descripcion}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
            <label for="acudiente">Acudiente</label>
              <select id="acudiente" class="form-control" name="acudiente" required>
              <option selected>Seleccionar</option>
              @foreach($acu as $a)
                <option value="{{$a->id}}">{{$a->nombre}} {{$a->apellido}} C.C {{$a->num_doc}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
            <label for="certificado">Certificados</label>
              <select id="certificado" class="form-control" name="certificado" required> 
              @foreach($certificado as $cer)
                <option value="{{$cer->id}}">{{$cer->foto}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--estado certificados-->
          <div class="form-row">
            <!--------->
            <div class="form-group col-md-6">
            <label for="usuario">Usuario</label>
              <select id="usuario" class="form-control" name="usuario" required>
              <option selected>Seleccionar</option>
                @foreach($user as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
              </select>
            </div>
            <!---->
            <div class="form-group col-md-6">
            <label for="estado">Estado</label>
              <select id="estado" class="form-control" name="estado" required>
              <option selected>Seleccionar</option>
                @foreach($estado as $es)
                <option value="{{$es->id}}">{{$es->descripcion}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--end estado-->
          <button type="submit" class="btn btn-primary">Registrar</button>
          <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
          <button type="button"  id="miboton" class="btn btn-success">Visualizar</button>
          <a  class="btn btn-danger" href="{{url('/visualizar/estudiante')}}">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Salud
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Some placeholder content for the second accordion panel. This panel is hidden by default.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Acudiente
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">

</div>
<!--Modal de visualizar--->
<!-- Button trigger modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  /*FUNCION PARA VALIDAR QUE SOLO INGRESE LETRAS*/
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
  /*tomamos la información del formulario y la enviamos a la ruta y de la ruta al controlador*/
  $('#matricula').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    var apellido=$('#apellido').val();
    var direccion=$('#direccion').val();
    var telefono=$('#telefono').val();
    var tipodoc=$('#tipodoc').val();
    var numerodoc=$('#numero_doc').val();
    var correo=$('#correo').val();
    var estrato=$('#estrato').val();
    var etnia=$('#etnia').val();
    var genero=$('#genero').val();
    var acudiente=$('#acudiente').val();
    var estado=$('#estado').val();
    var certificado=$('#certificado').val();
    var usuario=$('#usuario').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url:"{{route('datosestudiante')}}",
      
      data:{
        nombre:nombre,
        apellido:apellido,
        direccion:direccion,
        telefono:telefono,
        genero:genero,
        tipodoc:tipodoc,
        numerodoc:numerodoc,
        correo:correo,
        estrato:estrato,
        etnia:etnia,
        acudiente:acudiente,
        estado:estado,
        certificado:certificado,
        usuario:usuario,
        _token:_token
      }, 
      success:function(response){
        if(response){
          $('#matricula')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
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
    });
  });
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] ,form input[type=date] , form input[type=email]").each(function() { this.value = '' });
     toastr.success('Campos Vacios', {timeOut:1000});
  }
 </script> 
 <script type="text/javascript">
    $(document).ready(function() {
        $('#miboton').click(function() {
          location.href ="{{route('listarestu')}}";
        });
    });
</script>
@endsection