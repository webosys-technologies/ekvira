<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 $date=date('d-m-y-his');
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=LibraryCurrent-".$date."-export.xls");
 
// Add data table
include 'datacur.php';
?>