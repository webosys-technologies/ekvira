<?php
require '../../../common/connect.php';
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo '<response>';

	$id=$_GET['tid'];
	$table_name ='s_'.$id.'_a';
	$col_name=$_GET['col_name'];
	$stu_id=$_GET['stud_id'];
if(isset($_GET['flag'])){
		$val = $_GET['flag'];
		$query_add=sprintf("UPDATE ".$table_name." SET ".$col_name."=1");
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
}else{
	$query_add=sprintf("UPDATE ".$table_name." SET ".$col_name."=IF(".$col_name."=1, 0, 1) WHERE stud_id='%d'", $stu_id);
	if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; exit;}
}	
	
echo '</response>';
?>

