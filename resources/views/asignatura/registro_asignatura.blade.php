@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Formulario Registro de Asignaturas
</div>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Asignaturas
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="formudatos" name="formudatos" method="post">
              @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" placeholder="12345678" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="intensidad_horaria">Intensidad Horaria</label>
                        <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" placeholder="12345678" required>
                    </div>
                  
                <div class="form-group col-md-6">
                    <label for="val_habilitacion">Valor Habilitación</label>
                    <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" placeholder="12345678">
                  </div>
                  <div class="form-group col-md-6" >
                  <label for="id_estado">Estado</label>
                  <select id="id_estado" class="form-control" name="id_estado" required>
                  <option selected>Seleccionar</option>
                  @foreach($estado as $es)
                  <option value="{{$es->id}}">{{$es->descripcion}}</option>
                  @endforeach
                  </select>
                  </div>
              </div>
                
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/asignatura/reporte_asignatura')}}">Cancelar</a>
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
    var codigo=$('#codigo').val();
    var nombre=$('#nombre').val();
    var intensidad_horaria=$('#intensidad_horaria').val();
    var val_habilitacion=$('#val_habilitacion').val();
    var id_estado=$('#id_estado').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('datosasig')}}",
      data:{
        codigo:codigo,
        nombre:nombre,
        intensidad_horaria:intensidad_horaria,
        val_habilitacion:val_habilitacion,
        id_estado:id_estado,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('Asignatura registrada exitosamente', 'Nuevo Registro', {timeOut:3000});
        }
      },
      error: function(response){
        toastr.warning('Datos Repetidos (Codigo y/o Nombre)',{timeOut:1000});
      }
    });
  })

  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number]").each(function() { this.value = '' });
  }
</script>
@endsection