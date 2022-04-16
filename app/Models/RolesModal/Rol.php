<?php

namespace App\Models\RolesModal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
