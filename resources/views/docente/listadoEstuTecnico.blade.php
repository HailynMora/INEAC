<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('asignaturas_tecnicos')->select('anio')->distinct()->get();
  $curso =DB::table('programa_tecnico')->select('programa_tecnico.nombretec', 'programa_tecnico.id as idtec')->get();
  $tri =DB::table('trimestre_tecnicos')->get();
?>
<form action="{{route('listaEsTecnicos')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="listaTec" tabindex="-1" aria-labelledby="exampleModalListaBLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalListaBLabel">Periodo Académico</h5>
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
                    @if(isset($cur->idtec))
                    <option value="{{$cur->idtec}}">{{$cur->nombretec}}</option>
                    @endif
                @endforeach
                </select>
            </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="exampleFormControlSelect1">Trimestre</label>
                <select class="form-control" id="trim" name="trim">
                @foreach($tri as $t)
                    @if(isset($t->id))
                    <option value="{{$t->id}}">{{$t->nombretri}}</option>
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
             <option value="C">C</option>
             <option value="D">D</option>
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