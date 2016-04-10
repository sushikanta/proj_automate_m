<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'];
$result=mysqli_query($con, "DELETE FROM `dr_info` WHERE dr_id = '$id'");
if (!$result) { echo "Failed to Delete: "; http_response_code(404); }
else          { echo "ok"; }
?>