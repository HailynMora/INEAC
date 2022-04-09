<table class="table table-striped" style="background-color:#FFCC00;">
  <thead>
      <tr>
      <th scope="col">N° Documento</th>
      <th scope="col">Nombre</th>
      <th scope="col">Telefono</th>
      <th scope="col">Direccion</th>
      <th scope="col">Fec. Vinculación</th>
      <th scope="col">Opciones</th>
      </tr>
  </thead>
  <tbody>
    <tr style="background-color: #dcedc8;">
      <td>{{ $post[0]->num_doc }}</td>
      <td>{{ $post[0]->nombre }} {{ $post[0]->apellido }}</td>
      <td>{{ $post[0]->telefono }}</td>
      <td>{{ $post[0]->direccion }}</td>
      <td>{{date("Y-m-d", strtotime($post[0]->fec_vinculacion))}}</td>
      
      <td>
        <a href="{{route('actualizar_doc',$post[0]->id)}}" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
        <a type="button"  data-toggle="modal" data-target="#docente<?php echo $post[0]->id;?>">
        <i class="nav-icon fas fa-eye" style="color: #66b62b"></i></a>
        &nbsp&nbsp
        <a href="#" ><i class="fas fa-trash-alt" style="color:  red;" ></i></a>
        <div class="modal fade" id="docente<?php echo $post[0]->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                  <div> DOCENTE:  {{ $post[0]->nombre }} {{ $post[0]->apellido }}</div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!---Mostrar datos-->
                <form id="formudatos" name="formudatos" method="post">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="tipo_doc">Tipo Documento</label>
                        <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" disabled value="{{$post[0]->descripcion }}">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="num_doc">N° Documento</label>
                        <input type="text" class="form-control" id="num_doc" name="num_doc" disabled value="{{$post[0]->num_doc}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" disabled value="{{$post[0]->correo}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" disabled value="{{$post[0]->telefono}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" disabled value="{{$post[0]->direccion}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="genero">Genero</label>
                        <input type="text" class="form-control" id="genero" name="genero" disabled value="{{$post[0]->genero}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="fec_vinculacion">Fecha de Vinculacion</label>
                        <input type="text" class="form-control" id="fec_vinculacion" name="fec_vinculacion" disabled value="{{date('Y-m-d', strtotime($post[0]->fec_vinculacion))}}">
                      </div>
                      <div class="form-group col-md-12">
                        @include('docente.lista')
                      </div>
                    </div>
                  </form>
            
                <!--end mostrar datos-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>