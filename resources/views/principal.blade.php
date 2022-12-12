<!DOCTYPE html>
<html lang="es">
<head>
<title>INESUR</title>
<link rel="icon" href="{{asset('dist/img/faviconUniversity.svg')}}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{ asset('layouts_inicio/style/layout.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,700&family=Roboto+Slab:wght@200;500;700&display=swap" rel="stylesheet">
</head>
<style>
  .titulo{
      /* font-family: 'Roboto Condensed', sans-serif;*/
       font-size:32px;
       font-weight: 700;
       text-align:center; 
  }
  .letras{
       font-size:20px;
       font-weight: 700;
       text-align:center; 
  }
  .letras_log{
       font-size:20px;
       font-weight: 700;
      
  }

  .letra_peq{
       font-size:16px;
       font-weight: 700;
      
  }
  .letra_peq1{
       font-size:16px;
       font-weight: 700;
       text-align:center; 
      
  }
  .letra_but{
       font-size:12px;
       font-weight: 700;
       color: #FFFFFF;

  }
</style>
<body id="top">
<!-- ################################################################################################ -->

<!-- Top Background Image Wrapper -->
<div class="bgded" style="background-image:url('dist/fondo/iglesia.png');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <div id="logo" class="fl_left" style="margin-top:10px; margin-bottom:3px;"> 
        <!-- ################################################################################################ -->
        <div class="block clear"><img src="{{asset('dist/fondo/logoinesur1.png')}}" alt="cargando imagen ,,,"></div>
        <!-- ################################################################################################ -->
      </div>  
      <nav id="mainav" class="fl_right"> 
        <!-- ################################################################################################ -->
        <ul class="clear">
          <li class="active letras"><a href="{{ url('/') }}">Inicio</a></li>
          <li class="letras"><a href="https://forms.gle/h6nUM7j3kyyZsVbW7" target="_blank">Solicitud</a></li>
          <!--login-->
          @if (Route::has('login'))
           @auth
             <li><a class="letras" href="{{ url('/dashboard') }}">Regresar</a></li>
            @else
             <li><a class="letras" href="{{url('/reg') }}">Ingresar</a></li>
           @endauth
          @endif
        </ul>
        <!-- ################################################################################################ -->
      </nav>
    </header>
  </div>
  <!-- ################################################################################################ -->
 <!--colocar contenido-->
   @yield('content')
 <!--Finalizar contendio-->
 <footer>
 <div class="wrapper coloured">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
      <li class="one_quarter first">
        <div class="block clear letra_peq"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Soporte Técnico:</strong><br> (+57) 3178916679</span> <span><br> (+57) 3196672188</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear letra_peq"><a href="mailto:inesurpot@gmail.com"><i class="fas fa-envelope"></i></a> <span><strong>Correo Institucional:</strong><br>inesurpot@gmail.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear letra_peq"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Sabado  - Domingo:</strong><br> 08:00 am - 5:00 pm</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear letra_peq"><a href="https://goo.gl/maps/g1E1FGYmj2CjkBqMA"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Visitanos:</strong><br><a href="https://goo.gl/maps/g1E1FGYmj2CjkBqMA">INESUR - Potosi</a></span></div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>

<!-- ################################################################################################ -->
<div style="background-color:#022859; color:#FFFFFF;" >
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="letra_peq1">Copyright &copy; 2022 - Todos los derechos reservados - <a href="#" style="color:#FFFFFF;">Universidad De Nariño</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
</footer>
<!-- JAVASCRIPTS -->
<script  src="{{ asset('layouts_inicio/js/jquery.min.js') }}"></script>
<script  src="{{ asset('layouts_inicio/js/jquery.backtotop.js') }}"></script>
<script  src="{{ asset('layouts_inicio/js/jquery.mobilemenu.js') }}"></script>
</body>
</html>