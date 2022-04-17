@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado De Usuario</h3>
</div>
<div class="container-fluid">
    <table class="table">
        <tr>
            <thead class="table-warning">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Usuario</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Permiso</th>
                <th scope="col">Descripcion</th>
              </tr>
            </thead>
            <tbody>
                @php
                $cont = 1;
                @endphp
                @foreach($u as $usu)
                <tr>
                <th scope="row">{{$cont++}}</th>
                  <td>{{$usu->name}}</td>
                  <td>{{$usu->email}}</td>
                  <td>{{$usu->rol}}</td>
                  <td>{{$usu->permiso}}</td>
                  <td>{{$usu->despre}}</td>
                </tr>
                  
                @endforeach
            </tbody>
          </table>
          {{$u->links()}}
        </div>
        <!--end tabla-->

@endsection