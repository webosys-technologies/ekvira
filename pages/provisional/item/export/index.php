<?php
          session_start();
		  include('../../../../common/connect.php');
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admission.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
<!-- InstanceBeginEditable name="doctitle" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../../../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../../../js/sitevalid.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../../../../images/body.jpg);
}
-->
</style></head>

<body>
<a href="../../../../logout.php"></a>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="../../../../images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="../../../../images/logotext.png" alt="subscription-management-system" /></div>
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
        <h2 class="ico-dash"><a href="../../../../dashboard.php?flag=<?=$flag?>"><img src="../../../../images/dashboard.png" alt="" align="absmiddle" /> Dashboard</a></h2>
        
        <h2 class="ico-rt"><a href="../../../../logout.php"><img src="../../../../images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="../../../../admin/user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Export_Stock_Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
      <?php
	   $condition2=" ORDER BY prov_id DESC";	
			
		$que="SELECT * FROM stu_provisional $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       <div class="add_button">
       	<table width="100%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
   	    <tr>
   	      <td width="37%">&nbsp;</td>
           	  <td width="35%"><p align="right"><a href="exportcur.php?flag=cur" class="button">Export Current Allocation Sheet</a></p></td>
           	  <td width="28%" align="right"><p align="right"><a href="exporhist.php?flag=his" class="button">Export History Sheet</a></p></td>  
        </tr>
        </table> 
       </div>
        <div class="main-wrapper">
        <!-- Start Here -->
        <h2>Student Store Item Allocated List</h2>
        
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="5%">SR. NO.</th>
              <th width="8%">File NO.</th>
              <th width="23%">Full Name</th>
              <th width="12%">Contact No.</th>
              <th width="5%">M/F</th>
              <th width="23%">Study Item List</th>
              <th width="24%">Physical Item List</th>
              </tr>
          </thead>
          <tbody class='ms'>
          <?php
		  		
				$clcnt=1;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					//$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$gender = $row_prov['gender'];
					$fileno = $row_prov['fileno'];
					
					$query_study = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d' and stock_id=1 and return_date IS NULL", $id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
					
					$query_phy = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d'and stock_id=2 and return_date IS NULL", $id);
					if (!($result_physical = $con->query($query_phy))) 
					{ echo "FOR QUERY: $query_phy<BR>".$con->error; 	exit;}
					$rowCount2 = $con->affected_rows;
		
								
			  ?>
            <tr>
              <td><div align="center">
                  <?=$clcnt++;?>
              </div></td>
              <td><div align="center">
                <?=$fileno?>
              </div></td>
              <td><?=$fullname?></td>
              <td><div align="center">
                  <?=$contact?>
              </div></td>
              <td><div align="center">
                  <?=$gender?>
              </div></td>
              <td><?php 
			  		if($rowCount1>0)
					{
					$i=0;
						while($row_item = $result_study->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$study_item_id = $row_item['item_id'];
							if($stock_id='1'){
								$i++;
								
									$que_study="SELECT * FROM stu_study_stock where id=$study_item_id"; 
									if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_item_name=$item_res->fetch_assoc()){
										echo $i.'.'.$row_item_name['item_name'].' ';
									}
							}
						
						}
					}
			  ?></td>
              <td><?php 
			  		if($rowCount2>0)
					{
					$i=0;
						while($row_item = $result_physical->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$phy_item_id = $row_item['item_id'];
							if($stock_id='2'){
								$i++;
								
									$que_phy="SELECT * FROM stu_physical_stock where id=$phy_item_id"; 
									if (!($item_res_phy = $con->query($que_phy))){ echo "FOR QUERY: $que_phy<BR>".$con->error; 	exit;}
									if($row_item_phy=$item_res_phy->fetch_assoc()){
										echo $i.'.'.$row_item_phy['item_name'].' ';
									}
							}
						
						}
					}
			  ?> </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
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
        <div class="ffrt"><a href="../../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
