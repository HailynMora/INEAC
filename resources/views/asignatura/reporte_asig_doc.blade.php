@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Reporte asignaturas técnicos</h3>
</div>
<!--collapsed-->
@if(!isset($repe[0]->anio))
<div class="alert alert-info alert-dismissible fade show" role="alert">
            Lo sentimos! No se encontró información para la solicitud.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
 </div>
 <br>
@endif
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <div class="row">
        <div class="col-md-6">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTec">
            <i class="fas fa-filter"></i>
          </button>
          <!-- Button trigger modal -->
          <!-- Modal -->
          <form action="{{route('filasig_tecnico')}}" method="POST">
          @csrf
            <div class="modal fade" id="exampleModalTec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" style="background-color: #F1F1F1;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtro de asignaturas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--formulario-->
                    <div class="row">
                      <div class="col-4">
                        <input type="text" name="anio" class="form-control" placeholder="Año ejm. 2022"  aria-describedby="addon-wrapping" required>
                      </div>
                      <div class="col-4">
                         <select id="periodo" class="form-control" aria-describedby="addon-wrapping" name="periodo">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                         </select>
                      </div>
                      <div class="col-4">
                        <!--trimestre-->
                        <select class="form-control" id="trimestre"  name="trimestre">
                          <option value="Trimestre I">Trimestre I</option>
                          <option value="Trimestre II">Trimestre II</option>
                          <option value="Trimestre III">Trimestre III</option>
                          <option value="Trimestre IV">Trimestre IV</option>
                          <option value="Trimestre V">Trimestre V</option>
                          <option value="Trimestre VI">Trimestre VI</option>
                        </select>
                        <!--trimestre-->
                      </div>
                    </div>
                    <!--end filtrar-->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <a href="/asignatura/reporte" type="button" class="btn btn-info">Deshacer</a>
                    <button type="submit" class="btn btn-success">Filtrar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!--end modal-->
        </div>
        <div class="col-md-6">
        </div>
      </div>
    </div>
    <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <!--table-->
        <div class="container">
          <table class="table">
            <thead style="background-color:#0f468e; color: #ffffff;" class="alerta">
              <tr>
                <th scope="col">Año</th>
                <th scope="col">Trimestre</th>
                <th scope="col">Programa</th>
                <th scope="col">Código</th>
                <th scope="col">Asignatura</th>
                <th scope="col">I/Horaria</th>
                <th scope="col">Val. Habilitación</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody id="tabla1" style="background-color:#e3e3e3;" class="letraf">
              @foreach($repe as $d) <!--idtec nombretec codigotec estades idasig nombreasig horas trimestre--> 
              <tr style="background-color: #dcedc8;">
                <td>{{$d->anio}} - {{$d->periodo}}</td>
                <td>{{$d->trimestre}}</td>
                <td>{{$d->nombretec}}</td>
                <td>{{$d->codigoasig}}</td>
                <td>{{$d->asig}}</td>
                <td>{{$d->intensidad_horaria}}</td>
                <td>{{$d->val_habilitacion}}</td>
                <td>
                  <!-- Button trigger modal -->
                  <a type="button"  data-toggle="modal" data-target="#staticBackdrop{{$d->idasig}}" title="Registrar Objetivos">
                    <i class="fas fa-book-open" style="color:#215EBB; font-size:22px;"></i>&nbsp;
                  </a>
                  <a type="button" data-toggle="modal" data-target="#listaModalT{{$d->idasig}}" title="Lista de Objetivos">
                    <i class="fas fa-list-alt" style="color:#FFC107; font-size:22px;"></i>&nbsp;
                  </a>
                  <!-- vemtana de registrar notas -->
                  <a href="/registro/notas/tecnico/{{$d->idtec}}/{{$d->anio}}/{{$d->periodo}}/{{$d->idasig}}/{{$d->idtri}}" title="Ingresar notas" style="color: #678a3f;">
                    <i class="fas fa-sticky-note" style="color:#219F9C; font-size:22px;"></i>
                  </a>
                  <!-- Modal -->
                  <!-- Modal -->
                  <form action="{{route('regobjettec')}}"  method="post" id="objetivosform">
                    @csrf
                    <div class="modal fade" id="staticBackdrop{{$d->idasig}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #F1F1F1;">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Registrar objetivos de la asignatura: <span style="background-color:Yellow;">{{$d->asig}}</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!--###############################--->
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Objetivo</label>
                              <textarea class="form-control" id="objetivo" name="objetivo" rows="3"></textarea>
                            </div>
                            <input type="number" id="idasigna" name="idasigna" value="{{$d->idastec}}" hidden>
                            <!---###############################--> 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--modal visualizar objetivos-->
                  <!---modal de objetivos visualizar-->
                  <div class="modal fade" id="listaModalT{{$d->idasig}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content" style="background-color: #F1F1F1;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Objetivos de la asignatura: <span style="background-color:Yellow;">{{$d->asig}}</span></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!--###############################--->
                          <?php 
                            $contador=1;
                          ?>
                          @if($b!=0)
                            <div style="background-color:#CDFFEB; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" >
                              <div class="row">
                                <div class="col-2">
                                  No
                                </div>
                                <div class="col-8">
                                  Objetivos
                                </div>
                                <div class="col-2">
                                  Acción
                                </div>
                              </div>
                            </div>
                            <hr style="background-color:black;">
                            @foreach($ob as $j)
                              @if($j->id_asignaturas==$d->idastec)
                              <div class="row">
                                <div class="col-2" style="padding-left:15px;">
                                  {{$contador++}}
                                </div>
                                <div class="col-8">
                                  {{$j->descripcion}}
                                </div>
                                <div class="col-2">
                                  <a href="/eliminar/objetivostec/{{$j->id}}" class="btn btn-success" type="button"><i class="fas fa-trash-alt"></i></a>
                                </div>
                              </div>
                              <hr style="background-color:black;">
                              @endif
                            @endforeach
                          @endif
                          <!---###############################--> 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end modal-->
                  <!---end modal visualizar objetivos-->
                </td>
              </tr>
              @endforeach
            </tbody>
            <!--##################datos de la busqueda ##########################3-->
            <tbody id="datos" style="background-color: #dcedc8;">
            </tbody>
            <!--##########################################33-->
          </table>
          <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
              <div class="container-fluid">
              </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link  float-right letraf" type="button" href="/asignatura/reporte_c">
                  <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
            </div>
          </div>
        </div>
        <!--end table-->
      </div>
    </div>
  </div>
</div>
<!--end collapsed-->
<br><br>

<!--instanciar el ajax para quitar el error no definido-->
@endsection