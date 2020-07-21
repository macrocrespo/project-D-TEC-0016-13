<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe_avances extends Model
{
    protected $table = 'informes_avances';
    public function director() { return $this->belongsTo('App\Models\User', 'director_proyecto_id'); }
    public function becarios() { return $this->hasMany('App\Models\Becario', 'informe_avance_id'); }
}