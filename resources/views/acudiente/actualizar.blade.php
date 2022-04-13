@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Actualizar Acudiente</h3>
</div>
<form form action="{{route('actualizar_acudiente',$acu[0]->id)}}" method="post">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$acu[0]->nombre}}">
    </div>
    <div class="form-group col-md-6">
      <label for="apellido">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" required value="{{$acu[0]->apellido}}">
    </div>
  </div>
  <div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" required value="{{$acu[0]->direccion}}">
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="telefono">Telefono o Celular</label>
    <input type="text" class="form-control" id="telefono" name="telefono" required value="{{$acu[0]->telefono}}">
  </div>
  <div class="form-group col-md-6">
      <label for="tipogen">Genero</label>
      <select id="tipogen" name="tipogen" class="form-control">
      <option value="{{$acu[0]->id_genero}}" selected>{{$acu[0]->gen}}</option>
        @foreach($genero as $g)
        <option value="{{$g->id}}">{{$g->descripcion}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="tipodoc">Tipo Documento</label>
      <select id="tipodoc" name="tipodoc" class="form-control">
      <option value="{{$acu[0]->id_tipo_doc}}" selected>{{$acu[0]->tipodoc}}</option>
        @foreach($tipodoc as $t)
        <option value="{{$t->id}}">{{$t->descripcion}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="numerodoc">Número Documento</label>
      <input type="text" class="form-control" id="numerodoc" name="numerodoc" required value="{{$acu[0]->num_doc}}"> 
    </div>
    <div class="form-group col-md-4">
    <label for="parentesco">Parentesco</label>
      <select id="parentesco" name="parentesco" class="form-control">
      <option value="{{$acu[0]->id_parentesco}}" selected>{{$acu[0]->parent}}</option>
        @foreach($paren as $p)
        <option value="{{$p->id}}">{{$p->descripcion}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Actualizar</button>
  <a href="{{route('visacu')}}" type="button" class="btn btn-danger">Cancelar</a>
</form>
@endsection