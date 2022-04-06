<?php

namespace App\Models\MatriculasModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
