@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{ Backend::card() }}

            <table class="table table-striped">
                <tbody>

                    {{ Backend::row_details($r, 'name', array('width'=>200)) }}
                    {{ Backend::row_details($r, 'email') }}
                    {{ Backend::row_details($r, 'domicilio') }}
                    {{ Backend::row_details($r, 'codigo_perfil') }}
                    {{ Backend::row_details($r, 'rol_id', array('value'=>$r->rol->nombre)) }}

                </tbody>
            </table>
            {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

            {{ Backend::endcard() }}
        </div>
    </div>
</div>

@endsection