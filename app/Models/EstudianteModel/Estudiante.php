<?php

namespace App\Models\EstudianteModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
   protected $table = 'estudiante';
   protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
