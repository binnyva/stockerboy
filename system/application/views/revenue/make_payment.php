<div id="wraper">
  <div id="container">
	<div id="products">
	<h2 class="heading">Make Payment</h2>
	
	<p>Payment towards amount <?php echo $revenue->amount ?> that was added to the system on <?php echo date('dS, M Y', strtotime($revenue->added_on)) ?>. Amount left to be paid is <?php echo $revenue->amount_to_pay ?>.</p>
	
	<form action="" method="post">
		<div class="padd3"><div id="sales-input" class='item-1'>
		<input name="amount" type="text" class="text" value="Amount" onfocus="if(this.value=='Amount'){this.value=''};" onblur="if(this.value==''){this.value='Amount'};" />
		</div><br />
		
		<input name="action" type="submit" value="Make Payment" />
		</div>

	</form>
	
	</div>
  </div>
</div>
