<?php
        
        require_once("dbcontroller.php");
        
        $db_handle = new DBController();
        $sql7 = "UPDATE stu_prov_marksheet set teacher_status= 1 WHERE prov_id=".$_POST["stu_id"];
        mysql_query($sql7);
        ?>
