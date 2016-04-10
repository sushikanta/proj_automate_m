<?php require_once("function.php"); ?>
<?php
$EX_id = date("ymd").getCounter($con, 29);
$voucher = ucwords(mysqli_real_escape_string($con, $_REQUEST['voucher']));
$particulars = ucwords(mysqli_real_escape_string($con, $_REQUEST['particulars']));
$receiver = ucwords(mysqli_real_escape_string($con, $_REQUEST['receiver']));
$date_ex = date("Y-m-d H:i:s", strtotime($_REQUEST['date_ex']));

$amount = mysqli_real_escape_string($con, $_REQUEST['amount']);
$user_id = mysqli_real_escape_string($con, $_REQUEST['user_id']);

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO `expenditure`(`EX_id`, `EX_voucher`, `EX_particular`, `EX_person`, `EX_amount`, `EX_date`, `EX_user`) VALUES ('.$EX_id.', '".$voucher."', '".$particulars."', '".$receiver."', '".$amount."', '".$date_ex."', '".$user_id."')");

if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: Add".mysqli_error($con). ".";}//{ $flag = false; echo "Error details: update < only " . mysqli_error($con) . ".";}
	else updateCounter($con, 29);

/****************************
 A_book
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile
 30 	Expenditure

 A_action
 21		swap
 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status
 33 	Deleted
 ******************************/
 $A_id = date("jmy").getCounter($con, 42);
 $remark = 'Expenditure ID : '.$EX_id.' ( Rs. '.$amount.')';
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '30', '22', '$EX_id', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

if($flag){
			mysqli_commit($con);
			echo $EX_id;
			} else {
			mysqli_rollback($con);
			echo "Add failed !"; http_response_code(405);}
?>