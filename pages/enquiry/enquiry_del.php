<?php 
    require '../../common/connect.php';
	$id= $_REQUEST['id'];
	echo $id;
	echo $query=sprintf("DELETE FROM stu_enquiry WHERE enq_id='%d'", $id);
	if (!($result = $con->query($query))){ 
		echo "FOR QUERY: $query<BR>".$con->error; 	
		exit;
	}
	$query_course=sprintf("DELETE FROM stu_enq_course WHERE enq_id ='%d'", $id);
	if (!($result_course = $con->query($query_course))){ echo "FOR QUERY: $query_course<BR>".$con->error; 	exit;}
	
	header("Location:list-enquiry.php?flag=del");
	
?>