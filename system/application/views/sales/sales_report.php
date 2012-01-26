<div id="wraper">
  <div id="container">
    <div id="products">
		<ul class="tabs">
        <li><a href="#tab1">Sales</a></li>
        <!-- <li><a href="#tab2">Revenue</a></li> -->
    	</ul>

      
        <div class="tab_container">
            <div id="tab1" class="tab_content">
              <h2 class="heading">Sales By City</h2>
              
              <table class="data-table" style="width:400px;">
				<tr><th>City</th><th>Sales</th></tr>
				<?php 
				$total = 0;
				foreach($city_sales as $row) {
					$total += $row->sales;
				?>
				<tr><td><?php echo $row->name ?></td><td><a href="<?php echo site_url('sales/sales_report_city/'.$row->city_id.'/'.$from.'/'.$to); ?>"><?php echo $row->sales ?></a></td></tr>
				<?php } ?>
				<tr><td><strong>Total</strong></td><td><?php echo $total ?></td></tr>
				</table>
 
			</div>
      		
      </div>
    </div>
  </div>
</div>