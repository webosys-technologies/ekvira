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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pre-Cadet Admission System</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<style type="text/css" media="print">
@page{
size: auto;
margin: 0;
}
html
{
	background-color: #FFFFFF; 
	margin: 0px;  /* this affects the margin on the html before sending to printer */
}
</style>
<style type="text/css">
<!--
.gap{display:none;}
.hindifont {
    font-family: kruti dev;  
    font-size:18px;
}
.hindi li {
   font-size:18px;
   line-height:inherit;
}
#signleft {
	float: left;
	height: 100%;
	width: 30%;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
#signright {
	float: right;
	height: 100%;
	width: 30%;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-left-width: 0px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
-->
</style>
<style type="text/css">
<!--
.style3 {font-size: x-large;
		text-decoration:underline;}
-->
</style>
<style type="text/css">
<!--
.style4 {font-size: x-large}
-->
</style>
<style>
    .sub-head{
      color: #336699;
      font-size: 14px;
      font-weight: bold;
      font-style: italic;
      text-align: center;
      margin-top: 0px;
}
.logo-result1{
  
   margin-bottom: 50px;
    
}
p{
    //text-align: center;
    font-size: 14px;
    //padding-top: 20px;
}
main_tc_body p{
    text-align: left;
}
.main-wrapper1{
  background-color: #FFFFFF;
  padding: 40px 40px 40px 40px;
  }
  .logo-result1 > h1{
      font-size: 25px !important;
      color: #336699;
      font-weight: bold;
  }
  .sub-div{
      width:30%;
      float: left;
  }
  
  
</style>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../js/sitevalid.js"></script>
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; View Student Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
         <?php
	  
	         $id = $_GET['id'];
			// $mode = $_GET['mode'];
