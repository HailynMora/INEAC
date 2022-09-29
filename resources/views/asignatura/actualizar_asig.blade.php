@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #FFC107; color:#ffffff;">
 <h3 class="letra1"> Actualizar Asignaturas</h3>
</div>
<br><br>
<div class="container alerta">
<form action="{{route('actualizar_asignatura',$asig[0]->id)}}" method="post">
              @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" value="{{$asig[0]->codigo}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$asig[0]->asig}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="intensidad_horaria">Intensidad Horaria</label>
                        <input type="number" class="form-control" id="intensidad_horaria" name="intensidad_horaria" value="{{$asig[0]->intensidad_horaria}}">
                    </div>
                  
                <div class="form-group col-md-6">
                    <label for="val_habilitacion">Valor Habilitación</label>
                    <input type="number" class="form-control" id="val_habilitacion" name="val_habilitacion" value="{{$asig[0]->val_habilitacion}}">
                  </div>
                  <div class="form-group col-md-6" >
                  <label for="id_estado">Estados</label>
                  <select id="id_estado" class="form-control" name="id_estado">
                 <option value="{{$asig[0]->id_estado}}" selected>{{$asig[0]->estado}}</option>
                  @foreach($estado as $es)
                  <option value="{{$es->id}}">{{$es->descripcion}}</option>
                  @endforeach
                  </select>
                  </div>
              </div>
              <a href="{{route('reporte')}}"type="submit" class="btn btn-warning">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            
              </form>
</div>
@endsection