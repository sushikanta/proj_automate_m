<?php include("function.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT `department_id`, `department_name` FROM `department_tbl` WHERE `department_id` ='5' OR `department_id` ='6' OR `department_id` ='7' OR `department_id` ='8' ORDER BY `department_name` ASC");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['department_id']."' :'".$row['department_name']."'," ;  
	   }
 echo "}";
?>
    