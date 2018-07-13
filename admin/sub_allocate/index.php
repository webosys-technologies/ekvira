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


<?php
	$condition2=" ORDER BY t.id DESC";	
	$que="SELECT t.id as t_s_id, teacher_id, sub_id, user_id, username FROM stu_t_subject t,login l where t.user_id=l.id and t.status=1 $condition2"; 

$pagesize=10;	

if (!($page_res = $con->query($que))) 
{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
$rowCount = $con->affected_rows; 

?>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Subject Allocation Management<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
	 	<div class="main-wrapper">
        <!-- Start Here -->
        <h2>Subject allocation to teacher</h2>
				
		  <div align="right"><a href="add.php?flag=<?=$flag?>" class="button">Add New</a></div>
        
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
			  <thead>      
			  <tr>
				<th width='8%'>Sr. No.</th>
				<th width="34%" align='left'>Faculty Name </th>
				<th width="18%" align='left'>Subject Name</th>
				<th width="17%" align='left'><p>Faculty Contact No.</p></th>
				<th width="13%" align='left'>Username</th>
				<th width='10%'>Action</th>
			  </tr>
			  </thead>
			  <tbody class='ms'>
			  <?php
			  
				$clcnt=0;
				while($row_t_sub=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_t_sub['t_s_id'];
					$teacher_id=$row_t_sub['teacher_id'];
					$sub_id=$row_t_sub['sub_id'];
					$username=$row_t_sub['username'];

					
					$query_teacher = sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $teacher_id);
					if (!($result_teacher = $con->query($query_teacher))) 
					{ echo "FOR QUERY: $query_teacher<BR>".$con->error; 	exit;}
					$row_teacher = $result_teacher->fetch_assoc();
					$teacher = $row_teacher['name'];
					$contact =  $row_teacher['contact'];
					
					$query_sub = sprintf("SELECT * FROM stu_subject WHERE sub_id='%d'", $sub_id);
					if (!($result_sub = $con->query($query_sub))) 
					{ echo "FOR QUERY: $query_sub<BR>".$con->error; 	exit;}
					$row_sub = $result_sub->fetch_assoc();
					$subject = $row_sub['subject'];
					
			  ?>
			  	<tr>
				<td  style="text-transform:uppercase;"  align="center"><?=$clcnt?>.</td>
				<td  style="text-transform:uppercase;" align='left'><?=$teacher?></td>
				<td  style="text-transform:uppercase;" align='left'><?=$subject?></td>
				<td align='left'><?=$contact?></td>
				<td align='left'><?=$username?></td>
				<td>
					
					<ul class="actions">
						<li><a title="edit" href="edit.php?flag=non&txtmode=edit&id=<?=$id?>" ><img src="../../images/pencil.png" alt="edit" width="25" height="25"></a></li>
						&nbsp; 
						<?php if($user_type=='SU'){?><li><a href="submit.php?flag=<?=$flag?>&id=<?=$id?>&txtmode=del" onClick="if(confirm('Teacher will get permanently deleted will all its previous records including attendance and marks. Do you really want to delete this Faculty?')){return true;}else{return false;}"><img src="../../images/trash.png" alt="delete" width="25" height="25"></a></li><?php }else{?><li><a href="submit.php?flag=<?=$flag?>&id=<?=$id?>&txtmode=inactive" onClick="if(confirm('Do you really want to delete this Faculty?')){return true;}else{return false;}"><img src="../../images/trash.png" alt="delete" width="25" height="25"></a></li><?php }?>
					</ul>				</td>
			  </tr>
			  <?php
				}?>
			  </tbody>
			</table>	
        
        
        <!-- End -->
        </div>
     
	 	<? $flag=$_REQUEST['flag']; ?>
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
