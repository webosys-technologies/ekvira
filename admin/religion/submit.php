<?php
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];
$name = $_POST['name'];


if($mode=="del")
{
	$id= $_REQUEST['id'];

	$query=sprintf("DELETE FROM stu_religion WHERE religion_id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	header("Location:index.php?flag=del");
	exit;
}
$id= $_POST['id'];	
if($id=="")
{
	$query_add=sprintf("INSERT INTO stu_religion SET religion='%s'", $name);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?flag=add");
	exit;

}

if($id!="")
{	
	$qadd=sprintf("UPDATE stu_religion SET religion='%s' WHERE religion_id='%d'", $name, $id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?flag=edit");
	exit;	
}
?>