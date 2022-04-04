<?php

namespace App\Http\Controllers\Perfil;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerfilModel\Perfil;


class PerfilController extends Controller
{
    public function registrar(){
        return view('perfil.perfil');
    }
    
    public function  regdatos(Request $request){
            $perfil = new Perfil();
            $perfil->nivel_estudios = $request->input('nivel');
            $perfil->intereses = $request->input('descripcion');
            $perfil->descripcion = $request->input('cur');
            $perfil->cursos_realizados = $request->input('inter');
            $perfil->experiencia = $request->input('exp');
            $perfil->id_docente = 1; //cada docente va a registrar su perfil por lo tanto 
            //se captura el id de logeado y se almacena en la base de datos
            //se debe validar que el usuario solamente tenga un perfil
            $perfil->save();
            return back();
    }

    public function busperfil(){
        //se debe ingresar la id del usuario logeado para actualizar el perfil
        $perfil = DB::table('perfil_docente')->get();
        return view('perfil.actualizar')->with('perfil', $perfil);
    }
    

    public function actu(Request $request){
        $iden=$request->iden;
        $perfil = Perfil::FindOrFail($iden);
        $perfil->nivel_estudios = $request->input('nivel');
        $perfil->intereses = $request->input('inter');
        $perfil->descripcion = $request->input('des');
        $perfil->cursos_realizados = $request->input('cur');
        $perfil->experiencia = $request->input('exp');
        $perfil->id_docente = 1;
        $perfil->save();
        return back();
    }

    
   
}
