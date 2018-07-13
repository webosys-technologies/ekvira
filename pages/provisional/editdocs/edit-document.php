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

<script type="text/javascript" src="../../../js/admission.js"></script>
<link href="../../../js/jquery.datepick.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../../js/jquery.plugin.js"></script>
<script src="../../../js/jquery.datepick.js"></script>
<script>
$(function() {
	$('#popupDatepicker').datepick();
	
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script><!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; change Document Details<!-- InstanceEndEditable --></strong></p>
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
					//food = encodeURIComponent(document.getElementById("userInput").value);
					var id = id;
					var photo = prompt("Please enter Photo Count");
					xmlHttp.open("GET", "edit-photo.php?photo=" +photo+ "&id=" +id, true);
					xmlHttp.onreadystatechange = handleServerResponse;
					xmlHttp.send(null);
				}//else{
					//setTimeout('process()',500);
				//}	
			}
			
			function handleServerResponse(){
				if(xmlHttp.readyState==4){
					if(xmlHttp.status==200){
						xmlResponse = xmlHttp.responseXML;
						xmlDocumentElement = xmlResponse.documentElement;
						message = xmlDocumentElement.firstChild.data;
						document.getElementById("photoview").innerHTML =  message  ;
							//setTimeout('process()',500);
					}else{
						alert('somthing went wrong !');
					}
				}
			}
			
			</script>
            
            
        <?php
		if(isset($_GET['flag'])){
		   $flag = $_REQUEST['flag'];
		   $doctype = $_REQUEST['doctype'];
		 if($flag=="docedit"){?>
		<p align="center"><font color='red'><B>Document of <?=$doctype ?> is edited Successfully.</B></font></p>
		<? } } ?>	

<?php
	  
	         $id = $_REQUEST['id'];
