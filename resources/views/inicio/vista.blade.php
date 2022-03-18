@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Bienvenidos
</div>
<br>


<!--Tarjetas-->
<div class="card-deck">
 
<div class="card" style="width: 10rem;">
  <img src="img/docentes.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><b>Docentes</b></h5>
    <p class="card-text">Desde esta aplicación puede gestionar la información de los docentes y funcionalidades como: </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Registrar</li>
    <li class="list-group-item">Actualizar</li>
    <li class="list-group-item">Deshabilitar</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
  </div>
</div>
  
<div class="card" style="width: 18rem;">
  <img src="img/estudiantes.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><b>Estudiantes</b></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="img/asignaturas.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><b>Asignaturas</b></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
</div>
<!--end tarjetas-->
@endsection