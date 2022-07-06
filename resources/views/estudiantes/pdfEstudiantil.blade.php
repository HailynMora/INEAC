<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Estudiantil</title>
    </head>
    <body>
        <div >
            <div>
                <img src="{{ public_path('/img/pdf_i.jpg')}}" style="width:100%; height: 100px;">
            </div>
           <div>
                <h4 style="text-align:center;">
                    <b>EL SUSCRITO DIRECTOR GENERAL DE LA INSTITUCION EDUCATIVA DEL SUR INESUR<b>
                </h4>
                <p style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</p>
                <p style="text-align:center;">Código DANE No. 352001006791</p><br>
                <h4 style="text-align:center;">
                    CERTIFICA
                </h4>
            </div>
            <div>
                <p style="text-align:justify;">
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
                </p>
                @endif
            </div>
            <div>
               <table>
                  <tr>
                    <th>MATERIA</th>
                    <th>CALIFICACIÓN</th>
                    <th>CONCEPTO</th>
                  </tr>
                @if(isset($asig))
                @foreach($asig as $a)
                  <tr>
                    <td>{{$a->nombre}}</td>
                    <td>{{$a->definitiva}}</td>
                    <td>{{$a->desem}}</td>
                  </tr>
                @endforeach
                @endif
                </table>
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
              <p>Para constancia se firma en San Juan de Pasto el día <div id="current_date"></p>
            </div>
            <div > 
            <br><br><br>
            <p  style="text-align:center;">
             ____________________________________________<br>
             <b>ALEXANDER SARCHI GRIJALBA</b><br>
             Director
            </p>
           </div>
           <br><br>
           <div>
                <img src="{{ public_path('/img/pdf_in.jpg')}}" style="width:100%; height: 100px;">
            </div>
        <!-- html -->
     </div>

    </body>
<style>
table {
  text-align:center;
  width: 100%;
}

th {
  height: 70px;
}
#fondo{
    background-image:url({{ public_path('/img/pdf_inesur2.jpg')}});
    background-position: center;
    background-repeat: no-repeat;  
    background-size: cover; 
}
</style>

</html>


