@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Actualizar Docentes
</div>
<div class="container">
    <form action="{{route('actualizar_docente',$doc[0]->iddoc)}}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
            <label for="tipodoc">Tipo de Documento</label>
            <select id="tipodoc" class="form-control" name="tipodoc" required >
             <option value="{{$doc[0]->id_tipo_doc}}" selected>{{$doc[0]->desdoc}}</option>
                @foreach($tipo_doc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group col-md-3">
            <label for="numerodoc">Numero Documento</label>
            <input type="number" class="form-control" id="numerodoc" name="numerodoc" value="{{$doc[0]->num_doc}}" required>
            </div>
            <div class="form-group col-md-3">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$doc[0]->nombre}}">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required value="{{$doc[0]->apellido}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
            <label for="correo">Correo Electronico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{$doc[0]->correo}}" required>
            </div>
            <div class="form-group col-md-3">
            <label for="telefono">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" value="{{$doc[0]->telefono}}">
            </div>
            <div class="form-group col-md-3">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$doc[0]->direccion}}">
            </div>
            <div class="form-group col-md-3">
            <label for="fec_vinculacion">Fecha vinculación</label>
            <input type="date" class="form-control" id="fec_vinculacion" name="fec_vinculacion" required value="{{date('Y-m-d', strtotime($doc[0]->fec_vinculacion))}}"><td></td>
            </div>
            <div class="form-group col-md-3" >
            <label for="id_usuario">Usuario</label>
            <select id="id_usuario" class="form-control" name="id_usuario" required>
            <option value="{{$doc[0]->id_usuario}}" selected>{{$doc[0]->name}}</option>
            @foreach($u as $us)
            <option value="{{$us->id}}">{{$us->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group col-md-3">
            <label for="tipogen">Genero</label>
            <select id="tipogen" class="form-control" name="tipogen" required>
            <option value="{{$doc[0]->id_genero}}" selected>{{$doc[0]->gendoc}}</option>
            @foreach($gen as $g)
            <option value="{{$g->id}}">{{$g->descripcion}}</option>
            @endforeach
            </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{route('listado_docente')}}"type="submit" class="btn btn-warning">Cancelar</a>
        </form>
</div>
@endsection