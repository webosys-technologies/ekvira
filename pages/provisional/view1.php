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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; View Student Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
         <?php
	  
	         $id = $_GET['id'];
			 $mode = $_GET['mode'];
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
					
				}					
			 
	   ?>
        
        <div class="main-wrapper">
        <h1 align="center">VANDE MATARAM CAREER ACADEMY </h1>
			<h2 align="center">ATHARV NAGAR, DARYAPUR ROAD, AnJANGAON (SURJI), DIST. AMRAVATI <br />STUDENT POVISIONAL REGISTRATION DETAILS</h2>
        
        <?php 
		if($mode=='new')
		{
		?>  
		<p align="right" class="back-to-index"><a href="index.php?flag=non" class="button">Back To Index</a></p>
        <?php }else { ?>
        <p align="right" class="back-to-index"><a href="../uploadimg/index.php?flag=non" class="button">Back To Index</a></p>
        <?php } ?>
          
<div class="flag-msg">
				 <?php if($flag=$_REQUEST['flag']){
                    $flag=$_REQUEST['flag'];
                 } 
				if($flag=="not_img"){ ?>
                <p align="center"><font color='red'><b>**************File is not an image.**************</b></font></p>
                <? } ?>	
                <? if($flag=="too_large"){?>
                <p align="center"><font color='red'><b>**************Sorry, your file is too large.**************</b></font></p>
                <? } ?>	
                <? if($flag=="non_img"){?>
                <p align="center"><font color='red'><b>**************Sorry, only JPG, JPEG, PNG &amp; GIF files are allowed.**************</b></font></p>
                <? } ?>	
                <? if($flag=="error"){?>
                <p align="center"><font color='red'><b>**************Sorry, there was an error uploading your file.**************</b></font></p>
                <? } ?>
     </div>
     	<div style="width:40%; float:left;">
       	 <p align="left"><strong>Student ID</strong> : <?php echo getstuid($row_prov['prov_date']).$id;?><strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; FileNo.:-</strong>
       	 <?=$fileno?>
       	 </p> 
       </div>
         <div style="width:50%; float:right;">
       	 <p align="right"><strong>Admission Date</strong> : <?=$prov_date?> &nbsp; &nbsp; </p> 
       </div>
        <!-- End -->
        <table width="98%" border="0" class="tbl">
          <tr>
            <td width="18%"><strong>Full Name</strong></td>
            <td width="23%"  style="text-transform:uppercase;">: <?=$fullname?></td>
            <td width="17%"><strong>Mother Name</strong></td>
            <td width="21%">: <?=$mother?></td>
            <td width="21%" rowspan="8"><div align="center"><?php if($photo_url==''){ ?>
              <p align="right" class="back-to-index"><a href="webcam/index.php?id=<?=$id?>&flag=non&mode=<?=$mode?>" class="button">Click To Upload Photo</a></p>
            
            <?php }else{?><img align="right" src="upload/<?=$photo_url?>" alt="" name="goat_img" width="160" height="180" id="goat_img" /><?php }?></div></td>
          </tr>
          <tr>
            <td><strong>DOB</strong></td>
            <td>: <?=$dob?></td>
            <td><strong>Gender</strong></td>
            <td>: <?=$gender?></td>
            </tr>
          <tr>
            <td><strong>Contact NO.</strong></td>
            <td>: <?=$contact?></td>
            <td><strong>Country</strong></td>
            <td>:
              <?=$country?></td>
            </tr>
          <tr>
            <td><strong>State</strong></td>
            <td>:
              <?=$state?></td>
            <td><strong>City</strong></td>
            <td>:
              <?=$city?></td>
          </tr>
          <tr>
            <td><strong>Religion</strong></td>
            <td>: <?=$religion?></td>
            <td><strong>Caste</strong></td>
            <td>: <?=$caste?></td>
            </tr>
          <tr>
            <td height="32"><strong>Corresp. Address</strong></td>
            <td align="left" valign="top">: <?=$addr_corespond?></td>
            <td><strong>Permanent Address</strong></td>
            <td align="left" valign="top">: 
              <?=$addr_premanent?></td>
            </tr>
          <tr>
            <td><strong>Fixed Fees</strong></td>
            <td align="left" valign="top">:
              <?=$fixedfees?></td>
            <td><strong>Fees Paid</strong></td>
            <td align="left" valign="top">:
              <?=$feespaid?></td>
            </tr>
          
          <tr>
            <td><strong>Parent Contact NO.</strong></td>
            <td>:
              <?=$p_contact?></td>
            <td><strong>Course Duation</strong></td>
            <td>:
              <?=$duration?>    Months</td>
            </tr>
          <tr>
            <td height="33"><strong>Qualification</strong></td>
            <td colspan="3">:
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
            <td width="21%">&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Selected Course</strong></td>
            <td>:
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
			?>            </td>
            <td><strong>Store Item</strong></td>
            <td colspan="2">:
             <?php 
			  		if($rowCount1>0)
					{
					$i=0;
					echo '<strong>Study-</strong>';
						while($row_item = $result_study->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$study_item_id = $row_item['item_id'];
							if($stock_id='1'){
								$i++;
								
									$que_study="SELECT * FROM stu_study_stock where id=$study_item_id"; 
									if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_item_name=$item_res->fetch_assoc()){
										echo $i.'.'.$row_item_name['item_name'].' ';
									}
							}
						
						}
					//echo '<br />';
					}
			  ?> 
              
              <?php 
			  		if($rowCount2>0)
					{
					$i=0;
					echo '<strong>Physical-</strong>';
						while($row_item = $result_physical->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$phy_item_id = $row_item['item_id'];
							if($stock_id='2'){
								$i++;
								
									$que_study="SELECT * FROM stu_physical_stock where id=$phy_item_id"; 
									if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_item_name=$item_res->fetch_assoc()){
										echo $i.'.'.$row_item_name['item_name'].' ';
									}
							}
						
						}
					}
			  ?>          </td>
            </tr>
            <?php
			$query_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $id);
					if (!($result_doc = $con->query($query_doc))) 
					{ echo "FOR QUERY: $query_doc<BR>".$con->error; 	exit;}
					
				if($row_doc=$result_doc->fetch_assoc()){
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
					$income = $row_doc['income'];
					$medical = $row_doc['medical'];
					$idproof = $row_doc['id_proof'];
					$other = $row_doc['other'];
				}
					
			
			?>
            
            <tr>
              <td rowspan="2"><strong>Documents for 
                <?=$caste?>
              </strong></td>
              <td colspan="6">
              <ul class="halflist">
              <?php if($tenth=='YES'){?>
               <li> 
                 	 <img src="../../images/correct.png" alt="SUBMITTED" />  
                 	 <strong>10th</strong>  </li>
               <?php } ?>
               <?php if($twelth=='YES'){?>
               <li>
               		 <img src="../../images/correct.png" alt="SUBMITTED" />  
               		 <strong>12th</strong>  </li>
               <?php } ?>
               <?php if($diploma=='YES'){?>
                <li>
               		  <img src="../../images/correct.png" alt="SUBMITTED" /> 
           		      <strong>Diploma </strong>                </li>
                <?php } ?>
                <?php if($ug=='YES'){?>
                <li>
               		 <img src="../../images/correct.png" alt="SUBMITTED" />  
               		 <strong>UG</strong> </li>
                 <?php } ?>
                 <?php if($pg=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>PG</strong>                </li>
                <?php } ?>
                <?php if($tc=='YES'){?>
                <li>
               		 <img src="../../images/correct.png" alt="SUBMITTED" /> 
               		<strong>Nationality</strong>
				</li>
                <?php } ?>
                <?php if($nationality=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>Nationality</strong>                </li>
                <?php } ?>
                <?php if($domicile=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>Domicile</strong>               </li> 
               <?php } ?>
               <?php if($gap=='YES'){?>
               <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" /> 
               		<strong>Gap Certificate</strong>               </li>
               <?php } ?>
               <?php if($birth=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>Birth Cirtificate</strong>                </li>
                <?php } ?>
                <?php if($idproof=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>ID-Proof</strong>                </li>
                <?php } ?>
                <?php if($medical=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>Medical Cirtifi.</strong>                </li>
                <?php } ?>

                    <?php if($ncl=='YES'){?>
                       <li> <img src="../../images/correct.png" alt="SUBMITTED" /> 
                            <strong>NCL</strong>                       </li>
                       <?php } ?>
   
              <?php if($cast=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" /> 
               		<strong>Caste</strong>                </li>
              <?php } ?>
              <?php if($validity=='YES'){?>
                <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" />  
               		<strong>Validity</strong>                </li>
                <?php } ?>
                <?php if($income=='YES'){?>
                 <li>
               		<img src="../../images/correct.png" alt="SUBMITTED" /> 
               		<strong>Income</strong>                 </li>    
                <?php } ?>
            </ul>           	  </td>
            </tr>
            
            <tr>
            <td align="left" valign="top"><strong>Photo :</strong>
              <?=$photo ?></td>
            <td colspan="2"><strong>Any others Documents : </strong>
              <?=$other ?></td>
            <td><strong>NCC C-Certificate :- </strong>
              <?=$c_certi?></td>
            </tr>
            <tr>
              <td align="left" valign="top"><strong>Remark</strong></td>
              <td colspan="2">:
              <?=$remark?></td>
              <td><strong>Weight : </strong>
                <?=$weight ?></td>
              <td><strong>Height : </strong>
                <?=$height ?></td>
            </tr>
		</table>
