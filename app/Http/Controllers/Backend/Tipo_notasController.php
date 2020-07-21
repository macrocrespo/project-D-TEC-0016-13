<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Backend;

use App\Models\Tipo_nota;

class Tipo_notasController extends Controller
{
    public $data;
    public $controller;
    public $url_views;
    public $contenido;
    public $singular;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth'); // Autenticación
        $this->controller = 'tipo_notas';
        $this->url_views = 'backend.'.$this->controller.'.';
        $this->contenido = 'Tipo de notas';
        $this->singular = 'tipo de nota';
    }

    /**
     * Función para cargar todos los datos necesarios en el array $this->data
     */
    private function _load_data($page = 'index')
    {
        $this->data['controller']   = $this->controller;
        $this->data['user']         = Auth::user(); // Cargar el Tipo de nota registrado
        $this->data['contenido']    = $this->contenido;
        $this->data['singular']     = $this->singular;
        $this->data['active']['_notas'] = true;
        $this->data['active'][$this->controller] = true;

        // Migas de pan (breadcrumb)
        $title = $this->contenido;
        switch($page)
        {
            case 'index': 
                $this->data['icono_pagina']  = 'far fa-copy';
                $this->data['titulo_pagina'] = $title;
                $this->data['breadcrumb'] = array(
                    '-' => $title
                );
                break;
            case 'create': 
                $this->data['icono_pagina']  = 'fas fa-plus-circle';
                $this->data['titulo_pagina'] = 'Agregar '.$this->singular;
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Agregar '.$this->singular
                );
                break;
            case 'edit': 
                $this->data['icono_pagina']  = 'fas fa-pencil-alt';
                $this->data['titulo_pagina'] = 'Editar '.$this->singular;
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Editar '.$this->singular
                );
                break;
            case 'show': 
                $this->data['icono_pagina']  = 'fas fa-check-circle';
                $this->data['titulo_pagina'] = 'Detalles del '.$this->singular;
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Detalles del '.$this->singular
                );
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->ver_permiso($this->controller.'_crear', Auth::user());
        $this->_load_data();
        $this->load_plugin('datatable');
        return view($this->url_views.'index', $this->data);
    }

    /**
     * Función para configurar y mostrar el listado de registros
     */
    public function list()
    {
        // Obtener los registros de la base de datos
        $registros = Tipo_nota::orderBy('descripcion', 'asc')->get();

        // Formatear los registros para adaptar los valores a mostrar en el listado
        $valores = array();
        foreach ($registros as $r)
        {
            $valores[$r->id] = array(
                'descripcion' => $r->descripcion
            );
        }
        unset($registros);
        
        // Configuración de del listado
        $user = Auth::user();
        $listado = array(
            'listado_id'    => $this->controller,
            'controlador'   => $this->controller,
            'registros'     => $valores,
            'no_order'      => array(), // array('name'),
            'opciones'      => array(
                'detalles'  => Backend::tiene_permiso($this->controller.'_crear', $user->rol_id),
                'editar'    => Backend::tiene_permiso($this->controller.'_editar', $user->rol_id),
                'eliminar'  => Backend::tiene_permiso($this->controller.'_eliminar', $user->rol_id),
            ),
            'mensaje'       => 'No se han cargado '.strtolower($this->contenido).'.',
            'mensaje_eliminar' => '¿Seguro que desea eliminar el '.$this->singular.'?'
        );
        Backend::datatable($listado);
    }

    /**
     * Función para verificar la eliminación de un registro
     */
    public function verify()
    {
        // Por el momento no hay restricciones para eliminar
        echo 1;
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
    public function delete(Request $request)
    {
        $this->ver_permiso($this->controller.'_eliminar', Auth::user());
        $id = $request->input('id');
        $r = Tipo_nota::find($id);
        if ($r)
        {
            $r->delete();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ver_permiso($this->controller.'_crear', Auth::user());
        // Data
        $this->_load_data('create');
        $this->_data_to_form();
        // View
        return view($this->url_views.'create', $this->data);
    }

    /**
     * Función para cargar la información necesaria en formato correcto para el formulario
     */
    private function _data_to_form($id = 0)
    {
        if ($id > 0)
        {
            // Obtener los datos del registro
            $this->data['r'] = Tipo_nota::find($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $validate = $this->validate($request, [
            'descripcion' => 'required'
        ]);

        // Crear el nuevo registro
        $r = new Tipo_nota();
        $r->descripcion = $request->input('descripcion');
        $r->save();

        return redirect()->route($this->controller.'.index')->with([
            'mensaje' => 'El '.$this->singular.' se ha agregado correctamente.'
        ]);
    }
     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->ver_permiso($this->controller.'_crear', Auth::user());
        $this->_load_data('show');
        // Obtener los datos del registro
        $this->data['r'] = Tipo_nota::find($id);

        // Mostrar la vista
        return view($this->url_views.'show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ver_permiso($this->controller.'_editar', Auth::user());
        // Data
        $this->_load_data('edit');
        $this->_data_to_form($id);
        // View
        return view($this->url_views.'edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación
        $validate = $this->validate($request, [
            'descripcion'    => 'required'
        ]);

        // Modificar el registro
        $r = Tipo_nota::find($id);
        $r->descripcion = $request->input('descripcion');
        $r->update();

        return redirect()->route($this->controller.'.index')->with([
            'mensaje' => 'El '.$this->singular.' se ha editado correctamente.'
        ]);
    }
}