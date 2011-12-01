<tr><th>Code</th><th>Photo</th><th>Sex</th><th>Size</th><th>Colour</th><th>Number</th><th>Price</th></tr>
<?php 

foreach($stock_data as $row) { ?>
<tr>
	<td><?php echo $row->code ?></td>
	<td><img src="<?php echo base_url() . 'uploads/images/' . $row->img_name ?>" height="100" alt="<?php echo $row->name ?>"><br /><?php echo $row->name ?></td>
	<td><?php echo $row->sex ?></td>
	<td><?php echo $row->size ?></td>
	<td><?php echo $row->color ?></td>
	<td><?php echo $row->amount ?></td>
	<td><?php echo $row->price ?></td>
</tr>
<?php } ?>