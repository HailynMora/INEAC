@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1">Registar Perfil Profesional</h3>
</div>

<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h6 class="mb-0">
          <div class="row">
            <div class="col-6">
              <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <i class="fas fa-file-alt"></i>&nbsp;Datos De Perfil
              </button>
            </div>
            <div class="col-6 text-right alerta" style="padding-top:10px;">
             <a href="{{route('actuperfil')}}"><i class="fas fa-edit"></i>&nbsp;Actualizar</a>
            </div>
          </div>
        </h6>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body letraf">
            <form  action="{{route('regperfil')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                   <label for="nivel">Subir Foto</label>
                  <input type="file" class="form-control" id="foto" name="foto" required>
                  </div>
                  <div class="form-group col-md-6">
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
                <a  class="btn btn-danger" href="{{url('/')}}">Cancelar</a>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <button type="submit" class="btn btn-success">Registrar</button>
              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  /*$('#forprogramas').submit(function(e){
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
  })*/
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }
</script>


@endsection