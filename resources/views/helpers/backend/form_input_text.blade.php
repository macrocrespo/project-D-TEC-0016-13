<div id="form-field-{{ $id }}" class="col-md-{{ $size }} m-b-20">
    <label for="{{ $id }}">{{ $label }} 

        @if ($required) <span class="text-danger">*</span> @endif </label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
        @if ($required) required @endif 
        @if ($readonly) readonly @endif 
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif >

    @if ($error_txt != '')
    <div class="invalid-feedback">
        {{ $error_txt }}
    </div>
    @endif
</div>