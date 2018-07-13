<?php
    ob_start();
    
   $print_data="";
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

         $course_id = '';
 $section_id = '';
    $prov_id = ($_GET['prov_id']);
    $query_prov = sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $prov_id);
    if (!($result_prov = $con->query($query_prov))) 
    { echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}

    $row_prov=$result_prov->fetch_assoc();
    
    $query_prov_doc = sprintf("SELECT * FROM stu_prov_document WHERE prov_id='%d'", $prov_id);
    $result_prov_doc = $con->query($query_prov_doc);
    $row_prov_doc=$result_prov_doc->fetch_assoc();
    $course_id = $row_prov['course_id'];
    $section_id = $row_prov['section_id'];
    
    
        
?>


<?php
include("../../../common/dbcontroller.php");
$db_handle2 = new DBController();
 $sql8 = "SELECT * from stu_prov_marksheet WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

 $data_marks = $db_handle2->runQuery($sql8);
 
 function retunMyGradeInfo($marks,$outof){
          
          
            if($marks!='')
            {
                $i = $outof/10;
                
                if($marks <= $outof && $marks >= $outof-($i*1))
                {
                //grade D
                return 'A1';
                }else if($marks < $outof && $marks >= $outof-($i*2))
                {
                    //grade C
                    return 'A2';
                }else if($marks < $outof-($i*2) && $marks >= $outof-($i*3))
                {
                    //grade B
                    return 'B1';
                }else if($marks < $outof-($i*3) && $marks >= $outof-($i*4))
                {
                    //grade A
                    return 'B2';
                }
                else if($marks < $outof-($i*4) && $marks >= $outof-($i*5))
                {
                    //grade A+
                    return 'C1';
                }
                else if($marks < $outof-($i*5) && $marks >= $outof-($i*6))
                {
                    //grade A+
                    return 'C2';
                }
                else if($marks < $outof-($i*6) && $marks >= $outof-($i*7))
                {
                    //grade A+
                    return 'D';
                }
                else if($marks < $outof-($i*7) && $marks >= $outof-($i*8))
                {
                    //grade A+
                    return 'E1';
                }else if($marks!= 0){
                    return 'E2';
                }
            }
 }
 //echo '<pre>'; print_r($data_marks);die;
  ?>
<?php

$db_handle3 = new DBController();
 $sql9 = "SELECT * from formative_skill WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

 $data_marks1 = $db_handle3->runQuery($sql9);
 
 //echo '<pre>'; print_r($data_marks);die;
  ?>
<?php

$db_handle4 = new DBController();
 $sql10 = "SELECT * from english_math_marks WHERE prov_id='$prov_id' and class='$course_id' and class > '3' and section='$section_id'";

 $data_marks2 = $db_handle4->runQuery($sql10);
 
 //echo '<pre>'; print_r($data_marks);die;
  ?>




<!--for pdf query-->
















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admission.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
}';?>
-->
</style>
<style type="text/css">

.table-div {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100% !important;
    border:1px solid black;
}

