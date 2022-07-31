<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('matricula_tecnico')->select('anio')->distinct()->get();
  $per = DB::table('matricula_tecnico')->select('periodo')->distinct()->get();
  $tecni = DB::table('programa_tecnico')->select('programa_tecnico.id', 'programa_tecnico.nombretec as nom')->get();

  
?>
<!-- Button trigger modal -->
<!-- Modal -->
<form action="{{route('tecnicoCalf')}}" method="POST">
 @csrf
<div class="modal fade" id="notasTec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <!--tecnicos-->
        <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Programa</label>
            <select class="form-control" id="tecnico" name="tecnico">
              @foreach($tecni as $t)
                @if(isset($t->id))
                  <option value="{{$t->id}}">{{$t->nom}}</option>
                @endif
              @endforeach
            </select>
          </div> 
        </div>
        </div>
        <!--end tecnicos-->
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
             @foreach($per as $p)
                @if(isset($p->periodo))
                  <option value="{{$p->periodo}}">{{$p->periodo}}</option>
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