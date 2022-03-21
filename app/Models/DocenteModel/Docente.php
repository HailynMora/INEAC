<?php

namespace App\Models\DocenteModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docente';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
