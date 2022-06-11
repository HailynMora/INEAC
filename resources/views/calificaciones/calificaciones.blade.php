@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Registro Calificaciones</h3>
</div>
<br>
<!--collapsed-->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
     <div class="row">
        <div class="col-6">
            
        </div>
        <div class="col-6">
           <a href="/asignatura/reporte_c" type="button" class="btn btn-success float-right"><i class="fas fa-long-arrow-alt-left"></i></a>
        </div>
     </div>
    </div>

    <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <!--tabla-->
            <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Celular</th>
                <th scope="col">T/Documento</th>
                <th scope="col">No. Documento</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php $conta=1; ?>
            @foreach($estumat as $t)
                <tr>
                <th scope="row">{{$conta++}}</th>
                <td>{{$t->nombre}}&nbsp;{{$t->segundonom}}</td>
                <td>{{$t->primerape}}&nbsp;{{$t->segundoape}}</td>
                <td>{{$t->telefono}}</td>
                <td>{{$t->destipo}}</td>
                <td>{{$t->num_doc}}</td>
                <td>
                    <!--modal-->
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$t->idest}}">
                       <i class="fas fa-book-open" style="color:#AFCEE3; font-size:22px;"></i>
                     </a>
                    <a class="btn" href="/ver/notas/estudiante/{{$t->idest}}/{{$as[0]->idcur}}" style="background-color:#215EBB;"><i class="fas fa-file-alt" style="color:#AFCEE3; font-size:22px;"></i></a>
                        <!-- Modal -->
                        <form action="{{route('regnotas')}}" method="POST">
                        @csrf
                        <div class="modal fade" id="exampleModal{{$t->idest}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="container text-center" style="background-color:#5333ed; color:white; padding-top:10px; padding-bottom:10px;">
                                <h5 class="modal-title" id="exampleModalLabel">Registro de notas</h5>
                            </div>
                            <div class="modal-body">
                                <!--table-->
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Porcentaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nota1" name="nota1" placeholder="Ejm. 3.5" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <select id="porcentaje1" name="porcentaje1">
                                                    <option value="0.1">10%</option>
                                                    <option value="0.2">20%</option>
                                                    <option value="0.3">30%</option>
                                                    <option value="0.4">40%</option>
                                                    <option value="0.5">50%</option>
                                                    <option value="0.6">60%</option>
                                                    <option value="0.7">70%</option>
                                                    <option value="0.8">80%</option>
                                                    <option value="0.9">90%</option>
                                                    <option value="1">100%</option>
                                                </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <!--segunda fila-->
                                    <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nota2" name="nota2" placeholder="Ejm. 3.5" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select id="porcentaje2" name="porcentaje2">
                                                    <option value="0.1">10%</option>
                                                    <option value="0.2">20%</option>
                                                    <option value="0.3">30%</option>
                                                    <option value="0.4">40%</option>
                                                    <option value="0.5">50%</option>
                                                    <option value="0.6">60%</option>
                                                    <option value="0.7">70%</option>
                                                    <option value="0.8">80%</option>
                                                    <option value="0.9">90%</option>
                                                    <option value="1">100%</option>
                                                </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <!--tercera fila-->
                                    <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nota3" name="nota3" placeholder="Ejm. 3.5" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select id="porcentaje3" name="porcentaje3">
                                                    <option value="0.1">10%</option>
                                                    <option value="0.2">20%</option>
                                                    <option value="0.3">30%</option>
                                                    <option value="0.4">40%</option>
                                                    <option value="0.5">50%</option>
                                                    <option value="0.6">60%</option>
                                                    <option value="0.7">70%</option>
                                                    <option value="0.8">80%</option>
                                                    <option value="0.9">90%</option>
                                                    <option value="1">100%</option>
                                                </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <!--cuarta fila-->
                                <tr>
                                    <th scope="row">4</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nota4" name="nota4" placeholder="Ejm. 3.5" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <select id="porcentaje4" name="porcentaje4">
                                                    <option value="0.1">10%</option>
                                                    <option value="0.2">20%</option>
                                                    <option value="0.3">30%</option>
                                                    <option value="0.4">40%</option>
                                                    <option value="0.5">50%</option>
                                                    <option value="0.6">60%</option>
                                                    <option value="0.7">70%</option>
                                                    <option value="0.8">80%</option>
                                                    <option value="0.9">90%</option>
                                                    <option value="1">100%</option>
                                                </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <!--end cuarta fila-->
                                </tbody>
                                </table>
                                <!--end table-->
                                <input id="idcur" name="idcur" value="{{$as[0]->idcur}}" hidden >
                                <input id="idest" name="idest" value="{{$t->idest}}"  hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">enviar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        </form>
                    <!--end modal-->
                </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        <!--end tabla-->
       

      </div>
    </div>
  </div>
</div>
<!--end collapsed-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection