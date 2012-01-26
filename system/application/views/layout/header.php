<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/dd.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.dd.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/test.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/organictabs.jquery.js" ></script>
<script type="text/javascript">

$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});

$(function() {
	$("#example-one").organicTabs();
});

$(document).ready(function() {

try {
		oHandler = $(".select").msDropDown({mainCSS:'dd2'}).data("dd");
		//alert($.msDropDown.version);
		//$.msDropDown.create("body select");
		$("#ver").html($.msDropDown.version);
		} catch(e) {
			alert("Error: "+e.message);
		}
})

</script>
</head>

<body>
<div id="header">
  <div id="logo"><a href="<?= site_url('dashboard/dashboard_view') ?>">Stocker Boy</a></div>
  <div id="session">Welcome <?php echo $this->session->userdata('name'); ?> | <a href="<?php echo site_url('auth/logout'); ?>">Logout</a></div>
  <ul id="navigation">
    <li><a id="dash" title="Home" href="<?php echo site_url('dashboard/dashboard_view') ?>"><img src="<?php echo base_url(); ?>/images/home.png" /></a></li>
    <li><a id="prod" title="Products" href="<?php echo site_url('products/products_view') ?>"><img src="<?php echo base_url(); ?>/images/products.png" /></a></li>
    <li><a id="stk" title="Stock" href="<?php echo site_url('stock/stock_view') ?>"><img src="<?php echo base_url(); ?>/images/stock.png" /></a></li>
    <li><a id="sls" title="Sales" href="<?php echo site_url('sales/sales_view') ?>"><img src="<?php echo base_url(); ?>/images/sales.png" /></a></li>
    <li><a id="fin" title="Revenue" href="<?php echo site_url('revenue/') ?>"><img src="<?php echo base_url(); ?>/images/finance.png" /></a></li>
  </ul>
</div>

<?php
$message['success'] = $this->session->flashdata('success');
$message['error'] = $this->session->flashdata('error');
if(!empty($message['success']) or !empty($message['error'])) { ?>
<div class="message" id="error-message" <?php echo (!empty($message['error'])) ? '':'style="display:none;"';?>><?php echo (empty($message['error'])) ? '':$message['error'] ?></div>
<div class="message" id="success-message" <?php echo (!empty($message['success'])) ? '':'style="display:none;"';?>><?php echo (empty($message['success'])) ? '': $message['success'] ?></div>
<?php } ?>