<?php 
    require '../../../common/connect.php';

	$reason = $_GET['reason'];
	$id = $_GET['id'];
	if($reason!=''){
	$que=sprintf("SELECT * FROM stu_provisional WHERE prov_id='%d'", $id); 
	if (!($page_res = $con->query($que))) { echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
		
		
				$clcnt=0;
		
if($row_prov=$page_res->fetch_assoc())
{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					//$id=$row_prov['prov_id'];
					//$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$fname = $row_prov['fname'];
					$mname = $row_prov['mname'];
					$lname = $row_prov['lname'];
					$mother = $row_prov['mother'];
					$dob = dateformate($row_prov['dob']);
					$contact = $row_prov['contact'];
					$p_contact = $row_prov['p_contact'];
					$gender = $row_prov['gender'];
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$country_id = $row_prov['country_id'];
					$state_id = $row_prov['state_id'];
					$city_id = $row_prov['city_id'];
					$p_address = $row_prov['addr_premanent'];
					$c_address = $row_prov['addr_corespond'];
					$c_certi = $row_prov['c_certi'];
					$weight = $row_prov['weight'];
					$height = $row_prov['height'];
					$duration_id = $row_prov['duration_id'];
					$fixedfees = $row_prov['fixedfees'];
					$feespaid = $row_prov['feespaid'];
					$remark = $row_prov['remark'];
					$fileno = $row_prov['fileno'];
					$photo_url = $row_prov['photo_url'];
					$prov_date = $row_prov['prov_date'];
					

	
	$query_add=sprintf("INSERT INTO stu_cancel_prov SET fname='%s', mname='%s', lname='%s', mother='%s', dob='%s', contact='%s', p_contact='%s', gender='%s', caste_id='%d', religion_id='%d', country_id='%d', state_id='%d', city_id='%d', addr_premanent='%s', addr_corespond='%s', c_certi='%s',weight='%f', height='%f', duration_id='%d', fixedfees='%d', feespaid='%d', photo_url='%s', remark='%s', fileno='%s', reason='%s', prov_date='%s', cancel_date=CURDATE()", $fname, $mname, $lname, $mother, $dob, $contact, $p_contact, $gender, $caste_id, $religion_id, $country_id, $state_id, $city_id, $p_address, $c_address, $c_certi, $weight, $height, $duration_id, $fixedfees, $feespaid, $photo_url, $remark, $fileno, $reason, $prov_date);
	if (!($result_add = $con->query($query_add))) { echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}	
	$last_id=mysqli_insert_id($con);


//insert into cancel branch table

	$query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $id);
			if (!($result_prov_course = $con->query($query_prov_course))) { echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}
			$b_cnt=1;
			while($row_prov_course = $result_prov_course->fetch_assoc())
		{
			$course_id = $row_prov_course['course_id'];
			$prefer = $row_prov_course['prefer_no'];
						
		$query_shp = sprintf("INSERT INTO stu_cancel_course SET cancel_id='%d',prefer_no='%d', course_id='%d'", $last_id, $prefer, $course_id);
		if (!($result_shp = $con->query($query_shp))) { echo "FOR QUERY: $query_shp<BR>".$con->error; 	exit;}
		}


//insert into cancel edu table

$query_prov_edu = sprintf("SELECT * FROM stu_prov_edu WHERE prov_id='%d'", $id);
			if (!($result_prov_edu = $con->query($query_prov_edu))) { echo "FOR QUERY: $query_prov_edu<BR>".$con->error; 	exit;}
			$b_cnt=1;
			while($row_prov_edu = $result_prov_edu->fetch_assoc())
		{
			$edu_id = $row_prov_edu['edu_id'];
			$percent = $row_prov_edu['percent'];
						
		$query_shp1 = sprintf("INSERT INTO stu_cancel_edu SET cancel_id='%d',edu_id='%d', percent='%f'", $last_id, $edu_id, $percent);
		if (!($result_shp1 = $con->query($query_shp1))) { echo "FOR QUERY: $query_shp1<BR>".$con->error; 	exit;}
		}

	
	
	
	$query=sprintf("DELETE FROM stu_provisional WHERE prov_id='%d'", $id);
	if (!($result = $con->query($query))) { echo "FOR QUERY: $query<BR>".$con->error; 	exit;}
	
	$query_course=sprintf("DELETE FROM stu_prov_course WHERE prov_id ='%d'", $id);
	if (!($result_course = $con->query($query_course))) { echo "FOR QUERY: $query_course<BR>".$con->error; 	exit;}
	
	$query_edu=sprintf("DELETE FROM stu_prov_edu WHERE prov_id='%d'", $id);
	if (!($result_edu = $con->query($query_edu))) { echo "FOR QUERY: $query_edu<BR>".$con->error; 	exit;}
	
	$query_doc=sprintf("DELETE FROM stu_prov_document WHERE prov_id ='%d'", $id);
	if (!($result_doc = $con->query($query_doc))) { echo "FOR QUERY: $query_doc<BR>".$con->error; 	exit;}
	
	$query_lev=sprintf("DELETE FROM stu_prov_leave WHERE prov_id='%d'", $id);
	if (!($result_lev = $con->query($query_lev))) { echo "FOR QUERY: $query_lev<BR>".$con->error; 	exit;}
	
	//header("Location: index.php?flag=del");

}	
header("Location: index.php?flag=cancel");
exit;
}else{
header("Location: index.php?flag=rerror");
exit;
}


?>