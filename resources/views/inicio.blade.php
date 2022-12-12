<?php
use App\Models\Archivo;
use Illuminate\Support\Facades\DB;

    $pub =  DB::table('publicidad')->count();
    if($pub!=0){
      $publibach =  DB::table('publicidad')->where('tipo', '=', 1)->get();
      $publitec =  DB::table('publicidad')->where('tipo', '=', 2)->get();
      $val = DB::table('publicidad')->where('estado', '=', 1)->count();
    } 

?>
@extends('principal') 
@section('content')  

    <style>
      .band {
        width: 90%;
        max-width: 1240px;
        margin: 0 auto;
        
        display: grid;
        
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        grid-gap: 20px;
      }

      @media only screen and (min-width: 500px) {
        .band {
          grid-template-columns: 1fr 1fr;
        }  
      }

      @media only screen and (min-width: 850px) {
        .band {
          grid-template-columns: 1fr 1fr 1fr 1fr;
        }
      }


      .card {
        background: #0f468e;
        text-decoration: none;
        color: #444;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        min-height: 100%;
        
        position: relative;
        top: 0;
        transition: all .1s ease-in;
        border-radius:20px;
      }

      .card article {
        padding: 20px;
      }

      /* typography */
      .card h1 {
        font-size: 20px;
        margin: 0;
        color: #333;
      }

      .card p { 
        line-height: 1.4;
      }

      .card span {
        font-size: 12px;
        font-weight: bold;
        color: #999;
        /*text-transform: uppercase;*/
        letter-spacing: .05em;
        margin: 2em 0 0 0;
      }

    .imagen {
        margin: 20px;
        border: 5px solid #eee;
        -webkit-box-shadow: 4px 4px 4px rgba(0,0,0,0.2);
        -moz-box-shadow: 4px 4px 4px rgba(0,0,0,0.2);
        box-shadow: 4px 4px 4px rgba(0,0,0,0.2);
        -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
    }
    
    .img_rotate:hover {
        -webkit-transform: rotate(-7deg);
        -moz-transform: rotate(-7deg);
        -o-transform: rotate(-7deg);
    }

    /* css */
          /* Design */
          *,
          *::before,
          *::after {
            box-sizing: border-box;
          }

          .main{
            max-width: 1200px;
            margin: 0 auto;
          }

          .imgcard {
            height: auto;
            max-width: 100%;
            vertical-align: middle;
          }

          .cards {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
          }

          .cards_item {
            display: flex;
            padding: 1rem;
          }

          @media (min-width: 40rem) {
            .cards_item {
              width: 50%;
            }
          }

          @media (min-width: 56rem) {
            .cards_item {
              width: 50%;
            }
          }

          .card_dos {
            background-color: white;
            border-radius: 0.25rem;
            box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
          }

          .card_content {
            padding: 1rem;
            background-color: #0f468e;
            color:white;
          }
          .made_by{
            font-weight: 400;
            font-size: 13px;
            margin-top: 35px;
            text-align: center;
          }

          .btn-bot{
            display: inline-block;
            padding: 5px 8px 2px 8px;
            border: 1px solid;
            border-radius: 50px;
          }
    /* css end*/
    /*css modal*/
          .modal {
        display: none; /* Por defecto, estará oculto */
        position: fixed; /* Posición fija */
        z-index: 1; /* Se situará por encima de otros elementos de la página*/
        padding-top: 100px; /* El contenido estará situado a 200px de la parte superior */
        left: 0;
        top: 0;
        width: 100%; /* Ancho completo */
        height: 100%; /* Algura completa */
        overflow: auto; /* Se activará el scroll si es necesario */
        background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
      }

      /* Ventana o caja modal */
      .contenido-modal {
        position: relative; /* Relativo con respecto al contenedor -modal- */
        background-color: white;
        margin: auto; /* Centrada */
        padding: 20px;
        width: 60%;
        -webkit-animation-name: animarsuperior;
        -webkit-animation-duration: 0.5s;
        animation-name: animarsuperior;
        animation-duration: 0.5s
      }

      /* Animación */
      @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
      }

      @keyframes animarsuperior {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
      }

      /* Botón cerrar */
      .close {
        color: black;
        float: right;
        font-size: 30px;
        font-weight: bold;
      }

      .close:hover,
      .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
      }

      .newspaper {
        column-count: 3;
      }
    /*end css modal*/
    </style>
