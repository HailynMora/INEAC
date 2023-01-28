@extends('usuario.principa_usul')
@section('content')
<!---collpased-->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <div class="row alerta">
        <div class="col-4">
            <a  href="/asignatura/reporte" class="btn"><i class="fas fa-backward"></i>&nbsp;Regresar</a>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
            <a type="button" class="btn float-right" data-toggle="modal" data-target="#modalEditar">
                <i class="fas fa-edit" style="color:black; font-size:17px;"></i>&nbsp;Editar
            </a>
            <!--MODAL ACTUALIZAR-->
            <form action="{{route('actualizarNotaTec')}}" method="POST">
                @csrf
                <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                             <div class="container text-center" style="background-color: #283593; color:#ffffff; padding-top:10px; padding-bottom:10px;">
                                <h5 class="modal-title" id="exampleModalLabel">Editar notas</h5>
                            </div>
                            <div class="modal-body">
                                <!--table-->
                                @foreach($nota as $a) 
                                <div class="table-responsive">
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
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota1" name="nota1" placeholder="Ejm. 3.5" value="{{$a->nota1}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" style="padding-top:7px;">
                                                     <input type="text" id="porcentaje1" name="porcentaje1" value="{{$a->por1}}" required style="width : 5em;">
                                                     <a id="btn1" href="#" onclick="incrementClick(1)"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                     <a href="#" onclick="restar(1)"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                     <a  href="#" onclick="resetCounter(1)"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--segunda fila-->
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota2" name="nota2" placeholder="Ejm. 3.5" value="{{$a->nota2}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" style="padding-top:7px;">
                                                        <input type="text" id="porcentaje2" name="porcentaje2" value="{{$a->por2}}" required style="width : 5em;">
                                                        <a href="#" onclick="incrementClick(2)"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                        <a href="#" onclick="restar(2)"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                        <a  href="#" onclick="resetCounter(2)"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--tercera fila-->
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>
                                                    <div class="form-group" style="padding-top:7px;">
                                                        <input type="number" step="any" min="0" max="5" class="form-control" id="nota3" name="nota3" placeholder="Ejm. 3.5" value="{{$a->nota3}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" style="padding-top:7px;">
                                                     <input type="text" id="porcentaje3"  value="{{$a->por3}}" name="porcentaje3" required style="width : 5em;">
                                                     <a href="#" onclick="incrementClick(3)"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                     <a href="#" onclick="restar(3)"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                     <a  href="#" onclick="resetCounter(3)"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--cuarta fila-->
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" min="0" max="5" type="text" class="form-control" id="nota4" name="nota4" placeholder="Ejm. 3.5" value="{{$a->nota4}}" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" style="padding-top:7px;">
                                                        <input type="text" id="porcentaje4" name="porcentaje4"  value="{{$a->por4}}" required style="width : 5em;">
                                                        <a href="#" onclick="incrementClick(4)"><i class="fas fa-plus-circle" style="font-size:20px;"></i></a>
                                                        <a href="#" onclick="restar(4)"><i class="fas fa-minus-circle" style="font-size:20px; color:#05B673;"></i></a>
                                                        <a  href="#" onclick="resetCounter(4)"><i class="fas fa-trash-restore" style="font-size:20px; color:red;"></i></a>
                                                    </div>
                                                    <!---muestra la suma-->
                                                    <span>Total: </span><span id="tot"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end table-->
                                <input type="text" value="{{$a->idnota}}" name="idnota" hidden>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--FIN MODAL ACTUALIZAR-->
        </div>
      </div>
    </div>
     <!--mensaje-->
     @if(Session::has('notac'))
     <div class="container">
            <div class="alert alert-dismissible fade show" role="alert" style="background-color:#AFDCEC;">
                <strong> {{Session::get('notac')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
      @endif
       @if(Session::has('erroractu'))
       <div class="container">
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:#38ACEC;">
                        <strong> {{Session::get('erroractu')}}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        </div>
       @endif
     <!--end mensaje-->
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <!--table-->
       @foreach($nota as $n) 
               <div class="container text-center alerta" style="padding-top:10px; padding-bottom:10px; background-color:#ffc107;">
                <h5><b>Calificaciones</b></h5>
                 <div class="row">
                     <div class="col-2 text-left"><b>Estudiante:</b></div>
                     <div class="col-4 text-center">{{$n->nomes}}&nbsp;{{$n->second_nom}}&nbsp;{{$n->apes}}&nbsp;{{$n->second_ape}}</div>
                     <div class="col-3"><b>Curso:</b></div>
                     <div class="col-3">{{$n->curso}}</div>
                 </div>
                 <div class="row">
                     <div class="col-2 text-left"><b>Asignatura:</b></div>
                     <div class="col-4 text-center">{{$n->asignatura}}</div>
                     <div class="col-3"><b>Perido:</b></div>
                     <div class="col-3">{{$n->anio}} {{$n->periodo}}</div>
                 </div>
               </div><br>
                        <div style="background-color:#e3e3e3; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px;" class="letraf" >
                            <div class="row">
                                <div class="col-3">
                                    <b>N°</b>
                                </div>
                                <div class="col-3">
                                    <b>Calificación</b>
                                </div>
                                <div class="col-3">
                                    <b>Porcentaje</b>
                                </div>
                                <div class="col-3">
                                    <b>Total</b>
                                </div>
                            </div>
                            <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                1
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota1}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por1*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por1 * $n->nota1}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                2
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota2}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por2*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por2 * $n->nota2}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                3
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota3}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por3*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por3 * $n->nota3}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                            <div class="col-3" style="padding-left:15px;">
                                4
                            </div>
                            <div class="col-3">
                                <label>{{$n->nota4}}</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por4*100}}%</label>
                            </div>
                            <div class="col-3">
                                <label>{{$n->por4 * $n->nota4}}</label>
                            </div>
                        </div>
                        <hr style="background-color:black;">
                        <div class="row">
                           <div class="col-3" style="padding-left:15px;">
                              <h6><b>Definitiva:</b></h6>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <label><p>{{$n->desem}}</p></label>
                            </div>
                            <div class="col-3">
                              <label><p>{{$n->definitiva}}</p></label>
                            </div>
                        </div>
                </div>
             @endforeach
       <!--end table--->
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

