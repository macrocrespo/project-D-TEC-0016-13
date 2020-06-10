<!DOCTYPE html>
<html dir="ltr" lang="es-AR">

    @include('layouts.backend._head')

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        
        @include('layouts.backend._header')
        @include('layouts.backend._sidebar')

        <div class="page-wrapper">

            @include('layouts.backend._breadcrumb')
            @yield('content')
            @include('layouts.backend._footer')

        </div>

    </div>

    @include('layouts.backend._js')

</body>

</html>