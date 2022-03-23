<?php

namespace App\Models\EstadoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
