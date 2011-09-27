<script type="text/javascript" src="<?php echo base_url()?>js/ajaxupload.js"></script>
<script type="text/javascript">
	$('#dash').removeClass('active');
	$('#prod').addClass('active');
	$('#stk').removeClass('active');
	$('#sls').removeClass('active');
	$('#fin').removeClass('active');
	
	function add_product_type()
	{
		var ptype = $('#pro_type').val();
		if(ptype == "")
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
                <!--Content-->
            </div>
            <div id="tab2" class="tab_content">
               <div id="example-one">
        			
        	<ul class="nav">
                <li class="nav-one"><a href="#add_product" class="current">Add Product type</a></li>
                <li class="nav-two"><a href="#add_size">Add Size</a></li>
                <li class="nav-three"><a href="#add_color">Add Color</a></li>
                <li class="nav-four"><a href="#add_design">Add Design</a></li>
                <li class="nav-fifth last"><a href="#add_code">Add Item Code</a></li>
            </ul>
        	
        	<div class="list-wrap">
        		<div id="msg_div"></div>
        		<div id="add_product">
                <div class="padd">
                	<input name="pro_type" id="pro_type" type="text" class="textfield-large" value="" />
                	<input name="" type="button" class="addButton" value="" onClick="javascript:add_product_type();" />
                </div>
        		</div>
        		 
        		 <div id="add_size" class="hide">
        		 </div>
        		 
        		 <div id="add_color" class="hide">
                 <div class="padd">
        		 <select name="ptype" id="ptype" tabindex="1" class="select">
                  <option selected="selected">Product Type</option>
                  <option >Prototype Combobox</option>
                  <option>jQuery Tabs</option>
                  <option>Common Accordion</option>
                </select>
                <select name="design" id="design" tabindex="1" class="select">
                  <option selected="selected">Design</option>
                  <option >Prototype Combobox</option>
                  <option>jQuery Tabs</option>
                  <option>Common Accordion</option>
                </select>
                <input name="color" id="color" type="text" class="text" value="" />
                <input name="" type="button" class="addButton" />
                 </div>
                 </div>
        		 
        		 <div id="add_design" class="hide">
                 <?php
				 	for($i=1; $i<=10; $i++)
					{
				 ?>
                 	<div class="row">
                    	<select name="p_type<?php echo $i; ?>" id="p_type<?php echo $i; ?>" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          	<?php foreach($product_type->result_array() as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <input name="dname<?php echo $i; ?>" id="dname<?php echo $i; ?>" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <form action="<?php echo base_url()?>js/ajaxupload.php" method="post" name="sleeker<?php echo $i; ?>" id="sleeker<?php echo $i; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="maxSize" value="9999999999" />
                            <input type="hidden" name="maxW" value="200" />
                            <input type="hidden" name="relPath" value="../uploads/images/" />
                            <input type="hidden" name="colorR" value="255" />
                            <input type="hidden" name="colorG" value="255" />
                            <input type="hidden" name="colorB" value="255" />
                            <input type="hidden" name="maxH" value="300" />
                            <input type="hidden" name="filename" value="filename" />
                            <input type="hidden" id="ids" name="ids" value="ids" />
                            <input type="file" name="filename" onChange="ajaxUpload(this.form,'<?php echo base_url()?>js/ajaxupload.php?filename=name&amp;maxSize=9999999999&amp;maxW=750&amp;relPath=<?php echo base_url()?>uploads/images /&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area<?php echo $i; ?>','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'<?php echo base_url()?>images/ico/spinner.gif\' style=\'border:none\' width=\'20\' height=\'20\' border=\'0\' /&gt;','&lt;img src=\'<?php echo base_url()?>images/ico/spinner.gif\' width=\'20\' height=\'20\' style=\'border:none\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
                            
                            <div style="margin-top:-5px;color:#666; float:right; line-height:30px; font-size:12px;">
                            <input type="hidden" id="upload_area<?php echo $i; ?>" name="upload_area<?php echo $i; ?>" value="" />
                           	</div>
                          
                        </form>
                        
                    </div>
                    <?php
					}
					?>
                   
                    
                    <div class="row">
                    	<input name="" type="button" class="addButton" value="" onClick="javascript:add_designs();" />
                    </div>
        		 </div>
        		 
                 <div id="add_code" class="hide">
        		 </div>
        	 </div> <!-- END List Wrap -->
         
         </div>
            </div>
        </div>
    </div>
  </div>
</div>
