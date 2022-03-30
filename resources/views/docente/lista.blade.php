
<div class="form-group justify-content-center col-md-12 " id="docente<?php echo $d['id'];?>">
<form action="{{route('asig',$d['id'])}}">
    @csrf
<label for="asig_dictadas">Asignaturas a Cargo</label>
@if($b==1)
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Codigo</th>
        <th scope="col">Asignatura</th>
        <th scope="col">Programa</th>
        </tr>
    </thead>
    <tbody>
    
        <tr>
           <td></td>
           <td></td>
           <td></td>
        </tr>
        
    </tbody>
</table>
@endif
</form>   

</div>