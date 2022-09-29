@extends('usuario.principa_usul')
@section('content')
<!---collpased-->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <div class="row alerta">
        <div class="col-4">
            <a  href="/asignatura/reporte" class="btn"><i class="fas fa-backward"></i>&nbsp;Regresar</a>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
            <a type="button" class="btn float-right" data-toggle="modal" data-target="#modalEditar">
                <i class="fas fa-edit" style="color:black; font-size:17px;"></i>&nbsp;Editar
            </a>
            <!--MODAL ACTUALIZAR-->
            <form action="{{route('actualizarNotaTec')}}" method="POST">
                @csrf
                <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar registro de calificaciones </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--table-->
                                @foreach($nota as $a) 
                                <div class="table-responsive">
                                    <table class="table" style="background-color:#FFCC00;">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nota</th>
                                                <th scope="col">Porcentaje</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: #e3e3e3;">
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota1" name="nota1" placeholder="Ejm. 3.5" value="{{$a->nota1}}" required>
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
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota2" name="nota2" placeholder="Ejm. 3.5" value="{{$a->nota2}}" required>
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
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota3" name="nota3" placeholder="Ejm. 3.5" value="{{$a->nota3}}" required>
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
                                                        <input type="number" step="any" min="0" max="5" type="text" class="form-control" id="nota4" name="nota4" placeholder="Ejm. 3.5" value="{{$a->nota4}}" required>
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
                                        </tbody>
                                    </table>
                                </div>
                                <!--end table-->
                                <input type="text" value="{{$a->idnota}}" name="idnota" hidden>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--FIN MODAL ACTUALIZAR-->
        </div>
      </div>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <!--table-->
       @foreach($nota as $n) 
               <div class="container text-center alerta" style="padding-top:10px; padding-bottom:10px; background-color:#ffc107;">
                <h5><b>Calificaciones</b></h5>
                 <div class="row">
                     <div class="col-2 text-left"><b>Estudiante:</b></div>
                     <div class="col-4 text-center">{{$n->nomes}}&nbsp;{{$n->second_nom}}&nbsp;{{$n->apes}}&nbsp;{{$n->second_ape}}</div>
                     <div class="col-3"><b>Curso:</b></div>
                     <div class="col-3">{{$n->curso}}</div>
                 </div>
                 <div class="row">
                     <div class="col-2 text-left"><b>Asignatura:</b></div>
                     <div class="col-4 text-center">{{$n->asignatura}}</div>
                     <div class="col-3"><b>Perido:</b></div>
                     <div class="col-3">{{$n->anio}} {{$n->periodo}}</div>
                 </div>
               </div><br>
                        <div style="background-color:#e3e3e3; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" class="letraf" >
                            <div class="row">
                                <div class="col-3">
                                    <b>N°</b>
                                </div>
                                <div class="col-3">
                                    <b>Calificación</b>
                                </div>
                                <div class="col-3">
                                    <b>Porcentaje</b>
                                </div>
                                <div class="col-3">
                                    <b>Total</b>
                                </div>
                            </div>
                            <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                1
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota1}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por1*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por1 * $n->nota1}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                2
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota2}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por2*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por2 * $n->nota2}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                3
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota3}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por3*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por3 * $n->nota3}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                4
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota4}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por4*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por4 * $n->nota4}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                           <div class="col-3" style="padding-left:15px;">
                              <h6><b>Definitiva:</b></h6>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <label><p>{{$n->desem}}</p></label>
                            </div>
                            <div class="col-3">
                              <label><p>{{$n->definitiva}}</p></label>
                            </div>
                        </div>
                </div>
             @endforeach
       <!--end table--->
      </div>
    </div>
  </div>
</div>
<!--end collapsed-->
@endsection