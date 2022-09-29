@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Roles De Usuario</h3>
</div>
<!--cards--->
   <!--idrol
    idper
    id_estado-->
<br><br>
<div class="container">
<div class="card-deck letraf"> 
@foreach($rol as $r)
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><b>Nombre Rol:</b> {{$r->nomrol}}</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Permiso Asignado:</b> {{$r->name}}</li>
  </ul>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Descripción:</b> {{$r->pdescrip}}</li>
  </ul>
  <div class="card-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rol<?php echo $r->idrol ?>">
    Editar
    </button>
  </div>
</div>


<div class="modal fade" id="rol<?php echo $r->idrol ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#FFC107;">
        <h5 class="modal-title" id="staticBackdropLabel">Cambiar Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cambiarper', ['idrol' => $r->idrol]) }}" method="Post">
      @csrf
      <div class="modal-body">
       
        <table class="table">
            <thead class="thead-blue">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Permiso</th>
                <th scope="col">descripcion</th>
                <th scope="col">Elegir</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $con=1;
            ?>
            @foreach($per as $p)
                <tr>
                <th scope="row">{{$con++}}</th>
                <td> {{$p->nombre}}</td>
                <td>{{$p->descripcion}}</td>
                <td>
                <!---radio buttons-->
                <label for="radio"><input type="radio" name="radio" value="{{$p->id}}"/></label>
                <!--end radio button-->
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
     </form>
    </div>
  </div>
</div>

@endforeach
</div>
</div>
<!---end cards-->

@endsection