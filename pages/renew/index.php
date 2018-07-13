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
        <h2 class="ico-rt"><a href="../../admin/user/edit.php?flag=<?=$flag?>&amp;id=<?=$user_id?>"><img src="../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
   	  </div>
  <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Cancelled Student List<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        
       
      
        <table width="100%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
          <tr>
            <form action="index.php?flag=non" method="post">
              <input type="hidden" name="type" value='yes'  />
            </form>
            <td width="19%" align="right"><a href="index.php?status=cancel&flag=non" class="button">Cancelled Students</a></td>
            <td width="13%" align="right"><a href="index.php?status=complete&flag=non" class="button">Course Completed Students</a></td>
          </tr>
        </table>
        <?php
		if(isset($_REQUEST['status'])){
			$status=$_REQUEST['status'];
			}
if($status=='complete'){
	 $condition2=" ORDER BY prov_id ASC";	
			
		$que="SELECT * FROM stu_provisional where status=0 $condition2";
		if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
		$rowCount = $con->affected_rows;				
}
if($status=='cancel'){
		 $condition2=" ORDER BY cancel_id ASC";	
			
		$que="SELECT * FROM stu_cancel_prov $condition2";
		if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
		$rowCount = $con->affected_rows;			
}
	  
	   ?>
        <div class="main-wrapper">
        <h1 align="center">CANCELLED / COURSE COMPLETED STUDENTS LIST</h1>
        <p align="center">&nbsp;</p>
        <h2>Student List ( <span class="form-required">
          <?=$rowCount ?> 
          Students</span>  )</h2> 
        
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="16%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="5%">Parent Contact</th>
            <th width="5%">M/F</th>
            <th width="7%">Course</th>
            <th width="6%">Caste</th>
            <th width="17%">Correspondent Address</th>
            <th width="9%">Admission Date</th>
            <th width="9%">Cancel Date</th>
            <th width="5%">Total Fees</th>
             <th width="5%">Fees Paid</th> 
            
            
            <th width="7%">Cancel Reason  </th>
            <th>Renew Admission</th>
            </tr>
            </thead>
			<tbody class='ms'>
            
             <?php
				$clcnt=0;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['cancel_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$gender = $row_prov['gender'];
					
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					$reason = $row_prov['reason'];
					$prov_date = dateformate($row_prov['prov_date']);
					$cancel_date = dateformate($row_prov['cancel_date']);
					$p_contact = $row_prov['p_contact'];
					
					
				
					
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
            <td><ul class="actions">
                <li>
                  <?=$p_contact?>
                </li>
            </ul></td>
            <td><?=$gender?></td>
            <td>
		            <?php
					$query_prov_course = sprintf("SELECT * FROM stu_cancel_course WHERE cancel_id='%d'", $id);
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
			?>          </td>
            
            <td><?=$caste?></td>
            <td><?=$addr_premanent?></td>
            <td><?=$prov_date?></td>
            <td><?=$cancel_date?></td>
            <td><?=$fixedfees?></td>
          	<td><?=$feespaid?></td> 
            
            
            <td><?=$reason?></td>
            <td><ul class="actions">
                <li><a href="prov_add.php?flag=<?=$flag?>&amp;id=<?=$id?>" onclick="if(confirm('RENEW ADMISSION?')){return true;}else{return false;}"><img src="../../images/back.png" alt="ADD" /></a></li>
            </ul></td>
            </tr>
             <?php
				}?>
         </tbody>
        </table>
        </div>
        <!-- InstanceEndEditable -->      </div>
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
