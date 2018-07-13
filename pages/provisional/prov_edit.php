<?php
	session_start();
error_reporting(0);
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
<script type="text/javascript">	
$(function(){
	  $('#dob').daterangepicker({
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
.alert-info {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
</style>
<script type="text/javascript" src="../../js/admission.js"></script>
<script type="text/javascript" src="../../js/jquery-1.8.2.min.js"></script>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Edit Student Details<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
<script type="text/javascript">
$(document).ready(function()
{
	$("#loding1").hide();
	$("#loding2").hide();
	$("#country").change(function()
	{
		$("#loding1").show();
		var id=$(this).val();
		//alert(id);
		var dataString = 'id='+ id;
		$("#state").find('option').remove();
		$("#city").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "get_state.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding1").hide();
				$("#state").html(html);
			} 
		});
	});
	
	
	$("#state").change(function()
	{
		$("#loding2").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
	
		$.ajax
		({
			type: "POST",
			url: "get_city.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				//alert($("#city").html(html));
				$("#city").html(html);
			} 
		});
	});
	
});
</script>
        <script type="text/javascript">	
        $(function(){
              $('#duedate').daterangepicker({
                posX:550,
                posY:1750
              }); 
         });
        </script>
        <script>
		$("#sameasabove").click(function(){
			if($(this).val()=='YES'){
			$("#p_address").attr("disabled",disabled);
			}
		});
		</script>
     <?php
        $id = $_GET['id'];
		if($id > 0)
		{
			$query=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
			if(!($result = $con->query($query))){echo $con->error; exit;}
			$row_add=$result->fetch_assoc();	
			$country_id=$row_add['country_id'];
			$state_id=$row_add['state_id'];
			$city_id=$row_add['city_id'];
			$dob=$row_add['dob'];
			$term1_mark=$row_add['term1'];
                        $term2_mark=$row_add['term2'];
                        $present_class=$row_add['course_id'];
                        $present_section=$row_add['section_id'];
			$query_f = sprintf("SELECT * FROM stu_prov_fees WHERE prov_id='%d'", $id);
			if (!($result_f = $con->query($query_f))) 
			{ echo "FOR QUERY: $query_f<BR>".$con->error; 	exit;}
			$row_f= $result_f->fetch_assoc();
			$duedate = $row_f['due_date'];
                        
                        $query_f = sprintf("SELECT * FROM stu_term_marks WHERE stu_id='%d' order by exam_date DESC", $id);
			if (!($result_f = $con->query($query_f))) 
			{ echo "FOR QUERY: $query_f<BR>".$con->error; 	exit;}
			$row_stuMarkData= $result_f->fetch_assoc();
			$last_exam_date = $row_stuMarkData['exam_date'];
                        $last_exam_term=$row_stuMarkData['term'];
                        if($last_exam_term==1)
                        {
                            $last_exam_term="Term I";
                        }
                        else 
                        {
                            $last_exam_term="Term II";
                        }
                        $last_exam_name=$row_stuMarkData['exam'];
                        $last_exam_subname=$row_stuMarkData['sub_exam'];
                        $last_exam_status=$last_exam_term.' --> '.$last_exam_name.' --> '.$last_exam_subname;
		}
		
	?>
        <div class="main-wrapper">
           
        
            
            <?php
                
            if($_GET['result']==true)
                {
            ?>
            
            <div class="alert alert-info">
                    <h2><strong>Alert!</strong> Here You Can Change Student Result Status To Pass / Fail / Rejoin.<br>
                            <b>Present Class:<em><?=$present_class;?><sup>st</sup>std.</em>  Section:<em><?=$present_section;?></em></b><br></h2>
                    
            </div>
            
            <h2>Student Pass / Fail / Rejoin Status</h2>
                
            <?php
                }
                else {
            ?>
        <h2>Edit Student PROVISIONAL Registration</h2>
        
        <?php       }
        ?>
        <form action="submit.php" method="post" class="form">
            
            <?php
                    if($_GET['result']==true)
                {
            ?>
            <div class="field">
            <label>Select Status:<em> *</em></label>
            <div class="fieldrt">
                
                <select name="input_status">
                    <option></option>
                    <option value="Passout">Passout</option>
                    <option value="Fail">Fail</option>
                    <option value="Rejoin">Rejoin</option>
                </select>
            </div>
            
            </div>
            <?php
                }
                
            ?>
            <div class="field">
            <label>First Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['fname']?>" title="Full Name" id="fname" name="fname" required />
            </div>
        </div>
        <div class="field">
            <label>Middle Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['mname']?>" title="Full Name" id="mname" name="mname" required />
            </div>
        </div>
        <div class="field">
            <label>Last Name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['lname']?>" title="Last Name" id="lname" name="lname" required />
            </div>
        </div>
        
        <div class="field">
            <label>Mother name :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['mother']?>" title="Mother Name" id="mother" name="mother" required />
            </div>
        </div>
        
        <div class="field">
            <label>Date Of Birth (dd-mm-yyyy):<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$dob?>" title="DOB" id="dob"  name="dob" required />
            </div>
        </div>
        
        <div class="field">
            <label>Contact NO. : <em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['contact']?>" title="Contact" id="contact" name="contact" required />
            </div>
        </div>
        
        <div class="field">
            <label>Parents Contact NO. : </label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['p_contact']?>" title="Parent Contact" id="p_contact" name="p_contact" />
            </div>
        </div>
        
        <div class="field">
            <label>Gender :<em>*</em></label>
            <div class="fieldrt">
             <ul class="halflist">
             <li><input name="gender" type="radio" value="M" <?php if($row_add['gender']=='M'){?>checked="checked"<?php }?> id="male" required /><label for="male">Male</label></li>
              <li><input name="gender" type="radio" value="F" <?php if($row_add['gender']=='F'){?>checked="checked"<?php }?> id="female" style="margin-left:25%;" required /><label for="female">Female</label></li>
              </ul>
            </div>
        </div>
        
        <div class="field">
            <label>Caste :<em>*</em></label>
            <div class="fieldrt">
            <select name="caste" class="slct" required >
                  <option value="">Please Select Caste</option>
                  
                  <?php
				 		$query_caste = "SELECT * FROM stu_caste ORDER BY caste_id ASC";						
						if(!($result_caste = $con->query($query_caste)))
						{
							echo "FOR QUERY: $query_caste<BR>".$con->error;
							exit();
						}
						while($row_caste = $result_caste->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_caste['caste_id']?>' <?php if($row_add['caste_id']==$row_caste['caste_id']){?>selected="selected"<?php }?> ><?php echo stripslashes($row_caste['caste']);?></option>
						<?php
						}?>
                </select>
            </div>
        </div>
        
        <div class="field">
            <label>Religion :<em>*</em></label>
            <div class="fieldrt">
                <select name="religion" class="slct" required >
                  <option value="">Please Select</option>
                <?php
				 		$query_relig = "SELECT * FROM stu_religion ORDER BY religion_id ASC";
						
						if(!($result_relig = $con->query($query_relig)))
						{
							echo "FOR QUERY: $query_relig<BR>".$con->error;
							exit();
						}  
						while($row_relig = $result_relig->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_relig['religion_id']?>' <?php if($row_add['religion_id']==$row_relig['religion_id']){?>selected="selected"<?php }?> ><?php echo stripslashes($row_relig['religion']);?></option>
						<?php
						}?>
                </select>
            </div>
        </div>
        
         <div class="field">
            <label>Country :<em>*</em></label>
            <div class="fieldrt">

                <select name="country" id="country" class="slct" required >
                  <option selected="selected" value="">Please Select Country</option>
               			<?php
				 		$query_country = "SELECT * FROM country";
						if(!($result_country = $con->query($query_country)))
						{
							echo "FOR QUERY: $query_country<BR>".$con->error;
							exit();
						}  
						while($row_country = $result_country->fetch_assoc())
						{
						?>
                        <option value="<?php echo $row_country['country_id']; ?>" <?php if($row_country['country_id']==$row_add['country_id']){?> selected="selected"<?php }?>><?php echo $row_country['country_name']; ?></option> 
				  <?php } ?>
											
                </select>
            </div>
        </div>
        
         <div class="field">
            <label>State :<em>*</em></label>
            <div class="fieldrt">
                <select name="state" id="state" class="slct" >
                   <?php
				 		$query_state = "SELECT * FROM state where state_id=$state_id";
						if(!($result_state = $con->query($query_state)))
						{
							echo "FOR QUERY: $query_state<BR>".$con->error;
							exit();
						}  
						if($row_state = $result_state->fetch_assoc())
						{
						?>
                        <option value="<?php echo $row_state['state_id']; ?>" ><?php echo $row_state['state_name']; ?></option> 
				  <?php } ?>
                  
                </select>
                <img src="ajax-loader.gif" id="loding1"></img>
            </div>
        </div>
        
        <div class="field">
            <label>City :<em>*</em></label>
            <div class="fieldrt">
                <select name="city" id="city" class="slct"  >
                  <?php
				 		$query_city = "SELECT * FROM city where city_id=$city_id";
						if(!($result_city = $con->query($query_city)))
						{
							echo "FOR QUERY: $query_city<BR>".$con->error;
							exit();
						}  
						if($row_city = $result_city->fetch_assoc())
						{
						?>
                        <option value="<?php echo $row_city['city_id']; ?>" ><?php echo $row_city['city_name']; ?></option> 
				  <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="field">
            <label>Correspondent Address. : </label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['addr_corespond']?>" title="Full Address" id="c_address" name="c_address" />
       		 </div>
        </div>
        
        <div class="field">
            <label><p></p> </label>
            <div class="fieldrt">
                <input name="sameasabove" type="checkbox" onclick="AddressCopy(this.form)" value="YES" /> <em>Same As Above</em>
       		 </div>
        </div>
        
        <div class="field">
            <label>Permanent Address. : </label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['addr_premanent']?>" title="Full Address" id="p_address" name="p_address" />
       		 </div>
        </div>
        
        <div class="field">
            <label>Preferred Class List :<em>*</em></label>
            
            <div class="fieldrt">
<!--            <INPUT type="button" class="button" value="Add Row" onclick="addRow('courseTable')" />
            <INPUT type="button" class="button" value="Delete Row" onclick="deleteRow('courseTable')" />-->

              <TABLE id="courseTable"  border="0">
         <?php
 $query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $id);
						if (!($result_prov_course = $con->query($query_prov_course))) 
						{ echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}
				 		while($row_prov_course=$result_prov_course->fetch_assoc())
						{
							$course_id=$row_prov_course['course_id'];
							$section_id=$row_prov_course['section_id'];
						
 ?>
        <TR>
            <TD><INPUT type="checkbox" name="chk"/></TD>
            <TD>
                <SELECT name="course_id[]" class="slct" required >
                	<OPTION value="">Select Course</OPTION>
                    <?php
										
						$query_course = "SELECT * FROM stu_course ORDER BY course_id ASC";
						if(!($result_course = $con->query($query_course)))
						{
							echo "FOR QUERY: $query_course<BR>".$con->error;
							exit();
						}  
						while($row_course = $result_course->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_course['course_id']?>' <?php if($row_course['course_id']==$course_id){?>selected="selected"<?php }?> ><?php echo stripslashes($row_course['course']);?></option>
						<?php
						}?>
                </SELECT>
            </TD>
        </TR>
        <?php }?>
    </TABLE>
               
            </div>
        </div>
            
            
            <div class="field">
            <label>Section:<em>*</em></label>
            <div class="fieldrt">

                <select name="section_id" id="section" class="slct" required >
                  <option selected="selected" value="">Please Select Section</option>
               			<?php
                                    $query_section = "SELECT * FROM section";
                                    if(!($result_section = $con->query($query_section)))
                                    {
                                            echo "FOR QUERY: $result_section<BR>".$con->error;
                                            exit();
                                    }  
                                    while($row_section = $result_section->fetch_assoc())
                                    {
                                    ?>
                                    <option value='<?php echo $row_section['section']; ?>' <?php if($row_section['section']==$section_id){?>selected="selected"<?php }?> ><?php echo stripslashes($row_section['section']);?></option>
                        	  <?php } ?>
											
                </select>
            </div>
        </div>
        
        <div class="field">
            <label>Qualification Details :<em>*</em></label>
            
            <div class="fieldrt">
            <INPUT type="button" class="button" value="Add Row" onclick="addRow('eduTable')" />
            <INPUT type="button" class="button" value="Delete Row" onclick="deleteRow('eduTable')" />
