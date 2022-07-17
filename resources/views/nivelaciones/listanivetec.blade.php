<table style="border:1px solid black;">
@if(isset($res[0]))
     <thead>
        <tr>
            <th scope="col" colspan="13" style="text-align:center;">Instituto De Educación Tecnica INESUR</th>
       </tr>
       <tr>
            <th scope="col" colspan="13"  style="text-align:center;">Lista de Estudiantes para Nivelación</th>
       </tr>
         <tr>
           <th scope="col" colspan="4">Docente: {{$res[0]->nomdoc}} {{$res[0]->apedoc}}</th>
         </tr> 
         <tr>
         <th scope="col" style="background-color:#3DA3F7;">No</th>
         <th scope="col" style="background-color:#3DA3F7;">Documento</th>
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
         <th scope="col" style="background-color:#3DA3F7;">Asignatura</th>
         <th scope="col" style="background-color:#3DA3F7;">Trimestre</th>
         <th scope="col" style="background-color:#3DA3F7;">Tecnico</th>
         <th scope="col" style="background-color:#3DA3F7;">Valor Habilitación</th>
         </tr>
     </thead>
     <tbody>
        <?php
         $conta=1;
        ?>
        @foreach($res as $r)
        <tr>
            <td>{{$conta++}}</td>
            <td>{{$r->num_doc}}</td>
            <td>{{$r->ape1}} {{$r->ape2}} {{$r->nom1}} {{$r->nom2}}</td>
            <td>{{$r->nota1}}</td>
            <td>{{$r->por1}}</td>
            <td>{{$r->nota2}}</td>
            <td>{{$r->por2}}</td>
            <td>{{$r->nota3}}</td>
            <td>{{$r->por3}}</td>
            <td>{{$r->nota4}}</td>
            <td>{{$r->por4}}</td>
            <td>{{$r->definitiva}}</td>
            <td>{{$r->nomasig}}</td>
            <td>{{$r->nombretri}}</td>
            <td>{{$r->nombretec}}</td>
            <td>{{$r->valor}}</td>
        </tr>
        @endforeach
</tbody>
@endif
</table>