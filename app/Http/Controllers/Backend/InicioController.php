<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public $data;
    public $controller;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->controller = 'inicio';
    }

    /**
     * Función para cargar todos los datos necesarios en el array $this->data
     */
    private function _load_data($page = 'index')
    {
        $title = 'Inicio';
        $this->data['controller'] = $this->controller;
        $this->data['user']  = Auth::user(); // Cargar el usuario registrado
        // Migas de pan (breadcrumb)
        switch($page)
        {
            case 'index': 
                $this->data['icono_pagina']  = 'fas fa-home';
                $this->data['titulo_pagina'] = $title;
                $this->data['breadcrumb'] = array(
                    '-' => $title
                );
                break;
        }
    }

    public function index()
    {
        $this->_load_data();
        $informes = $cantidad = (object) null;
        $informes->comunes      = DB::table('informes_comunes')->count();
        $informes->avances      = DB::table('informes_avances')->count();
        $informes->hitos        = DB::table('informes_hitos')->count();
        $informes->indicadores  = DB::table('informes_indicadores')->count();
        $cantidad->notas        = DB::table('notas')->count();
        $this->data['informes'] = $informes;
        $this->data['cantidad'] = $cantidad;
        $this->data['fincas']   = DB::table('fincas')->get();
        return view('backend/inicio', $this->data);
    }
}
