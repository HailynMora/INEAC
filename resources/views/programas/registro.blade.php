@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Registro de Programas
</div>

<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Datos De Programa
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="forprogramas" name="forprogramas" method="POST">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="codigo">Codigo</label>
                  <input type="text" class="form-control" id="codigo" name="codigo" required>
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                  <label for="estado">Estado</label>
                  <select id="estado" class="form-control" name="estado" required>
                  <option selected>Seleccionar</option>
                  @foreach($estado as $d)
                  <option value="{{$d->id}}">{{$d->descripcion}}</option>
                  @endforeach
                  </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  $('#forprogramas').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    var codigo=$('#codigo').val();
    var estado=$('#estado').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regprogramas')}}",
      data:{
        nombre:nombre,
        codigo:codigo,
        estado:estado,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#forprogramas')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      }
    });
  })
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }
</script>

@endsection