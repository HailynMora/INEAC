@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Programas Bachillerato Registrados</h3>
</div>
<a href="{{route('registrarprog')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
<a href="{{route('reporte')}}"  class="btn btn-outline-warning my-2 my-sm-0" >Asig. Bachillerato</a>
    <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
    </form>
    
    <br><br>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Programas</th>
            <th scope="col">Jornada</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1">
        @foreach($rep as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->programa}}</td>
        <td>{{$d->jornada}}</td>
        <td>{{$d->cursodes}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_prog',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>
        &nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
            <?php
        }
        ?>
        &nbsp&nbsp
        <a href="{{route('vincular_a', $d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308;" ></i></a>        
        </td>
        </tr>
        <!--Ventana Modal para la Alerta de Eliminar--->
        <!-- Ventana modal para eliminar -->
        <div class="modal fade" id="cambiarPro{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #563d7c !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado {{$d->estado}} del programa? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        {{ $d->codigo }} - {{ $d->programa }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-success" href="{{ route('cambiarPro', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
             </div>
        </div>
        <!---fin ventana eliminar--->
        @endforeach
        </tbody>
        <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
    {{$rep->links()}}
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
      url:"{{route('buscarciclo')}}",
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
          '<td>' +  arreglo[x].codigo +'</td>' +
          '<td>' +  arreglo[x].descripcion + '</td>' +
          '<td>' +  arreglo[x].jornada + '</td>' +
          '<td>' + arreglo[x].cursodes +'</td>' +
          '<td>' +  arreglo[x].estado + '</td>' +
          '<td>' +  arreglo[x].id + '</td>' +
          '<td>' +  

          '<a href="{{route("actualizar_prog_tec",'+arreglo[x].id+')}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>'

          + '</td>' + //agregar los botones
          '</tr>';
          console.log(valor);
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