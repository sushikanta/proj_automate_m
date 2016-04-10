<?php require_once("function.php"); session_start();?>
<?php 
$receipt_no = $_REQUEST['id'];
$value = $_REQUEST['value'];
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition']; 
$user_id=$_SESSION['user_id'];

$check = mysqli_query($con, "SELECT y.PP_sl, y.PP_net, y.PP_paid, y.PP_bal, r.pr_status_id FROM patient_payment y LEFT JOIN patient_registration r ON r.pr_receipt_no = y.PP_receipt_no  WHERE y.PP_receipt_no = '$receipt_no'");
while($row = mysqli_fetch_array($check)) {	
	  $PP_sl = $row['PP_sl'];
	  $PP_bal = $row['PP_bal'];
	  $PP_net = $row['PP_net'];
	  $PP_paid = $row['PP_paid'];
	  $pr_status_id = $row['pr_status_id'];	
	}

if ($columnId == '7' && $columnPosition == '7')	// status update
   {
	if($pr_status_id == '4'){echo "Not authorised to change 'Cancelled' status !";}
	if($pr_status_id == '5'){echo "Not authorised to change 'Delivered' status !";}		
	if($pr_status_id != '4' && $pr_status_id != '5'){	

		/*------ START TRANSACTION ----------*/
		mysqli_autocommit($con, false);
		$flag = true;

		resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)

		/****************************
 26   Patient Registration
 28   Patient Discount
 29   Customer Profile
 30   Expenditure

 A_action
 21   swap
 22   Add
 23   Edit
 24   Cancel
 25   Status
 27   Investigation Status
 31   Payment
 33   Deleted
		 ******************************/
		 $A_id = date("ynj").getCounter($con, 42);
		 // $old_status = showStatus($con, $pr_status_id);
		 $new_status = showStatus($con, $value);
		 $remark = 'All Status TO : '.$new_status.' (Registration # :'.$receipt_no.')';
		 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '25', '$receipt_no', '".$remark."', '$user_id', NOW())");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		  else updateCounter($con, 42);

		// UPDATE patient_registration
		mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '$value' WHERE pr_receipt_no = '$receipt_no'");
		if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: Status update on Registration";}

		// UPDATE patient_test
		mysqli_query($con, "UPDATE patient_test SET PT_status_id = '$value' WHERE PT_receipt_no = '$receipt_no'"); 
		if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: Status update on Test";}

		if($flag){
			mysqli_commit($con);
			echo $value;
			} else {
			mysqli_rollback($con);
			echo " Update failed !";
			}
		}
    }
 

if ($columnId == '8' && $columnPosition == '8')	// balance update
{
	if($pr_status_id == '4'){echo "Cancelled status : Not authorised for payment !";}
	else{
	
  if($value < 0){ echo "Error: Dues Not less than 0 !";} 
   
  if($value >= 0)
   {
	  
	if($value == $PP_bal){ echo "Error: Same due amount !";}	 
	if($value > $PP_bal){echo "Error : Trying to update more dues, please recheck !";}
	if($value < $PP_bal)
		{
			/*------ START TRANSACTION ----------*/
		    mysqli_autocommit($con, false);
		    $flag = true;

			resetCounter($con, 13, 'dd'); // patient_transaction
			$tr_id = date("ynj").getCounter($con, 13);
			$paid_new = $PP_bal - $value;

			// UPDATE ON PATIENT_PAYMENT
			mysqli_query($con, "UPDATE patient_payment SET PP_paid =  PP_paid + $paid_new, PP_bal = '$value' WHERE PP_receipt_no = '$receipt_no'");	
			if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: PATIENT_PAYMENT update";}

			// UPDATE ON PATIENT_TRANSACTION
			mysqli_query($con, "INSERT INTO patient_transaction(TR_id, TR_pp_sl, TR_amount, TR_date, TR_user) VALUES ('$tr_id', '$PP_sl', '".$paid_new."', NOW(), '$user_id')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_transaction insert !";} 
	    else updateCounter($con, 13);

			if($flag){
			mysqli_commit($con);
			echo $value;
			} else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Update failed";
			}
	    }
	}
	}
   }
?>