<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InicioController extends Controller
{
    public function vista(){
        return view('inicio.vista');

    }
    public function mision_vision(){
        return view('inicio.mision');

    }

    public function vistaprin(){
        $val=DB::table('tipo_curso')->where('tipo_curso.id_estado', '=', 1)->count();
        if($val!=0){
            $b=1;
            $prog=DB::table('tipo_curso')->where('tipo_curso.id_estado', '=', 1)->get();
            return view('inicio')->with('prog', $prog)->with('b', $b);
        }else{
            $b=0;
            $prog="sin datos";
            return view('inicio')->with('prog', $prog)->with('b', $b);
        }
       
    }
}
