<?php include("config.php"); ?>
<?php
$receipt_no = $_REQUEST['id'] ;

$result_status = mysqli_query($con, "SELECT `PRS_status_id` FROM `patient_receipt_status` WHERE `PRS_receipt_no` = '".$receipt_no."'");
while($row=mysqli_fetch_array($result_status))
    {
		$status_id = $row['PRS_status_id'];		
		}	

if ($status_id == 6)
  {
  $result = mysqli_query($con, "SELECT  `disc_receipt_no` FROM `discount_tbl` WHERE `disc_receipt_no` = '".$receipt_no."'");
  if (mysqli_num_rows($result) == 0) 
			  { mysqli_query($con, "DELETE `patient_registration`, `patient_test`, `patient_payment`, `patient_receipt_status` FROM `patient_registration`, `patient_test`, `patient_payment`, `patient_receipt_status` WHERE `patient_registration`.`pr_receipt_no` = `patient_test`.`PT_receipt_no` AND `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` AND `patient_registration`.`pr_receipt_no` = `patient_receipt_status`.`PRS_receipt_no` AND `patient_registration`.`pr_receipt_no` = '".$receipt_no."'"); }
		else { mysqli_query($con, "DELETE `patient_registration`, `patient_test`, `patient_payment`, `patient_receipt_status`, `discount_tbl` FROM `patient_registration`, `patient_test`, `patient_payment`, `patient_receipt_status`, `discount_tbl` WHERE `patient_registration`.`pr_receipt_no` = `patient_test`.`PT_receipt_no` AND `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` AND `patient_registration`.`pr_receipt_no` = `patient_receipt_status`.`PRS_receipt_no` AND `patient_registration`.`pr_receipt_no` = `discount_tbl`.`disc_receipt_no` AND `patient_registration`.`pr_receipt_no` = '".$receipt_no."'"); }  
		echo "ok";
		}
else 
      { echo "Delete failed !  Contact concerned department and put status on 'Blocked'";}


?>