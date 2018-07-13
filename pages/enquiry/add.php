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

<script type="text/javascript" src="../../js/admission.js"></script>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Enquiry Registration<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <!-- Start Here -->
        <div class="main-wrapper">
        <h2>Student Enquiry Registration</h2>
        <form action="submit-enquiry.php" method="post" class="form">
        <div class="field">
            <label>First Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Full Name" id="fname" name="fname" required />
            </div>
        </div>
        <div class="field">
            <label>Middle Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Full Name" id="mname" name="mname" required />
            </div>
        </div>
        <div class="field">
            <label>Last Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Last Name" id="lname" name="lname" required />
            </div>
        </div>
        <div class="field">
            <label>Phone NO. : <em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Full Name" id="phno" name="phno" />
            </div>
        </div>
        
        <div class="field">
            <label>Gender :<em>*</em></label>
            <div class="fieldrt">
              <input name="gender" type="radio" value="M" checked="checked" id="male" required /><label for="male">Male</label>
              <input name="gender" type="radio" value="F" id="female" style="margin-left:25%;" required /><label for="female">Female</label>
            </div>
        </div>
        
        <div class="field">
            <label>Caste :<em>*</em></label>
            <div class="fieldrt">
                <select name="caste" class="slct" required >
                  <option value="">Please Select</option>
                  
                  <?php
				 		$query_caste = "SELECT * FROM stu_caste ORDER BY caste_id ASC";
										
						if(!($result_caste = $con->query($query_caste)))
						{
							echo "FOR QUERY: $query_caste<BR>".$con->error;
							exit();
						}
						//$rowCount = $con->affected_rows;  
						while($row_caste = $result_caste->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_caste['caste_id']?>'><?php echo stripslashes($row_caste['caste']);?></option>
						<?php
						}?>
                </select>
            </div>
        </div>
        
        <div class="field">
            <label>Religion :<em>*</em></label>
            <div class="fieldrt">
                <select name="religion" class="slct" required >
                  <option value="">Please Select</option>
                 <?php
				 		$query_relig = "SELECT * FROM stu_religion ORDER BY religion_id ASC";
						
						if(!($result_relig = $con->query($query_relig)))
						{
							echo "FOR QUERY: $query_relig<BR>".$con->error;
							exit();
						}  
						while($row_relig = $result_relig->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_relig['religion_id']?>'><?php echo stripslashes($row_relig['religion']);?></option>
						<?php
						}?>
                </select>
            </div>
        </div>
        
        
        <div class="field">
            <label>Full Address. :</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Full Address" id="address" name="address"  />
       		 </div>
        </div>
        
        <div class="field">
            <label>Preferred Course List :<em>*</em></label>
            
            <div class="fieldrt">
            <INPUT type="button" class="button" value="Add Row" onclick="addRow('dataTable')" />
            <INPUT type="button" class="button" value="Delete Row" onclick="deleteRow('dataTable')" />
              <TABLE id="dataTable"  border="0">
        <TR>
            <TD><INPUT type="checkbox" name="chk"/></TD>
            <TD>
                <SELECT name="course_id[]" class="slct" required >
                	<OPTION value="">Please Select Branch</OPTION>
                    <?php
				 		$query_course = "SELECT * FROM stu_course ORDER BY course_id ASC";
						if(!($result_course = $con->query($query_course)))
						{
							echo "FOR QUERY: $query_course<BR>".$con->error;
							exit();
						}  
						while($row_course = $result_course->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_course['course_id']?>'><?php echo stripslashes($row_course['course']);?></option>
						<?php
						}?>
                </SELECT>
            </TD>
        </TR>
    </TABLE>
                <p>&nbsp;</p>
            </div>
        </div>
        
        <div class="field">
            <label>Remark.</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Remark" id="remark" name="remark" required />
       		 </div>
        </div>
        
        <div class="gap"></div>
        
        <div class="field">
        <label>&nbsp;</label>
        <div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/>
        </div>
        </div>
        </form>
        </div>
        <!-- End -->
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
