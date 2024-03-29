@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Nivelaciones </h3>
</div>
<div class="container">
<a href="{{route('listanestu')}}" class="btn btn-info">Listado</a>
<p></p>
</div>
<div class="container table-responsive">
    <table class="table">
      <thead style="background-color:#0f468e; color:white;" class="alerta">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Programa</th>
          <th scope="col">Asignatura</th>
          <th scope="col">Definitiva</th>
          <th scope="col">Docente</th>
          <th scope="col">Periodo</th>
          <th scope="col">Valor</th>
        </tr>
      </thead>
      <tbody style="background-color:#e3e3e3;" class="letraf">
        <?php
            $cont = 1;
        ?>
        @if(isset($bac))
            @foreach($bac as $m)
            <tr>
              <th scope="row">{{$cont++}}</th>
              <td>{{$m->descur}}</td>
              <td>{{$m->nombreasig}}</td>
              <td>{{$m->definitiva}}</td>
              <td>{{$m->nomdoc}} {{$m->apedoc}}</td>
              <td>{{$m->anio}}-{{$m->periodo}} </td>
              <td>${{$m->val_habilitacion}}</td>
            </tr>
            @endforeach
        @endif
        @if(isset($tec))
            @foreach($tec as $m)
            <tr>
              <th scope="row">{{$cont++}}</th>
              <td>{{$m->nombretec}}</td>
              <td>{{$m->nombreasig}} - {{$m->nombretri}}</td>
              <td>{{$m->definitiva}}</td>
              <td>{{$m->nomdoc}} {{$m->apedoc}}</td>
              <td>{{$m->anio}}-{{$m->periodo}} </td>
              <td>${{$m->val_habilitacion}}</td>
            </tr>
            @endforeach
        @endif
      </tbody>
    </table>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(isset($res))
@if($res == 0)
  <script>
    swal({
    title: "Lo sentimos!",
    text: "No se encontró información para la solicitud!",
    icon: "warning",
    button: "Salir",
  });
  </script>
  @endif
@endif
@endsection