<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `emp_qualification_tbl` WHERE `emp_qualf_id` = '$id'");
if (!$result) { echo "Delete failed: $result"; }
else          { echo "ok"; }
mysqli_close($con);
?>