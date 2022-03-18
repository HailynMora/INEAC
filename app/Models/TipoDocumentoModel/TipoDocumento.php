<?php

namespace App\Models\TipoDocumentoModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';
   protected $primaryKey = "id";//tiene que hacer referencia a la llave primaria  
}
