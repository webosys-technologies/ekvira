<?php
require '../../../common/connect.php';

$id = $_REQUEST['id'];
$doc_type = $_REQUEST['doc'];
$val = $_REQUEST['value'];


if($val=='NO'){
 	$query = sprintf("UPDATE stu_prov_document SET $doc_type='YES' WHERE prov_id='%d'", $id); 
}else{
	$query = sprintf("UPDATE stu_prov_document SET $doc_type='NO' WHERE prov_id='%d'", $id); 
}
if(!($page_res=$con->query($query))){ echo $query.mysql_error(); exit;}
   
	header("Location: edit-document.php?flag=docedit&id=$id&doctype=$doc_type");
	exit;
?>
