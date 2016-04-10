<?php require_once("config.php"); ?> 
<?php 
 $result = mysqli_query($con, "SELECT source_id, source_name FROM source_tbl WHERE source_id > '3'");
 echo "{";
       while($row=mysqli_fetch_array($result)) {	
        echo "'".$row['source_id']."' :'".$row['source_name']."'," ;  
	   }
 echo "}";
?>
    