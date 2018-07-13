<?php
	session_start();
	include("../../../common/connect.php");
	include("../../../common/getid.php");
	if($_SESSION['authorised'])
  	{
		$state=$_SESSION['authorised'];
		$val=calcID();
		if($val!=$state)
		{
		header("Location: ../../../common/developer.php?flag=non");
		exit;
		}	
	}else{
		header("Location: ../../../index.php?flag=login_pass_err");
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admission.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pre-Cadet Admission System</title>
<script type="text/javascript">	
        $(function(){
              $('#datepicker').daterangepicker({
                posX:250,
                posY:350
              }); 
         });
        </script>
<style type="text/css">
.ui-daterangepickercontain 
{
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>
<script type="text/javascript">	
	$(function(){
		  $('#datepicker1').daterangepicker({
			posX:200,
			posY: 400
		  }); 
	 });
</script>

<style type="text/css">
.ui-daterangepickercontain 
{
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../../js/sitevalid.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../../../images/body.jpg);
}
-->
</style></head>

<body>
<a href="../../../logout.php"></a>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="../../../images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="../../../images/logotext.png" alt="subscription-management-system" /></div>
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
        <h2 class="ico-dash"><a href="../../../dashboard.php?flag=<?=$flag?>"><img src="../../../images/dashboard.png" alt="" align="absmiddle" /> Dashboard</a></h2>
        
        <h2 class="ico-rt"><a href="../../../logout.php"><img src="../../../images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="../../../admin/user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Faculty Pay Sheet<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <div class="main-wrapper">
        <!-- Start Here -->
            <?php
		$id = $_GET['id'];
		if($id>0)
		{
			$query="SELECT * FROM stu_faculty WHERE id=".$id;
			if (!($result_f = $con->query($query))){ echo "FOR QUERY: $query<BR>".$con->error; 	exit;}
			if($row=$result_f->fetch_assoc()){
				$fname=$row['name'];
			}
	
			?>
          <div class="pay_div" id="pay_div">
          <table width="100%" border="0" class="tbl">
       
			  <tr>
				<td width="19%"><strong>Faculty ID.</strong></td>
				<td width="21%"><strong>: <?=$id?></strong></td>
				<td width="22%"><strong>Faculty Name</strong></td>
				<td width="38%"><strong>: <?=$fname?></strong></td>
			  </tr>
         
        </table>
        <table width="100%" border="0" class="tbl">
        <thead>
          <tr>
            <th width="10%">SR. NO</th>
            <th width="37%">PAY MONTH</th>
            <th width="31%">DATE OF PAY</th>
            <th width="22%">AMOUNT</th>
          </tr>
          </thead>
          <?php
		  $query_sal="SELECT * FROM `stu_faculty_sal` WHERE faculty_id=".$id;
			if (!($result_sal = $con->query($query_sal))){ echo "FOR QUERY: $query_sal<BR>".$con->error; 	exit;}
			$cnt=0;
			while($row_sal=$result_sal->fetch_assoc())
			{
				$salary=$row_sal['pay_amt'];
				$month_id=$row_sal['pay_month'];
				$pay_date=$row_sal['pay_date'];
				
				$query_mon="SELECT month FROM pay_month WHERE id=".$month_id;
				if (!($result_mon = $con->query($query_mon))){ echo "FOR QUERY: $query_mon<BR>".$con->error; 	exit;}
				if($row_mon=$result_mon->fetch_assoc())
				{
					$month=$row_mon['month'];
				}
		  		$cnt++;
			  ?>
			  <tr>
				<td><div align="center"><?=$cnt?></div></td>
				<td><div align="center"><?=$month?></div></td>
				<td><div align="center"><?=$pay_date?></div></td>
				<td><div align="center"><?=floatval($salary)?></div></td>
			  </tr>
		   <?php
            }
		  ?>
        </table>
        </div>
        <?php } ?>
        </div>
        <!-- InstanceEndEditable -->
      </div>
    </div>

</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	  	<div class="fflt">Copyright &copy; 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
