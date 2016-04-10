<?php include("function.php");?>
<?php 
$receipt_no = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ;
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition']; 


$check = mysqli_query($con, "SELECT `PP_sl`, `PP_net`, `PP_paid`, `PP_bal` FROM `patient_payment` WHERE `PP_receipt_no` = '$receipt_no'");	
while($row = mysqli_fetch_array($check)) {	
	
	$PP_sl = $row['PP_sl'];
	$PP_bal = $row['PP_bal'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	
	
	}	


if ($columnId == '9' && $columnPosition == '9')	//balance update
{
	
/*----------------------- CLEAR DUES -------------------------------*/
  
 	if($value !=""){
		
	resetCounter_value($con, 30);	
    
	//CHECKING IF already created in patient_due_tbl
	$check_pd_sl = mysqli_query($con, "SELECT `PD_sl`, `PD_bal_paid` FROM `patient_due_tbl` WHERE `PD_pp_sl` = '$PP_sl' AND `PD_pp_sl` IS NOT NULL"); 
	  
	  if (mysqli_num_rows($check_pd_sl) == 0)  // NO id on Due table on today's date
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