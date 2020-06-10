<div id="Top_bar">
    <div class="container">
        <div class="column one">
            <div class="top_bar_left clearfix">
                <!-- Logo-->
                <div class="logo">
                    <a id="logo" href="index.html" title="D-TEC 0016/13"><img class="scale-with-grid" src="{{ asset('fe/images/logo1.png') }}" alt="D-TEC 0016/13" />
                    </a>
                </div>
                <!-- Main menu-->
                <div class="menu_wrapper" style="width: 100%; background: #fff;">
                    <nav id="menu">
                        <ul id="menu-main-menu" class="menu">
                            <li class="current-menu-item">
                                <a href="#"><span>Inicio</span></a>
                            </li>
                            <li>
                                <a href="#"><span>Misión y visión</span></a>
                            </li>
                            <li>
                                <a href="#"><span>Componentes</span></a>
                                <ul class="sub-menu">
                                    <li><a href="#"><span>Componente 1</span></a></li>
                                    <li><a href="#"><span>Componente 2</span></a></li>
                                    <li><a href="#"><span>Componente 3</span></a></li>
                                    <li><a href="#"><span>Componente 4</span></a></li>
                                    <li>
                                        <a href="#"><span>Componente 5</span></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="#"><strong>INCORPORACIÓN DE FUENTES DE ENERGÍA RENOVABLES</strong></a>
                                            </li>
                                            <li>
                                                <a href="#"><span>Notas</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span>Informes</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span>Correo</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><span>Componente 6</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span>Quienes somos</span></a>
                            </li>
                            <li style="float:right;">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}"><span><i class="icon-user"></i> {{ __('Login') }}</span></a>
                                @endif
                            </li>
                        </ul>
                    </nav><a class="responsive-menu-toggle" href="#"><i class="icon-menu"></i></a>
                </div>
                <!-- Secondary menu area - only for certain pages -->
                <div class="secondary_menu_wrapper">
                    <a target="_blank" style="display: block; margin-top: -20px;" id="logo_unse" href="https://www.unse.edu.ar/" title="UNSE"><img class="scale-with-grid" src="{{ asset('fe/images/logo_unse.jpg') }}" alt="UNSE" /></a>
                </div>
            </div>
        </div>
    </div>
</div>