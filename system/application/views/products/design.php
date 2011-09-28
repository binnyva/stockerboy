                <select name="sdesign" id="sdesign" tabindex="1" class="select">
                 <option value="">Design</option>
                <?php foreach($designs as $row) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
                </select>
               