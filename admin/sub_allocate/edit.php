<?php
	session_start();
	include("../../common/connect.php");
	include("../../common/getid.php");
	
	if($flag=$_REQUEST['flag']){
	 	$flag=$_REQUEST['flag'];
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Edit Teachers Details<!-- InstanceEndEditable --></strong></p>
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
	$query=sprintf("SELECT * FROM stu_t_subject t, login l WHERE t.user_id=l.id and t.id='%d'", $id); 
	if(!($result = $con->query($query))){echo $con->error; exit;}
	$row_add=$result->fetch_assoc();	
}

if($id > 0)
{
	$title = "Edit";
}
else
{
	$title = "Add";
}
?>
		<? if($flag=="passerr"){?>
		<p align="center"><font color='red'><B>Un-Equal Password, Please enter Password correctly.</B></font></p>
		<? } ?>
    <div class="main-wrapper">
        <!-- Start Here -->

			<h2><?php echo $title;?><strong>teachers </strong>Details</h2>
			
		  <form action="submit.php" method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
			
        <div class="field">
				<label><strong>Faculty Name :<em>*</em></strong></label>
				<div class="fieldrt">
					<select name="teacher_id" class="slct" required >
                  <option value="">Please Select</option>
                 	<?php
				 		$query_f = "SELECT * FROM stu_faculty ORDER BY id ASC";
						if(!($result_f= $con->query($query_f)))
						{
							echo "FOR QUERY: $query_f<BR>".$con->error;
							exit();
						}  
						while($row_f = $result_f->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_f['id']?>' <?php if($row_add['teacher_id']==stripslashes($row_f['id'])){?>selected="selected" <?php }?> ><?php echo stripslashes($row_f['name']);?></option>
						<?php
						}?>
                </select>
				</div>
			</div>	
            
           
        <div class="field">
				<label><strong>Subject Name :<em>*</em></strong></label>
				<div class="fieldrt">
					<select name="subject_id" class="slct" required >
                  <option value="">Please Select</option>
                 <?php
				 		$query_sub = "SELECT * FROM stu_subject ORDER BY sub_id ASC";
						if(!($result_sub = $con->query($query_sub)))
						{
							echo "FOR QUERY: $query_sub<BR>".$con->error;
							exit();
						}  
						while($row_sub = $result_sub->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_sub['sub_id']?>' <?php if($row_add['sub_id']==stripslashes($row_sub['sub_id'])){?>selected="selected" <?php }?> ><?php echo stripslashes($row_sub['subject']);?></option>
						<?php
						}?>
                </select>
				</div>
			</div>
            
             <div class="field">
				<label><strong>Faculty Username :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" value="<?=$row_add['username']?>" class="input-text" name="f_user" id="f_user" <? if($_SESSION['u_type']!='SU'){?> disabled="disabled" <? } ?> required />
				</div>
			</div>	
            
           
        	<div class="field">
				<label><strong>Faculty Password :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="password" value="<?=$row_add['password']?>" class="input-text" name="f_pass" id="f_pass" required />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Retype Password :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" value="" name="re_pass" id="re_pass" required />
				</div>
			</div>

                
            <input type="hidden" value="<?=$row_add['user_id']?>" name="user_id" >
			<input type="hidden" value="<?=$id?>" name="id" >
            <input type="hidden" value="non" name="txtmode" id="txtmode"  />
			<div class="field">
			<label>&nbsp;</label>
			<div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/></div>
			</div>

			</form>
			<!-- End -->
			
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
