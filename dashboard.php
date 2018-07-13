<?php  error_reporting(0);
session_start();
require 'common/connect.php';
include("common/getid.php");
	if($_SESSION['authorised'])
  	{
	$state=$_SESSION['authorised'];
	$val=calcID();
	if($val!=$state)
	{
		header("Location:common/developer.php?flag=non");
		exit;
	}
 }else{
 	header("Location:index.php?flag=err");
	exit;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pre-Cadet Admission System</title>
<link href="css/style-sms.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
	var togSrc = [ "images/up.png", "images/down.png" ];
	$("#notify").show();
	$("#adm_sec").hide();
	$("#stock_sec").hide();
	$("#lib_sec").hide();
	$("#staff_sec").hide();
	$("#stud_sec").hide();
	$("#exam_sec").hide();
	$("#admin_sec").hide();
  	$('#notifyimg').click(function(){
		$("#notify").show(1000);
		$("#adm_sec").hide(1000);
		$("#exam_sec").hide(1000);
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
		$("#exam_sec").hide(1000);
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
		$("#exam_sec").hide(1000)
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
		$("#exam_sec").hide(1000)
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
		$("#exam_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#studimg').click(function(){
		$("#stud_sec").show(1000);
		$("#notify").hide(1000);
		$("#exam_sec").hide(1000);
		$("#adm_sec").hide(1000)
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#staff_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#examimg').click(function(){
		$("#exam_sec").show(1000);
		$("#stud_sec").hide(1000);
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
		$("#exam_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#staff_sec").hide(1000);
		return false;
	});
});
</script>
<style type="text/css">
<!--
body {
	background-image: url(images/body.jpg);
}
-->
</style></head>


