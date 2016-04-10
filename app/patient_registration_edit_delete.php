<?php require_once("function.php"); session_start(); ?>
<?php  

$cur_total=0;
$cur_net =0;
$db_total =0;
$db_test_price=0;
$total_after_tax =0;

$refund_amount = 0;
$disc_value=0;

$db_paid =0;
$PP_paid =0;
$PP_bal=0;
  
  $mix = $_REQUEST['id'];
  $all = explode(" ", $mix);
  $PT_sl = $all['0'];
  $reason = $all['1'];
  
  resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)
  resetCounter($con, 29, 'dd');	//  exp for refund
  $user_id = $_SESSION['user_id'];
  
  $check = mysqli_query($con, "SELECT t.PT_receipt_no, t.PT_test_id, t.PT_test_name, t.PT_test_price, t.PT_status_id, y.PP_total, y.PP_tax, y.PP_disc, y.PP_paid FROM patient_test t LEFT JOIN patient_payment y ON y.PP_receipt_no = t.PT_receipt_no WHERE t.PT_sl = '$PT_sl' LIMIT 1");
  while($row=mysqli_fetch_array($check)){
	    $receipt_no= $row['PT_receipt_no'];
		$test_id=$row['PT_test_id'];
		$test_name=$row['PT_test_name'];
		$PT_status_id=$row['PT_status_id'];
		
		$db_test_price=$row['PT_test_price'];
		$db_total=$row['PP_total'];
		$db_paid=$row['PP_paid'];
		$tax_option=$row['PP_tax'];
		$disc_option=$row['PP_disc'];				
		$cur_total=$db_total - $db_test_price;
  }
  
 if($PT_status_id !=4){  // cancelled test status
  mysqli_autocommit($con, false);
  $flag = true;

 
 //-----UPDATE TO PATIENT PAYMENT 
 	//-----TAX = YES
	if($tax_option =='1'){ $tax = getTax($con, $receipt_no); $total_after_tax = $cur_total + ($cur_total * $tax * 0.01);}
	//-----TAX = NO
	if($tax_option =='2'){ $total_after_tax = $cur_total;}
	
	//-----DISC = YES
	if($disc_option =='1'){ $disc_value = showDiscount_in_amt($con, $receipt_no, $total_after_tax); $cur_net = $total_after_tax - $disc_value;}
	//-----DISC = NO
	if($disc_option =='2'){ $cur_net = $total_after_tax;} //2=amount
	
	if($db_paid > $cur_net){$PP_paid = $cur_net; $PP_bal = '0'; $refund_amount = $db_paid - $cur_net;}
	if($db_paid == $cur_net){$PP_paid = $cur_net; $PP_bal = '0'; $refund_amount = '0';}
	if($db_paid < $cur_net){$PP_paid = $db_paid; $PP_bal = $cur_net - $db_paid; $refund_amount = '0';}
	
 //-----UPDATE TO PATIENT PAYMENT
 	mysqli_query($con, "UPDATE patient_payment SET PP_total = '".$cur_total."', PP_net = '".$cur_net."', PP_paid = '".$PP_paid."', PP_bal = '".$PP_bal."', PP_date = NOW() WHERE PP_receipt_no = '$receipt_no'");
  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: update Payment " .mysqli_error($con). ".";} 
 
 /****************************
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile
 
 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status 
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 $remark = 'Cancelled:'.$test_name.' (Reason:'.$reason.', Refunded BAL Rs. '.$refund_amount.')';
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '27', '24', '$PT_sl', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);
  
  //-----Delete CANCELLED TEST = 3 TO PATIENT test
 mysqli_query($con, "DELETE FROM patient_test WHERE PT_sl = '$PT_sl'");
 if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: Delete " .mysqli_error($con). ".";}
 
  
  // REFUND - expenditure
 $EX_id = date("ynj").getCounter($con, 29);
 $voucher = 'SG'.$EX_id;
  mysqli_query($con, "INSERT INTO expenditure(EX_id, EX_voucher, EX_particular, EX_person, EX_amount, EX_date, EX_user) VALUES ('$EX_id', '".$voucher."', '".$remark."', '".$receipt_no."', '".$refund_amount."', NOW(), '$user_id')");
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: Expenditure" . mysqli_error($con) . ".";}//{ $flag = false; echo "Error details: update < only " . mysqli_error($con) . ".";}
	else updateCounter($con, 29);

 if($flag){
			mysqli_commit($con);
			echo 'ok';
			} else {
			mysqli_rollback($con);
			echo "! "; http_response_code(404);
		}
  }
?>