if($id > 0)
{
	$que=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
	if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}

			$clcnt=0;
		
				if($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$mother = $row_prov['mother'];
					$contact = $row_prov['contact'];
					$p_contact =  $row_prov['p_contact'];;
					$dob = dateformate($row_prov['dob']);
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$country_id = $row_prov['country_id'];
					$state_id = $row_prov['state_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$c_certi = $row_prov['c_certi'];
					$d_id = $row_prov['duration_id'];
					$weight = $row_prov['weight'];
					$height = $row_prov['height'];
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					$remark = $row_prov['remark'];
					$fileno = $row_prov['fileno'];
					$photo_url = $row_prov['photo_url'];
					$prov_date = dateformate($row_prov['prov_date']);
					$crr_dt = date('Y-m-d');
					
					$query_caste = sprintf("SELECT * FROM stu_caste WHERE caste_id='%d'", $caste_id);
					if (!($result_caste = $con->query($query_caste))) 
					{ echo "FOR QUERY: $query_caste<BR>".$con->error; 	exit;}
					$row_caste = $result_caste->fetch_assoc();
					$caste = $row_caste['caste'];
					
					$query_religion = sprintf("SELECT * FROM stu_religion WHERE religion_id='%d'", $religion_id);
					if (!($result_religion = $con->query($query_religion))) 
					{ echo "FOR QUERY: $query_religion<BR>".$con->error; 	exit;}
					$row_religion = $result_religion->fetch_assoc();
					$religion = $row_religion['religion'];
					
					$query_city = sprintf("SELECT * FROM city WHERE city_id='%d'", $city_id);
					if (!($result_city = $con->query($query_city))) 
					{ echo "FOR QUERY: $query_city<BR>".$con->error; 	exit;}
					$row_city = $result_city->fetch_assoc();
					$city = $row_city['city_name'];
					
					$query_state = sprintf("SELECT * FROM state WHERE state_id='%d'", $state_id);
					if (!($result_state = $con->query($query_state))) 
					{ echo "FOR QUERY: $query_state<BR>".$con->error; 	exit;}
					$row_state = $result_state->fetch_assoc();
					$state = $row_state['state_name'];
					
					$query_country = sprintf("SELECT * FROM country WHERE country_id='%d'", $country_id);
					if (!($result_country = $con->query($query_country))) 
					{ echo "FOR QUERY: $query_country<BR>".$con->error; 	exit;}
					$row_country = $result_country->fetch_assoc();
					$country = $row_country['country_name'];
					
					$query_d = sprintf("SELECT * FROM stu_duration WHERE d_id='%d'", $d_id);
					if (!($result_d = $con->query($query_d))) 
					{ echo "FOR QUERY: $query_d<BR>".$con->error; 	exit;}
					$row_d = $result_d->fetch_assoc();
					$duration = $row_d['duration'];
					
					$query_study = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d' and stock_id=1 and return_date IS NULL", $id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
					
					$query_phy = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d'and stock_id=2 and return_date IS NULL", $id);
					if (!($result_physical = $con->query($query_phy))) 
					{ echo "FOR QUERY: $query_phy<BR>".$con->error; 	exit;}
					$rowCount2 = $con->affected_rows;
                                        
					$prov_id ='';
                                        $query_prov_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $prov_id);
                                        $result_prov_doc = $con->query($query_prov_doc);
                                        $row_prov_doc=$result_prov_doc->fetch_assoc();
                                        $course_id = $row_prov['course_id'];
                                        $section_id = $row_prov['section_id'];
				}					

	   ?>
        
        <div class="main-wrapper">
            <div style="border-style: double;background-color: #FEF9E7;">
                    <div style="margin-top:20px;">
                        <div class="logo-result" style="padding-right: 0px;">
                            <img src="../../images/only-logo1.png" alt="Logo" />
                        </div>
                        <div class="logo-result1" style="padding-right:120px;">    
                            <h1><em>Ekvira School Of Brilliants Group</em></h1><h3 class="sub-head">WEBS-www.esob.co.in;email: ekvira_school@rediffmail.com;<br> chavhan_tushar@yahoo.com; helpdesk@esob.co.in;<br>Tel:91-8550991135,91-07228-222025</h3>
                        </div>
                    </div>
                    <div class="logo-result1">
                        <h1><u>TRANSFER CERTIFICATE</u></h1>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="font-weight:bold;">
                                <div class="col-md-4"> 
                                    Book No:&nbsp;<span style="border-bottom:1px solid black;"></span>
                                </div> 
                                <div class="col-md-4">Sr.No:<span style="border-bottom:1px solid black;"></span></div> 
                                <div class="col-md-4">Admission No:<span style="border-bottom:1px solid black;"></span></div> 
                            </div>
                          </div>
                    </div>
                    <div class="container" style="margin-top:40px;">
                        <div class="row">
                                <div class="col-md-12 main_tc_body">
                                <p><b>Name Of Student:</b>&nbsp;&nbsp;<?=$fullname?></p>
                                <p><b>Father's Name:</b>&nbsp;&nbsp;<?=$row_prov['mname']?>&nbsp;<?=$row_prov['lname']?></p>
                                <p><b>Mother's Name:</b>&nbsp;&nbsp;<?=$mother?></p>
                                <p><b>Nationality:</b>&nbsp;&nbsp;</p>
                                <p><b>Whether the candidate belongs to Schedule Caste or Schedule Tribe:</b>&nbsp;&nbsp;<?=$caste?></p>
                                <p><b>Date of first admission in the school with class:</b>&nbsp;&nbsp;</p>
                                <p><b>Date of Birth according to Admission Register:</b>&nbsp;&nbsp;<?=$dob?></p>
                                <p><b>Class in Which the pupil last studied in:</b>&nbsp;&nbsp;<?=$course_id?></p>
                                <p><b>School/Board Annual Examination last taken with result:</b>&nbsp;&nbsp;</p>
                                <p><b>Whether failed, if so once/twice in the same class: </b>&nbsp;&nbsp;</p>
                                <p><b>Subject's Studied:</b>&nbsp;&nbsp;</p>
                                <p><b>Whether qualified for promotion to the higher class:</b>&nbsp;&nbsp;</p>
                                <p><b>if so,to which class(if figures):</b>&nbsp;&nbsp;</p>
                                <p><b>Month up to which the pupil has paid school dues:</b>&nbsp;&nbsp;</p>
                                <p><b>Any fee concession availed of if so,the nature of such concession:</b>&nbsp;&nbsp;</p>
                                <p><b>Total No.of working days:</b>&nbsp;&nbsp;</p>
                                <p><b>Total No.of working days present:</b>&nbsp;&nbsp;</p>
                                <p><b>Whether NCC Cadet/Boy Scout/Girl Guide(details may be given):</b>&nbsp;&nbsp;</p>
                                <p><b>Games played or extra curricular activities in which the pupil usually took part:<br>(mention achievement level therein):</b>&nbsp;&nbsp;</p>
                                <p><b>General Conduct:</b>&nbsp;&nbsp;</p>
                                <p><b>Date of Application for Certificate:</b>&nbsp;&nbsp;</p>
                                <p><b>Date of issue of Certificate:</b>&nbsp;&nbsp;<?=$crr_dt?></p>
                                <p><b>Reasons of leaving the schools:</b>&nbsp;&nbsp;</p>
                                <p><b>Any other Remarks:</b>&nbsp;&nbsp;</p>
                                </div>
                                
                            </div>
                          </div>
                            <div class="container" style="margin-top:40px;margin-bottom:40px;">
                                    <div class="row">
                                        <div class="col-md-12" style="font-weight:bold;">
                                            <div class="col-md-4">Class Teacher<br>Signature</div> 
                                            <div class="col-md-5">Check by<br>(Name & Designation)</div> 
                                            <div class="col-md-3">Principal <br>Office Seal</div> 
                                        </div>
                                      </div>
                                </div>


                    </div>
                    
            </div>
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print & PDF</a></div>
        </div>
        
        <!-- InstanceEndEditable -->
      </div>
    </div>

</div>
<!-- Main Body End -->


<div class="footer">
	<div class="wrapper">
    	  	<div class="fflt">Copyright &copy; 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
</html>
<?php
}
?>