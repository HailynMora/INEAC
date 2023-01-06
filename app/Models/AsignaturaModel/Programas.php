<?php

namespace App\Models\AsignaturaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    protected $table = 'tipo_curso';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}

