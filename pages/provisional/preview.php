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
<style type="text/css">
<!--
.style1 {
	font-size: large
}
.hindifont {
    font-family: kruti dev;  
    font-size:18px;
}
.hindi li {
   font-size:24px;
   line-height:inherit;
}
#signleft {
	float: left;
	height: 100%;
	width: 50%;
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
.style2 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
.style3 {font-size: x-large;
		text-decoration:underline;}
-->
</style><!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->ProvisionalRegistration &raquo; Preview<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
         <?php
	  	$mode = $_POST['mode'];
	  	$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$fullname=stripslashes($fname." ".$mname." ".$lname);		
		$mother = $_POST['mother'];
		$dob = dateformate($_POST['dob']);
		$contact = $_POST['contact'];
		$p_contact = $_POST['p_contact'];
		$gender = $_POST['gender'];
		$caste_id = $_POST['caste'];
		$religion_id = $_POST['religion'];
		$country_id = $_POST['country'];
		$state_id = $_POST['state'];
		$city_id = $_POST['city'];
		$addr_corespond = $_POST['c_address'];
		$addr_premanent = $_POST['p_address'];
		$course_id = $_POST['course_id'];
		$section_id = $_POST['section_id'];
		$edu_id = $_POST['edu_id'];
		$percent = $_POST['percent'];
		$c_certi = $_POST['c_certi'];
		$d_id= $_POST['duration'];
		$weight= $_POST['weight'];
		$height= $_POST['height'];
		$fixedfees= $_POST['fixedfees'];
		$feespaid= $_POST['feespaid'];
		$duedate= $_POST['duedate'];
		$remark = $_POST['remark'];
		$fileno = $_POST['fileno'];
		//$prov_date = date();
		//document entry

		if(isset($_POST['tenth'])){$tenth = $_POST['tenth'];}else{$tenth='NO';}
		if(isset($_POST['twelth'])){$twelth = $_POST['twelth'];}else{$twelth='NO';}
		if(isset($_POST['diploma'])){$diploma = $_POST['diploma'];}else{$diploma='NO';}
		if(isset($_POST['ug'])){$ug = $_POST['ug'];}else{$ug='NO';}
		if(isset($_POST['pg'])){$pg = $_POST['pg'];}else{$pg='NO';}
		if(isset($_POST['tc'])){$tc = $_POST['tc'];}else{$tc='NO';}
		if(isset($_POST['ncl'])){$ncl = $_POST['ncl'];}else{$ncl='NO';}
		if(isset($_POST['cast'])){$cast = $_POST['cast'];}else{$cast='NO';}
		if(isset($_POST['validity'])){$validity = $_POST['validity'];}else{$validity='NO';}
		if(isset($_POST['national'])){$nationality = $_POST['national'];}else{$nationality='NO';}
		if(isset($_POST['domicile'])){$domicile = $_POST['domicile'];}else{$domicile='NO';}
		if(isset($_POST['income'])){$income = $_POST['income'];}else{$income='NO';}
		if(isset($_POST['gap'])){$gap = $_POST['gap'];}else{$gap='NO';}
		if(isset($_POST['photo'])){$photo = $_POST['photo'];}else{$photo='NO';}
		if(isset($_POST['birth'])){$birth = $_POST['birth'];}else{$birth='NO';}
		if(isset($_POST['medical'])){$medical = $_POST['medical'];}else{$medical='NO';}
		if(isset($_POST['idproof'])){$idproof = $_POST['idproof'];}else{$idproof='NO';}
		if(isset($_POST['other'])){$other_doc = $_POST['other'];}else{$other_doc='NO';}
				
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
									
			 
	   ?>
        <div class="main-wrapper">
        	<h1 align="center">VANDE MATARAM CAREER ACADEMY, AMJANGAON (SURJI) </h1>
          <p align="center" class="style1"><strong>STUDENT  PREVIEW FORM</strong> </p>
          <p>
           
         </p>
        
          <!-- End -->
        <table width="100%" border="0" class="tbl">
          <tr>
            <td width="17%"><strong>Full Name</strong></td>
            <td width="30%">: <?=$fullname?></td>
            <td width="19%"><strong>Mother Name</strong></td>
            <td colspan="2">: <?=$mother?></td>
          </tr>
          <tr>
            <td><strong>DOB</strong></td>
            <td>: <?=$dob?></td>
            <td><strong>Gender</strong></td>
            <td colspan="2">: <?=$gender?></td>
            </tr>
          <tr>
            <td><strong>Contact NO.</strong></td>
            <td>: <?=$contact?></td>
            <td><strong>Country</strong></td>
            <td colspan="2">: <?=$country?></td>
            </tr>
          <tr>
            <td><strong>State</strong></td>
            <td>:
              <?=$state?></td>
            <td><strong>City</strong></td>
            <td colspan="2">:
              <?=$city?></td>
            </tr>
          <tr>
            <td><strong>Religion</strong></td>
            <td>: <?=$religion?></td>
            <td><strong>Caste</strong></td>
            <td colspan="2">: <?=$caste?></td>
            </tr>
          <tr>
            <td><strong>Correspondent Address</strong></td>
            <td align="left" valign="top">: <?=$addr_corespond?></td>
            <td><strong>Permanent Address</strong></td>
            <td colspan="2" align="left" valign="top">: 
              <?=$addr_premanent?></td>
            </tr>
          <tr>
            <td><strong>Total Fees</strong></td>
            <td align="left" valign="top">:
              <?=$fixedfees?></td>
            <td><strong>Fees Paid</strong></td>
            <td colspan="2" align="left" valign="top">:
              <?=$feespaid?> <?php if(($fixedfees-$feespaid)!=0){ echo '(Next fees Due Date is <strong>'.dateformate(date('Y-m-d',strtotime("+15 day"))).'</strong>)';}?></td>
          </tr>
          
          <tr>
            <td><strong>Parent Contact NO.</strong></td>
            <td>:
              <?=$p_contact?></td>
            <td><strong>Course Duation</strong></td>
            <td colspan="2">:
              <?=$duration?> Months</td>
          </tr>
          <tr>
            <td><strong>Qualification</strong></td>
            <td>:
              <?php
			  		$b_cnt=1;
					for($i=0;$i<=count($edu_id)-1;$i++) 
				{
					$query_edu = sprintf("SELECT * FROM stu_edu where edu_id='%d'",$edu_id[$i]);
						if(!($result_edu = $con->query($query_edu)))
						{
							echo "FOR QUERY: $query_edu<BR>".$con->error; 	
							exit;
						}
					$row_edu = $result_edu->fetch_assoc();
					$edu = $row_edu['edu'];
					echo $edu.' ('.$percent[$i].'%),  ';
					$b_cnt++;
				}
			?></td>
            <td colspan="2"><strong>Weight :  </strong><?=$weight?></td>
            <td width="26%"><strong>Height :  </strong><?=$height?></td>
          </tr>
          <tr>
            <td><strong>Selected Course</strong></td>
            <td>:
             <?php
					$b_cnt=1;
					for($i=0;$i<=count($course_id)-1;$i++) 
				{
					$query_course = sprintf("SELECT * FROM stu_course where course_id='%d'",$course_id[$i]);
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
			?>            </td>
            <td><strong>NCC C-Certificate </strong></td>
            <td colspan="2">: 
              <?=$c_certi?></td>
          </tr>
       
            <tr>
              <td rowspan="2"><strong>Documents for 
                <?=$caste?>
              </strong></td>
              <td colspan="7">
              <ul class="halflist">
               <li> 
                 	 <?php if($tenth=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
                 	 <strong>10th</strong> </li>
               <li>
               		 <?php if($twelth=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		 <strong>12th</strong> </li>
                <li>
               		  <?php if($diploma=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?>
           		      <strong>Diploma </strong></li>
                <li>
               		 <?php if($ug=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		 <strong>UG</strong> </li>
                <li>
               		<?php if($pg=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>PG</strong> </li>
                <li>
               		<?php if($tc=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?>
               		Photo :
                    <?=$photo ?>
</li>
                <li>
               		<?php if($nationality=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Nationality</strong> </li>
                <li>
               		<?php if($domicile=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Domicile</strong> </li> 
               <li>
               		<?php if($gap=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Gap Certificate</strong> </li>
                <li>
               		<?php if($birth=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Birth Cirtificate               </strong></li>
                 <li>
               		<?php if($medical=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Medical Cirtificate</strong></li>  
                  <li>
               		<?php if($idproof=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>ID Proof</strong></li>  
                    
                   
                       <li>
                            <?php if($ncl=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
                            <strong>NCL</strong> </li>

              
                <li>
               		<?php if($cast=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Caste</strong> </li>
                <li>
               		<?php if($validity=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Validity</strong> </li>
 
                 <li>
               		<?php if($income=='YES'){?><img src="../../images/correct.png" alt="SUBMITTED"> <?php }else{ ?> <img src="../../images/cross.png" alt="NOT SUBMITTED"> <?php } ?> 
               		<strong>Income</strong> </li>    
            </ul>              </td>
            </tr>
            
            <tr>
            <td align="left" valign="top"><strong>Photo :</strong>
              <?=$photo ?></td>
            <td colspan="4"><strong>Any others Documents : </strong>
              <?=$other_doc ?></td>
            </tr>
            <tr>
              <td align="left" valign="top"><strong>Remark</strong></td>
              <td colspan="5">:
              <?=$remark?></td>
            </tr>
		</table>
        

      
        <p>&nbsp;</p>
        
        <div class="hindifont">
        <ol class="hindi">
        <table width="95%" border="0">
          <tr>
            <td colspan="2"><p align="center" class="style3"><strong>vdWMehps fu;e o vVh</strong></p></td>
            </tr>
          <tr>
            <td width="7%" style="vertical-align:top;" align="center"><li>
             1- 
            </li></td>
            <td width="93%"><li><p align="justify"> vdWMeh esa 'kkarh cukrs gqos] vuq'kklu]  f’k&quot;Vkpkj] uSfrdrk] eku&amp;lUeku rFkk vknj ds lkFk jguk vfuok;Z gSA Nk=  fuokl esa fdlh Hkh izdkj dk xSjorZu Lohdkj ugh agksxkA vxj dksbZ ik;k x;k rks  mls Nk= fuokl ls ckgj djfn;k tk,xkA</p>
              </li>            </td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">2-</div></li></td>
            <td><li><p align="justify"> vdWMeh esa izos’k ysus ds ckn 1 efgus rd Nk=  ckgj vius ?kj ugh tk ldrk 1 efgus ds ckn og tk ldrk gSA ?kj tkus ds ckn og  fu/kkZfjr fnu ds vanj vdWMeh es okil vkuk vfuok;Z gS ugh rks vdWMeh es izos'k  jn~n dj fn;k tk,xkA</p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">3-</div></li></td>
            <td><li><p align="justify"> Nk= fuokl esa fdlh Hkh izdkj dk u'kk&amp;ikuh  djuk iwjh rjg oftZr gSA vxj dksbZ ik;k x;k rks] ekrk&amp;firk dks lqpuk nsdj  nafMr fd;k tk,xk ,oa vdWMeh ls Hkh fudkyk tk ldrk gSA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">4-</div></li></td>
            <td><li><p align="justify"> Nk= fuokl esa jkr 07-00 cts ds ckn  izos'k vekU; gksxkA fdlh ckgjh O;Drh dks fcuk btktr ds Nk= fuokl esa ykus dh  btktr ugha gSA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">5-</div></li></td>
            <td><li><p align="justify"> lkeku] egRoiw.kZ phtsa tSls&amp;iSls]  eksckbZy b- phtks dh ftEesnkjh Nk= dh Loa; dh jgsxhA fdlh Hkh izdkj dk  uqdlku@pksjh gksrh gS rks mlds fy, Nk= Lo;a ftEesnkj jgsaxkA</p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">6-</div></li></td>
            <td><li><p align="justify"> Nk= fuokl esa fdlh izdkj dk xSjorZu]  okn&amp;fookn] yMkbZ&amp;&gt;xMk] jWfxax vknh u djrs gqos 'kkafrfiz; jguk  iM+sxkA vxj dksbZ xSjorZu] okn&amp;fookn] yMkbZ&amp;&gt;xMk]jWfxax vkfn esa  ik;k x;k rks mls vWdsMeh ls tkuk gksxkA</p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">7-</div></li></td>
            <td><li><p align="justify"> Nk= fuokl ds uy] ia[ks] QfuZpj]  fon;wrh; midj.kksa b- phtsa dke u jgrs gqos pkyw ikbZxbZ rks lacaf/kr Nk= ,oa  ml dejsa es jgus okys lHkh Nk=ksa dks naMhr dh; tk,xkA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">8-</div></li></td>
            <td><li><p align="justify"> Nk= fuokl ds uy] ia[ks] QfuZpj]  fon;qrh; midj.kkas] [ksyus ds lk/ku b- phtks dh gkfu tSls&amp;VwV&amp;QwV]  pksjh ;k fQj dksbZ Hkh uqdlku gksrk gS rks mldk vkfFkZd Hkqxrku lacaf/kr Nk=  ,oa ml dejs@gkWy esajgusokys lHkh Nk=ksa dks djuk iM+sxkA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">9-</div></li></td>
            <td><li><p align="justify"> ,d ckj Hkjk gwvk vdWMeh dk 'kqYd  okil ugh agksxkA ukgh fdlh ds uke is LFkkaukrjhr gksxkA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">10-</div></li></td>
            <td><li><p align="justify"> ;nh fdlh Hkh izdkj dh  leL;k&amp;rdzkj Nk= fuokl esa gksrh gS rks] mldh f'kdk;r oans ekrje vWdsMeh ds  eWustesaV es djsA </p></li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">11-</div></li></td>
            <td><li><p align="justify"> lHkh Nk=ksadks oansekrje vWdsMeh ds  eWustesaV dk gj ,d QSlyk ykxw ,oa ca/kudkjd gksxkA </p></li></td>
          </tr>
          <tr>
            <td height="74" style="vertical-align:top;">&nbsp;</td>
            <td><div align="right">
              <p>&nbsp;</p>
              <p><br />
                Mk;jsDVj <br />
                oans ekrje  vdWMeh</p>
            </div></td>
          </tr>
        </table>
        </ol>
        
        
        
        </div>
        <p>&nbsp;</p>
        
          <form action="submit.php" method="post" class="form">
          <input type="hidden" class="input-text" value="<?=$fname?>" id="fname" name="fname" />
          <input type="hidden" class="input-text" value="<?=$mname?>" id="mname" name="mname" />
          <input type="hidden" class="input-text" value="<?=$lname?>" id="lname" name="lname" />
          <input type="hidden" class="input-text" value="<?=$mother?>" id="mother" name="mother" />
          <input type="hidden" class="input-text" value="<?=$dob?>" id="dob" name="dob" />
          <input type="hidden" class="input-text" value="<?=$contact?>" id="contact" name="contact" />
          <input type="hidden" class="input-text" value="<?=$p_contact?>" id="p_contact" name="p_contact" />
          <input type="hidden" class="input-text" value="<?=$gender?>" id="gender" name="gender" />
          <input type="hidden" class="input-text" value="<?=$caste_id?>" id="caste" name="caste" />
          <input type="hidden" class="input-text" value="<?=$religion_id?>" id="religion" name="religion" />
          <input type="hidden" class="input-text" value="<?=$country_id?>" id="country" name="country" />
          <input type="hidden" class="input-text" value="<?=$state_id?>" id="state" name="state" />
          <input type="hidden" class="input-text" value="<?=$city_id?>" id="city" name="city" />
          <input type="hidden" class="input-text" value="<?=$addr_corespond?>" id="c_address" name="c_address" />
          <input type="hidden" class="input-text" value="<?=$addr_premanent?>" id="p_address" name="p_address" />
     <input type="hidden" class="input-text" value="<?php print base64_encode(serialize($course_id)); ?>" id="course_id" name="course_id" />
     <input type="hidden" class="input-text" value="<?=$section_id; ?>" id="section_id" name="section_id" />
          <input type="hidden" class="input-text" value="<?php print base64_encode(serialize($edu_id)); ?>" id="edu_id" name="edu_id" />
          <input type="hidden" class="input-text" value="<?php print base64_encode(serialize($percent)); ?>" id="percent" name="percent" />
          <input type="hidden" class="input-text" value="<?=$c_certi?>" id="c_certi" name="c_certi" />
          <input type="hidden" class="input-text" value="<?=$d_id?>" id="duration" name="duration" />
          <input type="hidden" class="input-text" value="<?=$weight?>" id="weight" name="weight" />
          <input type="hidden" class="input-text" value="<?=$height?>" id="height" name="height" />
          <input type="hidden" class="input-text" value="<?=$fixedfees?>" id="fixedfees" name="fixedfees" />
          <input type="hidden" class="input-text" value="<?=$feespaid?>" id="feespaid" name="feespaid" />
          <input type="hidden" class="input-text" value="<?=$duedate?>" id="duedate" name="duedate" />
          <input type="hidden" class="input-text" value="<?=$remark?>" id="remark" name="remark" />         
            <input type="hidden" class="input-text" value="<?=$fileno?>" id="fileno" name="fileno" />
          <input type="hidden" class="input-text" value="<?=$tenth?>" id="tenth" name="tenth" />
          <input type="hidden" class="input-text" value="<?=$twelth?>" id="twelth" name="twelth" />
          <input type="hidden" class="input-text" value="<?=$diploma?>" id="diploma" name="diploma" />
          <input type="hidden" class="input-text" value="<?=$ug?>" id="ug" name="ug" />
          <input type="hidden" class="input-text" value="<?=$pg?>" id="pg" name="pg" />
          <input type="hidden" class="input-text" value="<?=$tc?>" id="tc" name="tc" />
          <input type="hidden" class="input-text" value="<?=$ncl?>" id="ncl" name="ncl" />
          <input type="hidden" class="input-text" value="<?=$cast?>" id="cast" name="cast" />
          <input type="hidden" class="input-text" value="<?=$validity ?>" id="validity" name="validity" />
          <input type="hidden" class="input-text" value="<?=$nationality ?>" id="national" name="national" />
          <input type="hidden" class="input-text" value="<?=$domicile ?>" id="domicile" name="domicile" />
          <input type="hidden" class="input-text" value="<?=$income ?>" id="income" name="income" />
          <input type="hidden" class="input-text" value="<?=$gap ?>" id="gap" name="gap" />
          <input type="hidden" class="input-text" value="<?=$photo ?>" id="photo" name="photo" />
          <input type="hidden" class="input-text" value="<?=$birth ?>" id="birth" name="birth" />
          <input type="hidden" class="input-text" value="<?=$medical ?>" id="medical" name="medical" />
          <input type="hidden" class="input-text" value="<?=$idproof ?>" id="idproof" name="idproof" />
          <input type="hidden" class="input-text" value="<?=$mode ?>" id="mode" name="mode" />
          <input type="hidden" class="input-text" value="<?=$other_doc ?>" id="other" name="other" />
			        
            <hr />
			<p>&nbsp;</p>
       <h1 align="center">SELF DECLARATION</h1>
            
            <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I <strong><?=$fullname?></strong> 
          declare that i have selected the above mentioned Course for admission and for that i have submitted the above ticked documents and i accept all the terms and conditions given above.</h3>
        <p>&nbsp;</p>
        
          <ul><li> 
              <input name="accept" type="checkbox" size="100" value="true" style="zoom :1.5" required />
              <span class="style2">I Accept All Above Term and Conditions.</span>
          </li>
          </ul>
              <p>&nbsp;</p>
          
 		  <center><input name="input" type="submit" value="Confirm" class="button"/></center>
        </form>
        
        
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
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
