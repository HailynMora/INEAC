@extends('usuario.principa_usul')
@section('content')
<div class="alert  text-center"  role="alert" style="background-color: #ffc107; color:#ffffff;">
  <h3 class="letra1"> Listado De Estudiantes De Técnico </h3>
</div>
<br>
   <div class="table-responsive">
    <table class="table">
        <thead style="background-color:#0f468e; color:#ffffff" class="alerta">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo Doc</th>
            <th scope="col">No Documento</th>
            <th scope="col">Estado</th>
            <th scope="col">Curso</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1" style="background-color:#e3e3e3;" class="letraf">
        <?php
        $con =1;
        ?>
        @foreach($datos as $e)
        @if(isset($e->idest))
        <tr style="background-color: #E3E3E3;">
        <td>{{$con++}}</td>
        <td>{{$e->primernom}} {{$e->segnom}}</td> 
        <td>{{$e->priape}} {{$e->segape}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->telefono}}</td>
        <td>{{$e->nombretec}}</td>
        <td>
            <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $e->idest;?>" data-placement="bottom"  title="Ver Estudiante">
                    <img src="{{asset('dist/img/card.png')}}" class="img-fluid" ></a>
                    <!-- Modal -->
                    <div class="modal fade" id="estudiante<?php echo $e->idest;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header alert" style="background-color:#0f468e; color:#ffffff;">
                            <h5 class="modal-title" id="staticBackdropLabel">
                        
                            Datos Estudiante: {{$e->primernom}} {{$e->segnom}} {{$e->priape}} {{$e->segape}}
                        
                        </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!---Mostrar datos--> 
                        <h4 class="text-centers">Datos Personales</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><b>Tipo Identificacion</b></div>
                            <div class="col-md-3 ml-auto">{{$e->tdoces}}</div>
                            <div class="col-md-3"><b>Número</b></div>
                            <div class="col-md-3 ml-auto">{{$e->num_doc}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Dpt Expedición</b></div>
                            <div class="col-md-3 ml-auto">{{$e->dpt_expedicion}}</div>
                            <div class="col-md-3"><b>Mpio. Expedición</b></div>
                            <div class="col-md-3 ml-auto">{{$e->mun_expedicion}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Genero</b></div>
                            <div class="col-md-3 ml-auto">{{$e->generoestu}}</div>
                            <div class="col-md-3"><b>Fecha Nac</b></div>
                            <div class="col-md-3 ml-auto">{{$e->fecnacimiento}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Dpt Nacimiento</b></div>
                            <div class="col-md-3 ml-auto">{{$e->dpt_nacimiento}}</div>
                            <div class="col-md-3"><b>Mpio. Nacimiento</b></div>
                            <div class="col-md-3 ml-auto">{{$e->mun_nacimiento}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Primer Apellido</b></div>
                            <div class="col-md-3 ml-auto">{{$e->priape}}</div>
                            <div class="col-md-3"><b>Segundo Apellido</b></div>
                            <div class="col-md-3 ml-auto">{{$e->segape}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Primer Nombre</b></div>
                            <div class="col-md-3 ml-auto">{{$e->primernom}}</div>
                            <div class="col-md-3"><b>Segundo Nombre</b></div>
                            <div class="col-md-3 ml-auto">{{$e->segnom }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Dir. Residencia</b></div>
                            <div class="col-md-3 ml-auto">{{$e->dirresidencia}}</div>
                            <div class="col-md-3"><b>Barrio</b></div>
                            <div class="col-md-3 ml-auto">{{$e->barrio}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Dpt. Residencia</b></div>
                            <div class="col-md-3 ml-auto">{{$e->dptresidencia}}</div>
                            <div class="col-md-3"><b>Mpio. Residencia</b></div>
                            <div class="col-md-3 ml-auto">{{$e->munresidencia}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Zona</b></div>
                            <div class="col-md-3 ml-auto">{{$e->zona}}</div>
                            <div class="col-md-3"><b>Telefono/Celular</b></div>
                            <div class="col-md-3 ml-auto">{{$e->telefono}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Estrato</b></div>
                            <div class="col-md-3 ml-auto">{{$e->estrato}}</div>
                            <div class="col-md-3"><b>Tipo Sangre</b></div>
                            <div class="col-md-3 ml-auto">{{$e->tiposangre}}</div>
                        </div>
                        <!--end mostrar datos-->
                        <!---#########################################sistema salud----->
                        <br>
                        <hr>
                            <h4 class="text-centers">Sistema De Salud</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><b>Regimen Salud</b></div>
                            <div class="col-md-3 ml-auto">{{$e->regimen}}</div>
                            <div class="col-md-3"><b>Carnet/EPS</b></div>
                            <div class="col-md-3 ml-auto">{{$e->eps}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Nivel Formación</b></div>
                            <div class="col-md-3 ml-auto">{{$e->nivelformacion}}</div>
                            <div class="col-md-3"><b>Ocupación</b></div>
                            <div class="col-md-3 ml-auto">{{$e->ocupacion}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Discapacidad</b></div>
                            <div class="col-md-3 ml-auto">{{$e->discapacidad}}</div>
                            <div class="col-md-3"><b>Multiculturidad</b></div>
                            <div class="col-md-3 ml-auto">{{$e->etniades}}</div>
                        </div>
                        <!--#####################fin sistema salud---->
                        <!--#############Datos del acudiente-->
                        <br>
                        <hr>
                            <h4 class="text-centers">Datos De Padre Y/O Acudiente</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><b>Tipo Identificacion</b></div>
                            <div class="col-md-3 ml-auto">{{$e->tdocacu}}</div>
                            <div class="col-md-3"><b>Número</b></div>
                            <div class="col-md-3 ml-auto">{{$e->numacu}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Nombres y Apellido</b></div>
                            <div class="col-md-3 ml-auto">{{$e->nomacu}}</div>
                            <div class="col-md-3"><b>Parentesco</b></div>
                            <div class="col-md-3 ml-auto">{{$e->paren}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>Dirección Residencia</b></div>
                            <div class="col-md-3 ml-auto">{{$e->diracu}}</div>
                            <div class="col-md-3"><b>Telefono/Celular</b></div>
                            <div class="col-md-3 ml-auto">{{$e->telacu}}</div>
                        </div>
                        <!---############End Datos Acudiente-->
                        <br>
                        <hr>
                            <h4 class="text-centers">Datos Del Programa</h4> 
                            <div class="row">
                            <div class="col-md-3"><b>Curso</b></div>
                            <div class="col-md-3 ml-auto">{{$e->nombretec}}</div>
                            <div class="col-md-3"><b>Trimestre</b></div>
                            <div class="col-md-3 ml-auto">{{$e->nombretri}}</div>
                            </div>
                            <div class="row">
                            <div class="col-md-3"><b>Año</b></div>
                            <div class="col-md-3 ml-auto">{{$e->anio}}</div>
                            <div class="col-md-3"><b>Periodo</b></div>
                            <div class="col-md-3 ml-auto">{{$e->periodo}}</div>
                            </div>
                        <hr>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                        </div>
                        </div>
                    </div>
                    </div>
                        <!--Datos estuidnate ajax mostrar-->
                    <!-- Button trigger modal -->
      
        </td>
        </tr>
        @endif
        @endforeach
        </tbody>
        <!---respuesta de ajax-->
        <tbody id="tabla2"   style="background-color:#e3e3e3;" class="letraf">

        </tbody>
        <!--end respuesta-->
    </table>
</div>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
      </div>
      <div class="col-md-4">
     @if(isset($datos[0]->idest))
      {{ $datos->links() }}
     @endif
      </div>
      <div class="col-md-2 alerta">
        <h2 class="mb-0">
          <a class="btn btn-link float-right" type="button" href="/visualizar/estudiante">
          <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> <span class="alerta">Volver</span>
          </a>
        </h2>
      </div>
    </div>
   
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#formu').submit(function(e){
    e.preventDefault();
    var idtec=$('#idtec').val();
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('estutec')}}",
      type: "POST",
      data:{
        idtec:idtec,
        _token:_token,
      }
    }).done(function(response){
      var ar = JSON.parse(response);
      $("#tabla1").hide();
      $("#tabla2").empty();
      if(ar.length!=0){

        var conta=0;
        for(var i=0; i<ar.length; i++){
        
          if(ar[i].aprobado != "Retirado"){
            conta++;
            var respuesta = '<tr>' +
            '<td>' +  conta + '</td>' +
            '<td>' +  ar[i].nombre + ' '+ar[i].segundonom +'</td>' +
            '<td>' +  ar[i].primerape + ' ' +  ar[i].segundoape  +'</td>' +
            '<td>' +  ar[i].destipo  + '</td>' +
            '<td>' +  ar[i].num_doc  + '</td>' +
            '<td>' +  ar[i].aprobado + '</td>' +
            '<td>' +  ar[i].nombretec + '</td>' +
            '<td>' +'<a href="/generar/certificado/estudiantil_tec/'+ ar[i].id +'"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Certificados"><i class="nav-icon fas fa-book" style="color:  #e1b308; font-size:20px;" ></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>'
              + '<a href="/matricula/estudiante/actualizar/' + ar[i].id + '" type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>'+ 
                '<a type="button" data-toggle="modal" data-target="#cambiar'+ ar[i].id +'"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red; font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>'+
               ' <div class="modal fade" id="cambiar'+ ar[i].id +'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
              '<div class="modal-dialog" role="document">'+
               ' <div class="modal-content">'+
                 '<div class="modal-header" style="background-color:FFC107; color:#ffffff;!important;">'+
                    '<h4 class="modal-title text-center" style=" text-align: center;">'+
                     '<div id="nomdoc" class="reset"></div>'+
                    '</h4>'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                      '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                  '</div>'+
                  '<div class="modal-body mt-2 text-center">'+
                    '<strong style="text-align: center !important">'+
                      '<h4 class="modal-title text-center" style=" text-align: center;">'+
                        '<span>¿Desea retirar al estudiante:&nbsp;'+ar[i].nombre+ ' '+ar[i].primerape+'? </span>'+
                      '</h4>'+
                    '</strong>'+
                  '</div>'+
                  '<div class="modal-footer">'+
                    '<form action="/cambiar/estado/matricula" method="GET">'+
                     '@csrf'+
                    '<input id="idestudiante" name="idestudiante" value="'+ ar[i].id +'" hidden>'+ 
                    '<button type="submit" class="btn btn-success">Cambiar</button>&nbsp;&nbsp;'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>'+
                     '</form>'+
                  '</div>'+
                '</div>'+
              '</div>'+
           '</div>'+
            '</td>' +//agregar los botones
            '</tr>';
          
              $('#tabla2').append(respuesta);
          }else{
            
          }
         
        }
  

      }else{
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $("#tabla1").show();

      }    
    })
  });
</script>
@endsection