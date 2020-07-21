<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
	protected $table = 'permisos';
	public $timestamps = false;
	// RELACIONES
    public function roles() { return $this->belongsToMany('App\Models\Rol', 'roles_permisos', 'permiso_id', 'rol_id'); }
}
