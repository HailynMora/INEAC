@extends('usuario.principa_usul')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <img src="{{('/img/logoin.jpg')}}" style="width:60px; height: 80px;">
    </div>
    <div class="col-md-6">
      <h4 style="text-align:center;">INSTITUTO DE EDUCACIÓN TECNICA INESUR</h4>
      <p style="text-align:center;"> Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
        Emanada por Secretaría de Educación Municipal de Pasto<br>
        Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
      </p>
    </div>
    <div class="col-md-3">
    </div> 
  </div>
  <div class="row">
    <div class="col-md-4">
      <b>Tipo Documento</b> <br>
      {{$estudiante->destipo}}
    </div>
    <div class="col-md-4">
     <b> Documento </b><br>
     {{$estudiante->num_doc}}
    </div>
    <div class="col-md-4">
      <b>Nombre</b> <br>
      {{$estudiante->nombre}} {{$estudiante->segundonom}} {{$estudiante->primerape}} {{$estudiante->segundoape}}
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-4">
      <b>Código</b><br>
      {{$estudiante->codigo}}
    </div>
    <div class="col-md-4">
      <b>Programa</b><br>
      {{$estudiante->descripcion}}
    </div>
    <div class="col-md-4">
      <b>Sede</b><br>
      Potosi
    </div>
  </div>
  <hr style="background-color:black;">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Asignatura</th>
        <th scope="col">Calificación</th>
        <th scope="col">Concepto</th>
      </tr>
    </thead>
    <tbody>
      @foreach($notas as $a)
        <?php
          $idc = $a->id_curso;
        ?>
        @foreach($cur as $s)
          @if($s->id==$idc)
          <tr>
            <td>{{$s->codigo}}</td>
            <td>{{$s->nombre}}</td> 
            <td>{{$a->definitiva}}</td>
            <td>{{$a->desem}}</td>
          </tr>
          @endif
          <!--@foreach($obj as $o)
            @if($s->id==$o->id_asignaturas)
            <tr>
              <td>Objetivos:</td>
              <td>{{$o->descripcion}}</td>
              <td></td>
              <td></td>
          </tr>
            @endif
          @endforeach-->
        @endforeach

      @endforeach
    </tbody>
  </table>
</div>
@endsection