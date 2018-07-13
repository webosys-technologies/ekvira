<?php
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];
$name = $_POST['name'];
$item_qty= $_POST['item_qty'];
$p_name=$_POST['p_name'];
$other=$_POST['other'];

if($mode=="del")
{
	$id= $_REQUEST['id'];

		$query=sprintf("DELETE FROM stu_book WHERE id ='%d'", $id);
		if(!($result = $con->query($query))){echo $con->error; exit;}
		header("Location:index.php?flag=bookdel");
		exit;
	
}
$id= $_POST['id'];	
if($id=="")
{
	$query_add=sprintf("INSERT INTO stu_book SET book_name='%s',qty='%d',publication='%s',other='%s'",$name, $item_qty, $p_name, $other);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?flag=bookadd");
	exit;
	
}

if($id!="")
{	

	$qadd=sprintf("UPDATE stu_book SET book_name='%s',qty='%d',publication='%s',other='%s' WHERE id='%d'",$name, $item_qty, $p_name,$other, $id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?flag=bookedit");
	exit;	
	
}
?>