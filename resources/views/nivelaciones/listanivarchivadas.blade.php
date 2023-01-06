@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado De Nivelaciones</h3>
</div>
  <div class="table-responsive">
	<table class="table">
	  <thead style="background-color:#0f468e; color:white;" class="alerta">
	    <tr>
	      <th scope="col">N°</th>
	      <th scope="col">Ciclo</th>
          <th scope="col">Periodo</th>
          <th scope="col">Asignatura</th>
          <th scope="col">Definitiva</th>
	      <th scope="col">N° recibo</th>
	      <th scope="col">Descargar</th>
		  <th scope="col" colspan="3" style="text-align:center;">Acción</th>
	    </tr>
	  </thead>
	  <tbody style="background-color:#e3e3e3;" class="letraf">
	  	<?php
	  		$cont = 1;
	  	?>
		@if(isset($niv[0])) 
	  	@foreach($niv as $m)
	    <tr>
	      <th scope="row">{{$cont++}}</th>
	      <td>{{$m->cursonom}}</td>
          <td>{{$m->anio}} - {{$m->periodo}}</td>
          <td>{{$m->nomasig}}</td>
          <td>{{$m->definitiva}}</td>
	      <td>{{$m->numrecibo}}</td>
	      <td>
          @if($m->imgrecibo != '')
          <a href="/dist/archivo/{{$m->imgrecibo}}" download="Recibo de pago"  title="Descargar recibo de pago"><i class="fas fa-file-download" style="font-size:24px;"></i></a>
          @else
          <a onclick="mensaje();" download="Recibo de pago"  title="Descargar recibo de pago"><i class="fas fa-file-download" style="font-size:24px;"></i></a>
          @endif
        </td>
		  <td>
		   <!--modal-->
           <!-- Button trigger modal -->
                <a type="button" data-toggle="modal" data-target="#restu{{$m->idniv}}" title="Ver mas">
                 <i class="fas fa-plus-circle" style="color:#ffc107; font-size:24px;"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="restu{{$m->idniv}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header" style="background-color:#E0FCFF;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive" style="background-color:#E0FCFF;">
                    <!--table-->
                    <table class="table table-bordered ">
                    <thead>
                        <tr>
                        <th scope="col">Nota 1</th>
                        <th scope="col">%</th>
                        <th scope="col">Nota 2</th>
                        <th scope="col">%</th>
                        <th scope="col">Nota 3</th>
                        <th scope="col">%</th>
                        <th scope="col">Nota 4</th>
                        <th scope="col">%</th>
                        <th scope="col">Definitiva</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>{{$m->nota1}}</td>
                        <td>{{$m->por1 * 100}}</td>
                        <td>{{$m->nota2}}</td>
                        <td>{{$m->por2 * 100}}</td>
                        <td>{{$m->nota3}}</td>
                        <td>{{$m->por3  * 100}}</td>
                        <td>{{$m->nota4}}</td>
                        <td>{{$m->por4  * 100}}</td>
                        <td>{{$m->definitiva}}</td>
                        </tr>
                    </tbody>
                    </table>
                    <!--end table-->
                    <div class="container">
                        <h6><b>Estudiante:</b> {{$m->primernom}} {{$m->segnom}} {{$m->primerape}} {{$m->segape}}</h6>
                        <hr>
                        <b>Docente:</b>
                        {{$m->nombre}} {{$m->apellido}}
                        <hr>
                        <b>Descripción:</b>
                        {{$m->descripcion}}
                        <hr>
                        <b>Nota Anterior:</b>
                         {{$m->notantigua}}
                    </div>
                    </div>
                    <div class="modal-footer" style="background-color:#E0FCFF;">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                    </div>
                    </div>
                </div>
                </div>
           <!--end modal-->
		  </td>
	    </tr>
	    @endforeach
		@endif
    @if(isset($nivtec[0])) 
      @foreach($nivtec as $n)
         <!--#####################################-->
         <tr>
          <th scope="row">{{$cont++}}</th>
          <td>{{$n->cursonom}}</td>
          <td>{{$n->anio}} - {{$n->periodo}}</td>
          <td>{{$n->nomasig}}</td>
          <td>{{$n->definitiva}}</td>
          <td>{{$n->numrecibo}}</td>
            <td>
              @if($n->imgrecibo != '')
              <a href="/dist/archivo/{{$n->imgrecibo}}" download="Recibo de pago"  title="Descargar recibo de pago"><i class="fas fa-file-download" style="font-size:24px;"></i></a>
              @else
              <a onclick="mensaje();" download="Recibo de pago"  title="Descargar recibo de pago"><i class="fas fa-file-download" style="font-size:24px;"></i></a>
              @endif
            </td>
          <td>
          <!--modal-->
              <!-- Button trigger modal -->
                    <a type="button" data-toggle="modal" data-target="#re{{$n->idniv}}" title="Ver mas">
                    <i class="fas fa-plus-circle" style="color:#ffc107; font-size:24px;"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="re{{$n->idniv}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header" style="background-color:#E0FCFF;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body table-responsive" style="background-color:#E0FCFF;">
                        <!--table-->
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                            <th scope="col">Nota 1</th>
                            <th scope="col">%</th>
                            <th scope="col">Nota 2</th>
                            <th scope="col">%</th>
                            <th scope="col">Nota 3</th>
                            <th scope="col">%</th>
                            <th scope="col">Nota 4</th>
                            <th scope="col">%</th>
                            <th scope="col">Definitiva</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>{{$n->nota1}}</td>
                            <td>{{$n->por1 * 100}}</td>
                            <td>{{$n->nota2}}</td>
                            <td>{{$n->por2 * 100}}</td>
                            <td>{{$n->nota3}}</td>
                            <td>{{$n->por3 * 100}}</td>
                            <td>{{$n->nota4}}</td>
                            <td>{{$n->por4 * 100}}</td>
                            <td>{{$n->definitiva}}</td>
                            </tr>
                        </tbody>
                        </table>
                        <!--end table-->
                        <div class="container">
                            <b>Trimestre:</b>
                            {{$n->nombretri}}
                            <hr>
                            <b>Docente:</b>
                            {{$n->nombre}} {{$n->apellido}}
                            <hr>
                            <b>Descripción:</b>
                            {{$n->descripcion}}
                            <hr>
                            <b>Nota Anterior:</b>
                            {{$n->notantigua}}
                        </div>
                        </div>
                        <div class="modal-footer" style="background-color:#E0FCFF;">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                        </div>
                        </div>
                    </div>
                    </div>
              <!--end modal-->
          </td>
          </tr>
         <!--#######################################-->
      @endforeach
    @endif
	  </tbody>
	</table>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
   <script>
     function mensaje() {
      toastr.info('Lo sentimos!', 'No hay archivo para descargar', {timeOut:3000});
    }
   </script>
@endsection
