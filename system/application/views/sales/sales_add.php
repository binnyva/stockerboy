]
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
		$("#ldate_from" ).datepicker();
		$("#ldate_to" ).datepicker();
		$("#sale_frm" ).datepicker();
		$("#sale_to" ).datepicker();
		$("#rev_frm" ).datepicker();
		$("#rev_to" ).datepicker();
		
		$("#anim" ).val(function() {
			$("#date_from" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#date_to" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#ldate_from" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#ldate_to" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#sale_frm" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#sale_to" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#rev_frm" ).datepicker( "option", "showAnim", $( this ).val() );
			$("#rev_to" ).datepicker( "option", "showAnim", $( this ).val() );
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
	
	function leaderboard(value)
	{
		//$('#loading-spinner').show();
            $.ajax({
            type: "POST",
            url: "<?= site_url('sales/leaderboard')?>",
            data: "value="+value,
            success: function(msg){
				//$('#loading-spinner').hide();
				$('#leaderboard').html(msg);
            }
            });
	}
	
	function leaderboard_wk()
	{
		 $.ajax({
            type: "POST",
            url: "<?= site_url('sales/leaderboard_wk')?>",
           
            success: function(msg){
				//$('#loading-spinner').hide();
				$('#leaderboard').html(msg);
            }
            });
	}
	
	function leaderboard_revenue(value)
	{
		//$('#loading-spinner').show();
            $.ajax({
            type: "POST",
            url: "<?= site_url('sales/leaderboard')?>",
            data: "value="+value,
            success: function(msg){
				//$('#loading-spinner').hide();
				$('#leaderboard_revenue').html(msg);
            }
            });
	}
	
	function leaderboard_revenue_wk()
	{
		 $.ajax({
            type: "POST",
            url: "<?= site_url('sales/leaderboard_wk')?>",
           
            success: function(msg){
				//$('#loading-spinner').hide();
				$('#leaderboard_revenue').html(msg);
            }
            });
	}
	
	function plot_sales_graph()
	{
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();
		//alert(date_from);
		//alert(date_to);
		$.ajax({
            type: "POST",
            url: "<?= site_url('sales/plot_sales_graph')?>",
            data: "date_from="+date_from+'&date_to='+date_to,
            success: function(msg){
				//$('#loading-spinner').hide();
				$('#sales_graph').html(msg);
            }
            });
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
                 <!--onChange="javascript:plot_sales_graph();"-->
              </div>
              <div class="graph">
                  <div id="sales_graph">
                    <div id="chart" align="center" style="width: 100%; height: auto; float:left; margin: 0 auto;"></div>
                  </div>
              </div>
              <h2 class="heading">Sales Leaderboard</h2>
              	<div id="leaderboard">
                <script>
					leaderboard('0');
				</script>
                </table>
                </div>
              <div class="sort">
                <div><label>
					<input name="checkbox" type="checkbox" class="checkbox" id="checkbox" onClick="javascript:leaderboard('1');" />
                  Today</label>
                  <label>
                    <input name="checkbox2" type="checkbox" class="checkbox" id="checkbox2" onClick="javascript:leaderboard('2');" />
                    Yesterdy</label>
                    <label>
                    <input name="checkbox3" type="checkbox" class="checkbox" id="checkbox3" onClick="javascript:leaderboard_wk('3');" />
                    This Week</label>
                </div>
                <div><label>
                    <input name="checkbox4" type="checkbox" class="checkbox" id="checkbox4" />
                    Select a date range </label><input name="sale_frm" id="sale_frm" type="text" class="textSmall" /><span class="left">To</span><input name="sale_to" id="sale_to" type="text" class="textSmall" /></div>
              </div>
            </div>
            <div id="tab2" class="tab_content">
            
                  <h2 class="heading">Revenue Chart</h2>
                  <div class="row"><h4 class="left">Sales</h4>
                    <div class="fromTo"><span class="left"> Select a date range:</span><input name="ldate_from" id="ldate_from" type="text" class="textSmall" /><span class="left">To:</span><input name="ldate_to" id="ldate_to" type="text" class="textSmall" /><input type="hidden" id="anim" value="clip" /> </div>
                  </div>
                  <div class="graph">
                      <div id="rev_graph">
                        <div id="graph" align="center" style="width: 900px; height: auto; float:left; margin: 0 auto;"></div>
                      </div>
                  </div>
                  <h2 class="heading">Revenue Leaderboard</h2>
                    <div id="leaderboard_revenue">
                    <script>
                        leaderboard_revenue('0');
                    </script>
                    </table>
                    </div>
                  <div class="sort">
                    <div><label>
                        <input name="checkbox" type="checkbox" class="checkbox" id="checkbox" onClick="javascript:leaderboard_revenue('1');" />
                      Today</label>
                      <label>
                        <input name="checkbox2" type="checkbox" class="checkbox" id="checkbox2" onClick="javascript:leaderboard_revenue('2');" />
                        Yesterdy</label>
                        <label>
                        <input name="checkbox3" type="checkbox" class="checkbox" id="checkbox3" onClick="javascript:leaderboard_revenue_wk('3');" />
                        This Week</label>
                    </div>
                    <div><label>
                        <input name="checkbox4" type="checkbox" class="checkbox" id="checkbox4" />
                        Select a date range </label><input name="rev_frm" id="rev_frm" type="text" class="textSmall" /><span class="left">To</span><input name="rev_to" id="rev_to" type="text" class="textSmall" /></div>
                  </div>
            
      		</div>
      </div>
    </div>
  </div>
</div>