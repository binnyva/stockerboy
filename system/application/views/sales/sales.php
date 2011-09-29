<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui.css" />
    <script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>

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
              <div class="padd3">
<input name="textfield" type="text" class="text" id="textfield" />
<input name="textfield2" type="text" class="text" id="textfield2" />
<input name="textfield3" type="text" class="text" id="textfield3" />
<input name="button" type="submit" class="addButton" id="button" value="" />
<a href="#" class="addmoreLink right">Add 10 items at a time?</a>
              </div>
              <h2 class="heading">Sales Chart</h2>
              <div class="row"><h4 class="left">Sales</h4>
                <div class="fromTo"><span class="left"> Select a date range:</span><input name="date_from" id="date_from" type="text" class="textSmall" /><span class="left">To:</span><input name="date_to" id="date_to" type="text" class="textSmall" /><input type="hidden" id="anim" value="clip" /> </div>
              </div>
              <div class="graph">Content for  class "graph" Goes Here</div>
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
