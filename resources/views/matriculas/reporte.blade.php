@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Estudiantes Matriculados a Programas</h3>
</div>
<!----collapse--->
    <div class="accordion letraf" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0">
        
            <div class="row">
                <div class="col-12">
                 <a class="btn btn-link btn-block text-left" type="button">
                    <i class="fas fa-file-alt fa-lg"></i>&nbsp;Reporte
                 </a>
                </div>
            </div>
           
        </h2>
        </div>

        <div id="collapseOne letraf" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
        <!--tabla-->
        <div class="container">
            <table class="table">
                <thead style="background-color:#0f468e;color: #ffffff;">
                    <tr>
                    <th scope="col">Código Programa</th>
                    <th scope="col">Programa</th>
                    <th scope="col">Estudiantes</th>
                    <th scope="col">Notas</th>
                    </tr>
                </thead>
                <tbody style="background-color:#e3e3e3;">
                    @foreach ($mat as $m)
                <tr>
                    <td>{{$m->codigo}}</td>
                    <td>{{$m->nomcurso}}</td>
                    <td>
                     <!-- Button trigger modal -->
                        <a type="button" class="btn" data-toggle="modal" data-target="#staticBackdrop{{$m->idcur}}">
                          <i class="fas fa-file-excel fa-lg" style="color:green;font-size: 25px;"></i>
                        </a>
                         
                        <form action="{{route('filtrarper')}}" id="formudatos" method="post">
                         @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{$m->idcur}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header" style="background-color:#FFC107; color:white;">
                                <h5 class="modal-title" id="staticBackdropLabel">Seleccione el año y el periodo académico</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <!---formulario-->
            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Periodo Académico</label>
                                        <select id="periodo" class="form-control" name="periodo">
                                            <option selected>Elegir...</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Año</label>
                                        <select id="anio" class="form-control" name="anio">
                                               <option selected>Elegir...</option>
                                                @foreach($res as $a)
                                                <option value="{{$a->anio}}">{{$a->anio}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <input type="text" name="idc" id="idc" value="{{$m->idcur}}" hidden>
                            <!---end formulario-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal" style="background-color:#FFBD03; color:white;">Salir</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!--end modal-->
                       </form>
                
                   </td>
                   <td>
                    <!--aqui modal de reporte de notas-->
                    <a type="button" class="btn" data-toggle="modal" data-target="#modalnotas{{$m->idcur}}">
                          <i class="fas fa-file-excel fa-lg" style="color:blue;font-size: 25px;"></i>
                    </a>
                    <form action="{{route('filtrarNotasSec')}}" id="formudatos" method="post">
                         @csrf
                        <!-- Modal -->
                        <div class="modal fade" id="modalnotas{{$m->idcur}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header" style="background-color:#FFC107; color:white;">
                                <h5 class="modal-title" id="staticBackdropLabel">Seleccione el año y el periodo académico</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <!---formulario-->
            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Periodo Académico</label>
                                        <select id="pernot" class="form-control" name="pernot">
                                            <option selected>Elegir...</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Año</label>
                                        <select id="anionot" class="form-control" name="anionot">
                                               <option selected>Elegir...</option>
                                                @foreach($res as $a)
                                                <option value="{{$a->anio}}">{{$a->anio}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Asignatura</label>
                                        <select id="asig" class="form-control" name="asig">
                                               <option selected>Elegir...</option>
                                                @foreach($asig as $asi)
                                                @if(isset($asi->idasig))
                                                 <option value="{{$asi->idasig}}">{{$asi->nombre}}</option>
                                                @endif
                                                @endforeach
                                        </select>
                                    </div>
                                    <input type="text" name="idcur" id="idcur" value="{{$m->idcur}}" hidden>
                            <!---end formulario-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal" style="background-color:#FFBD03; color:white;">Salir</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!--end modal-->
                       </form>
                    <!--end modal-->
                   </td>
                   <!-- <td><a href="/reporte/estudiantes/bachillerato/{{$m->idcur}}" class="btn"  style="background-color:#00FFFF;"><i class="fas fa-file-excel fa-lg" style="background-color:#FBFF00;"></i></button></a>-->
                </tr>
                @endforeach
                @foreach ($matec as $ma)
                <tr>
                    <!--<td>{{$ma->idtec}}</td>-->
                   
                    <td>{{$ma->codigotec}}</td>
                    <td>{{$ma->nombretec}}</td> 
                    <td>
                        <a type="button" class="btn" data-toggle="modal" data-target="#modaltec{{$ma->idtec}}">
                            <i class="fas fa-file-excel fa-lg" style="color:green;font-size: 25px;"></i>
                        </a>
                        <!--modal -->
                            <form action="{{route('filtrartecnicos')}}"  method="post">
                            @csrf
                            <!-- Modal -->
                            <div class="modal fade" id="modaltec{{$ma->idtec}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header" style="background-color:#28F8FF;">
                                    <h5 class="modal-title" id="staticBackdropLabel">Seleccione el año y el trimestre académico</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <!---formulario-->

                                      <div class="form-group">
                                            <label for="exampleInputPassword1">Trimestre</label>
                                            <select id="tri" class="form-control" name="tri">
                                                <option selected>Elegir...</option>
                                                    @foreach($trimestre as $t)
                                                    <option value="{{$t->id}}">{{$t->nombre}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Periodo Académico</label>
                                            <select id="periodo" class="form-control" name="periodo">
                                                <option selected>Elegir...</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Año</label>
                                            <select id="anio" class="form-control" name="anio">
                                                <option selected>Elegir...</option>
                                                    @foreach($resanio as $an)
                                                    <option value="{{$an->anio}}">{{$an->anio}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <input type="text" name="idtecni" id="idctecni" value="{{$ma->idtec}}" hidden>
                                <!---end formulario-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal" style="background-color:#FFBD03; color:white;">Salir</button>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                            <!--end modal-->
                        </form>

                        <!--end -modal-->
                </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
           
        <!--end table-->
        </div>
        </div>
    </div>
    </div>
<!---end collapse--->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection