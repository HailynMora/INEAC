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
    <div class="modal-content" style="background-color: #F1F1F1;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Periodo académico</h5>
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
        <!--collapsed-->
        <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseOne">
                <i class="fas fa-info-circle" style="font-size:24px; color:blue;"></i> Información
              </button>
            </h2>
          </div>

          <div id="info" class="collapse hidden" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body alert alert-primary" >
              <p>Si el año o curso no estan disponibles en el formulario,<br> se debe a que aun falta registrar programas y vincular<br> asignaturas.<br>
              <a href="/programas/reporte_programas_tecnicos" style="color:black;"><b>ir al registro</b></a>
             </p>
            </div>
          </div>
        </div>
      </div>
        <!-- end per acdemico-->
      </div>
      <div class="modal-footer">
        <input val="2" name="val" id="val" hidden>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Visualizar</button>
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