@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Registro de Estudiantes</h3>
</div>
<!--mensajes-->
@if(Session::has('msj'))
        <div class="alert alert-info alert-dismissible fade show alerta" role="alert">
            {{Session::get('msj')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
 @endif
 @if(Session::has('msjalert'))
        <div class="alert alert-success alert-dismissible fade show alerta" role="alert">
            {{Session::get('msjalert')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
 @endif
 <!--end mensajes-->
<form id="matricula" name="matricula">
 @csrf
<div class="accordion letraf" id="accordionExample">
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
              <input type="text" class="form-control" id="numero_doc" name="numero_doc"  minlength="5"  maxlength="12" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Dpt. Expedición</label>
            <input type="text" class="form-control" id="depex" name="depex" >
            </div>
          </div>
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="numero_doc">Mpio Expedición</label>
              <input type="text" class="form-control" id="mpioex" name="mpioex" >
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
              <input type="text" class="form-control" id="dpt_nac" name="dpt_nac" >
            </div>
            <div class="form-group col-md-6">
             <label for="numero_doc">Mpio. Nacimiento</label>
              <input type="text" class="form-control" id="mpio_nac" name="mpio_nac">
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
              <input type="text" class="form-control" id="dptres" name="dptres"  onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
              <label for="apellido">Mpio. Residencia</label>
              <input type="text" class="form-control" id="mpiores" name="mpiores"  onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Dir. Residencia</label>
              <input type="text" class="form-control" id="dirres" name="dirres" >
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Barrio</label>
              <input type="text" class="form-control" id="barrio" name="barrio" >
            </div>
          </div>
          <!---##################33-->
           <!---###############--->
           <div class="form-row">
          <div class="form-group col-md-4">
            <label for="genero">Zona</label>
                <select id="zona" class="form-control" name="zona" >
                <option selected>Elegir ...</option>
                  <option value="Rural">Rural</option>
                  <option value="Urbana">Urbana</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="estrato">Estrato</label>
              <input type="number" class="form-control" id="estrato" name="estrato" min="0" max="5" required>
            </div>
            <div class="form-group col-md-4">
            <label for="genero">Tipo Sanguineo</label>
                <select id="sangre" class="form-control" name="sangre" >
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
             <input type="text" class="form-control" id="telefono" name="telefono"  minlength="10"  maxlength="10" >
            </div>
            <div class="form-group col-md-6">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
          </div>
          <!---registrar usuario-->
            <div class="form-row">
              <div class="form-group col-md-6">
              <label for="email">Usuario</label>
              <input type="email" class="form-control" id="email" name="email"  required>
              </div>
              <div class="form-group col-md-6">
                <label for="correo">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
              </div>
            </div>
          <!---end user-->
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
              <input type="text" class="form-control" id="nivelformacion" name="nivelformacion" >
            </div>
            </div>
            <!---#####################--->
                 
            <div class="form-row">
            <div class="form-group col-md-4">
            <label for="correo">Ocupación</label>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion" >
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Discapacidad</label>
            <input type="text" class="form-control" id="dicapacidad" name="discapacidad" >
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
              <input type="text" class="form-control" id="numdocacu" name="numdocacu" minlength="5"  maxlength="12" required>
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
              <input type="text" class="form-control" id="telacu" name="telacu" minlength="10"  maxlength="10" required>
            </div>
          </div>
          <!---###############################3-->
          <!-----etnia-->
       <!------##########################-->
      </div>
    </div>
  </div>

</div>
<!--#####################################--->

<!--#######################################-->
<div class="container-fluid">

</div>
<a  class="btn btn-danger" href="{{url('/visualizar/estudiante')}}">Cancelar</a>
<button type="submit" class="btn btn-warning letraf"  onclick="resetform()">Limpiar</button>
<button type="submit" class="btn btn-primary letraf">Registrar</button>
<button type="button"  id="miboton" class="btn btn-success letraf">Visualizar</button>
<!--carga masiva-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carga">
          <i class="fas fa-users" style="font-size:20px;"></i>
        </button>
<!--carga-->
<!--carga masiva-->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#listadoar">
          <i class="fas fa-file-excel" style="font-size:20px;"></i>
        </button>
<!--carga-->
</form>
<!--Modal de visualizar--->
     <!-- Modal -->
     <form action="{{route('usuariosImport')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="carga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title letraf" id="exampleModalLabel">Carga Masiva De Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body letraform">
               <!--formulario-->
               <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="form-control" name="uploadedfile" id="uploadedfile" placeholder="elegir"  accept=".csv" required>
                        <br>
                    </div>
                 </div>
                 <div class="form-group">
                      <label for="nombre">Descripciòn</label>
                     <input type="text" name="nombre" id="nombre" class="form-control-file" required>
                </div>
               <!--formulario de carga-->
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
               <!--boton info-->
               <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Nota
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body" style="text-align:justify;">
                 1. Para descargar el archivo Excel del registro de solicitudes dirijase a Google Drive, las credenciales son: <br>
                    Correo: inesurpotosi2022@gmail.com<br>
                    Contraseña: potosi2022.*<br>
                 2. Una vez descargado el archivo convierta a CSV delimitado por comas. Asegurese que este delimitado por comas antes de subirlo.
                </div>
              </div>
               <!--end info-->
                <a href="/archivo/formato.xlsx" type="button" class="btn btn-success" download="formato_estudiantes">Formato Excel</a>
                <button type="submit" class="btn btn-info">Importar</button>
            </div>
            </div>
        </div>
        </div>
        </form>
<!-- Button trigger modal -->
     <!-- Modal -->
        <div class="modal fade" id="listadoar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title letraf" id="exampleModalLabel">Listado De Archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body letraform">
               <!--table-->
               <div class="table-responsive">
               <table class="table">
                <thead style="background-color: #ffc107;">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Archivo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $conta=1;
                    ?>
                    @if(isset($listado))
                    @foreach($listado as $p)
                      <tr>
                        <th scope="row">{{$conta++}}</th>
                        <td>{{$p->ruta}}</td>
                        <td>{{$p->descripcion}}</td>
                        <td><a href="{{route('cargausu', $p->id)}}" class="btn btn-success">Guardar</a>
                            <a href="{{route('eliminararchivo', $p->id)}}" class="btn btn-danger">Eliminar</a>
                        </td>
                      </tr>
                      @endforeach
                    @endif
                </tbody>
              </table>
               <!--end table-->
               </div>
               <!--table-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
        </div>
       
      <!--mensajes-->
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