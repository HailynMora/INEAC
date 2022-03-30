@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Reporte Programas
</div>
<div class="container">
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Programa</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rep as $d)
        <tr>
        <td>{{$d->codigo}}</td>
        <td>{{$d->programa}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_prog',$d->id)}}" ><i class="nav-icon fas fa-edit" ></i></a>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection