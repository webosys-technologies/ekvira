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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="list-enquiry.php?flag=non">Home</a> &raquo; Add From Enquiry<!-- InstanceEndEditable --></strong></p>
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
			url: "../provisional/get_state.php",
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
			url: "../provisional/get_city.php",
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
              $('#dob').daterangepicker({
                posX:550,
                posY:600
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
			$query=sprintf("SELECT * FROM stu_enquiry WHERE enq_id='%d'", $id); 
			if(!($result = $con->query($query))){echo $con->error; exit;}
			$row_add=$result->fetch_assoc();	
		}
	
	?>
        <div class="main-wrapper">
        <h2>Student PROVISIONAL Registration</h2>
        <form action="../provisional/preview.php?flag=<?=$flag?>&" method="post" class="form">
        
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
                <input type="text" class="input-text" value="" title="Mother Name" id="mother" name="mother" required />
            </div>
        </div>
        
        <div class="field">
            <label>Date Of Birth (dd-mm-yyyy):<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="DOB" id="dob"  name="dob" required />
            </div>
        </div>
        
        <div class="field">
            <label>Contact NO. : <em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['phone']?>" title="Contact" id="contact" name="contact" required />
            </div>
        </div>
        
        <div class="field">
            <label>Parents Contact NO. : </label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Parent Contact" id="p_contact" name="p_contact" />
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
                        <option value="<?php echo $row_country['country_id']; ?>"><?php echo $row_country['country_name']; ?></option> 
				  <?php } ?>
											
                </select>
            </div>
        </div>
        
         <div class="field">
            <label>State :<em>*</em></label>
            <div class="fieldrt">
                <select name="state" id="state" class="slct" >
                  <option selected="selected" value="">Please Select State</option>
                </select>
                <img src="ajax-loader.gif" id="loding1"></img>
            </div>
        </div>
        
        <div class="field">
            <label>City :<em>*</em></label>
            <div class="fieldrt">
                <select name="city" id="city" class="slct"  >
                  <option selected="selected" value="">Please Select City</option>
                </select>
            </div>
        </div>
        
        
        
        <div class="field">
            <label>Correspondent Address. : </label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="<?=$row_add['address']?>" title="Full Address" id="c_address" name="c_address" />
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
                <input type="text" class="input-text" value="" title="Full Address" id="p_address" name="p_address" />
       		 </div>
        </div>
        
        <div class="field">
            <label>Preferred Course List :<em>*</em></label>
            
            <div class="fieldrt">
            <INPUT type="button" class="button" value="Add Row" onclick="addRow('courseTable')" />
            <INPUT type="button" class="button" value="Delete Row" onclick="deleteRow('courseTable')" />
           		
              <TABLE id="courseTable"  border="0">
	<?php
    $query_enq_course = sprintf("SELECT * FROM stu_course c,stu_enq_course e where c.course_id=e.course_id and e.enq_id='%d'", $id);
    if (!($result_enq_course = $con->query($query_enq_course))) 
    { echo "FOR QUERY: $query_enq_course<BR>".$con->error; 	exit;}
    while($row_enq_course=$result_enq_course->fetch_assoc())
    {
        $course=$row_enq_course['course'];
    ?>
        <TR>
       		 <TD><INPUT type="checkbox" name="chk"/></TD>
             <TD>
                <SELECT name="course_id[]" class="slct" required >
                	<option value="">Select Course</option>
			<?php
            $query_course = "SELECT * FROM stu_course";
			if(!($result_course = $con->query($query_course))){echo "FOR QUERY: $query_course<BR>".$con->error; exit(); }
			while($row_course = $result_course->fetch_assoc())
			{
            ?>
            <option value='<?php echo $row_course['course_id']?>' <?php if($row_enq_course['course_id']==$row_course['course_id']){?>selected="selected"<?php }?> ><?php echo stripslashes($row_course['course']);?></option>
              
		<?php } ?>			
                </SELECT>
            </TD>
        </TR>
        <?php  }?>
    </TABLE>
                <p>&nbsp;</p>
            </div>
        </div>
        
        <div class="field">
            <label>Qualification Details :<em>*</em></label>
            
            <div class="fieldrt">
            <INPUT type="button" class="button" value="Add Row" onclick="addRow('eduTable')" />
            <INPUT type="button" class="button" value="Delete Row" onclick="deleteRow('eduTable')" />
              <TABLE id="eduTable"  border="0">
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
						<option value='<?php echo $row_edu['edu_id']?>'><?php echo stripslashes($row_edu['edu']);?></option>
						<?php
						}?>
                </SELECT>
            </TD>
            <TD width="100">
            	<input type="text" class="input-text" value="" title="Percentage" id="percent[]" name="percent[]" placeholder="percent(%)" required />                 
            </TD>
        </TR>
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
            
            <ul class="halflist">
               <li> 
                 	 <input name="tenth" type="checkbox" value="YES" /> 
                 	 10th
               </li>
               <li>
               		 <input name="twelth" type="checkbox" value="YES" /> 
               		 12th
               </li>
                <li>
               		 <input name="diploma" type="checkbox" value="YES" />
               		 Diploma
                </li>
                <li>
               		<input name="ug" type="checkbox" value="YES" />	
               		UG
               </li>
                <li>
               		<input name="pg" type="checkbox" value="YES" />
               		PG
                </li>
                <li>
               		<input name="tc" type="checkbox" value="YES" /> TC
               </li>
                <li>
               		<input name="national" type="checkbox" value="YES" /> Nationality
               </li>
                <li>
               		<input name="domicile" type="checkbox" value="YES" /> Domicile
               </li> 
               <li>
               		<input name="gap" type="checkbox" value="YES" /> Gap Certificate
               </li>
                <li>
               		<input name="birth" type="checkbox" id="birth" value="YES" /> Birth Cirtificate
               </li>
               
               <li>
                    <input name="ncl" type="checkbox" value="YES" /> NCL
               </li>
          
              
                <li>
               		<input name="cast" type="checkbox" value="YES" /> Cast
               </li>
                <li>
               		<input name="validity" type="checkbox" value="YES" /> Validity
               </li>
                 
                <li>
               		<input name="income" type="checkbox" value="YES" /> Income
               </li>
               <li>
               		<input name="medical" type="checkbox" value="YES" /> Medical Certificate
               </li>
               <li>
               		<input name="idproof" type="checkbox" value="YES" /> ID Proof
               </li> 
              <li>
              		Photo : <input name="photo" type="text" size="7" placeholder="No of Photo" />
              </li>
            </ul>
         	<p>Any others Documents :  <input type="text" name="other" size="30" />
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
             <li><input name="c_certi" type="radio" value="YES"  required /><label for="male">YES</label></li>
              <li><input name="c_certi" type="radio" value="NO" checked="checked" style="margin-left:25%;" required /><label for="female">NO</label></li>
              </ul>
            </div>
        </div>
        
        <div class="field">
            <label>Weight(in KG's) :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text"  title="Weight" id="weight" name="weight" required />
            </div>
        </div>
        
        <div class="field">
            <label>Height(in CM's) :<em>*</em></label>
            <div class="fieldrt">
                <input type="text" class="input-text"  title="Height" id="height" name="height" required />
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
						<option value='<?php echo $row_d['d_id']?>'><?php echo stripslashes($row_d['duration']);?></option>
						<?php
						}?>
                </select>
       		 </div>
        </div>
           
         <div class="field">
            <label>Total Fees :</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Fixed Fees" id="fixedfees" name="fixedfees" required />
       		 </div>
        </div>
        
         <div class="field">
            <label>Fees Paid</label>
            <div class="fieldrt">
                <input type="text" class="input-text" value="" title="Fees Paid" id="feespaid" name="feespaid" required />
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
                <input type="text" class="input-text" value="" title="Register NO" id="fileno" name="fileno" required />
       		 </div>
        </div>
        
        <div class="gap"></div>
        <input type="hidden" value="new" id="mode" name="mode"  required />
        <div class="field">
        <label>&nbsp;</label>
        <div class="fieldrt"><input name="input" type="submit" value="Submit" class="button"/>
        </div>
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
