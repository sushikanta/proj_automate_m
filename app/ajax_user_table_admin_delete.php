<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;

$result=mysqli_query($con, "DELETE FROM `user_table` WHERE `user_id` = '$id'"); 

if (!$result)
      { echo "Opps ! Delete Failed";}
else  {echo 'ok';}

mysqli_close($con);
?>