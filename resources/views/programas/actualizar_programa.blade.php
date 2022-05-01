@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Actualizar Programas</h3>
</div>
<br><br>
<div class="container">
<form action="{{route('actualizar_programa',$prog[0]->id)}}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$prog[0]->programa}}">
        </div>
        <div class="form-group col-md-6">
            <label for="codigo">Codigo</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required  value="{{$prog[0]->codigo}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="des">Descripcion</label>
            <input type="text" class="form-control" id="des" name="des" required value="{{$prog[0]->cursodes}}">
        </div>
        <div class="form-group col-md-4">
            <label for="jornada">Jornada</label>
            <input type="text" class="form-control" id="jornada" name="jornada" required value="{{$prog[0]->jornada}}">
        </div>
        <div class="form-group col-md-4">
            <label for="estado">Estado</label>
            <select id="estado" class="form-control" name="estado" required>
            <option value="{{$prog[0]->id_estado}}" selected>{{$prog[0]->estado}}</option>
            @foreach($estado as $d)
                <option value="{{$d->id}}">{{$d->descripcion}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{route('reporte_pro')}}"type="submit" class="btn btn-warning">Cancelar</a>
    
    </form>
</div>
@endsection