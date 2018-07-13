<?php
	session_start();
	include("../../common/connect.php");
	include("../../common/getid.php");
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; De-Allocate Student<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        <script>
        function toggle_stu(source) {
          checkboxes = document.getElementsByName('stu_id[]');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }
        </script>
        <?php
		 $id = $_GET['id'];
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
         <table width="100%" class="tbl" border="0">
           <tr style="font-size:14px;">
             <td width="19%"><strong>
             <h3>Faculty Name :-</h3></strong></td>
             <td width="25%"><?=$teacher?></td>
             <td width="19%"><strong>
             <h3>Student Name :-</h3></strong></td>
             <td width="37%"><?=$subject?></td>
           </tr>
         </table>
        <div class="main-wrapper">
        <!-- Start Here -->

			<h2>de-allocate Students from Teacher</h2>
			
		 <form action="submit.php" method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
            
            	<table width="66%" border="0" class="tbl" align="center">
                  <thead>
                    <tr>
                      <th width="7%">Sr. No.</th>
                      <th width="11%">Student ID</th>
                      <th width="41%">Student Name</th>
                      <th width="41%">Course</th>
                      <th width="11%"> <p> All</p>
                          <p>
                            <input id="select_all" type="checkbox" onclick="toggle_stu(this)" />
                        </p></th>
                    </tr>
                  </thead>
                  <tbody class='ms'>
                    <?php
				   //$col_name = 's_'.$id;
				   //$table_name ='stu_t_student';
				   $table_name = 's_'.$id.'_a';
				   $que_tab="SELECT * FROM ".$table_name." LIMIT 1";
					if(!($check_tab = $con->query($que_tab))){
						 $query_create=sprintf("CREATE TABLE IF NOT EXISTS ".$table_name."(`id` int(11) NOT NULL AUTO_INCREMENT,`stud_id` int(11) NOT NULL,PRIMARY KEY (`id`), UNIQUE KEY `stud_id` (`stud_id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");	
					if(!($result_create = $con->query($query_create))){echo $con->error; exit;}	
					}
					
					$que_ck="SELECT stud_id FROM ".$table_name;
					if (!($res_ck = $con->query($que_ck))){ echo "FOR QUERY: $que_ck<BR>".$con->error; 	exit;}
					$rowCk = $con->affected_rows;
					if($rowCk>0){
						$condition2=" ORDER BY prov_id ASC";
						$que="SELECT * FROM stu_provisional s LEFT JOIN ".$table_name." a ON s.prov_id=a.stud_id WHERE s.prov_id IN (SELECT stud_id from ".$table_name.") and s.status=1 $condition2";
					}else{
					
					echo '<p align="center"><font color="red"><B>NO STUDENTS HAVE BEEN ALLOCATED.</B></font></p> <a href="index.php?flag=non" class="button">Back</a>'; 
					exit;	
					}
					
					if (!($page_res = $con->query($que))) 
						{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
						$rowCount = $con->affected_rows; 
						
					$clcnt=0;
		
					while($row_prov=$page_res->fetch_assoc())
					{ 
						if($clcnt%2==0){$class="even";}else{$class="";}
						$clcnt++;
						$prov_id=$row_prov['prov_id'];
						$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
				   ?>
                   
                    <tr>
                      <td><div align="center">
                          <?=$clcnt;?>
                      </div></td>
                      <td><?php echo getstuid($row_prov['prov_date']).$prov_id;?></td>
                      <td><div align="center">
                        <?=$fullname?>
                      </div></td>
                      <td><div align="center">
                        <?php
								$query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $prov_id);
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
						?>
                      </div></td>
                      <td><div align="center">
                        <input class="checkbox" name="stu_id[]" type="checkbox" value="<?=$prov_id?>" />                      
                      </div></td>
                    </tr>
                    <?php   } ?>
                  </tbody>
                </table>
<input name="txtmode" type="hidden" value="deallocate" />
                    <input name="t_sub_id" type="hidden" value="<?=$id?>" />
			<?php if($rowCount>0){?><input name="input" type="submit" value="Submit" class="button"/>
			<?php }else{ ?><p align="center"><font color='red'><B>NO STUDENTS HAVE BEEN ALLOCATED.</B></font></p> <a href="index.php?flag=non" class="button">Back</a><?php }?>
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
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
