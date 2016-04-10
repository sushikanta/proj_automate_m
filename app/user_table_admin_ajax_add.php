<?php require_once("function.php"); ?>
<?php
	resetCounter($con, 19, 'yy');
	$username = mysqli_real_escape_string($con, $_REQUEST['username']);
	$password = md5(mysqli_real_escape_string($con, $_REQUEST['password']));
	$name = ucwords(mysqli_real_escape_string($con, $_REQUEST['name']));
	$surname = ucwords(mysqli_real_escape_string($con, $_REQUEST['surname']));
	$dept_id = mysqli_real_escape_string($con, $_REQUEST['dept_id']);

	$user_id = date('y').getCounter($con, 27);

	mysqli_autocommit($con, false);
	$flag = true;

	mysqli_query($con, "INSERT INTO user_table(user_id, user_name, user_password, name, surname, user_dept_id, user_date, user_status) VALUES ('$user_id', '".$username."', '".$password."', '".$name."', '".$surname."', '$dept_id', NOW(), '1')");
	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " ".mysqli_error($con);}
		else updateCounter($con, 27);

	if($flag){ mysqli_commit($con); echo $user_id; } else { mysqli_rollback($con); echo " "; http_response_code(404); }
?>