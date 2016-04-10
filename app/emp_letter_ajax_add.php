<?php require_once("function.php"); ?>
<?php

    resetCounter($con, 26, 'yy');
	$type = mysqli_real_escape_string($con, $_REQUEST['type']);
	$remark = ucwords(mysqli_real_escape_string($con, $_REQUEST['remark']));

	$EL_id = date("y").getCounter($con, 26);	//PE_id
	$ei_id = mysqli_real_escape_string($con, $_REQUEST['emp_info']);
	$sent_date = date("Y-m-d", strtotime($_REQUEST['sent_date']));


mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO emp_letter(EL_id, EL_ei_id, EL_type, EL_remark, EL_date) VALUES ('$EL_id', '$ei_id', '$type', '".$remark."', '".$sent_date."')");

if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 26);

	if($flag){
			mysqli_commit($con);
			echo $EL_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>