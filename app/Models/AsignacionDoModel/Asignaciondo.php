<?php

namespace App\Models\AsignacionDoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciondo extends Model
{
    protected $table = 'asig_asignaturas';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
