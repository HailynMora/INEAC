<?php

namespace App\Models\SaludModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemaSalud extends Model
{
    protected $table = 'sistema_salud';
    protected $primaryKey = 'id';//tiene que hacer referencia a la llave primaria  
}
