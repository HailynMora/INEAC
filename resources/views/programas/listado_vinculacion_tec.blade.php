@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Asignaturas Vinculadas a Programas Técnivos</h3>
</div>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Cód. Programa</th>
            <th scope="col">Programa</th>
            <th scope="col">Trimestre</th>
            <th scope="col">Cód. Asignatura</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Docente</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        
        @foreach($asigpro as $s)
        <tr style="background-color: #dcedc8;">
            <td>{{$s->codigotec}}</td>
            <td>{{$s->nombretec}}</td>
            <td>{{$s->nombretri}}</td>
            <td>{{$s->codas}}</td>
            <td>{{$s->asig}}</td>
            <td>{{$s->nomdoc}} {{$s->apedoc}}</td>
            
            <td>
                &nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#eliminarAsig{{$s->id}}" data-placement="bottom"  title="Eliminar"><i class="nav-icon fas fa-trash" style="color: red;"></i></a>
               
            </td>
        </tr>
            <!-- Ventana modal para eliminar -->
            
            <!---fin ventana eliminar--->
        @endforeach
        
        </tbody>
    </table>
    {{$asigpro->links()}}
    <div class="mx-auto" style="width: 200px;">
    <a  class="btn btn-info" href="{{url('/programas/reporte_programas_tecnicos')}}">Regresar</a>

    </div>
    
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection