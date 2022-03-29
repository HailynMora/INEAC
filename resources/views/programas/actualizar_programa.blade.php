@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Actualizar Docentes
</div>
<div class="container">
<form action="{{route('actualizar_programa',$prog->id)}}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$prog->descripcion}}">
        </div>
        <div class="form-group col-md-6">
            <label for="codigo">Codigo</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required  value="{{$prog->codigo}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="estado">Estado</label>
            <select id="estado" class="form-control" name="estado" required>
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