<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Titulo del Documento</title>
    </head>
    <body>
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="width:10%;">
                      <img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;">
                    </td>
                    <td style="width:90%;">&nbsp;
                      <h4 style="text-align:center;">INSTITUTO DE EDUCACIÓN TECNICA INESUR</h4>
                        <p style="text-align:center;"> Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                            Emanada por Secretaría de Educación Municipal de Pasto<br>
                            Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
                        </p>
                    </td>
                </tr>
                <tr> 
                    <td style="width:5%;">
                    </td>
                    <td style="width:90%;"><br>
                        <hr style="background-color:black; width:100%;">
                        <h4 style="text-align:center;">
                            <b>EL SUSCRITO DIRECTOR GENERAL DE LA INSTITUCION EDUCATIVA DEL SUR INESUR<b>
                        </h4>
                        <h6 style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</h6>
                        <h6 style="text-align:center;">  Código DANE No.352001006791</h6><br><br>
                        <h5 style="text-align:center;">
                            CERTIFICA
                        </h5>
                    </td>
                    <td style="width:5%;">
                    
                    </td>
                </tr>
                <tr> 
                    <td style="width:5%;">
                    </td>
                    <td style="width:90%;"><br>
                        <hr style="background-color:black; width:100%;">
                        <p style="text-align:justify;"><br><br><br>
                        Que, <b>{{strtoupper($estudiante->nombre)}} {{strtoupper($estudiante->segundonom)}} {{strtoupper($estudiante->primerape)}} {{strtoupper($estudiante->segundoape)}}</b>, identificado con {{$estudiante->destipo}} No. <b>{{$estudiante->num_doc}}</b>, curso y aprobó en esta institución el <b>{{strtoupper($estudiante->descripcion)}}</b> correspondiente al <b>{{$estudiante->cursodes}}</b> del bachillerato por ciclos, Calendario {{$estudiante->periodo}}. las valoraciones se relacionan a continuación:
                        </p><br>
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

                </tr>@foreach($asig as $a)
                <tr> 
                    <td style="width:0.5%;">
                    </td>
                    
                    <td style="width:10%;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->definitiva}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$a->desem}}
                    </td>
                    
                    <td style="width:5%;">
                      &nbsp;
                    </td>
                    
                </tr>@endforeach
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
        <div id="esto">
            <p style="text-align:center;">
                    Dirección: Pasto calle 17 No. 26 - 66 Centro<br>
                    Teléfono: 3143317164 Email: girardotjurado@yahoo.es – girardotjurado@hotmail.com
             </p><br>
        </div>
        <style>
        /* css */
        #esto{
            position:absolute; 
            bottom:1px; width:100%; 
             text-align:center; 
             }
        </style>
    </body>
</html>


