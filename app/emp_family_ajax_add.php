<?php require_once("function.php"); ?>
<?php

    resetCounter($con, 39, 'yy');

	$name = ucwords(mysqli_real_escape_string($con, $_REQUEST['name']));
	$occupation = ucwords(mysqli_real_escape_string($con, $_REQUEST['occupation']));
	$relation_type = mysqli_real_escape_string($con, $_REQUEST['relation']);

	$EF_id = date("y").getCounter($con, 39);	//emp_family
	$fdob1 = mysqli_real_escape_string($con, $_REQUEST['fdob']);
	$fdob = date("Y-m-d", strtotime($fdob1));
	$ei_id = mysqli_real_escape_string($con, $_REQUEST['emp_info']);

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO `emp_family`(`EF_id`, `EF_ei_id`, `EF_type`, `EF_name`, `EF_occupation`, `EF_dob`) VALUES ('$EF_id', '$ei_id', '$relation_type', '".$name."', '".$occupation."', '".$fdob."')");

if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: emp_family " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 39);

	if($flag){
			mysqli_commit($con);
			echo $EF_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>