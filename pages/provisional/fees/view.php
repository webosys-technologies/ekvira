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
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script><!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; View Fees Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
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
					$tot_fees = $row_prov['fixedfees'];
				}
				
					$query_fees = sprintf("SELECT * FROM stu_prov_fees WHERE prov_id='%d' order by fees_id ASC", $id);
					if (!($result_fees = $con->query($query_fees))) 
					{ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}
					$tot_fees_paid=0;
			
			}
			
	   ?> 
        <div class="main-wrapper">
         
          <h1 align="center">VANDE MATARAM CAREER ACADEMY, AMJANGAON (SURJI) </h1>
          <h2 align="center">STUDENT Fees payment details</h2>
          <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="28%">Student Name</th>
              <th width="25%"><div align="left">
                : <?=$fullname?>
              </div></th>
              <th width="23%">Total Fees</th>
              <th width="24%"><div align="left">: 
                <?=$tot_fees?>
              </div></th>
            </tr>
          </thead>
          <tbody class='ms'>
          </tbody>
        </table>
          <table width="100%" border="0" class="tbl">
            <thead>
              <tr>
                <th width="4%">SR. NO.</th>
                <th width="20%">FEES PAID</th>
                <th width="24%">REMAINING FEES</th>
                <th width="23%">PAYMENT DATE / TIME</th>
                <th colspan="2">NEXT DUE DATE</th>
                <th width="6%">Action</th>
              </tr>
            </thead>
            <tbody class='ms'>
            <?php
				$clcnt=1;
				while($row_fees = $result_fees->fetch_assoc()){
				$feesid = $row_fees['fees_id'];
				$fees_paid = $row_fees['fees_paid'];
				$pay_date = $row_fees['pay_date'];
				$pay_time = $row_fees['pay_time'];
				$due_date = dateformate($row_fees['due_date']);
				$tot_fees_paid = $fees_paid + $tot_fees_paid;
			?>
              <tr>
                <td><div align="center">
                  <?=$clcnt++;?>
                </div></td>
                <td><div align="center">
                  <?=$fees_paid?>
                </div></td>
                <td><div align="center">
                  <?=($tot_fees-$tot_fees_paid)?>
                </div></td>
                <td><div align="center">
                  <?=dateformate($pay_date)?>
                  <strong>/</strong>
                  <?=$pay_time?>
                </div></td>
                <td colspan="2"><div align="center">
                  <?=$due_date?>
                </div></td>
                <td>
                <?php //if($user_type=='SU'){ ?>
                <ul class="actions">
                    <li><a href="del.php?fid=<?=$feesid?>&id=<?=$id?>" onclick="if(confirm('Do you really want to delete this Entry?')){return true;}else{return false;}"><img src="../../../images/trash.png" alt="delete" /></a></li>
                </ul>
                <?php //} ?>
                </td>
              </tr> 
              <?php }?>
               <tr>
                <td>&nbsp;</td>
                <td colspan="2"><strong>Total Fees Paid </strong>: 
                 <?=$tot_fees_paid?></td>
                <td colspan="4"><strong>Total Fees Balance </strong>: 
                 <?=($tot_fees-$tot_fees_paid)?></td>
              </tr>
            </tbody>
          </table>
          <p align="center" class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></p>
          <p></p>
        
        <!-- End -->
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
