<?php
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Auth;
?>
@extends('usuario.principa_usul')
@section('content')
<style>
  .borde {
  padding-top: 2px;
  padding-bottom: 2px;
  padding-right: 2px;
  padding-left: 2px;
  border-radius: 10px;
  background-color: #0f468e;
}
</style>
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:white;">
 <h2 class="letra1">Bienvenid@ {{Auth::user()->name}}</h2>
</div>
<br>

@if(Auth::user()->id_rol==1) <!--Logeado como administrador-->
   @include('inicio.inicioAdmin')
@endif
@if(Auth::user()->id_rol==2) <!--Logeado como  docente-->
    @include('inicio.inicioDoc')
@endif
@if(Auth::user()->id_rol==3) <!--Logeado estudiante-->
    @include('inicio.inicioestu')
@endif
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(isset($r))
@if($r == 0)
  <script>
    swal({
    title: "Lo sentimos!",
    text: "No se encontró información para la solicitud",
    icon: "warning",
    button: "Salir",
  });
  </script>
  @endif
@endif
@endsection