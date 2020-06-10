<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    public $data;
    public $online;
    public $admin_url;
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Configuración dependiedo si la App esta ONLINE
        $this->data['online'] = Config::get('backend.online');
        // Nombre de la aplicación backend
        $this->data['backend_name'] = Config::get('backend.backend_name');
        // Cargar las etiquetas de campos de la aplicación
        $this->data['tags'] = Config::get('backend.tags');
        // URL del Panel de control y Archivos
        $this->data['admin_url'] = $this->admin_url = Config::get('backend.admin_url');
        $this->data['files_url'] = $this->files_url = Config::get('backend.files_url');
    }

    /**
     * Función para cargar plugins necesarios para el funcionamiento del sitio en $this->data['css'] y $this->data['js']
     */
    public function load_plugin($plugin)
    {
        switch ($plugin)
        {
            case 'datatable':
                $this->data['js'][] = 'bk/js/listados.js';
                $this->data['js'][] = 'bk/plugins/datatables/datatables.min.js';
                $this->data['js'][] = 'bk/plugins/datatables/datatables.config.js';
                $this->data['css'][] = 'bk/plugins/datatables/datatables.min.css';
                break;
            case 'select2':
                $this->data['js'][] = 'bk/plugins/select2/js/select2.full.min.js';
                $this->data['js'][] = 'bk/plugins/select2/js/select2.min.js';
                $this->data['js'][] = 'bk/plugins/select2/js/i18n/es.js';
                $this->data['css'][] = 'bk/plugins/select2/css/select2.min.css';
                break;
            case 'html5editor':
                $this->data['js'][]  = 'bk/plugins/html5-editor/wysihtml5-0.3.0.js';
                $this->data['js'][]  = 'bk/plugins/html5-editor/bootstrap-wysihtml5.js';
                $this->data['css'][] = 'bk/plugins/html5-editor/bootstrap-wysihtml5.css';
                break;
            case 'echarts':
                $this->data['js'][]  = 'bk/plugins/echarts/echarts.min.js';
                break;
            case 'fileinput':
                $this->data['js'][]  = 'bk/plugins/file-input/jasny-bootstrap.min.js';
                $this->data['css'][] = 'bk/plugins/file-input/jasny-bootstrap.min.css';
                break;
        }
    }

    /**
     * Función para limpiar un string de caracteres especiales
     */
    public function limpiar_string($string = '')
    {
        $string = trim($string);
        $string = strip_tags($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        // Escapar el salto de línea
        $string = str_replace(
            array('\r\n', '\n\r', '\r', '\n', chr(13), chr(10), ','),
            '',
            $string
        );

        // Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array(
                "\\", "¨", "º", "~", "/", " ",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "?", "'", "¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";"
            ),
            '-',
            $string
        );

        $string = str_replace('--', '-', $string);
        $string = str_replace('--', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
