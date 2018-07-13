<?php
require '../../../common/connect.php';

$id=$_REQUEST['id'];
$stock_type = $_REQUEST['stock_type'];
$mode=$_POST['mode'];
$items_study = $_POST['items_study'];
$items_phy = $_POST['items_phy'];

if($stock_type=='return'){
	for($i=0;$i<=count($items_study)-1;$i++)
		{	if($items_study[$i]!=0){			
			$query_add=sprintf("Update stu_prov_item SET return_date=CURDATE(), return_time=CURTIME() where prov_id='%d' and stock_id='1' and item_id='%d' and return_date IS NULL", $id, $items_study[$i]);
			if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
			}
		}
		
		
		
		for($i=0;$i<=count($items_phy)-1;$i++)
		{	
			if($items_phy[$i]!=0){			
		 $query_add=sprintf("Update stu_prov_item SET return_date=CURDATE(), return_time=CURTIME() where prov_id='%d' and stock_id='2' and item_id='%d' and return_date IS NULL", $id, $items_phy[$i]);
			if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
			}
		}
		$flag='return';
}
else{

	for($i=0;$i<=count($items_study)-1;$i++)
	{	if($items_study[$i]!=0){			
		$query_add=sprintf("INSERT INTO stu_prov_item SET prov_id='%d', stock_id='1', item_id='%d', allocate_date=CURDATE(), allocate_time=CURTIME()", $id, $items_study[$i]);
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
		}
	}
	
	
	
	for($i=0;$i<=count($items_phy)-1;$i++)
	{	
		if($items_phy[$i]!=0){			
	 $query_add=sprintf("INSERT INTO stu_prov_item SET prov_id='%d', stock_id='2', item_id='%d', allocate_date=CURDATE(), allocate_time=CURTIME()", $id, $items_phy[$i]);
		if (!($result_add = $con->query($query_add))){ echo "FOR QUERY: $query_add<BR>".$con->error; 	exit;}
		}
	}
	$flag='add';
}
	if($mode=='new')
	{
	//header("Location: ../view.php?id=$id&flag=non&mode=$mode");
	header("Location: ../duedate.php?id=$id&flag=non&mode=$mode");
	}else{
	header("Location: index.php?flag=$flag");
	}
	exit;
?>