@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado de Estudiantes</h3>
</div>
<a href="{{route('registro_es')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
<form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
  @csrf
  <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
  <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
</form>
<br><br>
<div class="container">

<table class="table table-striped"style="background-color:#FFCC00;">
       <thead>
        <tr>
        <th scope="col">N° Identificacion</th>
        <th scope="col">Nombre</th>
        <th scope="col" >Telefono</th>
        <th scope="col" class="d-none d-lg-block ">Correo</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="tabla1">
    @if($b == 1)<!--valida si hay datos los imprime-->
      @foreach($estudiante as $d)
        <tr class="table-success"style="background-color: #dcedc8;">
        <td>{{$d->num_doc}}</td>
        <td>{{$d->first_nom }} {{$d->second_nom}} {{$d->firts_ape}} {{$d->second_ape}}</td>
        <td>{{$d->telefono}}</td>
        <td  class="d-none d-lg-block">{{$d->correo}}</td>
        <td>{{$d->estadoes}}</td>
        <td><!-- Button trigger modal -->
                <a href="{{route('actualizar_est',$d->id)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
                <a href="{{route('matricularadmin', $d->id)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Matricular Estudiante"><i class="fas fa-user-plus" style="color:#6D6D6D;"></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>" data-placement="bottom"  title="Ver Estudiante">
                <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
                 &nbsp&nbsp
                <?php
                if($d->estadoes == 'Activo'){
                    ?>
                    <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}" data-placement="bottom"  title="Deshabilitar Estudiante"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                    <?php
                }else{
                    ?>
                    <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Habilitar Estudiante"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                    <?php
                }
                ?>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="staticBackdropLabel">
                       
                          Datos Estudiante: {{$d->first_nom }} {{$d->second_nom}} {{$d->firts_ape}} {{$d->second_ape}}
                       
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
                        <div class="col-md-3">Tipo Identificacion</div>
                        <div class="col-md-3 ml-auto">{{$d->tdoces}}</div>
                        <div class="col-md-3">Número</div>
                        <div class="col-md-3 ml-auto">{{$d->num_doc}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Dpt Expedición</div>
                        <div class="col-md-3 ml-auto">{{$d->dpt_expedicion}}</div>
                        <div class="col-md-3">Mpio. Expedición</div>
                        <div class="col-md-3 ml-auto">{{$d->mun_expedicion}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Genero</div>
                        <div class="col-md-3 ml-auto">{{$d->generoestu}}</div>
                        <div class="col-md-3">Fecha Nac</div>
                        <div class="col-md-3 ml-auto">{{$d->fecnacimiento}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Dpt Nacimiento</div>
                        <div class="col-md-3 ml-auto">{{$d->dpt_nacimiento}}</div>
                        <div class="col-md-3">Mpio. Nacimiento</div>
                        <div class="col-md-3 ml-auto">{{$d->mun_nacimiento}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Primer Apellido</div>
                        <div class="col-md-3 ml-auto">{{$d->firts_ape}}</div>
                        <div class="col-md-3">Segundo Apellido</div>
                        <div class="col-md-3 ml-auto">{{$d->second_ape}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Primer Nombre</div>
                        <div class="col-md-3 ml-auto">{{$d->first_nom}}</div>
                        <div class="col-md-3">Segundo Nombre</div>
                        <div class="col-md-3 ml-auto">{{$d->second_nom}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Dir. Residencia</div>
                        <div class="col-md-3 ml-auto">{{$d->dirresidencia}}</div>
                        <div class="col-md-3">Barrio</div>
                        <div class="col-md-3 ml-auto">{{$d->barrio}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Dpt. Residencia</div>
                        <div class="col-md-3 ml-auto">{{$d->dptresidencia}}</div>
                        <div class="col-md-3">Mpio. Residencia</div>
                        <div class="col-md-3 ml-auto">{{$d->munresidencia}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Zona</div>
                        <div class="col-md-3 ml-auto">{{$d->zona}}</div>
                        <div class="col-md-3">Telefono/Celular</div>
                        <div class="col-md-3 ml-auto">{{$d->telefono}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Estrato</div>
                        <div class="col-md-3 ml-auto">{{$d->estrato}}</div>
                        <div class="col-md-3">Tipo Sangre</div>
                        <div class="col-md-3 ml-auto">{{$d->tiposangre}}</div>
                    </div>
                    <!--end mostrar datos-->
                    <!---#########################################sistema salud----->
                     <br>
                      <hr>
                        <h4 class="text-centers">Sistema De Salud</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">Regimen Salud</div>
                        <div class="col-md-3 ml-auto">{{$d->regimen}}</div>
                        <div class="col-md-3">Carnet/EPS</div>
                        <div class="col-md-3 ml-auto">{{$d->eps}}</div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">Nivel Formación</div>
                        <div class="col-md-3 ml-auto">{{$d->nivelformacion}}</div>
                        <div class="col-md-3">Ocupación</div>
                        <div class="col-md-3 ml-auto">{{$d->ocupacion}}</div>
                     </div>
                     <div class="row">
                        <div class="col-md-3">Discapacidad</div>
                        <div class="col-md-3 ml-auto">{{$d->discapacidad}}</div>
                        <div class="col-md-3">Multiculturidad</div>
                        <div class="col-md-3 ml-auto">{{$d->etniades}}</div>
                     </div>
                    <!--#####################fin sistema salud---->
                    <!--#############Datos del acudiente-->
                      <br>
                      <hr>
                        <h4 class="text-centers">Datos De Padre Y/O Acudiente</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">Tipo Identificacion</div>
                        <div class="col-md-3 ml-auto">{{$d->tdocacu}}</div>
                        <div class="col-md-3">Número</div>
                        <div class="col-md-3 ml-auto">{{$d->numacu}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">Nombres y Apellido</div>
                        <div class="col-md-3 ml-auto">{{$d->nomacu}}</div>
                        <div class="col-md-3">Parentesco</div>
                        <div class="col-md-3 ml-auto">{{$d->paren}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">Dirección Residencia</div>
                        <div class="col-md-3 ml-auto">{{$d->diracu}}</div>
                        <div class="col-md-3">Telefono/Celular</div>
                        <div class="col-md-3 ml-auto">{{$d->telacu}}</div>
                      </div>
                    <!---############End Datos Acudiente-->
                    <br>
                      <hr>
                        <h4 class="text-centers">Datos Del Programa</h4>
                      <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Ventana modal para cambiar -->
                <div class="modal fade" id="cambiarEstado{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #283593 !important; color:white;">
                        <h4 class="modal-title text-center" style=" text-align: center;">
                            <span>ESTUDIANTE: {{$d->first_nom }} {{$d->second_nom}} {{$d->firts_ape}} {{$d->second_ape}} </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                        </div>
                        <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                            <h4 class="modal-title text-center" style=" text-align: center;">
                            <span>¿Cambiar el estado {{$d->estadoes}} del Estudiante? </span>
                            </h4>
                        </strong>
                        </div>
                        <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarEstad', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    </div>
                </div>
                    <!---fin ventana cambiar--->
        </td>
        </tr>
        
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
               No Hay Registros
            </div>
        @endif
    </tbody>
    <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
</div>
 <!--finalizar Tabla de informacion-->
 <!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    console.log(nombre);
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('buscarest')}}",
      type: "POST",
      data:{
        nombre:nombre,
        _token:_token
      }, 
      error:function(jqXHR, response){
        if(jqXHR.status==422){
          toastr.warning('No hay registros!.', 'Nueva busqueda!', {timeOut:3000});
        }
     }
    }).done(function(res){
      var arreglo = JSON.parse(res);
      if(arreglo.length!=0){
        var conta=0;
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").hide(); 
        //$("#datosdos").empty();
      for(var x=0; x<arreglo.length; x++){
          conta+=1;
          var valor = '<tr>' +
          '<td>' +  arreglo[x].num_doc +'</td>' +
          '<td>' +  arreglo[x].first_nom + ' ' +  arreglo[x].second_nom + ' ' +  arreglo[x].firts_ape + ' ' +  arreglo[x].second_ape +'</td>' +
          '<td>' +  arreglo[x].telefono  + '</td>' +
          '<td>' +  arreglo[x].correo  + '</td>' +
          '<td>' +  arreglo[x].estadoes + '</td>' +
          '<td>' +  '<a href="/estudiante/actualizar/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp'+
                    '<a href="/admin/matricular/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Matricular Estudiante"><i class="fas fa-user-plus" style="color:#6D6D6D;"></i></a>&nbsp&nbsp&nbsp' +


          + '</td>' +//agregar los botones
          '</tr>';
          $('#datos').append(valor);
        }

      }else{
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").show();
      }
    
    });
  });
</script>
@endsection



