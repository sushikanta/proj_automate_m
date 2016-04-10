<?php require_once("function.php"); ?>
<?php

    resetCounter($con, 22, 'yy');
	$prev_org = ucwords(mysqli_real_escape_string($con, $_REQUEST['prev_org']));
	$address = ucwords(mysqli_real_escape_string($con, $_REQUEST['address']));
	$department = ucwords(mysqli_real_escape_string($con, $_REQUEST['department']));
	$position = ucwords(mysqli_real_escape_string($con, $_REQUEST['position']));

	$PE_id = date("y").getCounter($con, 22);	//PE_id
	$ei_id = mysqli_real_escape_string($con, $_REQUEST['emp_info']);
	$exit_date = date("Y-m-d", strtotime($_REQUEST['exit_date']));
	$join_date = date("Y-m-d", strtotime($_REQUEST['join_date']));

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO emp_prev_experience(PE_id, PE_ei_id, PE_org, PE_address, PE_dept, PE_position, PE_joined_date, PE_exit_date) VALUES ('$PE_id', '$ei_id', '".$prev_org."', '".$address."', '".$department."', '".$position."', '".$join_date."', '".$exit_date."')");

if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 22);

	if($flag){
			mysqli_commit($con);
			echo $PE_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>