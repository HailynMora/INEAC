<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('cursos')->select('anio')->distinct()->get();
  $cur = DB::table('tipo_curso')->select('descripcion', 'tipo_curso.id as idcur')->get();
  
?>
<!-- Button trigger modal -->
<!-- Modal -->
<form action="{{route('nivelacionEstudiantedoc')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="exampleModalnive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Periodo Académico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--periodo academico-->
        <div class="row">
        <div class="col-4">
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
        <div class="col-4">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Periodo</label>
          <select class="form-control" id="periodo" name="periodo">
             <option value="A">A</option>
             <option value="B">B</option>
          </select>
        </div>
       </div>
       <div class="col-4">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Programa</label>
          <select class="form-control" id="programa" name="programa">
            @foreach($cur as $c)
             @if(isset($c->idcur))
             <option value="{{$c->idcur}}">{{$c->descripcion}}</option>
             @endif
            @endforeach
          </select>
        </div>
       </div>
       </div>
        <!-- end per acdemico-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Generar</button>
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