<?php require_once("config.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT `test_category_id`, `test_category_name` FROM `test_category`");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['test_category_id']."' :'".$row['test_category_name']."'," ;  
	   }
 echo "}";
?>
    