<input type="hidden" id="base_url" value="{{ url($admin_url) }}">
<input type="hidden" id="site_url" value="{{ asset('') }}">

<script src="{{ asset('bk/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('bk/plugins/popper.min.js') }}"></script>
<script src="{{ asset('bk/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('bk/plugins/waves.js') }}"></script>
<script src="{{ asset('bk/plugins/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('bk/plugins/sparkline/sparkline.js') }}"></script>

<script src="{{ asset('bk/plugins/template/app.js') }}"></script>
<script src="{{ asset('bk/plugins/template/app.init.js') }}"></script>
<script src="{{ asset('bk/plugins/template/sidebarmenu.js') }}"></script>
<script src="{{ asset('bk/plugins/template/custom.js') }}"></script>

<script src="{{ asset('bk/js/backend.js') }}"></script>

@if(isset($js) && count($js) > 0) 
    @foreach ($js as $js_url)
        <script src="{{ asset($js_url) }}"></script>
    @endforeach
@endif