@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Listado de Docentes</h3>
</div>
<div>
  <br><br>
  <div class="container table-responsive">
    <table class="table table-striped">
      <thead style="background-color:#0f468e;color:#ffffff;" class="alerta">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nombres</th>
          <th scope="col">Correo</th>
          <th scope="col">Telefono</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="tabla1" style="background-color:#e3e3e3;" class="letraf">
        <?php
         $acum=1;
        ?>
         @if(isset($doc[0]))
          @foreach($doc as $d)
          <tr>
             <td>{{$acum++}}</td>
            <td>{{$d->nombre}}  {{$d->apellido}}</td>
            <td>{{$d->correo}}</td>
            <td>{{$d->telefono}}</td>
            <td>
              
              <a type="button"  data-toggle="modal" data-target="#docente<?php echo $d->idoc;?>" style="color: #66b62b"  data-placement="bottom"  title="Visualizar">
              <i class="fas fa-address-card" style="font-size:25px;"></i></a>
              
              <!--MODAL VER-->
              <div class="modal fade" id="docente<?php echo $d->idoc;?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <br>
                    <!---Mostrar datos-->
                    <div class="alert text-center" role="alert" style="background-color: #283593; color:#ffffff;">
                     <h4>Docente: {{$d->nombre}}  {{$d->apellido}}</h4>
                    </div>
                    <!--ACORDEON-->
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="fas fa-book"></i> Asignaturas a cargo
                            </button>
                          </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
                            <div class="form-group col-md-12">
                              <!---asignaturas a cargo-->
                              <div class="form-group justify-content-center col-md-12 " id="docente">
                                <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr style="background-color:white;">
                                      <th scope="col">No</th>
                                      <th scope="col">Codigo</th>
                                      <th scope="col">Asignatura</th>
                                      <th scope="col">Intensidad Horaria</th>
                                      <th scope="col">Curso</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @if(isset($condoc[0][0]))
                                  <?php
                                         
                                         $con=1;
                                         for($i=0;$i<count($condoc);$i++) {
                                             for($j=0;$j<count($condoc[$i]);$j++) {
                                              if($d->idoc == $condoc[$i][$j]->id_docente){
                                                echo '<tr style="background-color:white;">
                                                     <td>'.$con++.'</td>
                                                     <td>'.$condoc[$i][$j]->cod.'</td>
                                                     <td>'.$condoc[$i][$j]->asig.'</td>
                                                     <td>'.$condoc[$i][$j]->horas.'</td>
                                                     <td>'.$condoc[$i][$j]->cur.'</td>
                                                 </tr>';

                                              }

                                           }
                                         }
                                         ?>
                                    @endif
                                    @if(isset($asigtec[0][0]))
                                  <?php
                                         
                                         $con=1;
                                         for($i=0;$i<count($asigtec);$i++) {
                                             for($j=0;$j<count($asigtec[$i]);$j++) {
                                              if($d->idoc == $asigtec[$i][$j]->id_docente){
                                                echo '<tr style="background-color:white;">
                                                     <td>'.$con++.'</td>
                                                     <td>'.$asigtec[$i][$j]->cod.'</td>
                                                     <td>'.$asigtec[$i][$j]->asig.'</td>
                                                     <td>'.$asigtec[$i][$j]->horas.'</td>
                                                     <td>'.$asigtec[$i][$j]->cur.'</td>
                                                 </tr>';

                                              }

                                           }
                                         }
                                         ?>
                                    @endif
                                    <!--end array tecnicos-->
                                  </tbody>
                                </table>
                               </div>
                              </div>
                              <!---end asignaturas a cargo-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--FIN ACORDEON-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>                
              </div>
              <!--FIN MODAL VER-->
            </div>
            <!-- Ventana modal para cambiar -->
              <!---fin ventana cambiar--->
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
      <!--##################datos de la busqueda ##########################3-->
        <tbody id="datos" style="background-color: #dcedc8;">
        </tbody>
      <!--##########################################33-->
    </table>
    </div>
</div>
<!--modal para datos-->
<!-- Button trigger modal -->
<!-- Modal -->
 <!--MODAL VER-->
 
              <!--Find Modal deshabilitar y habilitar-->
<!--end modal para datos-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@endsection