<?php
	session_start();
	include("../../common/connect.php");
	include("../../common/getid.php");
	if($_SESSION['authorised'])
  	{
		$state=$_SESSION['authorised'];
		$val=calcID();
		if($val!=$state)
		{
		header("Location: ../../common/developer.php?flag=non");
		exit;
		}	
	}else{
		header("Location: ../../index.php?flag=login_pass_err");
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
        <h2 class="ico-rt"><a href="../../admin/user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; StudentOnLeave<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        
       <p align="right" class="back-to-index"><a href="index.php?flag=non" class="button">Back To Index</a></p>
        <div class="main-wrapper">
        <h2>Student On leave List</h2>   
      <?php
	   $condition2=" ORDER BY prov_id ASC";	
			
		$que="SELECT * FROM stu_prov_leave WHERE return_date IS NULL $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
		if($rowCount>0){
	   ?>    
        <table width="100%" border="0" class="tbl">
          <thead>
            <tr>
              <th width="4%">SR. NO.</th>
              <th width="8%">Student ID</th>
              <th width="22%">Full Name</th>
              <th width="11%">OPENING DATE </th>
              <th width="10%">CLOSING DATE</th>
              <th width="10%">NO. OF DAYS</th>
              <th width="25%">REASON</th>
              <th width="10%">RETURN FROM LEAVE</th>
            </tr>
          </thead>
          <tbody class='ms'>
          
           <?php
				$clcnt=0;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$id=$row_prov['prov_id'];
					$open_date = dateformate($row_prov['open_date']);
					$open_time = $row_prov['open_time'];
					$close_date = dateformate($row_prov['close_date']);
					$close_time = $row_prov['close_time'];
					$reason = $row_prov['reason'];
					
							
					$query_prov = sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id);
					if (!($result = $con->query($query_prov))) 
					{ echo "FOR QUERY: $query_prov<BR>".$con->error; 	exit;}
					$rows = $result->fetch_assoc();
					$fullname=stripslashes($rows['fname']." ".$rows['mname']." ".$rows['lname']);
					
					$adm_date = $rows['prov_date'];
					$current_date = date("Y-m-d");
					$time1=$close_date." ".$close_time;
					$time2=$open_date." ".$open_time;
					$t1 = strtotime($close_date);
					$curr_date = strtotime($current_date);
					$t2 = strtotime($open_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$noofdays = floor($days)+1;
			$clcnt++;	
			  ?>
            <tr>
              <td><?=$clcnt?></td>
              <td><?=getstuid($adm_date).$id?></td>
              <td><?=$fullname?></td>
              <td><?=$open_date?></td>
              <td><?=$close_date?></td>
              <td><?=$noofdays?></td>
              <td><?=$reason?></td>
              <td><ul class="actions">
                  <li><a href="stu_return.php?flag=<?=$flag?>&id=<?=$id?>"><img src="../../images/BACK.png" alt="View" width="32" height="32" /></a></li>
              </ul></td>
            </tr>
            <?php
				} ?>
          </tbody>
        </table>
        <?php }else{ echo '<p align="center"><font color="red">NO STUDENTS ARE CURRENTLY ON LEAVE</font></p>';} mysqli_free_result($page_res);?>
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
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
