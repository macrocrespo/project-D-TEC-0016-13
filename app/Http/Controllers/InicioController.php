<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    public $data;
    public $controller;

    public function __construct()
    {
        $this->middleware('auth');
        $this->controller = 'inicio';
        $this->data = array();
        $this->data['user'] = Auth::user();
    }
    
    public function index()
    {
        $this->data['titulo_pagina'] = 'Inicio';
        return view('inicio', $this->data);
    }

    public function demo()
    { 
        return view('demo', $this->data);
    }
}
