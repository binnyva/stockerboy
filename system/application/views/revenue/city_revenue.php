<div id="wraper">
  <div id="container">
	<div id="products">
	
	<ul class="tabs">
	<li><a href="#tab1">Pending Amount</a></li>
	<li><a href="#tab2">Sent Payments</a></li>
	</ul>

	<div class="tab_container">
	<div id="tab1" class="tab_content">

	<h2 class="heading">Pending Amount</h2>
	
	<table class="data-table">
	<tr><th>Time Frame</th><th>Total Amount</th><th>Paid Amount</th><th>Pending</th><th>Action</th></tr>

	<?php foreach($pending as $row) { ?>
	<tr>
		<td><?php
			$time_stamp = strtotime($row->added_on);
			echo "Week " . date('W', $time_stamp). "<br /><small>" . date('M d', $time_stamp - (7 * 24 * 60 * 60)) . " to " . date('M d', $time_stamp) . "</small>";
		?></td>
		<td><?php echo $row->amount ?></td>
		<td><span class="<?php echo ($row->latest_payment and $row->latest_payment->status == 'received') ? 'good' : 'bad' ?>"><?php echo $row->amount - $row->amount_to_pay + $row->unapproved ?></span></td>
		<td><?php echo $row->amount_to_pay - $row->unapproved ?></td>
		
		<td><a href="<?php echo site_url('revenue/make_payment/'.$row->id) ?>">Make Payment</a></td>
	</tr>
	<?php } ?>
	</table>
  
	</div>
	
	
	<div id="tab2" class="tab_content">
	
	<h2 class="heading">Sent Payments</h2>
	
	<table class="data-table">
	<tr><th>Payment Made</th><th>Payment Date</th><th>Status</th></tr>

	<?php foreach($sent_payments as $row) { ?>
	<tr>
		<td><?php echo $row->amount_paid ?></td>
		<td><?php echo date('dS M, Y', strtotime($row->paid_on)); ?></td>
		<td><?php echo ucfirst($row->status)  ?></td>
	</tr>
	<?php } ?>
	</table>
	
	</div>
	</div>
	</div>
  </div>
</div>
