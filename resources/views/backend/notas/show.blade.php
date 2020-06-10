@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{ Backend::card() }}

            <table class="table table-striped">
                <tbody>

                    {{ Backend::row_details($r, 'titulo', array('width'=>200)) }}
                    {{ Backend::row_details($r, 'contenido', array('value'=>nl2br($r->contenido))) }}
                    {{ Backend::row_details($r, 'tipo_nota_id', array('value'=>$r->tipo_nota->descripcion)) }}
                    {{ Backend::row_details($r, 'fecha', array('value'=>Backend::fecha_formato_listado($r->fecha, true))) }}
                    {{ Backend::row_details($r, 'usuario_id', array('value'=>$r->usuario->name)) }}

                </tbody>
            </table>
            {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

            {{ Backend::endcard() }}
        </div>
    </div>
</div>

@endsection