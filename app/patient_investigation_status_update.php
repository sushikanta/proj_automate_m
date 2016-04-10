<?php require_once("function.php"); session_start();?>
<?php 
$patient_test_id = $_REQUEST['id'];
$value = $_REQUEST['value'] ;
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];
$user_id=$_SESSION['user_id'];

$check = mysqli_query($con, "SELECT PT_status_id, PT_test_name, PT_receipt_no FROM patient_test WHERE PT_sl = '$patient_test_id'");	
while($row = mysqli_fetch_array($check)) {
	  $PT_status_id = $row['PT_status_id'];
	  $PT_test_name = $row['PT_test_name'];
      $PT_receipt_no = $row['PT_receipt_no'];
	}

  
  
  if($columnId == '2' && $columnPosition == '2')	// status update
     {

	  if($PT_status_id == '5'  && $value != '12' && $value != '3') // 5 = delivered, 3 = cancell  return =12
	    {
		  echo "Sorry! Delivered Test can not be changed";
		 }
	  elseif($PT_status_id == '3') // 5 = delivered, 3 = cancell  return =12
	    {
		  echo "Sorry! Cancelled Test can not be changed";
		 }
	  else
	   {
		resetCounter($con, 42, 'dd');	// audit
		/*------ START TRANSACTION ----------*/
		mysqli_autocommit($con, false);
		$flag = true;

		$new_status = showStatus($con, $value);
		// $old_status = showStatus($con, $PT_status_id);
		$remark = 'Status TO : '.$new_status.' (Investigation : '.$PT_test_name.')';

		if($PT_status_id ==$value){
			echo "Same Status !";}
		else{
		// UPDATE patient_test
		mysqli_query($con, "UPDATE patient_test SET PT_status_id = '$value' WHERE PT_sl = '$patient_test_id'");
		if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: patient_test update".mysqli_error($con). ".";}

/****************************
			A_book
 26   Patient Registration
 30   Expenditure
 28   Patient Discount
 29   Customer Profile

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
		$A_id = date("jmy").getCounter($con, 42);
		mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '27', '$PT_receipt_no', '".$remark."', '$user_id', NOW())");
		if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		else updateCounter($con, 42);
		
	//------ UPDATE collective status in patient_registration (EID)
		   
		   $total =  showTest_count($con, $PT_receipt_no, '0');		  
		   $delivered = showTest_count($con, $PT_receipt_no, '5');
		   $available = showTest_count($con, $PT_receipt_no, '11');
		   $return = showTest_count($con, $PT_receipt_no, '12');
		   $cancel = showTest_count($con, $PT_receipt_no, '3');
		  
		if($delivered == $total)
		  {
		   mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '5' WHERE pr_receipt_no = '$PT_receipt_no'");
		   if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: delivered update";}
		   }		
		elseif($available == $total)
		  {
		   mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '11' WHERE pr_receipt_no = '$PT_receipt_no'");
		   if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: available update";} 
		   }
		 elseif($return == $total)
		  {
		   mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '12' WHERE pr_receipt_no = '$PT_receipt_no'");
		    if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: Total return update";} 
		   }
		 elseif($cancel == $total)
		  {
		   mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '3' WHERE pr_receipt_no = '$PT_receipt_no'");
		    if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: Total return update";} 
		   }
		else{
			mysqli_query($con, "UPDATE patient_registration SET pr_status_id = '1' WHERE pr_receipt_no = '$PT_receipt_no'");
			 if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: Total Pending update";}
			}
		
				  if($flag){
					  mysqli_commit($con);
					  echo $value;
					  } else {
					  mysqli_rollback($con);	
					  echo "!"; http_response_code(404);
					  }		
	   }
   }
}