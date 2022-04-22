<?php

namespace App\Models\TrimestresModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrimestresTecnicos extends Model
{
    protected $table = 'trimestre_tecnicos';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria use HasFactory;
}
