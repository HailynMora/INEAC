<?php

namespace App\Models\AsignaturaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsigProgram extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
