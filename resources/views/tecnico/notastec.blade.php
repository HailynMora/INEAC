@extends('usuario.principa_usul')
@section('content')
       <!---tabla-->
        <!--notas-->
        <div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
            <h3 class="letra1">Reporte de notas</h3>
            </div>
            <br>
            <div class="container alerta">
              @if(isset($estudiante))
                <div class="row">
                     <div class="col-4">
                       <span><b>Nombre: </b></span> <span>{{$estudiante->nombre}} {{$estudiante->segundonom}} {{$estudiante->primerape}} {{$estudiante->segundoape}}</span>
                     </div>
                     <div class="col-2">
                       <span><b>No. Doc:</b> {{$estudiante->num_doc}}</span>
                     </div>
                     <div class="col-4">
                      <span><b>Programa:</b> {{$estudiante->nombretec}} - {{$estudiante->nombretri}}</span>
                     </div>
                     <div class="col-2">
                       <span><b>Periodo:</b> {{$estudiante->anio}} - {{$estudiante->periodo}}</span>
                     </div>
                </div>
               @endif
            </div>
            <br>
            <div class="container table-responsive">
                <table class="table">
                <thead style="background-color:#0f468e; color:white;" class="alerta">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Sesiones</th>
                     <th scope="col">Definitiva</th>
                    <th scope="col">Desempeño</th>
                    </tr>
                </thead>
                <tbody style="background-color:#e3e3e3;" class="letraf">
                    <?php
                        $cont = 1;
                    ?>
                     @foreach($notas as $a)
                      @if(isset($a->nombreasig))
                        <tr>
                        <th scope="row">{{$cont++}}</th>
                        <td>{{$a->nombreasig}}</td>
                        <td>{{$a->nombre}} {{$a->apellido}}</td>
                        <td>{{$a->ih}} </td>
                        <td>{{$a->definitiva}}</td>
                        <td>{{$a->desem}}</td>
                        </tr>
                         @endif
                        @endforeach
                </tbody>
                </table>
            </div>
        <!--end notas-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      @if(isset($res))
      @if($res == 0)
        <script>
          swal({
          title: "Lo sentimos!",
          text: "No se encontró información para la solicitud!",
          icon: "warning",
          button: "Salir",
        });
        </script>
        @endif
      @endif
@endsection

