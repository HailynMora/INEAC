@extends('usuario.principa_usul')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center"> Planilla De Notas</h3>
            <h3 class="text-center"> Instituto De Educación Técnica INESUR</h3>
            <h3 class="text-center"> Programa: {{$consulta[0]->curso}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h3 class="text-center">Jornada: Sabado</h3>
        </div>
        <div class="col-6">
            <h3 class="text-center">Municipio: Potosi</h3>
        </div>
    </div>
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Nombres</th>
      <th scope="col">Nota 1</th>
      <th scope="col">%</th>
      <th scope="col">Nota 2</th>
      <th scope="col">%</th>
      <th scope="col">Nota 3</th>
      <th scope="col">%</th>
      <th scope="col">Nota 4</th>
      <th scope="col">%</th>
      <th scope="col">Definitiva</th>
      <th scope="col">Desempeño</th>
    </tr>
  </thead>
  <tbody>
    <?php 
     $conta =1;
    ?>
    @foreach($consulta as $c)
    <tr>
      <th scope="row">{{$conta++}}</th>
      <td>{{$c->apes}} {{$c->sedape}}</td>
      <td>{{$c->nomes}} {{$c->segnom}} </td>
      <td>{{$c->nota1}}</td>
      <td>{{$c->por1*100}}%</td>
      <td>{{$c->nota2}}</td>
      <td>{{$c->por2*100}}%</td>
      <td>{{$c->nota3}}</td>
      <td>{{$c->por3*100}}%</td>
      <td>{{$c->nota4}}</td>
      <td>{{$c->por4*100}}%</td>
      <td>{{$c->definitiva}}</td>
      <td>{{$c->desem}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<br>
<div class="container">
   <div class="row">
        <div class="col-12">
            <h5 class="text-left">Docente: {{$consulta[0]->nomdoc}} {{$consulta[0]->apedoc}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 class="text-left">Firma:______________</h5>
        </div>
    </div>
</div>
@endsection