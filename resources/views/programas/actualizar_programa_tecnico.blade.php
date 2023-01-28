@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center " role="alert" style="background-color: #ffc107; color:white;">
 <h3 class="letra1">Actualizar programa técnico</h3>
</div>
<br><br>
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <!---->
        <div class="row">
           <div class="col-md-10">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left alerta" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Actualizar programa
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right alerta" type="button" href="/programas/reporte_programas_tecnicos">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body letraf">
            <form action="{{route('actualizar_programa_tec',$prog[0]->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$prog[0]->nombretec}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="codigo">Codigo</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" required  value="{{$prog[0]->codigotec}}" min="0">
                    </div>
                </div>
                <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required value="{{$prog[0]->descripcion}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jornada">Jornada</label>
                        <select  id="jornada" name="jornada" class="form-control" required>
                        @if($prog[0]->jornada == 'Sabado')
                        <option value="{{$prog[0]->jornada}}" selected>{{$prog[0]->jornada}}</option>
                        <option value="Domingo">Domingo</option>
                        @endif
                        @if($prog[0]->jornada == 'Domingo')
                        <option value="{{$prog[0]->jornada}}">{{$prog[0]->jornada}}</option>
                        <option value="Sabado">Sabado</option>
                        @endif
                        <input type="text" class="form-control" id="estado" name="estado" required value="1" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                 <a href="{{route('reporte_tecnico')}}"type="submit" class="btn btn-danger">Salir</a>
                 <button type="submit" class="btn btn-success">Guardar</button>
               </div>
            </form>
        </div>
      </div>
    </div>
</div>



@endsection
