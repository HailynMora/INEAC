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
                   <div class="conatiner">
                   <a href="/reporte/notas/{{$as[0]->idcur}}"><img src="{{asset('dist/img/informe.png')}}" class="img-fluid" ></a>
                  </div>
                </div>
                <div class="col-6">
                    <a  href="/asignatura/reporte_c" class="btn float-right"><i class="fas fa-backward"></i>&nbsp;Regresar</a>
                </div>
            </div>
        </div>
        <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <!--tabla-->
                <!--mensajes-->
                @if(Session::has('notare'))
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:#AFDCEC;">
                        <strong> {{Session::get('notare')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(Session::has('notaval'))
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:#38ACEC;">
                        <strong> {{Session::get('notaval')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                <!--end mensajes-->
                <br>
                <div class="table-responsive">
                    <table class="table" style="background-color:#FFCC00;">
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
                                <tr style="background-color: #dcedc8;">
                                    <th scope="row">{{$conta++}}</th>
                                    <td>{{$t->nombre}}&nbsp;{{$t->segundonom}}</td>
                                    <td>{{$t->primerape}}&nbsp;{{$t->segundoape}}</td>
                                    <td>{{$t->telefono}}</td>
                                    <td>{{$t->destipo}}</td>
                                    <td>{{$t->num_doc}}</td>
                                    <td>
                                        <!--modal-->
                                        <!-- Button trigger modal -->
                                        <a type="button"  data-toggle="modal" data-target="#exampleModal{{$t->idest}}" title="Ingresar Nota">
                                            <i class="bi bi-journal-bookmark" style="color:black; font-size:24px;"></i>
                                        </a>
                                        &nbsp&nbsp
                                        <a  href="/ver/notas/estudiante/{{$t->idest}}/{{$as[0]->idcur}}" title="Visualizar Nota">
                                          <i class="bi bi-file-earmark-ruled" style="color:black; font-size:24px;"></i>
                                       </a>
                                        <!-- Modal -->
                                        <form action="{{route('regnotas')}}" method="POST">
                                        @csrf
                                            <div class="modal fade" id="exampleModal{{$t->idest}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="container text-center" style="background-color: #283593; color:#ffffff; padding-top:10px; padding-bottom:10px;">
                                                            <h5 class="modal-title" id="exampleModalLabel">Registro de notas</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                        <!--table-->
                                                        <div class="table-responsive">
                                                        <table class="table" style="background-color:#FFCC00;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nota</th>
                                                                    <th scope="col">Porcentaje</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #7FFFD4;">
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota1" name="nota1" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
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
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota2" name="nota2" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
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
                                                                        <div class="form-group" style="padding-top:7px;">
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota3" name="nota3" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
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
                                                                            <input type="number" step="any" min="0" max="5" type="text" class="form-control" id="nota4" name="nota4" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
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
                                                      </div>
                                                        <!--end table-->
                                                        <input id="idcur" name="idcur" value="{{$as[0]->idcur}}" hidden >
                                                        <input id="idest" name="idest" value="{{$t->idest}}"  hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn"  style="background-color:#FFCC00;" data-dismiss="modal">Salir</button>
                                                        <button type="submit" class="btn btn-primary">enviar</button>
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
                   </div>
                <!--end tabla-->
            </div>
        </div>
    </div>
</div>
<!--end collapsed-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection