<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Certificado Laboral</title>
    </head>
    <body  style=" width:100%;  height: 100%;">
        <br><br>
        @if(isset($docente->nombre))
        <div style="background-image:url({{ public_path('/img/pdf_inesur2.jpg')}}); background-position:center;  background-repeat: no-repeat; background-size:cover; margin-top:-4rem; margin-left:-4rem; margin-right:-3rem;  margin-bottom:-2rem;">
        <!--para vincular en el servidor-->
       <!-- style="background-image:url({{' https://ineacpotosi.com/dist/img/pdf_inesur2.jpg'}});-->
       
        <div  style="padding-top: 95px;">
           <!-- <div>
                <img src="{{ public_path('/img/pdf_i.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
            <div style="padding-left:1em; padding-right:1em;">
            <br>
            <div>
            <br><br><br>
                <h4 style="text-align:center;">
                    <b>EL SUSCRITO DIRECTOR GENERAL DEL INSTITUTO DE EDUCACIÓN TéCNICA INESUR<b>
                </h4>
                <p style="text-align:center;">RESOLUCION 0071 DE 20 DE ENERO DE 2014</p>
                <p style="text-align:center;">Código DANE No. 352001006791</p><br>
                <h4 style="text-align:center;"> <br>
                   HACE CONSTAR
                </h4>
                <br>
            </div>
            <div>
                <p style="text-align:justify;  line-height:1.5; padding-left: 4rem; padding-right: 4rem;">
                Que el (la) señor(a) <b> {{strtoupper($docente->nombre)}} {{strtoupper($docente->apellido)}} </b> identificado(a) con cédula de ciudadania No. <b> {{strtoupper($docente->num_doc)}}</b>, docente de esta institución desde el <b> {{date('Y-m-d', strtotime($docente->fec_vinculacion))}}, </b> cargo que viene desempeñando hasta la 
                presente fecha.
               </p>
            </div>  
            <div>
            <br><br><br><br><br>
            </div>
            <br>
           <div style="padding-left: 4rem; padding-right: 4rem;">
             <p>Para constancia se firma en Potosi el dia {{$dia}} del mes {{$mes}}  del año {{$anio}}</p>
            </div>
            <br><br><br><br><br><br><br><br>
            <div > 
            <br>
            <p  style="text-align:center;">
             ____________________________________________<br>
             <b>ALEXANDER SARCHI GRIJALBA</b><br>
             Director
            </p>
            <br><br><br><br><br><br><br>
           </div>
           
          <!-- <div>
                <img src="{{ public_path('/img/pdf_in.jpg')}}" style="width:100%; height: 100px;">
            </div>-->
        <!-- html -->
     </div>
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
