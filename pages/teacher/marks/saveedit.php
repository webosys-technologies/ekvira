<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = mysql_query("UPDATE stu_prov_marksheet set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id=".$_POST["id"]." AND prov_id=".$_POST["stu_id"]);
if($result){
echo "success";
}
?>
