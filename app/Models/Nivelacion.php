<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivelacion extends Model
{
    protected $table = 'nivelaciones';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria use HasFactory;
}