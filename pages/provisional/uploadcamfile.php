<?php
require '../../common/connect.php';
$id = $_POST['id'];
$img_type = $_POST['img_type'];
$mode = $_POST['mode'];
$target_dir = "upload/";
$old_dir="webcam/images/";
if($img_type=='webcam'){
	$imgurl=$_POST['camimg'];
	$imgarray=explode('/',$imgurl);
	$filename=$imgarray[count($imgarray)-1];
	$tempold = explode(".", $filename);
 	$newfilename = $id . '_photo.' . end($tempold);
	$newfilepath = $target_dir.$newfilename;
	$oldfilepath=$old_dir.$filename;
	if (file_exists($newfilepath)) {
    //echo "Sorry, file already exists. and deleted";
		unlink($newfilepath);
   // $uploadOk = 0;
	}
	if(rename($oldfilepath,$newfilepath)){
	if($update = $con->query("update stu_provisional set photo_url='$newfilename' where prov_id=$id")){echo $con->error; }
		if($mode=='old'){
			header("Location:../uploadimg/index.php?id=$id&flag=add&mode=$mode");
		}else{
			header("Location:item/item_allocate.php?id=$id&flag=add&mode=$mode");
		}
	}
	else
	{
	header("Location:webcam/index.php?id=$id&flag=error&mode=$mode");
	}
	exit;
}else{

 $oldname = basename($_FILES["fileToUpload"]["name"]);
 $tempold = explode(".", $_FILES["fileToUpload"]["name"]);

 	$newfilename = $id . '_photo.' . end($tempold);

//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $target_file = $target_dir . $newfilename ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
		$flag='not_img';
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists. and deleted";
	unlink($target_file);
   // $uploadOk = 0;
}
// Check file size

	if ($_FILES["fileToUpload"]["size"] > 102400) {
		echo "Sorry, your file is too large.";
		$flag='too_large';
		$uploadOk = 0;
	}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$flag='non_img';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	header("Location:photoupload.php?id=$id&flag=$flag&mode=$mode");
	exit;
} 
else 
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$imgname=basename( $_FILES["fileToUpload"]["name"]);
		echo $que = "update stu_provisional set photo_url='$newfilename' where prov_id=$id";
		if($result = $con->query("select photo_url from stu_provisional where prov_id=$id and photo_url IS NULL")){echo $con->error; }
		if($con->affected_rows)
		{
			if($update = $con->query("update stu_provisional set photo_url='$newfilename' where prov_id=$id")){echo $con->error; }
			if($con->affected_rows)
			{
				header("Location:photoupload.php?id=$id&flag=ok&mode=$mode");
				exit;
			}	
			else
			{
				echo "Sorry, there was an error uploading your file.";
				header("Location:photoupload.php?id=$id&flag=error&mode=$mode");
				exit;
			}
		}else{
			header("Location:photoupload.php?id=$id&flag=ok&mode=$mode");
		}
		
		
}
}
}
?> 