@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para agregar usuario', 'icon'=>'fa fa-angle-double-right')) }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-b-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usuarios.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">

                                {{ Backend::form_input_text('name') }}
                                {{ Backend::form_input_text('email', array('type'=>'email')) }}
                                {{ Backend::form_input_text('domicilio', array('required'=>false)) }}
                                {{ Backend::form_select('codigo_perfil', array('options'=>$codigos_perfil, 'keys'=>false, 'required'=>false)) }}
                                {{ Backend::form_select('rol_id', array('db'=>$roles, 'error_txt'=>'Debe seleccionar un rol')) }}

                                {{ Backend::form_input_text('password', array('type'=>'password')) }}
                                {{ Backend::form_input_text('password_confirmation', array('type'=>'password', 'error_txt'=>'Debe repetir la contraseña')) }}
                            
                            </div>
                        </div>
                    </div>
                    {{ Backend::form_actions() }}
                </form>
            {{ Backend::endcard() }}
        </div>
    </div>
</div>
<input type="hidden" id="view" value="create">
<script>
    var validate = true;
    var select2 = true;
</script>
@endsection