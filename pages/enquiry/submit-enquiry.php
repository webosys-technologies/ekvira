<?php
require '../../common/connect.php';
	
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$phone = $_POST['phno'];
$gender = $_POST['gender'];
$caste = $_POST['caste'];
$religion = $_POST['religion'];
$address = $_POST['address'];
$course_id = $_POST['course_id'];
$remark = $_POST['remark'];


echo $phone;
$date=date("Y-m-d"); 
	$query_add=sprintf("INSERT INTO stu_enquiry SET fname='%s', mname='%s', lname='%s', phone='%s', gender='%s', caste_id='%s', religion_id='%s', address='%s', remark='%s', enq_date='%s'", $fname, $mname, $lname, $phone, $gender, $caste, $religion, $address, $remark,$date);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
	$last_id=mysqli_insert_id($con);
	
	/*******************************************/
	
	for($i=0;$i<=count($course_id)-1;$i++)
	{				

		$query_shp = sprintf("INSERT INTO stu_enq_course SET enq_id='%d', course_id='%d'", $last_id, $course_id[$i]);
		if (!($result_shp = $con->query($query_shp))){ echo "FOR QUERY: $query_shp<BR>".$con->error; 	exit;}
	}
	
	/**********************************************/
	
	
	header("Location: list-enquiry.php?flag=add");
	
	exit;

?>