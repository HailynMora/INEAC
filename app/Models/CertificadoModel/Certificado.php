<?php

namespace App\Models\CertificadoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table = 'certificados';
    protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria 
}
