</div>
</div>
         
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
                	<input name="pro_type" id="pro_type" type="text" class="textfield-large" value="Add product type" onfocus="if(this.value=='Add product type'){this.value=''};" onblur="if(this.value==''){this.value='Add product type'};" />
                	<input name="" type="button" class="addButton" value="" onClick="javascript:add_product_type();" />
                </div>
        		</div>
        		 
        		 <div id="add_size" class="hide">
                 <div class="padd">
        		 <select name="sptype" id="sptype" tabindex="1" class="select" onchange="javascript:design_drop(this.value);">
                  <option value="">Product Type</option>
                  <?php foreach($product_type->result_array() as $sprow): ?>
                      <option value="<?= $sprow['id'] ?>"><?= $sprow['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div id="design_div">
                <select name="sdesign" id="sdesign" tabindex="1" class="select">
                  <option value="">Design</option>
                  <?php /*?><?php foreach($design->result_array() as $sdrow): ?>
                      <option value="<?= $sdrow['id'] ?>"><?= $sdrow['name'] ?></option>
                  <?php endforeach; ?><?php */?>
                </select>
                </div>
                 <select name="size" id="size" tabindex="1" class="select">
                  <option value="">Size</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XXL">XXL</option>
                </select>
                <input name="" type="button" class="addButton" value="" onClick="javascript:add_size();" />
                 </div>
        		 </div>
        		 
        		 <div id="add_color" class="hide">
                 <div class="padd">
        		 <select name="ptype" id="ptype" tabindex="1" class="select" onchange="javascript:design_drop_color(this.value);">
                  <option value="">Product Type</option>
                  <?php foreach($product_type->result_array() as $prow): ?>
                      <option value="<?= $prow['id'] ?>"><?= $prow['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div id="designcolor_div">
                <select name="design" id="design" tabindex="1" class="select">
                  <option value="">Design</option>
                  <?php /*?><?php foreach($design->result_array() as $drow): ?>
                      <option value="<?= $drow['id'] ?>"><?= $drow['name'] ?></option>
                  <?php endforeach; ?><?php */?>
                </select>
                </div>
                <input name="color" id="color" type="text" class="text" value="Color" onfocus="if(this.value=='Color'){this.value=''};" onblur="if(this.value==''){this.value='Color'};" />
                <input name="" type="button" class="addButton" value="" onClick="javascript:add_color();" />
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
                            <input type="hidden" name="maxW" value="100" />
                            <input type="hidden" name="relPath" value="../uploads/images/" />
                            <input type="hidden" name="colorR" value="255" />
                            <input type="hidden" name="colorG" value="255" />
                            <input type="hidden" name="colorB" value="255" />
                            <input type="hidden" name="maxH" value="200" />
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
                 <div class="padd3">
                                  
        		 <select name="cptype" id="cptype" tabindex="1" class="select" onchange="javascript:design_drop_code(this.value);">
                  <option value="">Product Type</option>
                  <?php foreach($product_type->result_array() as $cprow): ?>
                      <option value="<?= $cprow['id'] ?>"><?= $cprow['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div id="code_design">
                <select name="cdesign" id="cdesign" tabindex="1" class="select">
                  <option value="">Design</option>
                  <?php /*?><?php foreach($design->result_array() as $cdrow): ?>
                      <option value="<?= $cdrow['id'] ?>"><?= $cdrow['name'] ?></option>
                  <?php endforeach; ?><?php */?>
                </select>
                </div>
                <div id="sizecolor_div">
                <select name="csize" id="csize" tabindex="1" class="select">
                  <option value="">Size</option>
                  
                </select>
                <select name="cod_color" id="cod_color" tabindex="1" class="select">
                  <option value="">Color</option>
                  
                </select>
                </div>
                </div>
                
                <div class="padd3">
                
                <select name="sex" id="sex" tabindex="1" class="select">
                  <option value="">Sex</option>
                  <option value="m">Male</option>
                  <option value="f">Female</option>
                </select>
                
                <input name="mrp" id="mrp" type="text" class="text" value="MRP" onfocus="if(this.value=='MRP'){this.value=''};" onblur="if(this.value==''){this.value='MRP'};" />
                
                <input name="national" id="national" type="text" class="text" value="National Cut" onfocus="if(this.value=='National Cut'){this.value=''};" onblur="if(this.value==''){this.value='National Cut'};" />
                
                <input name="city" id="city" type="text" class="text" value="City Cut" onfocus="if(this.value=='City Cut'){this.value=''};" onblur="if(this.value==''){this.value='City Cut'};" />
                
                
                
                
                 </div>
                 <div class="padd3">
                 	
                 	<input name="" type="button" class="addButton" value="" onClick="javascript:add_itemcode();" />
                 </div>
        		 </div>
        	 </div> <!-- END List Wrap -->
         
         </div>
            </div>
        </div>
    </div>
  </div>
</div>
