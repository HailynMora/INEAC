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
                  <a href="/perfil/registrar/usu">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
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
                <div class="borde" style="width: 12rem;">
                   <a href="/docente/listado_docente"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
                </div>
                <!--end card-->
              </div>
              <div class="col-2"></div>
              <div class="col-4 text-center">
                  <!--card-->
                  <div class="borde" style="width: 12rem;">
                    <a href="/visualizar/estudiante">
                     <img src="{{asset('dist/img/docente/estudiante.png')}}" class="card-img-top" alt="...">
                    </a>
                </div>
                <!--end card-->
              </div>
              <div class="col-1"></div>
            </div>
            <div class="row">
              <div class="col-4 text-center">
                  <!--card-->
                <div class="container" style="width: 12rem;  padding-top:30px;">
                <div class="borde" >
                    <a href="/reporte/matriculas"> <img src="{{asset('dist/img/docente/listado.png')}}" class="card-img-top" alt="..."> </a>
                </div>
              </div>
                <!--end card-->
              </div>
              <div class="col-1"></div>
              <div class="col-2"></div>
              <div class="col-1"></div>
              <div class="col-4">
                  <!--card-->
                <div class="container" style="padding-left:30px; padding-top:30px;">
                <div class="borde" style="width: 12rem;">
                   <a href="/listar/usuarios"> <img src="{{asset('dist/img/docente/usuarios.png')}}" class="card-img-top" alt="..."> </a>
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
                  <a href="/perfil/registrar/usu">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
              </div>
            </div>
        </div>
     </div> 
     <div class="row">
      <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
        <div class="col-12">
            <div class="borde" style="width: 12rem;">
              <a href="/docente/listado_docente"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
            </div>
         </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
         <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div class="borde" style="width: 12rem;">
                   <a href="/visualizar/estudiante">
                     <img src="{{asset('dist/img/docente/estudiante.png')}}" class="card-img-top" alt="...">
                    </a>
           </div> 
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
        <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div class="borde" style="width: 12rem;">
              <a href="/reporte/matriculas"> <img src="{{asset('dist/img/docente/listado.png')}}" class="card-img-top" alt="..."> </a>
            </div>
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
        <div class="container"  style="padding-left:2.5rem; padding-top: 15px; padding-bottom:15px;">
            <div class="borde" style="width: 12rem;">
              <a href="/listar/usuarios"> <img src="{{asset('dist/img/docente/usuarios.png')}}" class="card-img-top" alt="..."> </a>
            </div> 
          </div>
        </div>
     </div>
    </div>
  </div>
  <!--end pantallas pequeñas-->