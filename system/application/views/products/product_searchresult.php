<h2 class="heading">Product Type &gt; <?php echo $pname ?></h2>
   <div class="list-row">
   <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
      	<th></th>
        <th>Item Code</th>
		<th>Sex</th>
        <th>Size</th>
        <th>Color</th>
        <th>MRP</th>
        <th>National Cut</th>
        <th>City Cut</th>
      </tr>
   <?php
   	foreach($design->result_array() as $des)
	{
		
		$items = $all_items[$des['id']];
	?>
        <tr>
        	<td rowspan="<?php echo count($items); ?>" valign="top">
			<h3><?php echo $des['name'] ?></h3>
			<img src="<?php echo base_url()?>uploads/images/<?php echo $des['img_name'] ?>" height="200" /></td>
			<?php foreach($items as $row) { ?>
        	<td><?php echo $row->code ?></td>
			<td><?php echo $row->sex ?></td>
            <td><?php echo $row->size ?></td>
            <td><?php echo $row->color ?></td>
            <td><?php echo $row->price ?></td>
            <td><?php echo $row->national_cut ?></td>
            <td><?php echo $row->city_cut ?></td>
			</tr><tr>
			<?php } ?>
			<td colspan="8"><hr /></td>
        </tr>
    <?php
	}
   ?>
   </table>
   </div>