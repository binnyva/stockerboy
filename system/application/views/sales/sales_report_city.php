<div id="wraper">
  <div id="container">
    <div id="products">
		<ul class="tabs">
        <li><a href="#tab1">Sales</a></li>
        <!-- <li><a href="#tab2">Revenue</a></li> -->
    	</ul>

      
        <div class="tab_container">
            <div id="tab1" class="tab_content">
              <h2 class="heading">Sales By City In Week <?php echo date('M j', strtotime($from)) . ' - ' . date('M j', strtotime($to)) ?></h2>
              
              <table class="data-table" style="width:400px;">
				<tr><th>Code</th><th>Sales</th></tr>
				<?php
				$total = 0;
				foreach($sales_data as $row) {
					$total += $row->sales;
				?>
				<tr><td><?php echo $row->code ?></td><td><?php echo $row->sales ?></td></tr>
				<?php } ?>
				<tr><td><strong>Total</strong></td><td><?php echo $total ?></td></tr>
				</table>
 
			</div>
      		
      </div>
    </div>
  </div>
</div>