@extends('layouts.backend.index')
@section('content')

<div id="detalles" class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-success">
                        <h3 class="text-white box m-t-10"><i class="far fa-edit"></i></h3></div>
                    <div class="p-10">
                        <h3 class="text-success m-b-10">{{ $r->titulo}}</h3>
                        <span class="text-muted">
                            <i class="fas fa-user"></i>
                            {{ $r->usuario->name }}
                            <i class="fas fa-clock m-l-10"></i>
                            {{ Backend::fecha_formato_listado($r->fecha, true) }}
                        </span>
                        <br>
                        <span class="text-muted m-t-10" style="display: block;"><strong>Tipo: </strong>{{ ucfirst($r->tipo_nota->descripcion) }}</span>
                    </div>
                    @if (Backend::tiene_permiso('imprimir_exportar', $user->rol_id))
                        {{ Backend::btn_print_report() }}
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Nota')) }}
                {!! nl2br($r->contenido) !!}
            {{ Backend::endcard() }}
        </div>

        {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="show">
<input type="hidden" id="controller" value="{{ $controller }}">

@endsection