@extends('usuario.principa_usul')
@section('content')
<div class="accordion" id="accordionExample1">
  <div class="card">
    <div class="card-header" id="cabecera1">
        <div class="alert alert-warning" role="alert">
          <h5 class="text-center"> PLAN DE ESTUDIOS </h5>
        </div>
    </div>

    <div id="collapseOneconte" class="collapse show" aria-labelledby="cabecera1" data-parent="#accordionExample1">
      <div class="card-body">
       <!--cuerpo-->
       <div class="card-deck">
            <div class="card">
                <img src="{{asset('dist/img/plan3.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#colapsed1" aria-expanded="true" aria-controls="colapsed1">
                            Collapsible Group Item #1
                          </button>
                        </h2>
                      </div>

                      <div id="colapsed1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collapsed-->
                </p>
                </div>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/plan4.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  <!--collapsed-->
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collapsed-->
                </p>
                </div>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/plan5.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  <!-- collpased-->
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end collpased-->
                </p>
                </div>
            </div>
            <div class="card">
                <img src="{{asset('dist/img/plan6.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                <!--collapsed-->
                <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                          </button>
                        </h2>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                      </div>
                    </div>
                  </div>
                <!--end collapsed-->
                </p>
                </div>
            </div>
            </div>
       <!--end cuerpo-->
      </div>
    </div>
  </div>
</div>
@endsection