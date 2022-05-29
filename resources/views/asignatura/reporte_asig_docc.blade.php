@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3> Reporte Asignaturas Técnicos</h3>
</div>
<a href="{{route('reporte_asigdoc')}}" type="submit" class="btn btn-outline-success my-2 my-sm-0">Asignaturas Técnicos</a>
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
            <th scope="col">Programa</th>
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
        <td>
          <!-- Button trigger modal -->
          <a type="button" data-toggle="modal" data-target="#objetivosModal{{$d->ida}}" title="Objetivos">
            <i class="fas fa-book-open"></i>
          </a>
          &nbsp&nbsp&nbsp
          <a type="button" data-toggle="modal" data-target="#listaModal{{$d->ida}}" title="Lista de Objetivos">
            <i class="fas fa-ellipsis-h"></i>
          </a>
        </td>
        </tr>
        <!-- Modal -->
        <form id="regobjetivo" >
          @csrf
          <div class="modal fade" id="objetivosModal{{$d->ida}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Objetivos de Asignatura {{$d->asig}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Objetivo</label>&nbsp
                    </div>
                    <div class="col-md-9">
                      <textarea rows="2" cols="60" id="objetivo" name="objetivo" > </textarea>
                      <input value="{{$d->ida}}" name="idasig" id="idasig"  >
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Enviar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          </form>
       <!--fin modak-->
       <!-- Modal lista objetivos-->
       
        <!--lista objetivos-->
        @endforeach
        </tbody>
        <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
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
  $('#regobjetivo').submit(function(e){
    e.preventDefault();
    var obj=$('#objetivo').val();
    var asig=$('#idasig').val();
    var _token = $('input[name=_token]').val(); //token de seguridad
    console.log(obj);
    console.log(asig);
    $.ajax({
      type: "POST",
      url: "{{route('regobjet')}}",
      data:{
        obj:obj,
        asig:asig,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#regobjetivo')[0].reset();
          toastr.success('Objetivo registrado con exito', 'Nuevo Registro', {timeOut:3000});
          $('#objetivo').val('');
        }
      }
    });
  });
  
</script>
@endsection