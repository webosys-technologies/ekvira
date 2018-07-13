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
	$id = $_GET['id'];
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

<script>
function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
</script>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Select Date of Exam<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <script type="text/javascript">	
        $(function(){
              $('#m_date').daterangepicker({
                posX:450,
                posY:460
              }); 
         });
        </script>
        <div class="main-wrapper">
        <!-- Start Here -->
             <?php
if($id > 0)
{
			$condition2=" where id=$id";	
			$que="SELECT * FROM stu_t_subject $condition2"; 
		
		$pagesize=10;	
		
		if (!($page_t_s = $con->query($que))) 
		{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
		$rowCount = $con->affected_rows; 
		
				$clcnt=0;
				if($row_t_sub=$page_t_s->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$teacher_id=$row_t_sub['teacher_id'];
					$sub_id=$row_t_sub['sub_id'];

					
					$query_teacher = sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $teacher_id);
					if (!($result_teacher = $con->query($query_teacher))) 
					{ echo "FOR QUERY: $query_teacher<BR>".$con->error; 	exit;}
					$row_teacher = $result_teacher->fetch_assoc();
					$teacher = $row_teacher['name'];
					
					$query_sub = sprintf("SELECT * FROM stu_subject WHERE sub_id='%d'", $sub_id);
					if (!($result_sub = $con->query($query_sub))) 
					{ echo "FOR QUERY: $query_sub<BR>".$con->error; 	exit;}
					$row_sub = $result_sub->fetch_assoc();
					$subject = $row_sub['subject'];
		}
	}				
	?>
    
    <h1 align="center">STUDENT ATTENDANCE ENTRY</h1>
    <p align="center">&nbsp;</p>
    <form  method="post" action="home.php?flag=<?=$flag?>">
   
        <table width="100%" class="tbl" border="0">
          <tr style="font-size:14px;">
            <td width="24%"><strong>
              <h3>Faculty Name :-</h3>
            </strong></td>
            <td width="29%"><?=$teacher?></td>
            <td width="25%"><strong>
              <h3>Subject Name :-</h3>
            </strong></td>
            <td width="22%"><?=$subject?></td>
            </tr>
          <tr style="font-size:14px;">
            <td><strong>
              <h3>Select Exam Date :-</h3>
            </strong></td>
            <td><input name="m_date" type="text" id="m_date" class="input-text" required="required" placeholder="Select Exam Date" /> </td>
            <td width="25%"><strong>
              <h3>Maximum Marks :-</h3>
            </strong></td>
            <td> <input name="max_mark" type="text" id="max_mark" class="input-text" required="required" placeholder="Enter Maximum Marks" /> </td>
            </tr>
          <tr style="font-size:14px;">
            <td>&nbsp;</td>
            <td colspan="2"><p align="center"><input type="submit" class="button" value="Click to Fill Marks" /></p></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        
          <input type="hidden" name="id" id="id" value="<?=$id?>" />
             
         </form>
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
