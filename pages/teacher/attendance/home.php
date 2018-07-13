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
	$id = $_POST['id'];
	$a_date = $_POST['a_date'];
	$col_name = columnname($a_date);
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
<script type="text/javascript" src="../../../js/admission.js"></script>
<link href="../../../js/jquery.datepick.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../../js/jquery.plugin.js"></script>
<script src="../../../js/jquery.datepick.js"></script><!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; <a href="selectdate.php?id=<?=$id?>&amp;flag=non">Select Date</a> &raquo; Student Attendance<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
<script type="text/javascript">
		   var xmlHttp = createXmlHttpRequestObject();

			function createXmlHttpRequestObject(){
				var xmlHttp;
				
				if(window.ActiveXObject){
					try{
						xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
					}catch(e){
						xmlHttp = false;
					}
				}else{
					try{
						xmlHttp = new XMLHttpRequest();
					}catch(e){
						xmlHttp = false;
					}
				}
				if(!xmlHttp){
					alert("cant create that object hoos!"); 
				}else{
					return xmlHttp;
				}
				
			}
			
			function process(id){
				
				if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
					var stud_id = id;
					var t_id = <?=$id?>;
					var col_name = '<?=$col_name?>';
					xmlHttp.open("GET", "edit.php?tid=" +t_id+ "&stud_id=" +stud_id+ "&col_name="+col_name, true);
					//xmlHttp.onreadystatechange = handleServerResponse();
					alert('Attendance Edited');
					xmlHttp.send(null);
				}else{
					setTimeout('process()',500);
				}	
			}

			</script>
        <script>
        function toggle_stu(source) {
          checkboxes = document.getElementsByName('stu_id[]');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
		  }
			//AJAX CODE
				if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
					//var stud_id = source;
					var t_id = <?=$id?>;
					var col_name = '<?=$col_name?>';
					 //alert(val);
					xmlHttp.open("GET", "edit.php?tid=" +t_id+ "&flag=all&col_name=" +col_name, true);
					alert('All Set to Present');
					//xmlHttp.onreadystatechange = handleServerResponse();
					xmlHttp.send(null);
				}else{
					setTimeout('process()',500);
				}	
          
        }
        </script>
        
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
         <table width="100%" class="tbl" border="0">
           <tr style="font-size:14px;">
             <td width="18%"><strong>
             <h3>Faculty Name :-</h3></strong></td>
             <td width="21%"><?=$teacher?></td>
             <td width="18%"><strong>
             <h3>Subject Name :-</h3>
             </strong></td>
             <td width="17%"><?=$subject?></td>
             <td width="9%"><strong>
               <h3>Date :-</h3>
             </strong></td>
             <td width="17%"><?=$a_date?></td>
           </tr>
         </table>
        <div class="main-wrapper">
        <!-- Start Here -->

			<h2>Students Attendance Entry(<strong><font color="red">Select checkbox to mark attendance</font></strong>)</h2>
			
 <form method="POST"  name="regisfrm" onsubmit='return admin_ward();' class="form">		
            
            	<table width="66%" border="0" class="tbl" align="center">
                  <thead>
                    <tr>
                      <th width="6%">Sr. No.</th>
                      <th width="13%">Student ID</th>
                      <th width="41%">Student Name</th>
                      <th width="33%">Course</th>
                      <th width="7%"> <p> All</p>
                          <p>
                            <input id="select_all" type="checkbox" onclick="toggle_stu(this)" />
                        </p></th>
                    </tr>
                  </thead>
                  <tbody class='ms'>
                   <?php
				   //$col_name = columnname($a_date);
				   $table_name ='s_'.$id.'_a';
				   $que_col="SELECT ".$col_name." FROM ".$table_name." LIMIT 1";
					if(!($check_col = $con->query($que_col))){
						//$condition2=" ORDER BY prov_id DESC";	
						$que_col="ALTER TABLE ".$table_name." ADD COLUMN ".$col_name." INT(1) default 0";
						if (!($res_col = $con->query($que_col))){
							echo '<p align="center"><font color="#FF0000"><B>NO STUDENTS HAVE BEEN ALLOCATED ASK YOUR ADMIN TO ALLOT STUDENTS.</B></font></p>'; 
							//echo "FOR QUERY: $que_col<BR>".$con->error; 	
							exit;
						}	
					}
						$condition2=" ORDER BY prov_id ASC";	
						$que="SELECT * FROM stu_provisional,".$table_name." WHERE prov_id=stud_id $condition2";
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
						$col_val=$row_prov[$col_name];
				
				   ?>
                   
                    <tr>
                      <td><div align="center">
                          <?=$clcnt;?>
                      </div></td>
                      <td><div align="center">
                        <?php echo getstuid($row_prov['prov_date']).$prov_id;?>
                      </div></td>
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
                     
                        <input class="checkbox" onclick="process(<?=$prov_id?>);" name="stu_id[]" type="checkbox" value="<?=$prov_id?>" <?php if($col_val==1){?> checked="checked" <?php }?> />           
                             
                      </div></td>
                    </tr>
                    <?php   } ?>
                  </tbody>
                </table>
           	<input name="a_date" type="hidden" value="<?=$a_date?>" />
                    <input name="t_sub_id" type="hidden" value="<?=$id?>" />
			<?php if($rowCount==0){ ?><p align="center"><font color='red'><B>NO STUDENTS HAVE BEEN ALLOCATED ASK ADMIN TO ALLOT STUDENTS.</B></font></p> <a href="selectdate.php?flag=non&id=<?=$id?>" class="button">Back</a><?php }?>
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
