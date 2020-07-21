@extends('layouts.backend.index')
@section('content')

<div id="detalles" class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-success">
                        <h3 class="text-white box m-t-10"><i class="fas fa-check-circle"></i></h3></div>
                    <div class="p-10">
                        <h3 class="text-success m-b-10">Informe Año {{ $r->anio }}</h3>
                        <span class="text-muted">
                            <i class="far fa-calendar-alt"></i>
                            {{ $tags->periodo_informe }}: {{ Backend::fecha_formato_listado($r->periodo_informe, true) }}
                            <i class="fas fa-clock m-l-10"></i>
                            {{ $tags->fecha_ita }}: {{ Backend::fecha_formato_listado($r->fecha_ita, true) }}
                        </span>
                    </div>
                    @if (Backend::tiene_permiso('imprimir_exportar', $user->rol_id))
                        {{ Backend::btn_print_report() }}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-success">
                        <h3 class="text-white box m-t-10"><i class="fas fa-tasks"></i></h3></div>
                    <div class="p-10">
                        <h3 class="text-success m-b-10">{{ $tags->proyecto }}: {{ $r->proyecto}}</h3>
                        <span class="text-muted">
                            <i class="fas fa-chevron-circle-right"></i>
                            {{ $tags->codigo_proyecto }}: {{ $r->codigo_proyecto}}
                            <i class="far fa-dot-circle m-l-10"></i>
                            {{ $tags->componente }}: {{ $r->componente}}
                            <i class="fas fa-university m-l-10"></i>
                            {{ $tags->universidad }}: {{ $r->universidad}}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="becario card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class=""><img src="{{ asset('bk/images/users/user'.$r->director->id.'.png') }}" alt="{{ $r->director->name }}" class="rounded-circle" width="100"></div>
                        <div class="p-l-20">
                            <h3 class="font-medium">{{ $r->director->name }}</h3>
                            <h6>{{ $r->director->email }}</h6>
                            <label class="label label-success">{{ $tags->director_proyecto_id }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8"></div>

        @foreach ($becarios as $b)
            @if ($b->selected)
            <div class="col-md-4">
                <div id="becario_{{ $b->id }}" class="becario card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class=""><img src="{{ asset('bk/images/users/user'.$b->id.'.png') }}" alt="{{ $b->name }}" class="rounded-circle" width="100"></div>
                            <div class="p-l-20">
                                <h3 class="font-medium">{{ $b->name }}</h3>
                                <h6>{{ $b->email }}</h6>
                                <label class="label label-info">Becario</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->resultados_pa)) }}
                {!! nl2br($r->resultados_pa) !!}
            {{ Backend::endcard() }}
        </div>
        
        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->grado_avance)) }}
                {!! nl2br($r->grado_avance) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->analisis_causal)) }}
                {!! nl2br($r->analisis_causal) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->ajustes)) }}
                {!! nl2br($r->ajustes) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->sintesis)) }}
                {!! nl2br($r->sintesis) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->avance_transferencia)) }}
                {!! nl2br($r->avance_transferencia) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->presupuesto_estado)) }}
                {!! nl2br($r->presupuesto_estado) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->acciones_gastos)) }}
                {!! nl2br($r->acciones_gastos) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->comentarios)) }}
                {!! nl2br($r->comentarios) !!}
            {{ Backend::endcard() }}
        </div>

        <div class="col-md-12">
            {{ Backend::card(array('title'=>$tags->anexos)) }}
                {!! nl2br($r->anexos) !!}
            {{ Backend::endcard() }}
        </div>

        {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="show">
<input type="hidden" id="controller" value="{{ $controller }}">

@endsection