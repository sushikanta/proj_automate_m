<?php require_once("function.php"); ?>
<?php
	resetCounter($con, 2, 'mm');

	$dr_name = mysqli_real_escape_string($con, $_REQUEST['dr_name']);
	$dr_id = date("yn").getCounter($con, 2);
	$dr_name_x = ucwords($dr_name);
	$address = ucwords(mysqli_real_escape_string($con, $_REQUEST['address']));
	$dr_phone = mysqli_real_escape_string($con, $_REQUEST['phone']);

	mysqli_autocommit($con, false);
	$flag = true;

	mysqli_query($con, "INSERT INTO dr_info(dr_id, dr_name, dr_phone, dr_email, dr_dob, dr_address, dr_state, dr_district, dr_pin, dr_gender, dr_marital) VALUES ('$dr_id', '".$dr_name_x."', '".$dr_phone."', '', '', '".$address."', '', '', '', '', '')");
	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " ". mysqli_error($con);}
	  else updateCounter($con, 2);
	if($flag){ mysqli_commit($con); echo $dr_id; } else { mysqli_rollback($con); echo " "; http_response_code(404); }
?>