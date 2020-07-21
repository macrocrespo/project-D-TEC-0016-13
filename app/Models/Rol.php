<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table = 'roles';
	public $timestamps = false;
	// RELACIONES
	public function usuarios() { return $this->hasMany('App\Models\User', 'rol_id'); }
    public function permisos() { return $this->belongsToMany('App\Models\Permiso', 'roles_permisos', 'rol_id', 'permiso_id'); }
}
