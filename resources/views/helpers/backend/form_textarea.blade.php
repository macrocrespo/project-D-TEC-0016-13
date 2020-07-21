<div id="form-field-{{ $id }}" class="col-md-{{ $size }} m-b-20">
    <label for="{{ $id }}">{{ $label }} 
        @if ($required) <span class="text-danger">*</span> @endif </label>

    <textarea name="{{ $name }}" id="{{ $id }}" 
        style="min-height: {{ $height }}px;" 
        class="form-control @if ($editor) editor @endif"
        @if ($required) required @endif 
        @if ($readonly) readonly @endif >
        {{ $value }}
    </textarea>
    
    @if (!$editor && $error_txt != '')
    <div class="invalid-feedback">
        {{ $error_txt }}
    </div>
    @endif
</div>