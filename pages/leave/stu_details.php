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
.style1 {font-weight: bold}
-->
</style>
<style type="text/css">
<!--
.style2 {
	font-size: large;
	font-weight: bold;
}
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Grant Leave<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
     <script type="text/javascript">	
        $(function(){
              $('#datepicker').daterangepicker({
                posX:550,
                posY:800
              }); 
         });
        </script>
        <script type="text/javascript">	
	$(function(){
		  $('#datepicker1').daterangepicker({
			posX:550,
			posY:900
		  }); 
	 });
</script>
		 <?php
	  
	         $id = $_GET['id'];
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
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					$remark = $row_prov['remark'];
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
				}					
			 
	   ?>
        <div class="main-wrapper">
        <!-- Start Here -->
       	  <p align="center" class="style2">STUDENT LEAVE GRANTING FORM</p>
       	  <p align="center" class="style1">&nbsp;</p>
       	  <table width="100%" border="0" class="tbl">
            
            <tr>
              <td width="13%"><strong>Full Name</strong></td>
              <td width="25%">:
                <?=$fullname?></td>
              <td width="16%"><strong>Mother Name</strong></td>
              <td width="27%">:
              
                <?=$mother?></td>
              <td width="19%" rowspan="4"><img align="right" src="../provisional/upload/<?=$photo_url?>" alt="photo" name="goat_img" width="160" height="180" id="goat_img2" /></td>
            </tr>
            <tr>
              <td><strong>DOB</strong></td>
              <td>:
                <?=$dob?></td>
              <td><strong>Gender</strong></td>
              <td>:
                <?=$gender?></td>
            </tr>
            <tr>
              <td><strong>Contact NO.</strong></td>
              <td>:
                <?=$contact?></td>
              <td><strong>Parent Contact NO.</strong></td>
              <td>:
                <?=$p_contact?></td>
            </tr>
            <tr>
              <td><strong>Correspondent Address</strong></td>
              <td align="left" valign="top">:
                <?=$addr_corespond?></td>
              <td><strong>Permanent Address</strong></td>
              <td align="left" valign="top">:
                <?=$addr_premanent?></td>
            </tr>
          </table>
          <p>
            <?php }?>
          </p>
          <p><span class="style2">CURRENT LEAVE STATUS :---</span></p>
          <?php
		  $que=sprintf("SELECT * FROM stu_prov_leave WHERE prov_id='%d' and return_date IS NULL", $id); 
				if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			    $rowCount=$con->affected_rows;
		if($rowCount>0){
		  ?>
          <table width="100%" border="0" class="tbl">
            <thead>
              <tr>
                <th width="5%">SR. NO.</th>
                <th width="19%">OPENING DATE/TIME </th>
                <th width="19%">CLOSING DATE/TIME</th>
                <th width="9%">NO. OF DAYS</th>
                <th width="53%">REASON</th>
              </tr>
            </thead>
            <tbody class='ms'>
              <?php
			 	$clcnt=0;
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					
					$open_date = dateformate($row_prov['open_date']);
					$open_time = $row_prov['open_time'];
					$close_date = dateformate($row_prov['close_date']);
					$close_time = $row_prov['close_time'];
					$reason = $row_prov['reason'];
					$current_date = date("Y-m-d");
					$time1=$close_date." / ".$close_time;
					$time2=$open_date." / ".$open_time;
					$t1 = strtotime($close_date);
					$curr_date = strtotime($current_date);
					$t2 = strtotime($open_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$noofdays = floor($days)+1;
				
			$clcnt++;	
			  ?>
              <tr>
                <td><?=$clcnt?></td>
                <td><?=$time2?> </td>
                <td><?=$time1?></td>
                <td><?=$noofdays?></td>
                <td><?=$reason?></td>
              </tr>
              <?php
				}  ?>
            </tbody>
          </table>
          <p></p>
          <p>&nbsp; </p>
          <?php echo '<p align="center"><font color="red" align="center">STUDENT IS CURRENTLY ON LEAVE CANNOT GRANT NEW LEAVE UNTILL RETURNED</font></p>';?>
          <?php }else {?>
          
         
          <div class="registered-users-wrapper">
			<div class="box-users searchbg">
			  <form action="submit.php" method="post" >
				  <div class="form-list">
				
					<div class="input-box">
						<label>Opening Date :</label>
						<div class="input-box">
							<input type="text" class="input-text" title="Opening Date" id="datepicker" name="datepicker" required />
						</div>
					</div>
					
					<div class="input-box">
						<label>Closing Date :</label>
						<div class="input-box">
							<input type="text" class="input-text" title="Closing Date" id="datepicker1" name="datepicker1" required />
						</div>
					</div>
                    
                    <div class="input-box">
						<label>Reason to go Home Town:</label>
						<div class="input-box">
                        <textarea name="reason" cols="5" rows="5" wrap="hard" class="input-textarea" id="reason" required> </textarea>
						</div>
					</div>			
				  </div>
					<div class="clear"></div>
                    <input type="hidden" value="<?=$id?>" name="prov_id" />
<input type="hidden" value="grant" name="mode" />
					<input name="input" type="submit" value="Grant Leave" class="button"/>
			  </form>
			</div>
		</div>
         
           <?php } mysqli_free_result($page_res);?>
           <!-- End -->
         
         <p>&nbsp;</p>
         <p><span class="style2">PREVIOUS LEAVE HISTORY</span> <span class="style2">:---</span></p>
         <table width="100%" border="0" class="tbl">
           <thead>
             <tr>
               <th width="5%">SR. NO.</th>
               <th width="17%">OPENING DATE </th>
               <th width="16%">CLOSING DATE</th>
               <th width="9%"> <p>DAYS</p>
                <p>Approved</p></th>
               <th width="53%">REASON</th>
               <th width="19%">RETURNING DATE/TIME </th>
               <th width="9%"> <p>DAYS</p>
                <p>Taken</p></th>
               <th width="50%">Remark</th>
              </tr>
           </thead>
           <tbody class='ms'>
             <?php
			 	$que=sprintf("SELECT * FROM stu_prov_leave WHERE prov_id='%d' and return_date IS NOT NULL", $id); 
				if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;} 
				 $rowCount=$con->affected_rows;
			if($rowCount!=0){ 
				$clcnt=0;
		 		$current_date = date("Y-m-d");
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$open_date = dateformate($row_prov['open_date']);
					$open_time = $row_prov['open_time'];
					$close_date = dateformate($row_prov['close_date']);
					$close_time = $row_prov['close_time'];
					$return_date = dateformate($row_prov['return_date']);
					$return_time = $row_prov['return_time'];
					$reason = $row_prov['reason'];
					$remark = $row_prov['remark'];
					
					$time1=$close_date." / ".$close_time;
					$time2=$open_date." / ".$open_time;
					$t1 = strtotime($close_date);
					$curr_date = strtotime($current_date);
					$t2 = strtotime($open_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$noofdays = floor($days)+1;
					
					$time3=$return_date." / ".$return_time;
					$t1 = strtotime($return_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$daystaken = floor($days)+1;
										
							
			  ?>
             <tr>
               <td><?=$clcnt?></td>
               <td><?=$time2?></td>
               <td><?=$time1?></td>
               <td><?=$noofdays?></td>
               <td><?=$reason?></td>
               <td><?=$time3?></td>
               <td><?=$daystaken?></td>
               <td><?=$remark?></td>
              </tr>
             <?php
				} }?>
           </tbody>
         </table>
         <p>&nbsp; </p>
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
