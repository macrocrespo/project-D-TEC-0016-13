<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
 
class Backend {

    /**
     * Función para crear un panel HTML
     */
    public static function card($data = array()) 
    {
        // Opciones
        $data['icon']   = (isset($data['icon']))    ? $data['icon']  : '';
        $data['title']  = (isset($data['title']))   ? $data['title'] : '';
        $data['min']    = (isset($data['min']))     ? $data['min']   : false;
        $data['max']    = (isset($data['max']))     ? $data['max']   : true;
        $data['close']  = (isset($data['close']))   ? $data['close'] : false;

        echo view('helpers.backend.card', $data);
    }

    /**
     * Función para cerrar un panel HTML
     */
    public static function endcard()
    {
        echo '</div></div>';
    }

    /**
     * Función para generar el html de un listado con datatables
     */
    public static function datatable($data = array())
    {
        //dd($data);
        $data['admin_url'] = Config::get('backend.admin_url');
        // Obtener los nombres de los campos // columnas del listado
        $registros = $data['registros'];
        $campos = array();
        if (count($registros) > 0)
        {
            $campos = array_keys(array_values($registros)[0]);
            $data['campos'] = $campos;
        }

        // Cargar las etiquetas de campos de la aplicación
        $data['tags'] = Config::get('backend.tags');
        foreach ($campos as $campo)
        {
            if (!isset($data['tags'][$campo])) { $data['tags'][$campo] = 'Falta etiqueta para "'.$campo.'"'; }
        }

        // Opciones
        $data['no_order']   = (isset($data['no_order']))    ? $data['no_order'] : array();  // Columnas para ocultar ordenamiento
        $data['ancho']      = (isset($data['ancho']))       ? $data['ancho']    : array();  // Ancho de Columnas
        $data['alinear']    = (isset($data['alinear']))     ? $data['alinear']  : array();  // Alinear Columnas
        $data['titulo']     = (isset($data['titulo']))      ? $data['titulo']   : '';       // Título del listado
        $data['mensaje']    = (isset($data['mensaje']))     ? $data['mensaje']  : 'No se han encontrado resultados.'; // Mensaje por defecto
        
        echo view('helpers.backend.datatable', $data);
    }

    /**
     * Función para generar el html de un botón de creación
     */
    public static function btn_create($data = array())
    {
        echo view('helpers.backend.btn_create', $data);
    }

    /**
     * Convierte la fecha "2017-12-31 23:30:59" en "31-12-2017 23:30"
     * @param type $fecha
     * @param type $solo_fecha
     * @return type
     */
    public static function fecha_formato_listado($fecha = '', $solo_fecha = true, $recortar_anio = false)
    {
        $date = date_create($fecha);
        $anio = ($recortar_anio) ? 'y' : 'Y';
        return ($solo_fecha) ? $date->format('d/m/'.$anio) : $date->format('d/m/'.$anio.' H:i');
    }

    /**
     * Convierte la fecha "31-12-2017" en "2017-12-31"
     * @param type $fecha
     * @param type $fin_de_dia
     * @return type
     */
    public static function fecha_formato_db($fecha = '', $fin_de_dia = 0)
    {
        $fecha_db = explode('-', $fecha);
        $horario = ($fin_de_dia) ? '23:59:59' : '00:00:00';
        return (count($fecha_db) == 3) ? $fecha_db[2].'-'.$fecha_db[1].'-'.$fecha_db[0].' '.$horario : null;
    }

    /**
     * Función para generar una fecha en formato de exportación AAAAMMDD
     */
    public static function fecha_formato_export($fecha = '')
    {
        $fecha_db = explode(' ', $fecha);
        $fecha_db = str_replace('-', '', $fecha_db[0]);
        return (strlen($fecha_db) == 8) ? $fecha_db : '        ';
    }

    /**
     * Función para generar el HTML de un input text
     * @param type $name Ejemplo: titulo
     * @param type $params = array(icon, type, value, id, required, size, readonly)
     */
    public static function form_input_text($name = '', $params = array())
    {
        $html = '';
        if ($name != '')
        {
            $data['tags'] = Config::get('backend.tags');
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'          => $name,
                'label'         => $label,
                'type'          => isset($params['type'])           ? $params['type'] : 'text',
                'value'         => isset($params['value'])          ? $params['value'] : '',
                'id'            => isset($params['id'])             ? $params['id'] : $name,
                'required'      => isset($params['required'])       ? $params['required'] : true,
                'error_txt'     => isset($params['error_txt'])      ? $params['error_txt'] : 'Debe ingresar el '.$label,
                'readonly'      => isset($params['readonly'])       ? $params['readonly'] : false,
                'placeholder'   => isset($params['placeholder'])    ? $params['placeholder'] : false,
                'size'          => isset($params['size'])           ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_input_text', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un input file
     * @param type $name Ejemplo: imagen
     * @param type $params = array(tipo, file_url, required, mensaje, id, form_group, size)
     * @return string
     */
    public static function form_input_file($name = '', $params = array()) 
    {
        $html = '';
        $type = isset($params['type']) ? $params['type'] : 'image';
        if ($name != '' && ($type == 'image' || $type == 'file'))
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $accept = ($type == 'image') ? '.jpg,.jpeg,.gif,.png' : '.pdf,.doc,.docx,.xls,.xlsx';
            $help = ($type == 'image') ? 'La imagen debe ser JPG, GIF o PNG.' : 'El archivo debe ser PDF, WORD o EXCEL.';
            $data = array(
                'name'      => $name,
                'type'      => $type,
                'label'     => $label,
                'icon'      => $type,
                'file_url'  => isset($params['value'])      ? $params['value'] : '',
                'file_name' => isset($params['value'])      ? basename($params['value']) : '',
                'accept'    => isset($params['accept'])     ? $params['accept'] : $accept,
                'id'        => isset($params['id'])         ? $params['id'] : $name,
                'help'      => isset($params['help'])       ? $params['help'] : $help,
                'required'  => isset($params['required'])   ? $params['required'] : false,
                'error_txt' => isset($params['error_txt'])  ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'size'      => isset($params['size'])       ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_input_file', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un input radio
     * @param type $name Ejemplo: activo
     * @param type $params = array(options (array), required, size)
     * @param type $options array de option Ejemplo: (object) array('id' => 'activo1', 'value' => 1, 'text' => 'Si', 'checked' => true)
     * @return type
     */
    public static function form_input_radio($name = '', $params = array()) 
    {
        $html = '';
        $options = isset($params['options']) ? $params['options'] : array();
        if ($name != '' && !empty($options))
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'      => $name,
                'options'   => $options,
                'id'        => isset($params['id'])         ? $params['id'] : $name,
                'label'     => $label,
                'required'  => isset($params['required'])   ? $params['required'] : true,
                'error_txt' => isset($params['error_txt'])  ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'size'      => isset($params['size'])       ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_input_radio', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un textarea
     * @param type $name Ejemplo: texto
     * @param type $params = array(icon, value, id, required, size)
     */
    public static function form_textarea($name = '', $params = array())
    {
        $html = '';
        if ($name != '')
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'      => $name,
                'label'     => $label,
                'value'     => isset($params['value'])      ? $params['value'] : '',
                'id'        => isset($params['id'])         ? $params['id'] : $name,
                'editor'    => isset($params['editor'])     ? $params['editor'] : false,
                'height'    => isset($params['height'])     ? $params['height'] : 200,
                'required'  => isset($params['required'])   ? $params['required'] : true,
                'readonly'  => isset($params['readonly'])   ? $params['readonly'] : false,
                'error_txt' => isset($params['error_txt'])  ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'size'      => isset($params['size'])       ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_textarea', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un input text
     * @param type $name Ejemplo: rol_id
     * @param type $params = array(icon, options (array), message_empty, value, id, required, size)
     * @return string
     */
    public static function form_select($name = '', $params = array()) 
    {
        $html = '';
        if ($name != '')
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'          => $name,
                'options'       => isset($params['options'])        ? $params['options'] : false,
                'db'            => isset($params['db'])             ? $params['db'] : false,
                'db_value'      => isset($params['db_value'])       ? $params['db_value'] : 'id',
                'db_text'       => isset($params['db_text'])        ? $params['db_text'] : 'nombre',
                'keys'          => isset($params['keys'])           ? $params['keys'] : true,
                'label'         => $label,
                'message_empty' => isset($params['message_empty'])  ? $params['message_empty'] : '',
                'value_selected'=> isset($params['value'])          ? $params['value'] : '',
                'id'            => isset($params['id'])             ? $params['id'] : $name,
                'required'      => isset($params['required'])       ? $params['required'] : true,
                'error_txt'     => isset($params['error_txt'])      ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'disabled'      => isset($params['disabled'])       ? $params['disabled'] : false,
                'multiple'      => isset($params['multiple'])       ? $params['multiple'] : false,
                'size'          => isset($params['size'])           ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_select', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un Input check
     * @param type $name
     * @param type $params = array(checked, id, required, size)
     * @return type
     */
    public static function form_input_check($name = '', $params = array())
    {
        $html = '';
        if ($name != '')
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'      => $name,
                'label'     => $label,
                'checked'   => isset($params['checked'])    ? $params['checked'] : false,
                'text'      => isset($params['text'])       ? $params['text'] : '',
                'id'        => isset($params['id'])         ? $params['id'] : $name,
                'required'  => isset($params['required'])   ? $params['required'] : true,
                'error_txt' => isset($params['error_txt'])  ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'size'      => isset($params['size'])       ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_input_check', $data);
        }
        echo $html;
    }

    /**
     * Función para generar el HTML de un DatePicker
     * @param type $name
     * @param type $params
     * @return type
     */
    public static function form_datepicker($name = '', $params = array())
    {
        $html = '';
        if ($name != '')
        {
            $labels = Config::get('backend.tags');
            $label = isset($labels[$name]) ? $labels[$name] : 'Etiqueta para "'.$name.'"';
            $data = array(
                'name'      => $name,
                'label'     => $label,
                'icon'      => isset($params['icon'])       ? $params['icon'] : ' fa fa-angle-right',
                'value'     => isset($params['value'])      ? $params['value'] : date("d-m-Y"),
                'id'        => isset($params['id'])         ? $params['id'] : $name,
                'required'  => isset($params['required'])   ? $params['required'] : true,
                'error_txt' => isset($params['error_txt'])  ? $params['error_txt'] : 'Debe ingresar el '.strtolower($label),
                'daterange' => isset($params['daterange'])  ? $params['daterange'] : false,
                'size'      => isset($params['size'])       ? $params['size'] : 12 // col-md-12
            );
            $html = view('helpers.backend.form_datepicker', $data);
        }
        echo $html;
    }

    /**
     * Función para mostrar el cuerpo del modal de la imagen ampliada
     */
    public static function modal_ampliar_imagen()
    {
        echo view('helpers.backend.modal_ampliar_imagen');
    }

    /**
     * Función para mostrar las acciones de un formulario
     */
    public static function form_actions($action = 'create', $link = '')
    {
        $data['link'] = $link;
        $data['back'] = true;
        switch ($action)
        {
            case 'create':
                $data['class']          = 'success'; 
                $data['icon']           = 'fas fa-plus-circle';
                $data['action_text']    = 'Agregar';
            break;
            case 'edit':
                $data['class']          = 'warning'; 
                $data['icon']           = 'fas fa-pencil-alt';
                $data['action_text']    = 'Editar';
            break;
            case 'show':
                $data['class']          = 'info'; 
                $data['icon']           = 'fas fa-pencil-alt';
                $data['action_text']    = 'Editar';
            break;
        }
        echo view('helpers.backend.form_actions', $data);
    }

    /**
     * Función para generar una fila de información en el panel de detalles
     * @param type $registro
     * @param type $campo
     * @param type $params
     * @return type
     */
    public static function row_details($registro, $campo = '', $params = array())
    {
        $html = '';
        if (isset($params['value'])) { $value = $params['value']; }
        else 
        {
            $value = isset($registro->$campo) ? $registro->$campo : '-';
            if (!$value) { $value = '-'; }
            if (isset($params['table'])) { $value = isset($params['table'][$value]) ? $params['table'][$value] : '-'; }
        }
        if ($registro && $campo != '')
        {
            $labels = Config::get('backend.tags');
            $data = array(
                'campo'     => $campo,
                'value'     => $value,
                'label'     => isset($labels[$campo])       ? $labels[$campo]       : 'Etiqueta para "'.$campo.'"',
                'link'      => isset($params['link'])       ? $params['link']       : '',
                'prefix'    => isset($params['prefix'])     ? $params['prefix']     : '',
                'suffix'    => isset($params['suffix'])     ? $params['suffix']     : '',
                'class'     => isset($params['class'])      ? $params['class']      : '',
                'width'     => isset($params['width'])      ? $params['width']      : '',
                'imagen'    => isset($params['imagen'])     ? true : false,
                'archivo'   => isset($params['archivo'])    ? true : false
            );
            $html = view('helpers.backend.row_details', $data);
        }
        echo $html;
    }
}