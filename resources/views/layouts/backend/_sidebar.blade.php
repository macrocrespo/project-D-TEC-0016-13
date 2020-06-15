<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="{{ asset('bk/images/users/user'.$user->id.'.png') }}" alt="{{ $user->name }}" class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium">{{ $user->name }}</h5>
                            <?php /*
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            */ ?>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-circle btn-sm" data-toggle="tooltip" title="Cerrar sesión">
                                <i class="ti-power-off"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-user m-r-5 m-l-5"></i> Mi perfil</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-email m-r-5 m-l-5"></i> Mensajes</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-settings m-r-5 m-l-5"></i> Configuración</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('inicio') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Inicio</span>
                    </a>
                </li>
                <li class="sidebar-item @if (isset($active['informes'])) selected @endif">
                    <a class="sidebar-link has-arrow waves-effect waves-dark @if (isset($active['informes'])) active @endif" href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="fas fa-tasks"></i>
                        <span class="hide-menu">Informes</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level @if (isset($active['informes_comunes'])) in @endif">
                        <li class="sidebar-item @if (isset($active['informes_comunes'])) active @endif">
                            <a href="{{ route('informes_comunes.index') }}" class="sidebar-link @if (isset($active['informes_comunes'])) active @endif">
                                <i class="fas fa-angle-double-right "></i>
                                <span class="hide-menu">Informes comunes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item @if (isset($active['_notas'])) selected @endif">
                    <a class="sidebar-link has-arrow waves-effect waves-dark @if (isset($active['_notas'])) active @endif" href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="far fa-edit"></i>
                        <span class="hide-menu">Notas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level @if (isset($active['_notas'])) in @endif">
                        <li class="sidebar-item @if (isset($active['notas'])) active @endif">
                            <a href="{{ route('notas.index') }}" class="sidebar-link @if (isset($active['notas'])) active @endif">
                                <i class="fas fa-angle-double-right "></i>
                                <span class="hide-menu">Notas</span>
                            </a>
                        </li>
                        <li class="sidebar-item @if (isset($active['tipo_notas'])) active @endif">
                            <a href="{{ route('tipo_notas.index') }}" class="sidebar-link @if (isset($active['tipo_notas'])) active @endif">
                                <i class="fas fa-angle-double-right "></i>
                                <span class="hide-menu">Tipo de notas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @if ($user->rol_id == 1)
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Configuración</span>
                    </li>

                    <li class="sidebar-item @if (isset($active['usuarios'])) selected @endif">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link @if (isset($active['usuarios'])) active @endif" href="{{ route('usuarios.index') }}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">Usuarios</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>