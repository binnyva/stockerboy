 
<div id="wraper">
  <div id="container">
    <div id="dispatch-details">
		<ul class="tabs"></ul>
		<div class="tab_container">
		<h2 class="heading">Dispatch Details - <?php
			if($details->status == 'transit') echo 'In Transit'; 
			else if($details->status == 'failed') echo '<span class="error">Failed</span>';
			else echo '<span class="success">Reached</span>'; 
		?></h2>
		 
		<div class="padd3">
			<ul>
			<li><strong>From:</strong> <?php echo $all_cities[$details->from_city_id] ?></li>
			<li><strong>To:</strong> <?php echo $all_cities[$details->to_city_id] ?></li>
			<li><strong>Dispatch On:</strong> <?php echo $details->left_on ?></li>
			<li><strong>Courier Number:</strong> <?php echo $details->courier_number ?></li>
			<li><strong>Estimated Arrival:</strong> <?php echo $details->estimated_delivery_on ?></li>
			<?php if($details->reached_on != '0000-00-00 00:00:00') { ?>
			<li><strong>Reached On:</strong> <?php echo $details->reached_on ?></li>
			<?php } ?>
			</ul>
			
			<h3>Items</h3>
			<table class="data-table">
			<tr><th>Item</th><th>Amount</th></tr>
			<?php foreach($items as $row) { ?>
				<tr><td><?php echo $row->code ?></td><td><?php echo $row->amount ?></td></tr>
				<?php } ?>
			</table>
			<br /><br />
			
			<?php if($details->status == 'transit') { ?>
			<a href="<?php echo site_url('stock/dispatch_received/'.$details->id); ?>">Recieved Shipment</a><br />
			<a href="<?php echo site_url('stock/dispatch_failed/'.$details->id); ?>">Shipment Failed</a>
			<?php } ?>
		</div>
		
		
		</div>
    </div>
  </div>
</div>
