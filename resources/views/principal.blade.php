<!DOCTYPE html>
<html lang="es">
<head>
<title>INESUR</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{ asset('layouts_inicio/style/layout.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,700&family=Roboto+Slab:wght@200;500;700&display=swap" rel="stylesheet">
</head>
<style>
  .titulo{
      /* font-family: 'Roboto Slab', serif;*/
       font-family: 'Roboto Condensed', sans-serif;
       font-size:32px;
       font-weight: 700;
       letter-spacing: 0.1em;
       text-align:center; 
  }
  .letras{
      /* font-family: 'Roboto Slab', serif;*/
       font-family: 'Roboto Condensed', sans-serif;
       font-size:20px;
       font-weight: 700;
       letter-spacing: 0.1em;
       text-align:center; 
  }
</style>
<body id="top">
<!-- ################################################################################################ -->

<!-- Top Background Image Wrapper -->
<div class="bgded" style="background-image:url('img/fon.jpg');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <div id="logo" class="fl_left"> 
        <!-- ################################################################################################ -->
        <h1><a href="index.html" class="titulo">INESUR</a></h1>
        <!-- ################################################################################################ -->
      </div>
      <nav id="mainav" class="fl_right"> 
        <!-- ################################################################################################ -->
        <ul class="clear">
          <li class="active letras"><a href="{{ url('/') }}">Home</a></li>
          <!--login-->
          @if (Route::has('login'))
           @auth
             <li><a class="letras" href="{{ url('/dashboard') }}">Regresar</a></li>
            @else
             <li><a class="letras" href="{{url('/reg') }}">Iniciar</a></li>
              @if (Route::has('register'))
               <li><a class="letras" href="{{ route('register') }}">Registrar</a></li>
               @endif
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
        <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Soporte Técnico:</strong> (+57) 3178916679</span> <span><br> (+57) 3196672188</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Correo Institucional:</strong> support@domain.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Lunes  - Domingo:</strong> 08.00am - 6.00pm</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Visitanos:</strong> Dirección <a href="#">INESUR - Potosi</a></span></div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>

<!-- ################################################################################################ -->
<div style="background-color:#022859; color:#FFFFFF;" >
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2022 - Todos los derechos reservados - <a href="#" style="color:#FFFFFF;">Universidad De Nariño</a></p>
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