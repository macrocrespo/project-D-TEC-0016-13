<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('backend/inicio', $this->data);
    }
}
