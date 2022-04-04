@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Vincular Docente a Asignaturas
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-edit"></i>
  Vincular Docente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Docente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formudatos" name="formudatos" method="post">
      <h4>Asignaturas</h4>
              @csrf
                <div class="form-row">
                 <!-- <div class="form-group col-md-4">
                  <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success my-4 my-sm-2" type="submit">Search</button>
                    </form>
                  </nav>
                  </div>-->
                  <div class="form-group col-md-6">
                    
                        <label for="asignatura">Asignatura</label>
                        <select id="asignatura" class="form-control" name="asignatura">
                        <option selected>Seleccionar</option>
                        @foreach($asignatura as $as)
                        <option value="{{$as->id}}">{{$as->nombre}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="docente">Docente</label>
                        <select id="docente" class="form-control" name="docente">
                        <option selected>Seleccionar</option>
                        @foreach($docente as $do)
                        <option value="{{$do->id}}">{{$do->nombre}} {{$do->apellido}}</option>
                        @endforeach
                        </select>
                    </div>
                  <div class="form-group col-md-12">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                  </div>
                  
              </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
                <button type="submit" class="btn btn-success">Agregar</button>
                <button type="submit" class="btn btn-warning"  onclick="resetform()">Limpiar</button>
                <a  class="btn btn-danger" href="{{url('/asignatura/vincular_docente')}}">Cancelar</a>
              </form>
      </div>
    </div>
  </div>
</div>
<!--fin modal-->
<br><br><br>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Listado Asignaturas
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Asignatura</th>
            <th scope="col">IH</th>
            <th scope="col">Docente</th>
            <th scope="col">Descripcion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($asig as $d)
        <tr>
        <td>{{$d->codigo}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->nom_doc}} {{$d->ape_doc}}</td>
        <td>{{$d->descripcion}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $('#formudatos').submit(function(e){
    e.preventDefault();
    var asignatura=$('#asignatura').val();
    var docente=$('#docente').val();
    var descripcion=$('#descripcion').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('vincular')}}",
      data:{
        asignatura:asignatura,
        docente:docente,
        descripcion:descripcion,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('Docente vinculado correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      }
    });
  })
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] ,form input[type=date] , form input[type=email]").each(function() { this.value = '' });
     toastr.success('Campos Vacios', {timeOut:1000});
  }
</script>
@endsection