@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Reporte Asignaturas</h3>
</div>
<br><br>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Intensidad Horaria</th>
            <th scope="col">Val. Habilitación</th>
            <th scope="col">Estado </th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rep as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->val_habilitacion}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_asig',$d->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;"></i></a>&nbsp&nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
            <?php
        }
        ?>
        &nbsp&nbsp
        <!--<a type="button" data-toggle="modal" data-target="#eliminarAsig{{$d->id}}"><i class="nav-icon fas fa-trash" style="color: red;"></i></a>-->
        </td>
        </tr>
        <!-- Ventana modal para cambiar -->
        <div class="modal fade" id="cambiarAsig{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #563d7c !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado {{$d->estado}} de la asignatura? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        {{ $d->codigo }} - {{ $d->asig }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarAsig', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
             </div>
        </div>
        <!---fin ventana cambiar--->
        <!-- Ventana modal para eliminar 
        <div class="modal fade" id="eliminarAsig{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #563d7c !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Esta seguro que desea eliminar la asignatura  {{$d->asig}}? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        {{ $d->asig }} : Se eliminara de toda la Base de Datos
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <a  class="btn btn-success" href="{{ route('eliminarAsig', $d->id) }}">Eliminar</a>
                    </div>
                </div>
             </div>
        </div>-->
        <!---fin ventana eliminar--->
        @endforeach
        </tbody>
    </table>
    {{$rep->links()}}
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection