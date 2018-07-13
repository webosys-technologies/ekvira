<?php
include("../../../common/connect.php");
$id=$_POST['t_sub_id'];
$max_mark=$_POST['max_mark'];
$colexist=$_POST['colexist'];
$table_name ='s_'.$id.'_m';
$col_name=columnname($_POST['m_date']);
$stu_id=$_POST['stu_id'];
$stu_mark=$_POST['stu_mark'];
if($colexist==0){
	$que_col="ALTER TABLE ".$table_name." ADD COLUMN ".$col_name." INT(3) default 0";
	if (!($res_col = $con->query($que_col))){
		header("Location:index.php?flag=nostudent");
 		exit;
	}
}
	for($i=0;$i<=count($stu_id)-1;$i++)
	{
		$query_add=sprintf("UPDATE ".$table_name." SET ".$col_name."='%d' WHERE stud_id='%d'", $stu_mark[$i], $stu_id[$i]);	
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	}
	
	$exam_date=dateformate($_POST['m_date']);
	$query_m=sprintf("INSERT INTO stu_mark_det SET table_name='%s',col_name='%s',exam_date='%s',max_mark='%d'", $table_name,$col_name,$exam_date,$max_mark);	
		if (!($result_m = $con->query($query_m))){ echo "FOR QUERY: $query_m<BR>".$con->error; exit;}
		
	header("Location:index.php?flag=non");
	exit;
?>