<?php
include('../../common/connect.php');
include("../../common/getid.php");

$teach_id = intval($_GET['teacher']);
$sub_id = intval($_GET['sub']);

$sql="SELECT * FROM stu_t_subject WHERE teacher_id = '".$teach_id."' and sub_id = '".$sub_id."'";
if (!($result = $con->query($sql))){ echo "FOR QUERY: $sql<BR>".$con->error; 	exit;}
$rowCount = $con->affected_rows;
if($rowCount>0){
		$sql="SELECT name FROM stu_faculty WHERE id = '".$teach_id."'";
		if (!($result = $con->query($sql))){ echo "FOR QUERY: $sql<BR>".$con->error; 	exit;}
		if($row=$result->fetch_assoc()){ $teacher=$row['name']; }
		
		$sql1="SELECT subject FROM stu_subject WHERE sub_id = '".$sub_id."'";
		if (!($result1 = $con->query($sql1))){ echo "FOR QUERY: $sql1<BR>".$con->error; 	exit;}
		if($row1=$result1->fetch_assoc()){ $subject=$row1['subject']; }
	echo 'You have already allocated <strong>'.$subject.'</strong> Subject to <strong>'.$teacher.'</strong>';
}else{
$sql1="SELECT * FROM stu_t_subject WHERE teacher_id = '".$teach_id."'";
if (!($result1 = $con->query($sql1))){ echo "FOR QUERY: $sql1<BR>".$con->error; exit;}
$t_Count = $con->affected_rows;
	if($t_Count>0){
		echo 'tyes';
	}else{
		echo 'tno';
	}
}

mysqli_close($con);
?>