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
		url: "<?= site_url('stock/search_item')?>",
		data: "code="+code,
		success: function(msg){
			$('#extras').html(msg);
		}
		});
	}
	
	function search_item1()
	{
		var design = $('#design').val();
		var size = $('#size').val();
		var sex = $('#sex').val();
		var color = $('#color').val();
		
		$.ajax({
		type: "POST",
		url: "<?= site_url('stock/search_item1')?>",
		data: "design="+design+'&size='+size+'&sex='+sex+'&color='+color,
		success: function(msg){
			$('#extras').html(msg);
		}
		});
	}
	
	function show_div()
	{
		$('#next_div').show();
		$('#next').hide();
		$('#but_div1').hide();
		$('#button1').show();
	}
</script>

<div id="wraper">
  <div id="container">
    <div id="products">
        
    
        <div class="tab_container">
            <div id="tab1" class="tab_content">
           	  <h2 class="heading">Stock</h2>
              <div id="msg_div"></div>
              
      	<div class="padd3"><div id="sales-input" class='item-1'>
        <input name="code" id="code" type="text" class="text" value="Item Code" onfocus="if(this.value=='Item Code'){this.value=''};" onblur="if(this.value==''){this.value='Item Code'};" />
        <div id="next_div" style="display:none">
        	<select id="design" class="text">
            	<option value="">Design</option>
                <?php foreach($design->result_array() as $sdrow): ?>
                  <option value="<?= $sdrow['id'] ?>"><?= $sdrow['name'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <select id="size" class="text">
            	<option value="">Size</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
            
            <select id="sex" class="text">
            	<option value="">Sex</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
            </select>
            
            <select id="color" class="text">
            	<option value="">Color</option>
                <?php foreach($color->result_array() as $crow): ?>
                  <option value="<?= $crow['color'] ?>"><?= $crow['color'] ?></option>
              	<?php endforeach; ?>
            </select>
        </div>
        <div id="but_div1" style="float:left;"><input name="button" type="button" class="searchButton" id="button" value="" onClick="javascript:search_item();" /></div>
        <div style="float:left;"><input name="button" type="button" class="searchButton" id="button1" value="" onClick="javascript:search_item1();" style="display:none" /><input name="button" type="button" class="searchButton" id="next" value="Next" onClick="javascript:show_div();" /></div>
        </div>
        <div id="extras" style="padding-top:50px;">
        </div>
        </div>
			 
      </div>
    </div>
  </div>
</div>
</div>