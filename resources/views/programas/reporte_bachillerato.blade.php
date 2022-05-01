@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Programas Registrados</h3>
</div>
<a href="{{route('registrarprog')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
    <form class="form-inline my-6 my-lg-0 float-right mb-6">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    
    <br><br>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Programas</th>
            <th scope="col">Jornada</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rep as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->programa}}</td>
        <td>{{$d->jornada}}</td>
        <td>{{$d->cursodes}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_prog',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>
        &nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
            <?php
        }
        ?>
        &nbsp&nbsp
        <a href="{{route('vincular_a', $d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308;" ></i></a>        
        </td>
        </tr>
        <!--Ventana Modal para la Alerta de Eliminar--->
        <!-- Ventana modal para eliminar -->
        <div class="modal fade" id="cambiarPro{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #563d7c !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado {{$d->estado}} del programa? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        {{ $d->codigo }} - {{ $d->programa }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarPro', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
             </div>
        </div>
        <!---fin ventana eliminar--->
        @endforeach
        </tbody>
    </table>
    {{$rep->links()}}
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection