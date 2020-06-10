<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">
                @if (isset($icono_pagina)) <i class="{{ $icono_pagina }} m-r-5"></i> @endif
                @if (isset($titulo_pagina)) {{ $titulo_pagina }} @else Falta "titulo_pagina" @endif
            </h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}">{{ $backend_name }}</a></li>

                        @foreach ($breadcrumb as $item_route => $item_text)
                            @if ($item_route != '-')
                                <li class="breadcrumb-item"><a href="{{ route($item_route) }}">{{ $item_text }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $item_text }}</li>
                            @endif
                        @endforeach

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>