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
	$table_name ='s_'.$id.'_m';
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; View Attendance  Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <div class="add_button">
       	<table width="100%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
   	    <tr>
   	      <td width="63%">&nbsp;</td>
           	  <td width="13%" align="right">
                <p align="right"><a href="export/export.php?id=<?=$id?>&tname=<?=$table_name?>" class="button">Export To Excel Sheet</a></p></td>  
        </tr>
        </table> 
       </div>
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

        
        <!-- End -->
        <table width="100%" border="0" class="tbl">
          <tr style="font-size:14px;">
            <td width="19%"><strong>
              <h3>Faculty Name :-</h3>
            </strong></td>
            <td width="34%"><?=$teacher?></td>
            <td width="25%"><strong>
              <h3>Subject Name :-</h3>
            </strong></td>
            <td width="22%"><?=$subject?></td>
          </tr>
        </table>
        
<?php
 $sql="SELECT * FROM ".$table_name;	   
if ($result=mysqli_query($con,$sql))
  {
  
  echo '<table width="34%" border="0" align="center" class="tbl"> <thead> <tr>';
  // Get field information for all fields
  echo "<th>SR. NO.</th>";
  while ($fieldinfo=mysqli_fetch_field($result))
    {
		$colname=$fieldinfo->name;
			
					$query_max = sprintf("SELECT * FROM stu_mark_det WHERE table_name='%s' and col_name='%s'", $table_name, $colname);
					if (!($result_max = $con->query($query_max))){ echo "FOR QUERY: $query_max<BR>".$con->error; 	exit;}
					if ($row_max=$result_max->fetch_assoc()) 
					{
					$max_mark=$row_max['max_mark'];
					}
			
	 
		if($colname=='id'){
			echo "<th>Student ID</th>";
		}elseif($colname=='stud_id'){
			echo "<th>Name</th>";
		}else{
			echo "<th style='font-size:9px;'>".datefromcol($colname)." (".$max_mark.")</th>";
		}
    }
	echo "</tr></thead>";
	$cnt=0;
	while($rows=$result->fetch_row()){
	 $cnt++;
		  echo "<tr>";
		  for($i=0;$i<=$result->field_count-1;$i++){
			  	if($i==0){
					echo "<td>".$cnt."</td>";
				}elseif($i==1){
					$que="SELECT * FROM stu_provisional WHERE prov_id=".$rows[$i];
					if (!($page_res = $con->query($que))) 
						{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
						$rowCount = $con->affected_rows; 
					if($row_prov=$page_res->fetch_assoc())
					{ 
						$prov_id=$row_prov['prov_id'];
						$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
						echo "<td>".getstuid($row_prov['prov_date']).$prov_id."</td>";
						echo "<td>".$fullname."</td>";
					}
				
				}else{
					echo "<td>".$rows[$i]."</td>";
				}

		  }
		  echo "</tr>";		
	}
	
  echo "</table>";	
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);
exit;		
//}
?>
        
        <p>&nbsp;</p>
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
