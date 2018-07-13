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
	$update="SELECT * FROM stu_provisional WHERE status=1";
	if (!($updres = $con->query($update))){ echo "FOR QUERY: $update<BR>".$con->error; 	exit;}
	$rowCount = $con->affected_rows;
	if($rowCount>0){
		while($rowscheck=$updres->fetch_assoc())
		{
				$upid=$rowscheck['prov_id'];
				$adm_date=$rowscheck['prov_date'];
				$d_id=$rowscheck['duration_id'];
					$query_d = sprintf("SELECT * FROM stu_duration WHERE d_id='%d'", $d_id);
					if (!($result_d = $con->query($query_d))) 
					{ echo "FOR QUERY: $query_d<BR>".$con->error; 	exit;}
					$row_d = $result_d->fetch_assoc();
					$duration = $row_d['duration'];
				if($duration=1){
					$coursedays=30;
				}
				if($duration=6){
					$coursedays=180;
				}
				if($duration=12){
					$coursedays=360;
				}
				$current_date=date('Y-m-d');
				$t1 = strtotime($current_date);
				$t2 = strtotime($adm_date);
				$diff = abs($t1 - $t2)/3600;
				$days = $diff/24;
				$noofdays = floor($days)+1;
				
				if($noofdays>=$coursedays){
					$upgrade="UPDATE stu_provisional SET status=0 WHERE prov_id=".$upid;
					if (!($upgres = $con->query($upgrade))){ echo "FOR QUERY: $upgrade<BR>".$con->error; 	exit;}
				}
		
		}
	}


	 if(isset($_POST['type'])){
	  		$search=$_POST['search'];
	  	 $condition2=" ORDER BY prov_id DESC";	
		 $que="SELECT * FROM stu_provisional WHERE status=1 and fname like '%$search%' or mname like '%$search%' or lname like '%$search%' $condition2";
		 $flag='all';
	  }else{
	  	 $condition2=" ORDER BY prov_id DESC";	
		$que="SELECT * FROM stu_provisional WHERE status=1 $condition2";
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
<script src="../../js/jquery-1.8.2.min.js"></script>
<script>
$(document).ready(function(){ 
function removeHighlighting(highlightedElements){
    highlightedElements.each(function(){
        var element = $(this);
        element.replaceWith(element.html());
    })
}

function addHighlighting(element, textToHighlight){
    var text = element.text();
    var highlightedText = '<em>' + textToHighlight + '</em>';
    var newText = text.replace(textToHighlight, highlightedText);
    
    element.html(newText);
}

$("#search").on("keyup", function() {
    var value = $(this).val();
    
    removeHighlighting($("table tr em"));

    $("table tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);
            
            var $tdElement = $row.find("td:first");
            var id = $tdElement.text();
            var matchedIndex = id.indexOf(value);
            
            if (matchedIndex != 0) {
                $row.hide();
            }
            else {
                addHighlighting($tdElement, value);
                $row.show();
            }
        }
    });
});
});
</script>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sitevalid.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../../images/body.jpg);
}
-->
th,tr{
    padding:0px !important;
    font-size: 13px;
}
th,td{
    text-align: center;
}

