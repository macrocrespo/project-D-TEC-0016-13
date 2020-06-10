<?php switch ($form_size) {
    case 'small': $col1 = '4'; $col2 = '8'; $col3 = '0'; break;
    case 'large': $col1 = '3'; $col2 = '6'; $col3 = '3'; break;
} ?>
<div id="form-group-<?php echo $id; ?>" class="form-group <?php if ($last) { echo 'last'; } ?>">
    <label class="control-label col-md-<?php echo $col1; ?>" for="<?php echo $name; ?>">
        <?php echo $label; ?> <?php if ($required) { echo '*'; } ?>
    </label>
    <div class="col-md-<?php echo $col2; ?>">
        <div class="input-group">
            <?php if ($icon != '') { ?>
            <span class="input-group-addon">
                <i class="icon-<?php echo $icon; ?> font-blue"></i>
            </span>
            <?php } ?>
            <input readonly="readonly" type="text" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="form-control <?php echo ($daterange) ? 'input-date' : 'datepicker'; ?>" value="<?php echo $value; ?>"> 
        </div>
    </div>
</div>