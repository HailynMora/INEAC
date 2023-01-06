@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
  <h3 class="letra1"> Listado De Estudiantes Matriculados En Bachillerato</h3>
</div>
<br>
<div class="container alerta">
     <form id="formu" method="POST">
       @csrf
       <div class="row">
       <div class="col-md-4">
       <label>Elegir curso</label>
       <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="idbachi" id="idbachi">
        @foreach($program as $p)
        <option value="{{$p->idcur}}">{{$p->nomcur}}</option>
        @endforeach
      </select>
      </div>
       <div class="col-md-4">
       <label>Elegir periodo</label>
        <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="per" id="per">
          <option value="A">A</option>
          <option value="B">B</option>
        </select>
       </div>
       <div class="col-md-3">
        <label>Ingrese año</label>
        <input type="number" min="2000" class="form-select form-select-lg mb-3 form-control" placeholder="Ejemplo 2022" name="aniot" id="aniot" required> 
       </div> 
       <div class="col-md-1">
        <div class="container text-center" style="margin-top:32px;">
         <button type="submit" class="btn btn-primary">Filtrar</button>
       </div>
       </div>
      </div>
    </form>
  </div>
    <div class="table-responsive">
    <table class="table ">
        <thead style="background-color:#0f468e; color: #ffffff;" class="alerta">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Tipo Doc</th>
            <th scope="col">No Documento</th>
            <th scope="col">Curso</th>
            <th scope="col">Periodo</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tabla1" class="letraf">
        @if($b==1)
        @php
        $con = 1;
        @endphp
        @foreach($estumat as $e)
        <tr style="background-color: #e3e3e3;">
        <td>{{$con++}}</td>
        <td>{{$e->nombre}} {{$e->segundonom}}</td>
        <td>{{$e->primerape}} {{$e->segundoape}}</td>
        <td>{{$e->destipo}}</td>
        <td>{{$e->num_doc}}</td>
        <td>{{$e->nomcurso}}</td>
        <td>{{$e->anio}} - {{$e->periodo}} </td>
        <td>{{$e->estadoes}}</td>
       <!-- idest
        idcur-->
        
        <td>
        <a href="/matricula/estudiante/bachillerato/actualizar/{{$e->idmat}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>
          &nbsp&nbsp&nbsp
                <a href="{{route('certifEstu',$e->idest)}}"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Certificados"><i class="nav-icon fas fa-book" style="color:  #e1b308;font-size:20px;" ></i></a>&nbsp&nbsp&nbsp
        &nbsp&nbsp
        <!---deshabilitar un estudiante-->
          <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$e->idmat}}"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red;font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>
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
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
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
        <tbody id="tabla2" class="letraf" style="background-color:#e3e3e3;">
        </tbody>
    </table>
    </div>
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
          <i class="fas fa-arrow-circle-left" style="font-size:20px;"></i> Volver
          </a>
        </h2>
      </div>
    </div>
   
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
   $('#formu').submit(function(e){
    e.preventDefault();
    var idbachi=$('#idbachi').val();
    var per = $('#per').val();
    var anio = $('#aniot').val();
    var _token = $('input[name=_token]').val();
    console.log(anio);
    $.ajax({
      url:"{{route('estubachillerato')}}",
      type: "POST",
      data:{
        idbachi:idbachi,
        per:per,
        anio:anio,
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
            '<td>' +  ar[i].nomcurso + '</td>' +
            '<td>' +  ar[i].anio + '-' +  ar[i].periodo + '</td>' +
            '<td>' +  ar[i].estadoes + '</td>' +
            '<td>'
            + '<a href="/matricula/estudiante/bachillerato/actualizar/' + ar[i].idmat + '" ' + 'type="button" data-toggle="tooltip" data-placement="bottom"  title="Editar Estudiante"><i class="nav-icon fas fa-edit" style="color:#e1b308; font-size:20px;" ></i></a>&nbsp;&nbsp;'
              +'&nbsp&nbsp&nbsp <a href="/generar/certificado/estudiantil/'+ ar[i].idest +'"  type="button" data-toggle="tooltip" data-placement="bottom"  title="Certificados"><i class="nav-icon fas fa-book" style="color:#e1b308; font-size:20px;" ></i></a>&nbsp;&nbsp;&nbsp;'+
                '<a type="button" data-toggle="modal" data-target="#estado'+ar[i].idmat+'"  data-placement="bottom"  title="Retirar"> <i class="fas fa-user-times" style="color:red; font-size:20px;" data-toggle="tooltip" data-placement="bottom" title="Deshabilitar" ></i></a>'+
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
                    '<button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>&nbsp;&nbsp;'+
                    '<button type="submit" class="btn btn-primary">Guardar</button>'+
                    
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

        
       
        
        
        
        