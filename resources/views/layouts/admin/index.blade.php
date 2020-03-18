<!DOCTYPE html>
<html dir="ltr" lang="es-AR">

    @include('layouts.admin._head')

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        
        @include('layouts.admin._header')
        @include('layouts.admin._sidebar')

        <div class="page-wrapper">

            @include('layouts.admin._breadcrumb')
            @yield('content')
            @include('layouts.admin._footer')

        </div>

    </div>

    @include('layouts.admin._js')

</body>

</html>