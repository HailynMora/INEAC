<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveltec extends Model
{
    protected $table = 'nivelacionestec';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria use HasFactory;
}