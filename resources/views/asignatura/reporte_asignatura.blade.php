@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Reporte Asignaturas Bachillerato</h3>
</div>
<a href="{{route('regasignatura')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
<form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
  @csrf
  <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Nombre Asignatura" aria-label="Search">
  <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
</form>
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
    var nombre=$('#nombre').val();
    console.log(nombre);
    var _token = $('input[name=_token]').val();
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
@endsection