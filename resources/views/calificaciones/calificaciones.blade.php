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
                <div class="modal-dialog modal-lg" role="document">
                    @foreach($as as $a)
                    <div class="modal-content">
                        <form action="{{route('regnotas')}}"  method="post" id="notasform">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$a->descripcion}} -</h5>
                                <h5 class="modal-title" id="exampleModalLabel">- Asignatura: {{$a->nombre}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 style="text-align: center;">Calificaciones</h5>
                                <div style="background-color:#CDFFEB; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" >
                                    <div class="row">
                                        <div class="col-3">
                                            <b>N°</b>
                                        </div>
                                        <div class="col-6">
                                            <b>Calificación</b>
                                        </div>
                                        <div class="col-3">
                                            <b>Porcentaje</b>
                                        </div>
                                    </div>
                                </div>
                                <hr style="background-color:black;">
                                <div class="row">
                                    <div class="col-3" style="padding-left:15px;">
                                        1
                                    </div>
                                    <div class="col-6">
                                        <input id="nota1" name="nota1">
                                    </div>
                                    <div class="col-3">
                                        <select id="porcentaje1" name="porcentaje1">
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
                                <hr style="background-color:black;">
                                <div class="row">
                                    <div class="col-3" style="padding-left:15px;">
                                        2
                                    </div>
                                    <div class="col-6">
                                        <input id="nota2" name="nota2">
                                    </div>
                                    <div class="col-3">
                                        <select id="porcentaje2" name="porcentaje2">
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
                                <hr style="background-color:black;">
                                <div class="row">
                                    <div class="col-3" style="padding-left:15px;">
                                        3
                                    </div>
                                    <div class="col-6">
                                        <input id="nota3" name="nota3">
                                    </div>
                                    <div class="col-3">
                                        <select id="porcentaje3" name="porcentaje3">
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
                                <hr style="background-color:black;">
                                <div class="row">
                                    <div class="col-3" style="padding-left:15px;">
                                        4
                                    </div>
                                    <div class="col-6">
                                        <input id="nota4" name="nota4">
                                    </div>
                                    <div class="col-3">
                                        <select id="porcentaje4" name="porcentaje4">
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
                                <hr style="background-color:black;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5>Calificación Definitiva: </h5>
                                    </div>
                                    <div class="col-md-5">
                                        <b><p id="defi" name="defi"></p></b>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="text-align: center;">
                                            <button type="button" class="btn btn-info" value="Calcular" onclick="Calcular();">Calcular</button>
                                        </div>
                                    </div>
                                </div>
                                <input id="idcur" name="idcur" value="{{$a->idcur}}" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>
                        </form>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        <!--Fin modal-->

        @endforeach
    </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
    function Calcular(){
        var not1=$('#nota1').val();
        var por1=$('#porcentaje1').val();
        var not2=$('#nota2').val();
        var por2=$('#porcentaje2').val();
        var not3=$('#nota3').val();
        var por3=$('#porcentaje3').val();
        var not4=$('#nota4').val();
        var por4=$('#porcentaje4').val();
        var def;
        def = ((parseFloat(not1)*por1)+(parseFloat(not2)*por2)+(parseFloat(not3)*por3)+(parseFloat(not4)*por4));
        document.getElementById('defi').innerHTML = def;

    }
</script>

@endsection