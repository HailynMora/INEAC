@extends('usuario.principa_usul')
@section('content')
<div class="alert  text-center"  role="alert" style="background-color: #ffc107; color:#ffffff;">
  <h3 class="letra1"> Listado De Estudiantes Matriculados en Técnicos </h3>
</div>
<br>
<div class="container alerta">
     <form id="formu" method="POST">
       @csrf
       <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="idtec" id="idtec">
        <option selected>Seleccione un curso</option>
        @foreach($tecnico as $tec)
        <option value="{{$tec->id}}">{{$tec->nombretec}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-info">Filtrar</button>
    </form>
   </div>
    <br><br>
    <table class="table">
        <thead style="background-color:#0f468e; color:#ffffff" class="alerta">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo Doc</th>
            <th scope="col">No Documento</th>
            <th scope="col">Estado</th>
            <th scope="col">Curso</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1" style="background-color:#e3e3e3;" class="letraf">
          
        @if($b==1)
        @php
        $con = 1;
        @endphp
        @foreach($estutec as $e)
        <tr style="background-color: #E3E3E3;">
        <td>{{$con++}}</td>
        <td>{{$e->nombre}} {{$e->segundonom}}</td>
        <td>{{$e->primerape}} {{$e->segundoape}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->aprobado}}</td>
        <td>{{$e->nombretec}}</td>
       <!-- idest
        idcur-->
         <!-- aprobado-->
        <td>
        <a href="{{route('certifEstuTec',$e->idest)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Certificados"><i class="nav-icon fas fa-book" style="color:  #e1b308;font-size:20px;" ></i></a>&nbsp&nbsp&nbsp
        <a href="/matricula/estudiante/actualizar/{{$e->id}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>
        &nbsp&nbsp
        <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$e->id}}"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red;font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>
               <div class="modal fade" id="cambiarEstado{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                 <div class="modal-header" style="color:#ffffff;!important;">
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
                        <span>¿Desea retirar al estudiante:&nbsp; {{$e->nombre}} {{$e->segundonom}} {{$e->primerape}} {{$e->segundoape}}? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <form action="/cambiar/estado/matricula" method="GET">
                     @csrf
                    <input id="idestudiante" name="idestudiante" value="{{$e->id}}" hidden>
                    <button type="submit" class="btn btn-success">Cambiar</button>&nbsp;&nbsp;
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </form>
                  </div>
                </div>
              </div>
           </div>
      
      
      </td>
        </tr>
        @endforeach
       @endif
        </tbody>
        <!---respuesta de ajax-->
        <tbody id="tabla2"   style="background-color:#e3e3e3;" class="letraf">

        </tbody>
        <!--end respuesta-->
    </table>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
        <div class="container-fluid">
        @if($b==1)
         {{$estutec->links()}}
         @endif
       </div>
      </div>
      <div class="col-md-4">
      </div>
      <div class="col-md-2 alerta">
        <h2 class="mb-0">
          <a class="btn btn-link float-right" type="button" href="/visualizar/estudiante">
          <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> <span class="alerta">Volver</span>
          </a>
        </h2>
      </div>
    </div>
   
</div>


<!---##########################3--->
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
                        <span>¿Cambiar estado del estudiante? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <form action="{{route('deshaestudiante')}}" method="POST">
                      @csrf
                    <input id="idestudiante" name="idestudiante"> 
                    <button type="submit" class="btn btn-success">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </form>
                  </div>
                </div>
              </div>
            </div>
    <!--Find Modal deshabilitar y habilitar-->

<!----######################--->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#formu').submit(function(e){
    e.preventDefault();
    var idtec=$('#idtec').val();
    var _token = $('input[name=_token]').val();
    $.ajax({
      url:"{{route('estutec')}}",
      type: "POST",
      data:{
        idtec:idtec,
        _token:_token,
      }
    }).done(function(response){
      var ar = JSON.parse(response);
      $("#tabla1").hide();
      $("#tabla2").empty();
      if(ar.length!=0){

        var conta=0;
        for(var i=0; i<ar.length; i++){
        
          if(ar[i].aprobado != "Retirado"){
            conta++;
            var respuesta = '<tr>' +
            '<td>' +  conta + '</td>' +
            '<td>' +  ar[i].nombre + ' '+ar[i].segundonom +'</td>' +
            '<td>' +  ar[i].primerape + ' ' +  ar[i].segundoape  +'</td>' +
            '<td>' +  ar[i].destipo  + '</td>' +
            '<td>' +  ar[i].num_doc  + '</td>' +
            '<td>' +  ar[i].aprobado + '</td>' +
            '<td>' +  ar[i].nombretec + '</td>' +
            '<td>' +'<a href="#"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Certificados"><i class="nav-icon fas fa-book" style="color:  #e1b308; font-size:20px;" ></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>'
              + '<a href="/matricula/estudiante/actualizar/' + ar[i].id + '" type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308; font-size:20px;" ></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>'+ 
                '<a type="button" data-toggle="modal" data-target="#cambiar'+ ar[i].id +'"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red; font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>'+
               ' <div class="modal fade" id="cambiar'+ ar[i].id +'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
              '<div class="modal-dialog" role="document">'+
               ' <div class="modal-content">'+
                 '<div class="modal-header" style="background-color:FFC107; color:#ffffff;!important;">'+
                    '<h4 class="modal-title text-center" style=" text-align: center;">'+
                     '<div id="nomdoc" class="reset"></div>'+
                    '</h4>'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                      '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                  '</div>'+
                  '<div class="modal-body mt-2 text-center">'+
                    '<strong style="text-align: center !important">'+
                      '<h4 class="modal-title text-center" style=" text-align: center;">'+
                        '<span>¿Desea retirar al estudiante:&nbsp;'+ar[i].nombre+ ' '+ar[i].primerape+'? </span>'+
                      '</h4>'+
                    '</strong>'+
                  '</div>'+
                  '<div class="modal-footer">'+
                    '<form action="/cambiar/estado/matricula" method="GET">'+
                     '@csrf'+
                    '<input id="idestudiante" name="idestudiante" value="'+ ar[i].id +'" hidden>'+ 
                    '<button type="submit" class="btn btn-success">Cambiar</button>&nbsp;&nbsp;'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>'+
                     '</form>'+
                  '</div>'+
                '</div>'+
              '</div>'+
           '</div>'+
            '</td>' +//agregar los botones
            '</tr>';
          
              $('#tabla2').append(respuesta);
          }else{
            
          }
         
        }
  

      }else{
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $("#tabla1").show();

      }    
    })
  });
</script>
@endsection

