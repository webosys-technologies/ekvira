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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Allocation Statistics<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <div class="main-wrapper">
          <p>
            <!-- Start Here -->
            
            
            
            <!-- End -->
          <h1 align="center"> STOCK ITEM ALLOCATION STATISTICS</h1>
          <table width="90%" border="0" class="tbl">
            <tr>
              <td colspan="6"><h3>STUDY STOCK ITEM</h3></td>
            </tr>
            <tr>
              <td width="8%"><div align="center"><strong>SR. NO.</strong></div></td>
              <td width="22%"><div align="center"><strong>ITEM NAME</strong></div></td>
              <td width="18%"><div align="center"><strong>PUBLICATION.</strong></div></td>
              <td width="18%"><div align="center"><strong>TOTAL QTY.</strong></div></td>
              <td width="27%"><div align="center"><strong>TOTAL ALLOCATED</strong></div></td>
              <td width="25%"><div align="center"><strong>REMAINING QTY.</strong></div></td>
            </tr>
            <?php
		  		$condition2=" ORDER BY id DESC";	
				 $que="SELECT * FROM stu_study_stock $condition2"; 
				if (!($page_res = $con->query($que))) 
				{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows;
				$cnt=1;
				if($rowCount==0){
					echo 'Please Upload Study Stock Items First'; 
				}
				while($row_store=$page_res->fetch_assoc())
				{ 
					$item_id=$row_store['id'];
					$item_name=$row_store['item_name'];
					$publication=$row_store['publication'];
					$tot_qty=$row_store['qty'];
					 $que_study_qty = sprintf("SELECT * FROM stu_prov_item WHERE stock_id=1 and item_id='%d' and return_date IS NULL", $item_id);
					if (!($result_study_qty = $con->query($que_study_qty))) 
					{ echo "FOR QUERY: $que_study_qty<BR>".$con->error; 	exit;}
					$study_count = $con->affected_rows;
					$remain_study = $tot_qty-$study_count;
			
			?>
            <tr>
              <td><div align="center">
                <?=$cnt++?>
              </div></td>
              <td><div align="center">
                <?=$item_name?>
              </div></td>
              <td><div align="center">
                  <?=$publication?>
              </div></td>
              <td><div align="center">
                <?=$tot_qty?>
              </div></td>
              <td><div align="center">
                <?=$study_count?>
              </div></td>
              <td><div align="center">
                <?=$remain_study?>
              </div></td>
            </tr>
            <?php }?>
          </table>
          <p>&nbsp;</p>
          <table width="90%" border="0" class="tbl">
            <tr>
              <td colspan="6"><h3>PHYSICAL TRAINING STOCK ITEM</h3></td>
            </tr>
            <tr>
              <td width="8%"><div align="center"><strong>SR. NO.</strong></div></td>
              <td width="22%"><div align="center"><strong>ITEM NAME</strong></div></td>
              <td width="18%"><div align="center"><strong>BRAND NAME</strong></div></td>
              <td width="18%"><div align="center"><strong>TOTAL QTY.</strong></div></td>
              <td width="27%"><div align="center"><strong>TOTAL ALLOCATED</strong></div></td>
              <td width="25%"><div align="center"><strong>REMAINING QTY.</strong></div></td>
            </tr>
            <?php
		  		$condition2=" ORDER BY id DESC";	
				 $que="SELECT * FROM stu_physical_stock $condition2"; 
				if (!($page_res = $con->query($que))) 
				{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows;
				$cnt=1;
				if($rowCount==0){
					echo 'Please Upload Physical Stock Items First'; 
					exit;
				}
				while($row_store=$page_res->fetch_assoc())
				{ 
					$item_id=$row_store['id'];
					$item_name=$row_store['item_name'];
					$brand=$row_store['brand'];
					$tot_qty=$row_store['qty'];
					 $que_study_qty = sprintf("SELECT * FROM stu_prov_item WHERE stock_id=2 and item_id='%d' and return_date IS NULL", $item_id);
					if (!($result_study_qty = $con->query($que_study_qty))) 
					{ echo "FOR QUERY: $que_study_qty<BR>".$con->error; 	exit;}
					$phy_count = $con->affected_rows;
					$remain_phy = $tot_qty-$phy_count;
			
			?>
            <tr>
              <td><div align="center">
                <?=$cnt++?>
              </div></td>
              <td><div align="center">
                <?=$item_name?>
              </div></td>
              <td><div align="center">
                  <?=$brand?>
              </div></td>
              <td><div align="center">
                <?=$tot_qty?>
              </div></td>
              <td><div align="center">
                <?=$phy_count?>
              </div></td>
              <td><div align="center">
                <?=$remain_phy?>
              </div></td>
            </tr>
            <?php }?>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          
          <p>&nbsp;</p>
          <p align="center"><a onclick="window.print();" class="button">Print</a></p>
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
