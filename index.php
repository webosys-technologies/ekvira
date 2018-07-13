<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<title>Pre-Cadet Admission System</title>
<link href="css/style-sms.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(images/body.jpg);
	background-repeat: repeat;
}
-->
</style></head>

<body>

<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="images/logo.png" alt="Logo" /></div>
      <div class="clr"></div>
        <div class="logotxt"><img src="images/logotext.png" alt="subscription-management-system" /></div>
        <div class="clr"></div>
    </div>
</div>

<div class="mainbody">
<!--Main Body -->
					<div style="color:#FF0000; font-size:16px;" align="center">	<ul>
							<li>
								<?php
								if (isset($_GET['flag'])){
								if($_GET['flag']=='login_pass_err')
								{
								?>
								<span>Please Enter Correct Password</span>
								<?php
								}?>
								<?php
								if($_GET['flag']=='login_user_err')
								{
								?>
								<span>Please Enter Correct Username!!!</span>
								<?php
								}?>
                                <?php
								if($_GET['flag']=='logout')
								{
								?>
								<span>You Have Successfully Logged Out!!!</span>
								<?php
								}?>
								<?php
								if($_GET['flag']=='null_err')
								{
								?>
								<span>Please Enter Username OR Password!!!</span>
								<?php
								}
								if($_GET['flag']=='passchange')
								{?>
                                <span>Password Changed login Again!!!</span>
								<?php } }?>
							</li>
						</ul>
					</div>
<div class="wrapper">
	
   
    <div class="registered-users-wrapper">
    	<div class="registered-users">
        	<h2>Registered users</h2>
            <p>If you have an account, please log in.</p>
           
            <form action="login.php" method="get">
           	  <div class="form-list">
                             
                <label>User ID :<em>*</em></label>
                <div class="input-box">
                    <input type="text" class="input-text" value="" title="Name" id="name" name="username">
                </div>
                    
                <label>Password :<em>*</em></label>
                <div class="input-box">
                    <input type="password" class="input-text" value="" title="pass" id="password" name="password">
                </div>
                
                				
                <label></label>
           	  </div>
           	  <p class="required frt">* Required Fields</p>
                <div class="clear"></div>
                <input name="input" type="submit" value="Login" class="button"/> 
                
          </form>
        </div>
    </div>
    
</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	<div class="fflt">Copyright &copy; 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="#">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
        <div class="clear"></div>
    </div>
</div>

</body>
</html>
