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
        background: #48D1EE;
        text-decoration: none;
        color: #444;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        min-height: 100%;
        
        position: relative;
        top: 0;
        transition: all .1s ease-in;
      }

      .card:hover {
        top: -2px;
        box-shadow: 0 4px 5px rgba(0,0,0,0.2);
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
        text-transform: uppercase;
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
    
    img:hover {
        -webkit-transform: rotate(-7deg);
        -moz-transform: rotate(-7deg);
        -o-transform: rotate(-7deg);
    }
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
      <ul class="nospace group btmspace-80">
        <li class="one_third first">
          <figure><a class="imgover" href="#"><img src="images/demo/est1.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Mollis suscipit</h6>
              <div>
                <p>Eu adipiscing sit amet ante donec vulputate magna duis posuere tellus vel fringilla auctor nisi arcu.</p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/est2.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Vestibulum maecenas</h6>
              <div>
                <p>Urna at congue lectus nisi ac neque suspendisse vitae sapien eu mi placerat tincidunt sed eget elit in.</p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/est3.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Pellentesque enim</h6>
              <div>
                <p>Imperdiet pede sit amet elit aenean sollicitudin eros quis cursus feugiat lacus diam tempor tortor vel.</p>
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
              <figure><img class="imagen" src="images/demo/ciclo_3.png" alt="" style="border-radius:50%;">
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
            <figure><img class="imagen" src="images/demo/ciclo_iv.png" alt="" style="border-radius:50%;">
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
              <figure><img class="imagen" src="images/demo/ciclov.png" alt="" style="border-radius:50%;">
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
                 <figure><img class="imagen" src="images/demo/ciclovi.png" alt="" style="border-radius:50%;">
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
                    <figure><img class="imagen" src="images/demo/tecSis.png" alt="" style="width:50%; height:50%; border-radius:50%;">
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

    <!--END TECNICOS-->
    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
  </main>
  </div>
@endsection