<body>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="images/logotext.png" alt="subscription-management-system" /></div>
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
        <h2 class="ico-dash"><a href="dashboard.php?flag=<?=$flag?>"><img src="images/dashboard.png" alt="" align="absmiddle" /> Dashboard</a></h2>
        
        <h2 class="ico-rt"><a href="logout.php?flag=logout"><img src="images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="admin/user/edit.php?id=<?=$user_id?>&flag=non"><img src="images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
        
   	  </div>
        <div class="boxinner">
        	<p>You are here &raquo; <strong>Dashboard</strong></p>
        </div>
    </div> 

    <div class="wblock">
    <ul class="boxlist">
        	<li id="notifyimg" >
            <div class="boxicon"><img class="notifyimg"  src="images/icon-notice.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Notifications</a></div>
            </li>
            <li id="admimg">
            <div class="boxicon"><img class="admimg" src="images/icon-company.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Admission Management</a></div>
            </li>
            <li id="stockimg">
            <div class="boxicon"><img class="stockimg" src="images/result.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Store Stock Management</a></div>
            </li>
            <li id="libimg">
            <div class="boxicon"><img class="libimg" src="images/fees_icon.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Library Management</a></div>
            </li>
            <li id="staffimg">
            <div class="boxicon"><img class="staffimg" src="images/mf.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Staff Management</a></div>
            </li>
            <li id="studimg">
            <div class="boxicon"><img class="studimg" src="images/icon-subscriber.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Student Management</a></div>
            </li>
            <li id="examimg">
            <div class="boxicon"><img class="studimg" src="images/icon-subscriber.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Exam Management</a></div>
            </li>
            <?php if($user_type=='SU'){ ?>
             <li id="adminimg">
            <div class="boxicon"><img class="adminimg" src="images/icon-company.png" alt="SHOW/HIDE" /></div>
            <div class="boxtitle"><a>Admin Section</a></div>
            </li>
            <?php } ?>
        </ul>
    </div>

      <div class="wblock" id="notify">
      <h1>NOTIFICATION SECTION</h1>
      <hr/>
        <div class="notify_lt" id="notify_lt" style="overflow:scroll; height:150px;">
        <h3>FEES RELATED NOTIFICATION</h3>
        <hr />
        <?php
		  	$condition2=" ORDER BY prov_id DESC";	
			$que="SELECT * FROM stu_provisional $condition2";
			if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;
			if($rowCount>0){  
				$clcnt=0;
				$cur_date=date('Y-m-d');
				echo '<table class="tbl">';
				echo '<tr>';
				echo '<th> SR. </th>';
				echo '<th> Fileno </th>';
				echo '<th>Name</th>';
				echo '<th>Phone</th>';
				echo '<th>FeesPaid</th>';
				echo '<th>Due Date</th>';
				echo '<th>Action</th>';
				echo '</tr>';
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=$row_prov['fname'];
					$contact = $row_prov['contact'];
					$fileno = $row_prov['fileno'];
					$fixedfees = $row_prov['fixedfees'];
		  			
					$query_fees = sprintf("SELECT * FROM stu_prov_fees WHERE prov_id='%d' order by fees_id ASC", $id);
					if (!($result_fees = $con->query($query_fees))) 
					{ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}
					$tot_fees_paid=0;
					while($row_fees = $result_fees->fetch_assoc()){
					$nextDueDate = $row_fees['due_date'];
					$tot_fees_paid = $row_fees['fees_paid'] + $tot_fees_paid;
					$feesremaining=$fixedfees - $tot_fees_paid;
					}
					if($nextDueDate<=$cur_date and $feesremaining>0){
						echo '<tr>';
						echo '<td> '.$clcnt.'. </td>';
						echo '<td> '.$fileno.' </td>';
						echo '<td> '.$fullname.' </td>';
						echo '<td> '.$contact.' </td>';
						echo '<td> '.$tot_fees_paid.' </td>';
						echo '<td> '.dateformate($nextDueDate).' </td>';
						echo '<td><a href="pages/provisional/fees/payfees.php?flag=edit&id='.$id.'" class="button">pay</a></td>';
						echo '</tr>';
					}
		  		}
		  		echo '</table>';
			}
		  ?>
      </div>
      <div class="notify_rt" id="notify_rt" style="overflow:scroll; height:150px;">
        <h3>LEAVE RELATED NOTIFICATION</h3>
        <hr />
        <?php
			$current_date = date("Y-m-d");
		   $condition2=" ORDER BY prov_id ASC";	
			$que="SELECT * FROM stu_prov_leave WHERE close_date<='".$current_date."' and return_date IS NULL $condition2";
			
			if (!($page_res = $con->query($que))) { echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows;  
			if($rowCount>0){
				$clcnt=0;
				echo '<table class="tbl">';
				echo '<tr>';
				echo '<th> SR. NO. </th>';
				echo '<th> Fileno </th>';
				echo '<th>Name</th>';
				echo '<th>Phone</th>';
				echo '<th>Open Date</th>';
				echo '<th>Close Date</th>';
				echo '</tr>';
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$id=$row_prov['prov_id'];
					$open_date = dateformate($row_prov['open_date']);
					$open_time = $row_prov['open_time'];
					$close_date = dateformate($row_prov['close_date']);
					$close_time = $row_prov['close_time'];
					$reason = $row_prov['reason'];
						
					$query_prov = sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id);
					if (!($result = $con->query($query_prov))) 
					{ echo "FOR QUERY: $query_prov<BR>".$con->error; 	exit;}
					$rows = $result->fetch_assoc();
					$fullname=$rows['fname'];
					$contact = $rows['contact'];
					$fileno = $rows['fileno'];
					$clcnt++;	
	  				
						echo '<a href="#"><tr>';
						echo '<td> '.$clcnt.'. </td>';
						echo '<td> '.$fileno.' </td>';
						echo '<td> '.$fullname.' </td>';
						echo '<td> '.$contact.' </td>';
						echo '<td> '.$open_date.' </td>';
						echo '<td> '.$close_date.' </td>';
						echo '</tr></a>';


				}
				echo '</table>';
				}
				
		  ?>
      </div>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      <p></p>
      
    </div>
 <?php
	if($user_type=='SU' or $user_type='GU')
	{
	?>   
    <div id="adm_sec" class="wblock">
    <h1>ADMISSION MANAGEMENT SECTION</h1>
      <hr/>
           	<ul class="boxlist">
        	<li>
            <div class="boxicon"><a href="pages/enquiry/list-enquiry.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/enquiry/list-enquiry.php?flag=<?=$flag?>">Enquiry Admission</a></div>
            </li>
            
        	<li>
            <div class="boxicon"><a href="pages/provisional/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/index.php?flag=<?=$flag?>">List Admitted Students</a></div>
          </li>
            
                      
            <li>
            <div class="boxicon"><a href="pages/provisional/cancel_adm/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/cancel_adm/index.php?flag=<?=$flag?>">Cancel Admission</a></div>
            </li>
            <li>
            <div class="boxicon"><a href="pages/provisional/stud_status/index.php?status=new&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/stud_status/index.php?status=new&flag=<?=$flag?>">Admission Status</a></div>
            </li>
            
            <li>
            <div class="boxicon"><a href="pages/renew/index.php?status=cancel&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/renew/index.php?status=cancel&flag=<?=$flag?>">Renew Admission</a></div>
            </li>
            
            <li>
            <div class="boxicon"><a href="pages/uploadimg/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/uploadimg/index.php?flag=<?=$flag?>">Upload Photo</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="pages/enquiry/list-enquiry.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/index.php?flag=<?=$flag?>">Edit Details</a></div>
          </li>
          <li>
            <div class="boxicon"><a href="pages/provisional/export/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/export/index.php?flag=<?=$flag?>">Export to Excel</a></div>
          </li>
		</ul>
    </div>
     <div id="stock_sec" class="wblock">
     <h1>STOCK MANAGEMENT SECTION</h1>
      <hr/>
      	<ul class="boxlist">
   <?php
	if($user_type=='SU' or $user_type=='GU')
	{
	?>  
       	  <li>
            <div class="boxicon"><a href="admin/store/add.php?stock=study&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/store/add.php?stock=study&flag=<?=$flag?>">Add New Study Stock</a></div>
          </li>
          
            <li>
            <div class="boxicon"><a href="admin/store/add.php?stock=physical&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/store/add.php?stock=physical&flag=<?=$flag?>">Add New Physical Stock</a></div>
          </li>
           <li>
            <div class="boxicon"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>">Delete Item</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>">Edit</a></div>
            </li>
            <?php } ?>
        	<li>
            <div class="boxicon"><a href="pages/provisional/item/index.php?stock=study&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/item/index.php?stock=study&flag=<?=$flag?>">Allocate Item</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="pages/provisional/item/individual.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/item/individual.php?flag=<?=$flag?>">Individual Stock Summary</a></div>
          </li>
                     
            <li>
            <div class="boxicon"><a href="pages/provisional/item/statistics.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/item/statistics.php?flag=<?=$flag?>">Stock Item Statistics</a></div>
            </li>
             <li>
            <div class="boxicon"><a href="pages/provisional/item/export/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/item/export/index.php?flag=<?=$flag?>">Export To Excel</a></div>
            </li>
            
		</ul>
        
    </div>
    
    <div id="lib_sec" class="wblock">
      <h1>LIBRARY SECTION</h1>
      <hr/>
      	<ul class="boxlist">
        	<li>
            <div class="boxicon"><a href="admin/library/add.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/library/add.php?flag=<?=$flag?>">ADD NEW BOOK</a></div>
          </li>
                      
        	<li>
            <div class="boxicon"><a href="pages/provisional/book/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/book/index.php?flag=<?=$flag?>">Allocate/Return Book</a></div>
            </li>
            
            <li>
            <div class="boxicon"><a href="pages/provisional/book/individual.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/book/individual.php?flag=<?=$flag?>">Individual Book Summary</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="admin/library/index.php?flag=bookdel"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/library/index.php?flag=bookdel">Delete Book</a></div>
            </li>
                       
            <li>
            <div class="boxicon"><a href="admin/library/index.php?flag=bookedit"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/library/index.php?flag=bookedit">Edit</a></div>
            </li>
            
             <li>
            <div class="boxicon"><a href="pages/provisional/book/export/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/book/export/index.php?flag=<?=$flag?>">Export To Excel</a></div>
            </li>
            
		</ul>
    </div>
    
   <div id="staff_sec" class="wblock">
      <h1>STAFF SECTION </h1>
      <hr/>
      	<ul class="boxlist"> 
        	<li>
            <div class="boxicon"><a href="pages/teacher/payment/index.php?staff=teach&amp;flag=<?=$flag?>&amp;mode=pay"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/teacher/payment/index.php?staff=teach&amp;flag=<?=$flag?>&amp;mode=pay">Payment</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="pages/teacher/payment/sheetindex.php?staff=teach&amp;flag=<?=$flag?>&amp;mode=pay"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/teacher/payment/sheetindex.php?staff=teach&amp;flag=<?=$flag?>&amp;mode=pay">Payment Sheet</a></div>
          </li>
    <?php
	if($user_type=='SU')
	{
	?>    
            <li>
            <div class="boxicon"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach">Delete Staff</a></div>
            </li>
                       
            <li>
            <div class="boxicon"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach">Edit</a></div>
            </li>
      <?php }?>
		</ul>
    </div>
   <?php } ?> 
    <div id="stud_sec" class="wblock">
      <h1>STUDENT SECTION </h1>
      <hr/>
     
		<ul class="boxlist">
    <?php
	if($user_type=='SU' or $user_type='GU')
	{
	?> 
        	<li>
            <div class="boxicon"><a href="pages/provisional/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/index.php?flag=<?=$flag?>">Total Available Students</a></div>
          </li>
            
        	<li>
            <div class="boxicon"><a href="pages/leave/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/leave/index.php?flag=<?=$flag?>">Leave Management</a></div>
          </li>
                           
            <li>
            <div class="boxicon"><a href="pages/enquiry/list-enquiry.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/index.php?flag=<?=$flag?>">Student Edit</a></div>
          </li>
            
             <li>
            <div class="boxicon"><a href="pages/provisional/fees/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/fees/index.php?flag=<?=$flag?>">Fees Management</a></div>
          </li>
          <li>
            <div class="boxicon"><a href="pages/provisional/editdocs/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/provisional/editdocs/index.php?flag=<?=$flag?>">Edit Document</a></div>
          </li>
       <?php } ?>
           <li>
            <div class="boxicon"><a href="pages/teacher/marks/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/teacher/marks/index.php?flag=<?=$flag?>">Marks Management</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="pages/teacher/attendance/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/teacher/attendance/index.php?flag=<?=$flag?>">Attendance Management</a></div>
          </li>
		</ul>
         
    </div>
    
    
    <div id="exam_sec" class="wblock">
      <h1>EXAM SECTION </h1>
      <hr/>
     
		<ul class="boxlist">
    <?php
	if($user_type=='SU' or $user_type='GU')
	{
	?> 
        	
       <?php } ?>
           <li>
            <div class="boxicon"><a href="pages/teacher/marks/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="pages/teacher/marks/index.php?flag=<?=$flag?>">Marks Management</a></div>
          </li>
            
            
		</ul>
         
    </div>
    
    
    
  <?php
	if($user_type=='SU')
	{
	?>   
    <div id="admin_sec" class="wblock">
      <h1>ADMIN MANAGEMENT SECTION </h1>
      <hr/>
     
      	<ul class="boxlist">
       		 <li>
            <div class="boxicon"><a href="admin/user/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/user/index.php?flag=<?=$flag?>">ADD USER</a></div>
          </li>
          
          <li>
            <div class="boxicon"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/teacher/index.php?flag=<?=$flag?>&amp;staff=teach">ADD NEW STAFF</a></div>
          </li>
            <li>
            <div class="boxicon"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/store/index.php?stock=study&flag=<?=$flag?>">ADD NEW STOCK ITEM</a></div>
          </li>
          
        	<li>
            <div class="boxicon"><a href="admin/caste/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/caste/index.php?flag=<?=$flag?>">CAST</a></div>
          </li>
            
        	<li>
            <div class="boxicon"><a href="admin/religion/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/religion/index.php?flag=<?=$flag?>">RELIGION</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="admin/course/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/course/index.php?flag=<?=$flag?>">COURSE</a></div>
          </li>
            
            <li>
            <div class="boxicon"><a href="admin/qualification/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/qualification/index.php?flag=<?=$flag?>">QUALIFICATION</a></div>
          </li>
                       
            <li>
            <div class="boxicon"><a href="admin/duration/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/duration/index.php?flag=<?=$flag?>">COURSE DURATION</a></div>
          </li>
    
            <li>
            <div class="boxicon"><a href="admin/subject/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/subject/index.php?flag=<?=$flag?>">SUBJECT</a></div>
          </li>
            
             <li>
            <div class="boxicon"><a href="admin/sub_allocate/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/sub_allocate/index.php?flag=<?=$flag?>">TEACHER-SUBJECT ALLOCATION</a></div>
          </li>
            
             <li>
            <div class="boxicon"><a href="admin/stu_allocate/index.php?flag=<?=$flag?>"><img src="images/icon-distribution.png" alt="Student Enquiry Details" /></a></div>
            <div class="boxtitle"><a href="admin/stu_allocate/index.php?flag=<?=$flag?>">TEACHER-STUDENT ALLOCATION</a></div>
          </li>
            
		</ul>
       
    </div>
<?php }?>
      
    



</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	<div class="fflt">Copyright &copy; 2016 Webosys Technologies All Rights Reserved</div>
        <div class="ffrt"><a href="common/developer.php?flag=non">Designed &amp; Developed by Webosys Technologies</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
</html>