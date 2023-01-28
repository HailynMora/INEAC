@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1">Asignaturas vinculadas a programas técnicos</h3>
</div>
@if(!isset($asigpro[0]->anio))
<div class="alert alert-info alert-dismissible fade show letraf" role="alert" style="font-size:18px;">
    <strong >Lo sentimos.</strong> No hay información para la solicitud.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
 @endif
 <!---###################-->
 <div class="container table-responsive">
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
                                      <h5 class="modal-title" id="exampleModalLabel">Eliminar asignatura vinculada</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body alerta">
                                      ¿Desea eliminar la materia Vinculada de forma permanente?
                
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                      <a type="submit" href="{{route('elimasig', $s->id)}}" class="btn btn-success">Si</a>
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
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                <h2 class="mb-0 alerta">
                    <a class="btn btn-link float-right" type="button" href="/programas/reporte_programas_tecnicos">
                    <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> Volver
                    </a>
                </h2>
                </div>
            </div>
        </div>
        @endsection