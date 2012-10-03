<div id="wraper">
  <div id="container">
    <div id="products">
    
        <div class="tab_container">
        
		<div id="tab1" class="tab_content">
			<h2 class="heading">Stock</h2>
			<a href="<?php echo site_url('stock/stock_view') ?>">Back to Stock</a>
			<table class="data-table" id="stock-table">
			<tr><th>Code</th><th>Photo</th><th>Sex</th><th>Size</th><th>Colour</th><th>Number</th><th>Price</th></tr>
			<?php
			$last_city = 0;
			foreach($stock_data as $row) { 
				if($row->city_id != $last_city) {
					$last_city = $row->city_id;
					?>
					<tr><th colspan="7"><?php echo $all_cities[$row->city_id]; ?></th></tr>
					<?php
				}
			?>
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
			</table>
		</div>
		 
    </div>
  </div>
</div>
</div>