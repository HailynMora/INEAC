<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class docenteController extends Controller
{
    public function registro_docente(){
        return view('docente.registro_docente');

    }
    public function listado_docente(){
        return view('docente.listar_docente');

    }
}
