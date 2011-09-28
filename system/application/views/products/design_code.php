                <select name="cdesign" id="cdesign" tabindex="1" class="select" onchange="javascript:size_color_drop(this.value);">
                 <option value="">Design</option>
                <?php foreach($designs as $row) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
                </select>
               