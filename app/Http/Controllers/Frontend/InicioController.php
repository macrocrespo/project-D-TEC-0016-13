<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Informe_comun_imagen;

class InicioController extends Controller
{
    public $data;
    public $controller;

    public function __construct()
    {
        parent::__construct();
        $this->controller = 'inicio';
    }

    public function index()
    {
        // Obtener las imágenes de los informes
        $this->data['imagenes'] = Informe_comun_imagen::orderBy('id', 'desc')->get();
        return view('frontend/inicio', $this->data);
    }
}
