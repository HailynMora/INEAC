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
              EL SUSCRITO RECTOR DEL INSTITUTO DE EDUCACIÓN TECNICA INESUR, DEL MUNICIPIO PASTO - NARIÑO 
            </h4><br><br>
            <h5 style="text-align:center;">
                HACE CONSTAR
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
            Que el (la) señor(a) <b> {{strtoupper($docente->nombre)}} {{strtoupper($docente->apellido)}} </b> identificado(a) con cédula de ciudadania No. <b> {{strtoupper($docente->num_doc)}}</b>, docente de tiempo completo de esta institución desde el <b> {{date('Y-m-d', strtotime($docente->fec_vinculacion))}}, </b> cargo que viene desempeñando hasta la 
            presente fecha sin ninguna interrupción.
          </p><br>
    </td>
    <td style="width:5%;">
      &nbsp;
    </td>
 </tr>
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


