<?php
include("../../common/connect.php");
$txtmode=$_POST['txtmode'];
$t_sub_id=$_POST['t_sub_id'];
$table_name = 's_'.$t_sub_id.'_a';
$table_name1 = 's_'.$t_sub_id.'_m';
$stu_id=$_POST['stu_id'];

if($txtmode=='allocate'){
for($i=0;$i<=count($stu_id)-1;$i++)
{
	$query_id=sprintf("INSERT INTO ".$table_name." SET stud_id=%d, faculty_id=%d",$stu_id[$i],$t_all_id);	
        
	if(!($result_id = $con->query($query_id))){echo $con->error; exit;}
	echo $stu_id[$i];
	$query_id=sprintf("INSERT INTO ".$table_name1." SET stud_id=%d,faculty_id=%d",$stu_id[$i],$t_all_id);	
	if(!($result_id = $con->query($query_id))){echo $con->error; exit;}
	echo $stu_id[$i];
}
header("Location:index.php?flag=allocate");
exit;
}
else{
for($i=0;$i<=count($stu_id)-1;$i++)
{
	$query_id=sprintf("DELETE FROM ".$table_name." WHERE stud_id='%d'",$stu_id[$i]);	
	if(!($result_id = $con->query($query_id))){echo $con->error; exit;}
	$query_id=sprintf("DELETE FROM ".$table_name1." WHERE stud_id='%d'",$stu_id[$i]);	
	if(!($result_id = $con->query($query_id))){echo $con->error; exit;}
}
	/*******************************************/
	header("Location:index.php?flag=deallocate");
	exit;
}
?>