
<div class="form-group justify-content-center col-md-12 " id="docente<?php echo $d['id'];?>">
<form action="{{route('asig',$d['id'])}}">
    @csrf
<label for="asig_dictadas">Asignaturas a Cargo</label>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Codigo</th>
        <th scope="col">Asignatura</th>
        <th scope="col">Programa</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
</form>   

</div>