<?php
	session_start();
	include("../../common/connect.php");
	include("../../common/getid.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admission.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
<!-- InstanceBeginEditable name="doctitle" -->

<title>Welcome to Admission Mangement System</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../js/sitevalid.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../../images/body.jpg);
}
-->
</style></head>

<body>
<a href="../../logout.php"></a>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="../../images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="../../images/logotext.png" alt="subscription-management-system" /></div>
      <div class="hdrrt"> <span class="logotxt">
      <?php
	      if(isset($_SESSION['username']))
          {
          echo "Welcome  " .$_SESSION['username'];
		  $user_id=$_SESSION['user_id'];
		  $user_type=$_SESSION['u_type']; 
          }
          else
          {
          header ("location: ".$_SERVER['DOCUMENT_ROOT']."/logout.php?flag=non");
		  exit;
          }
			if(isset($_REQUEST['flag'])){
			$flag=$_REQUEST['flag'];
			}
	
   ?>
    
      </span></div>
        <div class="clr"></div>
  </div>
</div>

<div class="mainbody">
<!--Main Body -->
<div class="wrapper">

	<div class="box">
        <div class="hdr">
        <h2 class="ico-dash"><a href="../../dashboard.php?flag=<?=$flag?>"><img src="../../images/dashboard.png" alt="" align="absmiddle" /> Dashboard</a></h2>
        
        <h2 class="ico-rt"><a href="../../logout.php"><img src="../../images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="../user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->
          <?php 
		$stock_name=$_REQUEST['stock'];
		
		?><a href="index.php?stock=<?=$stock_name?>&flag=non">Home</a> &raquo; Add Store Item<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->

		
        <div class="main-wrapper">
        <!-- Start Here -->
        <?php
			if($stock_name=='study'){
            	echo "<h2>Add New Study Stock Item</h2>";
            }else{
            	echo"<h2>Add New Physical Stock Item</h2>";
            }
		?>
			
			<form action="submit.php?id=" method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
            
            <input type="hidden" name="stock" value="<?=$stock_name?>" />
			<div class="field">
				<label><strong>Item Name :<em>*</em></strong></label>
				<div class="fieldrt">
				  <input type="text" class="input-text" title="Store Item Name" id="name" name="name" onblur='notnull(this.id);' />
				</div>
			</div>
            <?php
			if($stock_name=='study'){
			?>
            <div class="field">
				<label><strong>Publication Name :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Store Item Name" id="p_name" name="p_name" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <?php
			}
		else{
		?>
        <div class="field">
				<label><strong>Brand Name :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Store Item Name" id="p_name" name="p_name" onBlur='notnull(this.id);' />
				</div>
			</div>
            <?php }
			?>
            <div class="field">
				<label><strong>Total Item Quantity :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Store Item Qty" id="item_qty" name="item_qty" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Other Details :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Other" id="other" name="other" onBlur='notnull(this.id);' />
				</div>
			</div>

			<div class="field">
			<label>&nbsp;</label>
			<div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/></div>
            
			</div>
				</form>
			</div>
		
		<!-- ****************End******************** -->

        <!-- InstanceEndEditable -->
      </div>
    </div>

</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	  	<div class="fflt">Copyright &copy; 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
