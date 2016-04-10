<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `employee_letter` WHERE `EL_sl` = '$id'");
if (!$result) { echo "Delete failed !"; }
else          { echo "ok"; }

mysqli_close($con);
?>