@extends('usuario.principa_usul')
@section('content')

<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Reporte Asignaturas Bachillerato</h3>
</div>
<!--collapsed-->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
         <!--cabecera-->
         <div class="row">
            <div class="col-md-6">
            @if($boton!=0)
             <a href="{{route('reporte_asigdoc')}}" class="btn btn-outline-success" >Asignaturas Técnicos</a>
            @endif
            <!---filtrar-->
            <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-filter"></i>
              </button>
             <!-- Button trigger modal -->
              <!-- Modal -->
              <form action="{{route('filtrarasignacion')}}" method="POST">
                @csrf
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Filtro de asignaturas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!--formulario-->
                      <div class="row">
                          <div class="col-6">
                            <input type="text" name="anio" class="form-control" placeholder="Año ejm. 2022"  aria-describedby="addon-wrapping" required>
                          </div>
                          <div class="col-6">
                            <input type="text"  name="periodo" class="form-control" placeholder="Periodo ejm. A"  aria-describedby="addon-wrapping" required>
                          </div>
                        </div>
                      </form>
                    <!--end filtrar-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:#33FFDD; color:black;">Salir</button>
                      <a href="{{route('reporte_asigdocc')}}" type="button" class="btn" style="background-color:#FFCC00;">Deshacer</a>
                      <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <!--end cabecera-->
      </h2>
    </div>
    <!--mensajes-->
    <br>
    @if(Session::has('msjobjetivo'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> {{Session::get('msjobjetivo')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(Session::has('elimi'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{Session::get('elimi')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <!--end mensajes-->
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <!--tabla-->
            <div class="table-responsive">
                <table class="table">
                    <thead style="background-color:#FFCC00;">
                        <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Asignatura</th>
                        <th scope="col">Intensidad Horaria</th>
                        <th scope="col">Val. Habilitación</th>
                        <th scope="col">Programa</th>
                        <th scope="col">Anio</th>
                        <th scope="col">Periodo</th>
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
                    <td>{{$d->curso}}</td>
                    <td>{{$d->anio}}</td>
                    <td>{{$d->periodo}}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <a type="button" class="btn" data-toggle="modal" data-target="#staticBackdrop{{$d->ida}}">
                          <i class="fas fa-book-open"></i>
                        </a>
                        <a type="button" data-toggle="modal" data-target="#listaModal{{$d->ida}}" title="Lista de Objetivos">
                          <i class="fas fa-list-alt"></i>
                        </a>
                        <!-- vemtana de registrar notas -->
                        <a href="/registro/notas/{{$d->idcurso}}/{{$d->anio}}/{{$d->periodo}}/{{$d->idasig}}" title="Ingresar notas" style="color: #678a3f;">
                          <i class="fas fa-sticky-note"></i>
                        </a>
                        <!-- Modal -->
                    <form action="{{route('regobjet')}}"  method="post" id="objetivosform">
                      @csrf
                      <div class="modal fade" id="staticBackdrop{{$d->ida}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Registrar Objetivos de la asignatura: <span style="background-color:Yellow;">{{$d->asig}}</span></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <!--###############################--->
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Objetivo</label>
                                <textarea class="form-control" id="objetivo" name="objetivo" rows="3"></textarea>
                              </div>
                              <input type="text" id="idasigna" name="idasigna" value="{{$d->ida}}" hidden>
                          <!---###############################--> 

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    </td>
                    </tr>
                    <!---modal de objetivos visualizar-->
                    <div class="modal fade" id="listaModal{{$d->ida}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Objetivos de la asignatura: <span style="background-color:Yellow;">{{$d->asig}}</span></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <!--###############################--->
                            <?php 
                              $contador=1;
                            ?>
                            @if($b!=0)
                              <div style="background-color:#CDFFEB; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" >
                              <div class="row">
                                    <div class="col-2">
                                      No
                                    </div>
                                    <div class="col-8">
                                      Objetivos
                                    </div>
                                    <div class="col-2">
                                      Acción
                                    </div>
                                </div>
                              </div>
                                <hr style="background-color:black;">
                            @foreach($ob as $j)
                              @if($j->id_asignaturas==$d->ida)
                                <div class="row">
                                    <div class="col-2" style="padding-left:15px;">
                                      {{$contador++}}
                                    </div>
                                    <div class="col-8">
                                      {{$j->descripcion}}
                                    </div>
                                    <div class="col-2">
                                      <a href="/eliminar/objetivos/{{$j->id}}" class="btn btn-success" type="button"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                                <hr style="background-color:black;">
                              @endif
                              @endforeach
                            @endif
                          <!---###############################--> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--end modal-->
                    @endforeach
                    </tbody>
                    <!--##################datos de la busqueda ##########################3-->
                    <tbody id="datos" style="background-color: #dcedc8;">
                    </tbody>
                  <!--##########################################33-->
                </table>
            </div>
        <!--end table-->
      </div>
    </div>
  </div>
</div>
<!--end collapsed-->

<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#buscar').submit(function(e){
    e.preventDefault();
    var nombre=$('#nombre').val();
    console.log(nombre);
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('busasigb')}}",
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
          '<td>' +  arreglo[x].curso + '</td>' +
          '<td>' +  arreglo[x].anio + '</td>' +
          '<td>' +  arreglo[x].periodo + '</td>' +
          '<td> <a type="button" class="btn" data-toggle="modal" data-target="#minfo'+ arreglo[x].id +'">'+
               '<i class="fas fa-book-open"></i></a>'+
               '<a type="button" data-toggle="modal" data-target="#listaModal'+ arreglo[x].id +'" title="Lista de Objetivos">'+
                '<i class="fas fa-list-alt"></i></a>'+
               '<form action="/objetivos/asignatura"  method="post">'+
               '@csrf'+
               '<div class="modal fade" id="minfo'+ arreglo[x].id +'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
                '<div class="modal-dialog">'+
                  '<div class="modal-content">'+
                    '<div class="modal-header">'+
                      '<h5 class="modal-title" id="staticBackdropLabel">Registrar Objetivos de la asignatura: <span style="background-color:Yellow;">'+  arreglo[x].asig +'</span></h5>'+
                      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                      '</button>'+
                    '</div>'+
                    '<div class="modal-body">'+
                    '<div class="form-group">'+
                        '<label for="exampleFormControlTextarea1">Objetivo</label>'+
                        '<textarea class="form-control" id="objetivo" name="objetivo" rows="3"></textarea>'+
                      '</div>'+
                      '<input type="text" id="idasigna" name="idasigna" value=" '+ arreglo[x].id +' " hidden>'+
                    '</div>'+
                    '<div class="modal-footer">'+
                      '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>'+
                      '<button type="submit" class="btn btn-primary">Guardar</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '</form>'+

          '</td>' +
          '</tr>';
          $('#datos').append(valor);
        }else{
         
            var valor = '<tr>' +
            '<td>' +  arreglo[x].codigo +'</td>' +
            '<td>' +  arreglo[x].asig + '</td>' +
            '<td>' +  arreglo[x].intensidad_horaria  + '</td>' +
            '<td>' +  arreglo[x].val_habilitacion  + '</td>' +
            '<td>' +  arreglo[x].curso + '</td>' +
            '</tr>';
            $('#datos').append(valor);
        }

        //document.getElementsByName("idasig")[0].value = arreglo[x].id;

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