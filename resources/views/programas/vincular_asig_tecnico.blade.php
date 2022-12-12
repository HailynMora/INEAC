@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:white;">
 <h3 class="letra1">Vincular Asignatura A Un Programa Técnico</h3>
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
                  <i class="fas fa-edit"></i> Vincular Asignaturas a un Programa Técnico 
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
                    <option value="0" selected>Seleccionar</option> 
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                  </select>
                  </div>          
                </div>
                <!---end periodo y anio--->
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas_tecnicos')}}">Cancelar</a>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                  Listar
                </button>
              </form>
              <br>
             
        </div>
      </div>
    </div>
  </div>

  <!--########################modal--->

  <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="color:black;">
        <div class="modal-title alert text-center" role="alert">
          <h3 class="letra1"> Asignaturas Vinculadas a Programas Técnicos</h3>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <!---###################-->
        <div class="container">
            <table class="table">
                <thead style="background-color:#0f468e; color:white;" class="alerta">
                    <tr>
                    <th scope="col">Año</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Cód. Programa</th>
                    <th scope="col">Programa</th>
                    <th scope="col">Trimestre</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">I/Horaria</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody class="letraf">
                
                @foreach($asigpro as $s)
                <tr style="background-color:#E3E3E3;;">
                    <td>{{$s->anio}}</td>
                    <td>{{$s->periodo}}</td>
                    <td>{{$s->codigotec}}</td>
                    <td>{{$s->nombretec}}</td>
                    <td>{{$s->nombretri}}</td>
                    <td>{{$s->asig}}</td>
                    <td>{{$s->horas}}</td>
                    <td>{{$s->nomdoc}} {{$s->apedoc}}</td>            
                    <td>
                        &nbsp&nbsp
                        <a type="button" data-toggle="modal" data-target="#eliminarAsig{{$s->id}}" data-placement="bottom"  title="Eliminar"><i class="nav-icon fas fa-trash" style="color: red;"></i></a>
                        <!---##############-->

                        <!-- Button trigger modal -->
                              <!-- Modal -->
                              <div class="modal fade" id="eliminarAsig{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#FFC107;">
                                      <h5 class="modal-title letra1" id="exampleModalLabel">Eliminar asignatura vinculada</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body alerta">
                                      ¿Desea eliminar la materia Vinculada de forma permanente?
                
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                      <a type="submit" href="{{route('elimasig', $s->id)}}" class="btn btn-primary">Si</a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                        <!---#############-->

                    </td>
                </tr>
                    <!-- Ventana modal para eliminar -->
                    
                    <!---fin ventana eliminar--->
                @endforeach
                
                </tbody>
            </table>
        </div>
      
     <!---####################--->   
      </div>
      <div class="modal-footer alerta">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

  <!----#######################end modal---->


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