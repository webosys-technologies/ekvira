<?php
require '../../common/connect.php';
$id = $_POST['id'];
$mode = $_POST['mode'];
$target_dir = "upload/";

 $oldname = basename($_FILES["fileToUpload"]["name"]);
 $tempold = explode(".", $_FILES["fileToUpload"]["name"]);

 	$newfilename = $id .'.'. end($tempold);

//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $target_file = $target_dir . $newfilename ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
       // echo "File is not an image.";
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
		//echo "Sorry, your file is too large.";
		$flag='too_large';
		$uploadOk = 0;
	}


	if ($_FILES["fileToUpload"]["size"] > 51250) {
		//echo "Sorry, your file is too large.";
		$flag='too_large';
		$uploadOk = 0;
	}

// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$flag='non_img';
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   //echo "Sorry, your file was not uploaded.";
	//if($mode=='old')
	//{
		header("Location:photoupload.php?id=$id&flag=$flag&mode=$mode");
	//}else
	//{
		//header("Location:view.php?id=$id&flag=$flag&mode=$mode");
		//header("Location:photoupload.php?id=$id&flag=$flag&mode=$mode");
	//}	
	exit;
// if everything is ok, try to upload file
} 
else 
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$imgname=basename( $_FILES["fileToUpload"]["name"]);
		
		if (!($update = $con->query("update stu_provisional set photo_url='$newfilename' where prov_id=$id"))) 
			{ 
			
			if($mode=='old')
				{
					header("Location:photoupload.php?id=$id&flag=error&mode=$mode");
				}else{
					header("Location:view.php?id=$id&flag=error&mode=$mode");
				}
				exit;
			
			}else{
			
				//if($mode=='old')
				//{
					header("Location:photoupload.php?id=$id&flag=ok&mode=$mode");
			//	}else{
					//header("Location:item/item_allocate.php?id=$id&flag=ok&mode=$mode");
			//	}
				exit;
			
			}
		
	}
}
?>