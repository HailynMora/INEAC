@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Asignaturas Vinculadas a Programas</h3>
</div>
<br>
<div class="container table-responsive">
    <table class="table">
        <thead style="background-color:#0f468e; color:white;" class="alerta">
            <tr>
            <th scope="col">Año</th>
            <th scope="col">Periodo</th>
            <th scope="col">Cód. Programa</th>
            <th scope="col">Programa</th>
            <th scope="col">Cód. Asignatura</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Docente</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        
        @foreach($asigpro as $s)
        @if(isset($s->anio))
        <tr style="background-color:#E3E3E3;" class="letraf">
            <td>{{$s->anio}}</td>
            <td>{{$s->periodo}}</td>
            <td>{{$s->codcur}}</td>
            <td>{{$s->curso}}</td>
            <td>{{$s->codas}}</td>
            <td>{{$s->asig}}</td>
            <td>{{$s->nomdoc}} {{$s->apedoc}}</td>
            <td>
                &nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#eliminarAsig{{$s->id}}" data-placement="bottom"  title="Eliminar"><i class="nav-icon fas fa-trash" style="color: red; font-size:20px;"></i></a>
            </td>
        </tr>
            <!-- Ventana modal para eliminar -->
            <div class="modal fade" id="eliminarAsig{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #283593 !important;">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                        </div>
                        <div class="modal-body mt-2 text-center">
                        <h4 class="modal-title text-center" style=" text-align: center;">
                                <span class="alerta">¿Esta seguro que desea desvincular la asignatura {{$s->asig}} del programa {{$s->curso}}? </span>
                            </h4>
                        </div>
                        <div class="modal-footer alerta">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                            <a  class="btn btn-primary" href="{{ route('desvincular', $s->id) }}">Guardar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!---fin ventana eliminar--->
            @endif
        @endforeach
        
        </tbody>
    </table>
    {{$asigpro->links()}}
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
          <h2 class="mb-0 alerta">
            <a class="btn btn-link float-right" type="button" href="/programas/reporte_programas">
            <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> Volver
            </a>
          </h2>
        </div>
    </div>
</div>

<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection