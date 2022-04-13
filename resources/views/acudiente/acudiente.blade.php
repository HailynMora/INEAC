@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado De Acudientes</h3>
</div>
<br><br>
<div class="container">
<table class="table table-striped"style="background-color:#FFCC00;">
       <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Dirección</th>
        <th scope="col" >Telefono</th>
        <th scope="col" >No Doc</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @if($b == 1)<!--valida si hay datos los imprime-->
      @foreach($acu as $d)
        <tr class="table-success"style="background-color: #dcedc8;">
        <td>{{$d->nombre}}</td>
        <td>{{$d->apellido}}</td>
        <td>{{$d->direccion}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->num_doc}}</td>
        <td><!-- Button trigger modal -->
                <a href="{{route('actualizar_acu',$d->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>">
                <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="staticBackdropLabel">
                       
                          Datos Acudiente: {{$d->nombre}} {{$d->apellido}}
                       
                       </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!---Mostrar datos-->
                    <div class="row">
                            <div class="col-md-6">Telefono</div>
                            <div class="col-md-6 ml-auto">{{$d->telefono}}</div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">Dirección</div>
                                <div class="col-md-6 ml-auto">{{$d->direccion}}</div>
                        </div>
                       <div class="row">
                            <div class="col-md-6">Tipo Doc</div>
                            <div class="col-md-6 ml-auto">{{$d->tipodoc}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Num Doc</div>
                            <div class="col-md-6 ml-auto">{{$d->num_doc}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Parentesco</div>
                            <div class="col-md-6 ml-auto">{{$d->parent}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Genero</div>
                            <div class="col-md-6 ml-auto">{{$d->gen}}</div>
                        </div>
                    
                    <!--end mostrar datos-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
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


@endsection