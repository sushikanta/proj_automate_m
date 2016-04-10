<?php include("function.php");?>
<?php include("header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">
		
        
<div class="inv-main">

    <div class="panel panel-info">
          <div class="panel-heading">Add Investigation Details (Admin Section)</div>
          
          
          <div class="table">
          <table class="table table-striped">
          <thead>
          <th>SL #</th>
          <th>Patient ID</th>
          <th>Discount Code</th>
          <th>Per (%)</th>
          <th>Amount</th>
          <th>Remark</th>
          <th>Action</th>
          </thead>
          <tr>
          <?php 
		  
		  $result=mysqli_query($con, "SELECT patient_disc_id, patient_id, disc_code, disc_value, patient_disc_tbl.disc_type_id, disc_remark FROM patient_disc_tbl, disc_code_tbl, disc_value_tbl WHERE patient_disc_tbl.disc_code_id = disc_code_tbl.disc_code_id AND patient_disc_tbl.disc_value_id=disc_value_tbl.disc_value_id order by disc_code desc limit 0,10");
		$sl_no=1;
		while($row=mysqli_fetch_array($result))
	    {
	     
		echo '<td>' .$sl_no .'</td>';
        echo  '<td>'. $row['patient_id'] . '</td>';
        echo   '<td>'. $row['disc_code'] . '</td>';
        if($row['disc_type_id']==1){echo  '<td>' . $row['disc_value'] .'</td>';} else{ echo '<td>' . "-" .'</td>';}
        if($row['disc_type_id']==2){echo  '<td>' . $row['disc_value'] .'</td>';} else{ echo '<td>' . "-" .'</td>';}
		echo '<td>' . $row['disc_remark'].'</td>';
		echo '<td>' .'<a href="discount_code_edit.php?disc_id='.$row['patient_disc_id'].'">'.'Edit'.'</a>'.'&nbsp;'.'<a href="discount_code_edit.php">Del</a>'.'</td>';
        echo '</tr>';
		$sl_no++;
		}
		  
            
          ?>
        
          </table>
        </div>
       </div>
  
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>   
   <script src="js/add_investigationDetails.js"></script>
  </body>
</html>