<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'];
$result=mysqli_query($con, "DELETE FROM `dr_clinic_tbl` WHERE DC_id = '$id'");
if (!$result) { echo "Failed to Delete: ".$id; http_response_code(404); }
else          { echo "ok"; }
?>