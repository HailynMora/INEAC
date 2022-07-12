<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado de Matricula Estudiantil </title>
    </head>
    <body  style=" width:100%;  height: 100%;">
        <br><br>
        @if(isset($estudiante->nombre))
        <div style="background-image:url({{ public_path('/img/pdf_inesur2.jpg')}}); background-position:center;  background-repeat: no-repeat; background-size:cover; margin-top:-5rem; margin-left:-4.1rem; margin-right:-3rem;  margin-bottom:-2rem;">
        <div  style="padding-top: 90px;">
           <!-- <div>
                <img src="{{ public_path('/img/pdf_i.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
            <br><br> <br><br> <br><br>
            <div style="padding-left: 4rem; padding-right: 4rem;">
            <br>
            <div>
                <br><br>
                <h4 style="text-align:center;">
                    <b>EL SUSCRITO DIRECTOR GENERAL DE LA INSTITUCION EDUCATIVA DEL SUR INESUR<b>
                </h4>
                <p style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</p>
                <p style="text-align:center;">Código DANE No. 352001006791</p><br>
                <h4 style="text-align:center;">
                    CERTIFICA
                </h4>
            </div>
            <br><br>
            <div>
                <p style="text-align:justify;  line-height:1.3;">
                Que, 
                @if(isset($estudiante))
                <b>{{strtoupper($estudiante->nombre)}} {{strtoupper($estudiante->segundonom)}} {{strtoupper($estudiante->primerape)}} {{strtoupper($estudiante->segundoape)}}</b>, identificado con {{$estudiante->destipo}} No. <b>{{$estudiante->num_doc}}</b>, se encuentra matriculado y {{$estudiante->apo}} el programa <b>{{strtoupper($estudiante->nombretec)}}</b>,<b>{{$estudiante->nombretri}}</b> en la sede del municipio de Potosi.

                <br><br>
                Correspondiente al Periodo {{$estudiante->periodo}}.
                </p>

                @endif
            </div>
            <br>
            <div>
                <p>Este certificado se expide a solicitud del interesado.</p>
            </div>
            <br><br>
           <div>
              <p>Para constancia se firma en Potosi el dia {{$dia}} del mes {{$mes}}  del año {{$anio}}</p>
            </div>
            <div > 
            <br><br><br>
            <p  style="text-align:center;">
             ____________________________________________<br>
             <b>ALEXANDER SARCHI GRIJALBA</b><br>
             Director
            </p>
           </div>
           <br><br><br>
          <!-- <div>
                <img src="{{ public_path('/img/pdf_in.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
        <!-- html -->
     </div>
     <br><br><br>
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
