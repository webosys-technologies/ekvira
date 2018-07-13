<?php 
session_start();
//require 'common/connect.php';
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
 	header("Location: ../../../index.php?flag=err");
	exit;
 }
 
 $course_id = '';
 $section_id = '';
    $prov_id = ($_GET['prov_id']);
    $query_prov = sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $prov_id);
    if (!($result_prov = $con->query($query_prov))) 
    { echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}

    $row_prov=$result_prov->fetch_assoc();
    
    $query_prov_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $prov_id);
    $result_prov_doc = $con->query($query_prov_doc);
    $row_prov_doc=$result_prov_doc->fetch_assoc();
    $course_id = $row_prov['course_id'];
    $section_id = $row_prov['section_id'];
?>
<?php
include("../../../common/dbcontroller.php");
$db_handle = new DBController();
$sql12 = "SELECT * from stu_prov_marksheet WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";
//$data_marksheet = $db_handle->runQuery($sql12);
$count = $db_handle->numRows($sql12);

if($count == 0)
{
    $crr_dt = date('Y-m-d');
    $sql1=sprintf("INSERT INTO `stu_prov_marksheet` (`subjects`,`prov_id`, `class`, `section`,`date`)"
           . "VALUES('HINDI','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('ENGLISH','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('MARATHI','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('MATH','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('SCIENCE','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('SOCIAL STUDIES','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('COMPUTER','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."')");
     
    $data_marksheet1 = $db_handle->runQuery($sql1);
    
}
$sql = "SELECT * from stu_prov_marksheet WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

$data_marksheet = $db_handle->runQuery($sql);


?>

<?php

$db_handle = new DBController();
$sql123 = "SELECT * from formative_skill WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";
//$data_marksheet = $db_handle->runQuery($sql12);
 $count = $db_handle->numRows($sql123);

if($count == 0)
{
    $crr_dt = date('Y-m-d');
    $sql5=sprintf("INSERT INTO `formative_skill` (`subjects`,`prov_id`, `class`, `section`,`date`) "
           . "VALUES('GENERAL KNOWLEDGE:','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('ART & CRAFT:','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('HEIGHT (CM):','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('MORAL SCIENCE:','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('MUSIC:','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."'),"
           . "('WEIGHT(KG):','".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."')");
   $data_marksheet3 = $db_handle->runQuery($sql5);
}

$sql4 = "SELECT * from formative_skill WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

$data_marksheet2 = $db_handle->runQuery($sql4);

?>

<!--for third table-->

<?php

$db_handle1 = new DBController();
$sql1234 = "SELECT * from english_math_marks WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";
//$data_marksheet = $db_handle->runQuery($sql12);
 $count = $db_handle1->numRows($sql1234);

if($count == 0)
{
    $crr_dt = date('Y-m-d');
    $sql6=sprintf("INSERT INTO `english_math_marks` (`prov_id`, `class`, `section`,`date`) "
           . "VALUES('".$prov_id."','".$course_id."','".$section_id."','".$crr_dt."')");
           
   $data_marksheets = $db_handle1->runQuery($sql6);
}

$sql7 = "SELECT * from english_math_marks WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

$data_marksheet4 = $db_handle1->runQuery($sql7);

?>
<?php
$sql8 = "SELECT teacher_status FROM stu_prov_marksheet WHERE prov_id='$prov_id'";

$data = $db_handle1->runQuery($sql8);
foreach($data as $k=>$v) {
  $abc = $data[$k]["teacher_status"]; 
  
}
$usertype = $_SESSION['u_type'];

?>



<?php
   function calculatemarks($math,$acti)
    {
       
      if($math!='' && $acti!='')
          
            {
               $a = $acti/2;
               $m =  $math/4;
               $resul =$a + $m;
               return $resul;
             }
          
    }
    
    function calculatesa($first,$second,$third)
    {
        if($first!='' && $second!='' && $third!='')
           {
                $resul1 = $first + $second + $third;
                return $resul1;
           }
    }
    function calculatefa($first,$second)
    {
        if($first!='' && $second!='')
           {
                $resul1 = $first + $second;
                return $resul1;
           }
    }
    
?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        .tdgcell
        {
            font-size: 14px;
            font-weight: bold;
            color: #ffffff;
            background-color: #0079ac;
            
        }
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pre-Cadet Admission System</title>
<link href="css/style-sms.css" rel="stylesheet" type="text/css" />

<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css">
<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!--<script src="../../../js/jquery-3.1.1.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<script>
$(document).ready(function(){
	var togSrc = [ "images/up.png", "images/down.png" ];
	$("#notify").show();
	$("#adm_sec").hide();
	$("#stock_sec").hide();
	$("#lib_sec").hide();
	$("#staff_sec").hide();
	$("#stud_sec").hide();
	$("#admin_sec").hide();
  	$('#notifyimg').click(function(){
		$("#notify").show(1000);
		$("#adm_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#lib_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#admimg').click(function(){
		$("#adm_sec").show(1000);
		$("#notify").hide(1000);
		$("#stock_sec").hide(1000);
		$("#lib_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#libimg').click(function(){
		$("#lib_sec").show(1000);
		$("#notify").hide(1000);
		$("#adm_sec").hide(1000)
		$("#stock_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#stockimg').click(function(){
		$("#stock_sec").show(1000);
		$("#notify").hide(1000);
		$("#adm_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#staffimg').click(function(){
		$("#staff_sec").show(1000);
		$("#notify").hide(1000);
		$("#adm_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#studimg').click(function(){
		$("#stud_sec").show(1000);
		$("#notify").hide(1000);
		$("#adm_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#adminimg').click(function(){
		$("#admin_sec").show(1000);
		$("#notify").hide(1000);
		$("#adm_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#staff_sec").hide(1000);
		return false;
	});
});
</script>
<style type="text/css">
.main-container {
	background-color: #f5f5f5;
          border: 1px solid #e3e3e3;
}

.photo-edit{
    height:365px;
    
}
</style>
<style type="text/css">
    .sui-button-cell
    {
        text-align: center;
    }

    .sui-checkbox
    {
        font-size: 17px !important;
        padding-bottom: 4px !important;
    }

    .deleteButton img
    {
        margin-right: 3px;
        vertical-align: bottom;
    }

    .bigicon
    {
        color: #5CB85C;
        font-size: 20px;
    }
</style>
<style>
			
			.current-row{background-color:#B24926;color:#FFF;}
			.current-col{background-color:#1b1b1b;color:#FFF;}
			.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;border-collapse: collapse;margin-bottom: 20px;}
			.tbl-qa th.table-header {padding:5px;border: 1px solid black;font-size: 12px;text-align: center;}
			.tbl-qa .table-row td {padding:3px;pxbackground-color: #FDFDFD;border: 1px solid black;text-align: center;}
			.table-head{background-color: #D3D3D3;}
                        .td-color{background-color: #D3D3D3 !important;font-weight: bold;font-size: 12px;text-align: center;}
                        #rightPanel{margin-bottom: 0px;}
                        
		</style>
</head>


<body>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="../../../images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="../../../images/logotext.png" alt="subscription-management-system" /></div>
      <div class="hdrrt"><span class="logotxt">
        <?php
          
          if($_SESSION['username'])
          {
          echo "Welcome  " .$_SESSION['username'];
		  $user_id=$_SESSION['user_id'];
		  $user_type=$_SESSION['u_type'];
          }
          else
          {
          header ("location: index.php?flag=non");
          }
          ?>
           <?php if(isset($_REQUEST['flag'])){
				$flag=$_REQUEST['flag'];
			} ?>
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
        
        <h2 class="ico-rt"><a href="../../../logout.php?flag=logout"><img src="../../../images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="../../../admin/user/edit.php?id=<?=$user_id?>&flag=non"><img src="../../../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong>Dashboard</strong></p>
        </div>
    </div> 

    
<!--k-->

<div class="container">
<br>

	<div class="row main-container" id="main">
        <div class="col-md-4 well photo-edit" id="leftPanel">
            <div class="row">
                <div class="col-md-12">
                	<div>
                            <img src="../../../images/no-photo.png" alt="Texto Alternativo" class="img-circle img-thumbnail" style="width: 160px;">
        				<h2><?php echo $row_prov['fname'].' '.$row_prov['mname'].' '.$row_prov['lname']; ?></h2>
                                         
<!--                                        <div style="float:left;">
                                            English:
                                        </div><br><br>
                                        <div style="float:left;">
                                            Hindi:
                                        </div><br><br>
                                        <div style="float:left;">
                                            Marathi:
                                        </div>-->
                              
        		</div>
        	</div>
            </div>
        </div>
        
        <div class="col-md-8 well" id="rightPanel" style="border:none; padding-bottom: 0px;">
            <div class="row">
    <div class="col-md-12">
        
        <div class="alert alert-success" style="display:none;">
            <strong>Success:</strong> <span id="message_success"></span>
        </div>
        <div class="alert alert-danger" style="display:none;">
            <strong>Failure:</strong> <span id="message"></span>
      </div>
    </div>
    	<form role="form">
			<h2>Student Records</h2>
                        
			<hr class="colorgraph">
                            
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="name">Student Name:</label>
                                           <label class="col-sm-6 col-md-9 lable_text"><?php echo $row_prov['fname'].' '.$row_prov['mname'].' '.$row_prov['lname']; ?></label>
					</div>
					
				</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="FatherName">Father Name:</label>
                                           <label class="col-sm-6 col-md-9 lable_text"><?php echo $row_prov['mname'].' '.$row_prov['lname']; ?></label>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="MothorName">Mother Name:</label>
                                           <label class="col-sm-6 col-md-9 lable_text" for="email"><?php echo $row_prov['mother'] ?></label>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="class">Class:</label>
                                           <label class="col-sm-6 col-md-9 lable_text"><?php echo $row_prov['course_id'] ?></label>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="Section">Section:</label>
                                           <label class="col-sm-6 col-md-9 lable_text"><?php echo $row_prov['section_id'] ?></label>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
                                           <label class="col-sm-6 col-md-3 lable_color" for="Mobile No.">Mob No:</label>
                                           <label class="col-sm-6 col-md-9 lable_text"><?php echo $row_prov['contact'] ?></label>
					</div>
				</div>
				
			</div>
			<br>
                            <div col-xs-12 col-sm-6 col-md-6>
                                <div class="col-xs-12 col-sm-6">
                                    
                                </div>
                                    
                                <div>

                                        <div class="col-xs-12 col-sm-3"><a href="../../provisional/view.php?id=<?=$prov_id?>&flag=non&mode=new" class="btn btn-primary btn-block btn-md" style="color: white;">View</a></div>
                                </div>
                                    <div>

                                        <div class="col-xs-12 col-sm-3"><a href="../../provisional/prov_edit.php?flag=non&id=<?=$prov_id?>" class="btn btn-success btn-block btn-md" style="color: white;">Edit</a></div>
                                </div>
                                    
                            </div>
        </form></br></br>
</div></div>
                            <?php
                                    if($row_prov['course_id']<=3)
                                    {
                            ?>
                        <form action="update_marks.php" method="post" name="myForm" id="myForm">
                            <input type="hidden" name="stu_id" value="<?php echo $_GET['prov_id'] ?>">
                            <input type="hidden" name="class" value="<?php echo $row_prov['course_id'] ?>">
                            <input type="hidden" name="section" value="<?php echo $row_prov['section_id'] ?>">
                                <div style="margin-top:70px">&nbsp;&nbsp;&nbsp;</div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Select Term & Add Marks</h3>
                                </div>
                                <div class="panel-body">
                                 
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                   <label for="examdate">Exam Date:</label>
                                                   <input type="date" id="datetime" name="exam_date" value="<?php echo date('Y-m-d');?>">
                                                </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                   <label for="working_days">Working Days:</label>
                                                   <input type="number" id="working_days" name="working_days" value="">
                                                </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                   <label for="present_days">Present Days:</label>
                                                   <input type="number" id="present_days" name="present_days" value="">
                                                </div>

                                        </div>

                                    </div><br>
                                
                                      <div class="row"> 
                                        <div class="col-sm-4">
                                        <label for="sel1">Please Select Term</label>
                                        <select class="form-control selectpicker" id="term" name="term" required="required">
                                          <option value="">Select Term</option>
                                          <option value="1">I</option>
                                          <option value="2">II</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-4">
                                      <label for="sel2">Please Select Exam</label>
                                      <select id="sel_1" class="form-control selectpicker" name="exam" required="required">
                                          <option value="">Select Exam</option>
                                          <option value="A-1">A-1</option>
                                          <option value="A-2">A-2</option>
                                          <option value="A-3">A-3</option>
                                          <option value="A-4">A-4</option>                
                                      </select>
                                      
                                      </div>
                                      <div class="col-sm-4">
                                          <label for="sel1">Please Select Subject</label>
                                        <select class="form-control selectpicker" id="subject" name="subject" required="required">
                                          <option value="">Select Subject</option>
                                          <option value="1">English</option>
                                          <option value="2">Hindi</option>
                                          <option value="3">Marathi</option>
                                          <option value="4">Mathematics</option>
                                          <option value="5">Science</option>
                                          <option value="6">Social Studies</option>
                                          <option value="7">Social & Emotional Skill</option>
                                          <option value="8">Work Habits</option>
                                          <option value="9">Discipline</option>
                                          <option value="10">Maintenance of Books/Notebooks</option>
                                          <option value="11">Art & Craft</option>
                                          <option value="12">Music</option>
                                          <option value="13">Games</option>
                                          <option value="14">Moral Values</option>
                                          <option value="15">General Knowledge</option>
                                          <option value="16">Computer Science</option>
                                        </select>
                                      </div>
                                    </div> <br>  
                                     <div class="row">    
                                      <div class="col-sm-4">
                                          <label for="sel1">Please Select Exam</label>
                                        <select class="form-control selectpicker" id="sub_exam" name="sub_exam" required="required">
                                          <option value="">Select Exam</option>
                                          <option value="Exam 1">Exam 1</option>
                                          <option value="Exam 2">Exam 2</option>
                                          <option value="Exam 3">Exam 3</option>
                                          <option value="Exam 4">Exam 4</option>
                                          <option value="Exam 5">Exam 5</option>
                                          <option value="Exam 6">Exam 6</option>
                                          <option value="Exam 7">Exam 7</option>
                                          <option value="Exam 8">Exam 8</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-4">
                                          <!--for English Hindi Marathi skill-->
                                          <label for="sel1">Please Select Skill</label>

                                          <select id="skill" class="form-control selectpicker" name="skill" required="required">
                                          <option value="">Select Skill</option>
                                          <option value="1">Listening Skill</option>
                                          <option value="2">Speaking Skill</option>
                                          <option value="3">Writing Skill</option>
                                          <option value="4">Reading Skill</option>
                                          </select>
                                          

                                      </div><br>
                                      <div class="col-sm-4">
                                          
                                          <select id="skill_option1" class="form-control selectpicker" name="skill_option1" required="required">
                                             <option value="">Select Option</option>
                                             <option value="1">Comprehension Level</option>
                                             <option value="2">Concentration</option>
                                         </select>
                                          
                                      </div>
                                     </div>      
                                  
                                </div>
                            </div>
                            
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="col-sm-12">
                                        <!--For English start-->
                                            <div id="grade_1" name="abc">
                                                <input type="radio" name="radio_name" value="A+"/> A+ -Mostly Demonstrates comprehension of short spoken text by answering question and illustating it<br/>
                                                <input type="radio" name="radio_name" value="A"/> A -Many Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>
                                                <input type="radio" name="radio_name" value="B"/> B -Some Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>
                                                <input type="radio" name="radio_name" value="C"/> C -Few Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>
                                                <input type="radio" name="radio_name" value="D"/> D -Need to Demonstrates comprehension of short spoken text by answering question and illustating it<br/>
                                            </div>
                                     
                                    </div>
                            </div>
                            <br>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-md-10">
                                    
                                </div>
                                 <div class="col-xs-12 col-md-2">
                                     <input type="button" name="smt" class="btn btn-info btn-block btn-md" value="Submit" id="smt" />
                                     
                                 

                                 </div><br></br>
                            <hr class="colorgraph">
                            </div>
                                
                                </form><br>
                                    <hr class="colorgraph">
            
                            <div col-xs-12 col-sm-12 col-md-12>
                                <div class="col-md-9"></div>
                                <div class="col-xs-12 col-md-3"><a href="stu-result.php?prov_id=<?php echo $_GET['prov_id']; ?>" class="btn btn-primary btn-block btn-md" style="color: white;">See Result</a></div>
                            </div>
                            
<?php
                                    }
                        else {
           ?>
                
                            
	</div>
            
           <!--First table-->

        </div>      
            <div class="container">
                <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading"><h4 style="font-weight: bold;">DEVELOPMENT OF SUBJECT LEARNING SKILL</h4></div>
                <div class="alert alert-danger" id="messa" style="display:none;margin-bottom:0px;" ><p><strong>Warning!!</strong>&nbspYou are not Authorised to change marks</p></div>
                <div class="alert alert-success" id="messa1" style="display:none;margin-bottom:0px;" ><p><strong>Success!!</strong>&nbspYou Marks Submitted Successfully</p></div>
                <div class="alert alert-success" id="messa2" style="display:none;margin-bottom:0px;" ><p><strong>Success!!</strong>&nbspFinal Marks submitted by teacher and admin successfully...!</p></div>
                <div>
                    <table class="tbl-qa" id="first_table">
                <thead>
                                
                                <tr class="table-head">
                                      <th class="table-header">ID</th>
                                      <th class="table-header" width="10%">SUBJECTS</th>
                                      <th class="table-header">MT-I</th>
                                      <th class="table-header">MT-II</th>
                                      <th class="table-header">FA-I</th>
                                      <th class="table-header">FA-II</th>
                                      <th class="table-header">WTE-I</th>
                                      <th class="table-header">SA-I</th>
                                      <th class="table-header">MT-III</th>
                                      <th class="table-header">MT-IV</th>
                                      <th class="table-header">FA-III</th>
                                      <th class="table-header">FA-IV</th>
                                      <th class="table-header">WTE-II</th>
                                      <th class="table-header">SA-II</th>
                                      <th class="table-header">FA 1+2</th>
                                      <th class="table-header">FA 3+4</th>
                                      <th class="table-header">SA 1+2</th>
                                      <th class="table-header">OG</th>
                                      <th class="table-header">ACT-I</th>
                                      <th class="table-header">ACT-II</th>
                                      <th class="table-header">ACT-III</th>
                                      <th class="table-header">ACT-IV</th>

                                      
                                </tr>
                                <tr class="table-head">
                                      <th class="table-header">ID</th>
                                      <th class="table-header">OUT OF</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="10">10:M</th>
                                      <th class="table-header" value="10">10:M</th>
                                      <th class="table-header" value="80">80:M</th>
                                      <th class="table-header" value="50">50:M</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="10">10:M</th>
                                      <th class="table-header" value="10">10:M</th>
                                      <th class="table-header" value="80">80:M</th>
                                      <th class="table-header" value="50">50:M</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="20">20:M</th>
                                      <th class="table-header" value="60">60:M</th>
                                      <th class="table-header" value="100">100:M</th>
                                      <th class="table-header" value="100">10:M</th>
                                      <th class="table-header" value="100">10:M</th>
                                      <th class="table-header" value="100">10:M</th>
                                      <th class="table-header" value="100">10:M</th>

                                      
                                </tr>
                        </thead>
                        <tbody>
                            
                                                
                             <?php
                              $sql8 = "SELECT * FROM stu_prov_marksheet WHERE prov_id='$prov_id'";

$data = $db_handle1->runQuery($sql8); 
foreach($data as $k=>$v) {
//  echo $data[$k]["teacher_status"]; 

}
//echo $data[$k]["teacher_status"];
//echo " ".$usertype;
//die;
$ts=$data[$k]["teacher_status"];
$tr=$data[$k]["teacher_role"];
$as=$data[$k]["admin_lock"];
$ar=$data[$k]["admin_role"];

                             if($data[$k]["teacher_status"] == 1 && $data[$k]["teacher_role"] =='TU' && $data[$k]["admin_lock"] == 1 && $data[$k]["admin_role"] =='SU'){
//                                 die('1:TU 1:SU');
                               
                             foreach($data_marksheet as $k=>$v) {
                                ?>
                                <tr class="table-row" id="table-row5">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td class="tdcell2" id="disab" class="td-color" contenteditable="false" onBlur="saveToDatabase(this,'subjects','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["subjects"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_1"])) echo "class='tdgcell'"; ?> onBlur="saveToDatabase(this,'mt_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_1"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_2"]; ?></td>
                                      <td class="tdcell2" id="disab" class="tdcell1" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php $a = calculatemarks($data_marksheet[$k]["mt_1"],$data_marksheet[$k]["act_1"]);?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $b = calculatemarks($data_marksheet[$k]["mt_2"],$data_marksheet[$k]["act_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $x = calculatesa($a,$b,$data_marksheet[$k]["wte_1"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_4"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $c = calculatemarks($data_marksheet[$k]["mt_3"],$data_marksheet[$k]["act_3"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $d = calculatemarks($data_marksheet[$k]["mt_4"],$data_marksheet[$k]["act_4"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $y = calculatesa($c,$d,$data_marksheet[$k]["wte_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($a,$b); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($c,$d); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($x,$y); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["og"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'og','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["og"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_4"]; ?></td>

                                </tr>
                            
                      <?php
                      }
                             }
                             else if($data[$k]["teacher_status"] == 1 && $usertype =='TU' && $data[$k]["admin_lock"] == 0 && $data[$k]["admin_role"] ==''){
//                                 die('1:TU');
                               
                             foreach($data_marksheet as $k=>$v) {
                                ?>
                                <tr class="table-row" id="table-row5">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td class="tdcell2" id="disab" class="td-color" contenteditable="false" onBlur="saveToDatabase(this,'subjects','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["subjects"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_1"])) echo "class='tdgcell'"; ?> onBlur="saveToDatabase(this,'mt_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_1"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_2"]; ?></td>
                                      <td class="tdcell2" id="disab" class="tdcell1" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php $a = calculatemarks($data_marksheet[$k]["mt_1"],$data_marksheet[$k]["act_1"]);?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $b = calculatemarks($data_marksheet[$k]["mt_2"],$data_marksheet[$k]["act_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $x = calculatesa($a,$b,$data_marksheet[$k]["wte_1"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_4"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $c = calculatemarks($data_marksheet[$k]["mt_3"],$data_marksheet[$k]["act_3"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $d = calculatemarks($data_marksheet[$k]["mt_4"],$data_marksheet[$k]["act_4"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $y = calculatesa($c,$d,$data_marksheet[$k]["wte_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($a,$b); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($c,$d); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($x,$y); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["og"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'og','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["og"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_4"]; ?></td>

                                </tr>
                            
                      <?php
                      }
                             }
                             
                             else if($usertype == 'GU' || $usertype == 'SU'){
//                                 die('GU/SU');
                                foreach($data_marksheet as $k=>$v) { 
                             
                      ?>
                            <tr class="table-row" id="table-row5">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td id="disab" class="td-color" contenteditable="true" onBlur="saveToDatabase(this,'subjects','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["subjects"]; ?></td>
                                      <td id="disab" contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_1"])) echo "class='tdgcell'"; ?> onBlur="saveToDatabase(this,'mt_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_1"]; ?></td>
                                      <td id="disab" contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_2"]; ?></td>
                                      <td id="disab" class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $a = calculatemarks($data_marksheet[$k]["mt_1"],$data_marksheet[$k]["act_1"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $b = calculatemarks($data_marksheet[$k]["mt_2"],$data_marksheet[$k]["act_2"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["wte_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_1"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $x = calculatesa($a,$b,$data_marksheet[$k]["wte_1"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_3"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_4"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $c = calculatemarks($data_marksheet[$k]["mt_3"],$data_marksheet[$k]["act_3"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $d = calculatemarks($data_marksheet[$k]["mt_4"],$data_marksheet[$k]["act_4"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["wte_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_2"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $y = calculatesa($c,$d,$data_marksheet[$k]["wte_2"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($a,$b); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_3_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($c,$d); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($x,$y); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["og"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'og','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["og"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_1"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_2"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_3"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_4"]; ?></td>

                                </tr>
                            <?php
                      }
                             }
                             else if($data[$k]["teacher_status"] == 0 && $usertype =='TU'){
//                                 die('0:TU');
                                 
                             foreach($data_marksheet as $k=>$v) {
                                ?>
                                <tr class="table-row" id="table-row5">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td id="disab" class="td-color" contenteditable="true" onBlur="saveToDatabase(this,'subjects','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["subjects"]; ?></td>
                                      <td id="disab" contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_1"])) echo "class='tdgcell'"; ?> onBlur="saveToDatabase(this,'mt_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_1"]; ?></td>
                                      <td id="disab" contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_2"]; ?></td>
                                      <td id="disab" class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $a = calculatemarks($data_marksheet[$k]["mt_1"],$data_marksheet[$k]["act_1"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $b = calculatemarks($data_marksheet[$k]["mt_2"],$data_marksheet[$k]["act_2"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["wte_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_1"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $x = calculatesa($a,$b,$data_marksheet[$k]["wte_1"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_3"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["mt_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_4"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $c = calculatemarks($data_marksheet[$k]["mt_3"],$data_marksheet[$k]["act_3"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $d = calculatemarks($data_marksheet[$k]["mt_4"],$data_marksheet[$k]["act_4"]); ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["wte_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_2"]; ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $y = calculatesa($c,$d,$data_marksheet[$k]["wte_2"]); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($a,$b); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["fa_3_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($c,$d); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["sa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($x,$y); ?></td>
                                      <td class="tdcell1" contenteditable="true" <?php if(!empty($data_marksheet[$k]["og"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'og','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["og"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_1"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_2"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_3"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet[$k]["act_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_4"]; ?></td>

                                </tr>
                      <?php
                      }
                             }
                             else{       
//                                 die('else');
                                foreach($data_marksheet as $k=>$v) { 
                             
                      ?>        
                            <tr class="table-row" id="table-row5">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td class="tdcell2" id="disab" class="td-color" contenteditable="false" onBlur="saveToDatabase(this,'subjects','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["subjects"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_1"])) echo "class='tdgcell'"; ?> onBlur="saveToDatabase(this,'mt_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_1"]; ?></td>
                                      <td class="tdcell2" id="disab" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_2"]; ?></td>
                                      <td class="tdcell2" id="disab" class="tdcell1" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php $a = calculatemarks($data_marksheet[$k]["mt_1"],$data_marksheet[$k]["act_1"]);?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $b = calculatemarks($data_marksheet[$k]["mt_2"],$data_marksheet[$k]["act_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $x = calculatesa($a,$b,$data_marksheet[$k]["wte_1"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["mt_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'mt_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["mt_4"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $c = calculatemarks($data_marksheet[$k]["mt_3"],$data_marksheet[$k]["act_3"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $d = calculatemarks($data_marksheet[$k]["mt_4"],$data_marksheet[$k]["act_4"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["wte_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'wte_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["wte_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $y = calculatesa($c,$d,$data_marksheet[$k]["wte_2"]); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($a,$b); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["fa_3_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'fa_3_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($c,$d); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["sa_1_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'sa_1_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo calculatefa($x,$y); ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["og"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'og','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["og"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_1','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_1"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_2','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_2"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_3"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_3','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_3"]; ?></td>
                                      <td class="tdcell2" contenteditable="false" <?php if(!empty($data_marksheet[$k]["act_4"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase(this,'act_4','<?php echo $data_marksheet[$k]["id"]; ?>')" onClick="showEdit(this);"><?php echo $data_marksheet[$k]["act_4"]; ?></td>

                                </tr>
                             <?php 
                             
                             
                             }
                             
}

if($ts==1 && $tr=='TU' && $as==1 && $ar=='SU')
                                { ?>
                                  <script>
                                        $(".tdcell2").click(function() 
                                        {
                                            $('#refresh').hide();
                                            $('#refresh1').hide();
                                            $('#messa2').show().delay(2500).fadeOut('slow');
                                        });
                                </script>  
                                <?php }
                                ?>
                        </tbody>
		</table>
                </div>
              </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2"><button id="refresh" class="btn btn-success btn-block btn-md tdcell2" style="color: white;" >Show Result</button></div>
                    <div class="col-md-2"><button id="refresh1" class="btn btn-danger btn-block btn-md tdcell2" style="color: white;" onclick="myFunction()">Save & Locked</button></div>
                     
                    
                </div><br>
                
       <!--second table-->
             <div class="row">
              <div class="panel panel-info">
                <div class="panel-heading"><h4 style="font-weight: bold;">DEVELOPMENT OF FORMATIVE SKILL</h4></div>
                <div>
                    <table class="tbl-qa">
                <thead>
                                
                                <tr class="table-head">
                                      <th class="table-header">ID</th>
                                      <th class="table-header">SUBJECTS</th>
                                      <th class="table-header">TERM - I</th>
                                      <th class="table-header">TERM - II</th>
                                      <th class="table-header">CLASS</th>
                                      <th class="table-header">SECTION</th>
                                      <th class="table-header">DATE</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($data_marksheet2 as $k=>$v) {
                        ?>
                                <tr class="table-row">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                      <td contenteditable="true" style="text-align:left;" onBlur="saveToDatabase1(this,'subjects','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["subjects"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet2[$k]["term_1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase1(this,'term_1','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["term_1"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet2[$k]["term_2"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase1(this,'term_2','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["term_2"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet2[$k]["class"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase1(this,'class','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["class"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet2[$k]["section"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase1(this,'section','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["section"]; ?></td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet2[$k]["date"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase1(this,'date','<?php echo $data_marksheet2[$k]["id"]; ?>')" onClick="showEdit1(this);"><?php echo $data_marksheet2[$k]["date"]; ?></td>
                                </tr>
                      <?php
                      }
                      ?>
                        </tbody>
		</table>
                </div>
              </div>  
             </div>
    
       <!--Third table-->
             <div class="row">
              <div class="panel panel-info">
                <div class="logo"><img src="../../../images/headtext.png" alt="Logo" /></div>
                <div>
                    <table class="tbl-qa">
                <thead>
                                
                                <tr class="table-head">
                                      <th class="table-header">ID</th>
                                      <th class="table-header"colspan="4">BASELINE TEST-I</th>
                                      <th class="table-header"colspan="4">BASELINE TEST-II</th>
                                      
                                </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($data_marksheet4 as $k=>$v) {
                        ?>
                                <tr class="table-row">
                                    <td class="td-color"><?php echo $k+1; ?></td>
                                    <td style="padding:0px;">ENGLISH :</td>
                                    <td contenteditable="true" <?php if(!empty($data_marksheet4[$k]["english"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase2(this,'english','<?php echo $data_marksheet4[$k]["id"]; ?>')" onClick="showEdit2(this);"><?php echo $data_marksheet4[$k]["english"]; ?></td>
                                    <td>MATH :</td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet4[$k]["math"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase2(this,'math','<?php echo $data_marksheet4[$k]["id"]; ?>')" onClick="showEdit2(this);"><?php echo $data_marksheet4[$k]["math"]; ?></td>
                                      <td>ENGLISH :</td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet4[$k]["english1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase2(this,'english1','<?php echo $data_marksheet4[$k]["id"]; ?>')" onClick="showEdit2(this);"><?php echo $data_marksheet4[$k]["english1"]; ?></td>
                                      <td>MATH :</td>
                                      <td contenteditable="true" <?php if(!empty($data_marksheet4[$k]["math1"])) echo "class='tdgcell'"; ?>  onBlur="saveToDatabase2(this,'math1','<?php echo $data_marksheet4[$k]["id"]; ?>')" onClick="showEdit2(this);"><?php echo $data_marksheet4[$k]["math1"]; ?></td>
                                      
                                      
                                </tr>
                      <?php
                      }
                      ?>
                        </tbody>
		</table>
                </div>
              </div>  
             </div>
            
          
            <div class="container">
                       <div class="row">
                           <hr class="colorgraph">
                        </div>
                        <div class="row">
                           <div col-xs-12 col-sm-12 col-md-12>
                               <div class="col-md-9"></div>
                               <!--<div class="col-md-2" style="display:none;"><a href="stu-result1.php?prov_id=<?php echo $_GET['prov_id']; ?>&pdf=true" class="btn btn-primary btn-block btn-md" style="color: white;">Confirm & Print</a></div>-->
                               <div id="button" class="col-md-3"><a href="stu-result1.php?prov_id=<?php echo $_GET['prov_id']; ?>" class="btn btn-info btn-block btn-md" style="color: white;">See Result</a></div>
                           </div>
                        </div>
                                

                           <?php 

                                   }?>
                             
                             <?php
                             if($abc == 0)
                                {
                                  ?>
                                    <script>
                                        $('#refresh').click(function() 
                                        {
                                            location.reload();
                                         });

                                        $("#refresh1").click(function() 
                                        {
                                            $(".tdcell1").blur();

                                         });
                                         $("#refresh1").click(function() 
                                        {
                                            $('#messa1').show().delay(2500).fadeOut('slow');

                                         });   
                                      </script>
                                <?php
                                    }
                                else if($usertype == 'GU' || $usertype == 'SU'){
                                    ?>
                                    
                                    <script>
                                        $('#refresh').click(function() 
                                        {
                                            location.reload();
                                         });

                                        $("#refresh1").click(function() 
                                        {
                                            $(".tdcell1").blur();

                                         });
                                         $("#refresh1").click(function() 
                                        {
                                            $('#messa1').show().delay(2500).fadeOut('slow');

                                         });   
                                      </script>
                                <?php } 
                                else if($ts==1)
                                { ?>
                                  <script>
                                        $(".tdcell2").click(function() 
                                        {
                                            $('#refresh').hide();
                                            $('#refresh1').hide();
                                            $('#messa').show().delay(2500).fadeOut('slow');
                                        });
                                </script>  
                                <?php }
                            else{
                                ?>
                                <script>
                                        $(".tdcell2").click(function() 
                                        {
                                            $('#refresh').hide();
                                            $('#refresh1').hide();
                                            $('#messa').show().delay(2500).fadeOut('slow');
                                        });
                                </script>
                                    
                             <?php  } ?>


                
            </div>
   </div>            
        </div>   
<!--j-->
    
<script>
$(document).ready(function(){
var form=$("#myForm");
$("#smt").click(function(){
    $('.alert alert-success').hide();
    $('.alert-danger').hide();
    if($('#working_days').val() == '')
    {   $('.alert alert-success').hide();
        $('#message').text('Please fill working days!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#present_days').val() == '')
    {   $('.alert alert-success').hide();
        $('#message').text('Please fill present days!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#term').val() == '')
    {   $('.alert alert-success').hide();
        $('#message').text('Please select term!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#sel_1').val() == '')
    {   $('.alert alert-success').hide();
        $('#message').text('Please select exam!');
        $('.alert-danger').show();
        return false;
    }
    
    else if($('#subject').val() == '')
    {   $('.alert-success').hide();
        $('#message').text('Please select Sebject!'); 
        $('.alert-danger').show();
        return false;
    }
    else if($('#sub_exam').val() == '')
    {   $('.alert-success').hide();
        $('#message').text('Please select exam!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#skill').val() == '' && $('#subject').val() != 10)
    {   $('.alert-success').hide();
        $('#message').text('Please select skill!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#subject').val() <= 3 && $('#skill_option1').val() == '')
    {    $('.alert-success').hide();
        $('#message').text('Please select skill level!');
        $('.alert-danger').show();
        return false;
    }
    else if($('#datetime').val() == '')
    {   $('.alert-success').hide();
        $('#message').text('Please select skill date!');
        $('.alert-danger').show();
        return false;
    }
    else if($('input:radio[name=radio_name]:checked').val() == '' || $('input:radio[name=radio_name]:checked').val() == undefined)
       {   $('.alert-success').hide();
        $('#message').text('Please select radio!');
        $('.alert-danger').show();
        return false;
    }
$.ajax({
        type:"POST",
        url:form.attr("action"),
        data:form.serialize(),
        success: function(response){
            $('.alert-danger').hide();
            $('.alert-success').hide();
            $('#message_success').text(response);  
            
            $('.alert-success').show();
             
        }
    });
});
});
</script>

<style>
    #leftPanel{
    background-color:#0079ac;
    color:#fff;
    text-align: center;
}

#rightPanel{
    height:367px;
}

/* Credit to bootsnipp.com for the css for the color graph */
.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>


</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	<div class="fflt">Copyright &copy; 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>


    <script type="text/javascript">
         
                $('#term').change(function(){
                    if(this.value==1){
                        $('#sel_1').html('<option value="">Please Select Exam</option><option value="A-1">A-1</option><option value="A-2">A-2</option><option value="A-3">A-3</option><option value="A-4">A-4</option> ');
                        //$('#sel_1').show();
                        
                    }
                    if(this.value==2){
                        
                       $('#sel_1').html('<option value="">Please Select Exam</option><option value="A-5">A-5</option><option value="A-6">A-6</option><option value="A-7">A-7</option><option value="A-8">A-8</option>');
                    }
                });
                
                
                
            var listening =['Comprehension Level','Concentration'];
            var Speaking =['Syntax & Vocabulary','Expression of ideas'];
            var Writing =['Handwriting','Spelling','Punctuation','Creativity'];
            var Reading =['interest','Comprehension Level','Flunency & Clarity'];
            $(document).ready(function(){
                         
subject
                
                $('#skill').change(function(){
                if(this.value==1){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="1">Comprehension Level</option><option value="2">Concentration</option>');
                }else if(this.value==2){
                      $('#skill_option1').html('<option value="">Select Option</option><option value="3">Syntax & Vocabulary</option><option value="4">Expression of Idea\'s</option><option value="5">Pronunciation</option>');
                }else if(this.value==3){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="6">Interest</option><option value="7">Comprehension Level</option><option value="8">Fluency & Clarity</option>');
                }else if(this.value==4){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="9">Handwriting</option><option value="10">Spelling</option><option value="11">Punctuation</option><option value="12">Creativity</option>');
                }
                
            });
                $('#skill').change(function(){
                if(this.value==5){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="13">Comprehension Level</option><option value="14">Concentration</option>');
                }else if(this.value==6){
                      $('#skill_option1').html('<option value="">Select Option</option><option value="15">Syntax & Vocabulary</option><option value="16">Expression of Idea\'s</option><option value="17">Pronunciation</option>');
                }else if(this.value==7){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="18">Interest</option><option value="19">Comprehension Level</option><option value="20">Fluency & Clarity</option>');
                }else if(this.value==8){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="21">Handwriting</option><option value="22">Spelling</option><option value="23">Punctuation</option><option value="24">Creativity</option>');
                }
                
            });
                $('#skill').change(function(){
                if(this.value==9){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="25">Comprehension Level</option><option value="26">Concentration</option>');
                }else if(this.value==10){
                      $('#skill_option1').html('<option value="">Select Option</option><option value="27">Syntax & Vocabulary</option><option value="28">Expression of Idea\'s</option><option value="29">Pronunciation</option>');
                }else if(this.value==11){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="30">Interest</option><option value="31">Comprehension Level</option><option value="32">Fluency & Clarity</option>');
                }else if(this.value==12){
                    $('#skill_option1').html('<option value="">Select Option</option><option value="33">Handwriting</option><option value="34">Spelling</option><option value="35">Punctuation</option><option value="36">Creativity</option>');
                }
                
            });

                 
//                 When subject change then display thease skills
                $('#subject').change(function(){
                if(this.value==1){
//                    for English skill
                     
                    $('#skill').html('<option value="">Select Skill</option><option value="1">Listening Skill</option><option value="2">Speaking Skill</option><option value="3">Reading Skill</option><option value="4">Writing Skill</option>');
                }else if(this.value==2){
//                      for Hindi skill
                        
                      $('#skill').html('<option value="">Select Skill</option><option value="5">Listening Skill</option><option value="6">Speaking Skill</option><option value="7">Reading Skill</option><option value="8">Writing Skill</option>');
                }else if(this.value==3){
//                      for Marathi skill
                        
                      $('#skill').html('<option value="">Select Skill</option><option value="9">Listening Skill</option><option value="10">Speaking Skill</option><option value="11">Reading Skill</option><option value="12">Writing Skill</option>');
                }else if(this.value==4){
                       $('#skill_option1').html('<option value="">No Levels available</option>');
//                      for Mathematics skill
                        
                      $('#skill').html('<option value="">Select Skill</option><option value="13">Logical Thinking</option><option value="14">Clarity of Concept</option><option value="15">Accuracy in Calculation</option><option value="16">Response</option>');
                }else if(this.value==5){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Science skill
                    $('#skill').html('<option value="">Select Skill</option><option value="17">Participation in activities</option><option value="18">Work Experience</option><option value="19">Group Cohesiveness</option>');
                }else if(this.value==6){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Social Studies skill
                    $('#skill').html('<option value="">Select Skill</option><option value="20">Participation in activities</option><option value="21">Work Experience</option><option value="22">Group Cohesiveness</option>');
                }else if(this.value==7){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                      Social & Emotional skill
                    $('#skill').html('<option value="">Select Skill</option><option value="23">Jests with other</option><option value="24">Is courteous & polite</option><option value="25">Sense Of Responsibilities</option>');
                }else if(this.value==8){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Work Habits skill
                    $('#skill').html('<option value="">Select Skill</option><option value="26">Classwork</option><option value="27">Neatness in work</option><option value="28">Interest in Activities</option>');
                }else if(this.value==9){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Discipline skill
                    $('#skill').html('<option value="">Select Skill</option><option value="29">Uniform</option><option value="30">Cleanliness & Hygiene</option>');
                }else if(this.value==10){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Discipline skill
                    $('#skill').html('<option value="">No skills available</option>');
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="271"/> A+ Mostly maintain books/notebooks properly<br/><input type="radio" name="radio_name" value="272"/> A Many time maintain books/notebooks properly<br/><input type="radio" name="radio_name" value="273"/> B Some time maintain books/notebooks properly<br/><input type="radio" name="radio_name" value="274"/> C Few time maintain books/notebooks properly<br/><input type="radio" name="radio_name" value="275"/> D Needs to maintain books/notebooks properly<br/>');
                }else if(this.value==11){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Art & Craft skill
                    $('#skill').html('<option value="">Select Skill</option><option value="31">Interest</option><option value="32">Creativity & Imagination</option><option value="33">Drawing & Colouring</option>');
                }else if(this.value==12){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Music skill
                    $('#skill').html('<option value="">Select Skill</option><option value="34">Interest</option><option value="35">Remembrance of song</option><option value="36">Singing in Tune</option>');
                }else if(this.value==13){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Games skill
                    $('#skill').html('<option value="">Select Skill</option><option value="37">Interest</option><option value="38">Follows instructions</option><option value="39">Participation</option>');
                }else if(this.value==14){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Moral Values skill
                    $('#skill').html('<option value="">Select Skill</option><option value="40">Attitude towards Teachers</option><option value="41">Attitude towards School</option><option value="42">Attitude towards Surrounding</option>');
                }else if(this.value==15){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for General Knowledge skill
                    $('#skill').html('<option value="">Select Skill</option><option value="43">Interest</option><option value="44">General Awareness</option>');
                }else if(this.value==16){
                    $('#skill_option1').html('<option value="">No Levels available</option>');
//                    for Computer Science skill
                    $('#skill').html('<option value="">Select Skill</option><option value="45">Interest</option><option value="46">Skills</option>');
                }
                
                
            });
            
            $('#grade_1').hide();
            $('#skill_option1').change(function(){
               $('#grade_1').show();
                if(this.value==1){
//                    For English only
                    $('#grade_1').html('<input type="radio" name="radio_name" value="1" name="learning_coml"/> A+ -Mostly Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="2" name="learning_coml"/> A -Many Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="3" name="learning_coml"/> B -Some Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="4" name="learning_coml"/> C -Few Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="5" name="learning_coml"/> D -Need to Demonstrates comprehension of short spoken text by answering question and illustating it<br/>');
                }else if(this.value==2){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="6" name="learning_con"/> A+ Mostly copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="7" name="learning_con"/> A -Many time copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="8" name="learning_con"/> B -Some times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="9" name="learning_con"/> C -Few times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="10" name="learning_con"/> D -Needs to copy words clearly and without errors.<br/>');
                }else if(this.value==3){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="11"/> A+ Mostly uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="12"/> A Many time uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="13"/> B Some times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="14"/> C Few times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="15"/> D Needs to use thematic vocabulary taught in class<br/>');
                }else if(this.value==4){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="16"/> A+ Mostly writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="17"/> A Many time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="18"/> B Some time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="19"/> C Few time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="20"/> D Needs to write simple sentences and is able to organize ideas in a logical sequence<br/>');
                }else if(this.value==5){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="21"/> A+ Mostly repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="22"/> A Many repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="23"/> B Some time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="24"/> C Few time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="25"/> D Needs to repeat simple words and sentences and has good pronunciation<br/>');
                }else if(this.value==6){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="26"/> A+ Mostly shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="27"/> A Many time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="28"/> B Some time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="29"/> C Few time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="30"/> D Needs to show interest in reading strategies<br/>');
                }else if(this.value==7){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="31"/> A+ Mostly articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="32"/> A Many time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="33"/> B Some time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="34"/> C Few time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="35"/> D Needs to be articulate and thoughtful when writing<br/>');
                    
                }else if(this.value==8){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="36"/> A+ Mostly recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="37"/> A Many time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="38"/> B Some time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="39"/> C Few time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="40"/> D Needs to recognize and use appropriate language structures in oral communication activities<br/>');
                }else if(this.value==9){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="41"/> A+ Mostly shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="42"/> A Many time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="43"/> B Some time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="44"/> C Few time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="45"/> D Needs to show good cursive/ handwriting skill<br/>');
                }else if(this.value==10){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="46"/> A+ Mostly shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="47"/> A Many time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="48"/> B Some time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="49"/> C Few time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="50"/> D Needs to show good spelling skill<br/>');
                }else if(this.value==11){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="51"/> A+ Mostly writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="52"/> A Many time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="53"/> B Some time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="54"/> C Few time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="55"/> D Needs to write well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>');
                }else if(this.value==12){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="56"/> A+ Mostly shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="57"/> A Many time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="58"/> B Some time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="59"/> C Few time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="60"/> D Needs to shows creativity in writing<br/>');
                }else if(this.value==13){
//                    For Hindi only
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="61" name="learning_coml"/> A+ -Mostly Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="62" name="learning_coml"/> A -Many Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="63" name="learning_coml"/> B -Some Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="64" name="learning_coml"/> C -Few Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="65" name="learning_coml"/> D -Need to Demonstrates comprehension of short spoken text by answering question and illustating it<br/>');
                }else if(this.value==14){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="66" name="learning_con"/> A+ Mostly copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="67" name="learning_con"/> A -Many time copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="68" name="learning_con"/> B -Some times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="69" name="learning_con"/> C -Few times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="70" name="learning_con"/> D -Needs to copy words clearly and without errors.<br/>');
                }else if(this.value==15){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="71"/> A+ Mostly uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="72"/> A Many time uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="73"/> B Some times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="74"/> C Few times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="75"/> D Needs to use thematic vocabulary taught in class<br/>');
                }else if(this.value==16){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="76"/> A+ Mostly writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="77"/> A Many time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="78"/> B Some time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="79"/> C Few time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="80"/> D Needs to write simple sentences and is able to organize ideas in a logical sequence<br/>');
                }else if(this.value==17){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="81"/> A+ Mostly repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="82"/> A Many repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="83"/> B Some time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="84"/> C Few time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="85"/> D Needs to repeat simple words and sentences and has good pronunciation<br/>');
                }else if(this.value==18){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="86"/> A+ Mostly shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="87"/> A Many time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="88"/> B Some time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="89"/> C Few time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="90"/> D Needs to show interest in reading strategies<br/>');
                }else if(this.value==19){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="91"/> A+ Mostly articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="92"/> A Many time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="93"/> B Some time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="94"/> C Few time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="95"/> D Needs to be articulate and thoughtful when writing<br/>');
                    
                }else if(this.value==20){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="96"/> A+ Mostly recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="97"/> A Many time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="98"/> B Some time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="99"/> C Few time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="100"/> D Needs to recognize and use appropriate language structures in oral communication activities<br/>');
                }else if(this.value==21){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="101"/> A+ Mostly shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="102"/> A Many time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="103"/> B Some time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="104"/> C Few time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="105"/> D Needs to show good cursive/ handwriting skill<br/>');
                }else if(this.value==22){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="106"/> A+ Mostly shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="107"/> A Many time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="108"/> B Some time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="109"/> C Few time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="110"/> D Needs to show good spelling skill<br/>');
                }else if(this.value==23){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="111"/> A+ Mostly writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="112"/> A Many time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="113"/> B Some time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="114"/> C Few time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="115"/> D Needs to write well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>');
                }else if(this.value==24){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="116"/> A+ Mostly shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="117"/> A Many time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="118"/> B Some time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="119"/> C Few time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="120"/> D Needs to shows creativity in writing<br/>');
                }else if(this.value==25){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="121" name="learning_coml"/> A+ -Mostly Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="122" name="learning_coml"/> A -Many Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="123" name="learning_coml"/> B -Some Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="124" name="learning_coml"/> C -Few Times Demonstrates comprehension of short spoken text by answering question and illustating it<br/>\n\
                    <input type="radio" name="radio_name" value="125" name="learning_coml"/> D -Need to Demonstrates comprehension of short spoken text by answering question and illustating it<br/>');
                }else if(this.value==26){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="126" name="learning_con"/> A+ Mostly copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="127" name="learning_con"/> A -Many time copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="128" name="learning_con"/> B -Some times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="129" name="learning_con"/> C -Few times copy words clearly and without errors.<br/>\n\
                    <input type="radio" name="radio_name" value="130" name="learning_con"/> D -Needs to copy words clearly and without errors.<br/>');
                }else if(this.value==27){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="131"/> A+ Mostly uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="132"/> A Many time uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="133"/> B Some times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="134"/> C Few times uses thematic vocabulary taught in class<br/>\n\
                    <input type="radio" name="radio_name" value="135"/> D Needs to use thematic vocabulary taught in class<br/>');
                }else if(this.value==28){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="136"/> A+ Mostly writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="137"/> A Many time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="138"/> B Some time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="139"/> C Few time writes simple sentences and is able to organize ideas in a logical sequence<br/>\n\
                    <input type="radio" name="radio_name" value="140"/> D Needs to write simple sentences and is able to organize ideas in a logical sequence<br/>');
                }else if(this.value==29){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="141"/> A+ Mostly repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="142"/> A Many repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="143"/> B Some time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="144"/> C Few time repeats simple words and sentences and has good pronunciation<br/>\n\
                    <input type="radio" name="radio_name" value="145"/> D Needs to repeat simple words and sentences and has good pronunciation<br/>');
                }else if(this.value==30){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="146"/> A+ Mostly shows interest in reading strategies<br/>\n\
                     <input type="radio" name="radio_name" value="147"/> A Many time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="148"/> B Some time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="149"/> C Few time shows interest in reading strategies<br/>\n\
                    <input type="radio" name="radio_name" value="150"/> D Needs to show interest in reading strategies<br/>');
                }else if(this.value==31){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="151"/> A+ Mostly articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="152"/> A Many time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="153"/> B Some time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="154"/> C Few time articulate and thoughtful when writing<br/>\n\
                    <input type="radio" name="radio_name" value="155"/> D Needs to be articulate and thoughtful when writing<br/>');
                    
                }else if(this.value==32){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="156"/> A+ Mostly recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="157"/> A Many time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="158"/> B Some time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="159"/> C Few time recognizes and uses appropriate language structures in oral communication activities<br/>\n\
                    <input type="radio" name="radio_name" value="160"/> D Needs to recognize and use appropriate language structures in oral communication activities<br/>');
                }else if(this.value==33){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="161"/> A+ Mostly shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" 162"/> A Many time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="163"/> B Some time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="164"/> C Few time shows good cursive/ handwriting skill<br/>\n\
                    <input type="radio" name="radio_name" value="165"/> D Needs to show good cursive/ handwriting skill<br/>');
                }else if(this.value==34){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="166"/> A+ Mostly shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="167"/> A Many time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="168"/> B Some time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="169"/> C Few time shows good spelling skill<br/>\n\
                    <input type="radio" name="radio_name" value="170"/> D Needs to show good spelling skill<br/>');
                }else if(this.value==35){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="171"/> A+ Mostly writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="172"/> A Many time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="173"/> B Some time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="174"/> C Few time writes well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>\n\
                    <input type="radio" name="radio_name" value="175"/> D Needs to write well developed simple sentences using familiar and newly acquired vocabulary and appropriate punctuation<br/>');
                }else if(this.value==36){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="176"/> A+ Mostly shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="177"/> A Many time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="178"/> B Some time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="179"/> C Few time shows creativity in writing<br/>\n\
                    <input type="radio" name="radio_name" value="180"/> D Needs to shows creativity in writing<br/>');
                }
                
             });
               
                $('#skill').change(function(){
                  if(this.value==13){
                    
//                    For Mathematics
                $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="181"/> A+ Mostly shows basic Logical skill in Maths<br/>\n\
                    <input type="radio" name="radio_name" value="182"/> A Many time shows basic Logical skill in Maths<br/>\n\
                    <input type="radio" name="radio_name" value="183"/> B Some time shows basic Logical skill in Maths<br/>\n\
                    <input type="radio" name="radio_name" value="184"/> C Few time shows basic Logical skill in Maths<br/>\n\
                    <input type="radio" name="radio_name" value="185"/> D Needs to show basic Logical skill in Maths<br/>');
                }else if(this.value==14){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="186"/> A+ Mostly shows good attitude towards the math work at this grade level<br/>\n\
                    <input type="radio" name="radio_name" value="187"/> A Many time shows good attitude towards the math work at this grade level<br/>\n\
                    <input type="radio" name="radio_name" value="188"/> B Some time shows good attitude towards the math work at this grade level<br/>\n\
                    <input type="radio" name="radio_name" value="189"/> C Few time shows good attitude towards the math work at this grade level<br/>\n\
                    <input type="radio" name="radio_name" value="190"/> D Needs to show good attitude towards the math work at this grade level<br/>');
                }else if(this.value==15){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="191"/> A+ Mostly does mathematical calculations accurately<br/>\n\
                    <input type="radio" name="radio_name" value="192"/> A Many time does mathematical calculations accurately<br/>\n\
                    <input type="radio" name="radio_name" value="193"/> B Some time does mathematical calculations accurately<br/>\n\
                    <input type="radio" name="radio_name" value="194"/> C Few time does mathematical calculations accurately<br/>\n\
                    <input type="radio" name="radio_name" value="195"/> D Needs to do mathematical calculations accurately<br/>');
                }else if(this.value==16){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="196"/> A+ Mostly response to the teacher\'s question related to topic taught<br/>\n\
                    <input type="radio" name="radio_name" value="197"/> A Many time response to the teacher\'s question related to topic taught<br/>\n\
                    <input type="radio" name="radio_name" value="198"/> B Some time response to the teacher\'s question related to topic taught<br/>\n\
                    <input type="radio" name="radio_name" value="199"/> C Few time response to the teacher\'s question related to topic taught<br/>\n\
                    <input type="radio" name="radio_name" value="200"/> D Needs to response to the teacher\'s question related to topic taught<br/>');
                }
//                For Science
                 else if(this.value==17){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="201"/> A+ Mostly participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="202"/> A Many time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="203"/> B Some time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="204"/> C Few time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="205"/> D Needs to participate in the classroom activities based on EVS<br/>');
                }else if(this.value==18){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="206"/> A+ Mostly Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="207"/> A Many time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="208"/> B Some time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="209"/> C Few time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="210"/> D Needs to Enthusiastic, Competent, Dutiful<br/>');
                }else if(this.value==19){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="211"/> A+ Mostly participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="212"/> A Many time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="213"/> B Some time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="214"/> C Few time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="215"/> D Needs to participate/respond in the group activities<br/>');
                }else if(this.value==20){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="216"/> A+ Mostly participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="217"/> A Many time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="218"/> B Some time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="219"/> C Few time participates in the classroom activities based on EVS<br/>\n\
                    <input type="radio" name="radio_name" value="220"/> D Needs to participate in the classroom activities based on EVS<br/>');
                }else if(this.value==21){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="221"/> A+ Mostly Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="222"/> A Many time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="223"/> B Some time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="224"/> C Few time Enthusiastic, Competent, Dutiful<br/>\n\
                    <input type="radio" name="radio_name" value="225"/> D Needs to Enthusiastic, Competent, Dutiful<br/>');
                }else if(this.value==22){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="226"/> A+ Mostly participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="227"/> A Many time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="228"/> B Some time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="229"/> C Few time participates/responds in the group activities<br/>\n\
                    <input type="radio" name="radio_name" value="230"/> D Needs to participate/respond in the group activities<br/>');
                }else if(this.value==23){
                    $('#grade_1').show(); 
                    $('#grade_1').html('<input type="radio" name="radio_name" value="231"/> A+ Mostly jest with other<br/>\n\
                    <input type="radio" name="radio_name" value="232"/> A Many time jest with other<br/>\n\
                    <input type="radio" name="radio_name" value="233"/> B Some times jest with other<br/>\n\
                    <input type="radio" name="radio_name" value="234"/> C Few times jest with other<br/>\n\
                    <input type="radio" name="radio_name" value="235"/> D Needs to jest with other<br/>');
                }else if(this.value==24){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="236"/> A+ Mostly courteous & polite<br/>\n\
                    <input type="radio" name="radio_name" value="237"/> A Many time courteous & polite<br/>\n\
                    <input type="radio" name="radio_name" value="238"/> B Some times courteous & polite<br/>\n\
                    <input type="radio" name="radio_name" value="239"/> C Few times courteous & polite<br/>\n\
                    <input type="radio" name="radio_name" value="240"/> D Needs to courteous & polite<br/>');
                }else if(this.value==25){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="241"/> A+ Mostly shows sense Of Responsibilities<br/>\n\
                    <input type="radio" name="radio_name" value="242"/> A Many time shows sense Of Responsibilities<br/>\n\
                    <input type="radio" name="radio_name" value="243"/> B Some time shows sense Of Responsibilities<br/>\n\
                    <input type="radio" name="radio_name" value="244"/> C Few time shows sense Of Responsibilities<br/>\n\
                    <input type="radio" name="radio_name" value="245"/> D Needs to show sense Of Responsibilities<br/>');
                }else if(this.value==26){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="246"/> A+ Mostly completes classwork in time<br/>\n\
                    <input type="radio" name="radio_name" value="247"/> A Many time completes classwork in time<br/>\n\
                    <input type="radio" name="radio_name" value="248"/> B Some time completes classwork in time<br/>\n\
                    <input type="radio" name="radio_name" value="249"/> C Few time completes classwork in time<br/>\n\
                    <input type="radio" name="radio_name" value="250"/> D Needs to complete classwork in time<br/>');
                }else if(this.value==27){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="251"/> A+ Mostly shows neatness in work<br/>\n\
                    <input type="radio" name="radio_name" value="252"/> A Many time shows neatness in work<br/>\n\
                    <input type="radio" name="radio_name" value="253"/> B Some time shows neatness in work<br/>\n\
                    <input type="radio" name="radio_name" value="254"/> C Few time shows neatness in work<br/>\n\
                    <input type="radio" name="radio_name" value="255"/> D Needs to show neatness in work<br/>');
                }else if(this.value==28){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="256"/> A+ Mostly shows interest in different activities<br/>\n\
                    <input type="radio" name="radio_name" value="257"/> A Many time shows interest in different activities<br/>\n\
                    <input type="radio" name="radio_name" value="258"/> B Some time shows interest in different activities<br/>\n\
                    <input type="radio" name="radio_name" value="259"/> C Few time shows interest in different activities<br/>\n\
                    <input type="radio" name="radio_name" value="260"/> D Needs to show interest in different activities<br/>');
                }else if(this.value==29){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="261"/> A+ Mostly comes in a proper uniform<br/>\n\
                    <input type="radio" name="radio_name" value="262"/> A Many time comes in a proper uniform<br/>\n\
                    <input type="radio" name="radio_name" value="263"/> B Some time comes in a proper uniform<br/>\n\
                    <input type="radio" name="radio_name" value="264"/> C Few time comes in a proper uniform<br/>\n\
                    <input type="radio" name="radio_name" value="265"/> D Needs to come in a proper uniform<br/>');
                }else if(this.value==30){
                    
                    $('#grade_1').html('<input type="radio" name="radio_name" value="266"/> A+ Mostly shows cleanliness & Hygiene<br/>\n\
                    <input type="radio" name="radio_name" value="267"/> A Many time shows cleanliness & Hygiene<br/>\n\
                    <input type="radio" name="radio_name" value="268"/> B Some time shows cleanliness & Hygiene<br/>\n\
                    <input type="radio" name="radio_name" value="269"/> C Few time shows cleanliness & Hygiene<br/>\n\
                    <input type="radio" name="radio_name" value="270"/> D Needs to show cleanliness & Hygiene<br/>');
                }else if(this.value==31){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="276"/> A+ Mostly shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="277"/> A Many time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="278"/> B Some time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="279"/> C Few time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="280"/> D Needs to show interest during Art & Craft activity.<br/>');
                }else if(this.value==32){
//                    For (2-E) Art & Craft
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="281"/> A+ Mostly shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="282"/> A Many time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="283"/> B Some time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="284"/> C Few time shows interest during Art & Craft activity.<br/>\n\
                    <input type="radio" name="radio_name" value="285"/> D Needs to show interest during Art & Craft activity.<br/>');
                }else if(this.value==33){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="286"/> A+ Mostly shows interest in drawing & select colour combination at his/her own<br/>\n\
                    <input type="radio" name="radio_name" value="287"/> A Many time shows interest in drawing & select colour combination at his/her own.<br/>\n\
                    <input type="radio" name="radio_name" value="288"/> B Some time shows interest in drawing & select colour combination at his/her own<br/>\n\
                    <input type="radio" name="radio_name" value="289"/> C Few time shows interest in drawing & select colour combination at his/her own<br/>\n\
                    <input type="radio" name="radio_name" value="290"/> D Needs to shows interest in drawing & select colour combination at his/her own<br/>');
                }else if(this.value==34){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="291"/> A+ Mostly shows interest in music<br/>\n\
                    <input type="radio" name="radio_name" value="292"/> A Many time shows interest in music<br/>\n\
                    <input type="radio" name="radio_name" value="293"/> B Some time shows interest in music<br/>\n\
                    <input type="radio" name="radio_name" value="294"/> C Few time shows interest in music<br/>\n\
                    <input type="radio" name="radio_name" value="295"/> D Needs to show interest in music<br/>');
                }else if(this.value==35){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="296"/> A+ Mostly tries to remember the song.<br/>\n\
                    <input type="radio" name="radio_name" value="297"/> A Many time tries to remember the song.<br/>\n\
                    <input type="radio" name="radio_name" value="298"/> B Some time tries to remember the song.<br/>\n\
                    <input type="radio" name="radio_name" value="299"/> C Few times tries to remember the song.<br/>\n\
                    <input type="radio" name="radio_name" value="300"/> D Needs to remember the song.<br/>');
                }else if(this.value==36){
                    $('#grade_1').show();

                    $('#grade_1').html('<input type="radio" name="radio_name" value="301"/> A+ Mostly tries to sing in a tune<br/>\n\
                    <input type="radio" name="radio_name" value="302"/> A Many time tries to sing in a tune<br/>\n\
                    <input type="radio" name="radio_name" value="303"/> B Some time tries to sing in a tune<br/>\n\
                    <input type="radio" name="radio_name" value="304"/> C Few time tries to sing in a tune<br/>\n\
                    <input type="radio" name="radio_name" value="305"/> D Needs to sing in a tune<br/>');
                }else if(this.value==37){
                    $('#grade_1').show();

                $('#grade_1').html('<input type="radio" name="radio_name" value="306"/> A+ Mostly shows interest in games<br/>\n\
                    <input type="radio" name="radio_name" value="307"/> A Many time shows interest in games<br/>\n\
                    <input type="radio" name="radio_name" value="308"/> B Some time shows interest in games<br/>\n\
                    <input type="radio" name="radio_name" value="309"/> C Few time shows interest in games<br/>\n\
                    <input type="radio" name="radio_name" value="310"/> D Needs to show interest in games<br/>');
                }else if(this.value==38){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="311"/> A+ Mostly follows the instructions given<br/>\n\
                    <input type="radio" name="radio_name" value="312"/> A Many time follows the instructions given<br/>\n\
                    <input type="radio" name="radio_name" value="313"/> B Some time follows the instructions given<br/>\n\
                    <input type="radio" name="radio_name" value="314"/> C Few time follows the instructions given<br/>\n\
                    <input type="radio" name="radio_name" value="315"/> D Needs to follow the instructions given<br/>');

                }else if(this.value==39){
                    $('#grade_1').show();
                     $('#grade_1').html('<input type="radio" name="radio_name" value="316"/> A+ Mostly participates in Games<br/>\n\
                    <input type="radio" name="radio_name" value="317"/> A Many time participates in Games<br/>\n\
                    <input type="radio" name="radio_name" value="318"/> B Some time participates in Games<br/>\n\
                    <input type="radio" name="radio_name" value="319"/> C Few time participates in Games<br/>\n\
                    <input type="radio" name="radio_name" value="320"/> D Needs to participate in Games<br/>');

                }else if(this.value==40){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="321"/> A+ Mostly courteous, Faithful obedient, Respectful<br/>\n\
                    <input type="radio" name="radio_name" value="322"/> A Many time courteous, Faithful obedient, Respectful<br/>\n\
                    <input type="radio" name="radio_name" value="323"/> B Some time courteous, Faithful obedient, Respectful<br/>\n\
                    <input type="radio" name="radio_name" value="324"/> C Few time courteous, Faithful obedient, Respectful<br/>\n\
                    <input type="radio" name="radio_name" value="325"/> D Needs to courteous, Faithful obedient, Respectful<br/>');
//                    For (2-G) Games

                }else if(this.value==41){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="326"/> A+ Mostly concerned enthusiastic, responsible, co-operative, vibrant.<br/>\n\
                    <input type="radio" name="radio_name" value="327"/> A Many time concerned enthusiastic, responsible, co-operative, vibrant.<br/>\n\
                    <input type="radio" name="radio_name" value="328"/> B Some time concerned enthusiastic, responsible, co-operative, vibrant.<br/>\n\
                    <input type="radio" name="radio_name" value="329"/> C Few time concerned enthusiastic, responsible, co-operative, vibrant.<br/>\n\
                    <input type="radio" name="radio_name" value="330"/> D Needs to concerned enthusiastic, responsible, co-operative, vibrant.<br/>');

                }else if(this.value==42){
                    $('#grade_1').show();
                     $('#grade_1').html('<input type="radio" name="radio_name" value="331"/> A+ Mostly Harmonious, Concerned friendly, Diffusive, caring<br/>\n\
                     <input type="radio" name="radio_name" value="332"/> A Many time Harmonious, Concerned friendly, Diffusive, caring<br/>\n\
                    <input type="radio" name="radio_name" value="333"/> B Some time Harmonious, Concerned friendly, Diffusive, caring<br/>\n\
                    <input type="radio" name="radio_name" value="334"/> C Few time Harmonious, Concerned friendly, Diffusive, caring<br/>\n\
                    <input type="radio" name="radio_name" value="335"/> D Needs to Harmonious, Concerned friendly, Diffusive, caring<br/>');

                }else if(this.value==43){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="336"/> A+ Mostly shows interest to grasp/collect information<br/>\n\
                    <input type="radio" name="radio_name" value="337"/> A Many time shows interest to grasp/collect information<br/>\n\
                    <input type="radio" name="radio_name" value="338"/> B Some time shows interest to grasp/collect information<br/>\n\
                    <input type="radio" name="radio_name" value="339"/> C Few time shows interest to grasp/collect information<br/>\n\
                    <input type="radio" name="radio_name" value="340"/> D Needs to show interest to grasp/collect information<br/>');
//                    For (2-H) Moral Values

                }else if(this.value==44){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="341"/> A+ Mostly shows general awareness/Knowledge<br/>\n\
                    <input type="radio" name="radio_name" value="342"/> A Many time shows general awareness/Knowledge<br/>\n\
                    <input type="radio" name="radio_name" value="343"/> B Some time shows general awareness/Knowledge<br/>\n\
                    <input type="radio" name="radio_name" value="344"/> C Few time shows general awareness/Knowledge<br/>\n\
                    <input type="radio" name="radio_name" value="345"/> D Needs to show general awareness/Knowledge<br/>');

                }else if(this.value==45){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="346"/> A+ Mostly shows interest in computer science<br/>\n\
                    <input type="radio" name="radio_name" value="347"/> A Many time shows interest in computer science<br/>\n\
                    <input type="radio" name="radio_name" value="348"/> B Some time shows interest in computer science<br/>\n\
                    <input type="radio" name="radio_name" value="349"/> C Few time shows interest in computer science<br/>\n\
                    <input type="radio" name="radio_name" value="350"/> D Needs to show interest in computer science<br/>');

                }else if(this.value==46){
                    $('#grade_1').show();
                    $('#grade_1').html('<input type="radio" name="radio_name" value="351"/> A+ Mostly shows creative,designing,writing,multimedia skill in computer<br/>\n\
                    <input type="radio" name="radio_name" value="352"/> A Many time shows creative,designing,writing,multimedia skill in computer<br/>\n\
                    <input type="radio" name="radio_name" value="353"/> B Some time shows creative,designing,writing,multimedia skill in computer<br/>\n\
                    <input type="radio" name="radio_name" value="354"/> C Few time shows creative,designing,writing,multimedia skill in computer<br/>\n\
                    <input type="radio" name="radio_name" value="355"/> D Needs to show creative,designing,writing,multimedia skill in computer<br/>');
                    }
                });
            });
    </script>
<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#d9edf7");
		} 
		
		function saveToDatabase(editableObj,column,id) {
                    
//                    console.log(column);
			$(editableObj).css("background","#0079ac url(loaderIcon.gif) no-repeat right");
                        
                        if(column == 'date' || column == 'subjects')
                        {
                              
                            $(editableObj).css("background","");
                        }
                        
                        else 
                            if($.isNumeric(editableObj.innerHTML) && editableObj.innerHTML.length < 10){
                            
                            $.ajax({
                              
                            url: "saveedit.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("font-size", "14px");
                                    $(editableObj).css("font-weight", "bold");
                                    $(editableObj).css("color", "#ffffff");
                                    $(editableObj).css("background-color", "#0079ac");
                                    
                            }
                                
                           });
                           
                        }
                        else
                        {
                            $(editableObj).css("background","");
                            $(editableObj).text('');
                               
                            editableObj.innerHTML = '';
                            $.ajax({
                            url: "saveedit.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                            }
                                
                           });
                        }
 
		}
                
                        
                        
		</script>
               


<script>
		function showEdit1(editableObj) {
			$(editableObj).css("background","#d9edf7");
		} 
		
		function saveToDatabase1(editableObj,column,id) {
//                    console.log(column);
			$(editableObj).css("background","#0079ac url(loaderIcon.gif) no-repeat right");
                        if(column == 'date' || column == 'subjects')
                        {
                            $(editableObj).css("background","");
                        }
                        else if($.isNumeric(editableObj.innerHTML) && editableObj.innerHTML.length < 4){
                            $.ajax({
                            url: "saveedit1.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("font-size", "14px");
                                    $(editableObj).css("font-weight", "bold");
                                    $(editableObj).css("color", "#ffffff");
                                    $(editableObj).css("background-color", "#0079ac");
                                    
                            }
                                
                           });
                        }
                        else
                        {
                            $(editableObj).css("background","");
                            $(editableObj).text('');
                            
                            editableObj.innerHTML = '';
                            $.ajax({
                            url: "saveedit1.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                            }
                                
                           });
                        }
                            
		}
		</script>
<script>
		function showEdit1(editableObj) {
			$(editableObj).css("background","#d9edf7");
		} 
		
		function saveToDatabase1(editableObj,column,id) {
                    
                        
                    
//                    console.log(column);
			$(editableObj).css("background","#0079ac url(loaderIcon.gif) no-repeat right");
                        if(column == 'date' || column == 'subjects')
                        {
                            $(editableObj).css("background","");
                        }
                        else if($.isNumeric(editableObj.innerHTML) && editableObj.innerHTML.length < 4){
                            $.ajax({
                            url: "saveedit1.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("font-size", "13px");
                                    $(editableObj).css("font-weight", "bold");
                                    $(editableObj).css("color", "#ffffff");
                                    $(editableObj).css("background-color", "#0079ac");
                                    $(editableObj).css("text-align", "center");
                            }
                                
                           });
                        }
                        else
                        {
                            $(editableObj).css("background","");
                            $(editableObj).text('');
                            
                            editableObj.innerHTML = '';
                            $.ajax({
                            url: "saveedit1.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("text-align", "center");
                            }
                                
                           });
                        }
                            
		}
		</script>
<script>
		function showEdit2(editableObj) {
			$(editableObj).css("background","#d9edf7");
		} 
		
		function saveToDatabase2(editableObj,column,id) {
//                    console.log(column);
			$(editableObj).css("background","#0079ac url(loaderIcon.gif) no-repeat right");
                        if(column == 'date' || column == 'subjects')
                        {
                            $(editableObj).css("background","");
                        }
                        else if($.isNumeric(editableObj.innerHTML) && editableObj.innerHTML.length < 4){
                            $.ajax({
                            url: "saveedit2.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("font-size", "13px");
                                    $(editableObj).css("font-weight", "bold");
                                    $(editableObj).css("color", "#ffffff");
                                    $(editableObj).css("background-color", "#0079ac");
                                    $(editableObj).css("text-align", "center");
                                    
                            }
                                
                           });
                        }
                        else
                        {
                            $(editableObj).css("background","");
                            $(editableObj).text('');
                            
                            editableObj.innerHTML = '';
                            $.ajax({
                            url: "saveedit2.php",
                            type: "POST",
                            data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id+'&stu_id='+<?=$prov_id?>,
                            success: function(data){
                                    $(editableObj).css("background","#FDFDFD");
                                    $(editableObj).css("text-align", "center");
                            }
                                
                           });
                        }
                            
		}
                    function myFunction()
                        {
                                $.ajax({
                                url: "saveedit3.php",
                                type: "POST",
                                data:'stu_id='+<?=$prov_id?>,

                               });
                         }
                        
                                   
                                
                    
                                  
		</script>




</body>
</html>