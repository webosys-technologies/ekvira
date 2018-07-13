<?php 
    require '../../../common/connect.php';
	$fid= $_REQUEST['fid'];
	$prov_id= $_REQUEST['id'];
	//echo $id;
	$query=sprintf("DELETE FROM stu_prov_fees WHERE fees_id='%d'", $fid);
	if (!($result = $con->query($query))){ echo "FOR QUERY: $query<BR>".$con->error; 	exit;}
		
	header("Location: view.php?id=$prov_id&flag=del");
?>