@extends('layouts.backend.index')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Formulario para agregar un '.$singular, 'icon'=>'fa fa-angle-double-right')) }}

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
                                {{ Backend::form_input_text('anio', array('value'=>old('anio'), 'size'=>2)) }}
                            </div>
                            <br>
                            <hr>
                            <h3 class="mb-4">Datos del proyecto / componente</h3>
                            <div class="form-row">
                                {{ Backend::form_input_text('codigo_proyecto', array('value'=>old('codigo_proyecto'), 'size'=>2)) }}
                                {{ Backend::form_input_text('componente', array('value'=>old('componente'), 'size'=>2)) }}
                                {{ Backend::form_input_text('proyecto', array('value'=>old('proyecto'), 'size'=>8)) }}
                                {{ Backend::form_input_text('universidad', array('value'=>old('universidad'))) }}
                                {{ Backend::form_select('director_proyecto_id', array('db'=>$directores, 'db_text'=>'name', 'size'=>4)) }}
                                {{ Backend::form_datepicker('periodo_informe', array('value'=>old('periodo_informe'), 'size'=>4)) }}
                                {{ Backend::form_datepicker('fecha_ita', array('value'=>old('fecha_ita'), 'size'=>4)) }}
                            </div>

                            <br>
                            <hr>
                            <h3 class="mb-4">Becarios del componente</h3>
                            <div class="form-row">
                                @foreach ($becarios as $b)
                                <div class="col-md-4">
                                    <div id="becario_{{ $b->id }}" class="becario card">
                                        <div class="card-body">
                                            <div class="d-flex flex-row">
                                                <div class=""><img src="{{ asset('bk/images/users/user'.$b->id.'.png') }}" alt="{{ $b->name }}" class="rounded-circle" width="100"></div>
                                                <div class="p-l-20">
                                                    <h3 class="font-medium">{{ $b->name }}</h3>
                                                    <h6>{{ $b->email }}</h6>
                                                    <div class="m-b-30">
                                                        
                                                        <div class="custom-control custom-checkbox mt-3">
                                                            <input onclick="incluir_becario({{ $b->id }})" type="checkbox" class="custom-control-input" name="check_becario_{{ $b->id }}" id="check_becario_{{ $b->id }}">
                                                            <label class="custom-control-label pt-0" for="check_becario_{{ $b->id }}">Incluir en el proyecto</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <br>
                            <hr>
                            <h3 class="mb-4">Avance en las metas físicas del proyecto / componente</h3>
                            <div class="form-row">
                                {{ Backend::form_textarea('resultados_pa', array('editor'=>true)) }}
                                {{ Backend::form_textarea('grado_avance', array('editor'=>true)) }}
                                {{ Backend::form_textarea('analisis_causal', array('editor'=>true)) }}
                                {{ Backend::form_textarea('ajustes', array('editor'=>true)) }}
                                {{ Backend::form_textarea('sintesis', array('editor'=>true)) }}
                                {{ Backend::form_textarea('avance_transferencia', array('editor'=>true)) }}
                            </div>
                            <br>
                            <hr>
                            <h3 class="mb-4">Ejecución del presupuesto para gastos del proyecto</h3>
                            <div class="form-row">
                                {{ Backend::form_textarea('presupuesto_estado', array('editor'=>true)) }}
                                {{ Backend::form_textarea('acciones_gastos', array('editor'=>true)) }}
                            </div>
                            <br>
                            <hr>
                            <h3 class="mb-4">Comentarios y anexos</h3>
                            <div class="form-row">
                                {{ Backend::form_textarea('comentarios', array('editor'=>true)) }}
                                {{ Backend::form_textarea('anexos', array('editor'=>true)) }}
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