<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Backend;

use App\Models\Informe_comun;
use App\Models\Informe_comun_imagen;

class Informes_comunesController extends Controller
{
    public $data;
    public $controller;
    public $url_views;
    public $contenido;
    public $singular;
    public $filepath;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth'); // Autenticación
        $this->controller   = 'informes_comunes';
        $this->url_views    = 'backend.'.$this->controller.'.';
        $this->contenido    = 'Informes comunes';
        $this->singular     = 'informe común';
        $this->filepath     = 'images/'.$this->controller.'/';
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
        $this->data['active']['informes'] = true;
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
        $registros = Informe_comun::orderBy('titulo', 'asc')->get();

        // Formatear los registros para adaptar los valores a mostrar en el listado
        $valores = array();
        foreach ($registros as $r)
        {
            $valores[$r->id] = array(
                'titulo'    => $r->titulo,
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
        $r = Informe_comun::find($id);
        if ($r)
        {
            // Eliminar las imágenes asociadas
            $imagenes = array('banner', 'banner_mobile', 'logo');
            foreach ($imagenes as $imagen)
            {
                if ($r->$imagen != '')
                {
                    $path = './'.$this->filepath.$r->$imagen;
                    if (file_exists($path)) { unlink($path); }
                }
            }
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
        $this->load_plugin('ckeditor');
        $this->load_plugin('fileinput');
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
            $r = Informe_comun::find($id);
            $r->texto = str_replace("\r\n", '<br>', $r->texto);
            $this->data['r'] = $r;

            // Verificar si existen las imágenes
            $imagenes_db = $r->imagenes;
            $imagenes = array();
            foreach ($imagenes_db as $img)
            {
                $path = '/'.$this->filepath.$img->imagen;
                if ($img->imagen != '' && file_exists('.'.$path))
                {
                    $imagenes[] = $this->files_url.$path;
                }
            }
            $this->data['imagenes'] = (object) $imagenes;
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
        $this->validate($request, [
            'titulo'    => 'required',
            'texto'     => 'required'
        ]);

        // Crear el nuevo registro
        $r = new Informe_comun();
        $r->titulo          = $request->input('titulo');
        $r->texto           = $request->input('texto');
        $r->usuario_id      = Auth::user()->id;
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
        // Plugins
        $this->load_plugin('print');
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
        
        $this->_load_data('show');
        // Obtener los datos del registro
        $this->data['r'] = Informe_comun::find($id);

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
        $this->load_plugin('ckeditor');
        $this->load_plugin('fileinput');
        $this->data['js'][] = 'bk/js/'.$this->controller.'.js';
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
        $this->validate($request, [
            'titulo'    => 'required',
            'texto'     => 'required'
        ]);

        // Modificar el registro
        $r = Informe_comun::find($id);
        $r->titulo      = $request->input('titulo');
        $r->texto       = $request->input('texto');
        $r->usuario_id  = Auth::user()->id;
        $r->update();

        return redirect()->route($this->controller.'.show', $r)->with([
            'mensaje' => 'El '.$this->singular.' se ha editado correctamente.'
        ]);
    }

    /**
     * Función para subir una imagen y asociar al informe comun
     */
    public function images_add(Request $request)
    {
        $this->ver_permiso($this->controller.'_editar', Auth::user());
        // Validación
        $this->validate($request, [
            'informe_comun_id'  => 'required',
            'nueva_imagen'      => 'required|image'
        ]);
        $informe_comun_id = $request->input('informe_comun_id');

        // Subir imagen
        if ($request->hasFile('nueva_imagen'))
        {
            $imagen = $request->file('nueva_imagen');
            // Guardar en DB
            $r = new Informe_comun_imagen();
            $r->informe_comun_id = $informe_comun_id;
            $r->imagen = $imagen->getClientOriginalName();
            $r->save();

            // Guardar la imagen en Storage
            if ($r->id > 0) 
            {
                $imagen->storeAs($this->controller, $r->id.'_'.$r->imagen);
            }
        }
    }

    /**
     * Función para mostrar el listado de imágenes asociadas al informe comun
     */
    public function images_list(Request $request)
    {
        // Obtener las imágenes asociadas al inform común
        $this->data['imagenes'] = Informe_comun_imagen::where('informe_comun_id', $request->input('id'))
            ->orderBy('id', 'desc')
            ->get();
        $this->data['view'] = $request->input('view');
        // View
        return view($this->url_views.'images_list', $this->data);
    }

    /**
     * Función para eliminar una imagen asociada al informe común
     */
    public function images_delete(Request $request)
    {
        $this->ver_permiso($this->controller.'_editar', Auth::user());
        $id = $request->input('id');
        $r = Informe_comun_imagen::findOrFail($id);

        // Eliminar la imagen física
        if(Storage::delete($this->controller.'/'.$r->id.'_'.$r->imagen)) 
        {
            // Eliminar la imagen de DB
            $r->delete();
        }
    }
}