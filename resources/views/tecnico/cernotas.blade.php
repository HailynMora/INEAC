<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Estudiantil</title>
    </head>
    <body  style=" width:100%;  height: 100%;">
        <br><br>
        @if(isset($estudiante->nombre))
        <div style="background-image:url({{ public_path('/img/pdf_inesur2.jpg')}}); background-position:center;  background-repeat: no-repeat; background-size:cover; margin-top:-4rem; margin-left:-3.1rem; margin-right:-2rem;  margin-bottom:-1rem;">
        <div  style="padding-top: 95px;">
           <!-- <div>
                <img src="{{ public_path('/img/pdf_i.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
            <div style="padding-left: 4rem; padding-right: 4rem;">
            <br>
            <div>
                <h4 style="text-align:center;">
                    <b>EL SUSCRITO DIRECTOR GENERAL DEL INSTITUTO DE EDUCACI&Oacute;N TECNICA INESUR</b>
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
                 en esta institución el <b>{{strtoupper($estudiante->nombretec)}}</b> <b>{{$estudiante->nombretri}}</b>, Calendario {{$estudiante->periodo}}. las valoraciones se relacionan a continuación:
                @endif
               </p>
            </div>
            <br>
            <div>
               <!--tabla-->
               <table>
                  <tr>
                    <th style="padding-left: 3rem; padding-right: 3rem;">MATERIA</th>
                    <th style="padding-left: 3rem; padding-right: 3rem;">CALIFICACIÓN</th>
                    <th style="padding-left: 3rem; padding-right: 3rem;">CONCEPTO</th>
                  </tr>
                @if(isset($asig))
                @foreach($asig as $a)
                  <tr>
                    <td style="padding-left: 3rem; padding-right: 3rem;">{{$a->nombreasig}}</td>
                    <td style="padding-left: 3rem; padding-right: 3rem;">{{$a->definitiva}}</td>
                    <td style="padding-left: 3rem; padding-right: 3rem;">{{$a->desem}}</td>
                  </tr>
                @endforeach
                @endif
                </table>
               <!--end table-->
            </div>
            <br>
            <div>
                @if($not!=0)
                <p>NO SE PROMUEVE.</p>
                @endif
                @if($not==0)
                <p>SE PROMUEVE.</p>
                @endif
            </div>
           <div>
              <p>Para constancia se firma en Potosi </p>
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

           <?php
            $conta = count($asig);
            ?>

            @if($conta==3)
              <br><br><br>
            @endif
            @if($conta==2)
              <br><br><br><br><br>
            @endif
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
