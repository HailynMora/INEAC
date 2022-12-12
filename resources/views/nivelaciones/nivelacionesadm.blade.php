<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('cursos')->select('anio')->distinct()->get();
  $curso =DB::table('tipo_curso')->select('descripcion', 'tipo_curso.id as idcur')->get();
  
?>
<!-- Button trigger modal -->
<!-- Modal -->
<form action="{{route('nivelacionEstudiante')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="exampleModalnotas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
           @foreach($curso as $c)
            @if(isset($c->idcur))
             <option value="{{$c->idcur}}">{{$c->descripcion}}</option>
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
                Nota
              </button>
            </h2>
          </div>

          <div id="info" class="collapse hidden" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body alert alert-primary" >
              <p>Si el año o curso no estan disponibles en el formulario,<br> se debe a que aun falta registrar cursos y vincular asignaturas.<br>
              <a href="/programas/reporte_programas" style="color:black;"><b>ir al registro</b></a>
             </p>
            </div>
          </div>
        </div>
      </div>
        <!-- end per acdemico-->
      </div>
      <div class="modal-footer">
        <input value="1" name="val" id="val" hidden>
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