<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Estudiantil</title>
        <style>
            /* spacing */
                table {
                width: 100%;
                border: 0px;
                }
                .espa{
                   padding:3px;
                   /*para los th y td opcional */
                }
        </style>
    </head>
    <body style="margin-top:-2.5rem;">
       <!---tabla-->
       <table>
            <tr>
                <td >
                    <img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;">
                </td>
                <td>
                    <p style="text-align:center;  font-size:18px;">
                      <b>INSTITUTO DE EDUCACIÓN TECNICA INESUR<b>
                     </p>
                    <p  style="text-align:center; font-size:15px;">
                        Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                        Emanada por Secretaría de Educación Municipal de Pasto<br>
                        Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
                        Potosi - Nariño
                    </p>
                </td>
            </tr>
        </table>
        <table style="border: black 1px solid; border-collapse: collapse; font-size:14px;">
            <tr>
                <td colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <b>Estudiante</b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <b> Doc</b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b> Curso </b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b> Periodo</b>
                  
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$estudiante->nombre}} {{$estudiante->segundonom}} {{$estudiante->primerape}} {{$estudiante->segundoape}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span> {{$estudiante->num_doc}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$estudiante->descripcion}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$estudiante->anio}} - {{$estudiante->periodo}}</span>
                </td>
            </tr>
        </table>
    @foreach($notas as $a)
    @if(isset($a->nomasig))
       <br>
        <!--asignaturas-->
        <table style="border: black 1px solid; border-collapse: collapse; font-size:14px;">
            <tr>
                <td  colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <b>{{$a->nomasig}}</b>
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                <b>  IHS(sesiones) </b>
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                <b> Def. </b>
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                <b> Desempeño </b>
                </td>
            </tr>
            <tr>
                <td  colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                <b> Doc: </b> {{$a->nombre}} {{$a->apellido}}
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  {{$a->ih}}
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <span>{{$a->definitiva}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                {{$a->desem}}
                </td>
            </tr>
            <tr>
            </tr>
            @foreach($cur as $c)
             @if($a->id_curso == $c->idasig)
            <tr>
                <td  colspan="7" style="border: black 1px solid; border-collapse: collapse; text-align:justify;">
                 {{$c->desob}}
                </td>
            </tr>
             @endif
           @endforeach
            <tr>
                <td  colspan="7" style="border: black 1px solid; border-collapse: collapse;">   
                </td>
            </tr>
        </table>
        @endif
        @endforeach
       <!--end tabla-->
    </body>
</html>


