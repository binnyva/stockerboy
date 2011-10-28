	<?php
	if($count > 0)
   {
	?>
   <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th>Item Code</th>
		<th>Sex</th>
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
        	<td align="center"><?= $row['code'] ?></td>
            <td align="center"><?= $row['sex'] ?></td>
            <td align="center"><?= $row['size'] ?></td>
            <td align="center"><?= $row['color'] ?></td>
            <td align="center"><?= $row['amount'] ?></td>
            <td align="center"><?= $row['national_cut'] ?></td>
            <td align="center"><?= $row['city_cut'] ?></td>
        </tr>
   <?php
	}
  
   ?>
   </table>
   <?php
    }
   else
   {
   	echo "No result found";
   }
   ?>
