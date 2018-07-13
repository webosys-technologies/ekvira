<?php
include("common/connect.php");

/*$que='truncate table stu_cancel_course';
$result=$con->query($que);
$que='truncate table stu_cancel_edu';
$result=$con->query($que);
$que='truncate table stu_cancel_prov';
$result=$con->query($que);
$que='truncate table stu_enquiry';
$result=$con->query($que);
$que='truncate table stu_enq_course';
$result=$con->query($que);
$que='truncate table stu_prov_leave';
$result=$con->query($que);
$que='truncate table stu_provisional';
$result=$con->query($que);
$que='truncate table stu_prov_course';
$result=$con->query($que);
$que='truncate table stu_prov_document';
$result=$con->query($que);
$que='truncate table stu_prov_edu';
$result=$con->query($que);
$que='truncate table stu_prov_item';
$result=$con->query($que);
$que='truncate table stu_prov_fees';
$result=$con->query($que);
$que='truncate table stu_t_subject';
$result=$con->query($que);
$que='truncate table stu_faculty';
$result=$con->query($que);
$que='truncate table stu_prov_book';
$result=$con->query($que);
$que='truncate table stu_book';
$result=$con->query($que);
$que='truncate table stu_mark_det';
$result=$con->query($que);
$que='truncate table stu_faculty_sal';
$result=$con->query($que);
$que='truncate table stu_subject';
$result=$con->query($que);
$que='truncate table stu_study_stock';
$result=$con->query($que);
$que='truncate table stu_physical_stock';
$result=$con->query($que);

$que="select id from stu_t_subject";
$result=$con->query($que);
while($row=$result->fetch_assoc()){
$id=$row['id'];
$tab_a='s_'.$id.'_a';
$tab_m='s_'.$id.'_m';
$que1='drop table $tab_a';
$result1=$con->query($que1);
$que2='drop table $tab_m';
$result2=$con->query($que2);
}
*/
header("Location:index.php?flag=success");
exit;

?>
