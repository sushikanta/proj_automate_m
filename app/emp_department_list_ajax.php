<?php require_once("function.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT `department_id`, `department_name` FROM `department_tbl` WHERE `department_id` >'2'  ORDER BY `department_name` ASC");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['department_id']."' :'".$row['department_name']."'," ;  
	   }
 echo "}";
?>
    