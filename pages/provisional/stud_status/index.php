<?php
	session_start();
	require '../../../common/connect.php';
	include("../../../common/getid.php");
	 if($_SESSION['authorised'])
	 {
	 	$state=$_SESSION['authorised'];
		$val=calcID();
		if($state==$val)
		{
		}else{
			header ("location: ../../../common/developer.php?flag=non");
			exit;
		}
		
	}else{
		header ("location: ../../../index.php?flag=non");
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->StudentStatus<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <table width="62%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
          <tr>
            <td width="36%" align="right"><a href="index.php?status=new&flag=<?=$flag?>" class="button">New Student</a></td>
           
              <td width="36%" align="right"><a href="index.php?status=regular&flag=<?=$flag?>" class="button">Regular Student</a></td>
      
            <td width="36%" align="right"><a href="index.php?status=old&flag=<?=$flag?>" class="button">Old Student</a></td>
          </tr>
        </table>
         <?php
		 if(isset($_REQUEST['status'])){
			$status=$_REQUEST['status'];
			}
		 
	   ?>
        <div class="main-wrapper">
        <h2> Student Provisional List ( <span class="form-required">
          <?=$status ?>
          Students</span>  )
        </h2>
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="8%">Student ID</th>
            <th width="21%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="5%">M/F</th>
            <th width="7%">Course</th>
            <th width="6%">Caste</th>
            <th width="13%">Correspondent Address</th>
            <th width="9%">Admission Date</th>
            <th width="7%">Remark</th>
            <th width="7%">Status</th>
          </tr>
            </thead>
			<tbody class='ms'>
            
             <?php
			  $condition2=" ORDER BY prov_id DESC";	
				$que="SELECT * FROM stu_provisional $condition2";
				if (!($page_res = $con->query($que))) 
					{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows; 
				$clcnt=0;
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$addr_corespond = $row_prov['addr_corespond'];
					$remark = $row_prov['remark'];
					$prov_date = $row_prov['prov_date'];
					$current_date = date("Y-m-d");
					
					$query_caste = sprintf("SELECT * FROM stu_caste WHERE caste_id='%d'", $caste_id);
					if (!($result_caste = $con->query($query_caste))) 
					{ echo "FOR QUERY: $query_caste<BR>".$con->error; 	exit;}
					$row_caste = $result_caste->fetch_assoc();
					$caste = $row_caste['caste'];
					$t1 = strtotime($current_date);
					$t2 = strtotime($prov_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$noofdays = floor($days)+1;
//OLD			
if($status=='old'){	
	if($noofdays>60){
	$status='OLD';
?>
<tr  style="text-transform:uppercase;">
            <td><?=$clcnt?></td>
            <td><?php echo getstuid($row_prov['prov_date']).$id;?></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
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
            
            <td><?=$caste?></td>
            <td><?=$addr_corespond?></td>
            <td><?=dateformate($prov_date);?></td>
            <td><?=$remark?></td>
            <td><?=$status?></td>
          </tr>	

<?php
	}
	//REGULAR
}else if($status=='regular'){
	if($noofdays>15 and $noofdays<=60){
	$status='REGULAR';
?>
<tr  style="text-transform:uppercase;">
            <td><?=$clcnt?></td>
            <td><?php echo getstuid($row_prov['prov_date']).$id;?></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
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
            
            <td><?=$caste?></td>
            <td><?=$addr_corespond?></td>
            <td><?=dateformate($prov_date);?></td>
            <td><?=$remark?></td>
            <td><?=$status?></td>
          </tr>


<?php
	}
	//NEW
}else{
	if($noofdays<15){
	$status='NEW';
?>
<tr  style="text-transform:uppercase;">
            <td><?=$clcnt?></td>
            <td><?php echo getstuid($row_prov['prov_date']).$id;?></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
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
            
            <td><?=$caste?></td>
            <td><?=$addr_corespond?></td>
            <td><?=dateformate($prov_date);?></td>
            <td><?=$remark?></td>
            <td><?=$status?></td>
          </tr>

<?php
	}
}
					
					
					
					if($noofdays>60){
							
					}else if($noofdays>15){
						
					}else{
						
					}
				 ?>
          
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
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>