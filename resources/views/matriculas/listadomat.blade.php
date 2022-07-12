@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  <h4> Listado De Estudiantes Matriculados En Bachillerato</h4>
</div>
<br>
<div class="container">
     <form id="formu" method="POST">
       @csrf
       <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="idbachi" id="idbachi">
        <option selected>Seleccione un curso</option>
        @foreach($program as $p)
        <option value="{{$p->idcur}}">{{$p->nomcur}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-info">Filtrar</button>
    </form>
  </div>
    <br><br>
    <table class="table ">
        <thead style="background-color:#F9FF79;">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo Doc</th>
            <th scope="col">No Documento</th>
            <th scope="col">Telefono</th>
            <th scope="col">Curso</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1">
        @if($b==1)
        @php
        $con = 1;
        @endphp
        @foreach($estumat as $e)
        <tr style="background-color: #B5F2FF;">
        <td>{{$con++}}</td>
        <td>{{$e->nombre}} {{$e->segundonom}}</td>
        <td>{{$e->primerape}} {{$e->segundoape}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->telefono}}</td>
        <td>{{$e->nomcurso}}</td>
        <td>{{$e->estadoes}}</td>
       <!-- idest
        idcur-->
        
        <td>
        <a href="/matricula/estudiante/bachillerato/actualizar/{{$e->idmat}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>
        &nbsp&nbsp
        <!---deshabilitar un estudiante-->
          <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$e->idmat}}"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>
                <div class="modal fade" id="cambiarEstado{{$e->idmat}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                      <form action="/cambiar/estado/matricula/bachillerato" method="GET">
                      @csrf
                      <input id="idestudiante" name="idestudiante" value="{{$e->idmat}}" hidden>
                      <button type="submit" class="btn btn-success">Cambiar</button>&nbsp;&nbsp;
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        <!---final deshabilitar estudiante-->
        </td>
        </tr>
        @endforeach
       @endif
        </tbody>
        <tbody id="tabla2" style="background-color: #B5F2FF;">
        </tbody>
    </table>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
        <div class="container-fluid">
        @if($b==1)
         {{$estumat->links()}}
        @endif
       </div>
      </div>
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
        <h2 class="mb-0">
          <a class="btn btn-link float-right" type="button" href="/visualizar/estudiante">
          <i class="fas fa-arrow-circle-left"></i> Volver
          </a>
        </h2>
      </div>
    </div>
   
</div>
@if($b=0)
         hola
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#formu').submit(function(e){
    e.preventDefault();
    var idbachi=$('#idbachi').val();
    var _token = $('input[name=_token]').val();
    console.log(idbachi);
    $.ajax({
      url:"{{route('estubachillerato')}}",
      type: "POST",
      data:{
        idbachi:idbachi,
        _token:_token,
      }
    }).done(function(response){
      var ar = JSON.parse(response);
      $("#tabla1").hide();
      $("#tabla2").empty();
      if(ar.length!=0){

        var conta=0;
        for(var i=0; i<ar.length; i++){
          if(ar[i].aprobado!="Retirado"){
            conta++;
            var respuesta = '<tr>' +
            '<td>' +  conta + '</td>' +
            '<td>' +  ar[i].nombre + ' '+ar[i].segundonom +'</td>' +
            '<td>' +  ar[i].primerape + ' ' +  ar[i].segundoape  +'</td>' +
            '<td>' +  ar[i].destipo  + '</td>' +
            '<td>' +  ar[i].num_doc  + '</td>' +
            '<td>' +  ar[i].telefono  + '</td>' +
            '<td>' +  ar[i].nomcurso + '</td>' +
            '<td>' +  ar[i].estadoes + '</td>' +
            '<td>' 
              + '<a href="/matricula/estudiante/bachillerato/actualizar/' + ar[i].idmat + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp&nbsp;'+ 
                '<a type="button" data-toggle="modal" data-target="#estado'+ar[i].idmat+'"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>'+
               ' <div class="modal fade" id="estado'+ar[i].idmat+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
              '<div class="modal-dialog" role="document">'+
               ' <div class="modal-content">'+
                 '<div class="modal-header" style="color:#ffffff;!important;">'+
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
                    '<form action="/cambiar/estado/matricula/bachillerato" method="GET">'+
                     '@csrf'+
                    '<input id="idestudiante" name="idestudiante" value="'+ ar[i].idmat +'" hidden>'+ 
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

        
       
        
        
        
        