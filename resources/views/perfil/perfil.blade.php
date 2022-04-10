@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
 Ingresar Perfil Profesional
</div>

<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Datos De Perfil
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="forprogramas" name="forprogramas" method="POST">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-12">
                  <label for="nivel">Nivel de Estudios</label>
                  <input type="text" class="form-control" id="nivel" name="nivel" required>
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="nombre">Descripción</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required></textarea>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="cur">Cursos Realizados</label>
                  <textarea class="form-control" id="cur" name="cur" rows="2" required></textarea>
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inter">Intereses</label>
                  <textarea class="form-control" id="inter" rows="2" name="inter" required></textarea>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="exp">Experiencia</label>
                  <textarea class="form-control" id="exp" name="exp" rows="2" required></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/')}}">Cancelar</a>
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
    var nivel=$('#nivel').val();
    var descripcion=$('#descripcion').val();
    var cur=$('#cur').val();
    var inter=$('#inter').val();
    var exp=$('#exp').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regperfil')}}",
      data:{
        nivel:nivel,
        descripcion:descripcion,
        cur:cur,
        inter:inter,
        exp:exp,
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