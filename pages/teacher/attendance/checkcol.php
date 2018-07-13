<script>
function checkcol() {
var adate = document.getElementById("a_date").value;
var t_id = <?=$id?>;
    if (adate == "") {
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
				var a = this.responseText;
				if(a=='true')
				{
					document.getElementById("a_date").value="";
				}				
            }
        };
		
        xmlhttp.open("GET","checkcol.php?tid=" +t_id+ "&adate=" +adate,true);
        xmlhttp.send();
    }
}
</script>


<?php
include('../../common/connect.php');

$t_S_id = intval($_GET['tid']);
$a_date = $_GET['adate'];

$sql="SELECT * FROM stu_t_subject WHERE teacher_id = '".$teach_id."' and sub_id = '".$sub_id."'";
if (!($result = $con->query($sql))){ echo "FOR QUERY: $sql<BR>".$con->error; 	exit;}
$rowCount = $con->affected_rows;
if($rowCount>0){
		$sql="SELECT name FROM stu_faculty WHERE id = '".$teach_id."'";
		if (!($result = $con->query($sql))){ echo "FOR QUERY: $sql<BR>".$con->error; 	exit;}
		if($row=$result->fetch_assoc()){ $teacher=$row['name']; }
		
		$sql1="SELECT subject FROM stu_subject WHERE sub_id = '".$sub_id."'";
		if (!($result1 = $con->query($sql1))){ echo "FOR QUERY: $sql1<BR>".$con->error; 	exit;}
		if($row1=$result1->fetch_assoc()){ $subject=$row1['subject']; }
	echo 'You have already allocated <strong>'.$subject.'</strong> Subject to <strong>'.$teacher.'</strong>';
}else{
$sql1="SELECT * FROM stu_t_subject WHERE teacher_id = '".$teach_id."' and sub_id != '".$sub_id."'";
if (!($result1 = $con->query($sql1))){ echo "FOR QUERY: $sql1<BR>".$con->error; exit;}
$t_Count = $con->affected_rows;
	if($t_Count>0){
		echo 'tyes';
	}else{
		echo 'tno';
	}
}

mysqli_close($con);
?>