<?php

namespace App\Models\GeneroModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
   protected $table = 'genero';
   protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
