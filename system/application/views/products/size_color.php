<select name="csize" id="csize" tabindex="1" class="select">
<option value="">Size</option>
<?php foreach($designs as $row) { ?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['size']; ?></option>
<?php } ?>
</select>

<select name="cod_color" id="cod_color" tabindex="1" class="select">
<option value="">Color</option>
<?php foreach($colors as $row) { ?>
<option value="<?php echo $row['color']; ?>"><?php echo $row['color']; ?></option>
<?php } ?>
</select>
               