<?php
session_start();
$u_type=$_SESSION['u_type'];
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];

if($mode=="del")
{
	$id= $_REQUEST['id'];

	$query=sprintf("DELETE FROM login WHERE id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	header("Location:index.php?flag=del");
	exit;
}
$id= $_POST['id'];
$username = $_POST['usrname'];
$password = trim($_POST['pswd']);
$password1 = trim($_POST['repswd']);
$usertype = $_POST['usertype'];
if($password==$password1){
 $valid=1;
}else{
 $valid=0;
}	
if($id=="")
{
	if($valid==1){
	$query_add=sprintf("INSERT INTO login SET usertype='%s', username='%s', password='%s'", $usertype, $username, $password);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?flag=add");
	exit;
	}else{
		header("Location:index.php?flag=unmatch");
		exit;
	}
}

if($id!="")
{	
	if($valid==1){
		if($u_type=='SU'){
			$qadd=sprintf("UPDATE login SET username='%s', password='%s' WHERE id='%d'", $username, $password, $id);
			if(!($res = $con->query($qadd))){echo $con->error; exit;}
			header("Location:index.php?flag=edit");
			exit;
		}else{
			$qadd=sprintf("UPDATE login SET password='%s' WHERE id='%d'", $password, $id);
			if(!($res = $con->query($qadd))){echo $con->error; exit;}
			header("Location:../../logout.php?flag=passchange");
			exit;
		}
	}else{
		header("Location:edit.php?id=$id&flag=unmatch");
		exit;
	}
		
}
?>