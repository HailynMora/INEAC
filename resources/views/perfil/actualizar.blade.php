@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
 Actualizar Perfil Profesional 
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Perfil</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Actualizar</a>
    
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <br>
    <div id="table_cargar">
    @if($b==1)
    <form id="ocultar">
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
              <div id="respuesta"></div>
              @endif
              @if($b==0)
              <div class="alert alert-success" role="alert">
                No hay Información Disponible! Registra tu perfil
              </div>
              @endif
          </div>

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

    <br>
    <div id="table_refresh">
    @if($b==1)
    <form id="actuperfil" action="{{route('actuperfiluser')}}" method="POST" enctype='multipart/form-data'>
              @csrf 
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nivel">Nivel de Estudios</label>
                    <input type="text" class="form-control" id="nivel" name="nivel"  value="{{$perfil[0]->nivel_estudios}}" required>
                    <input type="text" class="form-control" id="iden" name="iden"  value="{{$perfil[0]->id}}" hidden> 
                </div>
                <div class="form-group col-md-6">
                  <label for="img">Foto</label>
                  <input type="file" class="form-control" id="img" name="img">
                </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="descripcion">Descripción</label>
                  <input class="form-control" id="des" name="des" rows="2" value="{{$perfil[0]->descripcion}}">  
                  </div>
                  <div class="form-group col-md-6">
                  <label for="cur">Cursos Realizados</label>
                  <input class="form-control" id="cur" name="cur" rows="2" value="{{$perfil[0]->cursos_realizados}}">
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inter">Intereses</label>
                  <input class="form-control" id="inter" rows="2" name="inter" value="{{$perfil[0]->intereses}}"> 
                  </div>
                  <div class="form-group col-md-6">
                  <label for="exp">Experiencia</label>
                  <input class="form-control" id="exp" name="exp" rows="2" value="{{$perfil[0]->Experiencia}}">
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Guardar Cambios
                </button>
              </form>
              @endif
              <div id="nuevoactu"></div>
              @if($b==0)
              <div class="alert alert-success" role="alert">
                No hay Información Disponible! Registra tu perfil
              </div>
              @endif
         </div>
  </div>
  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

 <script type="text/javascript">
    $(document).ready(function() {
        $('#miboton').click(function() {
          location.reload();
        });
    });
</script>

@endsection