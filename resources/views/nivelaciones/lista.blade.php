@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado De Estudiantes Pendientes De Nivelación En Bachillerato</h3>
</div>
@if(Session::has('rep'))
  <div class="alert alert-dismissible fade show" role="alert" style="background-color:#E3E3E3;">
    <strong class="alerta"> {{Session::get('rep')}} </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="container">
   <a href="/listado/nivelacion/recibos/{{$p}}/{{$a}}/{{$pe}}" title="Lista de nivelaciones"> <i class="fas fa-book" style="color:#0E7F9B; font-size:30px;"></i> </a>
</div>
  <p></p>
  <div class="table-responsive">
	<table class="table">
	  <thead style="background-color:#0f468e; color:white;" class="alerta">
	    <tr>
	      <th scope="col">N°</th>
	      <th scope="col">N° Doc.</th>
	      <th scope="col">Estudiante</th>
	      <th scope="col">Definitiva</th>
	      <th scope="col">Ciclo</th>
	      <th scope="col">Asignatura</th>
	      <th scope="col">Valor</th>
	      <th scope="col">Docente</th>
		  <th scope="col" colspan="2" style="text-align:center;">Acción</th>
	    </tr>
	  </thead>
	  <tbody style="background-color:#e3e3e3;" class="letraf">
	  	<?php
	  		$cont = 1;
	  	?>
		@if(isset($re))
	  	@foreach($re as $m)
	    <tr>
	      <th scope="row">{{$cont++}}</th>
	      <td>{{$m->num_doc}}</td>
	      <td>{{$m->nom1}} {{$m->nom2}} {{$m->ape1}} {{$m->ape2}}</td>
	      <td>{{$m->definitiva}}</td>
	      <td>{{$m->descu}}</td>
	      <td>{{$m->nomasig}}</td>
	      <td>{{$m->valor}}</td>
	      <td>{{$m->nomdoc}} {{$m->apedoc}}</td>
		  <td>
			<!--boton recibo-->
			<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recibo{{$m->idest}}{{$m->idnota}}">
				Recibo
				</button>

				<!-- Modal -->
				<div class="modal fade" id="recibo{{$m->idest}}{{$m->idnota}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header" style="background-color:#ffc107; color:white;">
						<h5 class="modal-title" id="exampleModalLabel">Ingresar información del recibo de pago</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!--formulario-->
						<form action="{{route('recibo')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="imgrecibo">Imagen</label>
								<input type="file" class="form-control" id="img" name="img"  accept="image/*">
								<small id="emailHelp" class="form-text text-muted">Agregar la imagen o foto del recibo de pago</small>
							</div>
							<div class="form-group">
								<label for="n1">Número de recibo</label>
								<input type="number" class="form-control" id="numrecibo" name="numrecibo" min="0" required>
							</div>
							<div class="form-group">
								<label for="desrecibo">Descripción</label>
								<input type="text" class="form-control" id="desrecibo" name="desrecibo" required>
							</div>
							   <input type="text" class="form-control" id="idest" name="idest" value="{{$m->idest}}" hidden>
							   <input type="text" class="form-control" id="idnota" name="idnota" value="{{$m->idnota}}" hidden>
							   <input type="text" class="form-control" id="nota" name="nota" value="{{$m->definitiva}}" hidden>
							   <input type="text" class="form-control" id="programa" name="programa" value="{{$p}}" hidden>
							   <input type="text" class="form-control" id="anio" name="anio" value="{{$a}}"  hidden>
							   <input type="text" class="form-control" id="periodo" name="periodo" value="{{$pe}}"  hidden>
						<!--end formulario-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
					</form>
					</div>
				</div>
				</div>
			<!--end recibo-->
		  </td>
		  <td>
		  <a href="/recibos/estudiante/{{$m->idest}}/{{$a}}" class="btn btn-primary" style="background-color:#33A9B7;">Información</a>
		  </td>
	    </tr>
	    @endforeach
		@endif
	  </tbody>
	</table>
   </div>
	@if(Session::has('niv'))
			<br>
				<div class="letraf alert alert-info alert-dismissible fade show" role="alert">
					{{Session::get('niv')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
		@endif
@endsection
