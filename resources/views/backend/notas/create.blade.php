@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para agregar una '.$singular, 'icon'=>'fa fa-angle-double-right')) }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-b-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route($controller.'.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row">

                                {{ Backend::form_input_text('titulo') }}
                                {{ Backend::form_textarea('contenido', array('editor'=>true)) }}
                                {{ Backend::form_select('tipo_nota_id', array('db'=>$tipo_notas, 'db_text'=>'descripcion')) }}
                            
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
    var html5editor = true;
</script>
@endsection