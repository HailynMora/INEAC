<form action="{{route('pdfLaboral')}}" method="POST">
 @csrf
<div class="modal fade alerta" id="exampleModalcerti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #F1F1F1;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar certificado laboral</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--periodo academico-->
        @if(Session::has('pdf'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{Session::get('pdf')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleFormControlInput1">Ingrese número de documento</label>
                <input type="text" class="form-control" id="docu" name="docu" min="0" minlength="5" maxlength="12" required>
            </div>
        </div>
       </div>
        <!-- end per acdemico-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-success">Generar</button>
      </div>
    </div>
  </div>
</div>
</form>
<style>
  .modal-backdrop {
  z-index: -1;
  }
</style>