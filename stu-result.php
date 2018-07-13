<?php
    ob_start();
    require('phpToPDF.php');
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
}';?>
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

<script type="text/javascript" src="../../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../../js/daterangepicker.jQuery.js"></script>

<link rel="stylesheet" href="../../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" />
<?
    $print_data.='<html><head><style><link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="../../../css/style-sms.css" rel="stylesheet" type="text/css" /></style></head><body>'
?>
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
      <div class="hdrrt"> <span class="logotxt">';?>
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
                    <a href="stu-result.php?prov_id=8&pdf=true" class="button" align="right"/>PDF</a>
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
       
        $print_data.='
        
        <div>
            
        
       
        
        <div >';?>
            <?php
          
            }?>
     <div class="main-wrapper">
            
        
       
        
        <div >
       <div class="row" id="result" style="width:210; height: 300">
        <div class="col-xs-12">
            <div class="panel panel-primary">
               
                
                <div class="panel-body" id="result_print">
                            <div class="logo-result">
            <img src="../../../images/only-logo.png" alt="Logo" height="150px" width="150px"/>
        </div>
          <h4 align="center"style="color:firebrick">EKVIRA SCHOOL OF BRILLIANTS MORSHI(MH) </h4>
        <h4 align="center"style="color:firebrick">WEBS-www.esob.co.in; CN-8550991135; 07228-222025; </br>email: ekvira_school@rediffmail.com; chavhan_tushar@yahoo.com; helpdesk@esob.co.in <br />First Terminal Assisment Report</br>SESSION-2015-2016<br />CLASS:<? echo $data['course_id'].' ('.$data['section_id'].')'?></h4>
        
        <div class="stu-details-show">
            <h4 align="left" style="color:hotpink">Students Details :-</h4>
            <table>
                <tr><td>
            <div class="stu-details-show-left">
                <table>
                    <tr><td><h5 align="left">Student Name:</h5></td><td><h5 align="left"><? echo $fullname ?></h5></td></tr>
                    <tr><td><h5 align="left">Mothers Name:-</h5></td><td><h5 align="left"><? echo $mother?></h5></td>
                        <tr><td><h5 align="left">Working Days:-</h5></td><td><h5 align="left"></h5></td></tr>
                        <tr><td><h5 align="left">Classteacher\'s Name:-</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
            </div></td><td>
                
            <div class="stu-details-show-right">
                
                <table calspan="2">
                    <tr><td><h5 align="left">Admission No:-</h5></td><td><h5 align="left"><? echo $data['prov_id']?></h5></td><td><h5 align="left">Date:-</h5></td><td><h5 align="left"><? echo $data['prov_date']?></h5></td></tr>
                    
                        <tr ><td><h5 align="left">Roll No:-</h5></td><td><h5 align="left"><? echo $id?></h5></td><td><h5 align="left">DOB:-</h5></td><td><h5 align="left"><? echo $dob?></h5></td></tr>
                        <tr><td><h5 align="left">Address:-</h5></td><td><h5 align="left"><? echo $address?></h5></td></tr>
                        <tr><td><h5 align="left">Present Days:-</h5></td><td><h5 align="left"></h5></td><td><h5 align="left">Avg:-</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
            </div>
            </td></tr></table>
        </div>
        
        <h4 align="center" style="color:highlight">
                        Devlopment of subject learning skills
                    </h4>
                </div>
                    <ul class="list-group">

          
        
        
			
      
   <?php
    $print_data.='
            
            <div>
        <div>
            <div>
               
                
                <div>
            <div style="float: left; padding:5px 5px 5px 5px;">
            <img src="only-logo.png" height="150px" width="150px"/>
        </div>
        <div style="align:center font-size:20px;">
        
          <h4 align="center" style="color:firebrick">EKVIRA SCHOOL OF BRILLIANTS MORSHI(MH) </h4>
        <h4 align="center"style="color:firebrick">WEBS-www.esob.co.in; CN-8550991135; 07228-222025; </br>email: ekvira_school@rediffmail.com; chavhan_tushar@yahoo.com; helpdesk@esob.co.in <br />First Terminal Assisment Report</br>SESSION-2015-2016<br />CLASS:'.$data['course_id'].' ('.$data['section_id'].')</h4>
            
