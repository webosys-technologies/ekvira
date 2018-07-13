<?php
session_start();
$u_type=$_SESSION['u_type'];
include("../../common/connect.php");
$mode = $_REQUEST['txtmode'];

if($mode=="inactive")
{
	$id= $_REQUEST['id'];
	$staff_type=$_REQUEST['f_type'];
	$query=sprintf("UPDATE stu_t_subject SET status=0 WHERE id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	header("Location:index.php?flag=del");
	exit;
}
if($mode=="del")
{
	$id= $_REQUEST['id'];
	$staff_type=$_REQUEST['f_type'];
	$query=sprintf("DELETE FROM stu_t_subject WHERE id ='%d'", $id);
	if(!($result = $con->query($query))){echo $con->error; exit;}
	$query=sprintf("DROP TABLE s_".$id."_a");
	if(!($result = $con->query($query))){echo $con->error;}
	$query=sprintf("DROP TABLE s_".$id."_m");
	if(!($result = $con->query($query))){echo $con->error;}
	header("Location:index.php?flag=del");
	exit;
}
$id=$_POST['id'];
$teacher_id=$_POST['teacher_id'];
$subject_id = $_POST['subject_id'];
$f_user=trim($_POST['f_user']);
$f_pass = trim($_POST['f_pass']);
$re_pass = trim($_POST['re_pass']);

if($id=="")
{	
if($f_pass!=$re_pass)
{
	header("Location:add.php?flag=passerr&id=$id");
	exit;
}
$usertype='TU';
	$sql="SELECT * FROM stu_t_subject WHERE teacher_id = '".$teacher_id."'";
	if (!($result = $con->query($sql))) 
			{ echo "FOR QUERY: $sql<BR>".$con->error; 	exit;}
	$rowCount = $con->affected_rows;
   if($rowCount>0){
   		$row = $result->fetch_assoc();
		$user_id = $row['user_id'];
   		$query_add=sprintf("INSERT INTO stu_t_subject SET teacher_id='%d', sub_id='%d', user_id='%d'", $teacher_id, $subject_id, $user_id);	
		if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
   }else{
		
		$query_add=sprintf("INSERT INTO login SET usertype='%s', username='%s', password='%s'", $usertype, $f_user, $f_pass);	
		if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
		$user_id=mysqli_insert_id($con);;
		$query_add=sprintf("INSERT INTO stu_t_subject SET teacher_id='%d', sub_id='%d', user_id='%d'", $teacher_id, $subject_id, $user_id);	
		if(!($result_add = $con->query($query_add))){echo $con->error; exit;}
   }
	
	/*******************************************/
	header("Location:index.php?flag=add");
	exit;
}

if($id!="")
{	
if($f_pass!=$re_pass)
{
	header("Location:edit.php?flag=passerr&id=$id");
	exit;
}
 $que_tab="SELECT * FROM ".$table_name." LIMIT 1";
 if(!($check_tab = $con->query($que_tab))){
	$user_id = $_POST['user_id'];
	if($u_type=='SU'){
		$qadd=sprintf("UPDATE login SET username='%s', password='%s' WHERE id='%d'", $f_user, $f_pass, $user_id);
		if(!($res = $con->query($qadd))){echo $con->error; exit;}
	}else{
		$qadd=sprintf("UPDATE login SET password='%s' WHERE id='%d'", $f_pass, $user_id);
		if(!($res = $con->query($qadd))){echo $con->error; exit;}
	}
		
	$qadd=sprintf("UPDATE stu_t_subject SET teacher_id='%d', sub_id='%d' WHERE id='%d'",$teacher_id, $subject_id, $id);		
	if(!($res = $con->query($qadd))){echo $con->error; exit;}
	header("Location:index.php?flag=edit");
	exit;	
}
}
?>