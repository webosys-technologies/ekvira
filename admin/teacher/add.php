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
        <h2 class="ico-rt"><a href="../user/edit.php?flag=<?=$flag?>&id=<?=$user_id?>"><img src="../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?staff=<?=$f_type?>&flag=non">Home</a> &raquo; Add Faculty Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
		<script type="text/javascript">	
        $(function(){
              $('#doj').daterangepicker({
                posX:550,
                posY:650
              }); 
         });
        </script>
		
        <div class="main-wrapper">
        <!-- Start Here -->

			<h2>Add New <?php if($f_type=='teach'){ echo 'teaching';}else{ echo 'non-teaching';}?> Faculty Details</h2>
			
		  <form action="submit.php?id=" method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
            
            
			<div class="field">
				<label><strong>Faculty Name :<em>*</em></strong></label>
				<div class="fieldrt">
				  <input type="text" class="input-text" style="text-transform:uppercase;" title="Faculty Name" id="name" name="name" onblur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Date Of Birth(dd-mm-yyyy) :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Date Of Birth" id="dob" name="dob" onBlur='notnull(this.id);' />
				</div>
			</div>
            
             <div class="field">
            <label><strong>Gender :<em>*</em></strong></label>
            <div class="fieldrt">
             <ul class="halflist">
             <li><input name="gender" type="radio" value="M" checked="checked" id="male" required /><label for="male">Male</label></li>
              <li><input name="gender" type="radio" value="F" id="female" style="margin-left:25%;" required /><label for="female">Female</label></li>
              </ul>
            </div>
        </div>
            
            <div class="field">
				<label><strong>Designation :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Designation" id="desig" name="desig" onBlur='notnull(this.id);' />
				</div>
			</div>
            
           
        <div class="field">
				<label><strong>Highest Qualification :<em>*</em></strong></label>
				<div class="fieldrt">
					<select name="quali" class="slct" required >
                  <option value="">Please Select</option>
                 <?php
				 		$query_edu = "SELECT * FROM stu_edu ORDER BY edu_id ASC";
						if(!($result_edu = $con->query($query_edu)))
						{
							echo "FOR QUERY: $query_edu<BR>".$con->error;
							exit();
						}  
						while($row_edu = $result_edu->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_edu['edu_id']?>'><?php echo stripslashes($row_edu['edu']);?></option>
						<?php
						}?>
                </select>
				</div>
			</div>
            
            <div class="field">
				<label><strong>Address :</strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Address" id="addr" name="addr" onBlur='notnull(this.id);' />
				</div>
			</div>
            
        <div class="field">
				<label><strong>Contact No. :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Contact No." id="contact" name="contact" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Date Of Joining :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Date Of Joining" id="doj" name="doj" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Salary :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Salary" id="sal" name="sal" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Experience Till Date :<em>*</em></strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Experience Till Date" id="exp" name="exp" onBlur='notnull(this.id);' />
				</div>
			</div>
            
            <div class="field">
				<label><strong>Other Details :</strong></label>
				<div class="fieldrt">
					<input type="text" class="input-text" title="Other Details" id="other" name="other" onBlur='notnull(this.id);' />
				</div>
			</div>
			<input type="hidden" value='<?=$f_type?>' name="f_type" />
			<div class="field">
			<label>&nbsp;</label>
			<div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/></div>
            
			</div>
				</form>
			</div>
		
		<!-- ****************End******************** -->

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
