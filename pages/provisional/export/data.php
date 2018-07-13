<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<table width="100%" border="1" >
         <thead>
          <tr>
            <th colspan="11"><span class="style1">STUDENT PROVISIONAL ADMISSION DETAILS SHEET</span></th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="3">Export Date :-</th>
            <th colspan="4"><div align="left">
              <?=date('d-m-Y')?>
            </div></th>
           </tr>
          <tr>
            <th width="4%">SR. NO.</th>
            <th width="8%">File No.</th>
            <th width="8%">Student ID</th>
            <th width="21%">Full Name</th>
            <th width="8%">Mother</th>
            <th width="8%">DOB</th>
            <th width="8%">Contact No.</th>
            <th width="5%">Parent Contact</th>
            <th width="5%">Gender</th>
            <th width="7%">Course</th>
            <th width="6%">Religion</th>
            <th width="6%">Caste</th>
            <th width="13%">Correspondent Address</th>
            <th width="13%">Permanent Address</th>
            <th width="9%">C-Certificate</th>
            <th width="9%">Weight</th>
            <th width="9%">Height</th>
            <th width="9%">Course Duration</th>
            <th width="9%">Total Fees</th>
            <th width="9%">Fees Paid</th>
            <th width="9%">Fees Balance</th>
            <th width="9%">Admission Date</th>
            <th width="7%">Status</th>
            <th width="7%">Remark</th>
            </tr>
            </thead>
			<tbody class='ms'>
             <?php
			 include("../../../common/connect.php");
			$condition2=" ORDER BY prov_id ASC";	
			$que="SELECT * FROM stu_provisional $condition2";
			
			if (!($page_res = $con->query($que))) 
				{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
				$rowCount = $con->affected_rows; 
				$clcnt=0;
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$caste_id = $row_prov['caste_id'];
					$religion_id = $row_prov['religion_id'];
					$city_id = $row_prov['city_id'];
					$state_id = $row_prov['state_id'];
					$country_id = $row_prov['country_id'];
					$d_id = $row_prov['duration_id'];
					$addr_premanent = $row_prov['addr_premanent'];
					$addr_corespond = $row_prov['addr_corespond'];
					$remark = $row_prov['remark'];
					$fixedfees = $row_prov['fixedfees'];
					$prov_date = dateformate($row_prov['prov_date']);
					$current_date = date("Y-m-d");
					$t1 = strtotime($current_date);
					$t2 = strtotime($prov_date);
					$diff = abs($t1 - $t2)/3600;
					$days = $diff/24;
					$noofdays = floor($days)+1;
					if($noofdays>60)
					{
						$adm_status='OLD';
					}else if($noofdays>15 and $noofdays<=60){
						$adm_status='REGULAR';
					}else{
						$adm_status='NEW';
					}
					
					
					$query_caste = sprintf("SELECT * FROM stu_caste WHERE caste_id='%d'", $caste_id);
					if (!($result_caste = $con->query($query_caste))) 
					{ echo "FOR QUERY: $query_caste<BR>".$con->error; 	exit;}
					$row_caste = $result_caste->fetch_assoc();
					$caste = $row_caste['caste'];
					
					$query_religion = sprintf("SELECT * FROM stu_religion WHERE religion_id='%d'", $religion_id);
					if (!($result_religion = $con->query($query_religion))) 
					{ echo "FOR QUERY: $query_religion<BR>".$con->error; 	exit;}
					$row_religion = $result_religion->fetch_assoc();
					$religion = $row_religion['religion'];
					
					$query_city = sprintf("SELECT * FROM city WHERE city_id='%d'", $city_id);
					if (!($result_city = $con->query($query_city))) 
					{ echo "FOR QUERY: $query_city<BR>".$con->error; 	exit;}
					$row_city = $result_city->fetch_assoc();
					$city = $row_city['city_name'];
					
					$query_state = sprintf("SELECT * FROM state WHERE state_id='%d'", $state_id);
					if (!($result_state = $con->query($query_state))) 
					{ echo "FOR QUERY: $query_state<BR>".$con->error; 	exit;}
					$row_state = $result_state->fetch_assoc();
					$state = $row_state['state_name'];
					
					$query_country = sprintf("SELECT * FROM country WHERE country_id='%d'", $country_id);
					if (!($result_country = $con->query($query_country))) 
					{ echo "FOR QUERY: $query_country<BR>".$con->error; 	exit;}
					$row_country = $result_country->fetch_assoc();
					$country = $row_country['country_name'];
					
					$c_addr=$country.', '.$state.', '.$city.', '.$addr_corespond;
					$p_addr=$country.', '.$state.', '.$city.', '.$addr_premanent;
					
					$query_d = sprintf("SELECT * FROM stu_duration WHERE d_id='%d'", $d_id);
					if (!($result_d = $con->query($query_d))) 
					{ echo "FOR QUERY: $query_d<BR>".$con->error; 	exit;}
					$row_d = $result_d->fetch_assoc();
					$duration = $row_d['duration'];
					
					$query_fees = sprintf("SELECT * FROM stu_prov_fees WHERE prov_id='%d' order by fees_id ASC", $id);
					if (!($result_fees = $con->query($query_fees))) 
					{ echo "FOR QUERY: $query_fees<BR>".$con->error; 	exit;}
					$tot_fees_paid=0;
					while($row_fees = $result_fees->fetch_assoc()){
					$fees_paid = $row_fees['fees_paid'];
					$tot_fees_paid = $fees_paid + $tot_fees_paid;
					}
			  ?>
          <tr  style="text-transform:uppercase;">
            <td><div align="center">
              <?=$clcnt?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['fileno']?>
            </div></td>
            <td><div align="center"><?php echo getstuid($row_prov['prov_date']).$id;?></div></td>
            <td><div align="center">
              <?=$fullname?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['mother']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['dob']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['contact']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['p_contact']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['gender']?>
            </div></td>
            <td>
				    <div align="center">
				      <?php
					$query_prov_course = sprintf("SELECT * FROM stu_prov_course WHERE prov_id='%d'", $id);
					if (!($result_prov_course = $con->query($query_prov_course))) 
					{ echo "FOR QUERY: $query_prov_course<BR>".$con->error; 	exit;}

					$b_cnt=1;
					while($row_prov_course=$result_prov_course->fetch_assoc())
				{
					$course_id = $row_prov_course['course_id'];
					
					$query_course = sprintf("SELECT * FROM stu_course where course_id='%d'",$course_id);
						if(!($result_course = $con->query($query_course)))
						{
							echo "FOR QUERY: $query_course<BR>".$con->error; 	
							exit;
						}
					$row_course = $result_course->fetch_assoc();
					$course = $row_course['course'];
					echo $b_cnt.'.'.$course.' ';
					$b_cnt++;
				}
			?>            
		      </div></td>
            
            <td><div align="center">
              <?=$religion?>
            </div></td>
            <td><div align="center">
              <?=$caste?>
            </div></td>
            <td><div align="center">
              <?=$c_addr?>
            </div></td>
            <td><div align="center">
              <?=$p_addr?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['c_certi']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['weight']?>
            </div></td>
            <td><div align="center">
              <?=$row_prov['height']?>
            </div></td>
            <td><div align="center">
              <?=$duration?>
            </div></td>
            <td><div align="center">
              <?=$fixedfees?>
            </div></td>
            <td><div align="center">
              <?=$tot_fees_paid?>
            </div></td>
            <td><div align="center">
              <?=$fixedfees-$tot_fees_paid?>
            </div></td>
            <td><div align="center">
              <?=$prov_date?>
            </div></td>
            <td><div align="center">
                <?=$adm_status?>
            </div></td>
            <td><div align="center">
              <?=$remark?>
            </div></td>
            </tr>
             <?php
				}?>
         </tbody>
        </table>
