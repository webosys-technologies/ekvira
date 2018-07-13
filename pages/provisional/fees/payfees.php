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
<style type="text/css">
.ui-daterangepickercontain 
{
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>


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
<script src="../../../js/jquery-1.8.2.min.js"></script>
<script>
$(document).ready(function(){
	$("#feesamt").blur(function(){
		var totfees=document.getElementById("totfees").value;
		var feespaid=document.getElementById("feespaid").value;
		var feesamt=document.getElementById("feesamt").value;
		var remfees=parseInt(totfees)-(parseInt(feespaid)+parseInt(feesamt));
		if(remfees<=0){
			$("#duedate").hide(5);
			$("#duedate").attr("value","non");
		}else{
			$("#duedate").show(5);
		}
		
		$(function(){
              $('#duedate').daterangepicker({
                posX:550,
                posY:600
              }); 
    	});
	});
	
	
});
</script>

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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Pay Fees<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
      
        <div class="main-wrapper">
          <p>
            <!-- Start Here -->
            <?php //echo dateformate(date('Y-m-d',strtotime("+15 day"))); ?>
            <?php       
			$id = $_GET['id'];
			
			if($id > 0)
			{
				$que=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
				if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}

			$clcnt=0;
		
				if($row_prov=$page_res->fetch_assoc())
				{
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$fixedfees = $row_prov['fixedfees'];
				}
			}
			
			$query_fees = sprintf("SELECT * FROM stu_prov_fees WHERE prov_id='%d' order by fees_id ASC", $id);
			if (!($result_fees = $con->query($query_fees))) 
			{ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}
			$tot_fees_paid=0;
			while($row_fees = $result_fees->fetch_assoc()){
			$lastpaydate = $row_fees['pay_date'];
			$nextduedate = $row_fees['due_date'];
			$tot_fees_paid = $row_fees['fees_paid'] + $tot_fees_paid;
			}	
		?>
          </p>
          <table width="80%" height="141" border="1" align="center" class="tbl">
            <tr>
              <td width="23%" height="33"><strong>Student Name </strong></td>
              <td height="33" colspan="5"><strong>:</strong>                 <?=$fullname?></td>
            </tr>
            <tr>
              <td width="23%" height="33"><strong>Total Fees</strong></td>
              <td width="13%" height="34"><strong>: </strong> <?=$fixedfees?></td>
              <td width="18%" height="33"><strong>Total Fees Paid  </strong></td>
              <td width="11%"><strong>: </strong> <?=$tot_fees_paid?></td>
              <td width="18%" height="33"><strong>Fees Balance </strong></td>
              <td width="11%"><strong>: </strong><?=($fixedfees-$tot_fees_paid)?></td>
            </tr>
            <tr>
              <td width="23%" height="33"><strong>Last Payment Date </strong></td>
              <td height="34"><strong>: </strong> <?=dateformate($lastpaydate)?></td>
              <td height="33"><strong>Due Date</strong></td>
              <td colspan="3"><strong>: </strong> <?=dateformate($nextduedate)?></td>
            </tr>
          </table>
          <p>&nbsp; </p>
          <h2>pay student fees</h2>
            
			
		  <form action="submit.php" method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
           
			<div class="field">
				<label><strong>Enter Fees Amount :<em>*</em></strong></label>
				<div class="fieldrt">
                <input type="hidden" value="<?=$fixedfees?>" id="totfees" />
                <input type="hidden" value="<?=$tot_fees_paid?>" id="feespaid" />
				  <input type="text" class="input-text" title="Fees Amount" id="feesamt" name="feesamt" onblur='notnull(this.id);' required/>
				</div>
			</div>
            <div class="field">
				<label><strong>Select Next Due Date :<em>*</em></strong></label>
				<div class="fieldrt">
				  <input type="text" onclick="checkbal(this.id);" class="input-text" title="Next Due Date" id="duedate" name="duedate" onblur='notnull(this.id);' />
				</div>
			</div>
			<input type="hidden" id="id" name="id" value="<?=$id?>" />
			<div class="field">
			<label>&nbsp;</label>
			<div class="fieldrt"><input name="input" type="submit" value="Submit" class="button" /></div>
            
			</div>
		  </form>
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
