<?php
require '../../common/connect.php';
$id=$_POST['id'];
$mode = $_POST['mode'];	
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$mother = $_POST['mother'];
$dob = dateformate($_POST['dob']);
$contact = $_POST['contact'];
$p_contact = $_POST['p_contact'];
$gender = $_POST['gender'];
$caste = $_POST['caste'];
$religion = $_POST['religion'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$c_address = $_POST['c_address'];
$p_address = $_POST['p_address'];
$course_id = $_POST['course_id'];
$edu_id = $_POST['edu_id'];
$percent = $_POST['percent'];
$c_certi = $_POST['c_certi'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$duration_id = $_POST['duration'];
$fixedfees= $_POST['fixedfees'];
$feespaid= $_POST['feespaid'];
$remark = $_POST['remark'];
$fileno = $_POST['fileno'];

//document entry
		if(isset($_POST['tenth'])){$tenth = $_POST['tenth'];}else{$tenth='NO';}
		if(isset($_POST['twelth'])){$twelth = $_POST['twelth'];}else{$twelth='NO';}
		if(isset($_POST['diploma'])){$diploma = $_POST['diploma'];}else{$diploma='NO';}
		if(isset($_POST['ug'])){$ug = $_POST['ug'];}else{$ug='NO';}
		if(isset($_POST['pg'])){$pg = $_POST['pg'];}else{$pg='NO';}
		if(isset($_POST['tc'])){$tc = $_POST['tc'];}else{$tc='NO';}
		if(isset($_POST['ncl'])){$ncl = $_POST['ncl'];}else{$ncl='NO';}
		if(isset($_POST['cast'])){$cast = $_POST['cast'];}else{$cast='NO';}
		if(isset($_POST['validity'])){$validity = $_POST['validity'];}else{$validity='NO';}
		if(isset($_POST['national'])){$nationality = $_POST['national'];}else{$nationality='NO';}
		if(isset($_POST['domicile'])){$domicile = $_POST['domicile'];}else{$domicile='NO';}
		if(isset($_POST['income'])){$income = $_POST['income'];}else{$income='NO';}
		if(isset($_POST['gap'])){$gap = $_POST['gap'];}else{$gap='NO';}
		if(isset($_POST['photo'])){$photo = $_POST['photo'];}else{$photo='NO';}
		if(isset($_POST['birth'])){$birth = $_POST['birth'];}else{$birth='NO';}
		if(isset($_POST['medical'])){$medical = $_POST['medical'];}else{$medical='NO';}
		if(isset($_POST['idproof'])){$idproof = $_POST['idproof'];}else{$idproof='NO';}
		if(isset($_POST['other'])){$other_doc = $_POST['other'];}else{$other_doc='NO';}
				
//$course_id = unserialize(base64_decode($course_id));
//$edu_id = unserialize(base64_decode($edu_id));
//$percent = unserialize(base64_decode($percent));

$query_add=sprintf("INSERT INTO stu_provisional SET fname='%s', mname='%s', lname='%s', mother='%s', dob='%s', contact='%s', p_contact='%s', gender='%s', caste_id='%s', religion_id='%s', country_id='%d', state_id='%d', city_id='%d', addr_premanent='%s', addr_corespond='%s',c_certi='%s',weight='%f', height='%f', duration_id='%d', fixedfees='%d', feespaid='%d', remark='%s',fileno='%s', prov_date=CURDATE(), status=1", $fname, $mname, $lname, $mother, $dob, $contact, $p_contact, $gender, $caste, $religion,$country, $state, $city, $p_address, $c_address, $c_certi, floatval($weight), floatval($height), $duration_id, $fixedfees, $feespaid, $remark, $fileno);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
	$last_id=mysqli_insert_id($con);
$que = sprintf("DELETE FROM stu_cancel_prov WHERE cancel_id='%d'", $id);
if (!($res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}	
	
/************************************/
$status='CANCEL';	
	$que = sprintf("INSERT INTO stu_renew SET prov_id='%d', status='%s',renew_date=CURDATE()", $last_id, $status);
	if (!($res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
	
	
	/*******************COURSE DETAILS************************/
		
		$prefer = 1;
	for($i=0;$i<=count($course_id)-1;$i++)
	{				
		if($course_id[$i]!=0){
		$query_shp = sprintf("INSERT INTO stu_prov_course SET prov_id='%d',prefer_no='%d', course_id='%d'", $last_id, $prefer, $course_id[$i]);
		if (!($result_shp = $con->query($query_shp))){ echo "FOR QUERY: $query_shp<BR>".$con->error; 	exit;}
		$prefer = $prefer+1;
		}		
	}
	$que = sprintf("DELETE FROM stu_cancel_course WHERE cancel_id='%d'", $id);
	if (!($res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
	/**********************************************/
	
	/********************QUALIFICATION DETAILS***********************/
	
	for($i=0;$i<=count($edu_id)-1;$i++)
	{	
		if($edu_id[$i]!=0){			
		$query_edu = sprintf("INSERT INTO stu_prov_edu SET prov_id='%d',edu_id='%d', percent='%d'", $last_id, $edu_id[$i], $percent[$i]);
		if (!($result_edu = $con->query($query_edu))){ echo "FOR QUERY: $query_edu<BR>".$con->error; 	exit;}
		}
	}
	$que = sprintf("DELETE FROM stu_cancel_edu WHERE cancel_id='%d'", $id);
	if (!($res = $con->query($que))){ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
	/**********************************************/
	
	/********************DOCUMENT DETAILS**************************/
		$query_doc = sprintf("INSERT INTO stu_prov_document SET prov_id='%d', tenth='%s', twelth='%s', diploma='%s', ug='%s', pg='%s', tc='%s', ncl='%s', cast='%s', validity='%s', nationality='%s', domicile='%s', income='%s', gap='%s', photo='%s', birth='%s', medical='%s', id_proof='%s', other='%s'", $last_id, $tenth, $twelth, $diploma, $ug, $pg, $tc, $ncl, $cast, $validity, $nationality, $domicile, $income, $gap, $photo, $birth, $medical, $idproof, $other_doc);
		if (!($result_doc = $con->query($query_doc))){ echo "FOR QUERY: $query_doc<BR>".$con->error; 	exit;}		
	/**********************************************/
	
	/********************FEES DETAILS**************************/
		$due_date=date('Y-m-d',strtotime("+15 day"));
		$query_fees = sprintf("INSERT INTO stu_prov_fees SET prov_id='%d', fees_paid='%f', pay_date=CURDATE(), pay_time=CURTIME(), due_date='%s'", $last_id, $feespaid, $due_date);
		if (!($result_fees = $con->query($query_fees))){ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}		
	/**********************************************/



	header("Location: index.php?flag=add");	
	exit;

?>