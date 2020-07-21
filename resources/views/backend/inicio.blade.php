<?php $user = Auth::user(); ?>

@extends('layouts.backend.index')

@section('titulo_pagina', $titulo_pagina)

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-pic m-b-20 m-t-20">
                        <img src="{{ asset('bk/images/users/user'.$user->id.'.png') }}" class="rounded-circle" alt="user" width="150">
                        <h4 class="m-t-20 m-b-0">{{ $user->name }}</h4>
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </div>
                    <div class="badge badge-pill badge-light font-16">{{ $user->rol->descripcion }}</div>
                    <br><br>
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
        </div>

        <div class="col-md-8">

            <div class="row">
                
                @if (Backend::tiene_permiso('informes_comunes_crear', $user->rol_id))
                <div class="col-md-6">
                    <a href="{{ route('informes_comunes.index') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 style="color: #666;">{{ $informes->comunes }}</h3>
                                        <h6 class="card-subtitle">Informes comunes</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                
                @if (Backend::tiene_permiso('informes_avances_crear', $user->rol_id))
                <div class="col-md-6">
                    <a href="{{ route('informes_avances.index') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 style="color: #666;">{{ $informes->avances }}</h3>
                                        <h6 class="card-subtitle">Informes de avances</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                <?php /*
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 style="color: #666;">{{ $informes->hitos }}</h3>
                                    <h6 class="card-subtitle">Informes hitos</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 style="color: #666;">{{ $informes->indicadores }}</h3>
                                    <h6 class="card-subtitle">Informes con indicadores</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                */ ?>

                @if (Backend::tiene_permiso('notas_crear', $user->rol_id))
                <div class="col-md-6">
                    <a href="{{ route('notas.index') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 style="color: #666;">{{ $cantidad->notas }}</h3>
                                        <h6 class="card-subtitle">Notas</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                  @endif
                
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Backend::card(array('title'=>'Fincas')) }}
                <div class="row">
                    @foreach ($fincas as $f)
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <a href="JavaScript: void(0);"><i class="display-6 wi wi-day-sunny text-white" title="AMP"></i></a>
                                    <div class="m-l-15">
                                        <h4 class="font-medium m-b-0">{{ $f->nombre }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            {{ Backend::endcard() }}
        </div>
    </div>

</div>

@endsection
