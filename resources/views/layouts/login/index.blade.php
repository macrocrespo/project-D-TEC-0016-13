<!DOCTYPE html>
<html dir="ltr">

    @include('layouts.login._head')

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        @yield('content')

    </div>

    @include('layouts.login._js')
    
</body>

</html>