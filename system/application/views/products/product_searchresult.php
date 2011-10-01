<h2 class="heading">Product Type > <?= $pname ?></h2>
   <div class="list-row">
   <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
      	<th></th>
        <th>Item Code</th>
        <th>Size</th>
        <th>Color</th>
        <th>MRP</th>
        <th>National Cut</th>
        <th>City Cut</th>
      </tr>
   <?php
   	foreach($item->result_array() as $row)
	{
	?>
    	<!--<img src="<?php echo base_url()?>images/sample-product.jpg" width="180" height="133" />-->
        <tr>
        	<td><img src="<?php echo base_url()?>uploads/images/<?= $row['img_name'] ?>" width="100" height="100" /></td>
        	<td><?= $row['code'] ?></td>
            <td><?= $row['size'] ?></td>
            <td><?= $row['color'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['national_cut'] ?></td>
            <td><?= $row['city_cut'] ?></td>
        </tr>
        
    <?php
	}
   ?>
   </table>
   </div>