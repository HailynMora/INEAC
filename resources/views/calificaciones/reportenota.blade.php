@extends('usuario.principa_usul')
@section('content')

@if(isset($consulta[0]->asignatura))
<div class="container">
    <div class="row">
        <div class="col-12">
            <h5 class="text-center"> Planilla De Notas</h5>
            <h5 class="text-center"> Instituto De Educación Técnica INESUR</h5>
            <h5 class="text-center"> Programa: {{$consulta[0]->curso}} {{$consulta[0]->anio}} {{$consulta[0]->periodo}} </h5>
        </div>
    </div>
    <div class="row">
       <div class="col-4">
            <h5 class="text-left">Materia: {{$consulta[0]->asignatura}} </h5>
        </div>
        <div class="col-4">
            <h5 class="text-center">Jornada: Sabado</h5>
        </div>
        <div class="col-4">
            <h5 class="text-center">Municipio: Potosi</h5>
        </div>
    </div>
</div>
<div class="table-responsive">
<table class="table table-bordered">
  <thead style="background-color:#83C9F4;">
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
  <?php 
   $contador=1;
  ?>
 <h6 class="text-center">Criterios De Evaluación </h6>
 <hr style="background-color:black;">
@foreach($objetivos as $ob)
  @if(isset($ob->descripcion))
   <div class="row">
        <div class="col-12">
            <h6 class="text-left">{{$contador++}}. &nbsp;{{$ob->descripcion}} </h6>
            <hr style="background-color:black;">
        </div>
    </div>
    @endif
@endforeach
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
@endif
@endsection