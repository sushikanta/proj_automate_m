<?php require_once("function.php");?>
<?php 
$receipt_no = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ;
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition']; 

$check = mysqli_query($con, "SELECT `patient_payment`.`PP_sl`, `patient_payment`.`PP_net`, `patient_payment`.`PP_paid`, `patient_payment`.`PP_bal`,  `patient_registration`.`pr_status_id` FROM `patient_payment` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no`  WHERE `patient_payment`.`PP_receipt_no` = '$receipt_no'");	
while($row = mysqli_fetch_array($check)) {	
	
	$PP_sl = $row['PP_sl'];
	$PP_bal = $row['PP_bal'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$pr_status_id = $row['pr_status_id'];	
	}	
	
if ($columnId == '8' && $columnPosition == '8')	// status update
   {        
		if($pr_status_id == '5' && $value != '12'){echo "Sorry! Delivered can not be changed"; }
		
		else{		
		
		$result = mysqli_query($con, "UPDATE `patient_registration` SET `pr_status_id` = '$value' WHERE `pr_receipt_no` = '".$receipt_no."'"); 
		
		if (!$result) { echo "Update failed"; }
		else          { 
		//update on patient_test_tbl
		mysqli_query($con, "UPDATE `patient_test` SET `PT_status_id` = '$value' WHERE `PT_receipt_no` = '".$receipt_no."'"); 
		echo showStatus($con, $value); }
		}
    }
 

if ($columnId == '9' && $columnPosition == '9')	//balance update
{
	resetCounter_value($con, 30);
  
 	if($value !=""){	
	
	//CHECKING IF already created in patient_due_tbl
	$check_pd_sl = mysqli_query($con, "SELECT `PD_sl`, `PD_bal_paid` FROM `patient_due_tbl` WHERE `PD_pp_sl` = '$PP_sl' AND `PD_pp_sl` IS NOT NULL");	  
	  
	if (mysqli_num_rows($check_pd_sl) == 0)  // NO id on Due table
		  { 
			$PD_sl = date("ymd").getCounter_value($con, 30);
			$PD_bal_paid = $PP_bal - $value;
	
			mysqli_query($con, "INSERT INTO `patient_due_tbl`(`PD_sl`, `PD_pp_sl`, `PD_bal_paid`, `PD_date`) VALUES ('$PD_sl', '$PP_sl', '".$PD_bal_paid."', NOW())");
			
			mysqli_query($con, "UPDATE `patient_payment` SET `PP_bal` = '$value' WHERE `PP_receipt_no` = '".$receipt_no."'");	// UPDATE ON PATIENT_PAYMENT	
			echo $value;
		}
	   else  // paid id on Due table
	      { 
			while($row = mysqli_fetch_array($check_pd_sl)) {		
			$PD_sl = $row['PD_sl'];
			$paid = $row['PD_bal_paid']; }		
			
		$check1 = mysqli_query($con, "SELECT SUM(`PD_bal_paid`) AS sum FROM `patient_due_tbl` WHERE `PD_pp_sl` = '$PP_sl'");
		
			while($check2 = mysqli_fetch_array($check1)) {		
				  $sum = $check2['sum']; }
			
			$PD_sl_x = date("ymd").getCounter_value($con, 30);
	  
		 $PD_bal_paid_x = $PP_net - ($PP_paid + $sum + $value);
		mysqli_query($con, "INSERT INTO `patient_due_tbl`(`PD_sl`, `PD_pp_sl`, `PD_bal_paid`, `PD_date`) VALUES ('$PD_sl_x', '$PP_sl', '".$PD_bal_paid_x."', NOW())");

	     mysqli_query($con, "UPDATE `patient_payment` SET `PP_bal` = '$value' WHERE `PP_receipt_no` = '".$receipt_no."'");	// UPDATE ON PATIENT_PAYMENT	
		 echo $value;
	 }
   }
   
 if($value =="")  // More than balance amt
          {echo "Oops! You have entered none";}
 
  
/*----------------------- Same amt update - error -------------------------------*/ 

if($value == $PP_bal){
      echo "Same Bal = ".$PP_bal;
   } 
 
}

mysqli_close($con);
?>