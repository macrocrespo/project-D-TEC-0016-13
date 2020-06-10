@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{ Backend::card() }}

            <table class="table table-striped">
                <tbody>

                    {{ Backend::row_details($r, 'descripcion', array('width'=>200)) }}

                </tbody>
            </table>
            {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}

            {{ Backend::endcard() }}
        </div>
    </div>
</div>

@endsection