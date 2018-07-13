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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Upload/Update Photo<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
       <div class="flag-msg">
         <?php if($flag=$_REQUEST['flag']){
	 		$flag=$_REQUEST['flag'];
		 }?>	
		<? if($flag=="add"){?>
		<p align="center"><font color='red'><B>Photo Uploaded successfully.</B></font></p>
		<? } ?>	
		<? if($flag=="exit"){?>
		<p align="center"><font color='red'><B>Photo Not Uploaded.</B></font></p>
		<? } ?>		
        </div>
        
        
       <?php
	   $mode='old';
	  // require '../common/connect.php';
	   $condition2=" ORDER BY prov_id ASC";	
			
		$que="SELECT * FROM stu_provisional $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       
        <div class="main-wrapper">
        <h2>Student Provisional List</h2>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="5%">SR. NO.</th>
            <th width="9%">STUDENT ID</th>
            <th width="8%">FILE NO.</th>
            <th width="31%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="6%">M/F</th>
            <th width="10%">Admission Date</th>
            <th width="8%">Remark</th>
            <th width="7%">Print view</th>
            <th width="8%">Upload Photo</th>
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
					$gender = $row_prov['gender'];
					$remark = $row_prov['remark'];
					$fileno = $row_prov['fileno'];
					$prov_date = dateformate($row_prov['prov_date']);
					
			  ?>
          <tr>
            <td><?=$clcnt?></td>
            <td><div align="center">
              <?php echo getstuid($row_prov['prov_date']).$id;?>
            </div></td>
            <td><div align="center">
                <?=$fileno?>
            </div></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
            <td><?=$gender?></td>
            <td><?=$prov_date?></td>
            <td><?=$remark?></td>
            <td><ul class="actions">
                <li><a href="../provisional/view.php?id=<?=$id?>&flag=non&mode=<?=$mode?>"><img src="../../images/search.png" alt="View" /></a></li>
            </ul></td>
            <td>
            	<ul class="actions">
						<li><a href="../provisional/webcam/index.php?id=<?=$id?>&flag=non&mode=<?=$mode?>"><img src="../../images/icon-distribution.png" alt="View"></a></li>
				</ul>            </td>
            </tr>
             <?php
				}?>
         </tbody>
        </table>
        </div>
        <? if($rowCount==0){?>
		<p align="center"><font color='red'><B>No Record found.</B></font></p>
		<? } ?>
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
