@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Registro de Estudiantes
</div>
<form id="matricula" name="matricula">
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
      <input type="text" class="form-control" id="numero_doc" name="numero_doc" required>
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
  <button type="button" id="miboton" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
  Visualizar
</button>
</form>
<!--Modal de visualizar--->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Estudiantes Registrados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Tabla de informacion-->
        <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Dirección</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Estrato</th>
        <th scope="col">Etnia</th>
        <th scope="col">Genero</th>
        <th scope="col">Tipo Doc</th>
        <th scope="col">Número</th>
        <th scope="col">Acudiente</th>
        <th scope="col">Usuario</th>
        <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
    @if($b == 1)
      @foreach($estudiante as $d)
        <tr>
        <td>{{$d->nombre}}</td>
        <td>{{$d->apellido}}</td>
        <td>{{$d->direccion}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->correo}}</td>
        <td>{{$d->estrato}}</td>
        <td>{{$d->id_etnia}}</td>
        <td>{{$d->id_genero}}</td>
        <td>{{$d->id_tipo_doc}}</td>
        <td>{{$d->num_doc}}</td>
        <td>{{$d->id_acudiente}}</td>
        <td>{{$d->id_usuario}}</td>
        <td>{{$d->id_estado}}</td>
        </tr>
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
               No Hay Registros
            </div>
        @endif
    </tbody>
    </table>
        <!--finalizar Tabla de informacion-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!--End modal visualizar-->
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
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
      }
    });
  });
 </script> 
 <script type="text/javascript">
    $(document).ready(function() {
        $('#miboton').click(function() {
            // Recargo la página
            location.reload();
        });
    });
</script>
@endsection