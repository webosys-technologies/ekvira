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
<title>Welcome to Admission Mangement System</title>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Enquiry Student List<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
       <div class="add_button"> <p align="right"><a href="add.php?flag=<?=$flag?>" class="button">Add New Enquiry</a></p>
       </div>
       <?php
	  // require '../../common/connect.php';
	   $condition2=" ORDER BY enq_id ASC";	
			
		$que="SELECT * FROM stu_enquiry $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       
        <div class="main-wrapper">
        <h2>Student Enquiry List</h2>
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="27%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="7%">Gender</th>
            <th width="7%">Course</th>
            <th width="4%">Caste</th>
            <th width="4%">Religion</th>
            <th width="23%">Full Address</th>
            <th width="11%">Enquiry Date</th>
            <th width="9%">Remark</th>
            <th>Action</th>
            <th>Admit to provisional</th>
          </tr>
            </thead>
			<tbody class='ms'>
            
             <?php
				$clcnt=0;
		
				while($row_enq=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_enq['enq_id'];
					$fullname=stripslashes($row_enq['fname']." ".$row_enq['mname']." ".$row_enq['lname']);
					$phone = $row_enq['phone'];
					$gender = $row_enq['gender'];
					
					$caste_id = $row_enq['caste_id'];
					$religion_id = $row_enq['religion_id'];
					$address = $row_enq['address'];
					$remark = $row_enq['remark'];
					$enq_date = dateformate($row_enq['enq_date']);
				
					
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
					
					
			  ?>
          <tr>
            <td><?=$clcnt?></td>
            <td><?=$fullname?></td>
            <td><?=$phone?></td>
            <td><?=$gender?></td>
            <td>
				   <?php
					$query_enq_course = sprintf("SELECT * FROM stu_enq_course WHERE enq_id='%d'", $id);
					if (!($result_enq_course = $con->query($query_enq_course))) 
					{ echo "FOR QUERY: $query_enq_course<BR>".$con->error; 	exit;}

					$b_cnt=1;
					while($row_enq_course=$result_enq_course->fetch_assoc())
				{
					$course_id = $row_enq_course['course_id'];
					
					$query_course = sprintf("SELECT * FROM stu_course where course_id='%d'",$course_id);
						if(!($result_course = $con->query($query_course)))
						{
							echo "FOR QUERY: $query_enq_course<BR>".$con->error; 	
							exit;
						}
					$row_course = $result_course->fetch_assoc();
					$course = $row_course['course'];
					echo $b_cnt.'.'.$course.' ';
					$b_cnt++;
				}
			?>            </td>
            
            <td><?=$caste?></td>
            <td><?=$religion?></td>
            <td><?=$address?></td>
            <td><?=$enq_date?></td>
            <td><?=$remark?></td>
            <?php if($user_type=='SU' or $user_type='GU'){?>
            <td>
            	<ul class="actions">
						
				<li><a href="enquiry_del.php?id=<?=$id?>" onClick="if(confirm('Do you really want to delete this student?')){return true;}else{return false;}"><img src="../../images/trash.png" alt="delete"></a></li>
					</ul>            </td>
            <td><ul class="actions">
                <li><a href="prov_add.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if(confirm('TRANSFER TO PROVISIONAL ADMISSION?')){return true;}else{return false;}"><img src="../../images/back.png" alt="ADD" /></a></li>
            </ul></td>
             <?php }?>
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
		<?if($flag=="edit"){?>
		<p align="center"><font color='red'><B>Record is edited Successfully.</B></font></p>
		<? } ?>	
		<?if($flag=="add"){?>
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
