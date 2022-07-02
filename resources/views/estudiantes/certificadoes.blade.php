@extends('usuario.principa_usul')
@section('content')
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
    <a href="{{route('pdfEstudiantil')}}"><img src="{{asset('dist/img/pdf.png')}}" class="img-fluid" ></a>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <div  style="padding-left:40px; padding-right:40px;">
        <!--certifcado-->
        <div class="row">
          <div class="col-1">
          <img src="{{asset('img/logoin.jpg')}}" style="width:60px; height: 80px;">
           </div>
           <div class="col-10">
            <h5 class="text-center">INSTITUTO DE EDUCACIÓN TECNICA INESUR</h5>
            <p class="text-center" style="text-align:justify;"> Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                Emanada por Secretaría de Educación Municipal de Pasto<br>
                Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
            </p>
           </div>
           <div class="col-1">
           </div>
        </div>
        <hr style="background-color:black;">
        <div class="row">
           <div class="col-12">
            <h5 class="text-center">
              <b>EL SUSCRITO DIRECTOR GENERAL DE LA INSTITUCION EDUCATIVA DEL SUR INESUR<b>
            </h5>
            <h6 class="text-center">RESOLUCION 0071 DE 20 DE ENERO DE 2014</h6>
            <h6 class="text-center">  Código DANE No.352001006791</h6><br><br>
            <h6 class="text-center">
                CERTIFICA
            </h6>
           </div>
        </div>
        <div class="row">
           <div class="col-12"> <br>
            <h6 style="text-align:justify;">
            Que, <b>{{strtoupper($idc->nombre)}} {{strtoupper($idc->segundonom)}} {{strtoupper($idc->primerape)}} {{strtoupper($idc->segundoape)}}</b>, identificado con {{$idc->destipo}} No. <b>{{$idc->num_doc}}</b>, curso y aprobó en esta institución el <b>{{strtoupper($idc->descripcion)}}</b> correspondiente al <b>{{$idc->cursodes}}</b> del bachillerato por ciclos, Calendario {{$idc->periodo}}. las valoraciones se relacionan a continuación:
            </h6><br>
           </div>
        </div>
        <div >
          <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">MATERIAS</th>
                <th scope="col">EQUIVALENCIA</th>
                <th scope="col">CONCEPTO</th>
              </tr>
            </thead>
            <tbody>
              @foreach($asig as $a)
              <tr>
                <th scope="row"></th>
                <td>{{$a->nombre}}</td>
                <td>{{$a->definitiva}}</td>
                <td>{{$a->desem}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div>
          <h6><b>SE PROMUEVE</b></h6>
        </div>
        <div>
          <h6>Para constancia se firma en San Juan de Pasto el día <span id="current_date"></span> </h6>
        </div>
         <br>
         <div class="row">
           <div class="col-12"> <br>
            <h6 class="text-center" style="text-align:justify;">
             ____________________________________________<br>
             <b>ALEXANDER SARCHI GRIJALBA</b><br>
             Director
            </h6><br>
           </div>
        </div>  
         <br>
         <hr style="background-color:black;">
        <div class="row">
           <div class="col-12"> <br>
            <h6 class="text-center" style="text-align:justify;">
            Dirección: Pasto calle 17 No. 26 - 66 Centro<br>
            Teléfono: 3143317164 Email: girardotjurado@yahoo.es – girardotjurado@hotmail.com
            </h6><br>
           </div>
        </div> 
        </div> 
        <!--end certificado-->
      </div>
    </div>
  </div>
</div>
<script>
  date = new Date();
  year = date.getFullYear();
  month = date.getMonth() + 1;
  day = date.getDate();
  document.getElementById("current_date").innerHTML = month + "/" + day + "/" + year;
</script>
@endsection