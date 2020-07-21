<div class="form-group row mb-0">
    <label for="{{ $name }}" class="col-sm-6 text-right control-label col-form-label pr-3">{{ $label }}</label>
    <div class="col-sm-6 pt-2">
        <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="{{ $name }}_si" name="{{ $name }}" @if ($value) checked @endif>
                <label class="custom-control-label pt-0" for="{{ $name }}_si">Si</label>
            </div>
        </div>
        <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="{{ $name }}_no" name="{{ $name }}" @if (!$value) checked @endif>
                <label class="custom-control-label pt-0" for="{{ $name }}_no">No</label>
            </div>
        </div>
    </div>
</div>