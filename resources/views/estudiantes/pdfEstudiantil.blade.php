<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado De Notas</title>
    </head>
    <body  style=" width:100%;  height: 100%;">
        <br><br>
        @if(isset($estudiante->nombre))
        <div style="background-image:url({{ public_path('/img/pdf_inesur2.jpg')}}); background-position:center;  background-repeat: no-repeat; background-size:cover; margin-top:-4rem; margin-left:-5rem; margin-right:-5rem;  margin-bottom:-2rem;">
        <div  style="padding-top: 95px;">
           <!-- <div>
                <img src="{{ public_path('/img/pdf_i.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
            <div style="padding-left: 4rem; padding-right: 4rem;">
            <br>
            <div>
                <h4 style="text-align:center;">
                    <b>EL SUSCRITO DIRECTOR GENERAL DEL INSTITUTO DE EDUCACIÓN TECNICA INESUR</b>
                </h4>
                <p style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</p>
                <p style="text-align:center;">Código DANE No. 352001006791</p><br>
                <h4 style="text-align:center;">
                    CERTIFICA
                </h4>
            </div>
            <div>
                <p style="text-align:justify;  line-height:1.3;">
                Que, 
                @if(isset($estudiante))
                <b>{{strtoupper($estudiante->nombre)}} {{strtoupper($estudiante->segundonom)}} {{strtoupper($estudiante->primerape)}} {{strtoupper($estudiante->segundoape)}}</b>, identificado con {{$estudiante->destipo}} No. <b>{{$estudiante->num_doc}}</b>, curso y 
                 @if($not!=0)
                no aprobó
                @endif
                @if($not==0)
                aprobó
                @endif
                 en esta institución el <b>{{strtoupper($estudiante->descripcion)}}</b> correspondiente al <b>{{$estudiante->cursodes}}</b> del bachillerato por ciclos, Calendario {{$estudiante->periodo}}. las valoraciones se relacionan a continuación:
                @endif
               </p>
            </div>  
            <div>
               <!--tabla-->
               <table>
                  <tr>
                    <th style="padding-left: 3rem; padding-right: 3rem;">MATERIA</th>
                    <th style="padding-left: 8rem; padding-right: 8rem;">CALIFICACIÓN</th>
                    <th style="padding-left: 3rem; padding-right: 3rem;">CONCEPTO</th>
                  </tr>
                @if(isset($asig))
                @foreach($asig as $a)
                  <tr>
                    <td>{{$a->nombre}}</td>
                    <td style="padding-left: 8rem; padding-right:8rem;">{{$a->definitiva}}</td>
                    <td style="padding-left: 3rem; padding-right: 3rem;">{{$a->desem}}</td>
                  </tr>
                @endforeach
                @endif
                </table>
               <!--end table-->
            </div>
            <br>
            <div>
                
                <p>SE PROMUEVE: SI  NO</p>

            </div>
           <div>
             <p>Para constancia se firma en Potosi el dia {{$dia}} del mes {{$mes}}  del año {{$anio}}</p>
            </div>
            <div > 
            <br>
            <p  style="text-align:center;">
             ____________________________________________<br>
             <b>ALEXANDER SARCHI GRIJALBA</b><br>
             Director
            </p>
           </div>
           <br><br><br><br><br>
          <!-- <div>
                <img src="{{ public_path('/img/pdf_in.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
        <!-- html -->
     </div>
   </div>
   </div>
     @endif
    </body>
<style>
table {
  text-align:center;
  width: 50%;
}

th {
  height: 70px;
}
</style>

</html>
