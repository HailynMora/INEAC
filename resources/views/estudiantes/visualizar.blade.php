@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado de Estudiantes</h3>
</div>
<br><br>
<div class="container">
<table class="table table-striped"style="background-color:#FFCC00;">
       <thead>
        <tr>
        <th scope="col">N° Identificacion</th>
        <th scope="col">Nombre</th>
        <th scope="col" >Telefono</th>
        <th scope="col" class="d-none d-lg-block ">Correo</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @if($b == 1)<!--valida si hay datos los imprime-->
      @foreach($estudiante as $d)
        <tr class="table-success"style="background-color: #dcedc8;">
        <td>{{$d->num_doc}}</td>
        <td>{{$d->nombre}} {{$d->apellido}}</td>
        <td>{{$d->telefono}}</td>
        <td  class="d-none d-lg-block">{{$d->correo}}</td>
        <td>{{$d->estadoes}}</td>
        <td><!-- Button trigger modal -->
                <a href="{{route('actualizar_est',$d->id)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>" data-placement="bottom"  title="Ver Estudiante">
                <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
                &nbsp&nbsp
                <?php
                if($d->estadoes == 'Activo'){
                    ?>
                    <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}" data-placement="bottom"  title="Deshabilitar Estudiante"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                    <?php
                }else{
                    ?>
                    <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Habilitar Estudiante"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                    <?php
                }
                ?>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="staticBackdropLabel">
                       
                          Datos Estudiante: {{$d->nombre}} {{$d->apellido}}
                       
                       </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!---Mostrar datos-->
                    <div class="row">
                        <div class="col-md-4">Nombre</div>
                        <div class="col-md-4 ml-auto">{{$d->nombre}} {{$d->apellido}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Dirección</div>
                        <div class="col-md-4 ml-auto">{{$d->direccion}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tipo Doc.</div>
                        <div class="col-md-4 ml-auto">{{$d->tdoces}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Número</div>
                        <div class="col-md-4 ml-auto">{{$d->num_doc}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Genero</div>
                        <div class="col-md-4 ml-auto">{{$d->generoestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Etnia</div>
                        <div class="col-md-4 ml-auto">{{$d->etniaestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Estrato</div>
                        <div class="col-md-4 ml-auto">{{$d->estrato}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Usuario</div>
                        <div class="col-md-4 ml-auto">{{$d->usuestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Acudiente Nombres</div>
                        <div class="col-md-4 ml-auto">{{$d->nomacu}} {{$d->apeacu}} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Parentesco</div>
                        <div class="col-md-4 ml-auto">{{$d->paren}} </div>
                    </div>
                    
                    <!--end mostrar datos-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Ventana modal para cambiar -->
                <div class="modal fade" id="cambiarEstado{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #283593 !important; color:white;">
                        <h4 class="modal-title text-center" style=" text-align: center;">
                            <span>ESTUDIANTE: {{$d->nombre}} {{$d->apellido}} </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                        </div>
                        <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                            <h4 class="modal-title text-center" style=" text-align: center;">
                            <span>¿Cambiar el estado {{$d->estadoes}} del Estudiante? </span>
                            </h4>
                        </strong>
                        </div>
                        <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarEstad', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    </div>
                </div>
                    <!---fin ventana cambiar--->
        </td>
        </tr>
        
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
               No Hay Registros
            </div>
        @endif
    </tbody>
    </table>
</div>
 <!--finalizar Tabla de informacion-->
@endsection



