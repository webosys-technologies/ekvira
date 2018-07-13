<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admission Management System</title>
<link href="../css/style-sms.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(../images/body.jpg);
}
-->
</style>

	

</head>

<body>
<div class="header">
	<div class="wrapper">
    	<div class="logo"><img src="../images/logo.png" alt="Logo" /></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="../images/logotext.png" alt="subscription-management-system" /></div>
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
          header ("location: index.php");
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
        <h2 class="ico-dash"><a href="../dashboard.php?flag=all"><img src="../images/dashboard.png" alt="" align="absmiddle" /> Dashboard</a></h2>
        
        <h2 class="ico-rt"><a href="../logout.php"><img src="../images/logout.png" alt="Logout" title="Logout" /></a></h2>
        <h2 class="ico-rt"><a href="user/edit.php?id=<?=$user_id?>"><img src="../images/changepswd.png" alt="Change Password" title="Change Password"/></a></h2>
   	  </div>
  <div class="boxinner">
        	<p>You are here &raquo; <strong>Admin</strong></p>
        </div>
    </div>
    
    
    <ul class="boxlist">
			
     			<li>
                <div class="boxicon"><a href="user/index.php?flag=non"><img src="../images/icon-subscription.png" alt="Update own Subscription details" /></a></div>
                <div class="boxtitle"><a href="user/index.php?flag=non">User Management</a></div>
     			</li>
				
                <li>
                <div class="boxicon"><a href="caste/index.php?flag=non"><img src="../images/icon-company.png" alt="Caste Management" /></a></div>
                <div class="boxtitle"><a href="caste/index.php?flag=non">Caste Management</a></div>
     			</li>
                
               
                
                <li>
                <div class="boxicon"><a href="religion/index.php?flag=non"><img src="../images/icon-history.png" alt="Religion Management" /></a></div>
                <div class="boxtitle"><a href="religion/index.php?flag=non">Religion Management</a></div>
      </li>                       
      
      <li>
                <div class="boxicon"><a href="course/index.php?flag=non"><img src="../images/icon-history.png" alt="Course Management" /></a></div>
                <div class="boxtitle"><a href="course/index.php?flag=non">Course Management</a></div>
      </li>     
      
      <li>
                <div class="boxicon"><a href="qualification/index.php?flag=non"><img src="../images/icon-history.png" alt="Qualification Management" /></a></div>
                <div class="boxtitle"><a href="qualification/index.php?flag=non">Qualification Management</a></div>
      </li>
            
      <li>
                <div class="boxicon"><a href="duration/index.php?flag=non"><img src="../images/icon-history.png" alt="Course Duration" /></a></div>
                <div class="boxtitle"><a href="duration/index.php?flag=non">Course Duration</a></div>
      </li>
      
      <li>
                <div class="boxicon"><a href="store/index.php?stock=study&flag=non"><img src="../images/icon-history.png" alt="store item" /></a></div>
                <div class="boxtitle"><a href="store/index.php?stock=study&flag=non">Store Item</a></div>
      </li>
      
       <li>
                <div class="boxicon"><a href="library/index.php?flag=non"><img src="../images/icon-history.png" alt="store item" /></a></div>
                <div class="boxtitle"><a href="library/index.php?flag=non">Library Book</a></div>
      </li>
      
      <li>
                <div class="boxicon"><a href="teacher/index.php?staff=teach&flag=non"><img src="../images/icon-history.png" alt="store item" /></a></div>
                <div class="boxtitle"><a href="teacher/index.php?staff=teach&flag=non">Faculty Management</a></div>
      </li>
       <li>
                <div class="boxicon"><a href="subject/index.php?flag=non"><img src="../images/icon-history.png" alt="subject" /></a></div>
                <div class="boxtitle"><a href="subject/index.php?flag=non">Subject Management</a></div>
      </li>
      
      <li>
                <div class="boxicon"><a href="sub_allocate/index.php?flag=non"><img src="../images/icon-history.png" alt="subject allocation" /></a></div>
                <div class="boxtitle"><a href="sub_allocate/index.php?flag=non">Teacher-Subject Allocation Management</a></div>
      </li>
      
       <li>
                <div class="boxicon"><a href="stu_allocate/index.php?flag=non"><img src="../images/icon-history.png" alt="subject allocation" /></a></div>
                <div class="boxtitle"><a href="stu_allocate/index.php?flag=non">Teacher-Student Allocation Management</a></div>
      </li>
               
    </ul>



</div>
<!-- Main Body End -->
</div>

<div class="footer">
	<div class="wrapper">
    	<div class="fflt">Copyright &copy; 2014 SHS. All Rights Reserved</div>
        <div class="ffrt"><a href="http://www.webosys.com/">Designed &amp; Developed by Webosys Technologies</a></div>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>
