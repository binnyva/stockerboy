<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login | Stocker Boy</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url()?>css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="login-container">
  <div id="login-logo"><a href="#">Stocker Boy</a></div>
  <div id="login-box">
    <h3>Login to Stocker Boy App </h3>
    
    <div id="inner">
    <div class="field" style="color:#CC0000; text-align:center;"><?php echo $message;?></div>
    <form action="<?php echo site_url('auth/forgotpassword'); ?>" method="post" >
   	  <label><input name="email" id="email" type="text" class="textfield" value="Email ID" onfocus="if(this.value=='Email ID'){this.value=''};" onblur="if(this.value==''){this.value='Email ID'};" /></label>
    	<label>
    	 
    	<div id="button-row">
    	    
            <input name="" value="" type="submit" class="login-button" />
    	</div>
        </form>
    </div>
  </div>
  
</div>
</body>
</html>