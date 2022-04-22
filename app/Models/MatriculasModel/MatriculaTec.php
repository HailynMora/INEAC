<?php

namespace App\Models\MatriculasModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaTec extends Model
{
    protected $table = 'matricula_tecnico';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
