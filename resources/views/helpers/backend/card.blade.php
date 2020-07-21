<div class="card">
    @if ($title != '')
        <div class="card-header">
            <h4 class="pb-0" style="display: inline;">
            @if ($icon != '')  <i class="{{ $icon }} m-r-5"></i> @endif
            {{ $title }}
            </h4>
            <div class="card-actions no-print">
                @if ($min) <a class="" data-action="collapse"><i class="ti-minus"></i></a> @endif
                @if ($max) <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a> @endif
                @if ($close) <a class="btn-close" data-action="close"><i class="ti-close"></i></a> @endif
            </div>
        </div>
    @endif
    <div class="card-body collapse show" style="">