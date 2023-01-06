<?php

namespace App\Models\AsignaturaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramasTecnicos extends Model
{
    protected $table = 'programa_tecnico';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}

