@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Vincular Docente a Asignatura</h3>
</div>
<br><br>
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
                  <div class="form-group col-md-6">
                    
                        <label for="asignatura">Asignatura</label>
                        <select id="asignatura" class="form-control" name="asignatura">
                        <option selected>Seleccionar</option>
                        @foreach($asignatura as $as)
                        @if($as->estado=='Activo')
                        <option value="{{$as->id}}">{{$as->nombre}}</option>
                        @endif
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
        <thead style="background-color:#FFCC00;">
            <tr>
            <th scope="col">Código</th>
            <th scope="col">Asignatura</th>
            <th scope="col">IH</th>
            <th scope="col">Docente</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($asig as $d)
        <tr style="background-color: #dcedc8;">
        <td>{{$d->codigo}}</td>
        <td>{{$d->asig}}</td>
        <td>{{$d->intensidad_horaria}}</td>
        <td>{{$d->nom_doc}} {{$d->ape_doc}}</td>
        <td>{{$d->descripcion}}</td>
        <td>
          &nbsp&nbsp
          <a type="button" data-toggle="modal" data-target="#desvincularDoc{{$d->id}}"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-trash" style="color: red;"></i></a>
        </td>
        </tr>
         <!-- Ventana modal para eliminar -->
         <div class="modal fade" id="desvincularDoc{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #283593 !important;">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </div>
                    <div class="modal-body mt-2 text-center">
                    <h4 class="modal-title text-center" style=" text-align: center;">
                            <span>¿Esta seguro que desea desvincular el docente {{$d->nom_doc}} {{$d->ape_doc}} de la asignatura {{$d->asig}}? </span>
                        </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <a  class="btn btn-success" href="{{ route('desvincular_doc', $d->id) }}">Aceptar</a>
                    </div>
                </div>
            </div>
          </div>
        <!---fin ventana eliminar--->
        @endforeach
        </tbody>
        </table>

      </div>
    </div>
  </div>
  {{$asig->links()}}
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