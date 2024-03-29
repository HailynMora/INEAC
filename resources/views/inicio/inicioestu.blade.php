
<!--pantallas grandes-->
<div class="d-none d-sm-none d-md-block">
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="background-image:url({{asset('images/demo/img_fondo.png')}}); background-position:center; background-repeat: no-repeat;  background-size: cover;">
        <div class="card-body">
          <!--table-->
          <div class="container-fluid" style="padding-left:80px;">
            <div class="row">
              <div class="col-4"></div>
              <div class="col-4">
                <!--card-->
                <div class="container">
                  <div class="borde" style="width: 12rem;">
                  <a href="/plan/estudios">  <img src="{{asset('dist/img/programas.png')}}" class="card-img-top" alt="cargando..."> </a>
                  </div>
                </div>

                <!--end card-->
              </div>
              <div class="col-4"></div>
            </div>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-4 text-center">
                  <!--card-->
                <div  class="borde" style="width: 12rem;">
                   <a href="listado/docente"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
                </div>
                <!--end card-->
              </div>
              <div class="col-2"></div>
              <div class="col-4 text-center">
                  <!--card-->
                  <div  class="borde" style="width: 12rem;">
                   <a type="button" data-toggle="modal" data-target="#exampleModalnotas">
                     <img src="{{asset('dist/img/calificaciones.png')}}" class="card-img-top" alt="...">
                    </a>
                  @include('estudiantes.calificaciones')
                </div>
                <!--end card-->
              </div>
              <div class="col-1"></div>
            </div>
            <div class="row">
              <div class="col-4 text-center" style="padding-top:30px;">
                  <!--card-->
                <div  class="borde" style="width: 12rem;">
                    <a href="{{route('nivelacionEstudiantes')}}"> <img src="{{asset('dist/img/docente/nivelacion.png')}}" class="card-img-top" alt="..."> </a>
                </div>
                <!--end card-->
              </div>
              <div class="col-1"></div>
              <div class="col-2"></div>
              <div class="col-1"></div>
              <div class="col-4">
                  <!--card-->
                <div class="container" style="padding-left:30px; padding-top:30px;">
                <div  class="borde"  style="width: 12rem;">
                 <a href="{{route('perfilEstu')}}">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
                </div>
              </div>
                <!--end card-->
              </div>
            </div>
            <!--end tables-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!--pantallas grandes-->
  <!--pantallas pequeñas-->
  <div class="d-block d-sm-block d-md-none">
    <div class="container" style="background-image:url({{asset('images/demo/img_fondo.png')}}); background-position:center; background-repeat: no-repeat;  background-size: cover;" >
     <div class="row">
        <div class="col-12">
           <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div  class="borde" style="width: 12rem;">
                  <a href="/plan/estudios">  <img src="{{asset('dist/img/programas.png')}}" class="card-img-top" alt="cargando..."> </a>
              </div>
            </div>
        </div>
     </div> 
     <div class="row">
      <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
        <div class="col-12">
            <div  class="borde" style="width: 12rem;">
              <a href="listado/docente"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
            </div>
         </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
         <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div  class="borde"  style="width: 12rem;">
                   <a type="button" data-toggle="modal" data-target="#exampleModalnotas">
                     <img src="{{asset('dist/img/calificaciones.png')}}" class="card-img-top" alt="...">
                    </a>
                  @include('estudiantes.calificaciones')
           </div> 
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
        <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div  class="borde" style="width: 12rem;">
            <a href="{{route('nivelacionEstudiantes')}}"> <img src="{{asset('dist/img/docente/nivelacion.png')}}" class="card-img-top" alt="..."> </a>
            </div>
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
        <div class="container"  style="padding-left:2.5rem; padding-top: 15px; padding-bottom:15px;">
            <div  class="borde"  style="width: 12rem;">
            <a href="{{route('perfilEstu')}}">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
            </div> 
          </div>
        </div>
     </div>
    </div>
  </div>
  <!--end pantallas pequeñas-->