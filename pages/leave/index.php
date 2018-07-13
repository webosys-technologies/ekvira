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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->LeaveManagement<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
       
       <?php
	  // require '../common/connect.php';
	   $condition2=" ORDER BY prov_id DESC";	
			
		$que="SELECT * FROM stu_provisional $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       <p align="right" class="back-to-index"><a href="stu_onleave.php?flag=non" class="button">Show Students on Leave</a></p>
        <div class="main-wrapper">
        <h2>Student Provisional List</h2>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="20%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="8%">Parent Contact No.</th>
            <th width="5%">M/F</th>
            <th width="7%">Course</th>
            <th width="13%">Correspondent Address</th>
            <th width="10%">Permanent Address</th>
            <th width="7%">Remark</th>
             <th width="9%">View Leave</th>
             <th width="9%">Grant Leave</th>
            </tr>
            </thead>
			<tbody class='ms'>
            
             <?php
				$clcnt=0;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$p_contact = $row_prov['p_contact'];
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$remark = $row_prov['remark'];
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
					
			  ?>
          <tr>
            <td><?=$clcnt?></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
            <td><?=$p_contact?></td>
            <td><?=$gender?></td>
            <td>
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
			?>            </td>
            
            <td><?=$addr_premanent?></td>
            <td><?=$prov_date?></td>
            <td><?=$remark?></td>
            <td><ul class="actions">
                <li><a href="leave_status.php?flag=<?=$flag?>&id=<?=$id?>"><img src="../../images/search.png" alt="View" width="39" height="36" /></a></li>
            </ul></td>
            <td>
            	<ul class="actions">
						<li><a href="stu_details.php?flag=<?=$flag?>&id=<?=$id?>"><img src="../../images/correct.png" alt="View" width="39" height="36"></a></li>
				</ul>            </td>
            </tr>
             <?php
				}?>
         </tbody>
        </table>
        </div>
        <div class="flag-msg">
         <?php if($flag=$_REQUEST['flag']){
	 		$flag=$_REQUEST['flag'];
	 }?>
		<?if($rowCount==0){?>
		<p align="center"><font color='red'><B>No Record found.</B></font></p>
		<? } ?>	
		<? if($flag=="edit"){?>
		<p align="center"><font color='red'><B>Record is edited Successfully.</B></font></p>
		<? } ?>	
		<? if($flag=="add"){?>
		<p align="center"><font color='red'><B>New Record is added successfully.</B></font></p>
		<? } ?>	
		<?if($flag=="exist"){?>
		<p align="center"><font color='red'><B>Record is already exits.</B></font></p>
		<? } ?>	
		<?if($flag=="del"){?>
		<p align="center"><font color='red'><B>Record is deleted Successfully.</B></font></p>
		<? } ?>	
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
