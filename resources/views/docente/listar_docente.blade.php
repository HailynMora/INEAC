@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
 <h3>Listado de Docentes</h3>
</div>
<div>
<a href="{{route('regdocente')}}" class="btn btn-outline-success my-2 my-sm-0" >Registrar</a>
    <form class="form-inline my-6 my-lg-0 float-right mb-6">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    
    <br><br>
    <div class="container">
    @csrf
      <table class="table table-striped"style="background-color:#FFCC00;">
      <thead>
          <tr>
          <th scope="col">Tipo Doc</th>
          <th scope="col">Documento</th>
          <th scope="col">Nombres</th>
          <th scope="col">Fec. Vinculación</th>
          <th scope="col">Estado</th>
          <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody>
        @if($b == 1)
          @foreach($doc as $d)
          <tr style="background-color: #dcedc8;">
            <td>{{$d->descripcion}}</td>
            <td>{{$d->num_doc}}</td>
            <td>{{$d->nombre}}  {{$d->apellido}}</td>
            <td>{{date("Y-m-d", strtotime($d->fec_vinculacion))}}</td>
            <td>{{$d->estado}}</td>
            <td>
              <a href="{{route('actualizar_doc',$d->id)}}"  data-toggle="tooltip"  data-placement="bottom"  title="Editar Docente" ><i class="nav-icon fas fa-edit" style="color:  #e1b308;" ></i></a>&nbsp&nbsp&nbsp
              <a type="button"  data-toggle="modal" data-target="#docente<?php echo $d->id;?>" style="color: #66b62b"  data-placement="bottom"  title="Visualizar">
              <i class="nav-icon fas fa-eye"></i></a>
              &nbsp&nbsp
              <?php
              if($d->estado == 'Activo'){
                  ?>
                  <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Deshabilitar"><i class="nav-icon fas fa-toggle-on" style="color: #64e108;"></i></a>
                  <?php
              }else{
                  ?>
                  <a type="button" data-toggle="modal" data-target="#cambiarEstado{{$d->id}}"  data-placement="bottom"  title="Habilitar"><i class="nav-icon fas fa-toggle-off" style="color: #9cbe82;"></i></a>
                  <?php
              }
              ?>
              <!--MODAL VER-->
              <div class="modal fade" id="docente<?php echo $d->id;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <!---Mostrar datos-->
                    <form id="formudatos" name="formudatos" method="post">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="tipo_doc">Tipo Documento</label>
                          <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" disabled value="{{$d->descripcion}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="num_doc">N° Documento</label>
                          <input type="text" class="form-control" id="num_doc" name="num_doc" disabled value="{{$d->num_doc}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="correo">Correo</label>
                          <input type="text" class="form-control" id="correo" name="correo" disabled value="{{$d->correo}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="telefono">Telefono</label>
                          <input type="text" class="form-control" id="telefono" name="telefono" disabled value="{{$d->telefono}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="direccion">Direccion</label>
                          <input type="text" class="form-control" id="direccion" name="direccion" disabled value="{{$d->direccion}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="genero">Genero</label>
                          <input type="text" class="form-control" id="genero" name="genero" disabled value="{{$d->genero}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="fec_vinculacion">Fecha de Vinculacion</label>
                          <input type="text" class="form-control" id="fec_vinculacion" name="fec_vinculacion" disabled value="{{date('Y-m-d', strtotime($d->fec_vinculacion))}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="fec_vinculacion">Estado</label>
                          <input type="text" class="form-control" id="estado" name="estado" disabled value="{{$d->estado}}">
                        </div>
                        <div class="form-group col-md-12">
                        <!---asignaturas a cargo-->
                        <?php 
                          $id=$d->id;
                        ?>
                        
                            <div class="form-group justify-content-center col-md-12 " id="docente">
                              <label for="asig_dictadas">Asignaturas a Cargo</label>
                              <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Asignatura</th>
                                    <th scope="col">Intensidad Horaria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($condoc as $c)
                                  @if($c->id_docente==$id)
                                  <tr>
                                  <td>{{$c->codigo}} </td>
                                  <td>{{$c->nombre}}</td>
                                  <td>{{$c->intensidad_horaria}}</td>  
                                  </tr>                     
                                  @endif
                                @endforeach
                                
                            </tbody>
                            </table>

                            </div>
                        <!---end asignaturas a cargo-->
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
              <!--FIN MODAL VER-->
              
            </div>
            <!-- Ventana modal para cambiar -->
            <div class="modal fade" id="cambiarEstado{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #283593 !important;">
                    <h4 class="modal-title text-center" style=" text-align: center;">
                      <span>Docente: {{$d->nombre}}  {{$d->apellido}} </span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> 
                  </div>
                  <div class="modal-body mt-2 text-center">
                    <strong style="text-align: center !important"> 
                      <h4 class="modal-title text-center" style=" text-align: center;">
                        <span>¿Cambiar el estado {{$d->estado}} del Docente? </span>
                      </h4>
                    </strong>
                  </div>
                  <div class="modal-footer">
                    <a  class="btn btn-success" href="{{ route('cambiarEstado', $d->id) }}">Cambiar</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
              <!---fin ventana cambiar--->
          </td>
        </tr>
        @endforeach
        @else
        <div class="alert alert-warning text-center" role="alert">
          No Hay Registros
        </div>
        @endif
      </tbody>
    </table>
    {{$doc->links()}}
    </div>
   

</div>
<script>
  function JsonDate(jsonDate) {
  var date = new Date(parseInt(jsonDate.substr(6)));
  return date ;
}
</script>
@endsection