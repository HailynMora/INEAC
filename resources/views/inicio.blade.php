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
    </style>

<div class="overlay">
    <div id="pageintro" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <article>
        <h3 class="heading">INESUR SEDE POTOSI</h3>
        <p>A massa etiam augue nunc lectus duis eget libero non nisi lobortis suscipit praesent viverra nam dapibus orci non erat aliquam erat volutpat.</p>
        <footer><a class="btn" href="#">Gravida sem neque</a></footer>
      </article>
      <!-- ################################################################################################ -->
    </div>
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <ul class="nospace group btmspace-80">
        <li class="one_third first">
          <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Mollis suscipit</h6>
              <div>
                <p>Eu adipiscing sit amet ante donec vulputate magna duis posuere tellus vel fringilla auctor nisi arcu.</p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
            <figcaption>
              <h6 class="heading">Vestibulum maecenas</h6>
              <div>
                <p>Urna at congue lectus nisi ac neque suspendisse vitae sapien eu mi placerat tincidunt sed eget elit in.</p>
              </div>
            </figcaption>
          </figure>
        </li>
        <li class="one_third">
          <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
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
    <hr class="btmspace-80">       
          <h1 style=" text-align: center; font-size: 50px;">NUESTROS PROGRAMAS</h1>
    <br>
    <section class="group">
      <!---######################--->

        @if($b==1)
        <div class="band"> 
        @foreach($prog as $p)
            <div class="item-4">
                  <a href="#" class="card">
                    <div class="thumb"></div>
                    <article>
                     <div style=" font-size: 20px; text-align: center;"><br><b>{{$p->descripcion}}</b><br></div>
                      <p>We’ll be putting things together so that as you scroll down from the top of the page you’ll see an “Alien Lander” making its way to touch down.</p>
                      <span>Kezz Bracey</span>
                    </article>
                  </a>
            </div>
            @endforeach
          </div>
          @endif
          @if($b==0)
          <h3 style=" text-align: center; font-size: 50px;">NO HAY PROGRAMAS OFERTADOS</h3>
          @endif
      <!------##################---->
    </div>
    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
  <figure class="hoc container clear imgroup"> 
    <!-- ################################################################################################ -->
    <figcaption class="sectiontitle">
      <p class="nospace font-xs">Pulvinar sem eu tincidunt magna</p>
      <p class="heading underline font-x2">Nulla eu turpis curabitur</p>
    </figcaption>
    <ul class="nospace group">
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
      <li class="one_third"><a class="imgover" href="#"><img src="images/demo/348x261.png" alt=""></a></li>
    </ul>
    <!-- ################################################################################################ -->
  </figure>
  <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <div class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <p class="nospace font-xs">Vel lorem quis arcu euismod faucibus</p>
      <p class="heading underline font-x2">Quisque luctus nullam eget</p>
    </div>
    <ul class="nospace group team">
      <li class="one_quarter first">
        <figure><a class="imgover" href="#"><img src="images/demo/300x300.png" alt=""></a>
          <figcaption><strong>A. Doe</strong> <em>Job Title Here</em></figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure><a class="imgover" href="#"><img src="images/demo/300x300.png" alt=""></a>
          <figcaption><strong>B. Doe</strong> <em>Job Title Here</em></figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure><a class="imgover" href="#"><img src="images/demo/300x300.png" alt=""></a>
          <figcaption><strong>C. Doe</strong> <em>Job Title Here</em></figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure><a class="imgover" href="#"><img src="images/demo/300x300.png" alt=""></a>
          <figcaption><strong>D. Doe</strong> <em>Job Title Here</em></figcaption>
        </figure>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <figure class="hoc container clear clients"> 
    <!-- ################################################################################################ -->
    <figcaption class="sectiontitle">
      <p class="nospace font-xs">Nisl donec eu neque nisi molestie</p>
      <p class="heading underline font-x2">Pellentesque donec ut dolor</p>
    </figcaption>
    <ul class="nospace group">
      <li class="one_quarter first"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter first"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
      <li class="one_quarter"><a class="imgover" href="#"><img src="images/demo/249x100.png" alt=""></a></li>
    </ul>
    <!-- ################################################################################################ -->
  </figure>
</div>
@endsection