<TABLE id="eduTable"  border="0">
             
<?php
		$query_prov_edu = sprintf("SELECT * FROM stu_prov_edu WHERE prov_id='%d'", $id);
		if (!($result_prov_edu = $con->query($query_prov_edu))) 
		{ echo "FOR QUERY: $query_prov_edu<BR>".$con->error; 	exit;}
		while($row_prov_edu=$result_prov_edu->fetch_assoc())
		{
			$edu_id=$row_prov_edu['edu_id'];
		
?>
        <TR>
            <TD width="18"><INPUT type="checkbox" name="chk"/></TD>
            <TD width="145">
                <SELECT name="edu_id[]" class="slct" required >
                	<OPTION value="">Select Qualification</OPTION>
                    <?php
				 		$query_edu = "SELECT * FROM stu_edu ORDER BY edu_id ASC";
						if(!($result_edu = $con->query($query_edu)))
						{
							echo "FOR QUERY: $query_edu<BR>".$con->error;
							exit();
						}  
						while($row_edu = $result_edu->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_edu['edu_id']?>' <?php if($row_edu['edu_id']==$edu_id){?>selected="selected"<?php }?> ><?php echo stripslashes($row_edu['edu']);?></option>
						<?php
						}?>
                </SELECT>
            </TD>
            <TD width="100">
            	<input type="text" class="input-text" value="<?=$row_prov_edu['percent']?>" title="Percentage" id="percent[]" name="percent[]" placeholder="percent(%)" required />                 
            </TD>
        </TR>
 <?php }?>
