<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $anio = DB::table('asignaturas_tecnicos')->select('anio')->distinct()->get();
  $curso = DB::table('programa_tecnico')->select('id','nombretec')->distinct()->get();
  $trimestre = DB::table('trimestre_tecnicos')->select('id','nombretri')->get();

?>
@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Certificados Estudiantiles</h3>
</div>
<div class="container alerta">
  <div class="row">
    <div class="col-4" style="padding-top: 5%;">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/nota.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#exampleModal" class="nav-link">Generar</a>
        </div>
      </div>
    </div>
    <div class="col-4" style="padding-top: 5%;">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/matricula.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#matricula" class="nav-link">Generar</a>
        </div>
      </div>
    </div>
    <div class="col-4" style="padding-top: 5%;">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/boletin.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#boletin" class="nav-link">Generar</a>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<form action="{{route('pdfEstudiantilNot')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo Académico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--periodo academico-->
          <div class="row">
            <div class="col-4">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Trimestre</label>
              <select class="form-control" id="trimestre" name="trimestre">
                @foreach($trimestre as $a)
                    <option value="{{$a->id}}">{{$a->nombretri}}</option>
                @endforeach
              </select>
            </div> 
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Año</label>
              <select class="form-control" id="anio" name="anio">
                @foreach($anio as $a)
                  @if(isset($a->anio))
                    <option value="{{$a->anio}}">{{$a->anio}}</option>
                  @endif
                @endforeach
              </select>
            </div> 
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Periodo</label>
              <select class="form-control" id="periodo" name="periodo">
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="B">C</option>
                 <option value="B">D</option>
              </select>
            </div>
            <input type="text" name="ides" value="{{$ides}}" id="ides" hidden>
         </div>
         </div>
          <!-- end per acdemico-->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="{{route('pdfEstudiantilmattec')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="matricula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo Académico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--periodo academico-->
          <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Año</label>
              <select class="form-control" id="anio" name="anio">
                @foreach($anio as $a)
                  @if(isset($a->anio))
                    <option value="{{$a->anio}}">{{$a->anio}}</option>
                  @endif
                @endforeach
              </select>
            </div> 
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Periodo</label>
              <select class="form-control" id="periodo" name="periodo">
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="B">C</option>
                 <option value="B">D</option>
              </select>
            </div>
            <input type="text" name="ides" value="{{$ides}}" id="ides" hidden>
         </div>
         </div>
          <!-- end per acdemico-->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="{{route('boletintec')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="boletin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo Académico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--periodo academico-->
          <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Año</label>
              <select class="form-control" id="anio" name="anio">
                @foreach($anio as $a)
                  @if(isset($a->anio))
                    <option value="{{$a->anio}}">{{$a->anio}}</option>
                  @endif
                @endforeach
              </select>
            </div> 
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Periodo</label>
              <select class="form-control" id="periodo" name="periodo">
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="B">C</option>
                 <option value="B">D</option>
              </select>
            </div>
            <input type="text" name="ides" value="{{$ides}}" id="ides" hidden>
         </div>
         </div>
          <!-- end per acdemico-->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>
</form>
<style>
  .modal-backdrop {
  z-index: -1;
  }
</style>
@endsection