<?php }?>
          
<--        <div class="hindifont">
        <ol class="hindi">
        <table width="98%" border="0">
          <tr>
            <td colspan="2"><p align="center" class="style3"><strong>vdWMehps fu;e o vVh</strong></p></td>
            </tr>
          <tr>
            <td width="4%" style="vertical-align:top;" align="center"><li>
             1- 
            </li></td>
            <td width="96%" align="justify"><li> vdWMeh esa 'kkarh cukrs gqos] vuq'kklu]  f’k&quot;Vkpkj] uSfrdrk] eku&amp;lUeku rFkk vknj ds lkFk jguk vfuok;Z gSA Nk=  fuokl esa fdlh Hkh izdkj dk xSjorZu Lohdkj ugh agksxkA vxj dksbZ ik;k x;k rks  mls Nk= fuokl ls ckgj djfn;k tk,xkA
              </li>            </td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">2-</div></li></td>
            <td align="justify"><li> vdWMeh esa izos’k ysus ds ckn 1 efgus rd Nk=  ckgj vius ?kj ugh tk ldrk 1 efgus ds ckn og tk ldrk gSA ?kj tkus ds ckn og  fu/kkZfjr fnu ds vanj vdWMeh es okil vkuk vfuok;Z gS ugh rks vdWMeh es izos'k  jn~n dj fn;k tk,xkA</li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">3-</div></li></td>
            <td align="justify"><li> Nk= fuokl esa fdlh Hkh izdkj dk u'kk&amp;ikuh  djuk iwjh rjg oftZr gSA vxj dksbZ ik;k x;k rks] ekrk&amp;firk dks lqpuk nsdj  nafMr fd;k tk,xk ,oa vdWMeh ls Hkh fudkyk tk ldrk gSA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">4-</div></li></td>
            <td align="justify"><li> Nk= fuokl esa jkr 07-00 cts ds ckn  izos'k vekU; gksxkA fdlh ckgjh O;Drh dks fcuk btktr ds Nk= fuokl esa ykus dh  btktr ugha gSA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">5-</div></li></td>
            <td align="justify"><li> lkeku] egRoiw.kZ phtsa tSls&amp;iSls]  eksckbZy b- phtks dh ftEesnkjh Nk= dh Loa; dh jgsxhA fdlh Hkh izdkj dk  uqdlku@pksjh gksrh gS rks mlds fy, Nk= Lo;a ftEesnkj jgsaxkA</li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">6-</div></li></td>
            <td align="justify"><li> Nk= fuokl esa fdlh izdkj dk xSjorZu]  okn&amp;fookn] yMkbZ&amp;&gt;xMk] jWfxax vknh u djrs gqos 'kkafrfiz; jguk  iM+sxkA vxj dksbZ xSjorZu] okn&amp;fookn] yMkbZ&amp;&gt;xMk]jWfxax vkfn esa  ik;k x;k rks mls vWdsMeh ls tkuk gksxkA</li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">7-</div></li></td>
            <td align="justify"><li> Nk= fuokl ds uy] ia[ks] QfuZpj]  fon;wrh; midj.kksa b- phtsa dke u jgrs gqos pkyw ikbZxbZ rks lacaf/kr Nk= ,oa  ml dejsa es jgus okys lHkh Nk=ksa dks naMhr dh; tk,xkA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">8-</div></li></td>
            <td align="justify"><li> Nk= fuokl ds uy] ia[ks] QfuZpj]  fon;qrh; midj.kkas] [ksyus ds lk/ku b- phtks dh gkfu tSls&amp;VwV&amp;QwV]  pksjh ;k fQj dksbZ Hkh uqdlku gksrk gS rks mldk vkfFkZd Hkqxrku lacaf/kr Nk=  ,oa ml dejs@gkWy esa jgusokys lHkh Nk=ksa dks djuk iM+sxkA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">9-</div></li></td>
            <td align="justify"><li> ,d ckj Hkjk gwvk vdWMeh dk 'kqYd  okil ugh agksxkA ukgh fdlh ds uke is LFkkaukrjhr gksxkA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">10-</div></li></td>
            <td align="justify"><li> ;nh fdlh Hkh izdkj dh  leL;k&amp;rdzkj Nk= fuokl esa gksrh gS rks] mldh f'kdk;r oans ekrje vWdsMeh ds  eWustesaV es djsA </li></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><li><div align="center">11-</div></li></td>
            <td align="justify"><li> lHkh Nk=ksadks oansekrje vWdsMeh ds  eWustesaV dk gj ,d QSlyk ykxw ,oa ca/kudkjd gksxkA </li></td>
          </tr>
          <tr>
            <td height="50" style="vertical-align:top;">&nbsp;</td>
            <td align="right">
                Mk;jsDVj <br />
                oans ekrje  vdWMeh
              </td>
          </tr>
        </table>
        </ol>
        </div> -->
        <hr />
			
       <h1 align="center">SELF DECLARATION</h1>
            
            <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I <strong><?=$fullname?></strong> 
          declare that i have selected the above mentioned Course for admission and for that i have submitted the above ticked documents and i accept all the terms and conditions given above.</h4>
        <p>&nbsp;</p>
        <div class="sign" id="sign">
          <div class="signleft" id="signleft">
            <div align="center"><strong>Signature of Gaurdian / Parents</strong></div>
          </div>
          <input type="button" onclick="window.print();" class="button" value="Print"  />
          &nbsp; &nbsp; &nbsp;
          <strong>Authority Signature</strong>
          <div class="signright" id="signright">
            <div align="center"><strong>Signature of Student</strong></div>
          </div>
          </div>
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
