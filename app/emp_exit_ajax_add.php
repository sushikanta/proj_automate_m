<?php require_once("function.php"); ?>
<?php

    resetCounter($con, 41, 'yy');
	$reason = ucwords(mysqli_real_escape_string($con, $_REQUEST['reason']));

	$EE_id = date("y").getCounter($con, 41);	//PE_id
	$ei_id = mysqli_real_escape_string($con, $_REQUEST['emp_info']);
	$exit_date = date("Y-m-d", strtotime($_REQUEST['exit_date']));


mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO emp_exit_tbl(EE_id, EE_ei_id, EE_reason, EE_date) VALUES ('$EE_id', '$ei_id', '".$reason."', '".$exit_date."')");
if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 41);

mysqli_query($con, "UPDATE `emp_tbl` SET ET_status ='2' WHERE ET_ei_id = '$ei_id'");
if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //

	if($flag){
			mysqli_commit($con);
			echo $EE_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>