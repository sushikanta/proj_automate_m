<?php require_once("function.php"); ?>
<?php
	resetCounter($con, 7, 'yy');
	$state = ucwords(mysqli_real_escape_string($con, $_REQUEST['state']));
	$state_id = getCounter($con, 7);

	mysqli_autocommit($con, false);
	$flag = true;

	mysqli_query($con, "INSERT INTO state_tbl(state_id, state_name) VALUES ('$state_id', '".$state."')");
	if (mysqli_affected_rows($con) <= '0') { $flag = false; echo " ". mysqli_error($con);}
	else updateCounter($con, 7);


	/****************************
 26   Patient Registration
 29   Customer Profile
 30   Expenditure
 37   District
 38   State
 39   Dr.name
 40   Source Type
 41   Source Name

 A_action
 21   swap
 22   Add
 23   Edit
 24   Cancel
 25   Status
 27   Investigation Status
 28   Patient Discount
 31   Payment
 33   Deleted
		 ******************************/
		 $A_id = date("y").getCounter($con, 42);
		 $remark = 'State : '.$state;
		 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '38', '22', '$state_id', '".$remark."', '$user_id', NOW())");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		  else updateCounter($con, 42);

	if($flag){
		mysqli_commit($con);
		echo $state_id; }
	else {
		mysqli_rollback($con);
		echo ""; http_response_code(404); }
?>