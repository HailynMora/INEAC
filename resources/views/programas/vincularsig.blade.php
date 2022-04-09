@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Vincular Asignatura a un Programa</h3>
</div>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Vincular Asignaturas a un Programa
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="forvincular" name="forvincular" method="POST">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="curso">Programa</label>
                  <select id="curso" class="form-control" name="curso" required>
                    <option selected>Seleccionar</option>
                        @foreach($curso as $c)
                           <option value="{{$c->id}}">{{$c->descripcion}}</option>
                        @endforeach
                  </select>
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
                  <div class="form-group col-md-12">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas')}}">Cancelar</a>

              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  $('#forvincular').submit(function(e){
    e.preventDefault();
    var curso=$('#curso').val();
    var asig=$('#asig').val();
    var fecha=$('#fecha').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regvincularasig')}}",
      data:{
        curso:curso,
        asig:asig,
        fecha:fecha,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#forvincular')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
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