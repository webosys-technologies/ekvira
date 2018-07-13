<?php
require '../../../common/connect.php';

$id=$_REQUEST['id'];
$stock_type = $_REQUEST['stock_type'];
$mode=$_POST['mode'];
$books = $_POST['books'];

if($stock_type=='return'){
	for($i=0;$i<=count($books)-1;$i++)
		{	if($books[$i]!=0){			
			$query_add=sprintf("Update stu_prov_book SET return_date=CURDATE(), return_time=CURTIME() where prov_id='%d' and book_id='%d' and return_date IS NULL", $id, $books[$i]);
			if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
			}
		}

		$flag='return';
}
else{

	for($i=0;$i<=count($books)-1;$i++)
	{	if($books[$i]!=0){			
		$query_add=sprintf("INSERT INTO stu_prov_book SET prov_id='%d', book_id='%d', allocate_date=CURDATE(), allocate_time=CURTIME()", $id, $books[$i]);
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
		}
	}
	
	$flag='add';
}
	
	header("Location: index.php?flag=$flag");
	exit;
?>