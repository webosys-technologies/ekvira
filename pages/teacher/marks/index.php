<?php error_reporting(0);
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
<script src="../../../js/jquery-1.8.2.min.js"></script>
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
<script type="text/javascript" src="../../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" />
<link href="../../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../../js/sitevalid.js"></script>

<script type="application/x-javascript"> 
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
</script>

<!-- InstanceEndEditable -->

<link rel="stylesheet" href="../../../css/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme">
<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css">
<link href="../../../css/print_specific.css" rel="stylesheet" type="text/css" media="print">

    <link rel="stylesheet" href="http://sdgeneration.in/demo/school/pages/exam/marks/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://bootsnipp.com/dist/bootsnipp.min.css?ver=7d23ff901039aef6293954d33d23c066">

<style type="text/css">
.thstyle{
    width:100%;
}
.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}


    <!--
body {
	background-image: url(../../../images/body.jpg);
}
-->
</style></head>

<body style="margin-top:0px;">
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->StudentMarksEntry<!-- InstanceEndEditable --></strong></p>
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
<!--       	<table width="100%" cellpadding="0" cellspacing="0" style="padding:0 0px 0px 0px;">
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
        </table> -->
         
       </div>
      
       
        <div class="main-wrapper">
        <h2>STUDENT MARKS ENTRY ( <span class="form-required">
          <?=$rowCount ?> 
          Students</span>  )
        </h2>
        <!--<div class="print_button"><a href="#" class="button" onclick="window.print();">Print</a></div>-->
                
        
        <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">STUDENT ENTRY</h3>
                
            </div>
            
            <table class="table" style="width:100%">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="thstyle" placeholder="#"></th>
                        <th><input type="text" class="thstyle" placeholder="Student Id"></th>
                        <th><input type="text" class="thstyle" placeholder="Student Name"></th>
                        <th><input type="text" class="thstyle" placeholder="Contact No."></th>
                        
                        <th><input type="text" class="thstyle" placeholder="Class"></th>
                        <th><input type="text" class="thstyle" placeholder="Section"></th>
                        <th><input type="text" class="thstyle" placeholder="DOB"></th>
                        <th><input type="text" class="thstyle" placeholder="Action"></th>
                        
                    </tr>
                </thead>
			 <tbody>
            
             
<!--                                <tr style="text-transform: uppercase; display: table-row;">
                                    <td><input type="checkbox"><?=$clcnt?></td>
                                    <td>2016119</td>
                                    <td>maddy loe tiger</td>
                                    <td>1234567890</td>
                                    <td>11</td>
                                    <td>C</td>
                                    <td><a href="http://sdgeneration.in/demo/school/pages/exam/marks/add.php" type="button">Add Marks</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://sdgeneration.in/demo/school/pages/exam/marks/add.php" type="button">Print</a></td>
                                </tr>-->
                             
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
					$course = $row_prov['course_id'];
					$section = $row_prov['section_id'];
					echo '<td>'.$course.' </td>';
					echo '<td>'.$section.' </td>';
					$b_cnt++;
				}
			?>          
            
                    
            <td><?=$prov_date?></td>
        
             
            
            <td><a href="stu-profile.php?prov_id=<?=$id?>" type="button">Add Marks</a></td>
                
            </tr>
             <?php
				}?>
                    
                                     </tbody>
            </table>
        </div>
    </div>
        
        
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
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>



 <script src="../../../js/jquery-1.11.0.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/scripts.min.js"></script>
<script type="text/javascript">
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
    
</body>
<!-- InstanceEnd --></html>
