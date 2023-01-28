@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:white;">
 <h3 class="letra1">Vincular asignaturas a un programa técnico</h3>
</div>
<div>
</div>          
<br>
<!---############################33-->
@if(Session::has('mensaje'))
        <br>
        <div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
        <strong >{{Session::get('mensaje')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
  @endif
  @if(Session::has('mensajeconf'))
        <br>
        <div class="alert alert-info alert-dismissible fade show alerta" role="alert">
        <strong >{{Session::get('mensajeconf')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
  @endif
<!----############################-->
<br>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <!---->
        <div class="row">
           <div class="col-md-10">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Vincular asignaturas 
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right alerta" type="button" href="/programas/reporte_programas_tecnicos">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body letraf">
            <form action="{{route('regvincularasigtec')}}" id="forvincular" name="forvincular" method="POST" >
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="curso">Programa</label>
                  <input type="text" class="form-control" id="curso" name="curso" required value="{{$curso->id}}" hidden>
                  <input type="text" class="form-control" id="nomcurso" name="nomcurso" required value="{{$curso->nombretec}}" disabled>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="asig">Asignatura</label>
                  <select id="asig" class="form-control" name="asig" required>
                    <option value="0" selected>Seleccionar</option>
                        @foreach($asignatura as $a)
                           <option value="{{$a->id}}">{{$a->nombreasig}}</option>
                        @endforeach
                  </select>
                  </div> 
                 
              </div>
                <div class="form-row"> 
                <div class="form-group col-md-6">
                  <label for="docente">Docente</label>
                  <select id="docente" class="form-control" name="docente" required>
                    <option value="0" selected>Seleccionar</option>
                        @foreach($docente as $d)
                           <option value="{{$d->id}}">{{$d->nombre}} {{$d->apellido}}</option>
                        @endforeach
                  </select>
                  </div>  
                <div class="form-group col-md-6">
                  <label for="tri">Trimestre</label>
                  <select id="tri" class="form-control" name="tri" required>
                    <option value="0" selected>Seleccionar</option>
                        @foreach($trimestre as $t)
                           <option value="{{$t->id}}">{{$t->nombretri}}</option>
                        @endforeach
                  </select>
                  </div>           
                </div>
                <!--periodo y anio-->
                <div class="form-row"> 
                <div class="form-group col-md-6">
                  <label for="docente">Año</label>
                    <input class="form-control" name="anio" id="anio" value="{{$date}}">
                  </div>  
                <div class="form-group col-md-6">
                  <label for="periodo">Periodo</label>
                  <select id="periodo" class="form-control" name="periodo" required>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                  </select>
                  </div>          
                </div>
                <!---end periodo y anio--->
                <div class="modal-footer">
                    <a  class="btn btn-danger" href="{{url('/programas/reporte_programas_tecnicos')}}">Salir</a>
                    <button type="button" class="btn btn-info" Onclick="resetform();" >Limpiar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
               </div>
              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=date]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }
  function refrescar(){
    //Actualiza la página
    location.reload();
  }

</script>

@endsection