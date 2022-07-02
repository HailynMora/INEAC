<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Estudiantil</title>
    </head>
    <body>
        <div style="background-image:url({{ public_path('/img/pdf_inesur2.jpg')}}); background-position: center;  background-repeat: no-repeat;  background-size: cover; margin:-15px;">
           <br><br><br><br><br><br>
           <table>
            <tbody>
                <tr> 
                    <td style="width:5%;">
                    </td>
                    <td style="width:90%;"><br>
                        <h4 style="text-align:center;">
                            <b>EL SUSCRITO DIRECTOR GENERAL DE LA INSTITUCION EDUCATIVA DEL SUR INESUR<b>
                        </h4>
                        <p style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</p>
                        <p style="text-align:center;">Código DANE No. 352001006791</p><br>
                        <h4 style="text-align:center;">
                            CERTIFICA
                        </h4>
                    </td>
                    <td style="width:5%;">
                    </td>
                </tr>
                <tr> 
                    <td style="width:1%;">
                    </td>
                    <td style="width:94%;">
                        <p style="text-align:justify;">
                        Que, 
                        @if(isset($estudiante))
                        <b>{{strtoupper($estudiante->nombre)}} {{strtoupper($estudiante->segundonom)}} {{strtoupper($estudiante->primerape)}} {{strtoupper($estudiante->segundoape)}}</b>, identificado con {{$estudiante->destipo}} No. <b>{{$estudiante->num_doc}}</b>, curso y aprobó en esta institución el <b>{{strtoupper($estudiante->descripcion)}}</b> correspondiente al <b>{{$estudiante->cursodes}}</b> del bachillerato por ciclos, Calendario {{$estudiante->periodo}}. las valoraciones se relacionan a continuación:
                        </p><br>
                        @endif
                    </td>
                    <td style="width:5%;">
                      &nbsp;
                    </td>
                </tr>
                <br>
                <tr> 
                    <td style="width:5%;">
                    </td>
                    <td style="width:90%;"><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MATERIAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EQUIVALENCIA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONCEPTO 
                    </td>
                    <td style="width:5%;">
                      &nbsp;
                    </td>

                </tr>
                @if(isset($asig))
                @foreach($asig as $a)
                <tr> 
                    <td style="width:0.5%;">
                    </td>
                    
                    <td style="width:10%;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->definitiva}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->desem}}
                    </td>
                    
                    <td style="width:5%;">
                      &nbsp;
                    </td>
                    
                </tr>
                @endforeach
                @endif
                <br><br><br>
                <tr> 
                    <td style="width:5%;">
                    </td>
                    <td style="width:90%;"><br>
                        <p  style="text-align:center;">
                         ____________________________________________<br>
                         <b>ALEXANDER SARCHI GRIJALBA</b><br>
                         Director
                        </p><br>
                    </td>
                    <td style="width:5%;">
                      &nbsp;
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- html -->
        <br><br><br><br><br><br><br><br><br>
     </div>
    </body>
</html>


