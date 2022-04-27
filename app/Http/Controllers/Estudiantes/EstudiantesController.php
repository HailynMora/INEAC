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
            ->join('etnia', 'id_etnia', '=', 'etnia.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id_acudiente', '=', 'acudiente.id')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->select('estudiante.id', 'estudiante.nombre', 'estudiante.apellido', 'estudiante.direccion', 'estudiante.telefono',
            'estudiante.num_doc', 'estudiante.estrato', 'estudiante.correo', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'etnia.descripcion as etniaestu', 'users.name as usuestu', 'acudiente.nombre as nomacu', 'acudiente.apellido as apeacu', 'parentezco.descripcion as paren')
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
                if($request->input('secondape')!=NULL){
                    $Registrar->second_ape = $request->input('secondape');
                }
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
                $Registrar->id_usuario  = $request->input('usuario');
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
        $est = DB::table('estudiante')->where('estudiante.id','=',$id)
            ->join('estado', 'id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'id_genero', '=', 'genero.id')
            ->join('etnia', 'id_etnia', '=', 'etnia.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id_acudiente', '=', 'acudiente.id')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('certificados', 'estudiante.id_certificados', '=', 'certificados.id')
            ->select('estudiante.id', 'estudiante.nombre', 'estudiante.apellido', 'estudiante.direccion', 'estudiante.telefono',
            'estudiante.num_doc', 'estudiante.id_certificados','estudiante.estrato', 'estudiante.correo','estudiante.id_tipo_doc', 'estudiante.id_genero' ,'estudiante.id_etnia','estudiante.id_acudiente','estudiante.id_estado','estudiante.id_usuario','estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'etnia.descripcion as etniaestu', 'users.name as usuestu', 'acudiente.nombre as nomacu', 'acudiente.apellido as apeacu', 'parentezco.descripcion as paren','certificados.foto')
            ->get();
        $tipo_doc=TipoDocumento::all();
        $gen=Genero::all();
        $etnia=EtniaModel::all();
        $acu=Acudiente::all();
        $estado=Estado::all();
        $certificado=Certificado::all();
        $user=User::all();
        return view('estudiantes.actualizar', compact('est','tipo_doc','gen','etnia','acu','estado','certificado','user'));
    }
    public function actualizar_estudiante(Request $request,$id){
        $estudiante = Estudiante::FindOrFail($id);
        $estudiante->nombre = $request->input('nombre');
        $estudiante->apellido = $request->input('apellido');
        $estudiante->direccion = $request->input('direccion');
        $estudiante->telefono = $request->input('telefono');
        $estudiante->num_doc = $request->input('numero_doc');
        $estudiante->correo = $request->input('correo');
        $estudiante->estrato = $request->input('estrato');
        $estudiante->id_etnia = $request->input('etnia');
        $estudiante->id_genero = $request->input('genero');
        $estudiante->id_acudiente = $request->input('acudiente');
        $estudiante->id_tipo_doc = $request->input('tipodoc');
        $estudiante->id_certificados = $request->input('certificado');
        $estudiante->id_estado = $request->input('estado');
        $estudiante->id_usuario = $request->input('usuario');
        $estudiante->save();
        return redirect('/visualizar/estudiante');

    }
}