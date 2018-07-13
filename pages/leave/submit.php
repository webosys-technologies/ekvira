<?php
require '../../common/connect.php';

if(isset($_POST['prov_id'])){
$prov_id = $_POST['prov_id'];
$mode = $_POST['mode'];
if($mode=='grant')
{
$start = dateformate($_POST['datepicker']);
$end = dateformate($_POST['datepicker1']);
$reason = $_POST['reason'];
$query_add=sprintf("INSERT INTO stu_prov_leave SET prov_id='%d', open_date='%s', open_time=CURTIME(), close_date='%s', close_time=CURTIME(), reason='%s'", $prov_id, $start, $end, $reason);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	//$last_id=mysqli_insert_id($con);
	//header("Location: index.php?flag=add");
	header("Location: leaveprint.php?id=$prov_id&flag=non");	
	exit;
}
if($mode=='return'){	
$ret_date = dateformate($_POST['datepicker']);
$remark = $_POST['remark'];
$query_add=sprintf("UPDATE stu_prov_leave SET return_date='%s', return_time=CURTIME(), remark='%s', prov_id='%d'", $ret_date, $remark, $prov_id);	
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
	//$last_id=mysqli_insert_id($con);
	//header("Location: index.php?flag=add");
	header("Location: leave_status.php?id=$prov_id&flag=non");	
	exit;
}	
}
header("Location: index.php?flag=err");	
	exit;
?>