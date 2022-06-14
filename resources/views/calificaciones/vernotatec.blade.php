@extends('usuario.principa_usul')
@section('content')
<!---collpased-->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <div class="row">
          <div class="col-4">
              <a  href="/asignatura/reporte" class="btn"><i class="fas fa-backward"></i>&nbsp;Regresar</a>
          </div>
          <div class="col-4"></div>
          <div class="col-4"></div>
      </div>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <!--table-->
       @foreach($nota as $n) 
               <div class="container text-center" style="padding-top:10px; padding-bottom:10px; background-color:#31FEFB;">
                <h5><b>Calificaciones</b></h5>
                 <div class="row">
                     <div class="col-2 text-left"><b>Estudiante:</b></div>
                     <div class="col-4 text-center">{{$n->nomes}}&nbsp;{{$n->second_nom}}&nbsp;{{$n->apes}}&nbsp;{{$n->second_ape}}</div>
                     <div class="col-3"><b>Curso:</b></div>
                     <div class="col-3">{{$n->curso}}</div>
                 </div>
                 <div class="row">
                     <div class="col-2 text-left"><b>Asignatura:</b></div>
                     <div class="col-4 text-center">{{$n->asignatura}}</div>
                     <div class="col-3"><b>Perido:</b></div>
                     <div class="col-3">{{$n->anio}} {{$n->periodo}}</div>
                 </div>
               </div><br>
                        <div style="background-color:#CDFFEB; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" >
                            <div class="row">
                                <div class="col-3">
                                    <b>N°</b>
                                </div>
                                <div class="col-6">
                                    <b>Calificación</b>
                                </div>
                                <div class="col-3">
                                    <b>Porcentaje</b>
                                </div>
                            </div>
                            <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                1
                            </div>
                            <div class="col-6">
                                <label>{{$n->nota1}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por1}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                2
                            </div>
                            <div class="col-6">
                                <label>{{$n->nota2}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por2}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                3
                            </div>
                            <div class="col-6">
                                <label>{{$n->nota3}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por3}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                4
                            </div>
                            <div class="col-6">
                                <label>{{$n->nota4}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por4}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                           <div class="col-3" style="padding-left:15px;">
                              <h6><b>Definitiva:</b></h6>
                            </div>
                            <div class="col-6">
                            </div>
                            <div class="col-3">
                              <label><p>{{$n->definitiva}}</p></label>
                            </div>
                        </div>
                </div>
             @endforeach
       <!--end table--->
      </div>
    </div>
  </div>
</div>
<!--end collapsed-->
@endsection