@extends('usuario.principa_usul')
@section('content')

<div class="accordion">
  <div class="card">
    <div class="card-header">
        @if(isset($datos[0]))
        <div class="row">
                <div class="col-12 text-center">
                 <h4>{{$datos[0]->primernom}} {{$datos[0]->segnom}} {{$datos[0]->primerape}} {{$datos[0]->segape}}</h4>
                 <h4>Doc: {{$datos[0]->numdoc}}</h4>  
                </div>
        </div>
        <div class="row">
                <div class="col-6 text-center">
                 <h4>{{$datos[0]->curso}}</h4> 
                </div>
                <div class="col-6 text-center">
                 <h4>{{$datos[0]->descur}}</h4>  
                </div>
        </div>
        @endif
    </div>

    <div class="collapse show">
      <div class="card-body">
        <!--tabla de notas-->
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Asignatura</th>
                <th scope="col">Docente</th>
                <th scope="col">Nota 1</th>
                <th scope="col">%</th>
                <th scope="col">Nota 2</th>
                <th scope="col">%</th>
                <th scope="col">Nota 3</th>
                <th scope="col">%</th>
                <th scope="col">Nota 4</th>
                <th scope="col">%</th>
                <th scope="col">Definitiva</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $conta=1;
                ?>
                @foreach($datos as $d)
                @if(isset($d->asignatura))
                <tr>
                    <th scope="row">{{$conta++}}</th>
                    <td>{{$d->asignatura}}</td>
                    <td>{{$d->nomdoc}} {{$d->apedoc}}</td>
                    <td>{{$d->nota1}}</td>
                    <td>{{$d->por1}}</td>
                    <td>{{$d->nota2}}</td>
                    <td>{{$d->por2}}</td>
                    <td>{{$d->nota3}}</td>
                    <td>{{$d->por3}}</td>
                    <td>{{$d->nota4}}</td>
                    <td>{{$d->por4}}</td>
                    <td>{{$d->definitiva}}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
            </table>
          </div>
        <!--end table-->
      </div>
    </div>
  </div>
</div>
@endsection