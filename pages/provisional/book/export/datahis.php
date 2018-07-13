<table width="100%" border="1" class="tbl">
  <thead>
    <tr>
      <th colspan="5">STUDENT LIBRARY BOOK ALLOCATION HISTORY</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>Export Date :-</th>
      <th><div align="left">
        <?=date('d-m-Y')?>
      </div></th>
    </tr>
    <tr>
      <th width="6%">SR. NO.</th>
      <th width="8%">File No.</th>
      <th width="8%">Student ID</th>
      <th width="21%">Full Name</th>
      <th width="8%">Contact No.</th>
      <th width="14%">Book Name</th>
      <th width="15%">Publication</th>
      <th width="8%">Other</th>
      <th width="22%">Allocation Date / Time</th>
      <th width="24%">Return Date / Time</th>
    </tr>
  </thead>
  <tbody class='ms'>
    
	<?php
			include("../../../../common/connect.php");
			
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
	
	
					$query_stock = sprintf("SELECT * FROM stu_prov_book WHERE prov_id='%d' and return_date IS NOT NULL order by allocate_date ASC", $id);
					if (!($result_stock = $con->query($query_stock))) 
					{ echo "FOR QUERY: $query_stock<BR>".$con->error; 	exit;}
					$rowCount3 = $con->affected_rows;
				if($rowCount3>0)
					{
					$i=1;
						while($row_book = $result_stock->fetch_assoc())
						{
							$book_id = $row_book['book_id'];
						
							$allocate_date = $row_book['allocate_date'];
							$allocate_time = $row_book['allocate_time'];
							$return_date = $row_book['return_date'];
							$return_time = $row_book['return_time'];
							

											
											$que_study="SELECT * FROM stu_book where id=$book_id";
											if (!($book_res = $con->query($que_study))){ echo "FOR QUERY: $que_study<BR>".$con->error; 	exit;}
											if($row_book_name=$book_res->fetch_assoc()){
											$book_n=$row_book_name['book_name'];
											$detail=$row_book_name['publication'];
											$other=$row_book_name['other'];	
										
										
								
			  ?>
    <tr>
      <td><div align="center">
        <?=$i++;?>
      </div></td>
      <td><div align="center">
        <?=$row_prov['fileno']?>
      </div></td>
      <td><div align="center"><?php echo getstuid($row_prov['prov_date']).$id;?></div></td>
      <td><div align="center">
        <?=$fullname?>
      </div></td>
      <td><div align="center">
        <?=$row_prov['contact']?>
      </div></td>
      <td><div align="center">
        <?=$book_n?>
      </div></td>
      <td><div align="center">
        <?=$detail?>
      </div></td>
      <td><div align="center">
        <?=$other?>
      </div></td>
      <td><div align="center">
        <?=$allocate_date.' <strong>/</strong> '.$allocate_time?>
      </div></td>
      <td><div align="center">
        <?=$return_date.' <strong>/</strong> '.$return_time?>
      </div></td>
    </tr>
    <?php }}} else{ echo '<font color="#FF0000"><B>NO PREVIOUS HISTORY</b></font>'; } }?>
  </tbody>
</table>
