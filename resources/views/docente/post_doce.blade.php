<table class="table table-striped">
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
      
        <tr>
        <td>{{ $post->num_doc }}</td>
        <td>{{ $post->nombre }} {{ $post->apellido }}</td>
        <td>{{ $post->telefono }}</td>
        <td>{{ $post->direccion }}</td>
        <td>{{date("Y-m-d", strtotime($post->fec_vinculacion))}}</td>
        
        <td>
          <a href="{{route('actualizar_doc',$post->id)}}" ><i class="nav-icon fas fa-edit" ></i></a>&nbsp&nbsp&nbsp
          <a type="button"  data-toggle="modal" data-target="#docente<?php echo $post->id;?>">
          <i class="nav-icon fas fa-eye"></i></a>
          <div class="modal fade" id="docente<?php echo $post->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <div> DOCENTE:  {{ $post->nombre }} {{ $post->apellido }}</div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <!---Mostrar datos-->
                  
              
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