<?php switch ($form_size) {
    case 'small': $col1 = '4'; $col2 = '8'; $col3 = '0'; break;
    case 'large': $col1 = '3'; $col2 = '6'; $col3 = '3'; break;
} ?>
<div id="form-group-<?php echo $id; ?>" class="form-group <?php if ($last) { echo 'last'; } ?>">
    <label class="control-label col-md-<?php echo $col1; ?>" for="<?php echo $id; ?>">
        <?php echo $label; ?> <?php if ($required) { echo '*'; } ?>
    </label>
    <div class="col-md-<?php echo $col2; ?>">
        <div class="input-group" style="margin-top: 8px;">
            
            <label class="mt-checkbox mt-checkbox-outline">
                <input id="<?php echo $id; ?>" type="checkbox" value="<?php echo ($checked) ? 1 : 0; ?>" name="<?php echo $name; ?>">
                <?php echo $text; ?>
                <span></span>
            </label>
            
        </div>
    </div>
</div>