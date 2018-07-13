<?php
session_start();
        
        require_once("dbcontroller.php");
        
        $db_handle = new DBController();
        $user_type =$_SESSION['u_type'];
        $user_id =$_SESSION['user_id'];
        $ts=1;
        if($user_type =='SU'){
        $sql7 = "UPDATE stu_prov_marksheet set admin_lock= $ts   WHERE prov_id=".$_POST["stu_id"];
        $sql8 = "UPDATE stu_prov_marksheet set admin_role= '$user_type'  WHERE prov_id=".$_POST["stu_id"];
        $sql9 = "UPDATE stu_prov_marksheet set admin_update_id= $user_id  WHERE prov_id=".$_POST["stu_id"];
        
        mysql_query($sql7);
        mysql_query($sql8);
        mysql_query($sql9);
        }
        else if($user_type == 'TU'){
//             echo $user_type;
        $sql7 = "UPDATE stu_prov_marksheet set teacher_status= $ts   WHERE prov_id=".$_POST["stu_id"];
        $sql8 = "UPDATE stu_prov_marksheet set teacher_role= '$user_type'   WHERE prov_id=".$_POST["stu_id"];
        $sql9 = "UPDATE stu_prov_marksheet set teacher_update_id= $user_id   WHERE prov_id=".$_POST["stu_id"];
       
        mysql_query($sql7);
        mysql_query($sql8);
        mysql_query($sql9);
        }
        //,teacher_role=".$_POST['user_type']."
        ?>
