<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `emp_prev_company` WHERE `emp_prev_comp_id` = '$id'");
if (!$result) { echo "Delete failed: $result"; }
else          { echo "ok"; }
?>