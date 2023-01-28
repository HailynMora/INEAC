@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Actualizar programas</h3>
</div>
<br><br>
<div class="container letraf">
<form action="{{route('actualizar_programa',$prog[0]->id)}}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$prog[0]->programa}}">
        </div>
        <div class="form-group col-md-6">
            <label for="codigo">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required  value="{{$prog[0]->codigo}}" min="0">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="des">Descripción</label>
            <input type="text" class="form-control" id="des" name="des" required value="{{$prog[0]->cursodes}}">
        </div>
        <div class="form-group col-md-6">
            <label for="jornada">Jornada</label>
            <select  id="jornada" name="jornada" class="form-control" required>
            @if($prog[0]->jornada == 'Sabado')
            <option value="{{$prog[0]->jornada}}" selected>{{$prog[0]->jornada}}</option>
            <option value="Domingo">Domingo</option>
            @endif
            @if($prog[0]->jornada == 'Domingo')
            <option value="{{$prog[0]->jornada}}">{{$prog[0]->jornada}}</option>
            <option value="Sábado">Sábado</option>
            @endif
            </select>
        </div>
            <input type="number" class="form-control" id="estado" name="estado" value="1" hidden>
    </div>
    <div class="modal-footer">
      <a href="{{route('reporte_pro')}}"type="submit" class="btn btn-danger">Salir</a>
      <button type="submit" class="btn btn-success">Guardar</button>
    </div>
    </form>
</div>
@endsection