<?php
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];
$stock = $_REQUEST['stock'];
$name = $_POST['name'];
$item_qty= $_POST['item_qty'];
$p_name=$_POST['p_name'];
$other=$_POST['other'];

if($mode=="del")
{
	$id= $_REQUEST['id'];

	if($stock=='study'){
		$query=sprintf("DELETE FROM stu_study_stock WHERE id ='%d'", $id);
		if(!($result = $con->query($query))){echo $con->error; exit;}
		header("Location:index.php?stock=study&flag=del");
		exit;
	}else{
		$query=sprintf("DELETE FROM stu_physical_stock WHERE id ='%d'", $id);
		if(!($result = $con->query($query))){echo $con->error; exit;}
		header("Location:index.php?stock=physical&flag=del");
		exit;
	
	}
	
}
$id= $_POST['id'];	
if($id=="")
{

	if($stock=='study'){
	$query_add=sprintf("INSERT INTO stu_study_stock SET item_name='%s',qty='%d',publication='%s',other='%s'",$name, $item_qty, $p_name, $other);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?stock=study&flag=add");
	exit;
	}
	else{
	$query_add=sprintf("INSERT INTO stu_physical_stock SET item_name='%s',qty='%d',brand='%s',other='%s'",$name, $item_qty, $p_name, $other);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?stock=physical&flag=add");
	exit;
	}


}

if($id!="")
{	

	if($stock=='study'){
	$qadd=sprintf("UPDATE stu_study_stock SET item_name='%s',qty='%d',publication='%s',other='%s' WHERE id='%d'",$name, $item_qty, $p_name,$other, $id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?stock=study&flag=edit");
	exit;	
	}
	else
	{
	$qadd=sprintf("UPDATE stu_physical_stock SET item_name='%s',qty='%d',brand='%s',other='%s' WHERE id='%d'",$name, $item_qty, $p_name,$other, $id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?stock=physical&flag=edit");
	exit;
	}
}
?>