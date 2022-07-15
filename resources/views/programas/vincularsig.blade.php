@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Vincular Asignatura a un Programa</h3>
</div>
<br><br>
<div class="accordion letraf" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <!---->
        <div class="row">
           <div class="col-md-10">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-edit"></i> Vincular Asignaturas a un Programa
              </button>
            </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right" type="button" href="/programas/reporte_programas">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="forvincular" name="forvincular" method="POST" >
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="curso">Programa</label>
                  <input type="text" class="form-control" id="curso" name="curso" required value="{{$curso->id}}" hidden>
                  <input type="text" style="background-color:white;" class="form-control" id="nomcurso" name="nomcurso" value="{{$curso->descripcion}}" disabled>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="asig">Asignatura</label>
                  <select id="asig" class="form-control" name="asig" required>
                    <option selected>Seleccionar</option>
                        @foreach($asignatura as $a)
                           <option value="{{$a->id}}">{{$a->nombre}}</option>
                        @endforeach
                  </select>
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="docente">Docente</label>
                    <select id="docente" class="form-control" name="docente" required>
                    <option selected>Seleccionar</option>
                        @foreach($docente as $d)
                           <option value="{{$d->id}}">{{$d->nombre}} {{$d->apellido}}</option>
                        @endforeach
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="docente">Año</label>
                    <input type="text" style="background-color:white;" class="form-control" id="anio" name="anio" value="{{$date}}" disabled>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="docente">Periodo</label>
                    <select id="periodo"  class="form-control" name="periodo" required>
                           <option selected>Seleccionar</option>
                           <option value="A">A</option>
                           <option value="B">B</option>
                  </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalListar">
                  Listar
                </button>
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas')}}">Cancelar</a>

              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>
  <!--modal listar-->
  <form action="{{route('listado_asig')}}" method="POST">
    @csrf
  <div class="modal fade" id="modalListar" tabindex="-1" aria-labelledby="modalListarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalListarLabel">Ingrese Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--formulario-->
        <div class="form-group">
          <label for="anio">Año</label>
          <input type="text" class="form-control" id="anio" name="anio" placeholder="Ejm. 2022" required>
        </div>
        <div class="form-group">
          <label for="periodo">Periodo</label>
          <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Ejm. A" required>
        </div>
        <input type="text" class="form-control" id="cursoid" name="cursoid" required value="{{$curso->id}}" hidden>
        <!--end formulario-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Ver</button>
      </div>
    </div>
  </div>
</div>
</form>
  <!--end modal-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  $('#forvincular').submit(function(e){
    e.preventDefault();
    var curso=$('#curso').val();
    var asig=$('#asig').val();
    var docente=$('#docente').val();
    var fecha=$('#fecha').val();
    var anio=$('#anio').val();
    var periodo=$('#periodo').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regvincularasig')}}",
      data:{
        curso:curso,
        asig:asig,
        fecha:fecha,
        docente:docente,
        anio:anio,
        periodo:periodo,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#forvincular')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      },
      error:function(jqXHR, response){
          if(jqXHR.status==422){
            toastr.warning('Datos Repetidos!.', 'Asignatura ya esta vinculada!', {timeOut:3000});
          }
          }
    });
  })
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=date]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }
</script>

@endsection