@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Actualizar Docentes</h3>
</div>
<br><br>
<div class="container letraf">
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
            <input type="text" class="form-control" id="numerodoc" name="numerodoc" value="{{$doc[0]->num_doc}}" minlength="5" maxlength="12" required>
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
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{$doc[0]->telefono}}" minlength="10" maxlength="10">
            </div>
            <div class="form-group col-md-3">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$doc[0]->direccion}}">
            </div>
            <div class="form-group col-md-3">
            <label for="fec_vinculacion">Fecha vinculación</label>
            <input type="date" class="form-control" id="fec_vinculacion" name="fec_vinculacion" required value="{{date('Y-m-d', strtotime($doc[0]->fec_vinculacion))}}"><td></td>
            </div>
           
            <div class="form-group col-md-6">
            <label for="tipogen">Genero</label>
            <select id="tipogen" class="form-control" name="tipogen" required>
            <option value="{{$doc[0]->id_genero}}" selected>{{$doc[0]->gendoc}}</option>
            @foreach($gen as $g)
            @if($doc[0]->id_genero != $g->id)
            <option value="{{$g->id}}">{{$g->descripcion}}</option>
            @endif
            @endforeach
            </select>
            </div>
            <div class="form-group col-md-6">
                <label for="estado">Estado</label>
                <select id="estado" class="form-control" name="estado" required>
                <option value="{{$doc[0]->id_estado}}" selected>{{$doc[0]->estado}}</option>
                @foreach($es as $e)
                  @if($doc[0]->id_estado != $e->id)
                    <option value="{{$e->id}}">{{$e->descripcion}}</option>
                 @endif
                @endforeach
                </select>
            </div>
        </div>
        <a href="{{route('listado_docente')}}"type="submit" class="btn btn-warning">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
</div>
@endsection