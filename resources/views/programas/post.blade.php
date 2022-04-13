<!--tabla para ver los valores-->
<table class="table">
              <thead class="table-warning" style="background-color:#FFCC00;">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Codigo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                <tr style="background-color: #dcedc8;">
                  <th scope="row">{{$post[0]->id}}</th>
                  <td>{{ $post[0]->codigo }}</td>
                  <td>{{ $post[0]->programa }}</td>
                  <td>{{ $post[0]->estado }}</td>
                  <td>
                    <a href="{{route('actualizar_prog',$post[0]->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>
                    &nbsp&nbsp
                    <?php
                    if($post[0]->estado == 'Activo'){
                        ?>
                        <type="button" data-toggle="modal" data-target="#cambiarPro{{$post[0]->id}}"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                        <?php
                    }else{
                        ?>
                        <a type="button" data-toggle="modal" data-target="#cambiarPro{{$post[0]->id}}" ><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                        <?php
                    }
                    ?>
                  </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
                <!-- Ventana modal para eliminar -->
                <div class="modal fade" id="cambiarPro{{ $post[0]->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #563d7c !important;">
                                <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                                    <span>¿Cambiar el estado {{$post[0]->estado}} del programa? </span>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                            </div>
                            <div class="modal-body mt-2 text-center">
                                <strong style="text-align: center !important"> 
                                {{ $post[0]->codigo }} - {{ $post[0]->programa }}
                                </strong>
                            </div>
                            <div class="modal-footer">
                                <a  class="btn btn-success" href="{{ route('cambiarPro', $post[0]->id) }}">Cambiar</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!---fin ventana eliminar--->
            </tbody>
          </table>

        <!--end tabla-->
