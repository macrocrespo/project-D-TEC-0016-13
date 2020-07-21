@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para editar el '.$singular, 'icon'=>'fa fa-angle-double-right')) }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-b-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route($controller.'.update', $r) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                
                                {{ Backend::form_input_text('nombre', array('value'=>$r->nombre)) }}
                                {{ Backend::form_input_text('descripcion', array('value'=>$r->descripcion)) }}

                            </div>
                        </div>
                    </div>
                    {{ Backend::form_actions('edit') }}
                </form>
            {{ Backend::endcard() }}
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Permisos asociados al '.$singular, 'icon'=>'fa fa-angle-double-right')) }}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Notas</h4>
                            <hr>
                            {{ Backend::form_permiso('notas_crear', $params) }}
                            {{ Backend::form_permiso('notas_editar', $params) }}
                            {{ Backend::form_permiso('notas_eliminar', $params) }}
                            {{ Backend::form_permiso('notas_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tipos de notas</h4>
                            <hr>
                            {{ Backend::form_permiso('tipo_notas_crear', $params) }}
                            {{ Backend::form_permiso('tipo_notas_editar', $params) }}
                            {{ Backend::form_permiso('tipo_notas_eliminar', $params) }}
                            {{ Backend::form_permiso('tipo_notas_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informes comunes</h4>
                            <hr>
                            {{ Backend::form_permiso('informes_comunes_crear', $params) }}
                            {{ Backend::form_permiso('informes_comunes_editar', $params) }}
                            {{ Backend::form_permiso('informes_comunes_eliminar', $params) }}
                            {{ Backend::form_permiso('informes_comunes_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informes hitos</h4>
                            <hr>
                            {{ Backend::form_permiso('informes_hitos_crear', $params) }}
                            {{ Backend::form_permiso('informes_hitos_editar', $params) }}
                            {{ Backend::form_permiso('informes_hitos_eliminar', $params) }}
                            {{ Backend::form_permiso('informes_hitos_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informes indicadores</h4>
                            <hr>
                            {{ Backend::form_permiso('informes_indicadores_crear', $params) }}
                            {{ Backend::form_permiso('informes_indicadores_editar', $params) }}
                            {{ Backend::form_permiso('informes_indicadores_eliminar', $params) }}
                            {{ Backend::form_permiso('informes_indicadores_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Informes técnicos de avances</h4>
                            <hr>
                            {{ Backend::form_permiso('informes_avances_crear', $params) }}
                            {{ Backend::form_permiso('informes_avances_editar', $params) }}
                            {{ Backend::form_permiso('informes_avances_eliminar', $params) }}
                            {{ Backend::form_permiso('informes_avances_aprobar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Usuarios</h4>
                            <hr>
                            {{ Backend::form_permiso('usuarios_crear', $params) }}
                            {{ Backend::form_permiso('usuarios_editar', $params) }}
                            {{ Backend::form_permiso('usuarios_eliminar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Roles</h4>
                            <hr>
                            {{ Backend::form_permiso('roles_crear', $params) }}
                            {{ Backend::form_permiso('roles_editar', $params) }}
                            {{ Backend::form_permiso('roles_eliminar', $params) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Otras opciones</h4>
                            <hr>
                            {{ Backend::form_permiso('enviar_correos', $params) }}
                            {{ Backend::form_permiso('imprimir_exportar', $params) }}
                        </div>
                    </div>
                </div>
            </div>
            {{ Backend::endcard() }}
        </div>
    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="edit">
<input type="hidden" id="controller" value="{{ $controller }}">
<script>
    var validate = true;
</script>

@endsection