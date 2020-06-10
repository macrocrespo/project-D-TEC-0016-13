<div id="form-field-{{ $id }}" class="col-md-{{ $size }} m-b-20 @if ($multiple) multiple @endif">
    <label for="{{ $id }}">{{ $label }} 
        @if ($required) <span class="text-danger">*</span> @endif </label>
    @if (($options !== false && count($options) > 0) || ($db !== false && count($db) > 0))
        <select name="{{ $name }}<?php if ($multiple) { echo '[]'; } ?>" id="{{ $id }}" class="form-control" 
            @if ($required) required @endif 
            @if ($multiple) multiple="multiple" @endif 
            @if ($disabled) disabled="disabled" @endif >
            
            @if (!$multiple) <option value=""></option> @endif

            @if ($options)
                @foreach ($options as $value => $text)
                    <?php if (!$keys) { $value = $text; } ?>
                    @if ($multiple)
                        <option <?php if ($value_selected != '') { if (in_array($value, $value_selected)) { echo 'selected="selected"'; } } ?> value="{{ $value }}">{{ $text }}</option>
                    @else
                        <option @if ($value == $value_selected) selected="selected" @endif value="{{ $value }}">{{ $text }}</option>
                    @endif
                @endforeach
            @endif

            @if ($db)
                @foreach ($db as $r)
                    @if ($multiple)
                        <option <?php if ($value_selected != '') { if (in_array($r->$db_value, $value_selected)) { echo 'selected="selected"'; } } ?> value="{{ $r->$db_value }}">{{ $r->$db_text }}</option>
                    @else
                        <option @if ($r->$db_value == $value_selected) selected="selected" @endif value="{{ $r->$db_value }}">{{ $r->$db_text }}</option>
                    @endif
                @endforeach
            @endif

        </select>
    @else
        <select name="{{ $name }}" id="{{ $id }}" class="form-control">
            <option value=""><?php echo $message_empty; ?></option>
        </select>
    @endif
    @if ($error_txt != '')
    <div class="invalid-feedback">
        {{ $error_txt }}
    </div>
    @endif
</div>