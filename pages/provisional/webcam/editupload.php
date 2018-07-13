<?php
require '../../../common/connect.php';
/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */
$id = $_GET['id'];
$mode = $_GET['mode'];
if($mode=='f'){
	$filename = $mode.'_'.$id.'.jpg';
	$result = file_put_contents( '../upload/'.$filename, file_get_contents('php://input') );
	if (!$result) {
		//print "ERROR: Failed to write data to $filename, check permissions\n";
		header("Location:../../../admin/teacher/view.php?id=$id&flag=err&mode=$mode");
		exit();
	}
	
	if($update = $con->query("update stu_faculty set photo_url='$filename' where id=$id")){echo $con->error; }
	if($con->affected_rows)
	{
		header("Location:../../../admin/teacher/view.php?id=$id&flag=success&mode=$mode");
		exit;
	}	
}else{
	$filename = $id.'.jpg';
  		$result = file_put_contents( '../upload/'.$filename, file_get_contents('php://input') );
		if (!$result) {
			//print "ERROR: Failed to write data to $filename, check permissions\n";
			header("Location:index.php?id=$id&flag=err&mode=$mode");
			exit();
		}
		
		if($update = $con->query("update stu_provisional set photo_url='$filename' where prov_id=$id")){echo $con->error; }
		if($con->affected_rows)
		{
			header("Location:index.php?id=$id&flag=success&mode=$mode");
			exit;
		}	
}
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/images/' . $filename;
print "$url";

?>
