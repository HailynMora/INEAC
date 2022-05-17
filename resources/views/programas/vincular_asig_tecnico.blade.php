@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Vincular Asignatura a un Programa Técnico</h3>
</div>
<div>
</div>          
<br>
<!---############################33-->
@if(Session::has('mensaje'))
        <br>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{Session::get('mensaje')}}</strong> 
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
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Vincular Asignaturas a un Programa Técnico 
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right" type="button" href="/programas/reporte_programas_tecnicos">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form id="forvincular" name="forvincular" method="POST" >
              @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="curso">Programa</label>
                  <input type="text" class="form-control" id="curso" name="curso" required value="{{$curso->id}}" hidden>
                  <input type="text" class="form-control" id="nomcurso" name="nomcurso" required value="{{$curso->nombretec}}" disabled>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="tri">Trimestre</label>
                  <select id="tri" class="form-control" name="tri" required>
                    <option selected>Seleccionar</option>
                        @foreach($trimestre as $t)
                           <option value="{{$t->id}}">{{$t->nombretri}}</option>
                        @endforeach
                  </select>
                  </div>
              </div>
                <div class="form-row"> 
                <div class="form-group col-md-6">
                  <label for="asig">Asignatura</label>
                  <select id="asig" class="form-control" name="asig" required>
                    <option selected>Seleccionar</option>
                        @foreach($asignatura as $a)
                           <option value="{{$a->id}}">{{$a->nombreasig}}</option>
                        @endforeach
                  </select>
                  </div> 
                  <div class="form-group col-md-6">
                  <label for="docente">Docente</label>
                  <select id="docente" class="form-control" name="docente" required>
                    <option selected>Seleccionar</option>
                        @foreach($docente as $d)
                           <option value="{{$d->id}}">{{$d->nombre}} {{$d->apellido}}</option>
                        @endforeach
                  </select>
                  </div>                
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning" Onclick="resetform();" >Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas_tecnicos')}}">Cancelar</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
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
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title alert text-center" role="alert" style="color:black;">
          <h3> Asignaturas Vinculadas a Programas Técnicos</h3>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <!---###################-->
        <div class="container">
            <table class="table">
                <thead style="background-color:#FFCC00;">
                    <tr>
                    <th scope="col">Cód. Programa</th>
                    <th scope="col">Programa</th>
                    <th scope="col">Trimestre</th>
                    <th scope="col">Cód. Asignatura</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                
                @foreach($asigpro as $s)
                <tr style="background-color: #dcedc8;">
                    <td>{{$s->codigotec}}</td>
                    <td>{{$s->nombretec}}</td>
                    <td>{{$s->nombretri}}</td>
                    <td>{{$s->codas}}</td>
                    <td>{{$s->asig}}</td>
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
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Eliminar asignatura vinculada</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      ¿Desea elimar la materia Vinculada de forma permanente?
                
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
            {{$asigpro->links()}}
        </div>
      
     <!---####################--->   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

  <!----#######################end modal---->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
  $('#forvincular').submit(function(e){
    e.preventDefault();
    var curso=$('#curso').val();
    var asig=$('#asig').val();
    var tri=$('#tri').val();
    var docente=$('#docente').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regvincularasigtec')}}",
      data:{
        curso:curso,
        asig:asig,
        tri:tri,
        docente:docente,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#forvincular')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
          setTimeout(refrescar, 1500);
        }
      },
      error:function(jqXHR, response){
          if(jqXHR.status==422){
            toastr.warning('Datos Repetidos!.', 'Asignatura ya esta vinculada!', {timeOut:3000});
          }
          }
    });
  })
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