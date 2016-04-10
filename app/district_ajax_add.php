<?php require_once("function.php"); session_start(); ?>
<?php
	resetCounter($con, 8, 'yy');

	$district = ucwords(mysqli_real_escape_string($con, $_REQUEST['district']));
	$state = mysqli_real_escape_string($con, $_REQUEST['state']);
	$user_id = $_SESSION['user_id'];

	$district_id = date('y').getCounter($con, 8);

 	mysqli_autocommit($con, false);
    $flag = true;

	mysqli_query($con, "INSERT INTO district_tbl(district_id, district_name, state_id) VALUES ('$district_id', '".$district."', '$state')");
	  if (mysqli_affected_rows($con) <= '0') { $flag = false; echo "Oops ! ".mysqli_error($con); }
	  else updateCounter($con, 8);

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
		 $remark = 'District : '.$district;
		 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '37', '22', '$district_id', '".$remark."', '$user_id', NOW())");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		  else updateCounter($con, 42);


	 if($flag){
			mysqli_commit($con);
			echo $district_id; }
		else {
			mysqli_rollback($con);
			echo ""; http_response_code(404); }
?>