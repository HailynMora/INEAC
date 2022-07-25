<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('asignaturas_tecnicos')->select('anio')->distinct()->get();
  $prog = DB::table('programa_tecnico')->select('nombretec', 'programa_tecnico.id as idtec')->distinct()->get();

  
?>
<!-- Button trigger modal -->
<!-- Modal -->
<form action="{{route('nivelTecnicosVer')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="tecnicoRec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <label for="exampleFormControlSelect1">Programa</label>
          <select class="form-control" id="programa" name="programa">
           @foreach($prog as $p)
            @if(isset($p->idtec))
             <option value="{{$p->idtec}}">{{$p->nombretec}}</option>
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
        <button type="submit" class="btn btn-primary">Ver</button>
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