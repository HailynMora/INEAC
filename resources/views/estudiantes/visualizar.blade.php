@extends('usuario.principa_usul')
@section('content')
<!--Tabla de informacion-->
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado de Estudiantes</h3>
</div>
<div class="row alerta">
    <div class="col-md-1">
        <a href="{{route('registro_es')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
    </div>
    <div class="col-md-1">
        <a href="{{route('listadomatricula')}}" class="btn btn-outline-info my-2 my-sm-0" >Bto.Ciclo</a>
    </div>
    <div class="col-md-1">
        <a href="/listado/matricula/tecnico" class="btn btn-outline-info my-2 my-sm-0" >Técnicos</a>
    </div>
    <div class="col-md-9">
        <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
          @csrf
          <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Número Identificación" aria-label="Search">
          <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
        </form>
    </div>
</div>


<br><br>
<div class="container table-responsive">

<table class="table">
       <thead  style="background-color:#0f468e; color:white;"" class="alerta">
        <tr>
        <th scope="col">N° Identificacion</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="tabla1" style="background-color:e3e3e3;" class="letraf">
    @if($b == 1)<!--valida si hay datos los imprime-->
      @foreach($estudiante as $d)
        <tr class="table-success" >
        <td>{{$d->num_doc}}</td>
        <td>{{$d->first_nom }} {{$d->second_nom}} {{$d->firts_ape}} {{$d->second_ape}}</td>
        <td>{{$d->telefono}}</td>
        <td>{{$d->correo}}</td>
        <td>{{$d->estadoes}}</td>
        <td><!-- Button trigger modal -->
                <a href="{{route('actualizar_est',$d->id)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;" ></i></a>&nbsp&nbsp&nbsp
                <a href="{{route('matricularadmin', $d->id)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Matricular Estudiante"><i class="fas fa-user-plus" style="color:#6D6D6D;font-size:20px;"></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $d->id;?>" data-placement="bottom"  title="Ver Estudiante">
                <i class="nav-icon fas fa-eye" style="color: #66b62b;font-size:20px;"></i></a>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header alert" style="background-color:#ffc107; color:white;">
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
                      @foreach($pro as $p)
                      @if(isset($p->id_estudiante))
                      @if($d->id==$p->id_estudiante && $p->id_aprobado==1)
                      <div class="row">
                        <div class="col-md-3">Codigo</div>
                        <div class="col-md-3 ml-auto">{{$p->codigo}}</div>
                        <div class="col-md-3">Programa</div>
                        <div class="col-md-3 ml-auto">{{$p->descripcion}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">Periodo</div>
                        <div class="col-md-3 ml-auto">{{$p->periodo}}</div>
                        <div class="col-md-3">Año</div>
                        <div class="col-md-3 ml-auto">{{$p->anio}}</div>
                      </div>
                      @endif
                      @endif
                      @endforeach
                      <hr>
                      @foreach($tec as $t)
                      @if(isset($t->id_estudiante))
                      @if($d->id==$t->id_estudiante && $t->id_aprobado==1)
                      <div class="row">
                        <div class="col-md-3">Codigo</div>
                        <div class="col-md-3 ml-auto">{{$t->codigotec}}</div>
                        <div class="col-md-3">Programa</div>
                        <div class="col-md-3 ml-auto">{{$t->nombretec}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">Periodo</div>
                        <div class="col-md-3 ml-auto">{{$t->periodo}}</div>
                        <div class="col-md-3">Año</div>
                        <div class="col-md-3 ml-auto">{{$t->anio}}</div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">Trimestre</div>
                        <div class="col-md-3 ml-auto">{{$t->nombretri}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3 ml-auto"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3 ml-auto"></div>
                      </div>
                      @endif
                      @endif
                      @endforeach
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
                    <!--Datos estuidnate ajax mostrar-->
                   <!-- Button trigger modal -->
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
        <tbody id="datos" class="table-success">
        </tbody>
      <!--##########################################33-->
    </table>
</div>

 <!--finalizar Tabla de informacion-->
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title alerta" id="exampleModalLabel">Información Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body letraf">
                
               <!---Mostrar datos--> 
               <h4 class="text-centers">Datos Personales</h4>
                    <hr>
                    <div class="row ">
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
                      <hr>
                    

              </div>
              <div class="modal-footer letraf">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        for(var i=1; i<=32; i++){//limpia los datos de los divs para que no salgan uno sobre otro 
          $('#limpiar'+[i]).empty();
        }
        //$("#datosdos").empty();
      for(var x=0; x<arreglo.length; x++){
          conta+=1;
          if ( arreglo[x].estadoes == "Activo") { // true
          var valor = '<tr>' +
          '<td>' +  arreglo[x].num_doc +'</td>' +
          '<td>' +  arreglo[x].first_nom + ' ' +  arreglo[x].second_nom + ' ' +  arreglo[x].firts_ape + ' ' +  arreglo[x].second_ape +'</td>' +
          '<td>' +  arreglo[x].telefono  + '</td>' +
          '<td>' +  arreglo[x].correo  + '</td>' +
          '<td>' +  arreglo[x].estadoes + '</td>' +
          '<td>' +  '<a href="/estudiante/actualizar/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;" ></i></a>&nbsp&nbsp&nbsp'+
                    '<a href="/admin/matricular/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Matricular Estudiante"><i class="fas fa-user-plus" style="color:#6D6D6D;font-size:20px;"></i></a>&nbsp&nbsp&nbsp'+
                    '<a type="button" data-toggle="modal" data-target="#exampleModal" data-placement="bottom"  title="Ver Estudiante"><i class="nav-icon fas fa-eye" style="color: #66b62b;font-size:20px;"></i></a>&nbsp&nbsp&nbsp'+
        
           '</td>' +//agregar los botones
          '</tr>';
            $('#datos').append(valor);

          }else{
                var valor = '<tr>' +
              '<td>' +  arreglo[x].num_doc +'</td>' +
              '<td>' +  arreglo[x].first_nom + ' ' +  arreglo[x].second_nom + ' ' +  arreglo[x].firts_ape + ' ' +  arreglo[x].second_ape +'</td>' +
              '<td>' +  arreglo[x].telefono  + '</td>' +
              '<td>' +  arreglo[x].correo  + '</td>' +
              '<td>' +  arreglo[x].estadoes + '</td>' +
              '<td>' +  '<a href="/estudiante/actualizar/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;" ></i></a>&nbsp&nbsp&nbsp'+
                        '<a href="/admin/matricular/' + arreglo[x].id + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Matricular Estudiante"><i class="fas fa-user-plus" style="color:#6D6D6D;font-size:20px;"></i></a>&nbsp&nbsp&nbsp'+
                        '<a type="button" data-toggle="modal" data-target="#exampleModal" data-placement="bottom"  title="Ver Estudiante"><i class="nav-icon fas fa-eye" style="color: #66b62b;font-size:20px;"></i></a>&nbsp&nbsp&nbsp'+
               '</td>' +//agregar los botones
              '</tr>';
                $('#datos').append(valor);
           
          }
          //estudiante info    
          $('.iden').append(arreglo[x].tdoces);
          $('.num').append(arreglo[x].num_doc);
          $('.dtoex').append(arreglo[x].dpt_expedicion);
          $('.mpioex').append(arreglo[x].mun_expedicion);
          $('.gen').append(arreglo[x].generoestu);
          $('.fecna').append(arreglo[x].fecnacimiento);
          $('.dtona').append(arreglo[x].dpt_nacimiento);
          $('.mpionac').append(arreglo[x].mun_nacimiento);
          $('.primerape').append(arreglo[x].firts_ape);
          $('.segundoape').append(arreglo[x].second_ape);
          $('.primernom').append(arreglo[x].first_nom);
          $('.segundonom').append(arreglo[x].second_nom);
          $('.dires ').append(arreglo[x].dirresidencia);
          $('.barrio').append(arreglo[x].barrio);
          $('.dtores').append(arreglo[x].dptresidencia);
          $('.mpiores').append(arreglo[x].munresidencia);
          $('.zona').append(arreglo[x].zona);
          $('.celular').append(arreglo[x].telefono);
          $('.estrato ').append(arreglo[x].estrato);
          $('.tsangre').append(arreglo[x].tiposangre);
          //end estudiante info
            
          $('.regimen').append(arreglo[x].regimen);
          $('.carnet').append(arreglo[x].eps);
          $('.formacion').append(arreglo[x].nivelformacion);
          $('.ocupacion').append(arreglo[x].ocupacion);
          $('.discap').append(arreglo[x].discapacidad );
          $('.etnia').append(arreglo[x].etniades);
          //estuante sistema salud

          //Datos acudiente           
          $('.idenacu').append(arreglo[x].tdocacu);
          $('.numacu').append(arreglo[x].numacu);
          $('.nomacu').append(arreglo[x].nomacu);
          $('.paren').append(arreglo[x].paren);
          $('.diracu').append(arreglo[x].diracu);
          $('.telacu').append(arreglo[x].telacu);
          //end datos acudiente
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