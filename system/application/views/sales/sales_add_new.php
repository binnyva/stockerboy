<script type="text/javascript">
	function validate(e) {
		var codes = document.getElementsByName("items[]");
		var no_tshirts = document.getElementsByName("no_tshirts[]");
		
		var item_count = 0;
		var error_count=0;
		for(var i=0; i<codes.length; i++) {
			if(codes[i].value && codes[i].value != "Item Code") {
				item_count++;
				
				if(no_tshirts[i].value == '' || no_tshirts[i].value == "Number of T-Shirts") {
					$(no_tshirts[i]).css("background-color","#fee9d7");
					error_count++;
				} else {
					$(no_tshirts[i]).css("background-color","white");
				}
				
				
			}
		}
		
		if(error_count) {
			alert("Make sure you enter all the data correctly before submitting.");
			return false;
		}
		if(item_count == 0) {
			alert("Please make sure that you have added atleast one item.");
			return false;
		}
		
		return true;
	}

	var item_count = 2;
	function addMoreItems(count) {
		var form_html = "<div class='item-"+item_count+"'>" + $("#sales-input").html() + "</div>";
		var extras = $("#extras").html();
		item_count++;
		
		for(var i=0; i<count; i++) extras += form_html;
		
		$("#extras").html(extras);
	}
	
	function add_sales()
	{
		var item_code = $('#items').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		
		if(item_code == "")
		{
				alert("Enter Item Code");
		}
		else if(phone == "Phone Number")
		{
				alert("Enter Phone Number");
		}
		else if(email == "E-Mail")
		{
				alert("Enter Email");
		}
		
		else
		{
			$.ajax({
			type: "POST",
			url: "<?php echo site_url('sales/add_sales')?>",
			data: "item_code="+item_code+'&phone='+phone+'&email='+email,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
</script>
<div id="wraper">
  <div id="container">
    <div id="products">
        <ul class="tabs">
        <li><a href="#tab1">Sales</a></li>
    	</ul>
    
        <div class="tab_container">
            <div id="tab1" class="tab_content">
           	  <h2 class="heading">Enter Sales</h2>
              <div id="msg_div"></div>
			  
			  <form action="<?php echo site_url('sales/add_sales_new')?>" method="post" id="sales-form" onSubmit="return validate();">
<div class="padd3"><div id="sales-input" class='item-1'>
<input name="items[]" type="text" class="text" value="Item Code" onfocus="if(this.value=='Item Code'){this.value=''};" onblur="if(this.value==''){this.value='Item Code'};" />
<input name="no_tshirts[]" type="text" class="text" value="Number of T-Shirts" onfocus="if(this.value=='Number of T-Shirts'){this.value=''};" onblur="if(this.value==''){this.value='Number of T-Shirts'};" /><br />
</div>
<div id="extras">
</div>
</div>

<a href="javascript:addMoreItems(10);" class="addmoreLink right">Add 10 more fields...</a><br />

<input name="button" type="submit" class="addButton" id="button" value="" />
<br />
			  </form>
