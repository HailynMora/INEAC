@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Estudiantes Matriculados a Programas </h3>
</div>
<div class="container table-responsive">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código Programa</th>
            <th scope="col">Programa</th>
            <th scope="col">Reportes</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($mat as $m)
        <tr style="background-color: #dcedc8;">
            <td>{{$m->codigo}}</td>
            <td>{{$m->nomcurso}}</td>
            <td><a href="/reporte/estudiantes/bachillerato/{{$ma->idcur}}" class="btn btn-warning">Reporte</button></a>
        </tr>
         @endforeach
         {{$matec}}
         @foreach ($matec as $ma)
        <tr style="background-color: #dcedc8;">
            <td>{{$ma->codigotec}}</td>
            <td>{{$ma->nombretec}}</td>
            <td><a href="" class="btn btn-warning">Reporte</button></a>
        </tr>
         @endforeach
        </tbody>
    </table>
</div>
@endsection