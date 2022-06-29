<table style="border:1px solid black;">
@if(isset($res[0]))
     <thead>
        <tr>
            <th scope="col" colspan="13" style="text-align:center;">Instituto De Educación Tecnica INESUR</th>
       </tr>
       <tr>
            <th scope="col" colspan="13"  style="text-align:center;">Programa: {{$res[0]->curso}} {{$res[0]->anio}} - {{$res[0]->periodo}}</th>
       </tr>
         <tr>
           <th scope="col" colspan="4">Materia: {{$res[0]->asignatura}}</th>
           <th scope="col" colspan="4">Jornada: Sabado</th>
           <th scope="col" colspan="5">Municipio: Potosi</th>
         </tr>
         <tr>
           <th scope="col" colspan="4">Docente: {{$res[0]->nomdoc}} {{$res[0]->apedoc}}</th>
         </tr> 
         <tr>
         <th scope="col" style="background-color:#3DA3F7;">No</th>
         <th scope="col" style="background-color:#3DA3F7;">Apellidos</th>
         <th scope="col" style="background-color:#3DA3F7;">Nombres</th>
         <th scope="col" style="background-color:#3DA3F7;">Nota 1</th>
         <th scope="col" style="background-color:#3DA3F7;">{{$res[0]->por1*100}} %</th>
         <th scope="col" style="background-color:#3DA3F7;">Nota 2</th>
         <th scope="col" style="background-color:#3DA3F7;">{{$res[0]->por2*100}} %</th>
         <th scope="col" style="background-color:#3DA3F7;">Nota 3</th>
         <th scope="col" style="background-color:#3DA3F7;">{{$res[0]->por3*100}} %</th>
         <th scope="col" style="background-color:#3DA3F7;">Nota 4</th>
         <th scope="col" style="background-color:#3DA3F7;">{{$res[0]->por4*100}} %</th>
         <th scope="col" style="background-color:#3DA3F7;">Definitiva</th>
         <th scope="col" style="background-color:#3DA3F7;">Desempeño</th>
         </tr>
     </thead>
     <tbody>
        <?php
         $conta=1;
        ?>
        @foreach($res as $r)
        <tr>
            <td>{{$conta++}}</td>
            <td>{{$r->apes}} {{$r->sedape}}</td>
            <td>{{$r->nomes}} {{$r->segnom}}</td>
            <td>{{$r->nota1}}</td>
            <td>{{$r->por1}}</td>
            <td>{{$r->nota2}}</td>
            <td>{{$r->por2}}</td>
            <td>{{$r->nota3}}</td>
            <td>{{$r->por3}}</td>
            <td>{{$r->nota4}}</td>
            <td>{{$r->por4}}</td>
            <td>{{$r->definitiva}}</td>
            <td>{{$r->desem}}</td>
            <td></td>
        </tr>
        @endforeach
</tbody>
@endif
</table>