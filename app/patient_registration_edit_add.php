<?php require_once("function.php"); ?>
<?php
resetCounter($con, 16, 'dd');	 //  PT_sl (patient_test)
resetCounter($con, 42, 'dd');	 //  A_id (audit_tbl)

$total_amount =0;
$total_after_tax =0;
$total_after_disc =0;
$bal=0;
$paid_amount =0;
$db_total =0;

$receipt_no = $_REQUEST['receipt_no'];
$db_total = totalTest_amount($con, $receipt_no); // get total amount of all test from DB - patient_test

$test_id = $_REQUEST['test_id'];
$dept_id = $_REQUEST['dept_id'];
$test_name = $_REQUEST['test_name'];
$test_price = $_REQUEST['test_price'];
$status = $_REQUEST['status'];
$user_id = $_REQUEST['user_id'];

$tax_option = $_REQUEST['tax_option'];
$disc_option = $_REQUEST['disc_option'];
$paid_amount = $_REQUEST['paid_amount'];
$total_amount = $db_total + $test_price;

$pt_sl = date("jmy").getCounter($con, 16);
$A_id = date("jmy").getCounter($con, 42);
$reason = $_REQUEST['reason'];
$remark = 'Added:'.$test_name.' (Reason:'.$reason.', ED/'.$receipt_no.')';

mysqli_autocommit($con, false);
$flag = true;

//-----INSERT TO PATIENT TEST
mysqli_query($con, "INSERT INTO patient_test(PT_sl, PT_receipt_no, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id) VALUES ('$pt_sl', '$receipt_no', '$test_id', '".$test_name."', '".$test_price."', '$dept_id', '$status')");
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: Insert patient test " .mysqli_error($con). ".";}
else updateCounter($con, 16);

	//-----TAX = YES
	if($tax_option =='1'){ $tax = getTax($con, $receipt_no); $total_after_tax = $total_amount + ($total_amount * $tax * 0.01);}
	//-----TAX = NO
	if($tax_option =='2'){ $total_after_tax = $total_amount;}
	
	//-----DISC = YES
	if($disc_option =='1'){ $disc_value = showDiscount_in_amt($con, $receipt_no, $total_after_tax); $total_after_disc = $total_after_tax - $disc_value;}
	//-----DISC = NO
	if($disc_option =='2'){ $total_after_disc = $total_after_tax;} //2=amount
	
	$bal = $total_after_disc - $paid_amount;
	
 //-----UPDATE TO PATIENT PAYMENT
 mysqli_query($con, "UPDATE patient_payment SET PP_total = '".$total_amount."', PP_net = '".$total_after_disc."', PP_date = NOW(), PP_bal = '".$bal."' WHERE PP_receipt_no = '$receipt_no'");
  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: update Payment " .mysqli_error($con). ".";} 
 
 //-----INSERT INTO  audit_tbl
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '27', '22', '$pt_sl', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);
	
  if($flag){
			mysqli_commit($con);
			echo 'ok';
			} else {
			mysqli_rollback($con);
			echo " ! "; http_response_code(404);
		}
?>