@extends('usuario.principa_usul')
@section('content')
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Programa</th>
            <th scope="col">Trimestre</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rep as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigotec}}</td>
        <td>{{$d->nombretec}}</td>
        <td>{{$d->nombretri}}</td>
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
        @endforeach
        </tbody>
    </table>
</div>
@endsection