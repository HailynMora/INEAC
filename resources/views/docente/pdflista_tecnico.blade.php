<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Listado Estudiantes Técnico</title>
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
                footer {
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                    height: 40px;
                    }
        </style>
    </head>
    <body style="margin-top:-2.5rem;">
       <!---tabla-->
       <table>
            <tr>
                <td >
                    <!--<img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;">-->
                    <img src="{{ asset('https://ineacpotosi.com/dist/img/logoin.jpg')}}" style="width:60px; height: 80px;">  
                </td>
                <td>
                    <p style="text-align:center;  font-size:18px;">
                      <b>INSTITUTO DE EDUCACIÓN TECNICA INESUR<b>
                     </p>
                    <p  style="text-align:center; font-size:15px;">
                        Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                        Emanada por Secretaría de Educación Municipal de Pasto<br>
                        Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
                        Potosí - Nariño
                    </p>
                </td>
            </tr>
        </table>
        <div>
          <!--table-->
          <table>
            <tr>
                   <td colspan="3">
                   <p>Fecha: {{$dia}} / {{$mes}} / {{$anio}} </p>
                    </td>
                    <td colspan="3">
                    <b>Materia: ____________</b> 
                    </td>
                    <td colspan="3">
                    <b>Docente:</b>  {{$doc[0]->nombre}} {{$doc[0]->apellido}}
                    </td>
                    <td colspan="3">
                    <b>Firma: _______________</b> 
                    </td>
                </tr>
          </table>
          <!--end table-->
        </div>
        <table style="border: black 1px solid; border-collapse: collapse; font-size:14px;">
           <!--tabla cabecera-->
           <tr>
                <td colspan="3" style="border: black 1px solid; border-collapse: collapse;">
                </td>
                <td colspan="3" style="border: black 1px solid; border-collapse: collapse;">
                <b>Fecha</b> 
                </td>
                <td colspan="3" style="border: black 1px solid; border-collapse: collapse;">
                <b>Fecha</b> 
                </td>
                <td colspan="3" style="border: black 1px solid; border-collapse: collapse;">
                <b>Fecha</b> 
                </td>
            </tr>
           <!--end cabecera-->
            <tr>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <b>No.</b>
                </td>
                <td colspan="2" style="border: black 1px solid; border-collapse: collapse;">
                <b>Apellidos y Nombres &nbsp;</b>
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>UYC</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>P</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>A</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>UYC</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>P</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>A</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>UYC</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>P</b> 
                </td>
                <td style="border: black 1px solid; text-align:center;">
                <b>A</b> 
                </td>
            </tr>
        <?php 
         $conta = 1;
        ?>
        @foreach($estudiante as $d)
             @if(isset($d->id))
            <tr>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$conta++}}</span>
                </td>
                <td  colspan="2"  style="border: black 1px solid; border-collapse: collapse;">
                  <span> {{$d->firts_ape}} {{$d->second_ape}} {{$d->first_nom}} {{$d->second_nom}} </span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>&nbsp;</span>
                </td>
               
            </tr>
            @endif
            @endforeach
    
          <!--aqui continua-->
        </table>
        <!--table-->
        <footer>
        <table>
            <tr>
                   <td colspan="3">
                    <p>UYC: Uniforme y carnet </p>
                    </td>
                    <td colspan="3">
                    <p>P: Paz y salvo</p> 
                    </td>
                    <td colspan="3">
                    
                    </td>
                    <td colspan="3">
                    <p>A: Asistencia (A), Permiso (P), Falta (F) </p> 
                    </td>
                </tr>
          </table>
            </footer> 
          <!--end table-->
      
    </body>
</html>
 