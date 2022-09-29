@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado De Usuario</h3>
</div>
<br>
  @if(Session::has('infoRol'))
  <div class="alert alert-dismissible fade show" role="alert" style="background-color:#E3E3E3;">
    <strong class="alerta"> {{Session::get('infoRol')}} </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(Session::has('infoEs'))
  <div class="alert alert-dismissible fade show" role="alert" style="background-color:#E3E3E3;">
    <strong class="alerta"> {{Session::get('infoEs')}} </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

<div class="container table-responsive">
    <table class="table">
        <tr>
            <thead class="alerta" style="background-color:#0f468e;color: #ffffff;">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Usuario</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Permiso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody class="letraf" style="background-color: #e3e3e3;">
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
                  <td class="text-center">
                      <a type="button" class="btn" data-toggle="modal" data-target="#exampleModalCambio{{$usu->id}}">
                         <i class="nav-icon fas fa-edit" style="color:  #e1b308;font-size:20px;"></i>
                        </a>
                      <form action="{{route('cambioRol')}}" method="POST">
                        @csrf
                      <div class="modal fade" id="exampleModalCambio{{$usu->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#FFC107; color:white;">
                              <h5 class="modal-title" id="exampleModalLabel">¿Desea cambiar el rol del Usuario: {{$usu->email}} ?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body alerta">
                              <!--select de cambiar el rol-->
                              <div class="form-group">
                                <label for="newrol">Seleccionar Rol</label>
                                <select class="form-control" id="newrol" name="newrol">
                                  @foreach($rol as $r)
                                    @if(isset($r->idrol))
                                    <option value="{{$r->idrol}}">{{$r->nomrol}}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                              <!--ende select-->
                              <!--user-->
                              <input value="{{$usu->id}}" name="idusuario" id="idusuario" hidden>
                              <!--end user-->
                            </div>
                            <div class="modal-footer alerta">
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                     </form>
                    <!--end actualizar rol-->
                    </td> 
                  <td class="text-right" style="padding-top:20px;">
                    <!--deshabilitar-->
                       <!--#######################################3-->
                        @if($usu->estado == 1)
                          <a type="button" data-toggle="modal" data-target="#cambiarPro{{$usu->id}}" data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108; font-size:20px;"></i></a>
                        @endif   
                        @if($usu->estado == 2) 
                            <a type="button" data-toggle="modal" data-target="#cambiarPro{{$usu->id}}" data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82; font-size:20px;"></i></a>
                        @endif
                        <!-- Button trigger modal -->
                       
                     
                         <!-- Ventana modal para deshabilitar -->
                         <div class="modal fade" id="cambiarPro{{$usu->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#FFC107;">
                                                <h4 class="modal-title text-center" style="color:white; text-align: center;">
                                                    <span>¿Desea cambiar el estado del Usuario? </span>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button> 
                                            </div>
                                            <div class="modal-body mt-2 text-center alerta">
                                                <strong style="text-align: center !important"> 
                                                {{$usu->email}}
                                                </strong>
                                            </div>
                                            <div class="modal-footer alerta">
                                               <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                                <a  class="btn btn-success" href="{{ route('cambiarestadoUsu', $usu->id) }}">Cambiar</a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!---fin ventana deshabilitar--->
                    <!--end deshabilitar-->
                 
                    <!--actualizar rol-->
                      <!-- Modal -->
                      </td>
                      
                </tr>
                  
                @endforeach
            </tbody>
          </table>
          {{$u->links()}}
        </div>
        <!--end tabla-->

@endsection