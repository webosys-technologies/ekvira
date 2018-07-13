<?php
session_start();
session_destroy();
$flag = $_GET['flag'];
header ("Location: index.php?flag=passchange");
?>

