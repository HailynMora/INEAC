<?php

namespace App\Models\ObjetivosModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivos extends Model
{
    protected $table = 'objetivos';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
