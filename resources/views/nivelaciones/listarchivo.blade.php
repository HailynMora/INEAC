@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Información De Nivelaciones</h3>
</div>
@if(Session::has('inf'))
  <div class="alert alert-dismissible fade show" role="alert" style="background-color:#33A9B7; color:white;">
    <strong class="alerta"> {{Session::get('inf')}} </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="table-responsive">
	<table class="table">
	  <thead style="background-color:#0f468e; color:white;" class="alerta">
	    <tr>
	      <th scope="col">N°</th>
	      <th scope="col">Estudiante</th>
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
	      <td>{{$m->primernom}} {{$m->segnom}} {{$m->primerape}} {{$m->segape}}</td>
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
                <a type="button" data-toggle="modal" data-target="#re{{$m->idniv}}" title="Ver mas">
                 <i class="fas fa-plus-circle" style="color:#ffc107; font-size:24px;"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="re{{$m->idniv}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <td>{{$m->por3 * 100}}</td>
                        <td>{{$m->nota4}}</td>
                        <td>{{$m->por4 * 100}}</td>
                        <td>{{$m->definitiva}}</td>
                        </tr>
                    </tbody>
                    </table>
                    <!--end table-->
                    <div class="container">
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
          <td><a href="#" title="Editar información" data-toggle="modal" data-target="#archivoactu{{$m->idniv}}"><i class="fas fa-edit" style="color:#33A9B7; font-size:24px;"></i></a>
          <!--modal-->
          <!-- Modal -->
            <div class="modal fade" id="archivoactu{{$m->idniv}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color:#ffc107; color:white;">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--formulario-->
						<form action="{{route('reciboactualizar')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="imgrecibo">Imagen</label>
								<input type="file" class="form-control" id="img" name="img"  accept="image/*">
								<small id="emailHelp" class="form-text text-muted">Agregar la imagen o foto del recibo de pago</small>
							</div>
							<div class="form-group">
								<label for="n1">Número de recibo</label>
								<input type="number" class="form-control" id="numrecibo" name="numrecibo" min="0" value="{{$m->numrecibo}}" required>
							</div>
							<div class="form-group">
								<label for="desrecibo">Descripción</label>
								<input type="text" class="form-control" id="desrecibo" name="desrecibo" value="{{$m->descripcion}}" required>
							</div>
							<input type="text" class="form-control" id="idniv" name="idniv" value="{{$m->idniv}}" hidden >
						<!--end formulario-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
						<button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
               </form>
                </div>
            </div>
            </div>
           <!-- end modal-->
          </td>
          <td>
            <a type="button" data-toggle="modal" data-target="#confir{{$m->idniv}}" title="Eliminar datos"><i class="fas fa-trash-alt" style="color:red; font-size:24px;"></i></a>
            <!--modal-->
                <div class="modal fade" id="confir{{$m->idniv}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Realmente desea eliminar la información de manera permanente?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                        <a href="/archivo/estudiante/elim/{{$m->idniv}}" type="button" class="btn btn-primary">Confirmar</a>
                    </div>
                    </div>
                </div>
                </div>
            <!--end modal-->
        </td>
	    </tr>
	    @endforeach
        @else
        <div class="alert alert-dismissible fade show" role="alert" style="background-color:#33A9B7; color:white;">
            <strong class="alerta">No se encontró información para la solicitud.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
