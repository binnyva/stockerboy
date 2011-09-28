<script>
	$('#dash').addClass('active');
	$('#prod').removeClass('active');
	$('#stk').removeClass('active');
	$('#sls').removeClass('active');
	$('#fin').removeClass('active');
</script>
<div id="wraper">
  <div id="container">
    <div id="dashboard">
      <ul id="Status">
        <li>
          <h2>Sales
          </h2>
          <div class="inner-div">
            <h1><?php echo $total_sales ?></h1><span><?php echo $total_sales - $total_sales_last_week ?></span>
            <h3>Last Week: <?php echo $total_sales_last_week ?></h3>
          </div>
        </li>
        <li>
          <h2>Revenue
          </h2>
          <div class="inner-div">
            <h1><?php echo $total_revenue ?></h1><span><?php echo $total_revenue - $total_revenue_last_week ?></span>
            <h3>Last Week: <?php echo $total_revenue_last_week ?></h3>
          </div>
        </li>
        <li>
          <h2>Finance
          </h2>
          <div class="inner-div">
            <h1><?php echo $total_finance ?></h1><span><?php echo $total_finance - $total_finance_last_week ?></span>
            <h3>Last Week: <?php echo $total_finance_last_week ?></h3>
          </div>
        </li>
        <div class="heading"><span>Leaderboard</span></div>
		<li>
          <h2>Sales</h2>
          <div class="inner-div">
            <?php foreach ($leaderboard_sale as $city) { ?>
            <?php echo $city->name . '('.$city->sale.')' ?><br />
            <?php } ?>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
