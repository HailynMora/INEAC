@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Asignaturas programas técnicos</h3>
</div>
<div class="row">
  <div class="col-6">
    <!--BOTON MODAL-->
      <button type="button" class="btn btn-success my-2 my-sm-0 alerta" data-toggle="modal" data-target="#RegTecAsig">
        Registro
      </button>
    <!--FIN BOTON MODAL-->
  </div>
  <div class="col-6">
    <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Nombre Asignatura" aria-label="Search">
      <button type="submit" class="btn btn-primary my-2 my-sm-0 alerta">Buscar</button>
    </form>
    <br><br>
  </div>
  <!--INICIO MODAL-->
  <br>
    <form id="formudatos" name="formudatos" method="post">
      @csrf
      <div class="modal fade" id="RegTecAsig" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <h3 class="text-center letra1" style="background-color: #FFC107; color:#ffffff; padding-top:15px; padding-bottom:15px;">
              Registrar asignaturas
            </h3>
            <div class="modal-body">
              <!--registrar modal-->
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fas fa-edit"></i> Datos de asignatura
                        </button>
                      </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body letraf">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="codigo">Código</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="1234" min="0"  minlength="4" maxlength="6" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="nomas">Nombre</label>
                            <input type="text" class="form-control" id="nomas" name="nomas" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="intensidad_horaria">Intensidad horaria</label>
                            <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" placeholder="5" min="1" max="10" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="val_habilitacion">Valor habilitación</label>
                            <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" placeholder="1000" min="10000" max="60000" required>
                          </div>
                          
                            <input type="number" id="estado" class="form-control" name="estado" value="1" hidden>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!--FIN REGISTRAR MODAL--->
            </div>
            <div class="modal-footer alerta">
              <!--botones -->
                <a  class="btn btn-danger" href="{{url('/asignatura_tecnicos/reporte_asignatura')}}">Salir</a>
                <button type="submit" class="btn btn-info"  onclick="resetform()">Limpiar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
                <!--end botones-->
            </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  <!--FIN MODAL-->
</div>

<div class="container">
    <table class="table">
        <thead style="background-color:#0f468e; color:white;" class="alerta">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Asignatura</th>
            <th scope="col">Intensidad Horaria</th>
            <th scope="col">Val. Habilitación</th>
            <th scope="col">Estado </th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1" class="letraf">
        @foreach($rep as $d)
        <tr style="background-color: #E3E3E3;">
        <td>{{$d->codigoasig}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->val_habilitacion}}</td>
        <td>{{$d->estado}}</td>
        <td>
        <a href="{{route('actualizar_asigtec',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;"></i></a>&nbsp&nbsp&nbsp
        <?php
        if($d->estado == 'Activo'){
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108; font-size:20px;"></i></a>
            <?php
        }else{
            ?>
            <a type="button" data-toggle="modal" data-target="#cambiarAsig{{$d->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82; font-size:20px;"></i></a>
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
                <div class="modal-content alerta">
                    <div class="modal-header" style="background-color: #FFC107 !important;">
                        <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                            <span>¿Cambiar el estado <span style="color:black;">{{$d->estado}}</span> de la asignatura? </span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                        <strong style="text-align: center !important"> 
                        Asignatura: {{ $d->codigoasig }} - {{ $d->asig }}
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <a class="btn btn-success" href="/cambiar/asigtecnico/{{$d->id}}">Guardar</a>
                    </div>
                </div>
             </div>
        </div>
        
         <!--Modal deshabilitar y habilitar-->
       <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #FFC107; color:#ffffff;!important;">
                    <h4 class="modal-title text-center" style=" text-align: center;">
                     <div id="nomdoc" class="reset"></div>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> 
                  </div>
                  <div class="modal-body mt-2 text-center alerta">
                    <strong style="text-align: center !important"> 
                      <h4 class="modal-title text-center" style=" text-align: center;">
                        <span>¿Cambiar estado de la asignatura? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <form action="{{route('deshasigtec')}}" method="POST">
                      @csrf
                    <input id="idasig" name="idasig" hidden> 
                    <button type="button" class="btn btn-danger alerta" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-success alerta">Guardar</button>
                     </form>
                  </div>
                </div>
              </div>
            </div>
              <!--Find Modal deshabilitar y habilitar-->

        @endforeach
        </tbody>
        <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #E3E3E3;" class="letraf">
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
          <a class="btn btn-link float-right alerta" type="button" href="{{route('reporte_tecnico')}}">
          <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> Volver
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
      url:"{{route('buscarasigt')}}",
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
          '<td>' +  arreglo[x].codigoasig +'</td>' +
          '<td>' +  arreglo[x].asig + '</td>' +
          '<td>' +  arreglo[x].intensidad_horaria  + '</td>' +
          '<td>' +  arreglo[x].val_habilitacion  + '</td>' +
          '<td>' +  arreglo[x].estado + '</td>' +
          '<td>'+ ' <a href="/asignatura_tecnicos/actualizar/'+ arreglo[x].id +' "  data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;"></i></a>' + 
                  '&nbsp&nbsp&nbsp; <a type="button" data-toggle="modal" data-target="#cambiarEstado"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;font-size:20px;"></i></a>'+
          '</td>' +//agregar los botones
          '</tr>';
          $('#datos').append(valor);
        }else{
         
            var valor = '<tr>' +
            '<td>' +  arreglo[x].codigoasig +'</td>' +
            '<td>' +  arreglo[x].asig + '</td>' +
            '<td>' +  arreglo[x].intensidad_horaria  + '</td>' +
            '<td>' +  arreglo[x].val_habilitacion  + '</td>' +
            '<td>' +  arreglo[x].estado + '</td>' +
            '<td>'+ ' <a href="/asignatura_tecnicos/actualizar/'+ arreglo[x].id +' "  data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308;"></i></a>' + 
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
    var nomas=$('#nomas').val();
    var intensidad_horaria=$('#intensidad_horaria').val();
    var val_habilitacion=$('#val_habilitacion').val();
    var estado='1';
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('datosasigtec')}}",
      data:{
        codigo:codigo,
        nomas:nomas,
        intensidad_horaria:intensidad_horaria,
        val_habilitacion:val_habilitacion,
        estado:estado,
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
            toastr.warning('Datos Repetidos!.', 'El código de la asignatura debe ser único!', {timeOut:3000});
          }else{
           if(jqXHR.status==423){
            toastr.warning('Datos Repetidos!.', 'El nombre de la asignatura  debe ser único!', {timeOut:3000});
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