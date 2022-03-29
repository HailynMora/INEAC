@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Actualizar Estudiantes
</div>
<div class="container">
    <form action="{{route('actualizar_estudiante',$est->id)}}" method="post">
        @csrf
        <div class="container-fluid">
          <form id="matricula" name="matricula">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$est->nombre}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required value="{{$est->apellido}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tipodoc">Tipo Documento</label>
                        <select id="tipodoc" name="tipodoc" class="form-control" required >
                        @foreach($tipo_doc as $t) 
                         <option value="{{$t->id}}">{{$est->id_tipo_doc}}{{$t->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="numero_doc">Número Documento</label>
                        <input type="text" class="form-control" id="numero_doc" name="numero_doc" required value="{{$est->num_doc}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required value="{{$est->correo}}">
                    </div>
                </div>
                <!--aqui esta estrato-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required value="{{$est->telefono}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required value="{{$est->direccion}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estrato">Estrato</label>
                        <input type="number" class="form-control" id="estrato" name="estrato" required value="{{$est->estrato}}">
                    </div>
                </div>
                <!---->
                <div class="form-row">
                    <!--------->
                    <div class="form-group col-md-6">
                        <label for="genero">Genero</label>
                        <select id="genero" class="form-control" name="genero" required>
                            @foreach($gen as $g)
                            <option value="{{$g->id}}">{{$g->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!---->
                    <div class="form-group col-md-6">
                        <label for="etnia">Tipo Etnia</label>
                        <select id="etnia" class="form-control" name="etnia" required> 
                            @foreach($etnia as $e)
                            <option value="{{$e->id}}">{{$e->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="acudiente">Acudiente</label>
                    <select id="acudiente" class="form-control" name="acudiente" required>
                    @foreach($acu as $a)
                        <option value="{{$a->id}}">{{$a->nombre}} {{$a->apellido}} C.C {{$a->num_doc}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="certificado">Certificados</label>
                        <select id="certificado" class="form-control" name="certificado" required> 
                        @foreach($certificado as $cer)
                            <option value="{{$cer->id}}">{{$cer->foto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--estado certificados-->
                <div class="form-row">
                    <!--------->
                    <div class="form-group col-md-6">
                        <label for="usuario">Usuario</label>
                        <select id="usuario" class="form-control" name="usuario" required>
                            @foreach($user as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!---->
                    <div class="form-group col-md-6">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" name="estado" required>
                            @foreach($estado as $es)
                            <option value="{{$es->id}}">{{$es->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{route('listarestu')}}"type="submit" class="btn btn-warning">Cancelar</a>
            </form>
        </div>
        
    </form>
</div>
@endsection