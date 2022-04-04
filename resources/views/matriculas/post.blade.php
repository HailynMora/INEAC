<!--tabla para ver los valores-->
<div class="container-fluid">
<table class="table">
<tr>

              <thead class="table-warning">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
                <th scope="col">No. Documento</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Seleccionar</th>
              </tr>
            </thead>
            <tbody>
                  <th scope="row">{{$post[0]->id}}</th>
                  <td>{{ $post[0]->nombre }}</td>
                  <td>{{ $post[0]->apellido }}</td>
                  <td>{{ $post[0]->direccion }}</td>
                  <td>{{ $post[0]->telefono }}</td>
                  <td>{{ $post[0]->num_doc }}</td>
                  <td>{{ $post[0]->descripcion }}</td>
                <td>
                 <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Matricular
                    </button> 
               </td>
            </tbody>
          </table>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Matricular Estudiante: <span style="text-color: black;"> {{ $post[0]->nombre }}&nbsp{{ $post[0]->apellido }}</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- contenido del modal--> 
                                <div class="form-row">
                                <div class="form-group col-md-6">

                                    <div class="alert" role="alert" style="background-color:#8EEDF3;">
                                        <h4 class="alert-heading">Datos Personales</h4>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <p>
                                        texto
                                        </p>    
                                    </div>                  
                                </div>
                                <div class="form-group col-md-6">
                                <div class="alert " role="alert" style="background-color:#8EEDF3;">
                                        <h4 class="alert-heading">Elegir Curso</h4>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <p>
                                       texto
                                        </p>    
                                    </div>    
                                </div>
                                </div>
                            <!--end contenido del modal-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                        </div>
                    </div>
                    </div>
    </div>
        <!--end tabla-->