<!--style="background-image:url('img/fondo_mod.png'); background-repeat: no-repeat;  background-size: cover; margin: 10px 10px 10px 10px; " -->
<div class="overlay">
    <div id="pageintro" class="hoc clear" > 
      <!-- ################################################################################################ -->
     <!-- <article>
        <h3 class="heading">INESUR SEDE POTOSI</h3>
        <p>A massa etiam augue nunc lectus duis eget libero non nisi lobortis suscipit praesent viverra nam dapibus orci non erat aliquam erat volutpat.</p>
        <footer><a class="btn" href="#">Gravida sem neque</a></footer>
      </article>-->
      <br><br><br><br><br><br><br>
      <!-- ################################################################################################ -->
    </div>
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <ul class="nospace group btmspace-80" style="padding-top:3rem;">
        <li class="one_third first">
          <figure><a  href="#"><img src="{{asset('dist/fondo/estu.png')}}" alt="cargando imagen ..." style=" border: 2px; border-radius: 25px; background-color:white;"></a>
            <figcaption style="border: 2px;  padding: 10px; border-radius: 25px;">
              <h6 class="heading">Estudiantes</h6>
              <div>
                <p>
                </p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a  href="#"><img src="{{asset('dist/fondo/doc.png')}}" alt="cargando imagen ..." style=" border: 2px; border-radius: 25px; background-color:white;"></a>
            <figcaption style="border: 2px;  padding: 10px; border-radius: 25px;">
              <h6 class="heading">Docentes</h6>
              <div>
                <p></p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a  href="#"><img src="{{asset('dist/fondo/sec.png')}}" alt="cargando imagen ..." style=" border: 2px; border-radius: 25px; background-color:white;"></a>
            <figcaption style="border: 2px;  padding: 10px; border-radius: 25px;">
              <h6 class="heading">Secretaria</h6>
              <div>
                <p></p>
              </div>
            </figcaption>
          </figure>
        </li>
      </ul>
    </section>
    <!-- ################################################################################################ -->
     <div style="background-color:#144659; color:#FFFFFF; margin-left:-7.5em; margin-right:-7.5em; padding-top:1.2em; padding-bottom:0.3em;"> 
          <h1 class="titulo" style=" text-align: center; font-size: 40px; ">NUESTROS PROGRAMAS</h1> 
    </div>
    <br><br>
    <section class="group">
      <!---######################--->
      <h1 class="titulo" style=" text-align: center; font-size: 30px; ">BACHILLERATO POR CICLOS</h1> 
        <div class="band"> 
            <div class="item-4">
           
              <figure>
              <a class="titulo" id="abrirModalciclo1">
                <img class="imagen img_rotate" src="images/demo/ciclo_3.png" alt="" style="border-radius:50%;">
              </a>
              <figcaption>
               
                  <div style="padding-left:25px;">
                  <p class="titulo" style="font-size:18px; text-align:justify;">
                    Ciclo correspondiente a los grados 6° y 7°.
                  </p>
                </div>
                </figcaption>
            </figure>
            </div>
            <!----tabla2-->
            <div class="item-4">
            <figure>
            <a class="titulo" id="abrirModalciclo2">
              <img class="imagen img_rotate" src="images/demo/ciclo_iv.png" alt="" style="border-radius:50%;">
             </a> 
              <figcaption>
                <div style="padding-left:30px;">
                 <p class="titulo" style="font-size:18px; text-align:justify;">
                    Ciclo correspondiente a los grados 8° y 9°.
                  </p>
                  </div>
                </figcaption>
            </figure>
            </div>
             <!--end--tabla2-->

            <!--tabla 3-->
            <div class="item-4">
              <figure>
              <a class="titulo" id="abrirModalciclo3">
                <img class="imagen img_rotate" src="images/demo/ciclov.png" alt="" style="border-radius:50%;">
               </a>
                <figcaption>
                    <div style="padding-left:30px;">
                    <p class="titulo" style="font-size:18px; text-align:justify;">
                      Ciclo correspondiente al grado 10°.
                    </p>
                  </div>
                  </figcaption>
              </figure>
            </div>

            <!--end tabla 3-->
                 <!--tabla 3-->
                 <div class="item-4">
                 <figure>
                 <a class="titulo" id="abrirModalciclo4">
                  <img class="imagen img_rotate" src="images/demo/ciclovi.png" alt="" style="border-radius:50%;">
                 </a>
                  <figcaption>
                      <div style="padding-left:28px;">
                      <p class="titulo" style="font-size:18px; text-align:justify;">
                        Ciclo correspondiente al grado 11°.
                      </p>
                    </div>
                    </figcaption>
                </figure>
                </div>

                
            <!--end tabla 3-->            
          </div>
      <!------##################---->
    </div>
    <!--TECNICOS-->
    <div class="wrapper row3">
    <h1 class="titulo" style=" text-align: center; font-size: 30px; ">TÉCNICOS</h1>  
                 <!--tabla 3-->

                 <div style="margin:5px 5px 5px 5px;">
                     <div style="padding:0em 22em 0em 37em;">
                    <figure>
                     <a class="titulo" id="abrirModaltec">
                      <img class="imagen img_rotate" src="images/demo/tecSis.png" alt="" style="width:50%; height:50%; border-radius:50%;">
                     </a>            
                    <figcaption>
                          <div style="padding-left:28px;">
                          <p class="titulo" style="font-size:18px; text-align:justify;">
                            
                          </p>
                        </div>
                        </figcaption>
                    </figure>
                   </div>
                 </div>

            <!--end tabla 3-->            
      <!------##################---->
    </div>
    </div>
    <br><br>
    <!---publicidad-->
    <!--end publicidad-->
    @if(isset($val))
     @if($val != 0)
    <div class="main">
    <h1 class="titulo" style=" text-align: center; font-size: 30px; color:black; ">INFORMACIÓN DE MATRÍCULAS ACADÉMICAS</h1> 
      <ul class="cards">
        <li class="cards_item">
          <div class="card">
            <div class="card_image"><img class="imgcard" src="{{asset('dist/perfil/'.$publibach[0]->archivo)}}" style="border-radius:20px;"></div>
            <div class="card_content"  style=" border-radius:20px;">
              <p class="titulo" style="font-size: 24px; text-align:justify; ">{{$publibach[0]->descrip}}</p>
              <a class="btn-bot" href="https://www.facebook.com/profile.php?id=100063476350095&ref=page_internal" target="_blank" style="background-color: black;"><i class="fab fa-facebook-f" style="font-size:24px; color:#FFF;"></i></a>
            </div>
          </div>
        </li>
        <li class="cards_item">
          <div class="card">
            <div class="card_image"><img class="imgcard" src="{{asset('dist/perfil/'.$publitec[0]->archivo)}}"  style=" border-radius:20px;"></div>
            <div class="card_content" style=" border-radius:20px;">
              <p class="titulo" style="font-size: 24px; text-align:justify;">{{$publitec[0]->descrip}}</p>
              <a class="btn-bot" href="https://www.facebook.com/profile.php?id=100063476350095&ref=page_internal" target="_blank" style="background-color: black;"><i class="fab fa-facebook-f" style="font-size:24px; color:#FFF;"></i></a>
            </div>
          </div>
        </li>   
      </ul>
      <button class="titulo" id="abrire" style="text-align: center; font-size: 24px; color:white; background-color:#144659; border-radius:10px; margin:0 auto;">Requisitos</button>
      <br>
      <div class="wrapper row3">
        <p class="titulo" style=" text-align: justify; font-size: 24px; ">
        Si estas interesado en alguno de nuestros programas, debes dirigirte al apartado de <a href="#" style="color:#022859;">solicitud</a>, ubicado en la parte superior derecha.
        </p>  
      </div>
    </div><br>
    <!--modal-->
   
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="ventanare" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">Requisitos de matrícula para bachillerato por ciclos o programas técnicos </p>
            <ul style="font-size: 18px; color:black;">
            <li>Fotocopia del documento de identidad.</li>
            <li>Fotocopia del carnet de salud.</li>
            <li>Certificado de estudio del último grado que aprobó.</li>
            <li>Certificado médico.</li>
            <li>Fotocopia del recibo de luz.</li>
            <li>Fotografias tipo carnet.</li>
          </ul> 
          <button class="cerrare" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
      @endif
    @endif
    <!--end modal-->
    <!--END TECNICOS-->
    </section>
    <!--ventanas de modal programas tecnicos--> 
    <div id="ventanaModaltec" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">PLAN DE ESTUDIOS DEL PROGRAMA TÉCNICO EN SISTEMAS</p>
            <div class="newspaper">
            <ul style="font-size: 18px; color:black;">
            <li>Introducción a la información</li>
            <li>Procesadores de texto</li>
            <li>Microsoft Excel hoja de cálculo I</li>
            <li>Graficadores corel DRAW</li>
            <li>Bases de datos</li>
            <li>Microsoft Excel hoja de cálculo II</li>
            <li>Emprendimiento empresarial</li>
            <li>Edición de imagen PHOTOSHOP</li>
            <li>Fundamentos de electricidad y electrónica</li>cd /cd 
            <li>Redes e internet</li>
            <li>Mantenimiento de computadoras I</li>
            <li>Inglés técnico</li>
            <li>Proyectos trabajo de grado</li>
            <li>Animaciones</li>
            <li>Edición de sonido y video</li>
            <li>Diseño de páginas Web y animaciones Flash</li>
          </ul> 
           </div>
          <button class="cerrartec" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
    <!--end ventanas de modal-->
    <!--modal bachillerato ciclo 1-->
    <div id="ventanaModalciclo1" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">PLAN DE ESTUDIOS DEL CICLO III</p>
            <ul style="font-size: 18px; color:black;">
            <li>Artística</li>
            <li>Ciencias Naturales</li>
            <li>Ciencias Sociales</li>
            <li>Español y Literatura</li>
            <li>Educación Física</li>
            <li>Ética y Valores</li>
            <li>Educación Religiosa y Moral</li>
            <li>Ingles</li>
            <li>Informática y Sistemas</li>
            <li>Matemáticas</li>
          </ul> 
          <button class="cerrar1" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
    <!--end modal ciclo 1-->
     <!--modal bachillerato ciclo 1-->
     <div id="ventanaModalciclo2" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">PLAN DE ESTUDIOS DEL CICLO IV</p>
            <ul style="font-size: 18px; color:black;">
            <li>Artística</li>
            <li>Algebra</li>
            <li>Ciencias Sociales</li>
            <li>Ciencias Biológicas</li>
            <li>Educación Física</li>
            <li>Ética y Valores</li>
            <li>Educación Religiosa y Moral</li>
            <li>Español y Literatura</li>
            <li>Ingles</li>
            <li>Informática y Sistemas</li>
          </ul> 
          <button class="cerrar2" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
    <!--end modal ciclo 1-->
     <!--modal bachillerato ciclo 1-->
     <div id="ventanaModalciclo3" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">PLAN DE ESTUDIOS DEL CICLO V</p>
            <ul style="font-size: 18px; color:black;">
            <li>Artística</li>
            <li>Ciencias Políticas</li>
            <li>Comprensión Lectora</li>
            <li>Educación Religiosa y Moral</li>
            <li>Educación Física</li>
            <li>Español y Literatura</li>
            <li>Física</li>
            <li>Filosofía</li>
            <li>Ingles</li>
            <li>Informática y Sistemas</li>
            <li>Química</li>
            <li>Trigonometría</li>
          </ul> 
          <button class="cerrar3" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
    <!--end modal ciclo 1-->
     <!--modal bachillerato ciclo 1-->
     <div id="ventanaModalciclo4" class="modal">
        <div class="contenido-modal" style="background-color:#F2F2F2;">
            <p style="font-size: 24px; color:black;">PLAN DE ESTUDIOS DEL CICLO VI</p>
            <ul style="font-size: 18px; color:black;">
            <li>Artística</li>
            <li>Ciencias Políticas</li>
            <li>Comprensión Lectora</li>
            <li>Cálculo</li>
            <li>Educación Física</li>
            <li>Educación Religiosa y Moral</li>
            <li>Español y Literatura</li>
            <li>Física</li>
            <li>Filosofía</li>
            <li>Ingles</li>
            <li>Informática y Sistemas</li>
            <li>Química</li>
          </ul> 
          <button class="cerrar4" style="background-color:#FFC107; float:right;"><i class="fas fa-sign-out-alt" style="font-size:20px; color:black;"></i></button>
          <br>
        </div><br>
      </div>
    <!--end modal ciclo 1-->
  </main>
  </div>
  <!-- GetButton.io widget -->
 <!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "3182884902", // WhatsApp number
            call_to_action: "INESUR Potosí", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
            pre_filled_message: "Te damos la bienvenida", // WhatsApp pre-filled message
        };
        var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<script>
  // Ventana modal
