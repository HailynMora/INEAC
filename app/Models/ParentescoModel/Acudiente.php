<?php

namespace App\Models\ParentescoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
{
    protected $table = 'acudiente';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