a:link{
    color:#ffffff;
}
a:visited{
    color:#ffffff;
}
table.tbl td{
    padding: 3px 0px;
  border-left: 1px solid #a5c9e3;
  border-bottom: 1px solid #a5c9e3;
}
.main-wrapper {
  background-color: #FFFFFF;
  padding: 15px 5px 15px 5px;
}
a:hover{
    text-decoration: none;
}
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Provisional Registration<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
         <?php
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       <div class="add_button">
       	<table width="100%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
   	    <tr>
   	      <form action="index.php?flag=non" method="post"><input type="hidden" name="type" value='yes'  />
          <td width="39%" align="center" valign="middle">            <input type="text" class="input-text" name="search" id="search" placeholder=" live search" />          </td>
           	  <td width="12%" align="center" valign="middle">           	    <input type="submit" value="SEARCH" class="button" />         	    </td></form>
            	<td width="17%"><p align="right"><a href="item/index.php?flag=non" class="button">Item Allocation</a></p></td>
            	<td width="19%">
                 <p align="right"><a href="editdocs/index.php?flag=non" class="button">Edit Student Document</a></p></td>
             <td width="13%" align="right">
                <p align="right"><a href="add.php?flag=<?=$flag?>" class="button">Add New Entry</a></p></td>  
            </tr>
        </table> 
         
       </div>
      
       
        <div class="main-wrapper">
        <h2>Student Provisional List ( <span class="form-required">
          <?=$rowCount ?> 
          Students</span>  )
        </h2>
        <div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>
        <table width="100%" border="0" class="tbl">
         <thead>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="8%">Student ID</th>
            <th width="21%">Full Name</th>
            <th width="8%">Contact No.</th>
            <th width="5%">M/F</th>
            <th width="7%">Class</th>
            <th width="6%">Caste</th>
            <th width="9%">Correspondent Address</th>
            <th width="9%">Admission Date</th>
            <th width="7%">Remark</th>
            <th width="4%">View</th>
            <th width="4%">Edit</th>
            <th width="4%">Result</th>
            <th width="3%">Delete</th>
            <th width="6%">BC</th>
            <th width="6%">TC</th>
            <th width="6%">CC</th>
            <th width="6%">AC</th>
            <th width="6%">I-Card</th>
            
            </tr>
            </thead>
			<tbody class='ms'>
            
             <?php
				$clcnt=0;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$city_id = $row_prov['city_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$remark = $row_prov['remark'];
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
					
					
					
			  ?>
          <tr  style="text-transform:uppercase;">
            <td><?=$clcnt?></td>
            <td><?php echo getstuid($row_prov['prov_date']).$id;?></td>
            <td><?=$fullname?></td>
            <td><?=$contact?></td>
            <td><?=$gender?></td>
            <td>
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
            
            <td><?=$caste?></td>
            <td><?=$addr_corespond?></td>
            <td><?=$prov_date?></td>
            <td><?=$remark?></td>
             
            <td>
            	<ul class="actions">
						<li><a href="view.php?id=<?=$id?>&flag=non&mode=new"><img src="../../images/search.png" alt="View"></a></li>
				</ul>            </td>
            <td><span class="actions"><a href="prov_edit.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if(confirm('Do you really want to edit this student?')){return true;}else{return false;}"><img src="../../images/edit.png" alt="edit" /></a></span></td>
            <td><span class="actions"><a href="prov_edit.php?flag=<?=$flag?>&id=<?=$id?>&result=true" onclick="if(confirm('Do you really want to edit this student?')){return true;}else{return false;}"><img src="../../images/edit.png" alt="edit" /></a></span></td>
            <td>
            	<ul class="actions">
                    <li><a href="del.php?flag=<?=$flag?>&id=<?=$id?>" onClick="if(confirm('Do you really want to delete this student?')){return true;}else{return false;}"><img src="../../images/trash.png" alt="delete"></a></li>
		</ul>            
            </td>
            
            <td>
            	 <button type="button" class="btn btn-primary btn-xs"><span class="actions"><a href="bonafide.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if('#submit'){return true;}else{return false;}">BC</a></span></button>           
            </td>
            <td>
            	 <button type="button" class="btn btn-info btn-xs"><span class="actions"><a href="transfer.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if('#submit'){return true;}else{return false;}">TC</a></span></button>           
            </td>
            <td>
            	 <button type="button" class="btn btn-success btn-xs"><span class="actions"><a href="character.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if('#submit'){return true;}else{return false;}">CC</a></span></button>           
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-xs"><span class="actions"><a href="admitcard.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if('#submit'){return true;}else{return false;}">AC</a></span></button>           
            </td>
            <td>
            	 <button type="button" class="btn btn-warning btn-xs"><span class="actions"><a href="icard.php?flag=<?=$flag?>&id=<?=$id?>" onclick="if('#submit'){return true;}else{return false;}">I-Card</a></span></button>           
            </td>
                
            </tr>
             <?php
				}?>
         </tbody>
        </table>
        </div>
            
        <div class="flag-msg">
         <?php if($flag=$_REQUEST['flag']){
	 		$flag=$_REQUEST['flag'];
	 }?>
		<?if($rowCount==0){?>
		<p align="center"><font color='red'><B>No Record found.</B></font></p>
		<? } ?>	
		<? if($flag=="edit"){?>
		<p align="center"><font color='red'><B>Record is edited Successfully.</B></font></p>
		<? } ?>	
		<? if($flag=="add"){?>
		<p align="center"><font color='red'><B>New Record is added successfully.</B></font></p>
		<? } ?>	
		<?if($flag=="exist"){?>
		<p align="center"><font color='red'><B>Record is already exits.</B></font></p>
		<? } ?>	
		<?if($flag=="del"){?>
		<p align="center"><font color='red'><B>Record is deleted Successfully.</B></font></p>
		<? } ?>	
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
