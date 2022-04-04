@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
 Actualizar Perfil Profesional
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="location.reload()">Perfil</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Actualizar</a>
    
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <br>
    <div id="table_cargar">
    <form>
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-12">

                  <div class="alert" role="alert" style="background-color:#8EEDF3;">
                        <h4 class="alert-heading">Nivel de Estudios</h4>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>
                        {{$perfil[0]->nivel_estudios}}
                        </p>    
                    </div>   
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-6">

                    <div class="alert" role="alert" style="background-color:#8EEDF3;">
                        <h4 class="alert-heading">Descripción</h4>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>
                        {{$perfil[0]->descripcion}}
                        </p>    
                    </div>                  
                  </div>
                  <div class="form-group col-md-6">
                  <div class="alert " role="alert" style="background-color:#8EEDF3;">
                        <h4 class="alert-heading">Cursos Realizados</h4>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>
                        {{$perfil[0]->cursos_realizados}}
                        </p>    
                    </div>    
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                <div class="alert" role="alert" style="background-color:#8EEDF3;">
                        <h4 class="alert-heading">Intereses</h4>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>
                        {{$perfil[0]->intereses}}
                        </p>    
                    </div>                  
                  </div>
                  <div class="form-group col-md-6">

                  <div class="alert" role="alert" style="background-color:#8EEDF3;">
                        <h4 class="alert-heading">Experiencia</h4>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>
                        {{$perfil[0]->Experiencia}}
                        </p>    
                    </div>                     
                  </div>
                </div>
               
              </form>
          </div>

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

    <br>
    <div id="table_refresh">
    <form id="actuperfil" name="actuperfil" method="POST">
              @csrf
                
              <div class="form-row">
                  <div class="form-group col-md-12">
                  <label for="nivel">Nivel de Estudios</label>
                  <input type="text" class="form-control" id="nivel" name="nivel"  value="{{$perfil[0]->nivel_estudios}}" required>
                  <input type="text" class="form-control" id="iden" name="iden"  value="{{$perfil[0]->id}}" hidden> 
                  </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="descripcion">Descripción</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required> {{$perfil[0]->descripcion}} </textarea>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="cur">Cursos Realizados</label>
                  <textarea class="form-control" id="cur" name="cur" rows="2" required>{{$perfil[0]->cursos_realizados}}</textarea>
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inter">Intereses</label>
                  <textarea class="form-control" id="inter" rows="2" name="inter" required> {{$perfil[0]->intereses}}</textarea>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="exp">Experiencia</label>
                  <textarea class="form-control" id="exp" name="exp" rows="2" required>{{$perfil[0]->Experiencia}}</textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Guardar Cambios
                </button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
              </form>
         </div>
  </div>
  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  /*tomamos la información del formulario y la enviamos a la ruta y de la ruta al controlador*/
  $('#actuperfil').submit(function(e){
    e.preventDefault();
    var iden=$('#iden').val();
    var nivel=$('#nivel').val();
    var des=$('#descripcion').val();
    var cur=$('#cur').val();
    var inter=$('#inter').val();
    var exp=$('#exp').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url:"{{route('actuperfiluser')}}",
      
      data:{
        iden:iden,
        nivel:nivel,
        des:des,
        cur:cur,
        inter:inter,
        exp:exp,
        _token:_token
      }, 
      success:function(response){
        if(response){
          $('#actuperfil')[0].reset();
         // $("#table_refresh").load("#table_refresh");
          
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
          
          
        }
      },
      error:function(response){
          toastr.warning('Datos vacios!.', 'Ingrese Datos', {timeOut:3000});
      }
    });
  });
 </script> 
 <script type="text/javascript">
    $(document).ready(function() {
        $('#miboton').click(function() {
          location.reload();
        });
    });
</script>

@endsection