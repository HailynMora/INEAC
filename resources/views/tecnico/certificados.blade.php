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
 <h3 class="letra1">Certificados estudiantiles de programas técnicos</h3>
</div>
<!--mensajes-->
@if(Session::has('est'))
        <div class="alert alert-info alert-dismissible fade show alerta" role="alert">
            {{Session::get('est')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
<!--mensajes-->
<div class="container-fluid alerta d-none d-sm-none d-md-block">
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

<!--imagenes para celular-->
<div class="container d-block d-sm-block d-md-none">
  <div class="row">
    <div class="col-12">
     <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/nota.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#exampleModal" class="nav-link">Generar</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/matricula.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#matricula" class="nav-link">Generar</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('dist/img/boletin.png')}}" alt="Card image cap">
        <div class="card-body" style="display: flex;justify-content: center;align-items: center;">
          <a class="btn btn-warning" type="button" data-toggle="modal" data-target="#boletin" class="nav-link">Generar</a>
        </div>
      </div>
    </div>
  </div>

</div>

<!--end imagenes para celular-->

<!--notas-->
<div class="container alerta">
   <p>
    <a class="btn" data-toggle="collapse" href="#tecn" role="button" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-info-circle" style="font-size:24px; color:blue;"></i> Información
    </a>
  </p>
  <div class="collapse" id="tecn">
    <div class="card card-body">
      <div class="alert alert-primary" role="alert">
         Si el año o trimestre de selección no esta disponible, se debe a que no existen asignaturas vinculadas al programa técnico.
      </div>
    </div>
  </div>
</div>
  <!--end notas-->

<!-- Modal -->
<form action="{{route('pdfEstudiantilNot')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F1F1F1;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo académico</h5>
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
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="{{route('pdfEstudiantilmattec')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="matricula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F1F1F1;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo académico</h5>
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
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>
<form action="{{route('boletintec')}}" method="POST">
  @csrf
  <div class="modal fade alerta" id="boletin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F1F1F1;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Periodo académico</h5>
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
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar</button>
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