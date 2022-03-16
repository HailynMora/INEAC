<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function vista(){
        return view('inicio.vista');

    }
    public function mision_vision(){
        return view('inicio.mision');

    }
}
