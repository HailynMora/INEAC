@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Programas técnicos registrados</h3>
</div>
<!--MODAL-->
@if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show alerta" role="alert">
        <strong >{{Session::get('mensaje')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
  @endif
<div class="row">
  <div class="col-6">
    <button type="button"class="btn btn-success my-2 my-sm-0 alerta" data-toggle="modal" data-target="#RegTec">
      Registro
    </button>
    <!--BOTON REGISTRO ASIGNATURAS--->
    <a href="{{route('reportetec')}}" class="btn btn-warning my-2 my-sm-0 alerta" style="color:white;" >Asig. técnicos</a>
    <!--FIN REGISTRAR ASIGNATURAS--->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalListartec">Listar</button>
      <!--modal listar-->
    <form action="{{route('listado_asig_tec')}}" method="POST">
      @csrf
    <div class="modal fade" id="modalListartec" tabindex="-1" aria-labelledby="modalListarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header letra1" style="background-color: #ffc107; color:#ffffff;">
          <h5 class="modal-title" id="modalListarLabel">Ingrese datos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body alerta">
          <!--formulario-->
          <div class="form-group">
            <label for="curso">Programa</label>
            <select id="cursoid" name="cursoid" class="form-control" required>
            <option value="0" selected>Seleccionar</option>
            @if(isset($rep[0]))
                @foreach($rep as $per)
                    <option value="{{$per->id}}">{{$per->nombretec}}</option>
                @endforeach
              @else
               <option value="0" selected>Sin datos</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="periodo">Trimestre</label>
            <select id="trim" name="trim" class="form-control" required>
            <option value="0" selected>Seleccionar</option>
              @foreach($tri as $tr)
                    <option value="{{$tr->id_trimestre}}">{{$tr->nombretri}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="anio">Año</label>
            <select id="aniot" name="aniot" class="form-control" required>
            <option value="0" selected>Seleccionar</option>
               @foreach($anio as $an)
                    <option value="{{$an->anio}}">{{$an->anio}}</option>
                @endforeach
            </select>
          </div>
          <!--end formulario-->
        </div>
        <div class="modal-footer alerta">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  </form>
    <!--end modal-->
  </div>
  <div class="col-6">
    <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="Ejm. Técnico en sistemas" aria-label="Search">
      <button type="submit" class="btn btn-primary my-2 my-sm-0 alerta">Buscar</button>
    </form>
    <br><br><br>
  </div>
  <!--INICIO MODAL-->
    <form id="forprogramas" name="forprogramas" method="POST">
      @csrf
      <div class="modal fade" id="RegTec" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <h3 class="text-center letra1" style="background-color: #FFC107; color:#ffffff; padding-top:15px; padding-bottom:15px;">
              Registro  de programas técnicos
            </h3>
            <div class="modal-body">
              <!--registrar modal-->
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fas fa-edit"></i> Programa técnico
                        </button>
                      </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body letraf">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nomtec" name="nomtec" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="codigo">Código</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" min="0" minlength="4" maxlength="6"  required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="jornada">Jornada</label>
                            <select id="jornada" class="form-control" name="jornada" required>
                              <option selected>Seleccionar</option>
                              <option value="Sabado">Sábado</option>
                              <option value="Domingo">Domingo</option>
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
                <a  class="btn btn-danger" href="{{url('/programas/reporte_programas_tecnicos')}}">Salir</a>
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

<div class="accordion" id="accordionExample">
  <div class="card">

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <!--tabla-->
       <div class="container table-responsive">
          <table class="table">
              <thead class="alerta" style="background-color:#0f468e; color:white;">
                  <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Programa</th>
                  <th scope="col">Jornada</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Opciones</th>
                  </tr>
              </thead>
              <tbody class="letraf" id="tabla1">
              @foreach($rep as $d)
              <tr style="background-color:#E3E3E3;">
              <td>{{$d->codigotec}}</td>
              <td>{{$d->nombretec}}</td>
              <td>{{$d->jornada}}</td>
              <td>{{$d->descripcion}}</td>
              <td>{{$d->estado}}</td>
              <td>
              @if($d->estado == 'Activo')
              <a href="{{route('actualizar_prog_tec',$d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i></a>
              @endif
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
              @if($d->estado == 'Activo')
              <a href="{{route('vincular_asig', $d->id)}}" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308; font-size:20px;" ></i></a>        
              @endif
            </td>
              </tr>
              <!-- Ventana modal para deshabilitar -->
              <div class="modal fade" id="cambiarPro{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header alerta" style="background-color: #FFC107; color:white;">
                              <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                                  <span>¿Cambiar el estado <span style="color:black;">{{$d->estado}}</span> del programa? </span>
                              </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button> 
                          </div>
                          <div class="modal-body mt-2 text-center alerta">
                              <strong style="text-align: left !important"> 
                                  <h4>Programa: {{ $d->codigotec }} - {{ $d->nombretec }}</h4>
                              </strong>
                          </div>
                          <div class="modal-footer letraf">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                              <a  class="btn btn-success" href="{{ route('cambiarProTec', $d->id) }}">Guardar</a>
                          </div>
                      </div>
                  </div>
              </div>
              <!---fin ventana deshabilitar--->
              @endforeach
              </tbody>
              <!--##################datos de la busqueda ##########################3-->
              <tbody class="letraf" id="datos" style="background-color:#E3E3E3;">
              </tbody>
            <!--##########################################33-->
          </table>
      </div>
       <!--end table-->
      </div>
    </div>
  </div>
</div>
    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    console.log(nombre);
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('buscartecpro')}}",
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
          if( arreglo[x].estado == "Activo"){
            var valor = '<tr>' +
                        '<td>' +  arreglo[x].codigotec +'</td>' +
                        '<td>' +  arreglo[x].nombretec + '</td>' +
                        '<td>' +  arreglo[x].jornada + '</td>' +
                        '<td>' + arreglo[x].descripcion +'</td>' +
                        '<td>' +  arreglo[x].estado + '</td>' +
                        '<td>' +  

                        '<a href="/programastecnicos/actualizar/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Editar"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                        '<a type="button" data-toggle="modal" data-target="#cambiarPro'+ arreglo[x].id +'" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108; font-size:20px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                        '<a href="/vincularasig/'+arreglo[x].id+'" data-toggle="tooltip" data-placement="bottom"  title="Vincular Asignatura"><i class="nav-icon fas fa-file-alt" style="color:  #e1b308; font-size:20px;" ></i></a>'
                        
                        + '</td>' + //agregar los botones
                        '</tr>';
           }else{
              
                var valor = '<tr>' +
                            '<td>' +  arreglo[x].codigotec +'</td>' +
                            '<td>' +  arreglo[x].nombretec + '</td>' +
                            '<td>' +  arreglo[x].jornada + '</td>' +
                            '<td>' + arreglo[x].descripcion +'</td>' +
                            '<td>' +  arreglo[x].estado + '</td>' +
                            '<td>' +  
                            '<a type="button" data-toggle="modal" data-target="#cambiarPro'+ arreglo[x].id +'" data-placement="bottom" title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82; font-size:20px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a> '
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
    var nomtec=$('#nomtec').val();
    var codigo=$('#codigo').val();
    var estado='1';
    var descripcion=$('#descripcion').val();
    var jornada=$('#jornada').val();
    var _token = $('input[name=_token]').val(); //token de seguridad
console.log(nomtec);
    $.ajax({
      type: "POST",
      url: "{{route('regprogramastec')}}",
      data:{
        nomtec:nomtec,
        codigo:codigo,
        estado:estado,
        descripcion:descripcion,
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