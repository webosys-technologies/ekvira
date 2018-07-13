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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Book Allocation Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
       <div class="flag-msg">
         <?php if($flag=$_REQUEST['flag']){
	 		$flag=$_REQUEST['flag'];
	 }?>
			
		<? if($flag=="add"){?>
		<p align="center"><font color='red'><B><strong>Book</strong> Allocated successfully.</B></font></p>
		<? } ?>	
		<? if($flag=="return"){?>
		<p align="center"><font color='red'><B><strong>Book</strong> Returned Successfully.</B></font></p>
		<? } ?>	
        <? if($flag=="back"){?>
		<p align="center"><font color='red'><B>No <strong>Book</strong> Allocated or Returned.</B></font></p>
		<? } ?>
        </div>
          
       <?php
	  // require '../common/connect.php';
	   $condition2=" ORDER BY prov_id DESC";	
			
		$que="SELECT * FROM stu_provisional $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       
        <div class="main-wrapper">
        <!-- Start Here -->
        <h2>Student  <strong>Book</strong> Allocated List</h2>
        
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="5%">SR. NO.</th>
              <th width="8%">File No.</th>
              <th width="26%">Full Name</th>
              <th width="9%">Contact No.</th>
              <th width="6%">M/F</th>
              <th width="23%"><strong>Book</strong> List</th>
              <th width="7%">View Details</th>
              <th width="7%">Allocate</th>
              <th width="9%">Return<strong></strong></th>
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
					
					$query_study = sprintf("SELECT * FROM stu_prov_book WHERE prov_id='%d' and return_date IS NULL", $id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
					
						
			  ?>
            <tr>
              <td><div align="center">
                  <?=$clcnt++;?>
              </div></td>
              <td><?=$fileno?></td>
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
							$study_book_id = $row_item['book_id'];
							
								$i++;
								
									$que_study="SELECT * FROM stu_book where id=$study_book_id"; 
									if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_item_name=$item_res->fetch_assoc()){
										echo $i.'.'.$row_item_name['book_name'].' ';
									}						
						}
					}
			  ?></td>
              <td><ul class="actions"><li><a href="view.php?id=<?=$id?>&amp;flag=non"><img src="../../../images/search.png" alt="Allocate Item" /></a></li></ul></td>
              
              <td><ul class="actions"><li><a href="item_allocate.php?id=<?=$id?>&mode=old&flag=non"><img src="../../../images/confirm.png" alt="Allocate Item" /></a></li></ul></td>
              <td><ul class="actions"><li><a href="item_return.php?id=<?=$id?>&mode=old&flag=non"><img src="../../../images/edit.png" alt="Allocate Item" /></a></li>
</ul></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <!-- End -->
        </div>
        <? if($rowCount==0){?>
		<p align="center"><font color='red'><B>No Record found.</B></font></p>
		<? } ?>	
		<? if($flag=="edit"){?>
		<p align="center"><font color='red'><B>Record is edited Successfully.</B></font></p>
		<? } ?>
		<? if($flag=="exist"){?>
		<p align="center"><font color='red'><B>Record is already exits.</B></font></p>
		<? } ?>	
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
