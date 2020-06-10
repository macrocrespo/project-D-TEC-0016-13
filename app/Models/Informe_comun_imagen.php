<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe_comun_imagen extends Model
{
    protected $table    = 'informes_comunes_imagenes';
    public $timestamps  = false;
    public function informe() { return $this->belongsTo('App\Models\Informe_comun', 'informe_comun_id'); }
}
