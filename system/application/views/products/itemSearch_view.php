<h2 class="heading">Product Type ></h2>
   <div class="list-row">
   <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
      	<th></th>
        <th>Item Code</th>
        <th>Size</th>
        <th>Color</th>
        <th>MRP</th>
        <th>National Cut</th>
        <th>City Cut</th>
      </tr>
   <?php
   	foreach($item->result_array() as $row)
	{
	?>
        <tr>
        	<td><img src="<?php echo base_url()?>uploads/images/<?= $row['img_name'] ?>" width="100" height="100" /></td>
        	<td><?= $row['code'] ?></td>
            <td><?= $row['size'] ?></td>
            <td><?= $row['color'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['national_cut'] ?></td>
            <td><?= $row['city_cut'] ?></td>
        </tr>
        
    <?php
	}
   ?>
   </table>
   </div>
   
   <!--
   <ul class="pagination">
            	<?php
				if(!isset($search_query)) $search_query = '';
				if($linkCounter>1)
				{
					if($currentPage != '0') { ?>
					<li class="button small pagePrev"> 
						<a href="javascript:get_itemList('<?php echo $currentPage-1; ?>','<?php echo $search_query; ?>');" title="Previous page"></a>
					</li>
					<?php } 
												
						$leftcount=$currentPage-4;
						$leftcount= ($leftcount <0 )?0:$leftcount;
						$rightcount=$currentPage+4;
						$rightcount=($rightcount>$linkCounter)?$linkCounter:$rightcount;
					
					for($i=$leftcount;$i<= $currentPage;$i++)
					{
						if($i <> $currentPage)
						{
					?>
	
							<li class="first"><a href="javascript:get_itemList('<?=$i?>','<?php echo $search_query; ?>')" > <?=$i+1?></a></li>
					<?php 
						}
						else 
						{
					?>
							<li  class="active"><a href="javascript:get_itemList('<?php echo $i; ?>','<?php echo $search_query; ?>');"><?=$i+1?></a></li> 
					<?php      
								/// Current page is not displayed as link and given font r 
	
						}
					}
	
					for($i=$currentPage+1;$i< $rightcount;$i++)
					{
					?>
						<li ><a href="javascript:get_itemList('<?php echo $i?>','<?php echo $search_query; ?>');" ><?php echo $i+1?></a></li> 
					<?php
					}
					
					if($currentPage+1 != $linkCounter && $linkCounter != 0) { ?>
					<li class="button small pageNext"> 
						<a href="javascript:get_itemList('<?php echo $currentPage+1; ?>','<?php echo $search_query; ?>');" title="Next page"></a>
					</li>
					<?php } 
				
				}
				?>
	</ul>
	-->
	