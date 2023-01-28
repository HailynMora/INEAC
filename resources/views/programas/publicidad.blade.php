<?php
use App\Models\Archivo;
use Illuminate\Support\Facades\DB;

    $pub =  DB::table('publicidad')->count();
    if($pub!=0){
      $estado = DB::table('publicidad')->where('estado', '=', 1)->count();
    } 

?>
@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Agregar publicidad a los programas</h3>
</div>
<br>
<div class="container letraf">
  <div class="card">
  <div class="card-header">
  @if(Session::has('mensajepub'))
        <br>
        <div class="alert alert-info alert-dismissible fade show alerta" role="alert">
        <strong >{{Session::get('mensajepub')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div><br>
  @endif
  </div>
  <div class="card-body">
        <form action="{{route('publicidadg')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Subir Imagen</label>
            <input type="file" class="form-control" id="img" name="img" aria-describedby="emailHelp" accept="image/*" required>
            <small id="emailHelp" class="form-text text-muted">Agrege una archivo de tipo imagen.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Descripción</label>
            <input type="text" class="form-control" id="info" name="info" required>
        </div>
        <!--radius-->
        <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="val" id="val1" value="1" checked>
            <label class="form-check-label" for="val1">
            Bachillerato
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="val" id="val2" value="2">
            <label class="form-check-label" for="val2">
                Técnicos
            </label>
            </div>
            </div>
        <!--end--radius-->
        <div class="modal-footer">
         @if(isset($estado))
            @if($estado != 0)
                <button  type="button" class="btn btn-warning" data-toggle="modal" data-target="#estadopub" style="color:black;">
                Desactivar
                </button>
            @endif
            @if($estado == 0)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estadopub" style="color:white;">
                 Activar
               </button>
            @endif
         @endif
         <button type="submit" class="btn btn-success">Guardar</button>
        </div>
        </form>
        <!--boton de cambiar el estado-->
        <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="estadopub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Desea cambiar el estado de la publicidad en la página de inicio del aplicativo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="color:white;">Salir</button>
                        <!--botones-->
                        @if(isset($estado))
                            @if($estado != 0)
                             <a href="{{route('cambiarpub',2)}}" type="button" class="btn btn-success" style="color:white;">Guardar</a>
                            @endif
                            @if($estado == 0)
                            <a href="{{route('cambiarpub',1)}}" type="button" class="btn btn-success" style="color:white;">Guardar</a>
                            @endif
                        @endif
                        <!--end botones-->
                    </div>
                    </div>
                </div>
                </div>
        <!-- end estado-->
  </div>
</div>
</div>
@endsection