if(document.getElementById("abrire")){
var modal = document.getElementById("ventanare");
var boton = document.getElementById("abrire");
var span = document.getElementsByClassName("cerrare")[0];
boton.addEventListener("click",function() {
  modal.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
span.addEventListener("click",function() {
  modal.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});
}
//tecnicos
if(document.getElementById("abrirModaltec")){
  var modalt = document.getElementById("ventanaModaltec");
  var botont = document.getElementById("abrirModaltec");
  var spant = document.getElementsByClassName("cerrartec")[0];
  botont.addEventListener("click",function() {
  modalt.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
spant.addEventListener("click",function() {
  modalt.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modalt) {
    modalt.style.display = "none";
  }
});
}
//bachillerato ciclo 3
if(document.getElementById("abrirModalciclo1")){
  var modalc1 = document.getElementById("ventanaModalciclo1");
  var botonc1 = document.getElementById("abrirModalciclo1");
  var spanc1 = document.getElementsByClassName("cerrar1")[0];
  botonc1.addEventListener("click",function() {
  modalc1.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
spanc1.addEventListener("click",function() {
  modalc1.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modalc1) {
    modalc1.style.display = "none";
  }
});
}
//###################################################
//bachillerato ciclo 4
if(document.getElementById("abrirModalciclo2")){
  var modalc2 = document.getElementById("ventanaModalciclo2");
  var botonc2 = document.getElementById("abrirModalciclo2");
  var spanc2 = document.getElementsByClassName("cerrar2")[0];
  botonc2.addEventListener("click",function() {
  modalc2.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
spanc2.addEventListener("click",function() {
  modalc2.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modalc2) {
    modalc2.style.display = "none";
  }
});
}
//###################################################333
//bachillerato ciclo 5
if(document.getElementById("abrirModalciclo3")){
  var modalc3 = document.getElementById("ventanaModalciclo3");
  var botonc3 = document.getElementById("abrirModalciclo3");
  var spanc3 = document.getElementsByClassName("cerrar3")[0];
  botonc3.addEventListener("click",function() {
  modalc3.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
spanc3.addEventListener("click",function() {
  modalc3.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modalc3) {
    modalc3.style.display = "none";
  }
});
}
//#######################################################
//bachillerato ciclo 6
if(document.getElementById("abrirModalciclo4")){
  var modalc4 = document.getElementById("ventanaModalciclo4");
  var botonc4 = document.getElementById("abrirModalciclo4");
  var spanc4 = document.getElementsByClassName("cerrar4")[0];
  botonc4.addEventListener("click",function() {
  modalc4.style.display = "block";
});

// Si el usuario hace click en la x, la ventana se cierra
spanc4.addEventListener("click",function() {
  modalc4.style.display = "none";
});

// Si el usuario hace click fuera de la ventana, se cierra.
window.addEventListener("click",function(event) {
  if (event.target == modalc4) {
    modalc4.style.display = "none";
  }
});
}
// Cuando el usuario hace click en el botón, se abre la ventana
</script>
<!--modal tecnicos-->
<!--ciclo 1-->
<!-- /GetButton.io widget -->
<!-- /GetButton.io widget -->
@endsection