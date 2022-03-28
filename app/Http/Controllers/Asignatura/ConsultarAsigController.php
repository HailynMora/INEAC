<?php

namespace App\Http\Controllers\Asignatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultarAsigController extends Controller
{
    public function index(){
        return view('asignatura.consultar_asig');
    }
}
