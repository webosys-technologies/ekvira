<?php 
include("../../../../common/connect.php");
$id = $_GET['id'];
$tablename = $_GET['tname'];
if($id > 0)
{	
		$query = sprintf("SELECT * FROM stu_t_subject WHERE id='%d'", $id);
		if (!($result = $con->query($query))){ echo "FOR QUERY: $query<BR>".$con->error; 	exit;}
		
		$rowCount = $con->affected_rows; 
		
				$clcnt=0;
				if($row_t_sub=$result->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$teacher_id=$row_t_sub['teacher_id'];
					$sub_id=$row_t_sub['sub_id'];
					
					$query_teacher = sprintf("SELECT * FROM stu_faculty WHERE id='%d'", $teacher_id);
					if (!($result_teacher = $con->query($query_teacher))) 
					{ echo "FOR QUERY: $query_teacher<BR>".$con->error; 	exit;}
					$row_teacher = $result_teacher->fetch_assoc();
					$teacher = $row_teacher['name'];
					
					$query_sub = sprintf("SELECT * FROM stu_subject WHERE sub_id='%d'", $sub_id);
					if (!($result_sub = $con->query($query_sub))) 
					{ echo "FOR QUERY: $query_sub<BR>".$con->error; 	exit;}
					$row_sub = $result_sub->fetch_assoc();
					$subject = $row_sub['subject'];
				}
}				
?>
  <!-- End -->
  <table width="100%" border="1" class="tbl">
    <tr style="font-size:30px;">
      <td colspan="4" align="center">STUDENT ATTENDANCE ENTRY</td>
    </tr>
    <tr style="font-size:14px;">
      <td width="19%"><strong>
        <h3>Faculty Name :-</h3>
      </strong></td>
      <td width="34%"><?=$teacher?></td>
      <td width="25%"><strong>
        <h3>Subject Name :-</h3>
      </strong></td>
      <td width="22%"><?=$subject?></td>
    </tr>
  </table>
<?php
//echo $table_name ='s_'.$id.'_m';
$sql="SELECT * FROM ".$tablename;	   
if ($result=mysqli_query($con,$sql))
{
  echo '<table width="34%" border="1" align="center" class="tbl"><thead><tr>';
  // Get field information for all fields
  echo "<th>SR. NO.</th>";
  while ($fieldinfo=mysqli_fetch_field($result))
    {
		$colname=$fieldinfo->name;
			
					$query_max = sprintf("SELECT * FROM stu_mark_det WHERE table_name='%s' and col_name='%s'", $tablename, $colname);
					if (!($result_max = $con->query($query_max))){ echo "FOR QUERY: $query_max<BR>".$con->error; 	exit;}
					if ($row_max=$result_max->fetch_assoc()) 
					{
					$max_mark=$row_max['max_mark'];
					}
			
	 
		if($colname=='id'){
			echo "<th>Student ID</th>";
		}elseif($colname=='stud_id'){
			echo "<th>Name</th>";
		}else{
			echo "<th style='font-size:9px;'>".datefromcol($colname)." (".$max_mark.")</th>";
		}
    }
	echo "</tr></thead>";
	$cnt=0;
	while($rows=$result->fetch_row()){
	 $cnt++;
		  echo "<tr>";
		  for($i=0;$i<=$result->field_count-1;$i++){
			  	if($i==0){
					echo "<td align='center'>".$cnt."</td>";
				}elseif($i==1){
					$que="SELECT * FROM stu_provisional WHERE prov_id=".$rows[$i];
					if (!($page_res = $con->query($que))) 
						{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
						$rowCount = $con->affected_rows; 
					if($row_prov=$page_res->fetch_assoc())
					{ 
						$prov_id=$row_prov['prov_id'];
						$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
						echo "<td>".getstuid($row_prov['prov_date']).$prov_id."</td>";
						echo "<td>".$fullname."</td>";
					}
				
				}else{
					echo "<td>".$rows[$i]."</td>";
				}

		  }
		  echo "</tr>";		
	}
	
  echo "</table>";	
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);
exit;		
//}
?>