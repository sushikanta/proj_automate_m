<?php require_once("config.php"); ?>
<?php
 $result = mysqli_query($con, "SELECT state_id, state_name FROM state_tbl");
 echo "{";
       while($row=mysqli_fetch_array($result)) {
        echo "'".$row['state_id']."' :'".$row['state_name']."'," ;
	   }
 echo "}";
?>
