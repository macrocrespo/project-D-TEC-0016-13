<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $backend_name }} Panel de control">
    <meta name="author" content="Mario Crespo">
    <!-- Favicon icon -->
    <link rel="icon" type="image/icon" sizes="16x16" href="{{ asset('bk/images/favicon.png') }}">
    <title>{{ $backend_name }} - {{ $titulo_pagina }}</title>

    @if(isset($css) && count($css) > 0)
    @foreach ($css as $css_url)
        <link href="{{ asset($css_url) }}" rel="stylesheet">
    @endforeach
    @endif

    <link href="{{ asset('bk/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('bk/css/custom.css') }}" rel="stylesheet">

</head>