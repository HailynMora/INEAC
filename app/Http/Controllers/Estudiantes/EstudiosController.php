<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudiosController extends Controller
{
    public function principal(){
        return view('estudiantes.planEstudios');
    }
}
