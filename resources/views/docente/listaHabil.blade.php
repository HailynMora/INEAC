@extends('usuario.principa_usul')
@section('content')
    @if(isset($con[0]))
    <!--coolapsed-->
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <div class="alert alert-warning" role="alert">
                  <h3 class="text-center">Valor Habilitaciones</h3>
                </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
               <!--table-->
               <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Asignatura</th>
                        <th scope="col">Curso</th>
                        <th scope="col">V/Taller</th>
                        <th scope="col">V/Evaluacón </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $acum=1;
                        ?>
                        @foreach($con as $c)
                        <tr>
                        <th scope="row">{{$acum++}}</th>
                        <td>{{$c->nombre}}</td>
                        <td>{{$c->descripcion}}</td>
                        <td>$10000</td>
                        <td>${{$c->val_habilitacion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
               <!--end table-->
            </div>
            </div>
        </div>
        </div>
    <!--end collapsed-->
    @endif
@endsection