@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Actualizar Docentes
</div>
<div class="container">
<form action="{{route('actualizar_asignatura',$asig->id)}}" method="post">
              @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" value="{{$asig->codigo}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$asig->nombre}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="intensidad_horaria">Intensidad Horaria</label>
                        <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" value="{{$asig->intensidad_horaria}}">
                    </div>
                  
                <div class="form-group col-md-6">
                    <label for="val_habilitacion">Valor Habilitación</label>
                    <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" value="{{$asig->val_habilitacion}}">
                  </div>
                  <div class="form-group col-md-6" >
                  <label for="id_estado">Estado</label>
                  <select id="id_estado" class="form-control" name="id_estado">
                  @foreach($estado as $es)
                  <option value="{{$es->id}}">{{$es->descripcion}}</option>
                  @endforeach
                  </select>
                  </div>
              </div>
                
              <button type="submit" class="btn btn-success">Actualizar</button>
              <a href="{{route('reporte')}}"type="submit" class="btn btn-warning">Cancelar</a>
              
              </form>
</div>
@endsection