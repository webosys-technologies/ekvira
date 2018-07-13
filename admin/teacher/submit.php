<?php
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];

if($mode=="inactive")
{
	$id= $_REQUEST['id'];
	$staff_type=$_REQUEST['f_type'];
	$query=sprintf("UPDATE stu_faculty SET status=0 WHERE id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	header("Location:index.php?flag=del&staff=$staff_type");
	exit;
}
if($mode=="del")
{
	$id= $_REQUEST['id'];
	$staff_type=$_REQUEST['f_type'];
	$query=sprintf("DELETE FROM stu_faculty WHERE id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	header("Location:index.php?flag=del&staff=$staff_type");
	exit;
}
$id=$_POST['id'];
$staff_type=$_POST['f_type'];
$name = $_POST['name'];
$dob = dateformate($_POST['dob']);
$gender = $_POST['gender'];
$desig = $_POST['desig'];
$quali = $_POST['quali'];
$addr = $_POST['addr'];
$contact = $_POST['contact'];
$doj = dateformate($_POST['doj']);
$sal = $_POST['sal'];
$exp = $_POST['exp'];
$other = $_POST['other'];	
if($id=="")
{
	$query_add=sprintf("INSERT INTO stu_faculty SET type='%s', name='%s', dob='%s', gender='%s', designation='%s', qualification='%s', address='%s', contact='%s', doj='%s', salary='%f', experience='%f', other='%s'", $staff_type, $name, $dob, $gender, $desig, $quali, $addr, $contact, $doj, $sal, $exp, $other);	
	if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
	/*******************************************/
	header("Location:index.php?flag=add&staff=$staff_type");
	exit;
}

if($id!="")
{	
	$qadd=sprintf("UPDATE stu_faculty SET name='%s', dob='%s', gender='%s', designation='%s', qualification='%s', address='%s', contact='%s', doj='%s', salary='%f', experience='%f', other='%s' WHERE id='%d'",$name, $dob, $gender, $desig, $quali, $addr, $contact, $doj, $sal, $exp, $other,$id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?flag=edit&staff=$staff_type");
	exit;	
}

?>