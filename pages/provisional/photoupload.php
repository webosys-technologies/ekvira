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
<script type="text/javascript" src="webcam/webcam.js"></script>
<script>
        webcam.set_api_url( 'upload.php' );
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
                // show JPEG image in page
                document.getElementById('upload_results').innerHTML = 
                    'Snapshot<br>' + 
                    '<a href="'+image_url+'" target"_blank"><img src="' + image_url + '"></a>';
                
                // reset camera for another shot
                webcam.reset();
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
    height: 258px;
}
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
        	<p>You are here &raquo; <strong><!-- InstanceBeginEditable name="here" -->Status  Details<!-- InstanceEndEditable --></strong></p>
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
					$photo_url = $row_prov['photo_url'];					
				}
				
				if($photo_url=='')
				{
				 $p_url='../../images/mf.png';
   				}
				else
				{
				 $p_url='upload/'.$photo_url;
   				}
				
			}
			
			
		?>
        <div class="main-wrapper">
        <!-- Start Here -->
       <p align="center" class="style1"><strong>STUDENT POVISIONAL REGISTRATION UPLOAD PHOTO AND SIGNITURE</strong></p>
          
				 <?php if($flag=$_REQUEST['flag']){
                    $flag=$_REQUEST['flag'];
                 } 
				 ?>
         
   <div align="center">
     <table width="63%" height="325" border="1" class="tbl" align="center">
          <tr>
            <td height="51">Student Name :--</td>
            <td colspan="2"><?=$fullname?></td>
            </tr>
          <tr>
            <td width="32%" height="191"><img align="right" src="<?=$p_url?>" alt="photo" name="stu_photo" width="174" height="187" id="stu_photo" /></td>
            <td width="25%"><div align="center">
              <form action="uploadfile.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="fileToUpload" id="fileToUpload" class="button" required="required" />
                  <input type="hidden" name="id" value="<?=$id?>" />
                  <input type="hidden" name="mode" value="<?=$mode?>" />
                  <input type="hidden" name="img_type" value="imgfile" />
                  <input type="submit" value="Upload Image" name="submit" />
              </form>
              
              <div class="flag-msg">
             	 <?php if($flag=="not_img"){ ?>
                <p align="center"><font color='red'><B>File is not an image.</B></font></p>
                <? } ?>	
                <? if($flag=="too_large"){?>
                <p align="center"><font color='red'><B>Sorry, your file is too large.</B></font></p>
                <? } ?>	
                <? if($flag=="non_img"){?>
                <p align="center"><font color='red'><B>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</B></font></p>
                <? } ?>	
                <? if($flag=="error"){?>
                <p align="center"><font color='red'><B>Sorry, there was an error uploading your file.</B></font></p>
                <? } ?>	
			  	<? if($flag=="ok"){ ?>
                <p align="center"><font color='red'><B>Photo Uploaded Successfully.</B></font></p>
              	<? } ?>
              </div>
       		 </div></td>
        <td width="43%"><p align="center">Select image to upload</p>
        <p align="center">file size should be less than 100kb</p></td>
          </tr>
          <tr>
            <td height="73">
            			<?php if($mode=='old'){ ?>
                    		<p align="center"><a href="../uploadimg/index.php?flag=non" class="button">Home</a></p>
                         <?php } ?>
            </td>
            <td align="center">
					<?php if($flag=='ok'){  
						if($mode=='new'){	
					?>	
                    	<p><a href="item/item_allocate.php?id=<?=$id?>&mode=<?=$mode?>&flag=add" class="button">Proceed</a></p>
                         <?php }else{ ?>
                         <p><a href="../uploadimg/index.php?flag=add" class="button">Proceed</a></p>
	    <?php } }else{ ?> 
                    	<p onclick="alert('To Proceed Please Upload Photo');" class="button">Proceed</p>
                        
			    <?php } ?>             </td>
      
            <td><?php if($mode=='new'){ ?>
            		<p align="center"><a href="item/item_allocate.php?id=<?=$id?>&flag=non&mode=<?=$mode?>" class="button">skip upload</a></p>
                 <?php } ?>
            </td>
          </tr>
        </table>
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
        <div class="ffrt"><a href="../../common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>
</body>
<!-- InstanceEnd --></html>
