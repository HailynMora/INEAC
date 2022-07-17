@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Programas De Bachillerato Registrados</h3>
</div>
<div class="row">
  <div class="col-6">
    <button type="button"class="btn btn-outline-success my-2 my-sm-0 alerta" data-toggle="modal" data-target="#RegBac">
      Registrar
    </button>
    <!--BOTON REGISTRO ASIGNATURAS-->
      <a href="{{route('reporte')}}"  class="btn btn-outline-warning my-2 my-sm-0 alerta" >Asig. Bachillerato</a>
    <!--FIN BOTON REGISTRO ASIG-->
  </div>
  <div class="col-6">
    <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2 alerta" placeholder="Ejm. Ciclo III" aria-label="Search">
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0 alerta">Buscar</button>
    </form>
    <br><br>
  </div>
  <!--INICIO MODAL-->
   <form id="forprogramas" name="forprogramas" method="POST">
      @csrf
      <div class="modal fade" id="RegBac" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <h3 class="text-center letra1" style="background-color: #FFC107; color:#ffffff; padding-top:15px; padding-bottom:15px;">
              Registro  Programas 
            </h3>
            <div class="modal-body">
              <!--registrar modal-->
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fas fa-edit"></i> Datos De Programa
                        </button>
                      </h2>
                    </div>
                    <div id="collapseOne" class="collapse show letraf" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombac" name="nombac" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="codigo">Codigo</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="des">Descripcion</label>
                            <input type="text" class="form-control" id="des" name="des" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="jornada">Jornada</label>
                            <input type="text" class="form-control" id="jornada" name="jornada" required>
                          </div>
                          <div class="form-group col-md-4" >
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control" name="estado" required>
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
              <!--FIN REGISTRAR MODAL--->
            </div>
            <div class="modal-footer letraf">
              <!--botones -->
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas')}}">Cancelar</a>
              <!--end botones-->
            </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  <!--FIN MODAL-->
</div>  
<br> 
<div class="container table-responsive">
    <table class="table">
        <thead style="background-color:#0f468e; color:white;" class="alerta">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Programas</th>
            <th scope="col">Jornada</th>
            <th scope="col">Descripción</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1" class="letraf">
        @foreach($rep as $d)
        <tr style="background-color:#E3E3E3;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->programa}}</td>
        <td>{{$d->jornada}}</td>
        <td>{{$d->cursodes}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_prog',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i></a>
        &nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108; font-size:20px;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$d->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82; font-size:20px;"></i></a>
            <?php
        }
        ?>
        &nbsp&nbsp
        <a href="{{route('vincular_a', $d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308; font-size:20px;" ></i></a>        
        </td>
        </tr>
        <!--Ventana Modal para la Alerta de Eliminar--->
        <!-- Ventana modal para eliminar -->
        <div class="modal fade" id="cambiarPro{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header alerta" style="background-color: #ffc107 !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado {{$d->estado}} del programa? </span>
                        </h4>
                        <button type="button" class="close letraf" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center  letraf">
                        <strong style="text-align: center !important"> 
                        {{ $d->codigo }} - {{ $d->programa }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-success  letraf" href="{{ route('cambiarPro', $d->id) }}">Cambiar</a>
                        <button type="button" class="btn btn-default  letraf" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
             </div>
        </div>
        <!---fin ventana eliminar--->
        @endforeach
        </tbody>
        <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #E3E3E3;" class="letraf">
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
        if(arreglo[x].estado == "Activo"){
          var valor = '<tr>' +
                      '<td>' +  arreglo[x].codigo +'</td>' +
                      '<td>' +  arreglo[x].descripcion + '</td>' +
                      '<td>' +  arreglo[x].jornada + '</td>' +
                      '<td>' + arreglo[x].cursodes +'</td>' +
                      '<td>' +  arreglo[x].estado + '</td>' +
                      '<td>' +  '<a href="/programas/actualizar/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i> &nbsp;&nbsp;&nbsp;</a>'+
                                '<a type="button" data-toggle="modal" data-target="#cambiarPro'+ arreglo[x].id +'" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108; font-size:20px;"></i>&nbsp;&nbsp;&nbsp;</a>'+
                                '<a href="/vincular/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308; font-size:20px;" ></i></a>'

                      + '</td>' + //agregar los botones
                      '</tr>';
         }else{
            
            var valor = '<tr>' +
                        '<td>' +  arreglo[x].codigo +'</td>' +
                        '<td>' +  arreglo[x].descripcion + '</td>' +
                        '<td>' +  arreglo[x].jornada + '</td>' +
                        '<td>' + arreglo[x].cursodes +'</td>' +
                        '<td>' +  arreglo[x].estado + '</td>' +
                        '<td>' +  '<a href="/programas/actualizar/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i> &nbsp;&nbsp;&nbsp;</a>'+
                                  '<a type="button" data-toggle="modal"  data-target="#cambiarPro'+ arreglo[x].id +'" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82; font-size:20px;"></i>&nbsp;&nbsp;&nbsp;</a>'
                                  '<a href="/vincular/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308; font-size:20px;" ></i></a>'

                        + '</td>' + //agregar los botones
                        '</tr>';
         }
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
<script>
  $('#forprogramas').submit(function(e){
    e.preventDefault();
    var nombac=$('#nombac').val();
    var codigo=$('#codigo').val();
    var estado=$('#estado').val();
    var des=$('#des').val();
    var jornada=$('#jornada').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('regprogramas')}}",
      data:{
        nombac:nombac,
        codigo:codigo,
        estado:estado,
        des:des,
        jornada:jornada,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#forprogramas')[0].reset();
          toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      },
      error:function(jqXHR, response){
          if(jqXHR.status==422){
            toastr.warning('Datos Repetidos!.', 'El código del programa debe ser único!', {timeOut:3000});
          }else{
           if(jqXHR.status==423){
            toastr.warning('Datos Repetidos!.', 'El nombre del programa debe ser único!', {timeOut:3000});
           }
          }
         
      }
    });
  })
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text]").each(function() { this.value = '' });
     toastr.info('Campos Vacios', {timeOut:1000});
  }
</script>
@endsection