@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center"  role="alert">
  <h4> Matricula Estudiante </h4>
</div>
<!---->
<br>
<div class="container-fluid">
    <!---Mensaje-->
    @if(Session::has('validacion'))
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('validacion')}}
        </div>
    @endif
    <!-- end mensaje-->
     <!---Mensaje-->
     @if(Session::has('aceptado'))
        <div class="alert alert-primary alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('aceptado')}}
        </div>
    @endif
    <!-- end mensaje-->
 <div class="row">
     <div class="col-md-12" style="background-color:#28afc2;">
        <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-book-reader" style="color:#FFC300;"></i> Datos Estudiante</b></h4>
         <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE"> <br>
        <div class="container-fluid">
         <div class="row">
            <div class="col-md-4">
                <label><h5><b><i class="fas fa-address-card" style="color:#FFC300;"></i>&nbsp Número de Documento</b></h5></label><br>
            <h5> {{$estu->num_doc}} </h5>
            </div>
            <div class="col-md-4">
               <label><h5><b><i class="fas fa-user" style="color:#FFC300;"></i>&nbsp Nombre</b></h5></label><br>
               <h5> {{$estu->nombre}} {{$estu->apellido}} </h5>
            </div>
            <div class="col-md-4">
               <label><h5><b> <i class="fas fa-envelope" style="color:#FFC300;"></i>&nbsp Correo </b></h5></label><br>
               <h5>{{$estu->correo}}</h5>
            </div>
        </div>
       </div>
         <br>
     </div>
</div>
</div>

<br>
<div class="container-fluid">
<div class="row">
     <div class="col-md-12" style="background-color:#28afc2;">
       <h4 class="text-left" style="margin-top: 15px;"><b><i class="fas fa-search" style="color:#FFC300;"></i> Buscar Curso</b></h4>
         <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
         <div class="col-md-12">
           <!--Inicio del buscar-->
                <div class="container-fluid">
                        <div class="row" id="map_section">
                            <div class="col-12">
                            <form action="#" id="search-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12" id="search-wrapper">
                                                <input type="text" class="form-control w-100 m-0 search" placeholder="Ingrese el nombre a buscar ..." aria-label="Search">

                                                    <div id="results">

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br>    
                                          
                                    </div>
                            </div>
                    </div>
           <!--Finalizar el buscar-->
           <form action="{{route('regmatricula')}}" method="post">
                    @csrf
                       <div class="container-fluid">
                           <div id="post" class="mt-4"></div>
                           
                         </div><!--retorna la informacion-->  
                         <label for="fec_vinculacion"><h4><b><i class="fas fa-calendar-alt" style="color:#FFC300;"></i> Fecha Matricula</b></h4></label>
                         <hr style="height:2px;border-width:0;color:gray;background-color:#FEFEFE">
                     <div class="form-group col-md-4">
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                     </div>
                     <input type="text" id="estu" name="estu" value="{{$estu->id}}" hidden>
                      <br>
                      <div class="form-group col-md-12 text-center">
                           <a id="cancelar" type="button" class="btn btn-warning">Cancelar</a>
                           <a id="listado" type="button" class="btn btn-secondary">Visualizar</a>
                            <button type="submit" class="btn btn-success">Matricular</button>
                            
                     </div>
                      
                                              
           </form>
           <!---end informacion-->
       </div>
     </div>
</div>
</div>


<!--</form>-->
<!--aqui ajax-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script>
        $(function ()
        {
            'use strict';

            $(document).on('keyup', '#search-form .search', function ()
            {
                if($(this).val().length > 0)
                {
                    var search = $(this).val();

                    $.get("{{ route('curpostbus') }}", {search: search}, function (res)
                    {
                        $('#results').html(res);
                    });

                    return;
                }

                $('#results').empty();
            });

            $(document).on('click', '.post-link', function ()
            {
                var postId = $(this).data('id');

                $.get("{{ route('mostrarcurbus') }}", {id: postId}, function (res)
                {
                    $('#results').empty();
                    $('.search').val('');
                    $('#post').html(res);
                });
            });
        });
        </script>

        <script>
            let a=document.getElementById('cancelar');
            a.addEventListener('click',function (event) {
            event.preventDefault(); //esto cancela el comportamiento del click
            setTimeout(()=> location.href="{{route('matricularestu')}}");
            });
        </script>

        <script>
            let b=document.getElementById('listado');
            b.addEventListener('click',function (event) {
            event.preventDefault(); //esto cancela el comportamiento del click
            setTimeout(()=> location.href="{{route('listadomatricula')}}");
            });
        </script>


@endsection