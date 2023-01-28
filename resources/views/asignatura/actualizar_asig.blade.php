@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Actualizar asignaturas</h3>
</div>
<br><br>
<div class="container alerta">
<form action="{{route('actualizar_asignatura',$asig[0]->id)}}" method="post">
              @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" value="{{$asig[0]->codigo}}" min="0" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$asig[0]->asig}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="intensidad_horaria">Intensidad horaria</label>
                        <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" value="{{$asig[0]->intensidad_horaria}}" min="1" max="10" required>
                    </div>
                  
                   <div class="form-group col-md-6">
                    <label for="val_habilitacion">Valor habilitación</label>
                    <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" value="{{$asig[0]->val_habilitacion}}" min="10000" max="100000" required>
                    <input type="number" class="form-control" id="id_estado" name="id_estado" value="1" hidden>
                </div>
                 
              </div>
              <div class="modal-footer">
                <a href="{{route('reporte')}}"type="submit" class="btn btn-danger">Salir</a>
                <button type="submit" class="btn btn-success">Guardar</button>
             </div>
              </form>
</div>
@endsection