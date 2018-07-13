<?php
require '../../../common/connect.php';
$id = $_POST['id'];	
$feesamt = $_POST['feesamt'];
$duedate=dateformate($_POST['duedate']);


	
	/********************FEES DETAILS**************************/
		$query_fees = sprintf("INSERT INTO stu_prov_fees SET prov_id='%d', fees_paid='%f', pay_date=CURDATE(), pay_time=CURTIME(), due_date='%s'", $id, $feesamt, $duedate);
		if (!($result_fees = $con->query($query_fees))){ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}		
	/**********************************************/
	
	//header("Location: index.php?flag=add");
	//header("Location: photoupload.php?id=$last_id&flag=non&type=non");
	header("Location: index.php?flag=paid");	
	exit;
?>