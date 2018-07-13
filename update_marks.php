<?php
session_start();
    
extract($_POST);
error_reporting(0);
    require 'common/connect.php';
    include("common/getid.php");
    if ($_SESSION['authorised']) {
        $state = $_SESSION['authorised'];
        $val = calcID();
        if ($val != $state) {
            header("Location:common/developer.php?flag=non");
            exit;
        }
    } else {
        header("Location:index.php?flag=err");
        exit;
    }

    $squery_marks = sprintf("SELECT * FROM stu_term_marks WHERE term='%d' AND exam='%s' AND subject='%s' AND sub_exam='%s' AND skill='%d' AND level='%d'", 
            $term,$exam,$subject,$sub_exam,$skill,$skill_option1);
    if (!($result_marks = $con->query($squery_marks))) {
        echo $con->error;
        exit;
    }

    $row_marks = $result_marks->fetch_assoc();


    if ($skill_option1 == 1) {
        $skill_option = 'Listening_option';
    } elseif ($skill_option1 == 2) {
        $skill_option = 'Speaking_option';
    } elseif ($skill_option1 == 3) {
        $skill_option = 'Writing_option';
    } elseif ($skill_option1 == 4) {
        $skill_option = 'Reading_option';
    }

    if($row_marks>0)
    {
        $id = $row_marks['id'];
        //update
        //Insert records into marks table
        $query_marks = sprintf("UPDATE stu_term_marks SET 
        exam_date = '$exam_date',
        term = '$term',
        exam = '$exam',
        subject = '$subject',
        sub_exam = '$sub_exam',
        skill = '$skill',
        level = '$skill_option1',
        radio_value = '$skill_option',
        stu_id = '$stu_id',
        course_id = '$class',
        section_id = '$section' WHERE id='$id'");
        $query_marks_insert = $con->query($query_marks);
        echo 'Record has been updated successfully!';
    }
    else
    {
        //Insert records into marks table
        $query_marks = sprintf("INSERT INTO stu_term_marks SET 
        exam_date = '$exam_date',
        term = '$term',
        exam = '$exam',
        subject = '$subject',
        sub_exam = '$sub_exam',
        skill = '$skill',
        level = '$skill_option1',
        radio_value = '$skill_option',
        stu_id = '$stu_id',
        course_id = '$class',
        section_id = '$section'");
        $query_marks_insert = $con->query($query_marks);
        echo 'Record has been added successfully!';
    }
    
?>