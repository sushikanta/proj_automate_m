<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `emp_prev_company` WHERE `emp_prev_comp_id` = '$id'");
if (!$result) { echo "Delete failed !"; }
else          { echo "ok"; }
mysqli_close($con);
?>