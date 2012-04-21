<script type="text/javascript">
$('#dash').removeClass('active');
	$('#prod').removeClass('active');
	$('#stk').removeClass('active');
	$('#sls').removeClass('active');
	$('#slss').removeClass('active');
	$('#fin').addClass('active');
</script>
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
	<tr><th>City</th><th>Total Payment</th><th>Pending Payment</th><th>Added Date</th></tr>

	<?php foreach($pending as $row) { ?>
	<tr>
		<td><?php echo $row->name ?></td>
		<td><?php echo $row->amount ?></td>
		<td><?php echo $row->amount_to_pay ?></td>
		<td><?php echo date('dS M, Y', strtotime($row->added_on)); ?></td>
	</tr>
	<?php } ?>
	</table>
  
	</div>
	
	
	<div id="tab2" class="tab_content">
	
	<h2 class="heading">Sent Payments</h2>
	
	<table class="data-table">
	<tr><th>City</th><th>Payment Made</th><th>Payment Date</th><th>Actions</th></tr>

	<?php foreach($sent_payments as $row) { ?>
	<tr>
		<td><?php echo $row->name ?></td>
		<td><?php echo $row->amount_paid ?></td>
		<td><?php echo date('dS M, Y', strtotime($row->paid_on)); ?></td>
		<td><?php if($row->status == 'transit') { ?><a href="<?php echo site_url('revenue/payment_received/'.$row->id); ?>">Recieved</a> / <a href="<?php echo site_url('revenue/payment_failed/'.$row->id); ?>">Failed</a><?php }
			else { echo ucfirst($row->status); } ?></td>
	</tr>
	<?php } ?>
	</table>
	
	</div>
	</div>
	</div>
  </div>
</div>
