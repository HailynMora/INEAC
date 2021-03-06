@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  Formulario Registro de Docentes
</div>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-edit"></i> Datos Personales
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <form>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="tipo_doc">Tipo de Documento</label>
                    <select id="tipo_doc" class="form-control">
                      <option selected>seleccionar</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="num_doc">Numero Documento</label>
                    <input type="number" class="form-control" id="num_doc" placeholder="12345678">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido">
                  </div>
              </div>
                
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="correo">Correo Electronico</label>
                    <input type="email" class="form-control" id="correo" placeholder="example@example.com">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="form-control" id="telefono" >
                  </div>
                  <div class="form-group col-md-4">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion">
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="submit" class="btn btn-warning">Limpiar</button>
                <button type="submit" class="btn btn-danger">Cancelar</button>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection