@extends('layouts.backend.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-pic m-b-20 m-t-20">
                        <img src="{{ asset('bk/images/users/user'.$r->id.'.png') }}" class="rounded-circle" alt="{{ $r->name }}" width="150">
                        <h4 class="m-t-20 m-b-0">{{ $r->name }}</h4>
                        <a href="mailto:{{ $r->email }}">{{ $r->email }}</a>
                    </div>
                    <div class="badge badge-pill badge-light font-16">{{ $r->rol->descripcion }}</div>
                    <br><br>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Domicilio</h5>
                            <p>{{ $r->domicilio}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Código de perfil</h5>
                            <p>{{ $r->codigo_perfil}}</p>
                        </div>
                    </div>
                </div>
                <?php /*
                <div class="p-25 border-top m-t-15">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i class="fas fa-user-circle font-20 m-r-5"></i>Mi perfil</a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i class="fas fa-power-off font-20 m-r-5"></i>Cerrar sesión</a>
                        </div>
                    </div>
                </div>
                */ ?>
            </div>

            {{ Backend::form_actions('show', route($controller.'.edit', $r)) }}
            
        </div>
    </div>
</div>

@endsection