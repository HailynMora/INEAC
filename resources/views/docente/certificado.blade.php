@extends('usuario.principa_usul')
@section('content')
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
    <a href="{{route('pdfLaboral')}}"><img src="{{asset('dist/img/pdf.png')}}" class="img-fluid" ></a>
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
              EL SUSCRITO RECTOR DEL INSTITUTO DE EDUCACIÓN TECNICA INESUR, DEL MUNICIPIO PASTO - NARIÑO 
            </h5><br><br>
            <h6 class="text-center">
                HACE CONSTAR
            </h6>
           </div>
        </div>
        <hr style="background-color:black;">
        <div class="row">
           <div class="col-12"> <br>
            <h6 style="text-align:justify;">
            Que el (la) señor(a) <b> {{strtoupper($idc->nombre)}} {{strtoupper($idc->apellido)}} </b> identificado(a) con cédula de ciudadania No. <b> {{strtoupper($idc->num_doc)}}</b>, docente de tiempo completo de esta institución desde el <b>{{date('Y-m-d', strtotime($idc->fec_vinculacion))}} </b>, cargo que viene desempeñando hasta la 
            presente fecha sin ninguna interrupción.
            </h6><br>
           </div>
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
@endsection