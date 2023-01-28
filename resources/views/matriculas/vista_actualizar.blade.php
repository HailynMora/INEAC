@extends('usuario.principa_usul')
@section('content')
 <!--texto matriculas bachillerato-->
 <div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
  <h3 class="letra1">Actualizar matrícula</h3>
</div>
<br>
        <div class="container-fluid">
            <!---Mensaje-->
            @if(Session::has('validacion'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('validacion')}}
                </div>
            @endif
            <!-- end mensaje-->
            <!---Mensaje-->
            @if(Session::has('aceptado'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('aceptado')}}
                </div>
            @endif
            <!-- end mensaje-->
        <div class="row alerta">
            <div class="col-md-12" style="background-color:#e3e3e3;">
                <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-book-reader" style="color:#FFC300;"></i> Datos del estudiante</b></h4>
                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <label><h5><b><i class="fas fa-address-card" style="color:#FFC300;"></i>&nbsp Número de documento</b></h5></label><br>
                    <h5> {{$bachi[0]->num_doc}} </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b><i class="fas fa-user" style="color:#FFC300;"></i>&nbsp Nombre</b></h5></label><br>
                    <h5> {{$bachi[0]->nombre}} {{$bachi[0]->segundonom}} {{$bachi[0]->primerape}} {{$bachi[0]->segundoape}}  </h5>
                    </div>
                    <div class="col-md-4">
                    <label><h5><b> <i class="fas fa-envelope" style="color:#FFC300;"></i>&nbsp Correo </b></h5></label><br>
                    <h5>{{$bachi[0]->correo}}</h5>
                    </div>
                </div>
            </div>
                <br>
            </div>
        </div>
        </div>

        <br>
        <div class="container-fluid">
        <div class="row alerta">
            <div class="col-md-12" style="background-color:#e3e3e3;">
                <div class="col-md-12">
                    <br>
                <form action="{{route('actualizar_matricula_bachi')}}" method="post">
                            @csrf  
                                <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-calendar-alt" style="color:#FFC300;"></i> Periodo Académico</b></h4>
                                <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
                                <div class="row">
                                    <div class="col-md-3">
                                       <label for="exampleFormControlSelect1">Curso</label>
                                        <select class="form-control" id="curso" name="curso">
                                            <option value="{{$bachi[0]->idcurso}}">{{$bachi[0]->curso}}</option>  
                                            @foreach($cursos as $c)
                                            <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                            @endforeach                
                                            </select>
                                    </div>
                                   <div class="form-group col-md-3">
                                   <label for="exampleFormControlSelect1">Fecha</label>
                                      <input type="date" class="form-control" name="fecha" id="fecha" required value="{{date('Y-m-d', strtotime($bachi[0]->fec_matricula))}}">
                                    </div>
                                        <!--###############-->
                                   
                                    <div class="form-group col-md-3">
                                            <label for="exampleFormControlSelect1">Año</label>
                                            <input type="text"  class="form-control" name="anioba" id="anioba" value="{{$bachi[0]->anio}}">
                                        </div>
                                   
                                    <!---#############--->
                                    <!--###############-->
                                    
                                    <div class="form-group col-md-3">
                                            <label for="exampleFormControlSelect1">Periodo</label>
                                            <select class="form-control" id="perbachiller" name="perbachiller">
                                            <option value="{{$bachi[0]->periodo}}">{{$bachi[0]->periodo}}</option>
                                            <option value="A">A</option>  
                                            <option value="B">B</option>                    
                                            </select>
                                        </div>
                                   
                                    <!---#############--->
                                </div>
                            
                               <input type="text" id="idmat" name="idmat" value="{{$bachi[0]->idmat}}" hidden>
                            <br>
                            <div class="form-group col-md-12 text-center">
                                <br>
                                <div class="form-group col-md-12 modal-footer">
                                    <a href="/admin/reporte/estudiante" id="cancelar" type="button" class="btn btn-danger" >Salir</a>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                        
                                </div>
                            </div>
                            
                                                    
                </form>
                <!---end informacion-->
            </div>
            </div>
        </div>
        </div>
  <!---end matriculas bachillerato-->
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