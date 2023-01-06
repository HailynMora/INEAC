<?php

namespace App\Models\AsignaturaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}

