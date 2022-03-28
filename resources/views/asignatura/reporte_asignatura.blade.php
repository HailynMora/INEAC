@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Reporte Asignaturas
</div>
<div class="container">
    <table class="table">
        <thead class="thead-light">
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
        <tr>
        <td>{{$d->codigo}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->val_habilitacion}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_asig',$d->id)}}" ><i class="nav-icon fas fa-edit" ></i></a>&nbsp&nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a href="#" ><i class="nav-icon fas fa-toggle-on"></i></a>
            <?php
        }else{
            ?>
            <a href="#" ><i class="nav-icon fas fa-toggle-off"></i></a>
            <?php
        }
        ?>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection