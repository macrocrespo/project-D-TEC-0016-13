@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{ Backend::card(array('title'=>'Listado de '.strtolower($contenido), 'icon'=>'fa fa-angle-double-right')) }}
                <p class="text-muted m-b-20">Desde aquí puede agregar, editar y eliminar {{ strtolower($contenido) }}.</p>

                <?php Backend::btn_create(array('route'=>$controller.'.create', 'text'=>'Agregar '.$singular)); ?>
                <div class="m-t-20"></div>
                <div id="loading"><i class="fa fa-spinner fa-spin text-info"></i></div>
                <div id="listado_wrapper"></div>
            {{ Backend::endcard() }}
        </div>
    </div>
</div>

<script>
// VARIABLES NECESARIAS PARA LA CARGA DEL LISTADO
// Bandera para habilitar la carga del listado
var cargar_listado = true;
// Controlador primario, para cargar el listado, verificar y eliminar dentro del mismo controlador
var controller = '{{ $controller }}'; 
// Controlador secundario, para validar y eliminar contenido de otro tipo dentro de un listado
var controller2 = '';
// URL de la función que carga el listado
var url_listado = '/list';
// Se aplica filtro
var aplicar_filtro = false;
// URL de la función que aplica el filtro
var url_filtro = '';
</script>
@endsection