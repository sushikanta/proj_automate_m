<?php include("config.php"); ?>
<?php
$id = $_REQUEST['id'] ;
$result=mysqli_query($con, "DELETE FROM `dr_profile` WHERE `dr_id` = '$id'");
if (!$result) { echo "Delete failed: ".$id; }
else          { echo "ok"; }
mysqli_close($con);
?>