@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Registro Calificaciones</h3>
</div>
<br>
<div class="container">
    <table class="table">
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Identificion</th>
            <th scope="col">Estudiante</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
    <tbody>
        <?php
            $cont=1;
        ?>
        @foreach($estumat as $es)
        <tr>
        <th scope="row">{{$cont++}}</th>
        <td>{{$es->num_doc}}</td>
        <td>{{$es->primerape}} {{$es->segundoape}} {{$es->nombre}} {{$es->segundonom}} </td>
        <td>
        <a type="button"  data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus-circle" style="color:#5e6457;"></i>
        </a>  
        </td>
        </tr>
        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    @foreach($as as $a)
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asignatura: {{$a->nombre}} 
                                <br>{{$a->descripcion}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nota #</label>
                                </div>
                                <div class="col-md-6">
                                    <label>Calificación</label>
                                </div>
                                <div class="col-md-3">
                                    <label>Porcentaje</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>N° 1</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="nota1" name="nota1">
                                </div>
                                <div class="col-md-3">
                                    <div>
                                    <select id="porcentaje" name="porcentaje">
                                        <option value="0.1">10%</option>
                                        <option value="0.2">20%</option>
                                        <option value="0.3">30%</option>
                                        <option value="0.4">40%</option>
                                        <option value="0.5">50%</option>
                                        <option value="0.6">60%</option>
                                        <option value="0.7">70%</option>
                                        <option value="0.8">80%</option>
                                        <option value="0.9">90%</option>
                                        <option value="1">100%</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>N° 2</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="nota1" name="nota1">
                                </div>
                                <div class="col-md-3">
                                    <div>
                                    <select id="porcentaje" name="porcentaje">
                                        <option value="0.1">10%</option>
                                        <option value="0.2">20%</option>
                                        <option value="0.3">30%</option>
                                        <option value="0.4">40%</option>
                                        <option value="0.5">50%</option>
                                        <option value="0.6">60%</option>
                                        <option value="0.7">70%</option>
                                        <option value="0.8">80%</option>
                                        <option value="0.9">90%</option>
                                        <option value="1">100%</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>N° 3</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="nota1" name="nota1">
                                </div>
                                <div class="col-md-3">
                                    <div>
                                    <select id="porcentaje" name="porcentaje">
                                        <option value="0.1">10%</option>
                                        <option value="0.2">20%</option>
                                        <option value="0.3">30%</option>
                                        <option value="0.4">40%</option>
                                        <option value="0.5">50%</option>
                                        <option value="0.6">60%</option>
                                        <option value="0.7">70%</option>
                                        <option value="0.8">80%</option>
                                        <option value="0.9">90%</option>
                                        <option value="1">100%</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>N° 4</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="nota1" name="nota1">
                                </div>
                                <div class="col-md-3">
                                    <div>
                                    <select id="porcentaje" name="porcentaje">
                                        <option value="0.1">10%</option>
                                        <option value="0.2">20%</option>
                                        <option value="0.3">30%</option>
                                        <option value="0.4">40%</option>
                                        <option value="0.5">50%</option>
                                        <option value="0.6">60%</option>
                                        <option value="0.7">70%</option>
                                        <option value="0.8">80%</option>
                                        <option value="0.9">90%</option>
                                        <option value="1">100%</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nota definitiva:</label>
                                </div>
                                <div class="col-md-3">
                                    <input>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        <!--Fin modal-->

        @endforeach
    </tbody>
    </table>
</div>
@endsection