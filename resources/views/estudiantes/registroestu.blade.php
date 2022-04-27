@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Registro de Estudiantes</h3>
</div>
<form id="matricula" name="matricula">
 @csrf
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
            <label for="correo">Dpt. Expedición</label>
            <input type="text" class="form-control" id="depex" name="depex" required>
            </div>
          </div>
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="numero_doc">Mpio Expedición</label>
              <input type="text" class="form-control" id="mpioex" name="mpioex" required>
            </div>
            <div class="form-group col-md-4">
              <label for="genero">Genero</label>
                <select id="genero" class="form-control" name="genero" required>
                <option selected>Seleccionar</option>
                  @foreach($genero as $g)
                  <option value="{{$g->id}}">{{$g->descripcion}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fecnac" name="fecnac" required>
            </div>
          </div>
          <!---###############--->
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="numero_doc">Dpt. Nacimiento</label>
              <input type="text" class="form-control" id="dpt_nac" name="dpt_nac" required>
            </div>
            <div class="form-group col-md-6">
             <label for="numero_doc">Mpio. Nacimiento</label>
              <input type="text" class="form-control" id="mpio_nac" name="mpio_nac" required>
            </div>
          </div>
          <!---###############--->
          <div class="form-row">
          <div class="form-group col-md-3">
              <label for="apellido">Primer Apellido</label>
              <input type="text" class="form-control" id="firsape" name="firsape" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="secondape" name="secondape" onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Primer Nombre</label>
              <input type="text" class="form-control" id="firstname" name="firstname" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Nombre</label>
              <input type="text" class="form-control" id="secondname" name="secondname" onkeypress="return soloLetras(event)">
            </div>
          </div>
          <!---##################33-->
          <!---###############--->
          <div class="form-row">
          <div class="form-group col-md-3">
              <label for="apellido">Dtp. Residencia</label>
              <input type="text" class="form-control" id="dptres" name="dptres" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
              <label for="apellido">Mpio. Residencia</label>
              <input type="text" class="form-control" id="mpiores" name="mpiores" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Dir. Residencia</label>
              <input type="text" class="form-control" id="dirres" name="dirres" required>
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Barrio</label>
              <input type="text" class="form-control" id="barrio" name="barrio" required>
            </div>
          </div>
          <!---##################33-->
           <!---###############--->
           <div class="form-row">
          <div class="form-group col-md-4">
            <label for="genero">Zona</label>
                <select id="zona" class="form-control" name="zona" required>
                <option selected>Elegir ...</option>
                  <option value="Rural">Rural</option>
                  <option value="Urbana">Urbana</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="estrato">Estrato</label>
              <input type="number" class="form-control" id="estrato" name="estrato" required>
            </div>
            <div class="form-group col-md-4">
            <label for="genero">Tipo Sanguineo</label>
                <select id="sangre" class="form-control" name="sangre" required>
                <option selected>Elegir ...</option>
                  <option value="A+">A+</option>
                  <option value="B+">B+</option>
                  <option value="O+">O+</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="A-">A-</option>
                  <option value="O-">O-</option>
                  <option value="B-">B-</option>
                </select>
          </div>
          </div>
          <!---##################33-->
            <!---###############--->
            <div class="form-row">
            <div class="form-group col-md-6">
             <label for="telefono">Telefono</label>
             <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group col-md-6">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
          </div>
          <!--estado oculto por defecto habilitado-->
              <select id="estado" class="form-control" name="estado" hidden>
                @foreach($estado as $es)
                <option value="{{$es->id}}">{{$es->descripcion}}</option>
                @endforeach
              </select>
             
                <select id="usuario" class="form-control" name="usuario" hidden>
                  @foreach($user as $u)
                  <option value="{{$u->id}}">{{$u->name}}</option>
                  @endforeach
                </select>
          <!---##################33-->
          <!--end estado-->

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Sistema De Salud
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
         <!----##########################-->
         <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Regimen salud</label>
              <input type="text" class="form-control" id="regimen" name="regimen" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Carnet EPS</label>
            <input type="text" class="form-control" id="carnet" name="carnet" required>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Nivel Formación</label>
              <input type="text" class="form-control" id="nivelformacion" name="nivelformacion" required>
            </div>
            </div>
            <!---#####################--->
                 
            <div class="form-row">
            <div class="form-group col-md-4">
            <label for="correo">Ocupación</label>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Discapacidad</label>
            <input type="text" class="form-control" id="dicapacidad" name="discapacidad" required>
            </div>
            <div class="form-group col-md-4">
            <label for="etnia">Multiculturalidad</label>
                <select id="etnia" class="form-control" name="etnia" required> 
                @foreach($etnia as $e)
                  <option value="{{$e->id}}">{{$e->descripcion}}</option>
                  @endforeach
                </select>
             </div>

          </div>
          <!--################################3-->      
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
        <!----##########################-->
        <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Tipo Documento</label>
              <select id="tdocacu" name="tdocacu" class="form-control" required>
              <option selected>Seleccionar</option>
                @foreach($tipodoc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Número Documento</label>
              <input type="number" class="form-control" id="numdocacu" name="numdocacu" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Nombres y Apellidos</label>
            <input type="text" class="form-control" id="nombresacu" name="nombresacu" required>
            </div>
          </div>
          <!--################################3-->
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="etnia">Parentesco</label>
                <select id="parentesco" class="form-control" name="parentesco" required> 
                  @foreach($paren as $p)
                  <option value="{{$p->id}}">{{$p->descripcion}}</option>
                  @endforeach
                </select>
              </div>
           <div class="form-group col-md-4">
              <label for="tipodoc">Dir. Residencia</label>
              <input type="text" class="form-control" id="diracu" name="diracu" required>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Telefono/Celular</label>
              <input type="number" class="form-control" id="telacu" name="telacu" required>
            </div>
          </div>
          <!---###############################3-->
          <!-----etnia-->
       <!------##########################-->
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <!-----
      tipodoc 
    numero_doc 
    depex 
     mpioex 
     genero  
     fecnac 
     dpt_nac  
     mpio_nac  
     firsape 
     secondape
    firstname 
    secondname 
     dptres 
     mpiores 
     dirres 
     barrio
    zona
    estrato
    sangre 
    telefono 
    correo
     estado
    usuario
  --->

</div>
<button type="submit" class="btn btn-primary">Registrar</button>
<button type="button"  id="miboton" class="btn btn-success">Visualizar</button>
<button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
<a  class="btn btn-danger" href="{{url('/visualizar/estudiante')}}">Cancelar</a>
</form>
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

    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    console.log(formData);
    $.ajax({
      type: "POST",
      url:"{{route('datosestudiante')}}",
      data:formData,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
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