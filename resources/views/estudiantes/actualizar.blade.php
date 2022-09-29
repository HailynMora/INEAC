@extends('usuario.principa_usul')
@section('content')
<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Actualizar Estudiante</h3>
</div>
<br><br>
<div class="container letraf">
<form action="{{route('actualizar_estudiante', $est[0]->id)}}" method="post">
 @csrf
    <!---#####################################################################3----->
 <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <!--#########################################-->
        <div class="row">
           <div class="col-md-10">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-edit"></i> Datos Personales
                </button>
              </h2>
          </div>
          <div class="col-md-2">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left float-right" type="button" href="/visualizar/estudiante">
                <i class="fas fa-arrow-circle-left"></i> Volver
                </a>
              </h2>
          </div>
      </div>
      <!------>
    </div>
    
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Tipo Documento</label>
              <select id="tipodoc" name="tipodoc" class="form-control" required>
              <option value="{{$est[0]->idtdoces}}">{{$est[0]->tdoces}}</option>
                @foreach($tipodoc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Número Documento</label>
              <input type="number" class="form-control" id="numero_doc" name="numero_doc" value="{{$est[0]->num_doc}}" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Dpt. Expedición</label>
            <input type="text" class="form-control" id="depex" name="depex" value="{{$est[0]->dpt_expedicion}}">
            </div>
          </div>
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="numero_doc">Mpio Expedición</label>
              <input type="text" class="form-control" id="mpioex" name="mpioex" value="{{$est[0]->mun_expedicion}}">
            </div>
            <div class="form-group col-md-4">
              <label for="genero">Genero</label>
                <select id="genero" class="form-control" name="genero" required>
                <option value="{{$est[0]->idgen}}">{{$est[0]->generoestu}}</option>
                  @foreach($genero as $g)
                  <option value="{{$g->id}}">{{$g->descripcion}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fecnac" name="fecnac" value="{{date('Y-m-d', strtotime($est[0]->fecnacimiento))}}" required >
            </div>
          </div>
          <!---###############--->
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="numero_doc">Dpt. Nacimiento</label>
              <input type="text" class="form-control" id="dpt_nac" name="dpt_nac"  value="{{$est[0]->dpt_nacimiento}}" >
            </div>
            <div class="form-group col-md-6">
             <label for="numero_doc">Mpio. Nacimiento</label>
              <input type="text" class="form-control" id="mpio_nac" name="mpio_nac" value="{{$est[0]->mun_nacimiento}}">
            </div>
          </div>
          <!---###############--->
          <div class="form-row">
          <div class="form-group col-md-3">
              <label for="apellido">Primer Apellido</label>
              <input type="text" class="form-control" id="firsape" name="firsape" value="{{$est[0]->firts_ape}}" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="secondape" name="secondape" value="{{$est[0]->second_ape}}" onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Primer Nombre</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="{{$est[0]->first_nom}}" required onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Nombre</label>
              <input type="text" class="form-control" id="secondname" name="secondname" value="{{$est[0]->second_nom}}" onkeypress="return soloLetras(event)">
            </div>
          </div>
          <!---##################33-->
          <!---###############--->
          <div class="form-row">
          <div class="form-group col-md-3">
              <label for="apellido">Dtp. Residencia</label>
              <input type="text" class="form-control" id="dptres" name="dptres" value="{{$est[0]->dptresidencia}}"  onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
              <label for="apellido">Mpio. Residencia</label>
              <input type="text" class="form-control" id="mpiores" name="mpiores" value="{{$est[0]->munresidencia}}"  onkeypress="return soloLetras(event)">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Dir. Residencia</label>
              <input type="text" class="form-control" id="dirres" name="dirres" value="{{$est[0]->dirresidencia}}" >
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Barrio</label>
              <input type="text" class="form-control" id="barrio" name="barrio" value="{{$est[0]->barrio}}">
            </div>
          </div>
          <!---##################33-->
           <!---###############--->
           <div class="form-row">
          <div class="form-group col-md-4">
            <label for="genero">Zona</label>
                <select id="zona" class="form-control" name="zona" >
                <option value="{{$est[0]->zona}}" selected> {{$est[0]->zona}}</option>
                  <option value="Rural">Rural</option>
                  <option value="Urbana">Urbana</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="estrato">Estrato</label>
              <input type="number" class="form-control" id="estrato" name="estrato" value="{{$est[0]->estrato}}" required>
            </div>
            <div class="form-group col-md-4">
            <label for="genero">Tipo Sanguineo</label>
                <select id="sangre" class="form-control" name="sangre" >
                <option value="{{$est[0]->tiposangre}}" selected> {{$est[0]->tiposangre}}</option>
                  <option value="A+">A+</option>
                  <option value="B+">B+</option>
                  <option value="O+">O+</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="A-">A-</option>
                  <option value="O-">O-</option>
                  <option value="B-">B-</option>
                </select>
          </div>
          </div>
          <!---##################33-->
            <!---###############--->
            <div class="form-row">
            <div class="form-group col-md-6">
             <label for="telefono">Telefono</label>
             <input type="text" class="form-control" id="telefono" name="telefono" value="{{$est[0]->telefono}}">
            </div>
            <div class="form-group col-md-6">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" value="{{$est[0]->correo}}" required>
            </div>
          </div>
          <!--estado oculto por defecto habilitado-->
              <select id="estado" class="form-control" name="estado">
              <option value="{{$est[0]->idestado}}" selected>{{$est[0]->estadoes}}</option>
                @foreach($estado as $es)
                <option value="{{$es->id}}">{{$es->descripcion}}</option>
                @endforeach
              </select>
             
          <!---##################33-->
          <!--end estado-->

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Sistema De Salud
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
         <!----##########################-->
         <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Regimen salud</label>
              <input type="text" class="form-control" id="regimen" name="regimen" value="{{$est[0]->regimen}}" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Carnet EPS</label>
            <input type="text" class="form-control" id="carnet" name="carnet" value="{{$est[0]->eps}}" required>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Nivel Formación</label>
              <input type="text" class="form-control" id="nivelformacion" name="nivelformacion" value="{{$est[0]->nivelformacion}}">
            </div>
            </div>
            <!---#####################--->
                 
            <div class="form-row">
            <div class="form-group col-md-4">
            <label for="correo">Ocupación</label>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion" value="{{$est[0]->ocupacion}}" >
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Discapacidad</label>
            <input type="text" class="form-control" id="dicapacidad" name="discapacidad" value="{{$est[0]->discapacidad}}" >
            </div>
            <div class="form-group col-md-4">
            <label for="etnia">Multiculturalidad</label>
                <select id="etnia" class="form-control" name="etnia" required> 
                <option value="{{$est[0]->idetnia}}">{{$est[0]->etniades}}</option>
                @foreach($etnia as $e)
                  <option value="{{$e->id}}">{{$e->descripcion}}</option>
                  @endforeach
                </select>
             </div>

          </div>
          <!--################################3-->      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Acudiente
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <!----##########################-->
        <div class="form-row">
          <div class="form-group col-md-4">
              <label for="tipodoc">Tipo Documento</label>
              <select id="tdocacu" name="tdocacu" class="form-control" required>
              <option value="{{$est[0]->idtpoacu}}">{{$est[0]->tdocacu}}</option>
                @foreach($tipodoc as $t)
                <option value="{{$t->id}}">{{$t->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Número Documento</label>
              <input type="number" class="form-control" id="numdocacu" name="numdocacu" value="{{$est[0]->numacu}}" required>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Nombres y Apellidos</label>
            <input type="text" class="form-control" id="nombresacu" name="nombresacu" value="{{$est[0]->nomacu}}" required>
            </div>
          </div>
          <!--################################3-->
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="etnia">Parentesco</label>
                <select id="parentesco" class="form-control" name="parentesco" required> 
                <option value="{{$est[0]->idparen}}">{{$est[0]->paren}}</option>
                  @foreach($paren as $p)
                  <option value="{{$p->id}}">{{$p->descripcion}}</option>
                  @endforeach
                </select>
              </div>
           <div class="form-group col-md-4">
              <label for="tipodoc">Dir. Residencia</label>
              <input type="text" class="form-control" id="diracu" name="diracu" value="{{$est[0]->diracu}}" required>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Telefono/Celular</label>
              <input type="number" class="form-control" id="telacu" name="telacu" value="{{$est[0]->telacu}}" required>
            </div>
          </div>
          <!---###############################3-->
          <!-----etnia-->
       <!------##########################-->
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">

        </div>
        <a href="{{route('listarestu')}}"type="submit" class="btn btn-warning">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{url('/visualizar/estudiante')}}" type="button"   id="miboton" class="btn btn-success">Visualizar</a>
   <!---############################################################################--->
    </form>
</div>
@endsection