if($id > 0)
{
	$que=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
	if(!($page_res=$con->query($que))){ echo $que.mysql_error(); exit;}

		
		
				$clcnt=0;
		
				if($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$mother = $row_prov['mother'];
					$contact = $row_prov['contact'];
					$dob = dateformate($row_prov['dob']);
					$gender = $row_prov['gender'];
					$d_id = $row_prov['duration_id'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$country_id = $row_prov['country_id'];
					$state_id = $row_prov['state_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$remark = $row_prov['remark'];
					$fileno = $row_prov['fileno'];
					$prov_date = dateformate($row_prov['prov_date']);
					
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					
					$query_caste = sprintf("SELECT * FROM stu_caste WHERE caste_id='%d'", $caste_id);
					if (!($result_caste = $con->query($query_caste))) 
					{ echo "FOR QUERY: $query_caste<BR>".mysql_error(); 	exit;}
					if($row_caste = $result_caste->fetch_assoc()){
					$caste = $row_caste['caste'];}
					
					$query_religion = sprintf("SELECT * FROM stu_religion WHERE religion_id='%d'", $religion_id);
					if (!($result_religion = $con->query($query_religion))) 
					{ echo "FOR QUERY: $query_religion<BR>".mysql_error(); 	exit;}
					if($row_religion = $result_religion->fetch_assoc()){
					$religion = $row_religion['religion'];}
				
					
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
	}					
			 
	   ?>
        <p align="right" class="back-to-index"><a href="index.php?flag=non" class="button">Back To Index</a></p>
        <div class="main-wrapper">
        <!-- Start Here -->
       <div style="width:50%; float:left;">
       	 <P align="left"><strong>Admission ID</strong> : <?php echo date('Ym').$id;?><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; FileNo.:-</strong>
       	 <?=$fileno?></P>
       </div>
       <div style="width:50%; float:right;">
       	 <P align="right"><strong>Admission Date</strong> : <?=$prov_date?></P> 
       </div>
        <!-- End -->
        <table width="100%" border="0" class="tbl">
         
            <?php
			$query_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $id);
					if (!($result_doc = $con->query($query_doc))) 
					{ echo "FOR QUERY: $query_doc<BR>".mysql_error(); 	exit;}
					if($row_doc = $result_doc->fetch_assoc()){
					//$row_doc = mysql_fetch_array($result_doc);
					
					$tenth = $row_doc['tenth'];
					$twelth = $row_doc['twelth'];
					$diploma = $row_doc['diploma'];
					$ug = $row_doc['ug'];
					$pg = $row_doc['pg'];
					$tc = $row_doc['tc'];
					$ncl = $row_doc['ncl'];
					$cast = $row_doc['cast'];
					$validity = $row_doc['validity'];
					$nationality = $row_doc['nationality'];
					$domicile = $row_doc['domicile'];
					$gap = $row_doc['gap'];
					$photo = $row_doc['photo'];
					$birth = $row_doc['birth'];
					$medical = $row_doc['medical'];
					$idproof = $row_doc['id_proof'];
					$income = $row_doc['income'];
					$idproof = $row_doc['id_proof'];
					$other = $row_doc['other'];
					
			?>
            
            <tr>
              <td rowspan="2"><strong>Documents for 
                <?=$caste?>
              </strong></td>
              <td colspan="5">
              <ul class="halflist">
              
               
                <li>
                <a href="edit.php?doc=tenth&amp;value=<?=$tenth?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		 <?php if($tenth=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		 <strong>10th</strong> </a> </li>
                
                <li>
                <a href="edit.php?doc=twelth&amp;value=<?=$twelth?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($twelth=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>12th</strong> </a> </li>
                <li>
                <a href="edit.php?doc=diploma&amp;value=<?=$diploma?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		 <?php if($diploma=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		 <strong>Diploma</strong> </a> </li>
                 
                 <li>
                <a href="edit.php?doc=ug&amp;value=<?=$ug?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($ug=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>UG</strong> </a> </li>
                <li>
                <a href="edit.php?doc=pg&amp;value=<?=$pg?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		 <?php if($pg=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		 <strong>pg</strong> </a> </li>
                     
                <li>
                <a href="edit.php?doc=tc&amp;value=<?=$tc?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($tc=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?>
               		<strong> TC </strong> </a>				</li>

                <li>
                 <a href="edit.php?doc=nationality&amp;value=<?=$nationality?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($nationality=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Nationality</strong> </a></li>
                <li>
                <a href="edit.php?doc=domicile&amp;value=<?=$domicile?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($domicile=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Domicile</strong> </a> </li> 
               <li>
               <a href="edit.php?doc=gap&amp;value=<?=$gap?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($gap=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Gap Certificate</strong> </a> </li>
                <li>
                <a href="edit.php?doc=birth&amp;value=<?=$birth?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($birth=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Birth Cirtificate </strong> </a></li>
                    
                    
       
                       <li>
                       <a href="edit.php?doc=ncl&amp;value=<?=$ncl?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
                            <?php if($ncl=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
                            <strong>NCL</strong> </a> </li>
    
                <li>
                <a href="edit.php?doc=cast&amp;value=<?=$cast?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($cast=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Caste</strong> </a> </li>
                <li>
                <a href="edit.php?doc=validity&amp;value=<?=$validity?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($validity=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Validity</strong> </a> </li>
                
              	<li>
                <a href="edit.php?doc=medical&amp;value=<?=$medical?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($medical=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Medical Certi.</strong> </a> </li>
                <li>
                <a href="edit.php?doc=id_proof&amp;value=<?=$idproof?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($idproof=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>ID Proof</strong> </a> </li>
                 <li>
                 <a href="edit.php?doc=income&amp;value=<?=$income?>&amp;id=<?=$id?>" onClick="if(confirm('Do you really want to Edit this document?')){return true;}else{return false;}">
               		<?php if($income=='YES'){?><img src="../../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Income</strong> </a> </li>    
            </ul> </td>
            </tr>
           <tr>
            <td align="left" valign="top"> 
              <div ><strong>Photo :</strong> <a onclick="process(<?=$id?>);"><div style="width:80%; float:right; text-align:left;" id="photoview"> <?=$photo ?> (Click to edit photo count)</div></a></div> </td>
            <td colspan="2"><strong>Any others Documents : </strong>
              <?=$other ?></td>
            </tr>
            <?php }?>
             <tr>
            <td width="17%"><strong>Full Name</strong></td>
            <td width="38%">: <?=$fullname?></td>
            <td width="16%"><strong>Mother Name</strong></td>
            <td width="29%">: <?=$mother?></td>
            </tr>
          <tr>
            <td><strong>DOB</strong></td>
            <td>: <?=$dob?></td>
            <td><strong>Gender</strong></td>
            <td>: <?=$gender?></td>
            </tr>
            <tr>
            	<td><strong>Qualification</strong></td>
            <td align="left" valign="top">:
              <?php
					$query_prov_edu = sprintf("SELECT * FROM stu_prov_edu WHERE prov_id='%d'", $id);
					if (!($result_prov_edu = $con->query($query_prov_edu))) 
					{ echo "FOR QUERY: $query_prov_edu<BR>".$con->error; 	exit;}

					$b_cnt=1;
					while($row_prov_edu=$result_prov_edu->fetch_assoc())
				{
					$edu_id = $row_prov_edu['edu_id'];
					$percent = $row_prov_edu['percent'];
					
					$query_edu = sprintf("SELECT * FROM stu_edu where edu_id='%d'",$edu_id);
						if(!($result_edu = $con->query($query_edu)))
						{
							echo "FOR QUERY: $query_edu<BR>".$con->error; 	
							exit;
						}
					$row_edu = $result_edu->fetch_assoc();
					$edu = $row_edu['edu'];
					echo $edu.' ('.$percent.'%),  ';
					$b_cnt++;
				}
			?></td>
            <td><strong>Course Duation</strong></td>
            <td>:
              <?=$duration?>
              Months</td>
            </tr>
          <tr>
            <td><strong>Conatact NO.</strong></td>
            <td>: <?=$contact?></td>
            <td><strong>Country</strong></td>
            <td>: <?=$country?></td>
            </tr>
          <tr>
            <td><strong>City</strong></td>
            <td>:
              <?=$city?></td>
            <td><strong>State</strong></td>
            <td>:
              <?=$state?></td>
            </tr>
          <tr>
            <td><strong>Religion</strong></td>
            <td>: <?=$religion?></td>
            <td><strong>Caste</strong></td>
            <td>: <?=$caste?></td>
            </tr>
          
          <tr>
            <td><strong>Courses Options</strong></td>
            <td colspan="5">:
           <?php
					$query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $id);
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
			?>             </td>
            </tr>
		</table>
        
        <?php }?>
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
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
