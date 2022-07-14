<?php

namespace App\Http\Controllers\Perfil;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerfilModel\Perfil;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentescoModel\Acudiente;
use App\Models\EstudianteModel\Estudiante;

class PerfilController extends Controller
{
    public function registrar(){
        $idl=auth()->id();
        $val = DB::table('perfil_docente')->where('id_usuario', $idl)->count();
        if($val!=0){
            $b=1;
            $perfil = DB::table('perfil_docente')->where('id_usuario', $idl)->get();
           return view('perfil.actualizar')->with('perfil', $perfil)->with('b', $b);;
        }else{
            return view('perfil.perfil');
        }
    }
    
    public function  regdatos(Request $request){
           
            $idl=auth()->id();
            $perfil = new Perfil();
            $perfil->nivel_estudios = $request->input('nivel');
            $perfil->intereses = $request->input('descripcion');
            $perfil->descripcion = $request->input('cur');
            $perfil->cursos_realizados = $request->input('inter');
            $perfil->experiencia = $request->input('exp');
            $perfil->id_usuario = $idl; //cada docente va a registrar su perfil por lo tanto 
            //se captura el id de logeado y se almacena en la base de datos
            //se debe validar que el usuario solamente tenga un perfil
            //###########################################
            if($request->hasFile('foto')){                 
                $file = $request->file('foto');
                $val = "perfil".time().".".$file->guessExtension();
                $ruta = public_path("dist/perfil/".$val);
               // if($file->guessExtension()=="pdf"){
                copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
                $perfil->imagen= $val;//ingresa el nombre de la ruta a la base de datos
               }
            ############################################
            $perfil->save();
            return back();
    }

    public function busperfil(){
        //se debe ingresar la id del usuario logeado para actualizar el perfil
        $idl=auth()->id();
        $val = DB::table('perfil_docente')->where('id_usuario', $idl)->count();
        if($val!=0){
          $b=1;
           $perfil = DB::table('perfil_docente')->where('id_usuario', $idl)->get();
           return view('perfil.actualizar')->with('perfil', $perfil)->with('b', $b);
        }else{
            $b=0;
            $perfil="no hay datos";
            return view('perfil.actualizar')->with('perfil', $perfil)->with('mensaje', 'No hay Datos almacenados')->with('b', $b);
        }
       
    }
    

    public function actu(Request $request){
        $idl=auth()->id();
        $iden=$request->iden;
        $perfil = Perfil::FindOrFail($iden);
        $perfil->nivel_estudios = $request->input('nivel');
        $perfil->intereses = $request->input('inter');
        $perfil->descripcion = $request->input('des');
        $perfil->cursos_realizados = $request->input('cur');
        $perfil->experiencia = $request->input('exp');
        $perfil->id_usuario = $idl;
        $perfil->save();
        
        $datosper = Perfil::FindOrFail($iden);
        return response()->json(['datosper' => $datosper]);
    }

    public function estudiantePEr(){
        $ides=auth()->id();
          $datos  =DB::table('estudiante')
                    ->join('estado', 'id_estado', '=', 'estado.id')
                    ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'id_genero', '=', 'genero.id')
                    ->join('users', 'id_usuario', '=', 'users.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->where('id_usuario', $ides)
                    ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                    'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                    'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                    'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
                    'genero.descripcion as generoestu',  'genero.id as idgenero', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 'parentezco.id as idparentezco', 
                    'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                    'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu', 'tipo.id as idparen' )
                    ->get();

            $gen = DB::table('genero')->where('id', '!=', $datos[0]->idgenero)->select('genero.descripcion as gene', 'genero.id as idgen')->get();
            $tipodoc = DB::table('tipo_documento')->get();
            $paren = DB::table('parentezco')->get();
            
        return view('estudiantes.perfilES')->with('est', $datos)->with('gen', $gen)->with('doc', $tipodoc)->with('paren', $paren);
    }

   public function actuEstuPerfil(Request $request){
        $Registrar = Estudiante::FindOrFail($request->idest);
        //#################################################
        $Registrar->dirresidencia = $request->input('dirres');
        $Registrar->dptresidencia = $request->input('dptres');
        $Registrar->munresidencia = $request->input('mpiores');
        $Registrar->zona = $request->input('zona');
        $Registrar->barrio = $request->input('barrio');
        $Registrar->telefono = $request->input('telefono');
        $Registrar->id_genero = $request->input('genero');
        if($request->hasFile('img')){                 
            $file = $request->file('img');
            $val = "estu".time().".".$file->guessExtension();
            $ruta = public_path("dist/perfil/".$val);
           // if($file->guessExtension()=="pdf"){
            copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
            $Registrar->foto= $val;//ingresa el nombre de la ruta a la base de datos
        }
        $Registrar->save(); 
        /////////////////////////77######################### almacenar los datos en la tabla sistema_salud
        /////////////#############################################Almacenar los datos del acudiente
        $Acu=Acudiente::where('id_estudiante', '=', $request->idest)->first();
        $Acu->lastname = $request->input('nombresacu');
        $Acu->direccion = $request->input('diracu');
        $Acu->telefono = $request->input('telacu');
        $Acu->num_doc = $request->input('numdocacu');
        $Acu->id_parentesco = $request->input('parentezco');
        $Acu->id_tipo_doc =$request->input('tipoAcu');
        $Acu->save(); 
        return back();
   }
   
}
