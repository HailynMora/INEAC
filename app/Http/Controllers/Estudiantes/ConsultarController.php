<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultarController extends Controller
{
    public function index(){
        return view('estudiantes.consultar');
    }

}
