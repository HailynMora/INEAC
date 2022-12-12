<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Listado Docentes</title>
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
                        Potosi - Nariño
                    </p>
                </td>
            </tr>
        </table>
        <div>
          <p>Fecha: {{$dia}} / {{$mes}} / {{$anio}}</p>
        </div>
        <table style="border: black 1px solid; border-collapse: collapse; font-size:14px;">
            <tr>
                <td colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <b>No. Documento</b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <b>Tipo Doc.</b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b>Apellidos y Nombres</b>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b>Fecha Vinculación</b> 
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b>Teléfono</b> 
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b>Dirección</b> 
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                <b>Estado</b> 
                </td>
            </tr>
            @foreach($docente as $d)
             @if(isset($d->id))
            <tr>
                <td colspan="4" style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$d->num_doc}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span> {{$d->descripcion}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$d->apellido}} {{$d->nombre}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span> {{date('Y-m-d', strtotime($d->fec_vinculacion))}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$d->telefono}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$d->direccion}}</span>
                </td>
                <td style="border: black 1px solid; border-collapse: collapse;">
                  <span>{{$d->estado}}</span>
                </td>
            </tr>
            @endif
            @endforeach
          <!--aqui continua-->
        </table>

        <h3 style="text-align:center;">Asignaturas vinculadas a docentes</h3>
       <!--asignaturas a cargo-->
       <table style="border: black 1px solid; border-collapse: collapse; font-size:14px;">
        <tr>
            <!--<td colspan="2">celdas a1 y b1 unidas</td>--->
            <td  style="border: black 1px solid; border-collapse: collapse;"><b>Docente</b></td>
            <td  style="border: black 1px solid; border-collapse: collapse;"><b>Asignatura y curso</b></td>
        </tr>
       @foreach($docente as $p)
       @if(isset($p->id))
       @if(isset($condoc[0][0]))
        <tr>
           <td style="border: black 1px solid; border-collapse: collapse;">{{$p->apellido}} {{$p->nombre}}</td>      
            <td style="border: black 1px solid; border-collapse: collapse;">
                    <?php
                        $con=1;
                        for($i=0;$i<count($condoc);$i++) {
                            for($j=0;$j<count($condoc[$i]);$j++) {
                                if($p->id == $condoc[$i][$j]->id_docente){
                                echo $condoc[$i][$j]->asig."\t".$condoc[$i][$j]->horas."H."."\t"."=>"."\t".$condoc[$i][$j]->cur;
                                echo "<br>";
                                }

                            }
                        }
                ?>
                </td>
        </tr>  
       @endif
       @endif
       @endforeach
       </table>
    </body>
</html>
 