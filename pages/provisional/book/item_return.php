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
<title>Pre-Cadet Admission System</title>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script>
function toggle_study(source) {
  checkboxes = document.getElementsByName('books[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style><!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; Return Allocated Items<!-- InstanceEndEditable --></strong></p>
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
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					
				}
	
			}
			
		?> 
	         
        <div class="main-wrapper">
        <!-- Start Here -->
       <p align="center" class="style1"><strong>RETURN STORE ITEM </strong></p>
          
				 <?php if($flag=$_REQUEST['flag']){
                    $flag=$_REQUEST['flag'];
					//$type=$_REQUEST['type'];
                 } 
				 ?>
         
   <div align="center">   
   
   <form action="submit.php" method="post">
       
        <table width="80%" height="228" border="1" class="tbl" align="center">
          <tr>
            <td height="51"><strong>Student Name :-- </strong></td>
            <td height="51" colspan="2"><?=$fullname?></td>
          </tr>
          <tr>
            <td width="23%"><strong>Allocated Books :-</strong></td>
            <td height="94" colspan="2">
            <table width="90%" border="0" class="tbl" align="center">
              <thead>
                <tr>
                  <th width="5%"><p> All</p>
    <p>
      <input id="select_all" type="checkbox" onClick="toggle_study(this)" />
    </p></th>
                  <th width="30%">Item Name</th>
                  <th width="24%">Publication</th>
                  <th width="24%">Other</th>
                </tr>
              </thead>
              <tbody class='ms'>
                <?php
		  $condition2=" ORDER BY id DESC";	
				$que="SELECT * FROM stu_book $condition2"; 
				if (!($page_res = $con->query($que))) 
				{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows;
				$nothaving=0;
				while($row_store=$page_res->fetch_assoc())
				{ 
					$book_id=$row_store['id'];
										
				$query_study = sprintf("SELECT * FROM stu_prov_book WHERE prov_id='%d' and book_id='%d' and return_date IS NULL", $id, $book_id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
					if(	$rowCount1>0)
					{	
					$nothaving=1;			
 			?>
                <tr>
                  <td><input name="books[]" type="checkbox" value="<?=$row_store['id']?>" /></td>
                  <td><div align="center">
                      <?=$row_store['book_name']?>
                  </div></td>
                  <td><div align="center">
                      <?=$row_store['publication']?>
                  </div></td>
                  <td><div align="center">
                      <?=$row_store['other']?>
                  </div></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
            <?php if($nothaving!=1){ ?>
                <input type="hidden" name="books[]" value="" />
              <font color="#FF0000"><b>NO </B><strong>Books</strong><b> Are Allocated</B></font>
              <?php		
			  		  }  
                ?>            </td>
          </tr>
          <tr>
            <td height="73"></td>
            <td width="66%" height="73"><p align="center">
                <input type="submit" value="Return Item" class="button" />
            </p></td>
            <td width="11%"><?php
			if($mode=='new'){
			?>
            <a href="../view.php?id=<?=$id?>&flag=non&mode=<?=$mode?>" class="button">Skip </a>
            <?php }else{ ?>
             <a href="index.php?flag=back" class="button">Back</a>
            <?php } ?></td>
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="hidden" name="stock_type" value="return" />
            <input type="hidden" name="mode" value="<?=$mode?>" />
            <!--<td width="25%"><p align="center"><a href="view.php?id=<?=$id?>&flag=non" class="button">Save and Proceed</a></p>-->
          </tr>
        </table>
        <p>&nbsp;</p>
        
        </form>
        </div>
        <!-- End -->
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
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
