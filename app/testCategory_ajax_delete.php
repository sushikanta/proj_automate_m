<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `test_category` WHERE test_category_id = '$id'");
if (!$result) { echo "Delete failed: $result"; }
else          { echo "ok"; }
mysqli_close($con);
?>