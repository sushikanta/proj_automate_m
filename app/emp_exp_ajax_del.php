<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'];
$result = mysqli_query($con, "DELETE FROM emp_prev_experience WHERE PE_id = '$id'");
if (!$result) { echo "ERROR: Delete Failed !"; mysqli_error($con); http_response_code(404);  }
else          { echo "ok"; }
?>