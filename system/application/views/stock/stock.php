<script type="text/javascript">
	$('#dash').removeClass('active');
	$('#prod').removeClass('active');
	$('#stk').addClass('active');
	$('#sls').removeClass('active');
	$('#fin').removeClass('active');
	
	function search_item()
	{
		var code = $('#code').val();
		$.ajax({
		type: "POST",
		url: "<?php echo site_url('stock/search_item')?>",
		data: "code="+code,
		success: function(msg){
			$('#extras').html(msg);
		}
		});
	}

var item_count = 2;
function addMoreItems(count) {
	var extras = $("#extras").html();
	
	for(var i=item_count; i<item_count+count; i++) extras += "<div class='item-"+i+"'>" + $("#dispatch-input").html() + "</div>";
	
	item_count += count;
	
	$("#extras").html(extras);
}

function stock_by_city(cid)
{
	$.ajax({
	type: "POST",
	url: "<?= site_url('stock/get_stock_by_city')?>",
	data: "cid="+cid,
	success: function(data){
		$('#stock-table').html(data);
	}
	});	
}
</script>

<div id="wraper">
  <div id="container">
    <div id="products">
		<ul class="tabs">
        <li><a href="#tab1">Stock</a></li>
        <li><a href="#tab2">Dispatch</a></li>
        <li><a href="#tab3">Receive</a></li>
    	</ul>
    
        <div class="tab_container">
        
		<div id="tab1" class="tab_content">
			<h2 class="heading">Stock</h2>
			
			<?php if($this->session->userdata('type') == 'national') { ?>
			<div class="padd3"><div id="stock-input">
			<h3>Add Stock</h3>
			<form action="<?php echo site_url('stock/add_stock'); ?>" method="post">
			<input name="item_code" id="item_code" type="text" class="text" value="Item Code" onfocus="if(this.value=='Item Code'){this.value=''};" onblur="if(this.value==''){this.value='Item Code'};" />
			<input name="amount" type="text" type="text" class="text" value="Amount" onfocus="if(this.value=='Amount'){this.value=''};" onblur="if(this.value==''){this.value='Amount'};" /><br style="clear:both;" />
			
			<?php echo form_submit('action','Add Stock', 'class="submit"'); ?>
			<!--<input name="button" type="button" class="searchButton" id="button" value="" onClick="javascript:search_item();" />-->
			</form>
			</div></div>
			<?php } ?>
			
			<h3>Current Stock</h3>
			<?php echo form_dropdown('to_city_id', $all_cities, '', 'class="select" onchange="javascript:stock_by_city(this.value);"'); ?>
                <table class="data-table" id="stock-table">
                <tr><th>Code</th><th>Photo</th><th>Sex</th><th>Size</th><th>Colour</th><th>Number</th><th>Price</th></tr>
                <?php foreach($stock_data as $row) { ?>
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
		
		
		<div id="tab2" class="tab_content">
			<h2 class="heading">Dispatch</h2>
				
			<div class="padd3">
			<form action="<?php echo site_url('stock/add_dispatch') ?>" class="form-area" method="post">
			<div id="dispatch-input" class='item-1'>
			<input name="item_code[]" type="text" class="text" value="Item Code" onfocus="if(this.value=='Item Code'){this.value=''};" onblur="if(this.value==''){this.value='Item Code'};" />
			<input name="amount[]" type="text" class="text" value="Number" onfocus="if(this.value=='Number'){this.value=''};" onblur="if(this.value==''){this.value='Number'};" /><br />
			</div>
			<div id="extras">
			</div>

			<a href="javascript:addMoreItems(10);" class="addmoreLink">Add 10 more fields...</a><br />
			
			<div id="dispatch-details">
			<label>To City</label><?php echo form_dropdown('to_city_id', $all_cities, '', 'class="select" onchange="javascript:design_drop(this.value);"'); ?><br />
			<label>Estimated Delivery Date</label><?php echo form_input('estimated_delivery_on','','class="text"'); ?>Use YYYY-MM-DD format.<br />
			<label>Courier Number</label><?php echo form_input('courier_number','','class="text"'); ?><br />
			</div>
			
			<?php echo form_submit('action','Dispatch', 'class="submit"'); ?>
			</form>
			</div>
        </div>
        
        <div id="tab3" class="tab_content">
			<h2 class="heading">Receive Dispatch</h2>
			
			<div class="padd3">
			<table class="data-table">
			<tr><th>Dispatch Number</th><th>From</th><th>Total Items</th><th>Estimated Arrival</th><th>Status</th></tr>
			<?php foreach($dispatches as $row) { ?>
			<tr><td><a href="<?php echo site_url('stock/dispatch_details/'.$row->id); ?>"><?php echo $row->id ?></a></td><td><?php echo $all_cities[$row->from_city_id] ?></td><td><?php echo $row->amount ?></td><td><?php echo $row->estimated_delivery_on ?></td>
				<td><a href="<?php echo site_url('stock/dispatch_received/'.$row->id); ?>">Recieved</a> <a href="<?php echo site_url('stock/dispatch_failed/'.$row->id); ?>">Failed</a></td></tr>
			<?php } ?>
			</table>
			</div>
			
			
			<h2 class="heading">Past Dispatches</h2>
			
			<div class="padd3">
			<table class="data-table">
			<tr><th>Dispatch Number</th><th>From</th><th>Total Items</th><th>Arrival</th><th>Status</th></tr>
			<?php foreach($past_dispatches as $row) { ?>
			<tr><td><a href="<?php echo site_url('stock/dispatch_details/'.$row->id); ?>"><?php echo $row->id ?></a></td>
				<td><?php echo $all_cities[$row->from_city_id] ?></td><td><?php echo $row->amount ?></td><td><?php echo $row->reached_on ?></td>
				<td><?php echo ucfirst($row->status) ?></td></tr>
			<?php } ?>
			</table>
			</div>
		</div>
			 
    </div>
  </div>
</div>
</div>