<script type="text/javascript" src="<?php echo base_url()?>js/ajaxupload.js"></script>
<script type="text/javascript">
	$('#dash').removeClass('active');
	$('#prod').addClass('active');
	$('#stk').removeClass('active');
	$('#sls').removeClass('active');
	$('#fin').removeClass('active');
	
	function design_drop(pid)
	{
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_design')?>",
		data: "pid="+pid,
		success: function(data){
			$('#design_div').html(data);
		}
		});	
	}
	
	function design_search(pid)
	{
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_design')?>",
		data: "pid="+pid,
		success: function(data){
			$('#design_search').html(data);
		}
		});	
	}
	
	function design_drop_color(pid)
	{
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_design_color')?>",
		data: "pid="+pid,
		success: function(data){
			$('#designcolor_div').html(data);
		}
		});	
	}
	
	function design_drop_code(pid)
	{
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_design_code')?>",
		data: "pid="+pid,
		success: function(data){
			$('#code_design').html(data);
		}
		});	
	}
	
	function size_color_drop(did)
	{
		//alert(did);
		var pid = $('#cptype').val();
		//alert(pid);
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_size_color')?>",
		data: "pid="+pid+'&did='+did,
		success: function(data){
			$('#sizecolor_div').html(data);
		}
		});	
	}
	
	function add_product_type()
	{
		var ptype = $('#pro_type').val();
		if(ptype == "Add product type")
		{
				alert("Enter Product Type");
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?= site_url('products/add_product_type')?>",
			data: "ptype="+ptype,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
	
	function add_size()
	{
		var ptype = $('#sptype').val();
		var design = $('#sdesign').val();
		var size = $('#size').val();
		if(ptype == "")
		{
				alert("Enter Product Type");
		}
		else if(design == "")
		{
			alert("Enter Design");
		}
		else if(size == "")
		{
			alert("Enter Size");
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?= site_url('products/add_size')?>",
			data: "ptype="+ptype+'&design='+design+'&size='+size,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
	
	function add_color()
	{
		var ptype = $('#ptype').val();
		var design = $('#design').val();
		var color = $('#color').val();
		if(ptype == "")
		{
				alert("Enter Product Type");
		}
		else if(design == "")
		{
			alert("Enter Design");
		}
		else if(color == "Color")
		{
			alert("Enter Color");
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?= site_url('products/add_color')?>",
			data: "ptype="+ptype+'&design='+design+'&color='+color,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
	
	function add_designs()
	{
		<?php
		for($i=1;$i<=10;$i++)
		{
		?>
			var ptype<?php echo $i; ?> = $('#p_type<?php echo $i; ?>').val();
			
			var dname<?php echo $i; ?> = $('#dname<?php echo $i; ?>').val();
			
			var img<?php echo $i; ?> = $('#upload_area<?php echo $i; ?>').val();
			
		
			$.ajax({
			type: "POST",
			url: "<?= site_url('products/add_design')?>",
			data: "ptype="+ptype<?php echo $i; ?>+'&dname='+dname<?php echo $i; ?>+'&img='+img<?php echo $i; ?>,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
			
		<?php
		}
		?>
		
	}
	
	function add_itemcode()
	{
		var ptype = $('#cptype').val();
		var design = $('#cdesign').val();
		var size = $('#csize').val();
		var color = $('#cod_color').val();
		
		var sex = $('#sex').val();
		var mrp = $('#mrp').val();
		var national = $('#national').val();
		var city = $('#city').val();
		
		if(ptype == "")
		{
				alert("Enter Product Type");
		}
		else if(design == "")
		{
			alert("Enter Design");
		}
		else if(size == "")
		{
			alert("Enter Size");
		}
		else if(color == "")
		{
			alert("Enter Color");
		}
		else if(sex == "")
		{
			alert("Enter Sex");
		}
		else if(mrp == "MRP")
		{
			alert("Enter MRP");
		}
		else if(national == "National Cut")
		{
			alert("Enter National Cut");
		}
		else if(city == "City Cut")
		{
			alert("Enter City Cut");
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?= site_url('products/add_itemcode')?>",
			data: "ptype="+ptype+'&design='+design+'&size='+size+'&color='+color+'&sex='+sex+'&mrp='+mrp+'&national='+national+'&city='+city,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
	
	function get_itemList(page_no,search_query)
	{
		
		//$('#loading-spinner').show();
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/get_itemList')?>",
		data: "pageno="+page_no+"&q="+search_query,
		success: function(msg){
			//$('#loading-spinner').hide();
			$('#update-div').html(msg);
			//alert(msg);
		}
		});
	}
	
	function triggerSearch()
	{
		q = $('#keyword').val();
		get_itemList('0',q);
	}
	
	function item_search(page)
	{
		var itemcode = $('#itemcode').val();
		var ptype = $('#product_type').val();
		var design_select = $('#design_select').val();
		var color_select = $('#color_select').val();
		$.ajax({
		type: "POST",
		url: "<?= site_url('products/item_search')?>",
		data: "itemcode="+itemcode+"&product_type="+ptype+"&design_select="+design_select+"&color_select="+color_select+"&page_no="+page,
		success: function(msg){
			//$('#loading-spinner').hide();
			$('#update-div').html(msg);
			//alert(msg);
		}
		});	
	}
	
</script>
<div id="wraper">
  <div id="container">
    <div id="products">
        <ul class="tabs">
        <li><a href="#tab1">Search Product</a></li>
        <li><a href="#tab2">Add Product</a></li>
    	</ul>
    
        <div class="tab_container">
            <div id="tab1" class="tab_content">
              <div id="example-two">
        	<div class="list-wrap">
        		<div>
        		  <div class="padd2">
                  <div class="row" style="margin-bottom:10px;">
                  <input name="keyword" id="keyword" type="text" class="textfield" style="width:97%" value="Enter Keyword" onfocus="if(this.value=='Enter Keyword'){this.value=''};" onblur="if(this.value==''){this.value='Enter Keyword'};" onKeyUp="javascript:triggerSearch();" autocomplete="off" />
                  </div>
                  <div class="row" style="margin-bottom:10px;">
                  <input name="itemcode" id="itemcode" type="text" class="text" value="Item Code" onfocus="if(this.value=='Item Code'){this.value=''};" onblur="if(this.value==''){this.value='Item Code'};" />
		            <select name="product_type" id="product_type" class="select">
                    	<option value="">Product</option>
                    	<?php foreach($product_type->result_array() as $row): ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

					<div id="design_search">
                    <select name="design_select" id="design_select" class="select">
                    	<option value="">Design</option>
                    	<?php foreach($design->result_array() as $cdrow): ?>
                            <option value="<?php echo $cdrow['id'] ?>"><?php echo $cdrow['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>

					<div id="color_search">
                    <select name="color_select" id="color_select" class="select">
                    	<option value="">Size</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                    </div>
					
					<div id="sex_search">
                    <select name="sex_select" id="sex_select" class="select">
                    	<option value="">Sex</option>
						<option value="f">F</option>
						<option value="m">M</option>
                    </select>
                    </div>
					</div>
                    <div class="row" style="text-align:center">
					<input name="" type="button" class="searchButton" onClick="javascript:item_search('0')" />
					</div>
                  </div>
              </div>
        	 </div> <!-- END List Wrap -->
         </div>
         
         <div class="searchResults">
         <div id="update-div">