</TABLE>
                <p>&nbsp;</p>
            </div>
        </div>
        
        <div class="field">
           <hr />
            <div class="fieldrt">
       		 </div>
        </div>
        
        <div class="field">
            <label>Submitted Documents : <em>*</em></label>
            <div class="fieldrt">
<?php
		$query_prov_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $id);
		if (!($result_prov_doc = $con->query($query_prov_doc))) 
		{ echo "FOR QUERY: $query_prov_doc<BR>".$con->error; 	exit;}
		$row_doc=$result_prov_doc->fetch_assoc();
	
					
?>            
            <ul class="halflist">
               <li> 
                 	 <input name="tenth" <?php if($row_doc['tenth']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> 
                 	 10th
               </li>
               <li>
               		 <input name="twelth" <?php if($row_doc['twelth']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> 
               		 12th
               </li>
                <li>
               		 <input name="diploma" <?php if($row_doc['diploma']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" />
               		 Diploma
                </li>
                <li>
               		<input name="ug" <?php if($row_doc['ug']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" />	
               		UG
               </li>
                <li>
               		<input name="pg" <?php if($row_doc['pg']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" />
               		PG
                </li>
                <li>
               		<input name="tc" <?php if($row_doc['tc']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> TC
               </li>
                <li>
               		<input name="national" <?php if($row_doc['nationality']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Nationality
               </li>
                <li>
               		<input name="domicile" <?php if($row_doc['domicile']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Domicile
               </li> 
               <li>
               		<input name="gap" <?php if($row_doc['gap']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Gap Certificate
               </li>
                <li>
               		<input name="birth" <?php if($row_doc['birth']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" id="birth" value="YES" /> Birth Cirtificate
               </li>
               
               <li>
                    <input name="ncl" <?php if($row_doc['ncl']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> NCL
               </li>
          
              
                <li>
               		<input name="cast" <?php if($row_doc['cast']=='YES'){ ?>checked="checked"<?php }?>  type="checkbox" value="YES" /> Caste
               </li>
                <li>
               		<input name="validity" <?php if($row_doc['validity']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Validity
               </li>
                 
                <li>
               		<input name="income" <?php if($row_doc['income']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Income
               </li>
               <li>
               		<input name="medical" <?php if($row_doc['medical']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> Medical Certificate
               </li>
               <li>
               		<input name="idproof" <?php if($row_doc['id_proof']=='YES'){ ?>checked="checked"<?php }?> type="checkbox" value="YES" /> ID Proof
               </li> 
              <li>
              		Photo : <input name="photo" value="<?=$row_doc['photo']?>" type="text" size="7" placeholder="No of Photo" />
              </li>
            </ul>
         	<p>Any others Documents :  <input type="text" value="<?=$row_doc['other']?>" name="other" size="30" />
              </p>   	
         
            </div>
        </div>
        <br />
        <div class="field">
           <hr />
            <div class="fieldrt">
       		 </div>
        </div>
        
        <div class="field">
            <label>NCC C-Certificate :<em>*</em></label>
            <div class="fieldrt">
            <ul class="halflist">
             <li><input name="c_certi" type="radio" value="YES" <?php if($row_add['c_certi']=='YES'){?>checked="checked"<?php }?>  required /><label for="male">YES</label></li>
              <li><input name="c_certi" type="radio" value="NO" <?php if($row_add['c_certi']=='NO'){?>checked="checked"<?php }?>  style="margin-left:25%;" required /><label for="female">NO</label></li>
              </ul>
            </div>
        </div>
        
        <div class="field">
            <label>Weight(in KG's) :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['weight']?>"  title="Weight" id="weight" name="weight" required />
            </div>
        </div>
        
        <div class="field">
            <label>Height(in CM's) :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['height']?>" title="Height" id="height" name="height" required />
            </div>
        </div>
        
         <div class="field">
            <label>Course Duration :</label>
            <div class="fieldrt">
                <select name="duration" class="slct" required >
                  <option value="">Course Duation in Months</option>
                  
                  <?php
				 		$query_d = "SELECT * FROM stu_duration ORDER BY d_id ASC";						
						if(!($result_d = $con->query($query_d)))
						{
							echo "FOR QUERY: $query_d<BR>".$con->error;
							exit();
						}
						while($row_d = $result_d->fetch_assoc())
						{
						?>
						<option value='<?php echo $row_d['d_id']?>' <?php if($row_add['duration_id']==$row_d['d_id']){?>selected="selected"<?php }?>><?php echo stripslashes($row_d['duration']);?></option>
						<?php
						}?>
                </select>
       		 </div>
        </div>
           
         <div class="field">
            <label>Total Fees :</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['fixedfees']?>" title="Fixed Fees" id="fixedfees" name="fixedfees" required />
       		 </div>
        </div>
        
         <div class="field">
            <label>Fees Paid</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['feespaid']?>" title="Fees Paid" id="feespaid" name="feespaid" required />
       		 </div>
        </div>
        
        <div class="field">
            <label>Next Fees Due-Date</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=dateformate($duedate)?>" title="Fees Due-Date" id="duedate" name="duedate" required />
       		 </div>
        </div>
        
        <div class="field">
            <label>Remark.</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['remark']?>" title="Remark" id="remark" name="remark" required />
       		 </div>
        </div>
        
        <div class="field">
            <label>Register NO.</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['fileno']?>" title="Register NO" id="fileno" name="fileno" required />
       		 </div>
        </div>
        
        <div class="gap"></div>
        <?php
                
            if($_GET['result']==true)
                {
                
            ?>
            <input type="hidden" id="mode" name="mode" value="stu_status"/>
            <?php
                }
                else { 
            ?>
        <input type="hidden" value="update" id="mode" name="mode"  required />
        <?php
                }
        ?>
        <input type="hidden" value="<?=$id?>" id="prov_id" name="prov_id"  required />
        
        <div class="field">
        <label>&nbsp;</label>
        <div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/>
        </div>
        </form>
        <?php
   //              }
                 //end of the else part
        ?>
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
