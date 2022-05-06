@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  <h4> Listado De Estudiantes Matriculados </h4>
</div>
<br>
<div class="container">
     <form action="{{route('filtrarestu')}}" method="POST">
       @csrf
       <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="idcur" id="idcur">
        <option selected>Seleccione un curso</option>
        @foreach($program as $p)
        <option value="{{$p->idcur}}">{{$p->nomcur}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-info">Filtrar</button>
      <a href ="{{route('listadomatricula')}}" type="button" class="btn btn-info" id="deshacer">Deshacer</a>
    </form>
   </div>
    <br>
      <!---Mensaje-->
      @if($b==0)
      @if(Session::has('validacion'))
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('validacion')}}
        </div>
     @endif
     @endif
    <br>
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
        @foreach($estumat1 as $e)
        <tr style="background-color: #B5F2FF;">
        <td>{{$con++}}</td>
        <td>{{$e->nombre}} {{$e->segundonom}}</td>
        <td>{{$e->primerape}} {{$e->segundoape}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->telefono}}</td>
        <td>{{$e->nomcurso}}</td>
       <!-- idest
        idcur-->
        
        <td>
        <a href="#" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;"  data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>
        &nbsp&nbsp
        <a href="#" ><i class="fas fa-trash-alt" style="color:  red;"  data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>
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
        @if($b==1)
        {{$estumat1->links()}}
         @endif
        
       </div>
      </div>
    </div>
   
</div>
@endsection
