<?php 
    require '../../common/connect.php';
	$id= $_REQUEST['id'];
	echo $id;
	echo $query=sprintf("DELETE FROM stu_provisional WHERE prov_id='%d'", $id);
	if (!($result = $con->query($query))){ echo "FOR QUERY: $query<BR>".$con->error; 	exit;}
	
	$query_branch=sprintf("DELETE FROM stu_prov_course WHERE prov_id ='%d'", $id);
	if (!($result_branch = $con->query($query_branch))){ echo "FOR QUERY: $query_branch<BR>".$con->error; exit;}
	
	$query_edu=sprintf("DELETE FROM stu_prov_edu WHERE prov_id ='%d'", $id);
	if (!($result_edu = $con->query($query_edu))){ echo "FOR QUERY: $query_edu<BR>".$con->error; exit;}
	
	$query_doc=sprintf("DELETE FROM stu_prov_document WHERE prov_id ='%d'", $id);
	if (!($result_doc = $con->query($query_doc))){ echo "FOR QUERY: $query_doc<BR>".$con->error; exit;}
	
	header("Location: index.php?flag=del");
?>