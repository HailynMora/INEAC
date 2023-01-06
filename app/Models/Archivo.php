<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'publicidad';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria use HasFactory;
}

