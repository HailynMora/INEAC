@extends('usuario.principa_usul')
@section('content')

<div class="alert text-center" role="alert" style="background-color: #ffc107; color:#ffffff;">
 <h3 class="letra1">Perfil Estudiante</h3>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="alert" role="alert">
          
          <div class="container" style="border-radius: 50%;">
              <img src="{{asset('dist/perfil/'.$est[0]->foto)}}" class="img-fluid" alt="cargando imagen..." style="border-radius: 50%; width:30%; height:30%;" >
            </div>
            
      </div>   
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>
<div class="container letraf">
<form action="{{route('actuPerfil_Estu')}}" method="post" enctype='multipart/form-data'>
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
                <a class="btn btn-link btn-block text-left float-right" type="button" href="/dashboard">
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
              <label for="numero_doc">Tipo Documento</label>
              <input type="text" class="form-control" id="tipodoc" name="tipodoc" value="{{$est[0]->tdoces}}" readonly="readonly">
              <input type="text" class="form-control" id="idest" name="idest" value="{{$est[0]->id}}" hidden>
             
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">N??mero Documento</label>
              <input type="number" class="form-control" id="numero_doc" name="numero_doc" value="{{$est[0]->num_doc}}" readonly="readonly">
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Dpt. Expedici??n</label>
            <input type="text" class="form-control" id="depex" name="depex" value="{{$est[0]->dpt_expedicion}}" readonly="readonly">
            </div>
          </div>
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="numero_doc">Mpio Expedici??n</label>
              <input type="text" class="form-control" id="mpioex" name="mpioex" value="{{$est[0]->mun_expedicion}}" readonly="readonly">
            </div>
            <div class="form-group col-md-4">
               <div class="form-group">
                  <label for="genero">Genero</label>
                  <select class="form-control" id="genero" name="genero">
                  <option value="{{$est[0]->idgenero}}">{{$est[0]->generoestu}}</option>
                    @foreach($gen as $g)
                      @if(isset($g->gene))
                        <option value="{{$g->idgen}}"> {{$g->gene}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fecnac" name="fecnac" value="{{date('Y-m-d', strtotime($est[0]->fecnacimiento))}}" readonly="readonly" >
            </div>
          </div>
          <!---###############--->
          <!---###############################################--->
          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="numero_doc">Dpt. Nacimiento</label>
              <input type="text" class="form-control" id="dpt_nac" name="dpt_nac"  value="{{$est[0]->dpt_nacimiento}}" readonly="readonly">
            </div>
            <div class="form-group col-md-6">
             <label for="numero_doc">Mpio. Nacimiento</label>
              <input type="text" class="form-control" id="mpio_nac" name="mpio_nac" value="{{$est[0]->mun_nacimiento}}" readonly="readonly">
            </div>
          </div>
          <!---###############--->
          <div class="form-row">
          <div class="form-group col-md-3">
              <label for="apellido">Primer Apellido</label>
              <input type="text" class="form-control" id="firsape" name="firsape" value="{{$est[0]->firts_ape}}" required onkeypress="return soloLetras(event)" readonly="readonly">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="secondape" name="secondape" value="{{$est[0]->second_ape}}" onkeypress="return soloLetras(event)" readonly="readonly">
            </div>
            <div class="form-group col-md-3">
             <label for="nombre">Primer Nombre</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="{{$est[0]->first_nom}}" required onkeypress="return soloLetras(event)" readonly="readonly">
            </div>
            <div class="form-group col-md-3">
            <label for="apellido">Segundo Nombre</label>
              <input type="text" class="form-control" id="secondname" name="secondname" value="{{$est[0]->second_nom}}" onkeypress="return soloLetras(event)" readonly="readonly">
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
          <div class="form-group col-md-3">
            <label for="genero">Zona</label>
            <input type="text" class="form-control" id="zona" name="zona" value="{{$est[0]->zona}}">
               
            </div>
            <div class="form-group col-md-3">
              <label for="estrato">Estrato</label>
              <input type="number" class="form-control" id="estrato" name="estrato" value="{{$est[0]->estrato}}" readonly="readonly">
            </div>
            <div class="form-group col-md-3">
                <label for="estrato">Tipo Sanguineo</label>
                <input type="text" class="form-control" id="sangre" name="sangre" value=" {{$est[0]->tiposangre}}" readonly="readonly">
          </div>
           <div class="form-group col-md-3">
             <label for="telefono">Telefono</label>
             <input type="text" class="form-control" id="telefono" name="telefono" value="{{$est[0]->telefono}}">
            </div>
          </div>
          <!---##################33-->
            <!---###############--->
            <div class="form-row">
            <div class="form-group col-md-3">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" value="{{$est[0]->correo}}" readonly="readonly">
            </div>
            <div class="form-group col-md-3">
             <label for="nomusu">Usuario</label>
             <input type="text" class="form-control" id="nomusu" name="nomusu" value="{{$usu->name}}">
            </div>
            <div class="form-group col-md-3">
              <label for="correo">Contrase??a</label>
              <input type="password" class="form-control" id="pass" name="pass" placeholder="*********" >
            </div>
            <div class="form-group col-md-3">
              <label for="img">Foto</label>
              <input type="file" class="form-control" id="img" name="img">
            </div>
          </div>
          <!--estado oculto por defecto habilitado--> 
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
              <input type="text" class="form-control" id="regimen" name="regimen" value="{{$est[0]->regimen}}" readonly="readonly">
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Carnet EPS</label>
            <input type="text" class="form-control" id="carnet" name="carnet" value="{{$est[0]->eps}}" readonly="readonly">
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Nivel Formaci??n</label>
              <input type="text" class="form-control" id="nivelformacion" name="nivelformacion" value="{{$est[0]->nivelformacion}}" readonly="readonly">
            </div>
            </div>
            <!---#####################--->
                 
            <div class="form-row">
            <div class="form-group col-md-4">
            <label for="correo">Ocupaci??n</label>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion" value="{{$est[0]->ocupacion}}"  readonly="readonly">
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Discapacidad</label>
            <input type="text" class="form-control" id="dicapacidad" name="discapacidad" value="{{$est[0]->discapacidad}}" readonly="readonly">
            </div>
            <div class="form-group col-md-4">
              <label for="correo">Etnia</label>
              <input type="text" class="form-control" id="etnia" name="etnia" value="{{$est[0]->etniades}}" readonly="readonly">
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
              <label for="genero">Tipo Documento</label>
                  <select class="form-control" id="tipoAcu" name="tipoAcu">
                  <option value="{{$est[0]->idparen}}">{{$est[0]->tdocacu}}</option>
                    @foreach($doc as $d)
                      @if(isset($d->descripcion))
                        <option value="{{$d->id}}"> {{$d->descripcion}}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">N??mero Documento</label>
              <input type="number" class="form-control" id="numdocacu" name="numdocacu" value="{{$est[0]->numacu}}" >
            </div>
            <div class="form-group col-md-4">
            <label for="correo">Nombres y Apellidos</label>
            <input type="text" class="form-control" id="nombresacu" name="nombresacu" value="{{$est[0]->nomacu}}" >
            </div>
          </div>
          <!--################################3-->
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="etnia">Parentesco</label>
            <select class="form-control"  id="parentezco" name="parentezco">
                  <option value="{{$est[0]->idparentezco}}">{{$est[0]->paren}}</option>
                    @foreach($paren as $p)
                      @if(isset($p->descripcion))
                        <option value="{{$p->id}}"> {{$p->descripcion}}</option>
                      @endif
                    @endforeach
            </select>
          </div>
           <div class="form-group col-md-4">
              <label for="tipodoc">Dir. Residencia</label>
              <input type="text" class="form-control" id="diracu" name="diracu" value="{{$est[0]->diracu}}">
            </div>
            <div class="form-group col-md-4">
              <label for="numero_doc">Telefono/Celular</label>
              <input type="number" class="form-control" id="telacu" name="telacu" value="{{$est[0]->telacu}}" >
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
        <button type="submit" class="btn btn-primary">Actualizar</button>
   <!---############################################################################--->
    </form>
</div>
@endsection