@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para editar una '.$singular, 'icon'=>'fa fa-angle-double-right')) }}

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
                                {{ Backend::form_textarea('contenido', array('editor'=>true, 'value'=>$r->contenido)) }}
                                {{ Backend::form_select('tipo_nota_id', array('db'=>$tipo_notas, 'db_text'=>'descripcion', 'value'=>$r->tipo_nota_id)) }}

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
    var html5editor = true;
</script>

@endsection