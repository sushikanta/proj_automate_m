<?php require_once("function.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT `designation_id`, `designation_name` FROM `designation_tbl` ORDER BY `designation_name` ASC");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['designation_id']."' :'".$row['designation_name']."'," ;  
	   }
 echo "}";
?>
    