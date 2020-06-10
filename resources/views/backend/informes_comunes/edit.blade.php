@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para editar un '.$singular, 'icon'=>'fa fa-angle-double-right')) }}

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
                                
                                {{ Backend::form_input_text('titulo', array('value'=>$r->titulo)) }}
                                {{ Backend::form_textarea('texto', array('editor'=>true, 'value'=>$r->texto)) }}

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
            {{ Backend::card(array('title'=>'Imagenes asociadas', 'icon'=>'fa fas fa-images')) }}

                <form id="form_upload_image" action="{{ route($controller.'.images_add') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <input type="hidden" name="informe_comun_id" value="{{ $r->id }}">
                                    {{ Backend::form_input_file('nueva_imagen', array('required'=>true)) }}
                                </div>
                                <div class="col-md-4">
                                    <button id="btn_upload_image" type="submit" class="btn-action btn btn-outline-success waves-effect waves-light" style="margin-top: 34px;">
                                        <i class="fas fa-plus-circle"></i> Subir</button>
                                </div>
                            </div>
                            <div id="listado_imagenes"></div>
                        </div>
                    </div>
                    
                </form>
            {{ Backend::endcard() }}
        </div>
    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="edit">
<input type="hidden" id="controller" value="{{ $controller }}">
<script>
    var validate = true;
    var html5editor = true;
</script>

@endsection