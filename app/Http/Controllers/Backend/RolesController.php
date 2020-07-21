<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Backend;
use Illuminate\Support\Facades\DB;

use App\Models\Rol;
use App\Models\User;
use App\Models\Permiso;

class RolesController extends Controller
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
        $this->controller   = 'roles';
        $this->url_views    = 'backend.'.$this->controller.'.';
        $this->contenido    = 'Roles';
        $this->singular     = 'rol';
    }

    /**
     * Función para cargar todos los datos necesarios en el array $this->data
     */
    private function _load_data($page = 'index')
    {
        $this->data['controller']   = $this->controller;
        $this->data['user']         = Auth::user(); // Cargar el Tipo de rol registrado
        $this->data['contenido']    = $this->contenido;
        $this->data['singular']     = $this->singular;
        $this->data['active'][$this->controller] = true;

        // Migas de pan (breadcrumb)
        $title = $this->contenido;
        switch($page)
        {
            case 'index': 
                $this->data['icono_pagina']  = 'fas fa-user-circle';
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
        $user = Auth::user();
        // Obtener los registros de la base de datos
        $registros = ($user->rol_id == 1) ? 
                        Rol::orderBy('nombre', 'asc')->get() : 
                        Rol::where('id','>', 1)->orderBy('nombre', 'asc')->get();

        // Formatear los registros para adaptar los valores a mostrar en el listado
        $valores = array();
        foreach ($registros as $r)
        {
            $valores[$r->id] = array(
                'nombre'        => $r->nombre,
                'descripcion'   => $r->descripcion
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
    public function verify(Request $request)
    {
        // No se puede eliminar un rol si tiene usuarios asociados
        $id = $request->input('id');
        $usuarios = User::where('rol_id', $id)->count();
        echo ($usuarios == 0) ? 1 : 0;
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
        $r = Rol::find($id);
        if ($r)
        {
            // Eliminar los permisos asociados
            DB::table('roles_permisos')->where('rol_id', '=', $id)->delete();
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
            $r = Rol::find($id);
            $this->data['r'] = $r;
            
            // Permisos
            $permisos_rol = array();
            foreach ($r->permisos as $p)
            {
                $permisos_rol[] = $p->nombre;
            }

            $permisos_db = Permiso::orderBy('id', 'asc')->get();
            $permisos = array();
            foreach ($permisos_db as $p)
            {
                $permisos[$p->nombre] = $p->descripcion;
            }
            // Parámetros de los inputs
            $this->data['params'] = array(
                'permisos'      => $permisos,
                'permisos_rol'  => $permisos_rol
            );
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
            'nombre'        => 'required',
            'descripcion'   => 'required'
        ]);

        // Crear el nuevo registro
        $r = new Rol();
        $r->nombre      = $request->input('nombre');
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
        $this->data['r'] = Rol::find($id);

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
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
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
            'nombre'        => 'required',
            'descripcion'   => 'required',
        ]);

        // Modificar el registro
        $r = Rol::find($id);
        $r->nombre      = $request->input('nombre');
        $r->descripcion = $request->input('descripcion');
        $r->update();

        return redirect()->route($this->controller.'.index')->with([
            'mensaje' => 'El '.$this->singular.' se ha editado correctamente.'
        ]);
    }

    public function permiso(Request $request)
    {
        $this->ver_permiso($this->controller.'_editar', Auth::user());
        $id             = $request->input('id');
        $permiso_nombre = $request->input('permiso');
        $value          = $request->input('value');

        // Obtener el ID del permiso
        $permiso = Permiso::where('nombre', '=', $permiso_nombre)->first(['id']);
        if ($permiso)
        {
            if ($value) // Si $value = 1 => Eliminar el permiso de la DB
            { 
                DB::table('roles_permisos')
                ->where('rol_id', '=', $id)
                ->where('permiso_id', '=', $permiso->id)
                ->delete();
            }
            else // Si $value = 0 => Agregar el permiso en DB
            {
                DB::table('roles_permisos')->insert([
                    'rol_id' => $id, 
                    'permiso_id' => $permiso->id
                ]);
            }
        }
    }
}