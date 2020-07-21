<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Helpers\Backend;

use App\Models\Informe_avances;
use App\Models\Becario;


class Informes_avancesController extends Controller
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
        $this->controller   = 'informes_avances';
        $this->url_views    = 'backend.'.$this->controller.'.';
        $this->contenido    = 'Informes tecnicos de avances';
        $this->singular     = 'informe técnico de avances';
    }

    /**
     * Función para cargar todos los datos necesarios en el array $this->data
     */
    private function _load_data($page = 'index')
    {
        $this->data['controller']   = $this->controller;
        $this->data['user']         = Auth::user();
        $this->data['contenido']    = $this->contenido;
        $this->data['singular']     = $this->singular;
        $this->data['active'][$this->controller] = true;

        // Migas de pan (breadcrumb)
        $title = $this->contenido;
        switch($page)
        {
            case 'index': 
                $this->data['icono_pagina']  = 'fas fa-tasks';
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
        $registros = Informe_avances::orderBy('id', 'desc')->get(['id', 'anio', 'proyecto', 'updated_at']);

        // Formatear los registros para adaptar los valores a mostrar en el listado
        $valores = array();
        foreach ($registros as $r)
        {
            $valores[$r->id] = array(
                'anio'      => $r->anio,
                'proyecto'  => $r->proyecto,
                'fecha'     => Backend::fecha_formato_listado($r->updated_at)
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
            'alinear'       => array(),
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
        $r = Informe_avances::find($id);
        if ($r)
        {
            // Quitar relaciones con becarios
            DB::table('informes_avances_becarios')
                    ->where('informe_avance_id', '=', $id)
                    ->delete();

            // Eliminar el informe
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
        // Plugins
        $this->load_plugin('select2');
        $this->load_plugin('ckeditor');
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
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
        $this->data['directores'] = DB::table('users')->where('rol_id', '=', 2)->get(['id', 'name']);
        $becarios = DB::table('users')->where('rol_id', '>', 2)->get(['id', 'name', 'email']);
        if ($id > 0)
        {
            // Obtener los datos del registro
            $r = Informe_avances::find($id);
            $this->data['r'] = $r;
            // Becarios asociados
            foreach ($becarios as $b)
            {
                $b->selected = false;
                $asociado = DB::table('informes_avances_becarios')
                            ->where('usuario_id', '=', $b->id)
                            ->where('informe_avance_id', '=', $id)
                            ->count();
                if ($asociado) { $b->selected = true; }
            }
        }
        $this->data['becarios'] = $becarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = array(
            'anio'              => 'required',
            'proyecto'          => 'required',
            'codigo_proyecto'   => 'required',
            'componente'        => 'required',
            'universidad'       => 'required',
            'director_proyecto_id' => 'required',
            'periodo_informe'   => 'required',
            'fecha_ita'         => 'required',
            'resultados_pa'     => 'required',
            'grado_avance'      => 'required',
            'analisis_causal'   => 'required',
            'ajustes'           => 'required',
            'sintesis'          => 'required',
            'avance_transferencia' => 'required',
            'presupuesto_estado'=> 'required',
            'acciones_gastos'   => 'required',
            'comentarios'       => 'required',
            'anexos'            => 'required'
        );
        // Validación
        $this->validate($request, $campos);

        // Crear el nuevo registro
        $r = new Informe_avances();
        foreach ($campos as $campo => $validate)
        {
            $r->$campo = $request->input($campo);
        }
        $r->save();

        // Asociar becarios
        $becarios = DB::table('users')->where('rol_id', '>', 2)->get(['id']);
        foreach ($becarios as $b)
        {
            $becario_activo = $request->input('check_becario_'.$b->id);
            if ($becario_activo == 'on')
            {
                $becario = new Becario();
                $becario->usuario_id = $b->id;
                $becario->informe_avance_id = $r->id;
                $becario->save();
            }
        }

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
        // Plugins
        $this->load_plugin('print');
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
        
        // Data
        $this->_load_data('show');
        $this->_data_to_form($id);
        $this->data['tags'] = (object) Config::get('backend.tags');
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
        // Plugins
        $this->load_plugin('select2');
        $this->load_plugin('ckeditor');
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
        
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
        $campos = array(
            'anio'              => 'required',
            'proyecto'          => 'required',
            'codigo_proyecto'   => 'required',
            'componente'        => 'required',
            'universidad'       => 'required',
            'director_proyecto_id' => 'required',
            'periodo_informe'   => 'required',
            'fecha_ita'         => 'required',
            'resultados_pa'     => 'required',
            'grado_avance'      => 'required',
            'analisis_causal'   => 'required',
            'ajustes'           => 'required',
            'sintesis'          => 'required',
            'avance_transferencia' => 'required',
            'presupuesto_estado'=> 'required',
            'acciones_gastos'   => 'required',
            'comentarios'       => 'required',
            'anexos'            => 'required'
        );
        // Validación
        $this->validate($request, $campos);

        // Modificar el registro
        $r = Informe_avances::find($id);
        foreach ($campos as $campo => $validate)
        {
            $r->$campo = $request->input($campo);
        }
        $r->update();

        // Asociar becarios
        $becarios = DB::table('users')->where('rol_id', '>', 2)->get(['id']);
        foreach ($becarios as $b)
        {
            // Verificar si ya esta asociado en DB
            $asociado = DB::table('informes_avances_becarios')
                            ->where('usuario_id', '=', $b->id)
                            ->where('informe_avance_id', '=', $id)
                            ->count();
            // Activo en el Form
            $becario_activo = $request->input('check_becario_'.$b->id);
            // Si esta activo, pero no esta asociado, insertar
            if ($becario_activo == 'on' && !$asociado)
            {
                $becario = new Becario();
                $becario->usuario_id = $b->id;
                $becario->informe_avance_id = $r->id;
                $becario->save();
            }
            // Si no esta activo, pero si esta asociado, eliminar
            if (!$becario_activo && $asociado)
            {
                DB::table('informes_avances_becarios')
                    ->where('usuario_id', '=', $b->id)
                    ->where('informe_avance_id', '=', $id)
                    ->delete();
            }
        }

        return redirect()->route($this->controller.'.index')->with([
            'mensaje' => 'El '.$this->singular.' se ha editado correctamente.'
        ]);
    }
}