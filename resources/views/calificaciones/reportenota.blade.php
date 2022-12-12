@extends('usuario.principa_usul')
@section('content')

@if(!isset($consulta[0]))
     <div class="container" style="background-color:white;">
        <div class="row">
        <div class="col-10">
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Datos No Encontrados!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="col-2">
                <a href="/asignatura/reporte_c" class="btn float-right"> <img src="{{asset('dist/img/back1.png')}}" class="img-fluid" ></a>
        </div>
        </div>
    </div>
@endif
@if(Session::has('notas'))
       <br>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{Session::get('notas')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
@if(isset($consulta[0]->asignatura))
<div class="container letraf" style="background-color:white;">
  <div class="container" style="padding-top:10px;">
   <div class="row letraf">
        <div class="col-6">
        <button type="button" class="btn" data-toggle="modal" data-target="#filtrarPDF">
          <img src="{{asset('dist/img/pdf.png')}}" class="img-fluid" >
        </button>
        <button type="button" class="btn" data-toggle="modal" data-target="#filtrarExcel">
          <img src="{{asset('dist/img/excel.png')}}" class="img-fluid" >
        </button>
        <button type="button" class="btn" data-toggle="modal" data-target="#filtrar">
          <img style="padding-top:5px;" src="{{asset('dist/img/filter.png')}}" class="img-fluid" >
        </button>
         <!-- Modal -->
      <form action="{{route('pdf')}}" method="POST">
        @csrf
        <div class="modal fade" id="filtrarPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#C2F2FF;">
                <h5 class="modal-title" id="exampleModalLabel">Generar PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar</label>
                <select class="form-control" id="idpdf" name="idpdf">
                  <option value="1">Aprobado</option>
                  <option value="2">Reprobado</option>
                  <option value="3">Todos</option>
                </select>
              </div>
                <!--end formulario-->
                <input value="{{$consulta[0]->idcur}}" id="idcurso" name="idcurso" hidden>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn  btn-warning" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Generar</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!--filtrar excel-->
         <!-- Modal -->
      <form action="{{route('excelnotas')}}" method="POST">
        @csrf
        <div class="modal fade" id="filtrarExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#C2F2FF;">
                <h5 class="modal-title" id="exampleModalLabel">Generar Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar</label>
                <select class="form-control" id="idexcel" name="idexcel">
                  <option value="1">Aprobado</option>
                  <option value="2">Reprobado</option>
                  <option value="3">Todos</option>
                </select>
              </div>
                <!--end formulario-->
                <input value="{{$consulta[0]->idcur}}" id="idcurso" name="idcurso" hidden>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn  btn-warning" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Generar</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!--filtrar-->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <form action="{{route('filtroNotas')}}" method="POST">
        @csrf
        <div class="modal fade" id="filtrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#C2F2FF;">
                <h5 class="modal-title" id="exampleModalLabel">Filtrar Estudiantes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar</label>
                <select class="form-control" id="filnota" name="filnota">
                  <option value="1">Aprobado</option>
                  <option value="2">Reprobado</option>
                  <option value="3">Todos</option>
                </select>
              </div>
                <!--end formulario-->
                <input value="{{$consulta[0]->idcur}}" id="idcurso" name="idcurso" hidden>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Filtrar</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!--end filtrar-->
        </div>
        <div class="col-6">
            <a href="/asignatura/reporte_c" class="btn float-right"> <img src="{{asset('dist/img/back1.png')}}" class="img-fluid" ></a>
        </div>
   </div>
</div>
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
<div class="table-responsive letraf">
<table class="table table-bordered letraf">
  <thead style="background-color:white;">
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
  <tbody style="background-color:white;">
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

<div class="container letraf" style="background-color:white;">
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
<div class="container letraf" style="background-color:white;">
   <div class="row">
        <div class="col-12">
            <h6 class="text-left">Docente: {{$consulta[0]->nomdoc}} {{$consulta[0]->apedoc}}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h6 class="text-left">Firma:______________</h6>
        </div>
    </div>
</div>
@endif
@endsection