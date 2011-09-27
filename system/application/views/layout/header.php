<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $title ?></title>
<link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url()?>js/jquery-1.4.min.js"></script>
</head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $title ?></title>
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
</script>
<script>
        $(function() {
            $("#example-one").organicTabs();
        });
    </script>
<script type="text/javascript">
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
    <li><a id="dash" href="<?= site_url('dashboard/dashboard_view') ?>">Dashboard</a></li>
    <li><a id="prod" href="<?= site_url('products/products_view') ?>">Products</a></li>
    <li><a id="stk" href="#">Stock</a></li>
    <li><a id="sls" href="#">Sales</a></li>
    <li><a id="fin" href="#">Finance</a></li>
  </ul>
</div>