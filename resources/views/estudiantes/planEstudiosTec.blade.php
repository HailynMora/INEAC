@extends('usuario.principa_usul')
@section('content')
<div class="accordion">
  <div class="card">
    <div class="card-header">
        <div class="alert" role="alert" style="background-color:#ffc107;color: #ffffff;">
          <h5 class="text-center letra1"> Plan de estudios </h5>
        </div>
    </div>

    <div  class="collapse show letraf" aria-labelledby="cabecera1">
      <div class="card-body">
       <!--cuerpo-->
       <div class="card-deck">
            <div class="card">
                <img src="{{asset('dist/img/TI.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample1">
                    <div class="card">
                      <div class="card-header" id="headingOne1">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#colapsed1" aria-expanded="true" aria-controls="colapsed1">
                            Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="colapsed1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                        <div class="card-body">
                         <!--plan de estudios-->
                         <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Introducción a la Información
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Procesador de Texto Presentadores
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Microsoft Excel Hoja de Calculo I
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                         <!--end -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collapsed-->
                </p>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/TIII.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample3">
                    <div class="card">
                      <div class="card-header" id="headingOne3">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                          Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne3" class="collapse show" aria-labelledby="headingOne3" data-parent="#accordionExample3">
                       <!--plan estudios-->
                       <div class="card-body">
                       <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Graficadores Corel DRAW
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Base de Datos
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Microsoft Excel Hoja de Calculo II
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div>                           
                       <!--end materias-->
                      </div>
                    </div>
                  </div>
                  </div>
                  <!--end collapsed-->
                </p>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/TII.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!-- collpased-->
                  <div class="accordion" id="accordionExample5">
                    <div class="card">
                      <div class="card-header" id="headingOne5">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne5">
                          Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne5" class="collapse show" aria-labelledby="headingOne5" data-parent="#accordionExample5">
                        <div class="card-body">
                         <!--materias-->
                         <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Emprendimiento Empresarial
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Edición de Imagen PHOTOSHOP
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Fundamentos de Electricidad y Electronica
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <!-- end materias-->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collpased-->
                </p>
            </div>
        </div>
        <br><br>
        <div class="card-deck">
            <div class="card">
                <img src="{{asset('dist/img/TIV.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample10">
                    <div class="card">
                      <div class="card-header" id="headingOne10">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#colapsed10" aria-expanded="true" aria-controls="colapsed10">
                            Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="colapsed10" class="collapse show" aria-labelledby="headingOne10" data-parent="#accordionExample10">
                        <div class="card-body">
                         <!--plan de estudios-->
                         <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura hola
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Redes e Internet
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Mantenimiento de Computadoras I
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div> 
                         <!--end -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collapsed-->
                </p>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/TV.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample11">
                    <div class="card">
                      <div class="card-header" id="headingOne11">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne11" aria-expanded="true" aria-controls="collapseOne11">
                          Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne11" class="collapse show" aria-labelledby="headingOne11" data-parent="#accordionExample11">
                       <!--plan estudios-->
                       <div class="card-body">
                       <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Inglés Técnico
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Proyectos Trabajo de Grado
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div>                           
                       <!--end materias-->
                      </div>
                    </div>
                  </div>
                  </div>
                  <!--end collapsed-->
                </p>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/TVI.jpg')}}" class="card-img-top" alt="...">
                <p class="card-text">
                  <!-- collpased-->
                  <div class="accordion" id="accordionExample12">
                    <div class="card">
                      <div class="card-header" id="headingOne12">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne12" aria-expanded="true" aria-controls="collapseOne12">
                          Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne12" class="collapse show" aria-labelledby="headingOne12" data-parent="#accordionExample12">
                        <div class="card-body">
                         <!--materias-->
                         <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Creditos
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Animaciones
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Edición de Sonido y Video
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Diseño de Paginas Web Animaciones Flash
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div> 
                          <!-- end materias-->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collpased-->
                </p>
            </div>
        </div>
       <!--end cuerpo-->
      </div>
    </div>
  </div>
</div>
@endsection