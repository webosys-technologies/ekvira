<?php
include("../../../common/connect.php");
$id=$_POST['id'];
$staff_type=$_POST['staff'];
$p_date=dateformate($_POST['p_date']);
$salary=$_POST['salary'];
$month=$_POST['month'];

	echo $query_add=sprintf("INSERT INTO stu_faculty_sal SET faculty_id='%d', pay_amt='%f', pay_month='%d', pay_date='%s'",$id, $salary, $month, $p_date);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	header("Location:index.php?flag=add&staff=$staff_type");
	exit;
?>