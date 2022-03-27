@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<table class="table table-striped">
       <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @if($b == 1)
      @foreach($estudiante as $d)
        <tr>
        <td>{{$d->nombre}}</td>
        <td>{{$d->apellido}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->correo}}</td>
        <td>{{$d->estadoes}}</td>
        <td><!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>">
                Ver Mas
                </button>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                        <div class="alert alert-warning" role="alert">
                          Datos Estudiante
                        </div>
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
 <!--finalizar Tabla de informacion-->
@endsection



