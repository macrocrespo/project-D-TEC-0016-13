@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para editar un usuario', 'icon'=>'fa fa-angle-double-right')) }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-b-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('usuarios.update', $r) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">

                                {{ Backend::form_input_text('name', array('value'=>$r->name)) }}
                                {{ Backend::form_input_text('email', array('type'=>'email', 'value'=>$r->email)) }}
                                {{ Backend::form_input_text('domicilio', array('required'=>false, 'value'=>$r->domicilio)) }}
                                {{ Backend::form_select('codigo_perfil', array('options'=>$codigos_perfil, 'keys'=>false, 'required'=>false, 'value'=>$r->codigo_perfil)) }}
                                {{ Backend::form_select('rol_id', array('db'=>$roles, 'error_txt'=>'Debe seleccionar un rol', 'value'=>$r->rol_id)) }}

                            </div>
                        </div>
                    </div>
                    {{ Backend::form_actions('edit') }}
                </form>
            {{ Backend::endcard() }}
        </div>
    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="update">
<input type="hidden" id="controller" value="{{ $controller }}">
<script>
    var validate = true;
    var select2 = true;
</script>

@endsection