function incrementClick(num) {
    switch (num) {
    case 1:
        counterVal = document.getElementsByName("porcentaje1")[0].value;
        if(counterVal == ''){
            counterVal = 0;
        }
        counterVal = parseFloat(counterVal);
        if(counterVal < 1){
          counterVal += 0.1;
          valor = redondearDecimales(counterVal, 2);
          document.getElementsByName("porcentaje1")[0].value = valor; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 2:
        counterVal2 = document.getElementsByName("porcentaje2")[0].value;
        if(counterVal2 == ''){
            counterVal2 = 0;
        }
        counterVal2 = parseFloat(counterVal2);
        if(counterVal2 < 1){
          counterVal2 += 0.1;
          valor1 = redondearDecimales(counterVal2, 2);
          document.getElementsByName("porcentaje2")[0].value = valor1; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        //############################
        break;
    case 3:
        counterVal3 = document.getElementsByName("porcentaje3")[0].value;
        if(counterVal3 == ''){
            counterVal3 = 0;
        }
        counterVal3 = parseFloat(counterVal3);
        if(counterVal3 < 1){
          counterVal3 += 0.1;
          valor2 = redondearDecimales(counterVal3, 2);
          document.getElementsByName("porcentaje3")[0].value = valor2; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        //##########################
        break;
    case 4:
        //###########################
        counterVal4 = document.getElementsByName("porcentaje4")[0].value;
        if(counterVal4 == ''){
            counterVal4 = 0;
        }
        counterVal4 = parseFloat(counterVal4);
        if(counterVal4 < 1){
          counterVal4 += 0.1;
          valor3 = redondearDecimales(counterVal4, 2);
          document.getElementsByName("porcentaje4")[0].value = valor3; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    default:
        console.log('Lo lamentamos');
    }
    //sumar 
    sumarval();

}

function resetCounter(n) {
    switch (n) {
    case 1:
        counterVal = 0;
        valor=0;
        document.getElementsByName("porcentaje1")[0].value = counterVal; 
        break;
    case 2:
        counterVal2 = 0;
        valor1=0;
        document.getElementsByName("porcentaje2")[0].value = counterVal2;
        break;
    case 3:
        counterVal3 = 0;
        valor2 = 0;
        document.getElementsByName("porcentaje3")[0].value = counterVal3; 
        break;
    case 4:
        counterVal4 = 0;
        valor3 = 0;
        document.getElementsByName("porcentaje4")[0].value = counterVal4; 
        break;
    default:
        console.log('Lo lamentamos');
    }
        toastr.info(' ', 'Campo vacio', {timeOut:3000});
        sumarval();
}

//regresar
function restar(num) {
    switch (num) {
    case 1:
        restar1 = document.getElementsByName("porcentaje1")[0].value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementsByName("porcentaje1")[0].value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 2:
        restar1 = document.getElementsByName("porcentaje2")[0].value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementsByName("porcentaje2")[0].value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 3:
        restar1 = document.getElementsByName("porcentaje3")[0].value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementsByName("porcentaje3")[0].value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    case 4:
        restar1 = document.getElementsByName("porcentaje4")[0].value;
        if(restar1 > 0){
          restar1 -= 0.1;
          valores = redondearDecimales(restar1, 2);
          document.getElementsByName("porcentaje4")[0].value = valores; 
        }else{
            toastr.info('El valor debe estar entre 0 y 1', 'Lo sentimos!', {timeOut:3000});
        }
        break;
    default:
        console.log('Lo lamentamos');
    }
    sumarval();
}

//funcion sumar
function sumarval() {
        v1 = document.getElementsByName("porcentaje1")[0].value; 
        v2 = document.getElementsByName("porcentaje2")[0].value; 
        v3 = document.getElementsByName("porcentaje3")[0].value; 
        v4 =  document.getElementsByName("porcentaje4")[0].value; 
        sum = parseFloat(v1) + parseFloat(v2) + parseFloat(v3) + parseFloat(v4);
        sum = redondearDecimales(sum, 2);
        document.getElementById("tot").innerHTML=sum;
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