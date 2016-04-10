<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `designation_tbl` WHERE `designation_id` ='$id'");
if (!$result) { echo "Delete failed: $result"; }
else          { echo "ok"; }
?>