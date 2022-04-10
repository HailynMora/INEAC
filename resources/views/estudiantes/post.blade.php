<!--tabla para ver los valores-->
<table class="table" style="background-color:#FFCC00;">
<tr>

              <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
                <th scope="col">No. Documento</th>
                <th scope="col">Seleccionar</th>
              </tr>
            </thead>
            <tbody style="background-color: #dcedc8;">
                  <th scope="row">{{$post[0]->id}}</th>
                  <td>{{ $post[0]->nombre }}</td>
                  <td>{{ $post[0]->apellido }}</td>
                  <td>{{ $post[0]->direccion }}</td>
                  <td>{{ $post[0]->telefono }}</td>
                  <td>{{ $post[0]->num_doc }}</td>
                <td>
                <a href="{{route('actualizar_est',$post[0]->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
                <a type="button" data-toggle="modal" data-target="#estudiante<?php echo $post[0]->id;?>">
                <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
                </td>
                <!--  <td><button type="button" class="btn btn-success">Actualizar</button></td>
                  <td><button type="button" class="btn btn-danger">Eliminar</button></td>
                 -->
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="estudiante<?php echo $post[0]->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="staticBackdropLabel">
                       
                          Datos Estudiante
                       
                       </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!---Mostrar datos-->
                    <div class="row">
                        <div class="col-md-4">Nombre</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->nombre}} {{$post[0]->apellido}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Dirección</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->direccion}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tipo Doc.</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->tdoces}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Número</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->num_doc}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Genero</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->generoestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Etnia</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->etniaestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Estrato</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->estrato}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Usuario</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->usuestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Acudiente Nombres</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->nomacu}} {{$post[0]->apeacu}} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Parentesco</div>
                        <div class="col-md-4 ml-auto">{{$post[0]->paren}} </div>
                    </div>
                    
                    <!--end mostrar datos-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
            </tbody>
          </table>

        <!--end tabla-->
