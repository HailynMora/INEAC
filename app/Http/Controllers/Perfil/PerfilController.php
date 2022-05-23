<?php

namespace App\Http\Controllers\Perfil;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerfilModel\Perfil;
use App\Http\Controllers\Perfil\Auth;

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

    
   
}
