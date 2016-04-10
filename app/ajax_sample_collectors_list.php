<?php include("function.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT `UTC_id`, `UTC_user_name` FROM `user_technician_tbl` WHERE `UTC_dept_id` = '4' ORDER BY `UTC_user_name` DESC");
 
 echo "{"; 	    
        while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['UTC_id']."' :'".$row['UTC_user_name']."'," ;  
	   }
 echo "}";
?>
    