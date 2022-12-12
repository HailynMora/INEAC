@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado de Estudiantes</h3>
</div>
@if($b != 1)
@if(Session::has('consulta'))
       <br>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('consulta')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  @endif
  @endif
@if($b == 1)<!--valida si hay datos los imprime-->
<div class="row alerta">
    <div class="col-md-1 text-center">
     <a href="/docente/generar/listado/{{$dat['anio']}}/{{$dat['per']}}/{{$dat['curso']}}" type="button" class="btn btn-primary">Generar </a>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-9">
        <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
          @csrf
          <input id="cedula" name="cedula" class="form-control mr-sm-2" placeholder="Número Identificación" aria-label="Search">
          <button type="submit" class="btn btn-primary my-2 my-sm-0">Buscar</button>
        </form>
    </div>
</div>
<br>

<div class="container table-responsive">

<table class="table">
       <thead style="background-color:#0f468e; color: #ffffff;" class="alerta" >
        <tr>
        <th scope="col">N° Identificacion</th>
        <th scope="col">Nombre</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Correo</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="tablanueva" style="background-color:#e3e3e3;" class="letraf tablanueva">
      @foreach($estudiante as $d)
        <tr>
        <td>{{$d->num_doc}}</td>
        <td>{{$d->first_nom }} {{$d->second_nom}} {{$d->firts_ape}} {{$d->second_ape}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->correo}}</td>
        <td>{{$d->estamat }}</td>
        <td><!-- Button trigger modal -->
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>" data-placement="bottom"  title="Ver Estudiante">
                <img src="{{asset('dist/img/card.png')}}" class="img-fluid" ></a>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header alert" style="background-color:#0f468e; color:#ffffff;">
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
                        <div class="col-md-3"><b>Tipo Identificacion</b></div>
                        <div class="col-md-3 ml-auto">{{$d->tdoces}}</div>
                        <div class="col-md-3"><b>Número</b></div>
                        <div class="col-md-3 ml-auto">{{$d->num_doc}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dpt Expedición</b></div>
                        <div class="col-md-3 ml-auto">{{$d->dpt_expedicion}}</div>
                        <div class="col-md-3"><b>Mpio. Expedición</b></div>
                        <div class="col-md-3 ml-auto">{{$d->mun_expedicion}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Genero</b></div>
                        <div class="col-md-3 ml-auto">{{$d->generoestu}}</div>
                        <div class="col-md-3"><b>Fecha Nac</b></div>
                        <div class="col-md-3 ml-auto">{{$d->fecnacimiento}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dpt Nacimiento</b></div>
                        <div class="col-md-3 ml-auto">{{$d->dpt_nacimiento}}</div>
                        <div class="col-md-3"><b>Mpio. Nacimiento</b></div>
                        <div class="col-md-3 ml-auto">{{$d->mun_nacimiento}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Primer Apellido</b></div>
                        <div class="col-md-3 ml-auto">{{$d->firts_ape}}</div>
                        <div class="col-md-3"><b>Segundo Apellido</b></div>
                        <div class="col-md-3 ml-auto">{{$d->second_ape}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Primer Nombre</b></div>
                        <div class="col-md-3 ml-auto">{{$d->first_nom}}</div>
                        <div class="col-md-3"><b>Segundo Nombre</b></div>
                        <div class="col-md-3 ml-auto">{{$d->second_nom}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dir. Residencia</b></div>
                        <div class="col-md-3 ml-auto">{{$d->dirresidencia}}</div>
                        <div class="col-md-3"><b>Barrio</b></div>
                        <div class="col-md-3 ml-auto">{{$d->barrio}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dpt. Residencia</b></div>
                        <div class="col-md-3 ml-auto">{{$d->dptresidencia}}</div>
                        <div class="col-md-3"><b>Mpio. Residencia</b></div>
                        <div class="col-md-3 ml-auto">{{$d->munresidencia}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Zona</b></div>
                        <div class="col-md-3 ml-auto">{{$d->zona}}</div>
                        <div class="col-md-3"><b>Telefono/Celular</b></div>
                        <div class="col-md-3 ml-auto">{{$d->telefono}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Estrato</b></div>
                        <div class="col-md-3 ml-auto">{{$d->estrato}}</div>
                        <div class="col-md-3"><b>Tipo Sangre</b></div>
                        <div class="col-md-3 ml-auto">{{$d->tiposangre}}</div>
                    </div>
                    <!--end mostrar datos-->
                    <!---#########################################sistema salud----->
                     <br>
                      <hr>
                        <h4 class="text-centers">Sistema De Salud</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3"><b>Regimen Salud</b></div>
                        <div class="col-md-3 ml-auto">{{$d->regimen}}</div>
                        <div class="col-md-3"><b>Carnet/EPS</b></div>
                        <div class="col-md-3 ml-auto">{{$d->eps}}</div>
                     </div>
                     <div class="row">
                        <div class="col-md-3"><b>Nivel Formación</b></div>
                        <div class="col-md-3 ml-auto">{{$d->nivelformacion}}</div>
                        <div class="col-md-3"><b>Ocupación</b></div>
                        <div class="col-md-3 ml-auto">{{$d->ocupacion}}</div>
                     </div>
                     <div class="row">
                        <div class="col-md-3"><b>Discapacidad</b></div>
                        <div class="col-md-3 ml-auto">{{$d->discapacidad}}</div>
                        <div class="col-md-3"><b>Multiculturidad</b></div>
                        <div class="col-md-3 ml-auto">{{$d->etniades}}</div>
                     </div>
                    <!--#####################fin sistema salud---->
                    <!--#############Datos del acudiente-->
                      <br>
                      <hr>
                        <h4 class="text-centers">Datos De Padre Y/O Acudiente</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3"><b>Tipo Identificacion</b></div>
                        <div class="col-md-3 ml-auto">{{$d->tdocacu}}</div>
                        <div class="col-md-3"><b>Número</b></div>
                        <div class="col-md-3 ml-auto">{{$d->numacu}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><b>Nombres y Apellido</b></div>
                        <div class="col-md-3 ml-auto">{{$d->nomacu}}</div>
                        <div class="col-md-3"><b>Parentesco</b></div>
                        <div class="col-md-3 ml-auto">{{$d->paren}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><b>Dirección Residencia</b></div>
                        <div class="col-md-3 ml-auto">{{$d->diracu}}</div>
                        <div class="col-md-3"><b>Telefono/Celular</b></div>
                        <div class="col-md-3 ml-auto">{{$d->telacu}}</div>
                      </div>
                    <!---############End Datos Acudiente-->
                    <br>
                      <hr>
                        <h4 class="text-centers">Datos Del Programa</h4> 
                        <div class="row">
                          <div class="col-md-3"><b>Curso</b></div>
                          <div class="col-md-3 ml-auto">{{$d->descripcion}}</div>
                          <div class="col-md-3"><b>descripcion</b></div>
                          <div class="col-md-3 ml-auto">{{$d->cursodes}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><b>Año</b></div>
                          <div class="col-md-3 ml-auto">{{$d->anio}}</div>
                          <div class="col-md-3"><b>Periodo</b></div>
                          <div class="col-md-3 ml-auto">{{$d->periodo}}</div>
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
        
        @endforeach
        @endif
    </tbody>
    <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" class="letraf" style="background-color:#e3e3e3;">
        </tbody>
      <!--##########################################33-->
    </table>
</div>

 <!--finalizar Tabla de informacion-->
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable letraf">
            <div class="modal-content">
              <div class="modal-header" style="background-color:#0f468e;color: #ffffff;">
                <h5 class="modal-title" id="exampleModalLabel">Información Estudiante</h5>
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
                        <div class="col-md-3 ml-auto iden" id="limpiar1"> </div>
                        <div class="col-md-3"><b>Número</b></div>
                        <div class="col-md-3 ml-auto num" id="limpiar2"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dpt Expedición</b></div>
                        <div class="col-md-3 ml-auto dtoex" id="limpiar3">  </div>
                        <div class="col-md-3"><b>Mpio. Expedición</b></div>
                        <div class="col-md-3 ml-auto mpioex" id="limpiar4"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Genero</b></div>
                        <div class="col-md-3 ml-auto gen" id="limpiar5"> </div>
                        <div class="col-md-3"><b>Fecha Nac</b></div>
                        <div class="col-md-3 ml-auto fecna" id="limpiar6"> </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-3"><b>Dpt Nacimiento</b></div>
                        <div class="col-md-3 ml-auto dtona" id="limpiar7"> </div>
                        <div class="col-md-3"><b>Mpio. Nacimiento</b></div>
                        <div class="col-md-3 ml-auto mpionac" id="limpiar8"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Primer Apellido</b></div>
                        <div class="col-md-3 ml-auto primerape" id="limpiar9"> </div>
                        <div class="col-md-3"><b>Segundo Apellido</b></div>
                        <div class="col-md-3 ml-auto segundoape" id="limpiar10"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Primer Nombre</b></div>
                        <div class="col-md-3 ml-auto primernom" id="limpiar11"> </div>
                        <div class="col-md-3"><b>Segundo Nombre</b></div>
                        <div class="col-md-3 ml-auto segundonom" id="limpiar12"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dir. Residencia</b></div>
                        <div class="col-md-3 ml-auto dires" id="limpiar13"> </div>
                        <div class="col-md-3"><b>Barrio</b></div>
                        <div class="col-md-3 ml-auto barrio" id="limpiar14">  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Dpt. Residencia</b></div>
                        <div class="col-md-3 ml-auto dtores" id="limpiar15"> </div>
                        <div class="col-md-3"><b>Mpio. Residencia</b></div>
                        <div class="col-md-3 ml-auto mpiores" id="limpiar16"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Zona</b></div>
                        <div class="col-md-3 ml-auto zona" id="limpiar17"> </div>
                        <div class="col-md-3"><b>Telefono/Celular</b></div>
                        <div class="col-md-3 ml-auto celular" id="limpiar18"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><b>Estrato</b></div>
                        <div class="col-md-3 ml-auto estrato" id="limpiar19"> </div>
                        <div class="col-md-3"><b>Tipo Sangre</b></div>
                        <div class="col-md-3 ml-auto tsangre" id="limpiar20"> </div>
                    </div>
                    <!--end mostrar datos-->
                    <!---#########################################sistema salud----->
                     <br>
                      <hr>
                        <h4 class="text-centers">Sistema De Salud</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3"><b>Regimen Salud</b></div>
                        <div class="col-md-3 ml-auto regimen" id="limpiar21"> </div>
                        <div class="col-md-3"><b>Carnet/EPS</b></div>
                        <div class="col-md-3 ml-auto carnet" id="limpiar22"> </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3"><b>Nivel Formación</b></div>
                        <div class="col-md-3 ml-auto formacion" id="limpiar23"> </div>
                        <div class="col-md-3"><b>Ocupación</b></div>
                        <div class="col-md-3 ml-auto ocupacion" id="limpiar24"> </div>
                     </div>
                     <div class="row">
                        <div class="col-md-3"><b>Discapacidad</b></div>
                        <div class="col-md-3 ml-auto discap" id="limpiar25"> </div>
                        <div class="col-md-3"><b>Multiculturidad</b></div>
                        <div class="col-md-3 ml-auto etnia" id="limpiar26"> </div>
                     </div>
                    <!--#####################fin sistema salud---->
                    <!--#############Datos del acudiente-->
                      <br>
                      <hr>
                        <h4 class="text-centers">Datos De Padre Y/O Acudiente</h4>
                      <hr>
                      <div class="row">
                        <div class="col-md-3"><b>Tipo Identificacion</b></div>
                        <div class="col-md-3 ml-auto idenacu" id="limpiar27"> </div>
                        <div class="col-md-3"><b>Número</b></div>
                        <div class="col-md-3 ml-auto numacu" id="limpiar28"> </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><b>Nombres y Apellido</b></div>
                        <div class="col-md-3 ml-auto nomacu" id="limpiar29"> </div>
                        <div class="col-md-3"><b>Parentesco</b></div>
                        <div class="col-md-3 ml-auto paren" id="limpiar30"> </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3"><b>Dirección Residencia</b></div>
                        <div class="col-md-3 ml-auto diracu" id="limpiar31"> </div>
                        <div class="col-md-3"><b>Telefono/Celular</b></div>
                        <div class="col-md-3 ml-auto telacu" id="limpiar32"> </div>
                      </div>
                    <!---############End Datos Acudiente-->
                    <br>     
                      <hr>
                        <h4 class="text-start">Datos Del Programa</h4>
                        <div class="row">
                          <div class="col-md-3"><b>Curso</b></div>
                          <div class="col-md-3 ml-auto curso" id="limpiar33"> </div>
                          <div class="col-md-3"><b>descripcion</b></div>
                          <div class="col-md-3 ml-auto descur" id="limpiar34"> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><b>Año</b></div>
                          <div class="col-md-3 ml-auto anio" id="limpiar35"> </div>
                          <div class="col-md-3"><b>Periodo</b></div>
                          <div class="col-md-3 ml-auto per" id="limpiar36"> </div>
                        </div>
                      <hr>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
              </div>
            </div>
          </div>
        </div>
       <!--end datos estudiante ajax -->



 <!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#cedula').val();
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
     
     // var arreglo = JSON.parse(res);
      var arreglo = res;
      if(arreglo.busest.length!=0){
        var conta=0;
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tablanueva").hide(); 
        for(var i=1; i<=36; i++){//limpia los datos de los divs para que no salgan uno sobre otro 
          $('#limpiar'+[i]).empty();
        }
        //$("#datosdos").empty();
      for(var x=0; x<arreglo.busest.length; x++){
          conta+=1;
          console.log(arreglo);
          if ( arreglo.busest[x].estadoes == "Activo") { // true
          var valor = '<tr>' +
          '<td>' +  arreglo.busest[x].num_doc +'</td>' +
          '<td>' +  arreglo.busest[x].first_nom + ' ' +  arreglo.busest[x].second_nom + ' ' +  arreglo.busest[x].firts_ape + ' ' +  arreglo.busest[x].second_ape +'</td>' +
          '<td>' +  arreglo.busest[x].telefono  + '</td>' +
          '<td>' +  arreglo.busest[x].correo  + '</td>' +
          '<td>' +  arreglo.busest[x].estadoes + '</td>' +
          '<td>' +  '<a type="button" data-toggle="modal" data-target="#exampleModal" data-placement="bottom"  title="Ver Estudiante"> <img src="/dist/img/card.png" class="img-fluid" ></a>&nbsp&nbsp&nbsp'+
        
           '</td>' +//agregar los botones
          '</tr>';
            $('#datos').append(valor);

          }else{
                var valor = '<tr>' +
              '<td>' +  arreglo.busest[x].num_doc +'</td>' +
              '<td>' +  arreglo.busest[x].first_nom + ' ' +  arreglo.busest[x].second_nom + ' ' +  arreglo.busest[x].firts_ape + ' ' +  arreglo.busest[x].second_ape +'</td>' +
              '<td>' +  arreglo.busest[x].telefono  + '</td>' +
              '<td>' +  arreglo.busest[x].correo  + '</td>' +
              '<td>' +  arreglo.busest[x].estadoes + '</td>' +
              '<td>' +  '<a type="button" data-toggle="modal" data-target="#exampleModal" data-placement="bottom"  title="Ver Estudiante"> <img src="/dist/img/card.png" class="img-fluid" ></a>&nbsp&nbsp&nbsp'+
               '</td>' +//agregar los botones
              '</tr>';
                $('#datos').append(valor);
           
             }

              //estudiante info    
              $('.iden').append(arreglo.busest[x].tdoces);
              $('.num').append(arreglo.busest[x].num_doc);
              $('.dtoex').append(arreglo.busest[x].dpt_expedicion);
              $('.mpioex').append(arreglo.busest[x].mun_expedicion);
              $('.gen').append(arreglo.busest[x].generoestu);
              $('.fecna').append(arreglo.busest[x].fecnacimiento);
              $('.dtona').append(arreglo.busest[x].dpt_nacimiento);
              $('.mpionac').append(arreglo.busest[x].mun_nacimiento);
              $('.primerape').append(arreglo.busest[x].firts_ape);
              $('.segundoape').append(arreglo.busest[x].second_ape);
              $('.primernom').append(arreglo.busest[x].first_nom);
              $('.segundonom').append(arreglo.busest[x].second_nom);
              $('.dires ').append(arreglo.busest[x].dirresidencia);
              $('.barrio').append(arreglo.busest[x].barrio);
              $('.dtores').append(arreglo.busest[x].dptresidencia);
              $('.mpiores').append(arreglo.busest[x].munresidencia);
              $('.zona').append(arreglo.busest[x].zona);
              $('.celular').append(arreglo.busest[x].telefono);
              $('.estrato ').append(arreglo.busest[x].estrato);
              $('.tsangre').append(arreglo.busest[x].tiposangre);
              //end estudiante info
                
              $('.regimen').append(arreglo.busest[x].regimen);
              $('.carnet').append(arreglo.busest[x].eps);
              $('.formacion').append(arreglo.busest[x].nivelformacion);
              $('.ocupacion').append(arreglo.busest[x].ocupacion);
              $('.discap').append(arreglo.busest[x].discapacidad );
              $('.etnia').append(arreglo.busest[x].etniades);
              //estuante sistema salud

              //Datos acudiente           
              $('.idenacu').append(arreglo.busest[x].tdocacu);
              $('.numacu').append(arreglo.busest[x].numacu);
              $('.nomacu').append(arreglo.busest[x].nomacu);
              $('.paren').append(arreglo.busest[x].paren);
              $('.diracu').append(arreglo.busest[x].diracu);
              $('.telacu').append(arreglo.busest[x].telacu);
              //end datos acudiente

              //datos de programas bachillerato
              $('.curso').append(arreglo.bac[x].codigo);
              $('.anio').append(arreglo.bac[x].anio);
              $('.descur').append(arreglo.bac[x].descripcion);
              $('.per').append(arreglo.bac[x].periodo);

        }

      }else{
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tablanueva").show();
      }
    });
  });
</script>
@endsection



