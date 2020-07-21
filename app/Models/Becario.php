<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Becario extends Model
{
    protected $table    = 'informes_avances_becarios';
    public $timestamps  = false;
    public function informe() { return $this->belongsTo('App\Models\Informe_avances', 'informe_avance_id'); }
}
