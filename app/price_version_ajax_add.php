<?php require_once("function.php"); ?>
<?php
    resetCounter($con, 9, 'yy');
	$user_id = mysqli_real_escape_string($con, $_REQUEST['user_id']);
	$status = mysqli_real_escape_string($con, $_REQUEST['status']);
	$v_date = date("Y-m-d", strtotime($_REQUEST['v_date']));

	$PV_id = date("y").getCounter($con, 9);	//PE_id

mysqli_autocommit($con, false);
$flag = true;

if($status ==1){
   mysqli_query($con, "UPDATE `price_version` SET `PV_status`='2'");
   if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
 }

mysqli_query($con, "INSERT INTO price_version(PV_id, PV_user, PV_date, PV_status) VALUES ('$PV_id', '$user_id', '".$v_date."', '$status')");
if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	else updateCounter($con, 9);

	if($flag){
			mysqli_commit($con);
			echo $PV_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>