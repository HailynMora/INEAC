<?php

namespace App\Http\Controllers\Objetivos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjetivosModel\Objetivos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class objetivosController extends Controller
{
    public function regobjetivos(){
        $category = new Objetivos();
        $category->nombre = $request->input('nombre');
    }
}
