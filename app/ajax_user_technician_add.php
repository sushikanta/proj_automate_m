<?php include("function.php"); ?>
<?php 

$user_id = getCounter_value($con, 28);
$username = mysqli_real_escape_string($con, $_REQUEST['username']);
$full_name = mysqli_real_escape_string($con, $_REQUEST['full_name']);

$result = mysqli_query($con, "INSERT INTO `user_technician_tbl`(`UTC_id`, `UTC_user_name`, `UTC_full_name`, `UTC_dept_id`) VALUES ('$user_id', '".$username."', '".$full_name."', '4')");

if (!$result) { echo "Insert failed !"; }
else          { echo "ok"; }

mysqli_close($con);
?>