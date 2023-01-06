@extends('usuario.principa_usul')
@section('content')

@if(Session::has('actualizar'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('actualizar')}}
                </div>
 @endif
<div class="container-fluid">
            <!-- end mensaje-->
            <!---Mensaje-->
            <!-- end mensaje-->
        <div class="row alerta">
            <div class="col-md-12" style="background-color:#e3e3e3;">
                <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-book-reader" style="color:#3843D0;"></i> Datos Estudiante</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <label><h5><b><i class="fas fa-address-card" style="color:#3843D0;"></i>&nbsp Número de Documento</b></h5></label><br>
                    <h5> {{$tecmat[0]->num_doc}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b><i class="fas fa-user" style="color:#3843D0;"></i>&nbsp Nombre</b></h5></label><br>
                    <h5> {{$tecmat[0]->nombre}} {{$tecmat[0]->segundonom}} {{$tecmat[0]->primerape}} {{$tecmat[0]->segundoape}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b> <i class="fas fa-envelope" style="color:#3843D0;"></i>&nbsp Correo </b></h5></label><br>
                    <h5>{{$tecmat[0]->correo}}</h5>
                    </div>
                </div>
            </div>
                <br>
            </div>
        </div>
        </div>

        <br>
        <div class="container-fluid alerta">
        <div class="row">
            <div class="col-md-12" style="background-color:#e3e3e3;">
            <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-search" style="color:#3843D0;"></i> Seleccionar Programa</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                <form id="formtec" action="{{route('actualizar_matricula_tecnico')}}" method="post">
                            @csrf
                            <div class="container-fluid row">
                                <div  class="col-md-4">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Elegir Técnico</label>
                                        <select class="form-control" id="programatec" name="programatec">
                                        <option value="{{$tecmat[0]->idtec}}" >{{$tecmat[0]->nombretec}}</option>
                                        @foreach($progtec as $pro)
                                        <option value="{{$pro->id}}">{{$pro->nombretec}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--###############-->
                                <div  class="col-md-4">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Trimestre</label>
                                        <select class="form-control" id="tri" name="tri">
                                        <option value="{{$tecmat[0]->idtri}}">{{$tecmat[0]->nombretri}}</option>
                                        @foreach($trimestre as $t)
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
                                        <input type="text"  class="form-control" name="anio" id="anio" value="{{$tecmat[0]->anio}}">
                                    </div>
                                </div>
                                <!---#############--->
                                 <!--###############-->
                                 <div  class="col-md-2">
                                  <div class="form-group">
                                        <label for="exampleFormControlSelect1">Periodo</label>
                                        <select class="form-control" id="per" name="per">
                                        <option active value="{{$tecmat[0]->periodo}}" >{{$tecmat[0]->periodo}}</option>
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
                                <label for="fec_vinculacion"><h4><b><i class="fas fa-calendar-alt" style="color:#3843D0;"></i> Fecha Matrícula</b></h4></label>
                                     <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                                <div class="form-group col-md-4">
                                        <input type="date" class="form-control" name="fecha" id="fecha" value="{{date('Y-m-d', strtotime($tecmat[0]->fec_matricula))}}" required>
                                </div>
                                <input type="text" class="form-control" name="idmat" id="idmat" value="{{$tecmat[0]->id}}" hidden>
                                <br>
                                <div class="form-group col-md-12 text-center">
                                    <a href="/listado/matricula/tecnico" id="cancelar" type="button" class="btn" style="background-color:#FED615; color:white;">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                        
                                </div>
                            
                                                    
                </form>
                <!---end informacion-->
            </div>
          </div>
        </div>


   <!---end matriculas tecnicos-->
<script>
    //validar fecha
      /* Esperamos a la carga del DOM */
      window.addEventListener('DOMContentLoaded', (evento) => {
        /* Obtenemos la fecha de hoy en formato ISO */
        const hoy_fecha = new Date().toISOString().substring(0, 10);
        /* Buscamos la etiqueta, ya sea por ID (que no tiene) o por su selector */
        document.querySelector("input[name='fecha']").max = hoy_fecha;
    });

</script>
@endsection