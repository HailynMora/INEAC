@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado de Docentes</h3>
</div>
<div>
<div class="row">
  <div class="col-md-6">
  <a href="{{route('regdocente')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
  </div>
  <div class="col-md-6">
  <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="No. Identificación" aria-label="Search" required>
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
    </form>
    </div>
</div>
    <br><br>
    <div class="container">
      <table class="table table-striped"style="background-color:#FFCC00;">
      <thead>
          <tr>
          <th scope="col">Tipo Doc</th>
          <th scope="col">Documento</th>
          <th scope="col">Nombres</th>
          <th scope="col">Fec. Vinculación</th>
          <th scope="col">Estado</th>
          <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody id="tabla1">
        @if($b == 1)
          @foreach($doc as $d)
          <tr style="background-color: #dcedc8;">
            <td>{{$d->descripcion}}</td>
            <td>{{$d->num_doc}}</td>
            <td>{{$d->nombre}}  {{$d->apellido}}</td>
            <td>{{date("Y-m-d", strtotime($d->fec_vinculacion))}}</td>
            <td>{{$d->estado}}</td>
            <td>
              <a href="{{route('actualizar_doc',$d->id)}}"  data-toggle="tooltip"  data-placement="bottom"  title="Editar Docente" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
              <a type="button"  data-toggle="modal" data-target="#docente<?php echo $d->id;?>" style="color: #66b62b"  data-placement="bottom"  title="Visualizar">
              <i class="nav-icon fas fa-eye"></i></a>
              &nbsp&nbsp
              <?php
              if($d->estado == 'Activo'){
                  ?>
                  <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                  <?php
              }else{
                  ?>
                  <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                  <?php
              }
              ?>
              <!--MODAL VER-->
              <div class="modal fade" id="docente<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <br>
                    <!---Mostrar datos-->
                    <div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
                     <h4>Docente: {{$d->nombre}}  {{$d->apellido}}</h4>
                    </div>
                    <!--ACORDEON-->
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-chalkboard-teacher"></i> Datos Docente
                            </button>
                          </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            <form id="formudatos" name="formudatos" method="post">
                              @csrf
                              <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="tipo_doc">Tipo Documento</label>
                                  <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" disabled value="{{$d->descripcion}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="num_doc">N° Documento</label>
                                  <input type="text" class="form-control" id="num_doc" name="num_doc" disabled value="{{$d->num_doc}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="correo">Correo</label>
                                  <input type="text" class="form-control" id="correo" name="correo" disabled value="{{$d->correo}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="telefono">Telefono</label>
                                  <input type="text" class="form-control" id="telefono" name="telefono" disabled value="{{$d->telefono}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="direccion">Direccion</label>
                                  <input type="text" class="form-control" id="direccion" name="direccion" disabled value="{{$d->direccion}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="genero">Genero</label>
                                  <input type="text" class="form-control" id="genero" name="genero" disabled value="{{$d->genero}}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="fec_vinculacion">Fecha de Vinculacion</label>
                                  <input type="text" class="form-control" id="fec_vinculacion" name="fec_vinculacion" disabled value="{{date('Y-m-d', strtotime($d->fec_vinculacion))}}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="fec_vinculacion">Estado</label>
                                  <input type="text" class="form-control" id="estado" name="estado" disabled value="{{$d->estado}}">
                                </div>
                              </div>
                            </form>
                            <!--end mostrar datos-->
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="fas fa-book"></i> Asignaturas a cargo
                            </button>
                          </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
                            <div class="form-group col-md-12">
                              <!---asignaturas a cargo-->
                              <?php 
                                $id=$d->id;
                              ?>
                              <div class="form-group justify-content-center col-md-12 " id="docente">
                                <label for="asig_dictadas">Asignaturas a Cargo</label>
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Codigo</th>
                                      <th scope="col">Asignatura</th>
                                      <th scope="col">Intensidad Horaria</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($condoc as $c)
                                    @if($c->id_docente==$id)
                                      <tr>
                                        <td>{{$c->codigo}} </td>
                                        <td>{{$c->nombre}}</td>
                                        <td>{{$c->intensidad_horaria}}</td>  
                                      </tr>                     
                                    @endif
                                  @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <!---end asignaturas a cargo-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--FIN ACORDEON-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>                
              </div>
              <!--FIN MODAL VER-->
            </div>
            <!-- Ventana modal para cambiar -->
            <div class="modal fade" id="cambiarEstado{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #283593; color:#ffffff;!important;">
                    <h4 class="modal-title text-center" style=" text-align: center;">
                      <span>Docente: {{$d->nombre}}  {{$d->apellido}} </span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> 
                  </div>
                  <div class="modal-body mt-2 text-center">
                    <strong style="text-align: center !important"> 
                      <h4 class="modal-title text-center" style=" text-align: center;">
                        <span>¿Cambiar el estado {{$d->estado}} del Docente? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <a  class="btn btn-success" href="{{ route('cambiarEstado', $d->id) }}">Cambiar</a>
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
    @if($b==1)
    {{$doc->links()}}
    @endif
    </div>
</div>
<!--modal para datos-->
<!-- Button trigger modal -->
<!-- Modal -->
 <!--MODAL VER-->
 <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <br>
                    <!---Mostrar datos-->
                    <div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
                     <h4 id="nomdocente" class="reset"></h4>
                    </div>
                    <!--ACORDEON-->
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-chalkboard-teacher"></i> Datos Docente
                            </button>
                          </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            <form id="formudatos" name="formudatos" method="post">
                              @csrf
                              <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="tipo_doc">Tipo Documento</label>
                                  <div class="form-control reset" id="tipodocdocente"> </div>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="num_doc">N° Documento</label>
                                  <div class="form-control reset" id="numdocdocente"> </div>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="correo">Fecha de Vinculación</label>
                                  <div class="form-control reset" id="fecdocente"> </div>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="telefono">Telefono</label>
                                  <div class="form-control reset" id="telefonodocente"> </div>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="direccion">Direccion</label>
                                  <div class="form-control reset" id="direcciondocente"> </div>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="genero">Genero</label>
                                  <div class="form-control reset" id="generodocente"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="fec_vinculacion">Correo</label>
                                  <div class="form-control reset" id="correodocente" > </div>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="fec_vinculacion">Estado</label>
                                  <div class="form-control reset" id="estadocente"> </div>
                                  </div>
                              </div>
                            </form>
                            <!--end mostrar datos-->
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="fas fa-book"></i> Asignaturas a cargo
                            </button>
                          </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
                            <div class="form-group col-md-12">
                              <!---asignaturas a cargo-->
                              <?php 
                                $id=$d->id;
                              ?>
                              <div class="form-group justify-content-center col-md-12 " id="docente">
                                <label for="asig_dictadas">Asignaturas a Cargo</label>
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th scope="col">Codigo</th>
                                      <th scope="col">Asignatura</th>
                                      <th scope="col">Intensidad Horaria</th>
                                    </tr>
                                  </thead>
                                  <tbody id="asignatura">
                                   
                                  </tbody>
                                </table>
                              </div>
                              <!---end asignaturas a cargo-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--FIN ACORDEON-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>                
              </div>
            </div>
              <!--FIN MODAL VER-->
              <!--Modal deshabilitar y habilitar-->
              <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #283593; color:#ffffff;!important;">
                    <h4 class="modal-title text-center" style=" text-align: center;">
                     <div id="nomdoc" class="reset"></div>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> 
                  </div>
                  <div class="modal-body mt-2 text-center">
                    <strong style="text-align: center !important"> 
                      <h4 class="modal-title text-center" style=" text-align: center;">
                        <span>¿Cambiar el estado del Docente? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <form action="{{route('deshabdocente')}}" method="GET">
                      @csrf
                    <input id="idocente" name="idocente" hidden> 
                    <button type="submit" class="btn btn-success">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </form>
                  </div>
                </div>
              </div>
            </div>
              <!--Find Modal deshabilitar y habilitar-->
<!--end modal para datos-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    console.log(nombre);
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('buscardoc')}}",
      type: "POST",
      data:{
        nombre:nombre,
        _token:_token,
      }
    }).done(function(response){
      var arreglo =response;
        var conta=0;
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").hide(); 
        $(".reset").empty(); 
        $('#asignatura').empty();
        //$("#datosdos").empty();
      for(var x=0; x<arreglo.busdocente.length; x++){
          conta+=1;
         
          if ( arreglo.busdocente[x].estado == "Activo") { // true
            var valor = '<tr>' +
          '<td>' +  arreglo.busdocente[x].descripcion +'</td>' +
          '<td>' +  arreglo.busdocente[x].num_doc + '</td>' +
          '<td>' +  arreglo.busdocente[x].nombre  + ' ' +  arreglo.busdocente[x].apellido +'</td>' +
          '<td>' +  dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd')  + '</td>' +
          '<td>' +  arreglo.busdocente[x].estado + '</td>' +
          '<td>' +   
          '<a  href="/docente/actualizar/' + arreglo.busdocente[x].id + '" ' + ' data-toggle="tooltip"  data-placement="bottom"  title="Editar Docente" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp' + 
          '<a type="button"  data-toggle="modal" data-target="#exampleModal" style="color: #66b62b"  data-placement="bottom"  title="Visualizar"><i class="nav-icon fas fa-eye"></i></a>&nbsp&nbsp&nbsp'+
          '<a type="button" data-toggle="modal" data-target="#cambiarEstado"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>'
          '</td>' + //agregar los botones
          ' </tr>';
            
          } else {

            var valor = '<tr>' +
          '<td>' +  arreglo.busdocente[x].descripcion +'</td>' +
          '<td>' +  arreglo.busdocente[x].num_doc + '</td>' +
          '<td>' +  arreglo.busdocente[x].nombre  + ' ' +  arreglo.busdocente[x].apellido +'</td>' +
          '<td>' +  dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd')  + '</td>' +
          '<td>' +  arreglo.busdocente[x].estado + '</td>' +
          '<td>' +   
          '<a  href="/docente/actualizar/' + arreglo.busdocente[x].id + '" ' + ' data-toggle="tooltip"  data-placement="bottom"  title="Editar Docente" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp' + 
          '<a type="button"  data-toggle="modal" data-target="#exampleModal" style="color: #66b62b"  data-placement="bottom"  title="Visualizar"><i class="nav-icon fas fa-eye"></i></a>&nbsp&nbsp&nbsp'+
          '<a type="button" data-toggle="modal" data-target="#cambiarEstado"  data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>'
          '</td>' + //agregar los botones
          ' </tr>';
           
          }

         
          var nombre = arreglo.busdocente[x].nombre + ' '  +  arreglo.busdocente[x].apellido;
          var tipodoc = arreglo.busdocente[x].descripcion;
          var num = arreglo.busdocente[x].num_doc; 
          var correo = arreglo.busdocente[x].correo;
          var tel = arreglo.busdocente[x].telefono;
          var dir = arreglo.busdocente[x].direccion;
          var gen = arreglo.busdocente[x].genero;
          var fec = dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd');
          var es = arreglo.busdocente[x].estado;
          var idoc =  arreglo.busdocente[x].id;
          //  
          //   
          $('#datos').append(valor);
          $('#dato').append(valor);
          $('#nomdocente').append(nombre); //nombre docente modal exampleModal
          $('#tipodocdocente').append(tipodoc); 
          $('#numdocdocente').append(num); 
          $('#correodocente').append(correo); 
          $('#direcciondocente').append(dir);
          $('#generodocente').append(gen);
          $('#telefonodocente').append(tel);
          $('#fecdocente').append(fec);
          $('#estadocente').append(es);
          $('#nomdoc').append(nombre);
          document.getElementsByName("idocente")[0].value = idoc; //colocar valores en los inputs
          
          //////////////////////////////////////asignaturas imprimirs
          for(var x=0; x<arreglo.datos.length; x++){
            var d = '<tr>' +
            '<td>' +  arreglo.datos[x].codigo +'</td>' +
            '<td>' +  arreglo.datos[x].asig +'</td>' + 
            '<td>' +  arreglo.datos[x].intensidad_horaria +'</td>' +
            '</tr>';
            $('#asignatura').append(d);//imprime los datos en la tabla
             
          }
         
          //////////////////////////////////////////////

        }

    
    }).fail(function(jqXHR, response){
        console.log(response);
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").show();
	  });
  });


</script>
<script>
  function JsonDate(jsonDate) {
  var date = new Date(parseInt(jsonDate.substr(6)));
  return date;
}
////////////////////////////////7
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}
////////////////////////7777////
</script>
@endsection