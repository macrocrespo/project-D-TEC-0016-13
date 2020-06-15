<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Backend;

use App\Models\User;
use App\Models\Rol;

class UsuariosController extends Controller
{
    public $data;
    public $controller;
    public $filepath;
    public $codigos_perfil;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth'); // Autenticación
        $this->controller = 'usuarios';
        $this->filepath = 'images/usuarios/';
        $this->codigos_perfil = array(
            'D-TEC 0016/13-C5-DR',
            'D-TEC 0016/13-C5- PA',
            'D-TEC 0016/13-C5-PAF 10'
        );
    }

    /**
     * Función para cargar todos los datos necesarios en el array $this->data
     */
    private function _load_data($page = 'index')
    {
        $title = 'Usuarios';
        $this->data['controller'] = $this->controller;
        $this->data['user']  = Auth::user(); // Cargar el usuario registrado
        $this->data['active'][$this->controller] = true;
        // Migas de pan (breadcrumb)
        switch($page)
        {
            case 'index': 
                $this->data['icono_pagina']  = 'fas fa-users';
                $this->data['titulo_pagina'] = $title;
                $this->data['breadcrumb'] = array(
                    '-' => $title
                );
                break;
            case 'create': 
                $this->data['icono_pagina']  = 'fas fa-plus-circle';
                $this->data['titulo_pagina'] = 'Agregar usuario';
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Agregar usuario'
                );
                break;
            case 'edit': 
                $this->data['icono_pagina']  = 'fas fa-pencil-alt';
                $this->data['titulo_pagina'] = 'Editar usuario';
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Editar usuario'
                );
                break;
            case 'show': 
                $this->data['icono_pagina']  = 'fas fa-check-circle';
                $this->data['titulo_pagina'] = 'Detalles del usuario';
                $this->data['breadcrumb'] = array(
                    $this->controller.'.index' => $title,
                    '-' => 'Detalles del usuario'
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
        $this->_load_data();
        $this->load_plugin('datatable');
        return view('backend.usuarios.index', $this->data);
    }

    /**
     * Función para configurar y mostrar el listado de registros
     */
    public function list()
    {
        $user = Auth::user();
        // Obtener los registros de la base de datos
        $registros = ($user->rol_id == 1) ? 
                        User::orderBy('name', 'asc')->get() : 
                        User::where('rol_id','>', 1)->orderBy('name', 'asc')->get();

        // Formatear los registros para adaptar los valores a mostrar en el listado
        $valores = array();
        foreach ($registros as $r)
        {
            $valores[$r->id] = array(
                'imagen' => '<img class="img-list" src="'.asset('bk/images/users/user'.$r->id.'.png').'" />',
                'name' => $r->name,
                'email' => $r->email,
                'rol_id' => $r->rol->nombre
            );
        }
        unset($registros);
        
        // Configuración de del listado
        $listado = array(
            'listado_id'    => $this->controller,
            'controlador'   => $this->controller,
            'registros'     => $valores,
            'no_order'      => array(), // array('name'),
            'alinear'       => array('imagen'=>'center'),
            'opciones'      => array(
                'detalles'  => true,
                'editar'    => true,
                'eliminar'  => true
            ),
            'mensaje'       => 'No se han cargado usuarios.',
            'mensaje_eliminar' => '¿Seguro que desea eliminar el usuario?'
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        if ($user)
        {
            $user->delete();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Plugins
        $this->load_plugin('select2');
        // Data
        $this->_load_data('create');
        $this->_data_to_form();
        // View
        return view('backend.usuarios.create', $this->data);
    }

    /**
     * Función para cargar la información necesaria en formato correcto para el formulario
     */
    private function _data_to_form($id = 0)
    {
        // Obtener los datos de los roles
        $this->data['roles'] = Rol::orderBy('nombre', 'asc')->get();
        $this->data['codigos_perfil'] = $this->codigos_perfil;
        if ($id > 0)
        {
            // Obtener los datos del usuario
            $this->data['r'] = User::find($id);
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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id'    => 'required'
        ]);

        // Crear el nuevo registro
        $r = new User();
        $r->name            = $request->input('name');
        $r->email           = $request->input('email');
        $r->domicilio       = $request->input('domicilio');
        $r->codigo_perfil   = $request->input('codigo_perfil');
        $r->rol_id          = $request->input('rol_id');
        $r->password        = Hash::make($request->input('password'));
        $r->save();

        return redirect()->route('usuarios.index')->with([
            'mensaje' => 'El usuario se ha agregado correctamente.'
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
        $this->_load_data('show');
        // Obtener los datos de la promoción
        $this->data['r'] = User::find($id);

        // Mostrar la vista
        return view('backend.usuarios.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Plugins
        $this->load_plugin('select2');
        // Data
        $this->_load_data('edit');
        $this->_data_to_form($id);
        // View
        return view('backend.usuarios.edit', $this->data);
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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rol_id'    => 'required'
        ]);

        // Modificar el registro
        $r = User::find($id);
        $r->name            = $request->input('name');
        $r->email           = $request->input('email');
        $r->domicilio       = $request->input('domicilio');
        $r->codigo_perfil   = $request->input('codigo_perfil');
        $r->rol_id          = $request->input('rol_id');
        $r->update();

        return redirect()->route('usuarios.index')->with([
            'mensaje' => 'El usuario se ha editado correctamente.'
        ]);
    }
}
