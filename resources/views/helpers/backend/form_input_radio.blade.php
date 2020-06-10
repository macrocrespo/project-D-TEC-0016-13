<?php switch ($form_size) {
    case 'small': $col1 = '4'; $col2 = '8'; $col3 = '0'; break;
    case 'large': $col1 = '3'; $col2 = '6'; $col3 = '3'; break;
} ?>
<div id="form-group-<?php echo $id; ?>" class="form-group <?php if ($last) { echo 'last'; } ?>">
    <label class="control-label col-md-<?php echo $col1; ?>"><?php echo $label; ?> <?php if ($required) { echo '*'; } ?></label>
    <div class="col-md-<?php echo $col2; ?>">
        <div class="mt-radio-inline" data-error-container="#<?php echo $id; ?>_error">
            <?php foreach ($options as $option) { ?>
            <label class="mt-radio">
                <input type="radio" name="<?php echo $name; ?>" id="<?php echo $option->id; ?>" value="<?php echo $option->value; ?>" <?php if ($option->checked) { echo 'checked'; } ?>> <?php echo $option->text; ?>
                <span></span>
            </label>
            <?php } ?>
        </div>
        <div id="<?php echo $id; ?>_error"> </div>
    </div>
</div>