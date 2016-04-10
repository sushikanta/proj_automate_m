<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'];
$result = mysqli_query($con, "DELETE FROM emp_letter WHERE EL_id = '$id'");
if (!$result) { echo "ERROR: Delete Failed !"; mysqli_error($con); http_response_code(404);  }
else          { echo "ok"; }
?>