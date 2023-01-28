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
                <img src="{{asset('dist/img/plan3.png')}}" class="card-img-top" alt="...">
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
                                Sesiones
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Artistica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ciencias Naturales
                              </div>
                              <div class="col-3 text-center">
                                10
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Ciencias Sociales
                              </div>
                              <div class="col-3 text-center">
                                8
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Español y Literatura
                              </div>
                              <div class="col-3 text-center">
                                10
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Fisica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Etica y Valores
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Religiosa y Moral
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ingles
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Informática y Sistemas
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Matemáticas
                              </div>
                              <div class="col-3 text-center">
                                8
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
                <img src="{{asset('dist/img/plan4.png')}}" class="card-img-top" alt="...">
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
                                Sesiones
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Artistica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Algebra
                              </div>
                              <div class="col-3 text-center">
                                9
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Ciencias Sociales
                              </div>
                              <div class="col-3 text-center">
                                9
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ciencias Biológicas
                              </div>
                              <div class="col-3 text-center">
                                8
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Fisica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Etica y Valores
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Religiosa y Moral
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Español y Literatura
                              </div>
                              <div class="col-3 text-center">
                                10
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ingles
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Informática y Sistemas
                              </div>
                              <div class="col-3 text-center">
                                2
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
                <img src="{{asset('dist/img/plan5.png')}}" class="card-img-top" alt="...">
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
                                Sesiones
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Artistica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ciencias Políticas
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Comprención Lectora
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Religosa y Moral
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Fisica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Español y Literatura
                              </div>
                              <div class="col-3 text-center">
                                5
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Física
                              </div>
                              <div class="col-3 text-center">
                                7
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Filosofía
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ingles
                              </div>
                              <div class="col-3 text-center">
                                3
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Informática y Sistemas
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                               Química
                              </div>
                              <div class="col-3 text-center">
                                7
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Trigonometría
                              </div>
                              <div class="col-3 text-center">
                                8
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
            <div class="card">
                <img src="{{asset('dist/img/plan6.png')}}" class="card-img-top" alt="...">
                <p class="card-text">
                <!--collapsed-->
                <div class="accordion" id="accordionExample6">
                    <div class="card">
                      <div class="card-header" id="headingOne6">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                          Plan de estudios
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                        <div class="card-body">
                           <!--materias-->
                           <div class="row" style="background-color:#E5E6E7;">
                              <div class="col-6">
                                Asignatura
                              </div>
                              <div class="col-6 text-right">
                                Sesiones
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Artistica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ciencias Políticas
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Comprención Lectora
                              </div>
                              <div class="col-3 text-center">
                                4
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9 ">
                                Cálculo
                              </div>
                              <div class="col-3 text-center">
                                7
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Fisica
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Educación Religosa y Moral
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div> 
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Español y Literatura
                              </div>
                              <div class="col-3 text-center">
                                5
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Física
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Filosofía
                              </div>
                              <div class="col-3 text-center">
                                6
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Ingles
                              </div>
                              <div class="col-3 text-center">
                                3
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                                Informática y Sistemas
                              </div>
                              <div class="col-3 text-center">
                                2
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-9">
                               Química
                              </div>
                              <div class="col-3 text-center">
                                7
                              </div>
                          </div>
                          <!-- end materias-->
                        </div>
                      </div>
                    </div>
                  </div>
                <!--end collapsed-->
                </p>
            </div>
            </div>
       <!--end cuerpo-->
      </div>
    </div>
  </div>
</div>
@endsection