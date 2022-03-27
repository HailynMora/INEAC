@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Actualizar Docentes
</div>
<div class="container">
    <form action="{{route('actualizar_docente',$doc['id'])}}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
            <label for="tipodoc">Tipo de Documento</label>
            <select id="tipodoc" class="form-control" name="tipodoc" required >
                @foreach($tipo_doc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group col-md-3">
            <label for="numerodoc">Numero Documento</label>
            <input type="number" class="form-control" id="numerodoc" name="numerodoc" value="{{$doc->num_doc}}" required>
            </div>
            <div class="form-group col-md-3">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$doc->nombre}}">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required value="{{$doc->apellido}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
            <label for="correo">Correo Electronico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{$doc->correo}}" required>
            </div>
            <div class="form-group col-md-3">
            <label for="telefono">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" value="{{$doc->telefono}}">
            </div>
            <div class="form-group col-md-3">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$doc->direccion}}">
            </div>
            <div class="form-group col-md-3">
            <label for="fec_vinculacion">Fecha vinculación</label>
            <input type="date" class="form-control" id="fec_vinculacion" name="fec_vinculacion" required value="{{$doc->fec_vinculacion}}">
            </div>
            <div class="form-group col-md-3" >
            <label for="id_usuario">Usuario</label>
            <select id="id_usuario" class="form-control" name="id_usuario" required>
            @foreach($u as $us)
            <option value="{{$us->id}}">{{$us->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group col-md-3">
            <label for="tipogen">Genero</label>
            <select id="tipogen" class="form-control" name="tipogen" required>
            @foreach($gen as $g)
            <option value="{{$g->id}}">{{$g->descripcion}}</option>
            @endforeach
            </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
</div>
@endsection