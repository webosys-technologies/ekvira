<?php
include("../../../common/connect.php");
$flag=$_GET['flag'];
$table_name ='stu_t_student';

if($flag=='edit'){
	//$val = 0;
	$id=$_GET['t_sub_id'];
	$t_sub_id='s_'.$id;
	$stu_id=$_GET['stu_id'];
	echo $query_add=sprintf("UPDATE stu_t_attendance SET ".$t_sub_id."=IF(".$t_sub_id."=1, 0, 1) WHERE stud_id='%d'", $stu_id);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	header("Location:index.php?flag=edit&id=$id");
	exit;
}else{
	$t_sub_id=$_POST['t_sub_id'];
	$t_sub_id='s_'.$t_sub_id;
	$stu_id=$_POST['stu_id'];
	$val = 1;
	for($i=0;$i<=count($stu_id)-1;$i++)
	{
		$query_add=sprintf("UPDATE stu_t_attendance SET ".$t_sub_id."='%d' WHERE stud_id='%d'", $val, $stu_id[$i]);	
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	}
	header("Location:../index.php?flag=non");
	exit;
}
?>