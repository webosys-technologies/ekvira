<?php
require '../../../common/connect.php';
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */
$id = $_POST['id'];
$fname = $_POST['fname'];
//$filename = date('YmdHis') . '.jpg';
$target_dir = "../upload/";
$filename = $id . '_photo.'. '.jpg';
$target_file = $target_dir . $filename;

// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists. and deleted";
	unlink($target_file);
   // $uploadOk = 0;
}

$result = file_put_contents( '../upload/'.$filename, file_get_contents('php://input') );
if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	header("Location:index.php?id=$id&flag=ferror")
	exit();
}else{
	if($update = $con->query("update stu_provisional set photo_url='$filename' where prov_id=$id")){echo $con->error; }
}
if($con->affected_rows)
{
	header("Location:../item/item_allocate.php??id=$id&flag=non")
}else{
	header("Location:index.php?id=$id&flag=derror")
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/images/' . $filename;
print "$url $filename";

?>
