<?php include("function.php"); ?>
 
<?php 
 $result_status = mysqli_query($con, "SELECT `status_id`, `status_name` FROM `status_tbl`");
 echo "{";
       while($row=mysqli_fetch_array($result_status)) {	
        echo "'".$row['status_id']."' :'".$row['status_name']."'," ;  
	   }
 echo "}";
?>
    