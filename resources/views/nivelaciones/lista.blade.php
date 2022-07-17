@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado De Estudiantes Para Nivelacion Bachillerato</h3>
</div>
<div class="container">
	<table class="table">
	  <thead style="background-color:#0f468e; color:white;" class="alerta">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">N° Documento</th>
	      <th scope="col">Estudiante</th>
	      <th scope="col">Definitiva</th>
	      <th scope="col">Ciclo</th>
	      <th scope="col">Asignatura</th>
	      <th scope="col">Valor</th>
	      <th scope="col">Docente</th>
	    </tr>
	  </thead>
	  <tbody style="background-color:#e3e3e3;" class="letraf">
	  	<?php
	  		$cont = 1;
	  	?>
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
	    </tr>
	    @endforeach
	  </tbody>
	</table>
</div>
@endsection
