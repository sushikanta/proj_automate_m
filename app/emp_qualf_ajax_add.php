<?php require_once("function.php"); ?>
<?php

    resetCounter($con, 21, 'yy');

	$course = ucwords(mysqli_real_escape_string($con, $_REQUEST['course']));
	$faculty = ucwords(mysqli_real_escape_string($con, $_REQUEST['faculty']));
	$institute = ucwords(mysqli_real_escape_string($con, $_REQUEST['institute']));
	$university = ucwords(mysqli_real_escape_string($con, $_REQUEST['university']));

	$mark_obt = mysqli_real_escape_string($con, $_REQUEST['mark_obt']);
	$total_mark = mysqli_real_escape_string($con, $_REQUEST['total_mark']);
	$grade = mysqli_real_escape_string($con, $_REQUEST['grade']);
	$result = ucwords(mysqli_real_escape_string($con, $_REQUEST['result']));
	$duration_y = mysqli_real_escape_string($con, $_REQUEST['duration_y']);
	$duration_m = mysqli_real_escape_string($con, $_REQUEST['duration_m']);

	$EQ_id = date("y").getCounter($con, 21);	//EQ_id
	$ei_id = mysqli_real_escape_string($con, $_REQUEST['emp_info']);
	$passing_date = date("Y-m-d", strtotime($_REQUEST['passing_date']));

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO `emp_qualification`(`EQ_id`, `EQ_ei_id`, `EQ_course`, `EQ_faculty`, `EQ_institute`, `EQ_univ`, `EQ_mark`, `EQ_total`, `EQ_grad`, `EQ_result`, `EQ_pass_date`, `EQ_duration_year`, `EQ_duration_month`) VALUES ('$EQ_id', '$ei_id', '".$course."', '".$faculty."', '".$institute."', '".$university."', '$mark_obt', '$total_mark', '".$grade."', '".$result."', '".$passing_date."', '$duration_y', '$duration_m')");

if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 21);

	if($flag){
			mysqli_commit($con);
			echo $EQ_id;
			}
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
?>