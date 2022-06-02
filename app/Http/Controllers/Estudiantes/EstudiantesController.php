<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\ParentescoModel\Acudiente;
use App\Models\ParentescoModel\EtniaModel;
use App\Models\EstudianteModel\Estudiante;
use App\Models\CertificadoModel\Certificado;
use App\Models\EstadoModel\Estado;
use App\Models\SaludModel\SistemaSalud;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class EstudiantesController extends Controller
{
    public function registro(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $etnia=EtniaModel::all();
        $estado=Estado::all();
        $user=User::all();
        $paren=Parentesco::all();
        return view('estudiantes.registroestu')->with('tipodoc', $tipodoc)
        ->with('genero', $genero)->with('etnia', $etnia)
        ->with('estado', $estado)
        ->with('user', $user)->with('paren', $paren);
    }

    public function listar(){
        $res=DB::table('estudiante')->count(); //validar datos cuando no hay estudiantes
        if($res!=0){
            $b=1;
            $estudiante=DB::table('estudiante')
            ->join('estado', 'id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'id_genero', '=', 'genero.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
	        ->get();
        }
        else{
            $b=0;
            $estudiante=array('datos');
        }

        return view('estudiantes.visualizar')->with('estudiante', $estudiante)->with('b', $b);
    }
    public function cambiar_estado($id){
        $estu= Estudiante::find($id);
        $es = $estu->id_estado;
        if($es==2){
            $estu->id_estado = 1;
            $estu->save();
        }else{
            $estu->id_estado = 2;
            $estu->save();
        }        
        return redirect('/visualizar/estudiante');
    }


    public function regisacudiente(){
        $tipodoc=TipoDocumento::all();
        $paren=Parentesco::all();
        $genero=Genero::all();
        return view('estudiantes.acudiente')->with('tipodoc', $tipodoc)->with('paren', $paren)->with('genero', $genero);
    }

    public function datos(Request $request){
        $category = new Acudiente();
        $category->nombre = $request->input('nombre');
        $category->apellido = $request->input('apellido');
        $category->direccion = $request->input('direccion');
        $category->telefono = $request->input('telefono');
        $category->num_doc = $request->input('numerodoc');
        $category->id_parentesco = $request->input('parentesco');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('genero');
        $category->save();
        return back();
    }

    public function matricula(Request $request){

        $r= $request->input('numerodoc');
        $co= $request->input('correo');
        $res=DB::table('estudiante')->where('num_doc', '=', $r)->count();
        $c=DB::table('estudiante')->where('correo', '=', $co)->count();
        //consultar id del rol
        $idrol = DB::table('roles')->where('roles.descripcion', 'like', 'Estudiante')->select('roles.id')->first();
        //crear el user
        $usu = new User();
        $usu->name = $request->input('firstname');
        $usu->email = $request->input('email');
        $usu->password = Hash::make($request->pass);
        $usu->id_rol = $idrol->id;
        $usu->save();
        //end crear user

        if($res!=0){//validacion con ajax
            return \Response::json([
                'error'  => 'Error datos'
            ],422);
        }else{
            if($c!=0){
                return \Response::json([
                    'error'  => 'Error datos'
                ],423);
            }else{ 
                $Registrar = new Estudiante();
                $Registrar->first_nom = $request->input('firstname');
                $Registrar->second_nom = $request->input('secondname');
                $Registrar->firts_ape = $request->input('firsape');
                $Registrar->second_ape = $request->input('secondape');
                $Registrar->tiposangre = $request->input('sangre');
                $Registrar->dirresidencia = $request->input('dirres');
                $Registrar->dptresidencia = $request->input('dptres');
                $Registrar->munresidencia = $request->input('mpiores');
                $Registrar->zona = $request->input('zona');
                $Registrar->barrio = $request->input('barrio');
                $Registrar->telefono = $request->input('telefono');
                $Registrar->num_doc = $request->input('numero_doc');
                $Registrar->dpt_expedicion = $request->input('depex');
                $Registrar->mun_expedicion = $request->input('mpioex');
                $Registrar->fecnacimiento = $request->input('fecnac');
                $Registrar->dpt_nacimiento  = $request->input('dpt_nac');
                $Registrar->mun_nacimiento = $request->input('mpio_nac');
                $Registrar->correo = $request->input('correo');
                $Registrar->estrato = $request->input('estrato');
                $Registrar->id_genero = $request->input('genero');
                $Registrar->id_tipo_doc  = $request->input('tipodoc');
                $Registrar->id_estado = $request->input('estado');
                $Registrar->id_usuario  = $usu->id;
                $Registrar->save(); 
                //////////////////////////#################consultar el id del estudiante ingresado
                $ndoc=$request->numero_doc;
                $resestu=DB::table('estudiante')->where('num_doc', '=', $ndoc)->select('estudiante.id as idestu')->first();
                /////////////////////////77######################### almacenar los datos en la tabla sistema_salud
                $Salud =new SistemaSalud();
                $Salud->regimen	= $request->input('regimen');
                $Salud->eps	= $request->input('carnet');
                $Salud->nivelformacion= $request->input('nivelformacion');
                $Salud->ocupacion = $request->input('ocupacion');
                $Salud->discapacidad = $request->input('discapacidad');	
                $Salud->id_etnia = $request->input('etnia');
                $Salud->id_estudiante = $resestu->idestu;
                $Salud->save(); 
                /////////////#############################################Almacenar los datos del acudiente
                $Acu = new Acudiente();
                $Acu->lastname = $request->input('nombresacu');
                $Acu->direccion = $request->input('diracu');
                $Acu->telefono = $request->input('telacu');
                $Acu->num_doc = $request->input('numdocacu');
                $Acu->id_parentesco = $request->input('parentesco');
                $Acu->id_tipo_doc =$request->input('tdocacu');
                $Acu->id_estudiante	=$resestu->idestu;
                $Acu->save();
            }
        }
              
        return back();        
    }
    public function form_actualizar($id){
        
       // $est = Estudiante::findOrFail($id);
       $est=DB::table('estudiante')
            ->where('estudiante.id', '=', $id)
            ->join('estado', 'id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'id_genero', '=', 'genero.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.id_tipo_doc as idtdoces', 'estudiante.id_genero as idgen', 'estudiante.id_estado as idestado', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'sistema_salud.id_etnia as idetnia',  'etnia.descripcion as etniades', 'acudiente.id_parentesco as idparen',  'acudiente.id_tipo_doc as idtpoacu', 'tipo.descripcion as tdocacu')
	        ->get();
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $etnia=EtniaModel::all();
        //$acu=Acudiente::all();
        $estado=Estado::all();
       // $certificado=Certificado::all();
       $paren=Parentesco::all();
        //$user=User::all();
        return view('estudiantes.actualizar', compact('est','tipodoc','genero','etnia','estado', 'paren'));
    }
    public function actualizar_estudiante(Request $request, $id){
           $Registrar = Estudiante::FindOrFail($id);
        //#################################################
            $Registrar->first_nom = $request->input('firstname');
            $Registrar->second_nom = $request->input('secondname');
            $Registrar->firts_ape = $request->input('firsape');
            $Registrar->second_ape = $request->input('secondape');
            $Registrar->tiposangre = $request->input('sangre');
            $Registrar->dirresidencia = $request->input('dirres');
            $Registrar->dptresidencia = $request->input('dptres');
            $Registrar->munresidencia = $request->input('mpiores');
            $Registrar->zona = $request->input('zona');
            $Registrar->barrio = $request->input('barrio');
            $Registrar->telefono = $request->input('telefono');
            $Registrar->num_doc = $request->input('numero_doc');
            $Registrar->dpt_expedicion = $request->input('depex');
            $Registrar->mun_expedicion = $request->input('mpioex');
            $Registrar->fecnacimiento = $request->input('fecnac');
            $Registrar->dpt_nacimiento  = $request->input('dpt_nac');
            $Registrar->mun_nacimiento = $request->input('mpio_nac');
            $Registrar->correo = $request->input('correo');
            $Registrar->estrato = $request->input('estrato');
            $Registrar->id_genero = $request->input('genero');
            $Registrar->id_tipo_doc  = $request->input('tipodoc');
            $Registrar->id_estado = $request->input('estado');
            $Registrar->id_usuario  = 1;
            $Registrar->save(); 
            //////////////////////////#################consultar el id del estudiante ingresado
            $Salud=SistemaSalud::where('id_estudiante', '=', $id)->first();
            /////////////////////////77######################### almacenar los datos en la tabla sistema_salud
            $Salud->regimen	= $request->input('regimen');
            $Salud->eps	= $request->input('carnet');
            $Salud->nivelformacion= $request->input('nivelformacion');
            $Salud->ocupacion = $request->input('ocupacion');
            $Salud->discapacidad = $request->input('discapacidad');	
            $Salud->id_etnia = $request->input('etnia');
            $Salud->save(); 
            /////////////#############################################Almacenar los datos del acudiente
            $Acu=Acudiente::where('id_estudiante', '=', $id)->first();
            $Acu->lastname = $request->input('nombresacu');
            $Acu->direccion = $request->input('diracu');
            $Acu->telefono = $request->input('telacu');
            $Acu->num_doc = $request->input('numdocacu');
            $Acu->id_parentesco = $request->input('parentesco');
            $Acu->id_tipo_doc =$request->input('tdocacu');
            $Acu->save(); 


        //#################################################
        return redirect('/visualizar/estudiante');

    }

    //////////////////buscar estudiante////////////////////////
    public function busquedares_est(Request $request){
        $busest = $estudiante=DB::table('estudiante')->where('estudiante.num_doc','=',$request->nombre)
                    ->join('estado', 'id_estado', '=', 'estado.id')
                    ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'id_genero', '=', 'genero.id')
                    ->join('users', 'id_usuario', '=', 'users.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                    'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                    'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                    'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
                    'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
                    'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                    'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
                    ->get();
     return response(json_decode($busest,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////cambiar el estado del estudianet por ajax

    
    public function cambiarestado(Request $request){
        $estu= Estudiante::find($request->idestudiante);
        $es = $estu->id_estado;
        if($es==2){
            $estu->id_estado = 1;
            $estu->save();
        }else{
            $estu->id_estado = 2;
            $estu->save();
        }        
        return back();
    }
    public function listar_estudo(){
        $res=DB::table('estudiante')->count(); //validar datos cuando no hay estudiantes
        if($res!=0){
            $b=1;
            $estudiante=DB::table('estudiante')
            ->join('estado', 'id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'id_genero', '=', 'genero.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
	        ->get();
        }
        else{
            $b=0;
            $estudiante=array('datos');
        }

        return view('estudiantes.listado_doc')->with('estudiante', $estudiante)->with('b', $b);
    }


}