<?php

namespace App\Models\CalificacionesModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasTecnico extends Model
{
    protected $table = 'notas_tecnico';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
