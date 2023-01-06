@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Registro Calificaciones Técnicos</h3>
</div>
<br>
<!--collapsed-->
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <div class="row alerta">
                <div class="col-6">
                    <div class="conatiner">
                    @if(isset($asig[0]->idastec))
                        <a href="/reporte/notas/tecnico/{{$asig[0]->idastec}}"><img src="{{asset('dist/img/informe_c.png')}}" class="img-fluid" ></a>
                    @endif
                    </div>
                </div>
                <div class="col-6">
                    <a  href="/asignatura/reporte" class="btn float-right"><i class="fas fa-backward"></i>&nbsp;Regresar</a>
                </div>
            </div>
        </div>
        <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
                <!--tabla-->
                <!--mensajes-->
                @if(Session::has('notare'))
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:#AFDCEC;">
                        <strong> {{Session::get('notare')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(Session::has('notaval'))
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:#38ACEC;">
                        <strong> {{Session::get('notaval')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                <!--end mensajes-->
                <br>
                <div class="table-responsive">
                    <table class="table" >
                        <thead style="background-color:#0f468e;color: #ffffff;" class="alerta">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Celular</th>
                                <th scope="col">T/Documento</th>
                                <th scope="col">No. Documento</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#e3e3e3;" class="letraf">
                            <?php $conta=1; ?>
                            @foreach($mates as $t)
                             @if(isset($t->nombre))
                                <tr style="background-color: #dcedc8;">
                                    <th scope="row">{{$conta++}}</th>
                                    <td>{{$t->nombre}}&nbsp;{{$t->segundonom}}</td>
                                    <td>{{$t->primerape}}&nbsp;{{$t->segundoape}}</td>
                                    <td>{{$t->telefono}}</td>
                                    <td>{{$t->destipo}}</td>
                                    <td>{{$t->num_doc}}</td>
                                    <td>
                                        <!--modal-->
                                        <!-- Button trigger modal -->
                                        <a type="button"  data-toggle="modal" data-target="#exampleModal{{$t->idest}}" title="Ingresar Nota">
                                            <i class="bi bi-journal-bookmark" style="color:black; font-size:24px;"></i>
                                        </a>
                                        &nbsp&nbsp
                                        <a type="button" href="/ver/notas/estudiante/tecnico/{{$t->idest}}/{{$asig[0]->idastec}}" title="Visualizar Nota"><i class="bi bi-file-earmark-ruled" style="color:black; font-size:24px;"></i></a>
                                        <!-- Modal -->
                                        <form action="{{route('regnotastec')}}" method="POST">
                                        @csrf
                                            <div class="modal fade" id="exampleModal{{$t->idest}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="container text-center" style="background-color: #283593; color:#ffffff; padding-top:10px; padding-bottom:10px;">
                                                            <h5 class="modal-title" id="exampleModalLabel">Registro de notas</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                        <!--table-->
                                                        <table class="table" style="background-color:#FFCC00;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nota</th>
                                                                    <th scope="col">Porcentaje</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="background-color: #e3e3e3;">
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota1" name="nota1" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
                                                                          <input type="text" id="porcentaje1{{$t->idest}}" name="porcentaje1" value="0" required style="width : 6em;">
                                                                          <a id="btn1" href="#" onclick="incrementClick(1, '{{$t->idest}}')"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                                          <a href="#" onclick="restar(1, '{{$t->idest}}')"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                                          <a  href="#" onclick="resetCounter(1, '{{$t->idest}}')"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!--segunda fila-->
                                                                <tr>
                                                                    <th scope="row">2</th>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota2" name="nota2" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                       <div class="form-group" style="padding-top:7px;">
                                                                          <input type="text" id="porcentaje2{{$t->idest}}" name="porcentaje2" value="0" required style="width : 6em;">
                                                                          <a href="#" onclick="incrementClick(2, '{{$t->idest}}')"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                                          <a href="#" onclick="restar(2, '{{$t->idest}}')"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                                          <a  href="#" onclick="resetCounter(2, '{{$t->idest}}')"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!--tercera fila-->
                                                                <tr>
                                                                <th scope="row">3</th>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
                                                                            <input type="number" step="any" min="0" max="5" class="form-control" id="nota3" name="nota3" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                      <div class="form-group" style="padding-top:7px;">
                                                                         <input type="text" id="porcentaje3{{$t->idest}}"  value="0" name="porcentaje3" required style="width : 6em;">
                                                                          <a href="#" onclick="incrementClick(3, '{{$t->idest}}')"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                                          <a href="#" onclick="restar(3, '{{$t->idest}}')"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                                          <a  href="#" onclick="resetCounter(3, '{{$t->idest}}')"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!--cuarta fila-->
                                                                <tr>
                                                                    <th scope="row">4</th>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
                                                                            <input type="number" step="any" min="0" max="5" type="text" class="form-control" id="nota4" name="nota4" placeholder="Ejm. 3.5" required>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group" style="padding-top:7px;">
                                                                            <input type="text" id="porcentaje4{{$t->idest}}" name="porcentaje4"  value="0" required style="width : 6em;">
                                                                            <a href="#" onclick="incrementClick(4, '{{$t->idest}}')"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                                            <a href="#" onclick="restar(4, '{{$t->idest}}')"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                                            <a  href="#" onclick="resetCounter(4, '{{$t->idest}}')"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                                        </div>
                                                                        <!---muestra la suma-->
                                                                        <span>Total: </span><span id="tot{{$t->idest}}"></span>
                                                                    </td>
                                                                </tr>
                                                                <!--end cuarta fila-->
                                                            </tbody>
                                                        </table>
                                                        <!--end table-->
                                                        <input id="idcur" name="idcur" value="{{$asig[0]->idastec}}" hidden >
                                                        <input id="idest" name="idest" value="{{$t->idest}}"  hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--end modal-->
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end tabla-->
            </div>
        </div>
    </div>
</div>
<!--end collapsed-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

var counterVal = 0, counterVal2 = 0, counterVal3 = 0, counterVal4 = 0;
var valor=0, valor1=0, valor2=0, valor3=0;
var restar1=0, valores=0, result=0, v1=0, v2=0, v3=0, v4=0, sum=0;

function incrementClick(num, s) {
    var n = s;
    switch (num) {
    case 1:
        counterVal = document.getElementById("porcentaje1"+n).value;
        if(counterVal == ''){
            counterVal = 0;
        }
        counterVal = parseFloat(counterVal);
        if(counterVal < 1){
          counterVal += 0.1;
          valor = redondearDecimales(counterVal, 2);
          document.getElementById("porcentaje1"+n).value = valor;
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 2:
        counterVal2 = document.getElementById("porcentaje2"+n).value;
        if(counterVal2 == ''){
            counterVal2 = 0;
        }
        counterVal2 = parseFloat(counterVal2);
        if(counterVal2 < 1){
          counterVal2 += 0.1;
          valor1 = redondearDecimales(counterVal2, 2);
          document.getElementById("porcentaje2"+n).value = valor1; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        //############################
        break;
    case 3:
        counterVal3 = document.getElementById("porcentaje3"+n).value;
        if(counterVal3 == ''){
            counterVal3 = 0;
        }
        counterVal3 = parseFloat(counterVal3);
        if(counterVal3 < 1){
          counterVal3 += 0.1;
          valor2 = redondearDecimales(counterVal3, 2);
          document.getElementById("porcentaje3"+n).value = valor2; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        //##########################
        break;
    case 4:
        //###########################
        counterVal4 = document.getElementById("porcentaje4"+n).value;
        if(counterVal4 == ''){
            counterVal4 = 0;
        }
        counterVal4 = parseFloat(counterVal4);
        if(counterVal4 < 1){
          counterVal4 += 0.1;
          valor3 = redondearDecimales(counterVal4, 2);
          document.getElementById("porcentaje4"+n).value = valor3; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    default:
        console.log('Lo lamentamos');
    }
    //sumar 
    sumarval(n);

}

function resetCounter(n, id) {
    switch (n) {
    case 1:
        counterVal = 0;
        valor=0;
        document.getElementById("porcentaje1"+id).value = counterVal; 
        
        break;
    case 2:
        counterVal2 = 0;
        valor1=0;
        document.getElementById("porcentaje2"+id).value = counterVal2;
        break;
    case 3:
        counterVal3 = 0;
        valor2 = 0;
        document.getElementById("porcentaje3"+id).value = counterVal3; 
        break;
    case 4:
        counterVal4 = 0;
        valor3 = 0;
        document.getElementById("porcentaje4"+id).value = counterVal4; 
        break;
    default:
        console.log('Lo lamentamos');
    }
        toastr.info(' ', 'Campo vacio', {timeOut:3000});
       sumarval(id);
}

//regresar
function restar(num, id) {
    switch (num) {
    case 1:
        restar1 = document.getElementById("porcentaje1"+id).value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementById("porcentaje1"+id).value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 2:
        restar1 = document.getElementById("porcentaje2"+id).value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementById("porcentaje2"+id).value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 3:
        restar1 = document.getElementById("porcentaje3"+id).value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementById("porcentaje3"+id).value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 4:
        restar1 = document.getElementById("porcentaje4"+id).value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementById("porcentaje4"+id).value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    default:
        console.log('Lo lamentamos');
    }
    sumarval(id);
}

//funcion sumar
function sumarval(id) {
        v1 = document.getElementById("porcentaje1"+id).value; 
        v2 = document.getElementById("porcentaje2"+id).value; 
        v3 = document.getElementById("porcentaje3"+id).value; 
        v4 = document.getElementById("porcentaje4"+id).value; 
        sum = parseFloat(v1) + parseFloat(v2) + parseFloat(v3) + parseFloat(v4);
        sum = redondearDecimales(sum, 2);
        document.getElementById("tot"+id).innerHTML=sum;
        if(sum > 1){
        toastr.info('El valor máximo debe ser 1', 'Lo sentimos!', {timeOut:3000});
    }

}

//redondear decimales
function redondearDecimales(numero, decimales) {
    numeroRegexp = new RegExp('\\d\\.(\\d){' + decimales + ',}');   // Expresion regular para numeros con un cierto numero de decimales o mas
    if (numeroRegexp.test(numero)) {         // Ya que el numero tiene el numero de decimales requeridos o mas, se realiza el redondeo
        return Number(numero.toFixed(decimales));
    } else {
        return Number(numero.toFixed(decimales)) === 0 ? 0 : numero;  // En valores muy bajos, se comprueba si el numero es 0 (con el redondeo deseado), si no lo es se devuelve el numero otra vez.
    }
}

</script>

@endsection