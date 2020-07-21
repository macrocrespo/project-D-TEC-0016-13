@extends('layouts.backend.index')

@section('titulo_pagina', $titulo_pagina)

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-6 offset-md-3">

            <div class="jumbotron mt-5">
                <h1 class="display-4">
                    <i class="fas fa-exclamation-triangle m-r-5"></i>
                    Sin permisos</h1>
                <p class="lead">Disculpa, pero no tienes permisos para acceder a esta página.</p>
                <hr class="my-4">
                <p>Para más información, contacta con el administrador del sistema.</p>
                <a class="btn btn-danger btn-lg" href="{{ route('inicio') }}" role="button">
                    <i class="fas fa-home"></i>
                    Regresar al inicio</a>
              </div>

        </div>
        
    </div>

</div>

@endsection