</div>
        <hr>
        <div style="float: none; padding:5px 5px 5px 5px; width: 100%;" >
            <h4 align="left" style="color:purple;"><b>Students Details :</b></h4>
            
            <div style="padding:5px 5px 5px 5px; width: 100%; font-size:12px;">
            <table bgcolor="pink" width="100%">
                <tr><td width="50%">
                <table  width="100%">
                    <tr><td><h5 align="left">Student Name:</h5></td><td><h5 align="left">'.$fullname.'</h5></td></tr>
                    <tr><td><h5 align="left">Mothers Name:</h5></td><td><h5 align="left">'.$mother.'</h5></td>
                        <tr><td><h5 align="left">Working Days:</h5></td><td><h5 align="left"></h5></td></tr>
                        <tr><td><h5 align="left">Classteacher\'s Name:</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
            </td><td width="50%">
                
            
                
                <table calspan=\"2\" width="100%">
                    <tr><td><h5 align="left">Admission No:-</h5></td><td><h5 align="left">'.$data['prov_id'].'</h5></td><td><h5 align="left">Date:-</h5></td><td><h5 align="left">'.$data['prov_date'].'</h5></td></tr>
                    
                        <tr ><td><h5 align="left">Roll No:-</h5></td><td><h5 align="left">'.$id.'</h5></td><td><h5 align="left">DOB:-</h5></td><td><h5 align="left">'.$dob.'</h5></td></tr>
                        <tr><td><h5 align="left">Address:-</h5></td><td><h5 align="left">'.$address.'</h5></td></tr>
                        <tr><td><h5 align="left">Present Days:-</h5></td><td><h5 align="left"></h5></td><td><h5 align="left">Avg:-</h5></td><td><h5 align="left"></h5></td></tr>
                </table>
                
            </td></tr></table></div>
           
        </div>
        <hr>
        <h4 align="center" style="color:purple;">
                        Devlopment of subject learning skills
                    </h4>
                </div>
                    <ul>';?>
                    
                    <?php
                     // $mark_data=$page_res_marks->fetch_assoc();
                        $stu_term_marks=sprintf("SELECT * FROM stu_term_marks where stu_id='%d' group by subject",$id); 
                        $page_res_marks = $con->query($stu_term_marks);
                        while($mark_data=$page_res_marks->fetch_assoc()){
                           //****** Get data from student_term_marks table
//                            echo '<pre>';
//                            print_r($mark_data);
                   //        [id] => 6
                   //        [term] => 1
                   //        [exam] => A-1
                           $subject = $mark_data['subject'];
                           
                           
                           $subject_master1=sprintf("SELECT * FROM subject_master where sub_id='%d'",$subject); 
                           $page_res_subject1 = $con->query($subject_master1);
                           $subject_data1=$page_res_subject1->fetch_assoc();
                   //        [sub_exam] => Exam 1
                   //        [skill] => 1
                   //        [level] => 4
                   //        [radio_value] => 4
                   //        [stu_id] => 8
                   //        [course_id] => 1
                   //        [section_id] => 0
                   //        [exam_date] => 2016-12-08
                           
                        
                    $print_data.='
                    <li>
                        <h4 style="color:purple;">'.$subject_data1['sub_name'].'  :</h4>
                    <table>
                        <tbody>';?>
                        <li class="list-group-item">
                        <h4 style="color:yellowgreen"><? echo $subject_data1['sub_name']?></h4>
                    <table class="table table-hover">
<!--                        <thead>
                            <tr>
                                <th>Operation date</th>
                                <th>Remitter</th>
                                <th>Beneficiary</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                        </thead>-->
                        <tbody>
                            <?php
                            //****** Get master subject data
                            $subject_master=sprintf("SELECT * FROM stu_term_marks where subject='%d' and stu_id='%d'",$subject,$mark_data['stu_id']); 
                            $page_res_subject = $con->query($subject_master);
                            while($subject_data=$page_res_subject->fetch_assoc())
                            {
                                $skill = $subject_data['skill'];
                                $level = $subject_data['level'];

                                //get skill master
                                $skill_master=sprintf("SELECT * FROM skill_master where skill_id='%d'",$skill); 
                                $page_res_skill = $con->query($skill_master);
                                $skill_data=$page_res_skill->fetch_assoc();

                                $skillname = $skill_data['skill_name'];
                                
                            $print_data.='
                            <tr>
                                <th><h5 style="color:blue;">'.$skillname.':</h5></th>';?>
                            <tr>
                                <th><? echo $skillname?></th>
                                <?php
                                //****** Get subject term data
                                
                                $level_master=sprintf("SELECT * FROM stu_term_marks where level='%d'",$level); 
                                $page_res_level = $con->query($level_master);
                                $i=0;
                                
                                while($level_data=$page_res_level->fetch_assoc())
                                {
                                    
                                    $level_id = $level_data['level'];
                                    //Get data from level master
                                    $level_master1=sprintf("SELECT * FROM level_master where level_id='%d'",$level_id); 
                                    $page_res_level1 = $con->query($level_master1);
                                    $level_data1=$page_res_level1->fetch_assoc();
                                    $level_name = $level_data1['level_name'];
                                    $level_master2=sprintf("SELECT * FROM level_master where level_id='%d' and id='%d'",$level_id,$level_data['radio_value']); 
                                    $page_res_level2 = $con->query($level_master2);
                                    $level_data2=$page_res_level2->fetch_assoc();
                                    
                                    $result = $level_data2['result'];
                                    echo '<td>'.$level_name.'&nbsp; &nbsp;<strong>'.$result.'</strong></td>';
                                $print_data.='
                                <td><h5 style="color:black;">'.$level_name.'&nbsp; &nbsp;<strong style="color:green;">'.$result.'</strong></h5></td>
                               ';?>
                                <?php
                                
                                $i++;
                                }
                                
                                $sz = (5-$i);
                               echo '<td colspan="'.$sz.'">&nbsp;</td>';
                                ?>
                             </tr>
                           <?php
                               $print_data.= '<td colspan="'.$sz.'">&nbsp;</td>
                                

                            </tr>';?>
                                
                            <?php
                            }
                            $print_data.='
                        </tbody>
                    </table>
                    </li>
               ';?>
                    </tbody>
                    </table>
                    </li>
                    
                <?php
                }
                $print_data.='
                </ul>
                <hr>
                <div class=\"sign\" id="sign">
          <div class=\"signleft\" id="signleft">
            
          </div>         
          &nbsp; &nbsp; &nbsp;
          <br><br>
          <table width="100%">
          </tr>
          <th><h5>Authority Signature</th>
           <th><h5>Signature of Gaurdian / Parents</th>
            <th><h5>Signature of Student</th>
            </h5></tr></table>
          
          </div>
            </div>
        </div>
    </div>
</div>

        
        
        <!-- InstanceEndEditable -->
      </div>
        </div>
    </div>

</div>
<!-- Main Body End -->
</div>
</div>
</body>
</html>';?>
</ul>
                <div class="sign" id="sign">
          <div class="signleft" id="signleft">
            <div align="center"><strong>Signature of Gaurdian / Parents</strong></div>
          </div>         
          &nbsp; &nbsp; &nbsp;
          <strong>Authority Signature</strong>
          <div class="signright" id="signright">
            <div align="center"><strong>Signature of Student</strong></div>
          </div>
          </div>
            </div>
        </div>
    </div>
</div>

        
        
        <!-- InstanceEndEditable -->
      </div>
        </div>
    </div>

</div>
<!-- Main Body End -->
</div>
</div>
</body>
</html>


    <?php
echo $print_data;

if($_GET['pdf']==true)
{
    

    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $print_data,
      "action" => 'view',
      "save_directory" => '',
      "file_name" => 'my_filename.pdf');

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
}
?>
   