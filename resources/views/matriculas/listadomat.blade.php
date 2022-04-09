@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  <h4> Listado De Estudiantes Matriculados </h4>
</div>
<br>
<div class="container">
    <table class="table">
        <thead style="background-color:#F9FF79;">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo Doc</th>
            <th scope="col">No Documento</th>
            <th scope="col">Telefono</th>
            <th scope="col">Curso</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @if($b==1)
        @php
        $con = 1;
        @endphp
        @foreach($estumat as $e)
        <tr style="background-color: #B5F2FF;">
        <td>{{$con++}}</td>
        <td>{{$e->nombre}}</td>
        <td>{{$e->apellido}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->telefono}}</td>
        <td>{{$e->nomcurso}}</td>
       <!-- idest
        idcur-->
        
        <td>
        <a href="#" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>
        &nbsp&nbsp
        <a href="#" ><i class="fas fa-trash-alt" style="color:  red;" ></i></a>
        </td>
        </tr>
        @endforeach
       @endif
        </tbody>
    </table>
    <div class="row">
      <div class="col-md-5">
      </div>
      <div class="col-md-5">
      </div>
      <div class="col-md-2">
        <div class="container-fluid">
         {{$estumat->links()}}
       </div>
      </div>
    </div>
   
</div>
@if($b=0)
         hola
@endif
@endsection

        
       
        
        
        
        