<?php require_once("function.php"); ?>
 
<?php 
 $result = mysqli_query($con, "SELECT RT_id, RT_name FROM relation_type");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['RT_id']."' :'".$row['RT_name']."'," ;  
	   }
 echo "}";
?>
    