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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Stock Book Allocation List<!-- InstanceEndEditable --></strong></p>
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
					$contact = $row_prov['contact'];
				}
	
			}
	  
	   ?>
        <div class="main-wrapper">
        <!-- Start Here -->
        
        		
        
        <!-- End -->
        <h2>Student Store Book Allocated List</h2>
        <h2>Full Name :- <?=$fullname?></h2>
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <h3>Allocated  Book</h3>
        <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="8%">SR. NO.</th>
              <th width="27%">Book Name</th>
              <th width="21%">Publication</th>
              <th width="16%">Other</th>
              <th width="28%">Allocation Date / Time</th>
              </tr>
          </thead>
          <tbody class='ms'>
            <?php
				
					$query_study = sprintf("SELECT * FROM stu_prov_book WHERE prov_id='%d' and return_date IS NULL", $id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
										
				if($rowCount1>0)
					{
					$i=1;
						while($row_book = $result_study->fetch_assoc())
						{
							$book_id = $row_book['book_id'];
							$allocate_date = $row_book['allocate_date'];
							$allocate_time = $row_book['allocate_time'];
						
									$que_study="SELECT * FROM stu_book where id=$book_id"; 
									if (!($book_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_book_name=$book_res->fetch_assoc()){
										
								
			  ?>
            <tr>
              <td><div align="center">
                  <?=$i++;?>
              </div></td>
              <td><?=$row_book_name['book_name']?></td>
              <td><?=$row_book_name['publication']?></td>
              <td><?=$row_book_name['other']?></td>
              <td><?=$allocate_date.' <strong>/</strong> '.$allocate_time?></td>
              </tr>
            <?php } } }else{ echo '<font color="#FF0000"><B>NO PREVIOUS ALLOCATION</b></font>'; } ?>
          </tbody>
        </table>
        <h3>&nbsp;</h3>
        <h3>Allocation History</h3>
        <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="6%">SR. NO.</th>
              <th width="14%">Book Name</th>
              <th width="15%">Publication</th>
              <th width="8%">Other</th>
              <th width="22%">Allocation Date / Time</th>
              <th width="24%">Return Date / Time</th>
            </tr>
          </thead>
          <tbody class='ms'>
            <?php
					$query_stock = sprintf("SELECT * FROM stu_prov_book WHERE prov_id='%d' and return_date IS NOT NULL order by allocate_date ASC", $id);
					if (!($result_stock = $con->query($query_stock))) 
					{ echo "FOR QUERY: $query_stock<BR>".$con->error; 	exit;}
					$rowCount3 = $con->affected_rows;
				if($rowCount3>0)
					{
					$i=1;
						while($row_book = $result_stock->fetch_assoc())
						{
							$book_id = $row_book['book_id'];
						
							$allocate_date = $row_book['allocate_date'];
							$allocate_time = $row_book['allocate_time'];
							$return_date = $row_book['return_date'];
							$return_time = $row_book['return_time'];
							
//	$que_study="SELECT s.id as study_id, p.id as phy_id, s.item_name as study_item,p.item_name as phy_item,s.publication,p.brand,s.other as study_other,p.other as phy_other FROM stu_study_stock s,stu_physical_stock p";
									//$que_study="SELECT * FROM stu_study_stock where id=$study_item_id"; 
//if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
//if($row_item_name=$item_res->fetch_assoc()){

											
											$que_study="SELECT * FROM stu_book where id=$book_id";
											if (!($book_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
											if($row_book_name=$book_res->fetch_assoc()){
											$book_n=$row_book_name['book_name'];
											$detail=$row_book_name['publication'];
											$other=$row_book_name['other'];	
											}
										
								
			  ?>
            <tr>
              <td><div align="center">
                  <?=$i++;?>
              </div></td>
              <td><?=$book_n?></td>
              <td><?=$detail?></td>
              <td><?=$other?></td>
              <td><?=$allocate_date.' <strong>/</strong> '.$allocate_time?></td>
              <td><?=$return_date.' <strong>/</strong> '.$return_time?></td>
            </tr>
            <?php }}else{ echo '<font color="#FF0000"><B>NO PREVIOUS HISTORY</b></font>'; } ?>
          </tbody>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
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
