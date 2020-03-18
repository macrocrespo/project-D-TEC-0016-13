<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

@include('layouts.frontend._head')

<body class="page-parent template-slider color-blue layout-full-width header-stack header-left subheader-transparent sticky-header sticky-white subheader-title-left">
    
    <!-- Main Theme Wrapper -->
    <div id="Wrapper">
        <!-- Header Wrapper -->
        <div id="Header_wrapper">
            <!-- Header -->
            <header id="Header">
                <!-- Header Top -  Info Area -->
                @include('layouts.frontend._top_menu')
                <!-- Header -  Logo and Menu area -->
                @include('layouts.frontend._main_menu')
                <!-- Revolution slider area-->
                @yield('slider')
            </header>
        </div>
        <!-- Main Content -->
        @yield('content')
        <!-- Footer-->
        @include('layouts.frontend._footer')
    </div>
    <!-- JS -->
    @include('layouts.frontend._js')
</body>
</html>