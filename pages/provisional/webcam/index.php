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
	 $id = $_GET['id']; 
	 $mode = $_GET['mode'];
	 $imgdir='../upload/';
	 if($mode=='f'){ $filepath=$imgdir.'f_'.$id.'.jpg'; }else{ $filepath=$imgdir.$id.'.jpg'; } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/admission.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pre-Cadet Admission System</title>
    <script type="text/javascript" src="webcam.js"></script>
    <script>
        webcam.set_api_url( 'editupload.php?id=<?=$id?>&mode=<?=$mode?>' );
        webcam.set_quality( 90 ); // JPEG quality (1 - 100)
        webcam.set_shutter_sound( true ); // play shutter click sound
        
        webcam.set_hook( 'onComplete', 'my_completion_handler' );
        
        function take_snapshot() {
            // take snapshot and upload to server
            document.getElementById('upload_results').innerHTML = 'Snapshot<br>'+
            '<img src="uploading.gif">';
            webcam.snap();
        }
        
        function my_completion_handler(msg) {
            // extract URL out of PHP output
            if (msg.match(/(http\:\/\/\S+)/)) {
                var image_url = RegExp.$1;
				var filepath = '<?=$filepath?>';
				// show JPEG image in page
                document.getElementById('upload_results').innerHTML = 
                    'Snapshot<br>' +
                    '<a href="'+filepath+'" target"_blank"><img src="' + filepath + '"></a>';
               // document.getElementById('camimg').value = filepath;
                // reset camera for another shot
                webcam.reset();
				alert('Image Uploaded Successfully');
            }
            else alert("PHP Error: " + msg);
        }
    </script>
<style>
.main
{
    margin-left: auto;
    margin-right: auto;
    width: 690px;
}
.snap
{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(28, 184, 65);
    font-family: inherit;
    font-size: 100%;
    padding: .5em 1em;
    border: 0 hsla(0, 0%, 0%, 0);
    text-decoration: none;
}
.border
{
    border: 3px rgb(28, 184, 65) solid;
    padding: 5px;
    width: 320px;
    height: 265px;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head-sec" -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- InstanceEndEditable -->
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Take Picture<!-- InstanceEndEditable --></strong></p>
      </div>
    </div>
    
    <div class="gap"></div>
    
    <div class="fullbox">
    	<div class="box-users">
        <!-- InstanceBeginEditable name="main" -->
        
        <div class="main-wrapper">
        <!-- Start Here -->
        <div class="webcam">
          <div class="webleft"><h2>Take Picture Through Webcam</h2></div>
          
          
         <?php if($mode!='f'){?> <div class="webright"> <p align="right"><a href="../photoupload.php?id=<?=$id?>&flag=non&mode=<?=$mode?>" class="button">skip and upload Image File</a></p></div><?php }?>
        </div>
        
        <p> </p>
        <?php if($flag=$_REQUEST['flag']){
                $flag=$_REQUEST['flag'];
                }?>
            <? if($flag=="add"){?>
            <p align="center">&nbsp;</p>
            <p align="center"><font color='red'><B>Details Saved Successfully</B></font></p>
            <? } ?>
        <?php       
			//$id = $_GET['id'];
			//$mode = $_GET['mode'];
			if($id > 0)
			{	
				if($mode=='f'){
					$que=sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $id); 
					if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
	
					$clcnt=0;
			
					if($row_prov=$page_res->fetch_assoc())
					{
						$faculty_type = $row_prov['type'];
						if($faculty_type=='teach'){ $f_type='TEACHING'; }else{ $f_type='NON-TEACHING'; }
						$fullname=stripslashes($row_prov['name']).' ('.$f_type.' FACULTY)';
						
					}
				}else{
					$que=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
					if (!($page_res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
	
					$clcnt=0;
			
					if($row_prov=$page_res->fetch_assoc())
					{
						$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
						
					}
				}
			}
			
	   ?> 
        <table class="main">
        <tr>
          <td colspan="3" valign="top"><strong>Name :- </strong> <?=$fullname?></td>
          </tr>
        <tr>
            <td valign="top">
	            <div class="border">
                Live Webcam<br>
                <script>
                document.write( webcam.get_html(320, 240) );
                </script>
                </div>
                <br/><input type="button" class="button" value="SNAP IT" onClick="take_snapshot()">            </td>
            <td width="50">&nbsp;</td>
            <td valign="top">
                <div id="upload_results" class="border">
                    Snapshot<br>
                    <img src="logo.jpg" />                </div>
                <br/>
                <?php
				if($mode=='new'){	
				?>
                	<p align="right"><a href="../item/item_allocate.php?id=<?=$id?>&flag=add&mode=<?=$mode?>" class="button">PROCEED</a></p>
				<?php
				}else{ if($mode!='f'){
				?>	
                	<p align="right"><a href="../../uploadimg/index.php?flag=add&mode=<?=$mode?>" class="button">Go Back</a></p>
                <?php }else{?>
                	<p align="right"><a href="../../../admin/teacher/view.php?id=<?=$id?>&flag=add&staff=<?=$faculty_type?>" class="button">Go Back</a></p>
              <?php
				}  }
				?>            </td>
        </tr>
    </table>
        <div class="flag-msg">
        	<?php if($flag=$_REQUEST['flag']){
	 		$flag=$_REQUEST['flag'];
	 		}?>
            <? if($flag=="success"){?>
            <p align="center"><font color='red'><B>File has been Uploaded Successfully</B></font></p>
            <? } ?>
            <? if($flag=="err"){?>
            <p align="center"><font color='red'><B>ERROR: Failed to write data to $filename, check permissions</B></font></p>
            <? } ?>
            <? if($flag=="error"){?>
            <p align="center"><font color='red'><B>File has not been Uploaded</B></font></p>
            <? } ?>
            <? if($flag=="derror"){?>
            <p align="center"><font color='red'><B>File not saved to database</B></font></p>
            <? } ?>
        </div>
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
        <div class="ffrt"><a href="../../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
