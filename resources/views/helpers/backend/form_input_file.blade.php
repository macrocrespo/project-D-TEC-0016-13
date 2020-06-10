<div id="form-field-{{ $id }}" class="col-md-{{ $size }} m-b-20">
    <label for="{{ $id }}">{{ $label }} 
        @if ($required) <span class="text-danger">*</span> @endif </label>
        
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
        <div class="form-control" data-trigger="fileinput">
            <i class="fas fa-{{ $icon }}"></i>
            <span class="fileinput-filename"></span>
        </div>
        <span class="input-group-append">
            <span title="Eliminar" class="input-group-text fileinput-exists" data-dismiss="fileinput">
                <i class="fas fa-trash-alt"></i>
            </span>
        
            <span class="input-group-text btn-file">
                <span class="fileinput-new"><i class="fas fa-folder-open"></i></span>
                <span class="fileinput-exists"><i class="fas fa-pencil-alt"></i></span>
                <input type="file" name="{{ $name }}" id="{{ $id }}" accept="{{ $accept }}">
            </span>
        </span>

        @if ($type == 'image' && $file_url != '')
            <div class="fileinput-new img-thumbnail imagen-cargada">
                <a data-toggle="tooltip" title="Ampliar imagen" class="img_detalles" onclick="ampliar_imagen('{{ $label }}', '{{ $file_url }}')">
                    <img src="{{ $file_url }}" alt="{{ $file_name }}">
                </a>
                <a data-toggle="tooltip" title="Eliminar" onclick="eliminar_imagen_form('{{ $name }}');" class="btn btn-delete waves-effect waves-light btn-danger text-white"><i class="fas fa-trash-alt"></i></a>
            </div>
        @endif
        <div class="fileinput-preview fileinput-exists img-thumbnail"></div>
        
        @if ($help != '')
        <small id="name" class="form-text text-muted" style="width: 100%;">{{ $help }}</small>
        @endif

        @if ($error_txt != '')
        <div class="invalid-feedback">
            {{ $error_txt }}
        </div>
        @endif

    </div>
</div>