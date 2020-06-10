<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table    = 'notas';
    public $timestamps  = false;
    public function tipo_nota() { return $this->belongsTo('App\Models\Tipo_nota', 'tipo_nota_id'); }
    public function usuario() { return $this->belongsTo('App\Models\User', 'usuario_id'); }
}
