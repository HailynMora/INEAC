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
    <body style="margin-top:-2rem;">
       <!---tabla-->
       <table>
            <tr>
                <td >
                    <img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;">
                </td>
                <td>
                    <h5 style="text-align:center; padding-top:-50px;">
                    <b>INSTITUTO DE EDUCACIÓN TECNICA INESUR<b>
                    </h5>
                    <p style="text-align:center; padding-top:-50px;">
                        Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                        Emanada por Secretaría de Educación Municipal de Pasto<br>
                        Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
                        Potosi - Nariño
                    </p>
                </td>
            </tr>
        </table>
        <table style="border: black 1px solid; border-collapse: collapse;">
            <tr>
                <td colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  Estudiante
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                   Doc
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                   Curso
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                   Periodo
                  
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
          <?php
             $idc = $a->id_curso;
           ?>
     @foreach($cur as $s)
     @if($a->id_curso ==  $s->id )
        <br>
        <!--asignaturas-->
        <table style="border: black 1px solid; border-collapse: collapse;">
            <tr>
                <td  colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$s->nombre}}</span>
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                   IHS(sesiones)
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                  Def.
                </td>
                <td style="border:  black 1px solid; border-collapse: collapse;">
                  Desempeño
                </td>
            </tr>
            <tr>
                <td  colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                 Doc: Pedro Cuasquer
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  10
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <span>{{$a->definitiva}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                {{$a->desem}}
                </td>
            </tr>
            <tr>
                <td  colspan="7" style="border: black 1px solid; border-collapse: collapse;">
                 Conceptos:
                </td>
            </tr>
            <tr>
                <td  colspan="7" style="border: black 1px solid; border-collapse: collapse;">   
                </td>
            </tr>
        </table>
         @endif
         @endforeach
        @endforeach
       <!--end tabla-->
    </body>
</html>


