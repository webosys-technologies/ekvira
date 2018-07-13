<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0044)http://localhost/vmca/dashboard.php?flag=all -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Pre-Cadet Admission System</title>
<link href="./css/style-sms.css" rel="stylesheet" type="text/css">
<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
	var togSrc = [ "images/up.png", "images/down.png" ];
	$("#notify").show();
	$("#adm_sec").hide();
	$("#stock_sec").hide();
	$("#lib_sec").hide();
	$("#staff_sec").hide();
	$("#stud_sec").hide();
	$("#admin_sec").hide();
  	$('#notifyimg').click(function(){
		$("#notify").show(1000);
		$("#adm_sec").hide(1000);
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
		$("#lib_sec").hide(1000);
		$("#stock_sec").hide(1000);
		$("#stud_sec").hide(1000);
		$("#admin_sec").hide(1000);
		return false;
	});
	$('#studimg').click(function(){
		$("#stud_sec").show(1000);
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
    	<div class="logo"><img src="./Pre-Cadet Admission System_files/logo.png" alt="Logo"></div>
        <div class="clr"></div>
        <div class="logotxt"><img src="./Pre-Cadet Admission System_files/logotext.png" alt="subscription-management-system"></div>
      <div class="hdrrt"><span class="logotxt">
        Welcome  admin                 </span></div>
      <div class="clr"></div>
  </div>
</div>

<div class="mainbody">
<!--Main Body -->
<div class="wrapper">
    <div id="adm_sec" class="wblock" style="display: none;">
      <h1>ADMISSION MANAGEMENT SECTION</h1>
       <hr>
    </div>

<!--<div class="container">
    <h1 class="well">Student Details</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
							        <img class="img-circle edusec-img-disp" src="Pre-Cadet Admission System_files/no-photo.png" height="140" width="130" alt="No Image"></img>
							</div>
							<div class="col-sm-6 form-group">
								<label>Student Name:</label>
								
							</div>
							<div class="col-sm-6 form-group">
								<label>Father Name:</label>
								
							</div>
							<div class="col-sm-6 form-group">
								<label>Mother Name:</label>
								
							</div>
						</div>					
						<div class="form-group">
							<label>Address</label>
							<textarea placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>City</label>
								<input type="text" placeholder="Enter City Name Here.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>State</label>
								<input type="text" placeholder="Enter State Name Here.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>Zip</label>
								<input type="text" placeholder="Enter Zip Code Here.." class="form-control">
							</div>		
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Title</label>
								<input type="text" placeholder="Enter Designation Here.." class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>Company</label>
								<input type="text" placeholder="Enter Company Name Here.." class="form-control">
							</div>	
						</div>						
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" placeholder="Enter Phone Number Here.." class="form-control">
					</div>		
					<div class="form-group">
						<label>Email Address</label>
						<input type="text" placeholder="Enter Email Address Here.." class="form-control">
					</div>	
					<div class="form-group">
						<label>Website</label>
						<input type="text" placeholder="Enter Website Name Here.." class="form-control">
					</div>
					<button type="button" class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
				</div>
	</div>
	</div>-->

<div class="container">
<br>
<br>
	<div class="col-md-12 row" id="main">
        <div class="col-md-4 well" id="leftPanel">
            <div class="row">
                <div class="col-md-12">
                	<div>
        				<img src="http://lorempixel.com/200/200/abstract/1/" alt="Texto Alternativo" class="img-circle img-thumbnail">
        				<h2>Gopinath Perumal</h2>
        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        				tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning">
                                Social</button>
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Twitter</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Github</a></li>
                            </ul>
                        </div>
        			</div>
        		</div>
            </div>
        </div>
        <div class="col-md-8 well" id="rightPanel">
            <div class="row">
    <div class="col-md-12">
    	<form role="form">
			<h2>Edit your profile.<small>It's always easy</small></h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"></div>
				<div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Save</a></div>
			</div>
		</form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
        </div>
     </div>       
</div>

 </div>
</div>
             
        


<!-- Main Body End -->


<div class="footer">
	<div class="wrapper">
    	<div class="fflt">Copyright © 2016 NeonSoft All Rights Reserved</div>
        <div class="ffrt"><a href="http://localhost/vmca/common/developer.php?flag=non">Designed &amp; Developed by NeonSoft and Prahar IT Cell</a></div>
      <div class="clear"></div>
    </div>
</div>

</body></html>