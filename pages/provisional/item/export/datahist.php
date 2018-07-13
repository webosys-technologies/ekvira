 <?php
 include('../../../../common/connect.php');
	   $condition2=" ORDER BY prov_id DESC";	
			
		$que="SELECT * FROM stu_provisional $condition2";
		
		if (!($page_res = $con->query($que))) 
			{ echo "FOR QUERY: $que<BR>".$con->error; 	exit;}
			$rowCount = $con->affected_rows;  
	   ?>
       
        <table width="100%" border="1" class="tbl">
          <thead>
            <tr>
              <th colspan="5">STOCK ITEMS  ALLOCATION HISTORY SHEET</th>
              <th><div align="right">EXPORT DATE :- </div></th>
              <th><div align="left">
                  <?=date('d-m-Y')?>
              </div></th>
            </tr>
            <tr>
              <th width="5%">SR. NO.</th>
              <th width="8%">File NO.</th>
              <th width="23%">Full Name</th>
              <th width="12%">Contact No.</th>
              <th width="5%">M/F</th>
              <th width="23%">Study Item List</th>
              <th width="24%">Physical Item List</th>
              </tr>
          </thead>
          <tbody class='ms'>
          <?php
		  		
				$clcnt=1;
		
				while($row_prov=$page_res->fetch_assoc())
				{ 
					if($clcnt%2==0){$class="even";}else{$class="";}
					//$clcnt++;
					$id=$row_prov['prov_id'];
					$fullname=stripslashes($row_prov['fname']." ".$row_prov['mname']." ".$row_prov['lname']);
					$contact = $row_prov['contact'];
					$gender = $row_prov['gender'];
					$fileno = $row_prov['fileno'];
					
					$query_study = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d' and stock_id=1 and return_date IS NOT NULL", $id);
					if (!($result_study = $con->query($query_study))) 
					{ echo "FOR QUERY: $query_study<BR>".$con->error; 	exit;}
					$rowCount1 = $con->affected_rows;
					
					$query_phy = sprintf("SELECT * FROM stu_prov_item WHERE prov_id='%d'and stock_id=2 and return_date IS NOT NULL", $id);
					if (!($result_physical = $con->query($query_phy))) 
					{ echo "FOR QUERY: $query_phy<BR>".$con->error; 	exit;}
					$rowCount2 = $con->affected_rows;
		
								
			  ?>
            <tr>
              <td><div align="center">
                  <?=$clcnt++;?>
              </div></td>
              <td><div align="center">
                <?=$fileno?>
              </div></td>
              <td><div align="center">
                <?=$fullname?>
              </div></td>
              <td>
                <div align="center">
                  <?=$contact?>
                  </div></td>
              <td>
                <div align="center">
                  <?=$gender?>
                  </div></td>
              <td><div align="center">
                <?php 
			  		if($rowCount1>0)
					{
					$i=0;
						while($row_item = $result_study->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$study_item_id = $row_item['item_id'];
							if($stock_id='1'){
								$i++;
								
									$que_study="SELECT * FROM stu_study_stock where id=$study_item_id"; 
									if (!($item_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
									if($row_item_name=$item_res->fetch_assoc()){
										echo $i.'.'.$row_item_name['item_name'].' ';
									}
							}
						
						}
					}
			  ?>
              </div></td>
              <td><div align="center">
                <?php 
			  		if($rowCount2>0)
					{
					$i=0;
						while($row_item = $result_physical->fetch_assoc())
						{
							$stock_id = $row_item['stock_id'];
							$phy_item_id = $row_item['item_id'];
							if($stock_id='2'){
								$i++;
								
									$que_phy="SELECT * FROM stu_physical_stock where id=$phy_item_id"; 
									if (!($item_res_phy = $con->query($que_phy))){ echo "FOR QUERY: $que_phy<BR>".$con->error; 	exit;}
									if($row_item_phy=$item_res_phy->fetch_assoc()){
										echo $i.'.'.$row_item_phy['item_name'].' ';
									}
							}
						
						}
					}
			  ?> 
              </div></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
