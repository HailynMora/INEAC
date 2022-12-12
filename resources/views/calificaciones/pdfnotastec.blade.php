<!DOCTYPE html>
<html>
<head>
    <title>Notas Estudiantes Tecnicos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    @if(isset($consulta[0]))
    <div style="margin: 1rem 1rem 1rem 1rem;">
    <h6> <img src="{{ public_path('/img/logoin.jpg')}}" style="width:60px; height: 80px;"> <span  style="margin-left:12rem;">PLANILLA DE NOTAS</span></h6>
    <h6 class="text-center" style="padding-bottom:3px;">INSTITUTO DE EDUCACIÓN TECNICA INESUR</h6> 
    <h6 class="text-center">PROGRAMA: {{strtoupper($info->curso)}} {{$info->anio}} - {{$info->periodo}} </h6>
    <h6> JORNADA: SABADO <span  style="margin-left:20rem; text-align:right;"> MUNICIPIO: POTOSI </span></h6>
    <div class="row">
        <div class="col-12"></div>    
    </div>
    <div class="row">
        <div class="col-12"><h6 class="text-left">MATERIA: {{strtoupper($info->asignatura)}}</h6></div>
    </div>
    <br>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="3"></th>
            <th><span style="font-size:small;">Nota 1</span></th>
            <th><span style="font-size:small;">Nota 2</span></th>
            <th><span style="font-size:small;">Nota 3</span></th>
            <th><span style="font-size:small;">Nota 4</span></th>
            <th rowspan="2"><h6 class="text-center" style="padding-bottom:1rem; font-size:small;">DEFINITIVA</h6></th>
        </tr>
        <tr>
            <th>No</th>
            <th colspan="2"><span style="font-size:small;">APELLIDOS Y NOMBRES</span></th>
            <th><span style="font-size:small;">{{$consulta[0]->por1 *100}}%</span></th>
            <th><span style="font-size:small;">{{$consulta[0]->por2 *100}}%</span></th>
            <th><span style="font-size:small;">{{$consulta[0]->por3 *100}}%</span></th>
            <th><span style="font-size:small;">{{$consulta[0]->por4 *100}}%</span></th>
        </tr>
        </thead>
        <tbody>
            <?php
             $conta=1;
            ?>
            @foreach($consulta as $con)
            <tr>
            <th scope="row"><span style="font-size:14px;">{{$conta++}}</span></th>
            <td colspan="2"><span style="font-size:14px;">{{$con->apes}}&nbsp;{{$con->sedape}}&nbsp;{{$con->nomes}}</span></td>
            <td><span style="font-size:14px;">{{$con->nota1}}</span></td>
            <td><span style="font-size:14px;">{{$con->nota2}}</span></td>
            <td><span style="font-size:14px;">{{$con->nota3}}</span></td>
            <td><span style="font-size:14px;">{{$con->nota4}}</span></td>
            <td><span style="font-size:14px;">{{$con->definitiva}}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!--objetivos imprimir-->
       <br>
       <h6 class="text-center">CRITERIOS DE EVALUACIÓN</h6> 
       <hr>
       <?php
         $obcon = 1;
       ?>
       @foreach($obj as $ob)
         <div>{{$obcon++}} <span  style="margin-left:1rem; text-align:right;">{{$ob->objetivo}}</span></div>
         <hr>
       @endforeach

    <!--end objetivos imprimir-->
    <div><span style="font-size: 14px;">DOCENTE: {{$info->nomdoc}} {{$info->apedoc}}</div>
    <div><span style="font-size: 14px;">FIRMA: </span> _____________________________</div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    @endif
</body>
</html>