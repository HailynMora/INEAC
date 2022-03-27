<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultarDocController extends Controller
{
    
    public function consul_doce(){
        return view('docente.consultar_docente');
    }
}
