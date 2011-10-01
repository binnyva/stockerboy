<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui.css" />
    <script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/exporting.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'chart',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Sales',
         x: -20 //center
      },
     
      xAxis: {
         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      yAxis: {
         title: {
            text: 'Sales'
         },
         plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
         }]
      },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               this.x +': '+ this.y +'Â°C';
         }
      },
      legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'top',
         x: -10,
         y: 100,
         borderWidth: 0
      },
      series: [{
         name: 'This Week',
         data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
      }, {
         name: 'Previous Week',
         data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
      }]
   });
   
   
});
</script>

<script type="text/javascript">
	$('#dash').removeClass('active');
	$('#prod').removeClass('active');
	$('#stk').removeClass('active');
	$('#sls').addClass('active');
	$('#fin').removeClass('active');


 
	$(function() {
		$("#date_from" ).datepicker();
		$("#date_to" ).datepicker();
		$("#anim" ).val(function() {
			$("#date_from" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#date_to" ).datepicker( "option", "showAnim", $( this ).val() );
		});
	});
	
	function add_sales()
	{
		var item_code = $('#items').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		
		if(item_code == "")
		{
				alert("Enter Item Code");
		}
		else if(phone == "Phone Number")
		{
				alert("Enter Phone Number");
		}
		else if(email == "E-Mail")
		{
				alert("Enter Email");
		}
		
		else
		{
			$.ajax({
			type: "POST",
			url: "<?= site_url('sales/add_sales')?>",
			data: "item_code="+item_code+'&phone='+phone+'&email='+email,
			success: function(msg){
				$('#msg_div').html(msg);
			}
			});
		}
	}
	
	</script>
<div id="wraper">
  <div id="container">
    <div id="products">
        <ul class="tabs">
        <li><a href="#tab1">Sales</a></li>
        <li><a href="#tab2">Revenue</a></li>
    	</ul>
    
        <div class="tab_container">
            <div id="tab1" class="tab_content">
           	  <h2 class="heading">Enter Sales</h2>
              <div id="msg_div"></div>
              <div class="padd3">
				<select name="items" id="items" tabindex="1" class="select">
                  <option value="">Item Code</option>
                  <?php foreach($item->result_array() as $row): ?>
                      <option value="<?= $row['id'] ?>"><?= $row['code'] ?></option>
                  <?php endforeach; ?>
                </select>
<input name="phone" id="phone" type="text" class="text" value="Phone Number" onfocus="if(this.value=='Phone Number'){this.value=''};" onblur="if(this.value==''){this.value='Phone Number'};" />
<input name="email" id="email" type="text" class="text" value="E-Mail" onfocus="if(this.value=='E-Mail'){this.value=''};" onblur="if(this.value==''){this.value='E-Mail'};" />
<input name="button" type="button" class="addButton" id="button" value="" onclick="javascript:add_sales();" />
<!--<a href="#" class="addmoreLink right">Add 10 items at a time?</a>-->
              </div>
              <h2 class="heading">Sales Chart</h2>
              <div class="row"><h4 class="left">Sales</h4>
                <div class="fromTo"><span class="left"> Select a date range:</span><input name="date_from" id="date_from" type="text" class="textSmall" /><span class="left">To:</span><input name="date_to" id="date_to" type="text" class="textSmall" /><input type="hidden" id="anim" value="clip" /> </div>
              </div>
              <div class="graph">
              	<div id="chart" align="center" style="width: 100%; height: auto; float:left; margin: 0 auto;"></div>
              </div>
              <h2 class="heading">Sales Leaderboard</h2>
              <table width="470" border="0" cellpadding="20" cellspacing="0" class="salesTable" style="margin-left:230px;">
  <tr>
    <th width="90">Rank</th>
    <th width="265">City</th>
    <th width="113">Sales</th>
  </tr>
  <tr>
    <td align="center">1</td>
    <td>Hydrabad</td>
    <td align="center">2434</td>
  </tr>
  <tr class="bg">
    <td align="center">2</td>
    <td>Chennai</td>
    <td align="center">6546</td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td>Cochin</td>
    <td align="center">75675</td>
  </tr>
  <tr class="bg">
    <td align="center">4</td>
    <td>Banglore</td>
    <td align="center">8799</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr class="bg">
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
              <div class="sort">
                <div><label>
<input name="checkbox" type="checkbox" class="checkbox" id="checkbox" />
                  Today</label>
                  <label>
                    <input name="checkbox2" type="checkbox" class="checkbox" id="checkbox2" />
                    Yesterdy</label>
                    <label>
                    <input name="checkbox3" type="checkbox" class="checkbox" id="checkbox3" />
                    This Week</label>
                </div>
                <div><label>
                    <input name="checkbox4" type="checkbox" class="checkbox" id="checkbox4" />
                    Select a date range </label><input name="" type="text" class="textSmall" /><span class="left">To</span><input name="" type="text" class="textSmall" /></div>
              </div>
            </div>
            <div id="tab2" class="tab_content">
      		</div>
      </div>
    </div>
  </div>
</div>
