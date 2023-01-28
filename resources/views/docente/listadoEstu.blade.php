<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('cursos')->select('anio')->distinct()->get();
  $curso =DB::table('tipo_curso')->select('tipo_curso.descripcion', 'tipo_curso.id as id')->get();
  
?>
<!-- Button trigger modal -->
<!-- Modal -->
<form action="{{route('listarestudo')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="exampleModalListaB" tabindex="-1" aria-labelledby="exampleModalListaBLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #F1F1F1;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalListaBLabel">Periodo académico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--periodo academico-->
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="exampleFormControlSelect1">Curso</label>
                <select class="form-control" id="cursoba" name="cursoba">
                @foreach($curso as $cur)
                    @if(isset($cur->id))
                    <option value="{{$cur->id}}">{{$cur->descripcion}}</option>
                    @endif
                @endforeach
                </select>
            </div> 
            </div>
        </div>
        <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Año</label>
            <select class="form-control" id="anio" name="anio">
              @foreach($anio as $a)
                @if(isset($a->anio))
                  <option value="{{$a->anio}}">{{$a->anio}}</option>
                @endif
              @endforeach
            </select>
          </div> 
        </div>
        <div class="col-6">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Periodo</label>
          <select class="form-control" id="periodo" name="periodo">
             <option value="A">A</option>
             <option value="B">B</option>
          </select>
        </div>
       </div>
       </div>
        <!-- end per acdemico-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success">Visualizar</button>
      </div>
    </div>
  </div>
</div>
</form>
<style>
  .modal-backdrop {
  z-index: -1;
  }
</style>