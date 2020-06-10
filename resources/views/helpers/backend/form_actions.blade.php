<div class="form-actions">

    <div class="col-sm-12">
        @if ($link == '')
        <button type="submit" class="btn-action btn btn-outline-{{ $class }} waves-effect waves-light m-t-10">
            <i class="{{ $icon }}"></i> {{ $action_text }}</button>
        @else
        <a href="{{ $link }}" class="btn-action btn btn-outline-{{ $class }} waves-effect waves-light m-t-10">
            <i class="{{ $icon }}"></i> {{ $action_text }}</a>
        @endif

        @if ($back)
        <button onclick="window.history.back();" class="btn-action btn btn-outline-secondary waves-effect waves-light m-t-10">
            <i class="fas fa-arrow-right"></i> Volver</button>
        @endif

    </div>
</div>