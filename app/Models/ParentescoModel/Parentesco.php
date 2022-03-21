<?php

namespace App\Models\ParentescoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    protected $table = 'parentezco';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria   
}
