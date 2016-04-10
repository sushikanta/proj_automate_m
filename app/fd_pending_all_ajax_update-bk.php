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
	if($pr_status_id == '4'){echo "CANCELLED : Not authorised to change !";}
	
	if($pr_status_id == '5' && $value != '12'){echo "Sorry! Delivered can not be changed";}
		
	if($pr_status_id != '4' && $pr_status_id != '5'){	
		
		resetCounter($con, 36, 'dd');	// Patient_test_path
		/*------ START TRANSACTION ----------*/
		mysqli_autocommit($con, false);
		$flag = true;
		$action = '25';
		//$new_status = showStatus($con, $value);
		
		
	$check1 = mysqli_query($con, "SELECT PT_sl, PT_status_id FROM patient_test  WHERE PT_receipt_no = '$receipt_no'");
	 while($row1 = mysqli_fetch_array($check1))
	 {	
	  
		$PT_sl = $row1['PT_sl'];
		$PT_status_id = $row1['PT_status_id'];
		
		// INSERT patient_test_path
		$ptp_id = date("ynj").getCounter($con, 36);
		$old_status = showStatus($con, $PT_status_id);
		$remark =$old_status.' to '.$new_status;
		
		mysqli_query($con, "INSERT INTO patient_test_path(PTP_id, PTP_pt_sl, PTP_action, PTP_remark, PTP_user, PTP_date) VALUES ('$ptp_id', '$PT_sl', '$action', '".$remark."', '$user_id', NOW())");		 
		if(mysqli_affected_rows($con) <= 0)
		  { $flag = false; echo " Error in INSERT patient_test_path";}
		  else updateCounter($con, 36);
		}
				
		// UPDATE patient_registration
		mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '$value' WHERE pr_receipt_no = '$receipt_no'");
		if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: patient_registration update";}
		
		// UPDATE patient_test
		mysqli_query($con, "UPDATE patient_test SET PT_status_id = '$value' WHERE PT_receipt_no = '$receipt_no'"); 
		if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: patient_test update";}
		
		if($flag){
			mysqli_commit($con);
			echo $new_status;
			} else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Update failed";
			}
		}
    }
 

if ($columnId == '8' && $columnPosition == '8')	// balance update
{
	
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
?>