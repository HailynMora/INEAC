<?php
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Auth;
?>
@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Bienvenid@ {{Auth::user()->name}}</h3>
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

@endsection