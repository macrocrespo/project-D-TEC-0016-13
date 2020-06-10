<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe_comun extends Model
{
    protected $table = 'informes_comunes';
    public function usuario() { return $this->belongsTo('App\Models\User', 'usuario_id'); }
    public function imagenes() { return $this->hasMany('App\Models\Informe_comun_imagen', 'informe_comun_id'); }
}