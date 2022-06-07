<?php

namespace App\Models\CalificacionesModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
