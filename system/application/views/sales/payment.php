<script type="text/javascript">
	$('#dash').removeClass('active');
	$('#prod').removeClass('active');
	$('#stk').removeClass('active');
	$('#sls').addClass('active');
	$('#fin').removeClass('active');
	
	function validate(e)
	{
		var amt = document.getElementsByName("pay_amt");
		if(amt.value == '') 
		{
			$(pay_amt).css("background-color","#fee9d7");
			error_count++;
		} 
		else 
		{
			$(pay_amt).css("background-color","white");
		}
	}
</script>
<?php
foreach($rev->result_array() as $row)
{
	$amount = $row['amount_to_pay'];
	$city = $row['name'];
	$added = $row['added_on'];
	$rid = $row['id'];
}
?>
<div id="wraper">
  <div id="container">
    <div id="products">
        <ul class="tabs">
        <li><a href="#tab1">Payment</a></li>
    	</ul>
    
        <div class="tab_container">
        <div id="tab1" class="tab_content">
        <form action="<?php echo site_url('sales/add_payment')?>" method="post" id="sales-form" onSubmit="return validate();">
           	<div class='item-1'>
            <div style="float:left; width:200px;">City</div>
            <input name="city"  type="text" class="text" value="<?php echo $city ?>" /><br />
            </div>
            <div class='item-1'>
            <div style="float:left; width:200px;">Amount</div>
            <input name="amount"  type="text" class="text" value="<?= $amount ?>" /><br />
            </div>
            <div class='item-1'>
            <div style="float:left; width:200px;">Added</div>
            <input name="added"  type="text" class="text" value="<?= $added ?>" /><br />
            </div>
            <div class='item-1'>
            <div style="float:left; width:200px;">Amount for pay</div>
            <input name="pay_amt"  type="text" class="text" value="" /><br />
            </div>
            <input name="rid"  type="hidden" class="text" value="<?= $rid ?>" />
            <input name="button" type="submit" class="addButton" id="button" value="" />
         </form>
      	</div>

</div>
  </div>
</div>
</div>