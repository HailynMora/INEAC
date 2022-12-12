@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center"  role="alert" style="background-color:#ffc107;color: #ffffff;">
  <h3 class="letra1"> Matrícula Estudiante</h3>
</div>
<!--mensajes-->
       <!---Mensaje-->
           @if(Session::has('validacion'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('validacion')}}
                </div>
            @endif
            <!-- end mensaje-->
            <!---Mensaje-->
            @if(Session::has('matec'))
                <div class="alert alert-dismissible" role="alert" style="background-color:#8BF4E4;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('matec')}}
                </div>
            @endif
            <!-- end mensaje-->
<!--navs de matricula bachillerato y matricula tecnicos-->

<nav>
  <div class="nav nav-tabs letraf" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="font-size: 120%;">&nbsp;Bachillerato</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="font-size: 120%;">&nbsp;Técnicos</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <!--texto matriculas bachillerato-->
  <br>
        <div class="container-fluid letraf">
        <div class="row">
            <div class="col-md-12" style="background-color:#e3e3e3;">
                <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-book-reader" style="color:#FFC300;"></i> Datos Estudiante</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <label><h5><b><i class="fas fa-address-card" style="color:#FFC300;"></i>&nbsp Número de Documento</b></h5></label><br>
                    <h5> {{$estu->num_doc}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b><i class="fas fa-user" style="color:#FFC300;"></i>&nbsp Nombre</b></h5></label><br>
                    <h5> {{$estu->first_nom}} {{$estu->second_nom}} {{$estu->firts_ape}} {{$estu->second_ape}}  </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b> <i class="fas fa-envelope" style="color:#FFC300;"></i>&nbsp Correo </b></h5></label><br>
                    <h5>{{$estu->correo}}</h5>
                    </div>
                </div>
            </div>
                <br>
            </div>
        </div>
        </div>

        <br>
        <div class="container-fluid letraf">
        <div class="row">
            <div class="col-md-12" style="background-color:#e3e3e3;">
            <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-search" style="color:#FFC300;"></i>&nbsp;Seleccionar Curso</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                <div class="col-md-12">
                <form action="{{route('regmatricula')}}" method="post">
                            @csrf
                            <div class="container-fluid">
                               <!--cursos-->
                               <div  class="col-md-12">
                                  <div class="form-group">
                                        <select class="form-control" id="cur" name="cur">
                                        <option >Elegir ...</option>
                                        @foreach($bach as $bachi)
                                            @if(isset($bachi->idbachi))
                                            <option value="{{$bachi->idbachi}}">{{$bachi->curso}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end cursos-->
                                </div><!--retorna la informacion-->  
                                <label for="fec_vinculacion"><h4><b><i class="fas fa-calendar-alt" style="color:#FFC300;"></i>&nbsp;Periodo Académico</b></h4></label>
                                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                                <div class="row">
                                   <div class="form-group col-md-4">
                                   <label for="exampleFormControlSelect1">Fecha</label>
                                      <input type="date" class="form-control" name="fecha" id="fecha" required>
                                    </div>
                                        <!--###############-->
                                   
                                    <div class="form-group col-md-4">
                                            <label for="exampleFormControlSelect1">Año</label>
                                            <input type="text"  class="form-control" name="anioba" id="anioba" value="{{$anio}}">
                                        </div>
                                   
                                    <!---#############--->
                                    <!--###############-->
                                    
                                    <div class="form-group col-md-4">
                                            <label for="exampleFormControlSelect1">Periodo</label>
                                            <select class="form-control" id="perbachiller" name="perbachiller">
                                            <option active>Elegir ...</option>
                                            <option value="A">A</option>  
                                            <option value="B">B</option>                    
                                            </select>
                                        </div>
                                   
                                    <!---#############--->
                                </div>
                            
                               <input type="text" id="estu" name="estu" value="{{$estu->id}}" hidden>
                            <br>
                            <div class="form-group col-md-12 text-center">
                                <a href="/visualizar/estudiante" type="button" class="btn btn-warning">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Matricular</button>
                                <a id="listado" type="button" class="btn btn-success">Visualizar</a> 
                            </div>
                            
                                                    
                </form>
                <!---end informacion-->
            </div>
            </div>
        </div>
        </div>


  <!---end matriculas bachillerato-->

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
   <!---matriculas tecnicos-->
   <br>
        <div class="container-fluid letraf">
     
        <div class="row">
            <div class="col-md-12" style="background-color:#e3e3e3;">
                <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-book-reader" style="color:#3843D0;"></i> Datos Estudiante</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <label><h5><b><i class="fas fa-address-card" style="color:#3843D0;"></i>&nbsp Número de Documento</b></h5></label><br>
                    <h5> {{$estu->num_doc}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b><i class="fas fa-user" style="color:#3843D0;"></i>&nbsp Nombre</b></h5></label><br>
                    <h5> {{$estu->first_nom}} {{$estu->second_nom}} {{$estu->firts_ape}} {{$estu->second_ape}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b> <i class="fas fa-envelope" style="color:#3843D0;"></i>&nbsp Correo </b></h5></label><br>
                    <h5>{{$estu->correo}}</h5>
                    </div>
                </div>
            </div>
                <br>
            </div>
        </div>
        </div>

        <br>
        <div class="container-fluid letraf">
        <div class="row">
            <div class="col-md-12" style="background-color:#e3e3e3;">
            <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-search" style="color:#3843D0;"></i> Seleccionar Programa</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                <form id="formtec" action="{{route('matriculatecnico')}}" method="post">
                            @csrf
                            <div class="container-fluid row">
                                <div  class="col-md-4">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Elegir Curso</label>
                                        <select class="form-control" id="programatec" name="programatec">
                                        <option >Elegir ...</option>
                                        @foreach($prog as $pro)
                                        <option value="{{$pro->idtec}}">{{$pro->nombretec}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--###############-->
                                <div  class="col-md-4">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Trimestre</label>
                                        <select class="form-control" id="tri" name="tri">
                                        <option >Elegir ...</option>
                                        @foreach($tri as $t)
                                        <option value="{{$t->id}}">{{$t->nombretri}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!---#############--->
                                  <!--###############-->
                                  <div  class="col-md-2">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Año</label>
                                        <input type="text"  class="form-control" name="anio" id="anio" value="{{$anio}}">
                                    </div>
                                </div>
                                <!---#############--->
                                 <!--###############-->
                                 <div  class="col-md-2">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Periodo</label>
                                        <select class="form-control" id="per" name="per">
                                        <option active>Elegir ...</option>
                                        <option value="A">A</option>  
                                        <option value="B">B</option>     
                                        <option value="C">C</option> 
                                        <option value="D">D</option>                
                                        </select>
                                    </div>
                                </div>
                                <!---#############--->
                                   <br>
                                </div><!--retorna la informacion-->  
                                <br>
                                <label for="fec_vinculacion"><h4><b><i class="fas fa-calendar-alt" style="color:#3843D0;"></i> Fecha Matricula</b></h4></label>
                                     <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                                <div class="form-group col-md-4">
                                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                                </div>
                                    <input type="text" id="estu" name="estu" value="{{$estu->id}}" hidden>
                                <br>
                                <div class="form-group col-md-12 text-center">
                                    <a href="/visualizar/estudiante" id="cancelar" type="button" class="btn btn-warning">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Matricular</button>
                                    <a  href="{{route('listado_tecnico')}}" id="listado" type="button" class="btn btn-success">Visualizar</a>                                       
                                </div>
                            
                                                    
                </form>
                <!---end informacion-->
            </div>
          </div>
        </div>


   <!---end matriculas tecnicos-->
  </div>
</div>
<!--end navs matriculas--->


<!--</form>-->
<!--aqui ajax-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <script>
            let b=document.getElementById('listado');
            b.addEventListener('click',function (event) {
            event.preventDefault(); //esto cancela el comportamiento del click
            setTimeout(()=> location.href="{{route('listadomatricula')}}");
            });
        </script>
       <!--https://www.fucsalud.edu.co/themes/custom/fucs/Manua-Academusoft-Docente/contenidos1.html-->
@endsection