.table-div td, th{
    border: 1px solid black;
    text-align:center;
    padding: 3px !important;
    
}
#table-rows > td:first-child{
text-align:justify !important;
font-weight:bold;
}
.table-div th{
background-color:lightgray;
text-align:center;
}
.baseline > td{
text-align:justify;
font-weight:bold;
}
.current-row{background-color:#B24926;color:#FFF;}
			.current-col{background-color:#1b1b1b;color:#FFF;}
			.tbl-qa{width: 100%;background-color: #f5f5f5;border-collapse: collapse;margin-bottom: 20px;}
			.tbl-qa th.table-header {padding:5px;border: 1px solid black;font-size: 12px;text-align: center;}
			.tbl-qa .table-row td {padding:3px;pxbackground-color: #FDFDFD;border: 1px solid black;text-align: center;}
			.table-head{background-color: #D3D3D3;}
                        .td-color{background-color: #D3D3D3 !important;font-weight: bold;font-size: 12px;text-align: center;}
                        #rightPanel{margin-bottom: 0px;}
    .tdgcell
        {
            font-size: 13px;
            color: #000000;
            font-align:center;
        }
</style>

<?
$print_data.='
<style type="text/css">

.table-div {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border:1px solid black;
}

.table-div td, th {
    border: 1px solid black;
    text-align: left;
    
    
}
.table-div th{
background-color:lightgray;
text-align:center;
}

.table-div {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100% !important;
    border:1px solid black;
}

.table-div td, th{
    border: 1px solid black;
    text-align:center;
    }
  th{
      font-size:12px !important;
   }  
  td{
      font-size:12px !important;
   }  

#table-rows > td:first-child{
text-align:justify !important;
font-weight:bold;
}

.table-div th{
background-color:lightgray;
text-align:center;
}
.baseline > td{
text-align:justify;
font-weight:bold;
}
h5{
font-size:14px;
}
.current-row{background-color:#B24926;color:#FFF;}
			.current-col{background-color:#1b1b1b;color:#FFF;}
			.tbl-qa{width: 100%;background-color: #f5f5f5;border-collapse: collapse;margin-bottom: 20px;}
			.tbl-qa th.table-header {padding:5px;border: 1px solid black;text-align: center;}
			.tbl-qa .table-row td {padding:3px;pxbackground-color: #FDFDFD;border: 1px solid black;text-align: center;}
			.table-head{background-color: #D3D3D3;}
                        .td-color{background-color: #D3D3D3 !important;font-weight: bold;text-align: center;}
                        #rightPanel{margin-bottom: 0px;}
    .tdgcell
        {
            
            color: #000000;
            font-align:center;
        }
.panel{margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}.panel-body{padding:15px}.panel-heading{padding:10px 15px;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px}.panel-heading>.dropdown .dropdown-toggle{color:inherit}.panel-title{margin-top:0;margin-bottom:0;font-size:12px;color:inherit}.panel-title>.small,.panel-title>.small>a,.panel-title>a,.panel-title>small,.panel-title>small>a{color:inherit}.panel-footer{padding:10px 15px;background-color:#f5f5f5;border-top:1px solid #ddd;border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.list-group,.panel>.panel-collapse>.list-group{margin-bottom:0}.panel>.list-group .list-group-item,.panel>.panel-collapse>.list-group .list-group-item{border-width:1px 0;border-radius:0}.panel>.list-group:first-child .list-group-item:first-child,.panel>.panel-collapse>.list-group:first-child .list-group-item:first-child{border-top:0;border-top-left-radius:3px;border-top-right-radius:3px}.panel>.list-group:last-child .list-group-item:last-child,.panel>.panel-collapse>.list-group:last-child .list-group-item:last-child{border-bottom:0;border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.panel-heading+.panel-collapse>.list-group .list-group-item:first-child{border-top-left-radius:0;border-top-right-radius:0}.panel-heading+.list-group .list-group-item:first-child{border-top-width:0}.list-group+.panel-footer{border-top-width:0}.panel>.panel-collapse>.table,.panel>.table,.panel>.table-responsive>.table{margin-bottom:0}.panel>.panel-collapse>.table caption,.panel>.table caption,.panel>.table-responsive>.table caption{padding-right:15px;padding-left:15px}.panel>.table-responsive:first-child>.table:first-child,.panel>.table:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child,.panel>.table:first-child>thead:first-child>tr:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:first-child,.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child td:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child th:first-child,.panel>.table:first-child>thead:first-child>tr:first-child td:first-child,.panel>.table:first-child>thead:first-child>tr:first-child th:first-child{border-top-left-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:last-child,.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:last-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:last-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:last-child,.panel>.table:first-child>tbody:first-child>tr:first-child td:last-child,.panel>.table:first-child>tbody:first-child>tr:first-child th:last-child,.panel>.table:first-child>thead:first-child>tr:first-child td:last-child,.panel>.table:first-child>thead:first-child>tr:first-child th:last-child{border-top-right-radius:3px}.panel>.table-responsive:last-child>.table:last-child,.panel>.table:last-child{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:first-child,.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:first-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:first-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:first-child,.panel>.table:last-child>tbody:last-child>tr:last-child td:first-child,.panel>.table:last-child>tbody:last-child>tr:last-child th:first-child,.panel>.table:last-child>tfoot:last-child>tr:last-child td:first-child,.panel>.table:last-child>tfoot:last-child>tr:last-child th:first-child{border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:last-child,.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child td:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child th:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child td:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child th:last-child{border-bottom-right-radius:3px}.panel>.panel-body+.table,.panel>.panel-body+.table-responsive,.panel>.table+.panel-body,.panel>.table-responsive+.panel-body{border-top:1px solid #ddd}.panel>.table>tbody:first-child>tr:first-child td,.panel>.table>tbody:first-child>tr:first-child th{border-top:0}.panel>.table-bordered,.panel>.table-responsive>.table-bordered{border:0}.panel>.table-bordered>tbody>tr>td:first-child,.panel>.table-bordered>tbody>tr>th:first-child,.panel>.table-bordered>tfoot>tr>td:first-child,.panel>.table-bordered>tfoot>tr>th:first-child,.panel>.table-bordered>thead>tr>td:first-child,.panel>.table-bordered>thead>tr>th:first-child,.panel>.table-responsive>.table-bordered>tbody>tr>td:first-child,.panel>.table-responsive>.table-bordered>tbody>tr>th:first-child,.panel>.table-responsive>.table-bordered>tfoot>tr>td:first-child,.panel>.table-responsive>.table-bordered>tfoot>tr>th:first-child,.panel>.table-responsive>.table-bordered>thead>tr>td:first-child,.panel>.table-responsive>.table-bordered>thead>tr>th:first-child{border-left:0}.panel>.table-bordered>tbody>tr>td:last-child,.panel>.table-bordered>tbody>tr>th:last-child,.panel>.table-bordered>tfoot>tr>td:last-child,.panel>.table-bordered>tfoot>tr>th:last-child,.panel>.table-bordered>thead>tr>td:last-child,.panel>.table-bordered>thead>tr>th:last-child,.panel>.table-responsive>.table-bordered>tbody>tr>td:last-child,.panel>.table-responsive>.table-bordered>tbody>tr>th:last-child,.panel>.table-responsive>.table-bordered>tfoot>tr>td:last-child,.panel>.table-responsive>.table-bordered>tfoot>tr>th:last-child,.panel>.table-responsive>.table-bordered>thead>tr>td:last-child,.panel>.table-responsive>.table-bordered>thead>tr>th:last-child{border-right:0}.panel>.table-bordered>tbody>tr:first-child>td,.panel>.table-bordered>tbody>tr:first-child>th,.panel>.table-bordered>thead>tr:first-child>td,.panel>.table-bordered>thead>tr:first-child>th,.panel>.table-responsive>.table-bordered>tbody>tr:first-child>td,.panel>.table-responsive>.table-bordered>tbody>tr:first-child>th,.panel>.table-responsive>.table-bordered>thead>tr:first-child>td,.panel>.table-responsive>.table-bordered>thead>tr:first-child>th{border-bottom:0}.panel>.table-bordered>tbody>tr:last-child>td,.panel>.table-bordered>tbody>tr:last-child>th,.panel>.table-bordered>tfoot>tr:last-child>td,.panel>.table-bordered>tfoot>tr:last-child>th,.panel>.table-responsive>.table-bordered>tbody>tr:last-child>td,.panel>.table-responsive>.table-bordered>tbody>tr:last-child>th,.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>td,.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>th{border-bottom:0}.panel>.table-responsive{margin-bottom:0;border:0}.panel-group{margin-bottom:20px}.panel-group .panel{margin-bottom:0;border-radius:4px}.panel-group .panel+.panel{margin-top:5px}.panel-group .panel-heading{border-bottom:0}.panel-group .panel-heading+.panel-collapse>.list-group,.panel-group .panel-heading+.panel-collapse>.panel-body{border-top:1px solid #ddd}.panel-group .panel-footer{border-top:0}.panel-group .panel-footer+.panel-collapse .panel-body{border-bottom:1px solid #ddd}.panel-default{border-color:#ddd}.panel-default>.panel-heading{color:#333;background-color:#f5f5f5;border-color:#ddd}.panel-default>.panel-heading+.panel-collapse>.panel-body{border-top-color:#ddd}.panel-default>.panel-heading .badge{color:#f5f5f5;background-color:#333}.panel-default>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#ddd}.panel-primary{border-color:#337ab7}.panel-primary>.panel-heading{color:#fff;background-color:#337ab7;border-color:#337ab7}.panel-primary>.panel-heading+.panel-collapse>.panel-body{border-top-color:#337ab7}.panel-primary>.panel-heading .badge{color:#337ab7;background-color:#fff}.panel-primary>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#337ab7}.panel-success{border-color:#d6e9c6}.panel-success>.panel-heading{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.panel-success>.panel-heading+.panel-collapse>.panel-body{border-top-color:#d6e9c6}.panel-success>.panel-heading .badge{color:#dff0d8;background-color:#3c763d}.panel-success>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#d6e9c6}.panel-info{border-color:#bce8f1}.panel-info>.panel-heading{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}.panel-info>.panel-heading+.panel-collapse>.panel-body{border-top-color:#bce8f1}.panel-info>.panel-heading .badge{color:#d9edf7;background-color:#31708f}.panel-info>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#bce8f1}.panel-warning{border-color:#faebcc}.panel-warning>.panel-heading{color:#8a6d3b;background-color:#fcf8e3;border-color:#faebcc}.panel-warning>.panel-heading+.panel-collapse>.panel-body{border-top-color:#faebcc}.panel-warning>.panel-heading .badge{color:#fcf8e3;background-color:#8a6d3b}.panel-warning>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#faebcc}.panel-danger{border-color:#ebccd1}.panel-danger>.panel-heading{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.panel-danger>.panel-heading+.panel-collapse>.panel-body{border-top-color:#ebccd1}.panel-danger>.panel-heading .badge{color:#f2dede;background-color:#a94442}.panel-danger>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#ebccd1}.embed-responsive{position:relative;display:block;height:0;padding:0;overflow:hidden}.embed-responsive .embed-responsive-item,.embed-responsive embed,.embed-responsive iframe,.embed-responsive object,.embed-responsive video{position:absolute;top:0;bottom:0;left:0;width:100%;height:100%;border:0}.embed-responsive-16by9{padding-bottom:56.25%}.embed-responsive-4by3{padding-bottom:75%}.well{min-height:20px;padding:19px;margin-bottom:20px;background-color:#f5f5f5;border:1px solid #e3e3e3;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.05);box-shadow:inset 0 1px 1px rgba(0,0,0,.05)}.well blockquote{border-color:#ddd;border-color:rgba(0,0,0,.15)}.well-lg{padding:24px;border-radius:6px}.well-sm{padding:9px;border-radius:3px}.close{float:right;font-size:12px;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;filter:alpha(opacity=20);opacity:.2}.close:focus,.close:hover{color:#000;text-decoration:none;cursor:pointer;filter:alpha(opacity=50);opacity:.5}button.close{-webkit-appearance:none;padding:0;cursor:pointer;background:0 0;border:0}.modal-open{overflow:hidden}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;-o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out;-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);-o-transform:translate(0,-25%);transform:translate(0,-25%)}.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);-o-transform:translate(0,0);transform:translate(0,0)}.modal-open .modal{overflow-x:hidden;overflow-y:auto}.modal-dialog{position:relative;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5)}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}.modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.5}.modal-header{padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}.modal-body{position:relative;padding:15px}.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.modal-footer .btn-block+.btn-block{margin-left:0}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:768px){.modal-dialog{width:600px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}.modal-sm{width:300px}}@media (min-width:992px){.modal-lg{width:900px}}.tooltip{position:absolute;z-index:1070;display:block;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:12px;font-style:normal;font-weight:400;line-height:1.42857143;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;word-wrap:normal;white-space:normal;filter:alpha(opacity=0);opacity:0;line-break:auto}.tooltip.in{filter:alpha(opacity=90);opacity:.9}.tooltip.top{padding:5px 0;margin-top:-3px}.tooltip.right{padding:0 5px;margin-left:3px}.tooltip.bottom{padding:5px 0;margin-top:3px}.tooltip.left{padding:0 5px;margin-left:-3px}.tooltip-inner{max-width:200px;padding:3px 8px;color:#fff;text-align:center;background-color:#000;border-radius:4px}.tooltip-arrow{position:absolute;width:0;height:0;border-color:transparent;border-style:solid}.tooltip.top .tooltip-arrow{bottom:0;left:50%;margin-left:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.top-left .tooltip-arrow{right:5px;bottom:0;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.top-right .tooltip-arrow{bottom:0;left:5px;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.right .tooltip-arrow{top:50%;left:0;margin-top:-5px;border-width:5px 5px 5px 0;border-right-color:#000}.tooltip.left .tooltip-arrow{top:50%;right:0;margin-top:-5px;border-width:5px 0 5px 5px;border-left-color:#000}.tooltip.bottom .tooltip-arrow{top:0;left:50%;margin-left:-5px;border-width:0 5px 5px;border-bottom-color:#000}.tooltip.bottom-left .tooltip-arrow{top:0;right:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#000}.tooltip.bottom-right .tooltip-arrow{top:0;left:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#000}.popover{position:absolute;top:0;left:0;z-index:1060;display:none;max-width:276px;padding:1px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:12px;font-style:normal;font-weight:400;line-height:1.42857143;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;word-wrap:normal;white-space:normal;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.2);border-radius:6px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,.2);box-shadow:0 5px 10px rgba(0,0,0,.2);line-break:auto}.popover.top{margin-top:-10px}.popover.right{margin-left:10px}.popover.bottom{margin-top:10px}.popover.left{margin-left:-10px}.popover-title{padding:8px 14px;margin:0;font-size:12px;background-color:#f7f7f7;border-bottom:1px solid #ebebeb;border-radius:5px 5px 0 0}.popover-content{padding:9px 14px}.popover>.arrow,.popover>.arrow:after{position:absolute;display:block;width:0;height:0;border-color:transparent;border-style:solid}.popover>.arrow{border-width:11px}.popover>.arrow:after{content:"";border-width:10px}.popover.top>.arrow{bottom:-11px;left:50%;margin-left:-11px;border-top-color:#999;border-top-color:rgba(0,0,0,.25);border-bottom-width:0}.popover.top>.arrow:after{bottom:1px;margin-left:-10px;content:" ";border-top-color:#fff;border-bottom-width:0}.popover.right>.arrow{top:50%;left:-11px;margin-top:-11px;border-right-color:#999;border-right-color:rgba(0,0,0,.25);border-left-width:0}.popover.right>.arrow:after{bottom:-10px;left:1px;content:" ";border-right-color:#fff;border-left-width:0}.popover.bottom>.arrow{top:-11px;left:50%;margin-left:-11px;border-top-width:0;border-bottom-color:#999;border-bottom-color:rgba(0,0,0,.25)}.popover.bottom>.arrow:after{top:1px;margin-left:-10px;content:" ";border-top-width:0;border-bottom-color:#fff}.popover.left>.arrow{top:50%;right:-11px;margin-top:-11px;border-right-width:0;border-left-color:#999;border-left-color:rgba(0,0,0,.25)}.popover.left>.arrow:after{right:1px;bottom:-10px;content:" ";border-right-width:0;border-left-color:#fff}.carousel{position:relative}.carousel-inner{position:relative;width:100%;overflow:hidden}.carousel-inner>.item{position:relative;display:none;-webkit-transition:.6s ease-in-out left;-o-transition:.6s ease-in-out left;transition:.6s ease-in-out left}.carousel-inner>.item>a>img,.carousel-inner>.item>img{line-height:1}@media all and (transform-3d),(-webkit-transform-3d){.carousel-inner>.item{-webkit-transition:-webkit-transform .6s ease-in-out;-o-transition:-o-transform .6s ease-in-out;transition:transform .6s ease-in-out;-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-perspective:1000px;perspective:1000px}.carousel-inner>.item.active.right,.carousel-inner>.item.next{left:0;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}.carousel-inner>.item.active.left,.carousel-inner>.item.prev{left:0;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}.carousel-inner>.item.active,.carousel-inner>.item.next.left,.carousel-inner>.item.prev.right{left:0;-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}}.carousel-inner>.active,.carousel-inner>.next,.carousel-inner>.prev{display:block}.carousel-inner>.active{left:0}.carousel-inner>.next,.carousel-inner>.prev{position:absolute;top:0;width:100%}.carousel-inner>.next{left:100%}.carousel-inner>.prev{left:-100%}.carousel-inner>.next.left,.carousel-inner>.prev.right{left:0}.carousel-inner>.active.left{left:-100%}.carousel-inner>.active.right{left:100%}.carousel-control{position:absolute;top:0;bottom:0;left:0;width:15%;font-size:12px;color:#fff;text-align:center;text-shadow:0 1px 2px rgba(0,0,0,.6);background-color:rgba(0,0,0,0);filter:alpha(opacity=50);opacity:.5}.carousel-control.left{background-image:-webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-o-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,.0001)));background-image:linear-gradient(to right,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);
</style>'?>
<style type="text/css">
<!--
.style4 {font-size: x-large}
-->
</style>
<!-- InstanceEndEditable -->

<script type="text/javascript" src="../../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../../js/daterangepicker.jQuery.js"></script>

<link rel="stylesheet" href="../../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" />
<?php
    $print_data.='<html><head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><style><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" /></style></head><body>'
;?>
<link href="../../../css/print_specific.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../../../js/sitevalid.js"></script>
<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="../../../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="jspdf.min.js"></script>
        <script type="text/javascript" src="html2canvas.js"></script>
        <script type="text/javascript"> 
            function genPDF()
            {
                html2canvas(document.getElementById("result"),{
                   onrendered: function(canvas){
                       
                       
                       var img=canvas.toDataURL("image/jpeg",1.0);
                       
                       var doc=new jsPDF();
                       doc.add
                       doc.addImage(img,"JPEG", 0, 0, 210, 200);
                       
                        //window.open(
                        doc.save("test.pdf");
                      
                   }
                    
                });
                                 
            }
            
            
        </script>
        
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
<?php
$print_data.='<div">
<!--Main Body -->
<div>';?>
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" --><a href="index.php?flag=non">Home</a> &raquo; View Student Details<!-- InstanceEndEditable --></strong>
                    <div align="right">
                    <input type="button" onclick="window.print();" class="button" value="Print" align="right" />
                    <!--<input type="button" onclick="javascript:genPDF();" class="button" value="PDF"  align="right"/>-->
                    <?php $link=  sprintf("stu-result1.php?prov_id=%d&pdf=true",$prov_id);
                            
                            ?>
                    <a href='<?=$link;?>' class="button" align="right"/>PDF</a>
                    </div>
                </p>
                
      </div>
    </div>
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
    
    <?php
    
    $print_data.='
    <div>
    	<div>
        <!-- InstanceBeginEditable name="main" -->
       ';?>
         <?php
                
	         $id = $_GET['prov_id'];
		
        if($id > 0)
        {
        $fullname="";
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
					$address=$row_prov['addr_premanent'];
					$dob = dateformate($row_prov['dob']);
					
					
					
					
				}
                                
                           
			 
	   ?>
        <?php
        $stu_master1=sprintf("SELECT * FROM stu_term_marks where stu_id='%d'",$id); 
                           $page_res_stu = $con->query($stu_master1);
                           $stu_data1=$page_res_stu->fetch_assoc();
                           $present_days=$stu_data1['present_days'];
                           $working_days=$stu_data1['working_days'];
        //$mark_data[]="";
        $stu_prov=sprintf("SELECT * FROM stu_provisional where prov_id='%d'",$id); 
        $page_res = $con->query($stu_prov);
        $data=$page_res->fetch_assoc();
        
//        $mark_data=$page_res_marks->fetch_assoc();
//        $subject_master=sprintf("SELECT * FROM subject_master where sub_id='%d'",$mark_data['subject']); 
//        $page_res_subject = $con->query($subject_master);
//        $subject_data=$page_res_subject->fetch_assoc();
//        echo '<pre>';
//        while($mark_data=$page_res_marks->fetch_assoc())
//        print_r($mark_data['skill']);
//        die;
       
        $print_data.='<div>
        <div >';?>
            <?php
          
            }?>
        
        
        <?php
			  
				$clcnt=0;
				while($row_t_sub=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_t_sub['t_s_id'];
					$teacher_id=$row_t_sub['teacher_id'];
					$sub_id=$row_t_sub['sub_id'];
					$username=$row_t_sub['username'];

					
					$query_teacher = sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $teacher_id);
					if (!($result_teacher = $con->query($query_teacher))) 
					{ echo "FOR QUERY: $query_teacher<BR>".$con->error; 	exit;}
					$row_teacher = $result_teacher->fetch_assoc();
					$teacher = $row_teacher['name'];
					$contact =  $row_teacher['contact'];
					
					$query_sub = sprintf("SELECT * FROM stu_subject WHERE sub_id='%d'", $sub_id);
					if (!($result_sub = $con->query($query_sub))) 
					{ echo "FOR QUERY: $query_sub<BR>".$con->error; 	exit;}
					$row_sub = $result_sub->fetch_assoc();
					$subject = $row_sub['subject'];
					
			  ?>
        <?php
				}?>
        
     <div class="main-wrapper">
         <div>
       <div class="row" id="result">
        <div class="col-xs-12">
            <div class="panel panel-primary">
               
                
                <div class="panel-body" id="result_print">
                            <div class="logo-result">
            <img src="../../../images/only-logo.png" alt="Logo" height="150px" width="150px"/>
        </div>
          <h4 align="center"style="color:firebrick">EKVIRA SCHOOL OF BRILLIANTS MORSHI(MH) </h4>
        <h4 align="center"style="color:firebrick">WEBS-www.esob.co.in; CN-8550991135; 07228-222025; </br>email: ekvira_school@rediffmail.com; chavhan_tushar@yahoo.com; helpdesk@esob.co.in <br />First Terminal Assisment Report</br>SESSION-2015-2016<br />CLASS:<? echo $data['course_id'].' ('.$data['section_id'].')'?></h4>
        
         <div class="panel panel-primary">
            <div class="panel-heading">Students Details:</div>
            <div><table width="100%" style="background-color:#DCDCDC;">
                <tr><td width="50%">
            <div class="stu-details-show-left">
                <table width="50%">
                    <tr><td width="50%"><h5 style="font-weight: bold;" align="left">Student Name:</h5></td><td width="50%"><h5 align="left"><? echo $fullname ?></h5></td></tr>
                    <tr><td><h5 align="left" style="font-weight: bold;">Mothers Name:</h5></td><td><h5 align="left"><? echo $mother?></h5></td>
                        <tr><td><h5 align="left" style="font-weight: bold;">Working Days:</h5></td><td><h5 align="left"><? echo $working_days?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Present Days:</h5></td><td><h5 align="left"><? echo $present_days?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Contact No:</h5></td><td><h5 align="left"><?php echo $row_prov['contact'] ?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Classteacher's Name:</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
            </div></td><td width="50%">
                
            <div class="stu-details-show-right">
                
                <table width="100%">
                    <tr><td><h5 align="left" style="font-weight: bold;">Admission-No:</h5></td><td><h5 align="left"><? echo $data['prov_id']?></h5></td></tr>
                    
                        <tr ><td><h5 align="left" style="font-weight: bold;">Roll No:</h5></td><td><h5 align="left"><? echo $id?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Address:</h5></td><td><h5><? echo $address?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Date:</h5></td><td><h5 align="left"><? echo $data['prov_date']?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">DOB:</h5></td><td><h5 align="left"><? echo $dob?></h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Avg:</h5></td><td><h5 align="left" id="avg_result"></h5></td></tr>
                </table>
            </div>
            </td></tr></table></div>
          </div>
       
                </div>
                    <ul class="list-group">

          
        
        
			
      
   <?php
    $print_data.='
            
            <div>
        <div>
            <div>
            <div>
            <div style="float: left; padding:5px 5px 5px 5px;">
           <img src="../../../images/only-logo.png" alt="Logo" height="150px" width="150px"/>
            
        </div>
        <div style="align:center font-size:20px">
        
          <h4 align="center" style="color:firebrick">EKVIRA SCHOOL OF BRILLIANTS MORSHI(MH) </h4>
        <h4 align="center"style="color:firebrick">WEBS-www.esob.co.in; CN-8550991135; 07228-222025; </br>email: ekvira_school@rediffmail.com; chavhan_tushar@yahoo.com; helpdesk@esob.co.in <br />First Terminal Assisment Report</br>SESSION-2015-2016<br />CLASS:'.$data['course_id'].' ('.$data['section_id'].')</h4>
            
</div>
        <hr>
        <div class="panel panel-primary">
            <div class="panel-heading"><b>Students Details :</b></div>
            
            <div><table width="100%" style="background-color:#DCDCDC;">
                <tr><td width="50%">
            <div class="stu-details-show-left">
                <table>
                    <tr><td><h5 style="font-weight: bold;" align="left">Student Name:</h5></td><td><h5 align="left">'.$fullname.'</h5></td></tr>
                    <tr><td><h5 align="left" style="font-weight: bold;">Mothers Name:</h5></td><td><h5 align="left">'.$mother.'</h5></td>
                        <tr><td><h5 align="left" style="font-weight: bold;">Working Days:</h5></td><td><h5 align="left">'.$working_days.'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Present Days:</h5></td><td><h5 align="left">'.$present_days.'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Contact No:</h5></td><td><h5 align="left">'.$row_prov['contact'].'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Classteacher\'s Name:</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
            </div></td><td width="50%">
                
            <div class="stu-details-show-right">
                
                <table width="100%">
                    <tr><td><h5 align="left" style="font-weight: bold;">Admission-No:</h5></td><td><h5 align="left">'.$data['prov_id'].'</h5></td></tr>
                    
                        <tr ><td><h5 align="left" style="font-weight: bold;">Roll No:</h5></td><td><h5 align="left">'.$id.'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Address:</h5></td><td><h5>'.$address.'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Date:</h5></td><td><h5 align="left">'.$data['prov_date'].'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">DOB:</h5></td><td><h5 align="left">'.$dob.'</h5></td></tr>
                        <tr><td><h5 align="left" style="font-weight: bold;">Avg:</h5></td><td><h5 align="left" id="avg_result"></h5></td></tr>
                </table>
            </div>
            </td></tr></table></div>
           
        </div>
        <hr>
        
                </div>
                    ';
   
    ?>
        <!-- InstanceEndEditable -->
      </div>
        </div>
    </div>

</div>
<!-- Main Body End -->

    <?php $print_data.='
</body>
</html>';?>


<script>
    $(document).ready(function(){
        $('#avg_result').text(<?php echo $avg_result?>+'%'); 
    });
       
</script>
             
            
                
                <!--for pdf-->
                <?php
                
                $print_data.='
                <div>
                    <!--for First table-->
                   <div width="100%">
                    <div class="panel panel-info">
                        <div class="panel-heading">DEVELOPMENT OF SUBJECT LEARNING SKILL</div>
                        <div>
                          
                         
                            <table class="table-div">
                                
                                    <tr>
                                      <th>SUBJECTS</th><th>MT-<br>I</th><th>MT-<br>II</th><th>FA-<br>I</th><th>FA-<br>II</th><th>WTE-<br>I</th><th>SA-<br>I</th><th>MT-<br>III</th><th>MT-<br>IV</th><th>FA-<br>III</th><th>FA-<br>IV</th><th>WTE-<br>II</th><th>SA-<br>II</th><th>FA <br>1+2</th><th>FA<br> 3+4</th><th>SA <br>1+2</th><th>OG</th><th>ACT-<br>I</th><th>ACT-<br>II</th><th>ACT-<br>III</th><th>ACT-<br>IV</th>
                                    </tr>
                                    <tr>
                                      <td style="font-weight:bold;text-align:justify;">OUT OF</td><td>20:M</td><td>20:M</td><td>10:M</td><td>10:M</td><td>80:M</td><td>50:M</td><td>20:M</td><td>20:M</td><td>10:M</td><td>10:M</td><td>80:M</td><td>50:M</td><td>20:M</td><td>20:M</td><td>60:M</td><td>100:M</td><td>10:M</td><td>10:M</td><td>10:M</td><td>10:M</td>
                                    </tr>
                                    
                                            ';?>
                                    <?php
                                    
                                    foreach($data_marks as $key=> $value)
                                        {
                                        
                                $print_data.='
                                    <tr id="table-rows">
                                        <td>'.$data_marks[$key]["subjects"].'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["mt_1"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["mt_2"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_1"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_2"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["wte_1"],80).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["sa_1"],50).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["mt_3"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["mt_4"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_3"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_4"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["wte_2"],80).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["sa_2"],50).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_1_2"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["fa_3_4"],20).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["sa_1_2"],60).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["og"],100).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["act_1"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["act_2"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["act_3"],10).'</td>
                                        <td>'.retunMyGradeInfo($data_marks[$key]["act_4"],10).'</td>
                                        
                                   </tr>';
                                  

                                      };
                                      ?>
                         
                            <?php
                                    $print_data.='            
                            </table>
                            
                        </div>
                      </div>
                    </div>
                    
                    <!--For Second table-->
                    <div width="100%">
                    <div class="panel panel-info">
                        <div class="panel-heading">DEVELOPMENT OF FORMATIVE SKILL</div>
                        <div>
                          
                         
                            <table class="table-div">
                                
                                    <tr>
                                      <th>SUBJECTS</th><th>TERM - I</th><th>TERM - II</th>
                                    </tr>';?>
                                    <?php
                                      foreach($data_marks1 as $key => $value) {
                                      ?>
                                    
                             <?php
                                    $print_data.=' 
                                <tr id="table-rows">
                                        <td>'.$data_marks1[$key]["subjects"].'</td>
                                        <td>'.retunMyGradeInfo($data_marks1[$key]["term_1"],100).'</td>
                                        <td>'.retunMyGradeInfo($data_marks1[$key]["term_2"],100).'</td>
                                   </tr>';?>
                                  <?php 

                                      }
                                       ?>
                          <?php
                                    $print_data.='
                                        </table>
                            
                        </div>
                      </div>
                    </div>
                    
                    <!--for Third table-->
             
                    <div width="100%">
                       <div class="panel panel-info">

                           <div class="logo"><img src="../../../images/headtext.png" alt="Logo" /></div>
                           <div>

                               <table class="table-div">
                               <tr>
                                   <th colspan="2">BASELINE TEST-I</th><th colspan="2">BASELINE TEST-II</th>
                               </tr>';?>
                               <?php
                                 foreach($data_marks2 as $key => $value) {
                               ?>
                 <?php
                                    $print_data.='
                               <tr class="baseline">
                                        <td><span style="padding-right:60px;">ENGLISH :</span>'.($data_marks2[$key]["english"]).'</td>
                                        <td><span style="padding-right:60px;">ENGLISH :</span>'.($data_marks2[$key]["math"]).'</td>
                                        <td><span style="padding-right:60px;">ENGLISH :</span>'.($data_marks2[$key]["english1"]).'</td>
                                        <td><span style="padding-right:60px;">ENGLISH :</span>'.($data_marks2[$key]["math1"]).'</td>
                               </tr>';?>
                                <?php 
                                     }
                                   ?>
                           <?php
                                    $print_data.='  </table>

                           </div>
                         </div>

                   </div>
                 
                    <div>
                      <div class="sign" id="sign"><br><br>
                        <table width="100%">
                              <tr>
                                  <th><h5 align="center">Authority Signature</th>
                                  <th><h5 align="center">Signature of Gaurdian / Parents</th>
                                  <th><h5 align="center">Signature of Student</th></h5>
                              </tr>
                        </table>
                      </div>
                    </div>
                
            </div>
                
                ';?>
                
                
                
                
                
                
                
                
                
                
                
                <!--------------->
                
                <div>
                    <!--for First table-->
                   <div width="100%">
                    <div class="panel panel-info">
                        <div class="panel-heading">DEVELOPMENT OF SUBJECT LEARNING SKILL</div>
                        <div>
                          
                         
                            <table class="table-div">
                                
                                    <tr>
                                      <th>SUBJECTS</th><th value="10">MT-<br>I</th><th>MT-<br>II</th><th>FA-<br>I</th><th>FA-<br>II</th><th>WTE-<br>I</th><th>SA-<br>I</th><th>MT-<br>III</th><th>MT-<br>IV</th><th>FA-<br>III</th><th>FA-<br>IV</th><th>WTE-<br>II</th><th>SA-<br>II</th><th>FA <br>1+2</th><th>FA <br>3+4</th><th>SA <br>1+2</th><th>OG</th><th>ACT-<br>I</th><th>ACT-<br>II</th><th>ACT-<br>III</th><th>ACT-<br>IV</th>
                                    </tr>
                                    <tr id="table-rows">
                                      <td>OUT OF</td><td>20:M</td><td>20:M</td><td>10:M</td><td>10:M</td><td>80:M</td><td>50:M</td><td>20:M</td><td>20:M</td><td>10:M</td><td>10:M</td><td>80:M</td><td>50:M</td><td>20:M</td><td>20:M</td><td>60:M</td><td>100:M</td><td>10:M</td><td>10:M</td><td>10:M</td><td>10:M</td>
                                    </tr>
                                    <?php
                                            
                                      foreach($data_marks as $key => $value) {
                                          
                                      ?>
                                    <tr id="table-rows">
                                        <td><?php echo $data_marks[$key]["subjects"]; ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["mt_1"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["mt_2"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_1"],10); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_2"],10); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["wte_1"],80); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["sa_1"],50); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["mt_3"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["mt_4"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_3"],10); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_4"],10); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["wte_2"],80); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["sa_2"],50); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_1_2"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["fa_3_4"],20); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["sa_1_2"],60); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["og"],100); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["act_1"],100); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["act_2"],100); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["act_3"],100); ?></td>
                                        <td <?php echo $data_marks[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks[$key]["act_4"],100); ?></td>
                                   </tr>
                                  <?php 

                                      }
                                       ?>
                          </table>
                            
                        </div>
                      </div>
                    </div>
                    
                    <!--For Second table-->
                    <div width="100%">
                    <div class="panel panel-info">
                        <div class="panel-heading">DEVELOPMENT OF FORMATIVE SKILL</div>
                        <div>
                          
                         
                            <table class="table-div">
                                
                                    <tr>
                                      <th>SUBJECTS</th><th>TERM - I</th><th>TERM - II</th>
                                    </tr>
                                    <?php
                                      foreach($data_marks1 as $key => $value) {
                                      ?>
                                    <tr id="table-rows">
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><?php echo $data_marks1[$key]["subjects"]; ?></td>
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks1[$key]["term_1"],100);?></td>
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><?php echo retunMyGradeInfo($data_marks1[$key]["term_2"],100); ?></td>
                                        
                                   </tr>
                                  <?php 

                                      }
                                       ?>
                          </table>
                            
                        </div>
                      </div>
                    </div>
                    
                    <!--for Third table-->
             
                    <div width="100%">
                       <div class="panel panel-info">

                           <div class="logo"><img src="../../../images/headtext.png" alt="Logo" /></div>
                           <div>

                               <table class="table-div">
                               <tr>
                                   <th colspan="2">BASELINE TEST-I</th><th colspan="2">BASELINE TEST-II</th>
                               </tr>
                               <?php
                                 foreach($data_marks2 as $key => $value) {
                               ?>
                               <tr class="baseline">
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><span style="padding-right:60px;">ENGLISH :</span><?php //echo retunMyGradeInfo($data_marks2[$key]["english"]);?></td>
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><span style="padding-right:63px;">MATHS :</span><?php //echo retunMyGradeInfo($data_marks2[$key]["math"]);?></td>
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><span style="padding-right:59px;">ENGLISH :</span><?php //echo retunMyGradeInfo($data_marks2[$key]["english1"]);?></td>
                                        <td <?php echo $data_marks1[$key]["id"]; ?>><span style="padding-right:62px;">MATHS :</span><?php //echo retunMyGradeInfo($data_marks2[$key]["math1"]);?></td>
                               </tr>
                               <?php 
                                     }
                                   ?>
                             </table>

                           </div>
                         </div>

                   </div>
                 
                    <div>
                      <div class="sign" id="sign"><br><br>
                        <table width="100%">
                              <tr>
                                  <th><h5 align="center">Authority Signature</th>
                                  <th><h5 align="center">Signature of Gaurdian / Parents</th>
                                  <th><h5 align="center">Signature of Student</th></h5>
                              </tr>
                        </table>
                      </div>
                    </div>
          </div>
        </div> 
      </div> 
     </div> 
       </div>
</div>
</body>
</html>
 <?php
//echo $print_data;
require('phpToPDF.php');
if($_GET['pdf']==true)
{
    
    
    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $print_data,
      "action" => 'view',
      "save_directory" => '',
      "file_name" => $fullname.' result.pdf'.date(d));

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
}
?>
   