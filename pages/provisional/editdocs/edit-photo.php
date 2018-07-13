<?php
require '../../../common/connect.php';
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo '<response>';
$photo = $_GET['photo'];
$id = $_GET['id'];

//$que = sprintf("SELECT photo from stu_prov_document WHERE prov_id='%d'", $id); 
//if(!($result=mysql_query($que))){ echo $que.mysql_error(); exit;}
//$row = mysql_fetch_array($result);
//$photo_count = $row['photo'];

$query = sprintf("UPDATE stu_prov_document SET photo='%s' WHERE prov_id='%d'",$photo, $id); 
if(!($page_res=$con->query($query))){ echo $query.mysql_error(); exit;}

$que = sprintf("SELECT photo from stu_prov_document WHERE prov_id='%d'", $id); 
if(!($result=$con->query($que))){ echo $que.mysql_error(); exit;}
$row = $result->fetch_assoc();
$photo_count = $row['photo'];

echo $photo_count;
/* $food = $_GET['photo'];
 $foodArray = array('tuna','becon','beef','loaf');
 if(in_array($food,$foodArray))
 		echo 'We do have '.$food. '!';
 elseif($food=='')
 		echo 'enter some food';
 else
 		echo 'sorry we dont sell no ' .$food. '!';  */
echo '</response>';
?>

