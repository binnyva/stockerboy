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
		var ptype = $('#img1').val();
		//alert(ptype);
		
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
                 	<div class="row">
                    	<select name="p_type1" id="p_type1" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname1" id="dname1" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img1" id="img1" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type2" id="p_type2" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname2" id="dname2" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img2" id="img2" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type3" id="p_type3" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname3" id="dname3" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img3" id="img3" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type4" id="p_type4" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname4" id="dname4" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img4" id="img4" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type5" id="p_type5" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname5" id="dname5" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img5" id="img5" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type6" id="p_type6" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname6" id="dname6" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img6" id="img6" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type7" id="p_type7" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname7" id="dname7" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img7" id="img7" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type8" id="p_type8" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname8" id="dname8" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img8" id="img8" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type9" id="p_type9" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname9" id="dname9" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img9" id="img9" >
                    </div>
                    
                    <div class="row">
                    	<select name="p_type10" id="p_type10" tabindex="1" class="select">
                          <option selected="selected">Product Type</option>
                          <option >Prototype Combobox</option>
                          <option>jQuery Tabs</option>
                          <option>Common Accordion</option>
                        </select>
                        
                        <input name="dname10" id="dname10" type="text" class="textfield-large" value="Design Name" onfocus="if(this.value=='Design Name'){this.value=''};" onblur="if(this.value==''){this.value='Design Name'};" />
                        
                        <input type="file" name="img10" id="img10" >
                    </div>
                    
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
