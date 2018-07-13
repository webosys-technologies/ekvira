<?php
	session_start();
	include("../../common/connect.php");
	include("../../common/getid.php");
	$f_type=$_REQUEST['staff'];
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
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script><!-- InstanceEndEditable -->
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
        <h2 class="ico-rt"><a href="../user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?staff=<?=$f_type?>&flag=non">Home</a> &raquo; Faculty  Details<!-- InstanceEndEditable --></strong></p>
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
	$que=sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $id); 
	if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}

			$clcnt=0;
		
				if($row_f=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$fullname=stripslashes($row_f['name']);
					$type = $row_f['type'];
					$dob = dateformate($row_f['dob']);
					$gender = $row_f['gender'];
					$contact = $row_f['contact'];
					$designation =  $row_f['designation'];;
					$quali_id = $row_f['qualification'];
					$address = $row_f['address'];
					$salary = $row_f['salary']; 
					$experience = $row_f['experience'];
					$other = $row_f['other'];
					$doj = dateformate($row_f['doj']);
					$status = $row_f['status'];
					$resume = $row_f['resume'];
					$photo_url = $row_f['photo_url'];
						
					$query_edu = sprintf("SELECT * FROM stu_edu WHERE edu_id='%d'", $quali_id);
					if (!($result_edu = $con->query($query_edu))) 
					{ echo "FOR QUERY: $query_edu<BR>".$con->error; 	exit;}
					$row_edu = $result_edu->fetch_assoc();
					$qualification = $row_edu['edu'];
				}					
		?>
        <!-- Start Here --> 
        <div class="main-wrapper">
        <!-- Start Here -->
        
        
               	 <h1 align="center">VANDE MATARAM CAREER ACADEMY, AMJANGAON (SURJI) </h1>
          	<h2 align="center">FACULTY DETAILS </h2>
          
			<div style="width:40%; float:left;">
			 <p align="left"><strong>Faculty Type</strong>: <span style="text-transform:uppercase;">
			   <?php if($type=='teach'){ echo 'TEACHING';}else{ echo 'NON-TEACHING';}?>
			 </span></p> 
	      </div>
           <div style="width:50%; float:right;">
                <p align="right"><strong>Joining Date</strong> : <?=$doj?></p> 
           </div>
        <!-- End -->
        <table width="100%" border="0" class="tbl">
          <tr>
            <td width="18%"><strong>Full Name</strong></td>
            <td width="23%"  style="text-transform:uppercase;">: <?=$fullname?></td>
            <td width="17%"><strong>Desingnation</strong></td>
            <td width="21%">: <?=$designation?></td>
            <td width="21%" rowspan="7"><div align="center"><?php if($photo_url==''){ ?>
              <p align="right" class="back-to-index"><a href="../../pages/provisional/webcam/index.php?id=<?=$id?>&mode=f&flag=non" class="button">Click To Upload Photo</a></p>
            <?php }else{?><img align="right" src="../../pages/provisional/upload/<?=$photo_url?>" alt="" name="goat_img" width="160" height="180" id="goat_img" /><?php }?></div></td>
          </tr>
          <tr>
            <td><strong>DOB</strong></td>
            <td>: 
              <?=$dob?></td>
            <td><strong>Gender</strong></td>
            <td>: <?=$gender?></td>
            </tr>
          <tr>
            <td><strong>Contact NO.</strong></td>
            <td>: <?=$contact?></td>
            <td><strong>City</strong></td>
            <td>: <?=$qualification?></td>
            </tr>
          <tr>
            <td><strong>Salary</strong></td>
            <td>: <?=$salary?></td>
            <td><strong>Experience</strong></td>
            <td>: <?=$experience?></td>
            </tr>
          <tr>
            <td height="32"><strong>Corresp. Address</strong></td>
            <td colspan="3" align="left" valign="top">: <?=$address?></td>
            </tr>
          <tr>
            <td><strong>Other Details</strong></td>
            <td align="left" valign="top">:
              <?=$other?></td>
            <td><strong>Resume Uploaded</strong></td>
            <td align="left" valign="top">:
              <?php if($resume==''){ echo 'NO';}else{ echo 'YES (CLICK TO DOWNLOAD';}?></td>
            </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
		</table>
<?php }?>
        <!-- End -->
        <p align="center"><input type="button" onclick="window.print();" class="button" value="Print"  /></p>
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
