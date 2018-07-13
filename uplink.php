<?php
$target_file='install.php';

	if (file_exists($target_file)) {
		unlink($target_file);
	}
	header("Location:index.php?flag=success");
	exit;
?>