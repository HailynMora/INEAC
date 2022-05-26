@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado de Docentes</h3>
</div>
<div>
<div class="row">
  <div class="col-md-6">
  
  </div>
  <div class="col-md-6">
  <form id="buscar" class="form-inline my-6 my-lg-0 float-right mb-6">
      @csrf
      <input id="nombre" name="nombre" class="form-control mr-sm-2" placeholder="No. Identificación" aria-label="Search" required>
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Buscar</button>
    </form>
    </div>
</div>
    <br><br>
    <div class="container">
      <table class="table table-striped"style="background-color:#FFCC00;">
      <thead>
          <tr>
          <th scope="col">Tipo Doc</th>
          <th scope="col">Documento</th>
          <th scope="col">Nombres</th>
          <th scope="col">Fec. Vinculación</th>
          <th scope="col">Estado</th>
          </tr>
      </thead>
      <tbody id="tabla1">
        @if($b == 1)
          @foreach($doc as $d)
          <tr style="background-color: #dcedc8;">
            <td>{{$d->descripcion}}</td>
            <td>{{$d->num_doc}}</td>
            <td>{{$d->nombre}}  {{$d->apellido}}</td>
            <td>{{date("Y-m-d", strtotime($d->fec_vinculacion))}}</td>
            <td>{{$d->estado}}</td>
            <td>
          </td>
        </tr>
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
          No Hay Registros
        </div>
        @endif
      </tbody>
      <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
    @if($b==1)
    {{$doc->links()}}
    @endif
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
      url:"{{route('buscardoc')}}",
      type: "POST",
      data:{
        nombre:nombre,
        _token:_token,
      }
    }).done(function(response){
      var arreglo =response;
        var conta=0;
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").hide(); 
        $(".reset").empty(); 
        $('#asignatura').empty();
        //$("#datosdos").empty();
      for(var x=0; x<arreglo.busdocente.length; x++){
          conta+=1;
         
          if ( arreglo.busdocente[x].estado == "Activo") { // true
            var valor = '<tr>' +
          '<td>' +  arreglo.busdocente[x].descripcion +'</td>' +
          '<td>' +  arreglo.busdocente[x].num_doc + '</td>' +
          '<td>' +  arreglo.busdocente[x].nombre  + ' ' +  arreglo.busdocente[x].apellido +'</td>' +
          '<td>' +  dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd')  + '</td>' +
          '<td>' +  arreglo.busdocente[x].estado + '</td>' +
          '<td>' +   
          '<a type="button"  data-toggle="modal" data-target="#exampleModal" style="color: #66b62b"  data-placement="bottom"  title="Visualizar"><i class="nav-icon fas fa-eye"></i></a>&nbsp&nbsp&nbsp'+
          '</td>' + //agregar los botones
          ' </tr>';
            
          } else {

            var valor = '<tr>' +
          '<td>' +  arreglo.busdocente[x].descripcion +'</td>' +
          '<td>' +  arreglo.busdocente[x].num_doc + '</td>' +
          '<td>' +  arreglo.busdocente[x].nombre  + ' ' +  arreglo.busdocente[x].apellido +'</td>' +
          '<td>' +  dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd')  + '</td>' +
          '<td>' +  arreglo.busdocente[x].estado + '</td>' +
          '<td>' +    
          '<a type="button"  data-toggle="modal" data-target="#exampleModal" style="color: #66b62b"  data-placement="bottom"  title="Visualizar"><i class="nav-icon fas fa-eye"></i></a>&nbsp&nbsp&nbsp'+
          '</td>' + //agregar los botones
          ' </tr>';
           
          }

         
          var nombre = arreglo.busdocente[x].nombre + ' '  +  arreglo.busdocente[x].apellido;
          var tipodoc = arreglo.busdocente[x].descripcion;
          var num = arreglo.busdocente[x].num_doc; 
          var correo = arreglo.busdocente[x].correo;
          var tel = arreglo.busdocente[x].telefono;
          var dir = arreglo.busdocente[x].direccion;
          var gen = arreglo.busdocente[x].genero;
          var fec = dateFormat(arreglo.busdocente[x].fec_vinculacion, 'yyyy-MM-dd');
          var es = arreglo.busdocente[x].estado;
          var idoc =  arreglo.busdocente[x].id;
          //  
          //   
          $('#datos').append(valor);
          $('#dato').append(valor);
          $('#nomdocente').append(nombre); //nombre docente modal exampleModal
          $('#tipodocdocente').append(tipodoc); 
          $('#numdocdocente').append(num); 
          $('#correodocente').append(correo); 
          $('#direcciondocente').append(dir);
          $('#generodocente').append(gen);
          $('#telefonodocente').append(tel);
          $('#fecdocente').append(fec);
          $('#estadocente').append(es);
          $('#nomdoc').append(nombre);
          document.getElementsByName("idocente")[0].value = idoc; //colocar valores en los inputs
          
          //////////////////////////////////////asignaturas imprimirs
          for(var x=0; x<arreglo.datos.length; x++){
            var d = '<tr>' +
            '<td>' +  arreglo.datos[x].codigo +'</td>' +
            '<td>' +  arreglo.datos[x].asig +'</td>' + 
            '<td>' +  arreglo.datos[x].intensidad_horaria +'</td>' +
            '</tr>';
            $('#asignatura').append(d);//imprime los datos en la tabla
             
          }
         
          //////////////////////////////////////////////

        }

    
    }).fail(function(jqXHR, response){
        console.log(response);
        toastr.warning('Lo sentimos!', 'Datos no encontrados', {timeOut:3000});
        $('#buscar')[0].reset();
        $("#datos").empty();
        $("#tabla1").show();
      });
  });


</script>
<script>
  function JsonDate(jsonDate) {
  var date = new Date(parseInt(jsonDate.substr(6)));
  return date;
}
////////////////////////////////7
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}
////////////////////////7777////
</script>
@endsection