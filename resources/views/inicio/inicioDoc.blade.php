<?php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Auth;
   
  $idoc = auth()->user()->id;
  $validar= DB::table('docente')->where('id_usuario', '=', $idoc)->select('docente.id as idocente')->count();
  if($validar != 0){
  $valdoc= DB::table('docente')->where('id_usuario', '=', $idoc)->select('docente.id as idocente')->first();
  $asigbachi = DB::table('cursos')->where('cursos.id_docente', '=', $valdoc->idocente)->count();
  $asigtec = DB::table('asignaturas_tecnicos')->where('asignaturas_tecnicos.id_docente', '=', $valdoc->idocente)->count();
  }
?>
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
                <!--end card-->
              </div>
              <div class="col-4"></div>
            </div>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-4 text-center">
                  <!--card-->
                <div class="borde" style="width: 12rem;">
                   <a href="/docente/listado"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
                </div>
                <!--end card-->
              </div>
              <div class="col-2"></div>
              <div class="col-4 text-center">
                  <!--card-->
                <div class="container">
                  <div class="borde" style="width: 12rem;">
                  <a href="/perfil/registrar/usu">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
                  </div>
                </div>
                <!--end card-->
              </div>
              <div class="col-1"></div>
            </div>
            <div class="row">
              <div class="col-4 text-center"  style="padding-top:30px;">
                  <!--card-->
                <div class="borde" style="width: 12rem;">
                    <a href="/asignatura/reporte_c"> <img src="{{asset('dist/img/docente/asignatura.png')}}" class="card-img-top" alt="..."> </a>
                </div>
                <!--end card-->
              </div>
              <div class="col-4">
              <div class="container" style="padding-left:0px; padding-top:30px;">
               @if(isset($asigtec))
                 @if($asigtec !=0)
                 <br><br><br><br>
                  <div class="borde" style="width: 12rem;">
                  <a type="button" data-toggle="modal" data-target="#listaTec" class="nav-link" style="color:white;">
                     <img src="{{asset('dist/img/docente/teces.png')}}" class="card-img-top" alt="...">
                    </a>
                    @include('docente.listadoEstuTecnico')
                  </div>
                  @endif 
                  @endif 
                  </div>
              </div>
              <div class="col-4">
                  <!--card-->
                <div class="container" style="padding-left:30px; padding-top:30px;">
                @if(isset($asigbachi))
                @if($asigbachi != 0)
                  <div class="borde" style="width: 12rem;">
                    <a type="button" data-toggle="modal" data-target="#exampleModalListaB" class="nav-link" style="color:white;">
                     <img src="{{asset('dist/img/docente/estudiante.png')}}" class="card-img-top" alt="...">
                    </a>
                    @include('docente.listadoEstu')
                  </div>
                  @endif 
                  @endif 
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
            <div class="borde" style="width: 12rem;">
                  <a href="/perfil/registrar/usu">  <img src="{{asset('dist/img/docente/perfil.png')}}" class="card-img-top" alt="cargando..."> </a>
              </div>
            </div>
        </div>
     </div> 
     <div class="row">
      <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
        <div class="col-12">
            <div class="borde" style="width: 12rem;">
              <a href="/docente/listado"> <img src="{{asset('dist/img/docentes.png')}}" class="card-img-top" alt="..."></a>
            </div>
         </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
         <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
         @if(isset($asigbachi))
            @if($asigbachi!=0)
                  <div class="borde" style="width: 12rem;">
                    <a type="button" data-toggle="modal" data-target="#exampleModalListaB" class="nav-link" style="color:white;">
                     <img src="{{asset('dist/img/docente/estudiante.png')}}" class="card-img-top" alt="...">
                    </a>
                    @include('docente.listadoEstu')
                  </div>
              @endif 
              @endif  
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
         <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
         @if(isset($asigtec))
           @if($asigtec !=0)
                  <div class="borde" style="width: 12rem;">
                  <a type="button" data-toggle="modal" data-target="#listaTec" class="nav-link" style="color:white;">
                     <img src="{{asset('dist/img/docente/teces.png')}}" class="card-img-top" alt="...">
                    </a>
                    @include('docente.listadoEstuTecnico')
                  </div>
             @endif 
             @endif 
          </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
        <div class="container"  style="padding-left:2.5rem; padding-top: 15px;">
            <div class="borde" style="width: 12rem;">
              <a href="/asignatura/reporte_c"> <img src="{{asset('dist/img/docente/asignatura.png')}}" class="card-img-top" alt="..."> </a>
            </div>
          </div>
        </div>
     </div>
    </div>
  </div>
  <!--end pantallas pequeñas-->