@extends('usuario.principa_usul')
@section('content')
<div class="alert alert-primary text-center" role="alert">
 Vincular Docente a Asignaturas
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li>
        <h3>
          Buscar Asignatura
        </h3>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<!--instanciar el ajax para quitar el error no definido-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $('#formudatos').submit(function(e){
    e.preventDefault();
    var asignatura=$('#asignatura').val();
    var docente=$('#docente').val();
    var descripcion=$('#descripcion').val();
    var _token = $('input[name=_token]').val(); //token de seguridad

    $.ajax({
      type: "POST",
      url: "{{route('vincular')}}",
      data:{
        asignatura:asignatura,
        docente:docente,
        descripcion:descripcion,
        _token:_token
      },
      success: function (response) {
        if(response){
          $('#formudatos')[0].reset();
          toastr.success('Docente vinculado correctamente.', 'Nuevo Registro', {timeOut:3000});
        }
      }
    });
  })
  function resetform() {
     $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text],form input[type=number] ,form input[type=date] , form input[type=email]").each(function() { this.value = '' });
     toastr.success('Campos Vacios', {timeOut:1000});
  }
</script>
@endsection