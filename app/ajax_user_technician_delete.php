<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;

$result=mysqli_query($con, "DELETE FROM `user_technician_tbl` WHERE  `UTC_id` = '$id'");

if (!$result)
      { echo "Opps ! something is wrong..."; }
else  {  echo 'ok';}

mysqli_close($con);
?>