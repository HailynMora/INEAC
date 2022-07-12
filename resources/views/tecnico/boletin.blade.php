<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Estudiantil</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;">
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                    <h5 style="text-align:center;">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INSTITUTO DE EDUCACIÓN TECNICA INESUR<b>
                    </h5>
                    <p style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creado mediante Resolución No. 3128 del 31 Diciembre de 2010<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Emanada por Secretaría de Educación Municipal de Pasto<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sede Principal Pasto calle 17 No. 26 - 66 Centro<br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Potosi - Nariño
                    </p>
                </td>
                <td></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <p>Nombre: {{$estudiante->nombre}} {{$estudiante->segundonom}} {{$estudiante->primerape}} {{$estudiante->segundoape}}</p>
                </td>
                <td>
                    <p>Identificación: {{$estudiante->num_doc}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Tecnico: {{$estudiante->nombretec}}</p>
                </td>
                <td>
                    <p>Trimestre: {{$estudiante->nombretri}}</p> 
                </td>
                <td>
                    <p>Año: {{$estudiante->anio}}</p>
                </td>
                <td>
                    <p>Perido: {{$estudiante->periodo}}</p>
                </td>
            </tr>
        </table>
        <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Calificación</th>
                <th>Concepto</th>
              </tr>
            </thead>
            <tbody>
              @foreach($asig as $a)
                <?php
                  $idc = $a->id_tecnicos;
                ?>
                @foreach($cur as $s)
                  @if($s->id==$idc)
                  <tr>
                    <td>{{$s->codigoasig}}</td>
                    <td>{{$s->nombreasig}}</td> 
                    <td>{{$a->definitiva}}</td>
                    <td>{{$a->desem}}</td>
                  </tr>
                  <br>
                  @endif
                @endforeach

              @endforeach
            </tbody>
        </table>
    </body>
</html>