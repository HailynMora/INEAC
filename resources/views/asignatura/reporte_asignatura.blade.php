@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Reporte Asignaturas Bachillerato</h3>
</div>
  <!--modal-->
   <!-- Button trigger modal -->
   <div class="row">
     <div class="col-6">
        <button type="button"class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#RegAsig">
          Registrar
        </button>
      </div>
      <!-- Modal -->
      <form id="formudatos" name="formudatos" method="post">
      @csrf
      <div class="modal fade" id="RegAsig" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <h3 class="text-center" style="background-color: #283593; color:#ffffff; padding-top:15px; padding-bottom:15px;">
                    Registro de Asignaturas
              </h3>
            <div class="modal-body">
              <!--registrar modal-->
                <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-edit"></i> Asignaturas
                          </button>
                        </h2>
                      </div>
                  
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="codigo">Código</label>
                                        <input type="number" class="form-control" id="codigo" name="codigo" placeholder="12345678" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="intensidad_horaria">Intensidad Horaria</label>
                                        <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" placeholder="12345678" required>
                                    </div>
                                  
                                <div class="form-group col-md-6">
                                    <label for="val_habilitacion">Valor Habilitación</label>
                                    <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" placeholder="12345678">
                                  </div>
                                  <div class="form-group col-md-6" >
                                  <label for="id_estado">Estado</label>
                                  <select id="id_estado" class="form-control" name="id_estado" required>
                                  <option selected>Seleccionar</option>
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                  </select>
                                  </div>
                              </div>
                                                              
                        </div>
                      </div>
                    </div>
                  </div>

              <!--##########################3--->
            </div>
            <div class="modal-footer">
              <!--botones -->
               <button type="submit" class="btn btn-success">Registrar</button>
               <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
              <a  class="btn btn-danger" href="{{url('/asignatura/reporte_asignatura')}}">Cancelar</a>
              <!--end botones-->
            </div>
          </div>
        </div>
      </div>
      </form>
<!--##########end modal--########-->
     <div class="col-6">
        <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
        @csrf
        <input id="nombrebus" name="nombrebus" class="form-control mr-sm-2" placeholder="Nombre Asignatura" aria-label="Search">
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
      </form>
     </div>
  </div>
<br><br>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Intensidad Horaria</th>
            <th scope="col">Val. Habilitación</th>
            <th scope="col">Estado </th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1">
        @foreach($rep as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->val_habilitacion}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_asig',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;"></i></a>&nbsp&nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
            <?php
        }
        ?>
        &nbsp&nbsp
        <!--<a type="button" data-toggle="modal" data-target="#eliminarAsig{{$d->id}}"><i class="nav-icon fas fa-trash" style="color: red;"></i></a>-->
        </td>
        </tr>
        <!-- Ventana modal para cambiar -->
        <div class="modal fade" id="cambiarAsig{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #563d7c !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado {{$d->estado}} de la asignatura? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        {{ $d->codigo }} - {{ $d->asig }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarAsig', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
             </div>
        </div>
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
                        <span>¿Cambiar estado de la asignatura? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <form action="{{route('deshasignatura')}}" method="POST">
                      @csrf
                    <input id="idasig" name="idasig" hidden> 
                    <button type="submit" class="btn btn-success">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </form>
                  </div>
                </div>
              </div>
            </div>
              <!--Find Modal deshabilitar y habilitar-->
        @endforeach
        </tbody>
        <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
        <div class="container-fluid">
        {{$rep->links()}}
       </div>
      </div>
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
        <h2 class="mb-0">
          <a class="btn btn-link float-right" type="button" href="{{route('reporte_pro')}}">
          <i class="fas fa-arrow-circle-left"></i> Volver
          </a>
        </h2>
      </div>
    </div>
    
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombrebus').val();
    var _token = $('input[name=_token]').val();
    console.log(nombre);
    $.ajax({
      url:"{{route('buscarasigc')}}",
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
       if ( arreglo[x].estado == "Activo") { // true
          var valor = '<tr>' +
          '<td>' +  arreglo[x].codigo +'</td>' +
          '<td>' +  arreglo[x].asig + '</td>' +
          '<td>' +  arreglo[x].intensidad_horaria  + '</td>' +
          '<td>' +  arreglo[x].val_habilitacion  + '</td>' +
          '<td>' +  arreglo[x].estado + '</td>' +
          '<td>'+ ' <a href="/asignatura/actualizar/'+ arreglo[x].id +' "  data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;"></i></a>' + 
                  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a type="button" data-toggle="modal" data-target="#cambiarEstado"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>'+
          '</td>' +//agregar los botones
          '</tr>';
          $('#datos').append(valor);
         }else{
          
            var valor = '<tr>' +
            '<td>' +  arreglo[x].codigo +'</td>' +
            '<td>' +  arreglo[x].asig + '</td>' +
            '<td>' +  arreglo[x].intensidad_horaria  + '</td>' +
            '<td>' +  arreglo[x].val_habilitacion  + '</td>' +
            '<td>' +  arreglo[x].estado + '</td>' +
            '<td>'+ ' <a href="/asignatura/actualizar/'+ arreglo[x].id +' "  data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;"></i></a>' + 
                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a type="button" data-toggle="modal" data-target="#cambiarEstado"  data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>'+
            '</td>' +//agregar los botones
            '</tr>';
            $('#datos').append(valor);

         }

         document.getElementsByName("idasig")[0].value = arreglo[x].id;

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
<script>
  $('#formudatos').submit(function(e){
    e.preventDefault();
    var codigo=$('#codigo').val();
    var nombre=$('#nombre').val();
    var intensidad_horaria=$('#intensidad_horaria').val();
    var val_habilitacion=$('#val_habilitacion').val();
    var id_estado=$('#id_estado').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('datosasig')}}",
      data:{
        codigo:codigo,
        nombre:nombre,
        intensidad_horaria:intensidad_horaria,
        val_habilitacion:val_habilitacion,
        id_estado:id_estado,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('Asignatura registrada exitosamente', 'Nuevo Registro', {timeOut:3000});
        }
      },
      error:function(jqXHR, response){
          if(jqXHR.status==422){
            toastr.warning('Datos Repetidos!.', 'El código de la Asignatura debe ser único!', {timeOut:3000});
          }else{
           if(jqXHR.status==423){
            toastr.warning('Datos Repetidos!.', 'El nombre de la Asignatura  debe ser único!', {timeOut:3000});
           }
          }
         
      }
    });
  })

  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number]").each(function() { this.value = '' });
  }
</script>
@endsection