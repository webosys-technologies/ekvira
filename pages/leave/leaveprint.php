<?php
	session_start();
	include("../../common/connect.php");
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
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; LeaveForm<!-- InstanceEndEditable --></strong></p>
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
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$mother = $row_prov['mother'];
					$contact = $row_prov['contact'];
					$p_contact =  $row_prov['p_contact'];;
					$dob = dateformate($row_prov['dob']);
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					$remark = $row_prov['remark'];
					$photo_url = $row_prov['photo_url'];
					$prov_date = dateformate($row_prov['prov_date']);
					
					
					$query_caste = sprintf("SELECT * FROM stu_caste WHERE caste_id='%d'", $caste_id);
					if (!($result_caste = $con->query($query_caste))) 
					{ echo "FOR QUERY: $query_caste<BR>".$con->error; 	exit;}
					$row_caste = $result_caste->fetch_assoc();
					$caste = $row_caste['caste'];
					
					$query_religion = sprintf("SELECT * FROM stu_religion WHERE religion_id='%d'", $religion_id);
					if (!($result_religion = $con->query($query_religion))) 
					{ echo "FOR QUERY: $query_religion<BR>".$con->error; 	exit;}
					$row_religion = $result_religion->fetch_assoc();
					$religion = $row_religion['religion'];
					
					$query_city = sprintf("SELECT * FROM city WHERE city_id='%d'", $city_id);
					if (!($result_city = $con->query($query_city))) 
					{ echo "FOR QUERY: $query_city<BR>".$con->error; 	exit;}
					$row_city = $result_city->fetch_assoc();
					$city = $row_city['city_name'];
				}					
			 
	   ?>
       <p align="right" class="back-to-index"><a href="index.php?flag=non" class="button">Back To Index</a></p>
        <div class="main-wrapper">
        <!-- Start Here -->
       	  <h1 align="center">VANDE MATARAM CAREER ACADEMY, AMJANGAON (SURJI) </h1>
          <h2 align="center">STUDENT LEAVE FORM</h2>
       	  <p align="center" class="style1">&nbsp;</p>
       	  <table width="100%" border="0" class="tbl">
            
            <tr>
              <td width="13%"><strong>Full Name</strong></td>
              <td width="25%">:
                <?=$fullname?></td>
              <td width="16%"><strong>Mother Name</strong></td>
              <td width="27%">:
              
                <?=$mother?></td>
              <td width="19%" rowspan="5"><img align="right" src="../provisional/upload/<?=$photo_url?>" alt="photo" name="goat_img" width="160" height="180" id="goat_img2" /></td>
            </tr>
            <tr>
              <td><strong>DOB</strong></td>
              <td>:
                <?=$dob?></td>
              <td><strong>Gender</strong></td>
              <td>:
                <?=$gender?></td>
            </tr>
            <tr>
              <td><strong>Contact NO.</strong></td>
              <td>:
                <?=$contact?></td>
              <td><strong>Parent Contact NO.</strong></td>
              <td>:
                <?=$p_contact?></td>
            </tr>
            <tr>
              <td><strong>Religion</strong></td>
              <td>:
                <?=$religion?></td>
              <td><strong>Caste</strong></td>
              <td>:
                <?=$caste?></td>
            </tr>
            <tr>
              <td><strong>Correspondent Address</strong></td>
              <td align="left" valign="top">:
                <?=$addr_corespond?></td>
              <td><strong>Permanent Address</strong></td>
              <td align="left" valign="top">:
                <?=$addr_premanent?></td>
            </tr>
            <tr>
              <td><strong>Fixed Fees</strong></td>
              <td align="left" valign="top">:
                <?=$fixedfees?></td>
              <td><strong>City</strong></td>
              <td>:
                <?=$city?></td>
              <td rowspan="3" align="left" valign="middle">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Fees Paid</strong></td>
              <td align="left" valign="top">:
                <?=$feespaid?></td>
              <td><strong>Selected Course</strong></td>
              <td>:
                <?php
					$query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $id);
					if (!($result_prov_course = $con->query($query_prov_course))) 
					{ echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}

					$b_cnt=1;
					while($row_prov_course=$result_prov_course->fetch_assoc())
				{
					$course_id = $row_prov_course['course_id'];
					
					$query_course = sprintf("SELECT * FROM stu_course where course_id='%d'",$course_id);
						if(!($result_course = $con->query($query_course)))
						{
							echo "FOR QUERY: $query_course<BR>".$con->error; 	
							exit;
						}
					$row_course = $result_course->fetch_assoc();
					$course = $row_course['course'];
					echo $b_cnt.'.'.$course.' ';
					$b_cnt++;
				}
			?></td>
            </tr>
            <tr>
              <td><strong>Qualification</strong></td>
              <td colspan="3">:
                <?php
					$query_prov_edu = sprintf("SELECT * FROM stu_prov_edu WHERE prov_id='%d'", $id);
					if (!($result_prov_edu = $con->query($query_prov_edu))) 
					{ echo "FOR QUERY: $query_prov_edu<BR>".$con->error; 	exit;}

					$b_cnt=1;
					while($row_prov_edu=$result_prov_edu->fetch_assoc())
				{
					$edu_id = $row_prov_edu['edu_id'];
					$percent = $row_prov_edu['percent'];
					
					$query_edu = sprintf("SELECT * FROM stu_edu where edu_id='%d'",$edu_id);
						if(!($result_edu = $con->query($query_edu)))
						{
							echo "FOR QUERY: $query_edu<BR>".$con->error; 	
							exit;
						}
					$row_edu = $result_edu->fetch_assoc();
					$edu = $row_edu['edu'];
					echo $edu.' ('.$percent.'%),  ';
					$b_cnt++;
				}
			?></td>
            </tr>
            <tr>
              <td align="left" valign="top"><strong>Remark</strong></td>
              <td colspan="4">:
                <?=$remark?></td>
            </tr>
          </table>
        
          <p>&nbsp;</p>
          <h3>CURRENT LEAVE STATUS :---</h3>
          <?php
		  $que=sprintf("SELECT * FROM stu_prov_leave WHERE prov_id='%d' and return_date IS NULL", $id); 
				if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount=$con->affected_rows;
		if($rowCount!=0){
		  ?>
          <table width="100%" border="0" class="tbl">
            <thead>
              <tr>
                <th width="5%">SR. NO.</th>
                <th width="19%">OPENING DATE/TIME </th>
                <th width="19%">CLOSING DATE/TIME</th>
                <th width="7%">NO. OF DAYS</th>
                <th width="50%">REASON</th>
              </tr>
            </thead>
            <tbody class='ms'>
              <?php
			 	
				$clcnt=0;
		 
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					
					$open_date = dateformate($row_prov['open_date']);
					$open_time = $row_prov['open_time'];
					$close_date = dateformate($row_prov['close_date']);
					$close_time = $row_prov['close_time'];
					$reason = $row_prov['reason'];
					$current_date = date("Y-m-d");
					$time1=$close_date." / ".$close_time;
					$time2=$open_date." / ".$open_time;
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
                <td><?=$time2?> </td>
                <td><?=$time1?> </td>
                <td><?=$noofdays?></td>
                <td><?=$reason?></td>
              </tr>
              <?php
				} ?>
            </tbody>
          </table>
          <?php }?>
          <p>&nbsp;</p>
          <table width="90%" border="0">
            <tr>
              <td width="9%" height="46">&nbsp;</td>
              <td width="91%"><h3 align="center">Rules and Regulations</strong></h3></td>
            </tr>
            <tr>
              <td height="50"><div align="center">1.</div>
              <p align="center">&nbsp;</p></td>
              <td><div align="justify">Student should report in academy within end date and time of leave otherwise his/her admission will be canceled automatically and student or his/her parents will be responsible for the consequences.</div></td>
            </tr>
            <tr>
              <td height="50"><div align="center">2.</div>
                  <p align="center">&nbsp;</p></td>
              <td><div align="justify">During leave periods if any accident or anything hazardous happened with student than student or his/her parents will be responsible for it.</div></td>
            </tr>
            <tr>
              <td height="50"><div align="center">3.</div>              </td>
              <td><div align="justify">Once got admited student will get 7 days leave after one month training.</div></td>
            </tr>
            <tr>
              <td height="113">&nbsp;</td>
              <td><div align="right"><strong>Signature of Student</strong></div></td>
            </tr>
          </table>
          <p align="center"><a onclick="window.print();" class="button">Print</a></p>
        </div>
        <?php }?>
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
