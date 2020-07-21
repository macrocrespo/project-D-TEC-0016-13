@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="d-flex flex-row">
                    <div class="p-10 bg-success">
                        <h3 class="text-white box m-t-10"><i class="fas fa-user-circle"></i></h3>
                    </div>
                    <div class="p-10">
                        <h3 class="text-success m-b-10">{{ $r->nombre}}</h3>
                        <span class="text-muted">
                            {{ $r->descripcion }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Permisos')) }}

            {{ Backend::endcard() }}
        </div>

        {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

    </div>
</div>

<input type="hidden" id="id" value="{{ $r->id }}">
<input type="hidden" id="view" value="show">
<input type="hidden" id="controller" value="{{ $controller }}">

@endsection