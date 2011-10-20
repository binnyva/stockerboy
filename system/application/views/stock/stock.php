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
        <input name="button" type="button" class="searchButton" id="button" value="" onClick="javascript:search_item();" />
        </div>
        <div id="extras" style="padding-top:50px;">
        </div>
        </div>
			 
      </div>
    </div>
  </div>
</div>
</div>