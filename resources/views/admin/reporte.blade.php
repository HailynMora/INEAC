@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado De Usuarios</h3>
</div>
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
  @if(Session::has('db'))
  <div class="alert alert-success fade show" role="alert" >
    <strong class="alerta"> {{Session::get('db')}} </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
<div class="container" >
  <a type="button" data-toggle="modal" data-target="#eliminardb"><i class="fas fa-database" style="font-size: 24px; color:#16997F;"></i> Limpiar DB</a>
  <!---modal-->
  <!-- Modal -->
    <div class="modal fade" id="eliminardb" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">¿En verdad desea eliminar los registros de la base de datos?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Tenga en cuenta que si elimina los registros de la base de datos, desapareceran definitivamente.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Salir</button>
            <a href="{{route('eliminardb')}}" type="button" class="btn btn-primary">Confirmar</a>
          </div>
        </div>
      </div>
    </div>
  <!--end modal-->
</div>

<div class="container table-responsive">
    <table class="table">
        <tr>
            <thead class="alerta" style="background-color:#0f468e;color: #ffffff;">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Usuario</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cambiar</th>
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
                  <td>{{$usu->despre}}</td>
                  @if($usu->email != "adm@gmail.com")
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
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confir{{$usu->id}}">Guardar</button>
                                <!---confirmar  boton-->
                                <!-- Modal -->
                                <div class="modal fade" id="confir{{$usu->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de cambiar el rol de este usuario?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Si</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <!--end confirmar-->
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
                                                <br>
                                                {{$usu->email}}
                                                <br>
                                                </strong>
                                            </div>
                                            <div class="modal-footer alerta">
                                               <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#des{{$usu->id}}">Cambiar</button>
                                                  <!---confirmar  boton-->
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="des{{$usu->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de cambiar el estado del usuario?</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                          <a  class="btn btn-primary" href="{{ route('cambiarestadoUsu', $usu->id) }}">Si</a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                    <!--end confirmar-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!---fin ventana deshabilitar--->
                    <!--end deshabilitar-->
                 
                    <!--actualizar rol-->
                      <!-- Modal -->
                      </td>
                      @else
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      @endif
                      
                </tr>
                  
                @endforeach
            </tbody>
          </table>
          {{$u->links()}}
        </div>
        <!--end tabla-->

@endsection