<?php require_once("config.php");?>
<?php
function getCounter_value($con, $counter_id){		// generalised function to get counter value from counter_tbl &  updated 
 $result=mysqli_query($con, "SELECT counter_value FROM counter_tbl WHERE counter_id='$counter_id'");
	while($row=mysqli_fetch_array($result)){
		$counter_value=$row['counter_value'];		
		}	
	$updated_value=$counter_value+1;
	mysqli_query($con, "UPDATE counter_tbl set counter_value='$updated_value', last_updated_date='".date('Y-m-d')."' WHERE counter_id='$counter_id'");	
	return $counter_value;
	}
	
function resetCounter_value($con, $counter_id){		// reset counter_value everyday
$result=mysqli_query($con, "SELECT counter_id, counter_value, last_updated_date FROM counter_tbl WHERE counter_id='$counter_id'");
while($row=mysqli_fetch_array($result))
{
	$database_date=$row['last_updated_date'];
	$database_counter_value=$row['counter_value'];
   }
if(strtotime($database_date) == strtotime(date('Y-m-d')))
	{
	  $n=0; // just add
	  }
		else
		{
	   $reset_value=1;
	   mysqli_query($con, "UPDATE counter_tbl set counter_value='$reset_value', last_updated_date='".date('Y-m-d')."' WHERE counter_id='$counter_id'");
	  
	  }
		
	}

function counterValueOnly($con, $counter_id){		// show only counter_value
 $result=mysqli_query($con, "SELECT counter_id, counter_value, last_updated_date FROM counter_tbl WHERE counter_id='$counter_id'");
while($row=mysqli_fetch_array($result))
{
	return $row['counter_value'];
   }
}
	
function addPatient($con, $patient_id, $lab_id, $patient_name, $patient_age, $patient_gender_id, $marital_status, $patient_address, $patient_registration_date, $patient_phone, $state_id, $district_id, $pin_id, $source_id, $referred_id){
	mysqli_query($con, "INSERT INTO patient_registration(patient_id, lab_id, patient_name, patient_age, patient_gender_id, marital_id, patient_address, district_id, pin_id, state_id, patient_registration_date, patient_phone, source_id, referred_id) VALUES ('".$patient_id."', '".$lab_id."', '".$patient_name."', '.$patient_age.', '".$patient_gender_id."', '.$marital_status.', '".$patient_address."', '.$district_id.', '.$pin_id.', '.$state_id.', '".$patient_registration_date."', '.$patient_phone.' , '.$source_id.' , '.$referred_id.')");
  }

function addState($con, $state_name){
	$result = mysqli_query($con, "SELECT state_id FROM state_tbl WHERE state_name ='".$state_name."'");
	if (mysqli_num_rows($result) == 0) 
        {
			$state_id_x = getCounter_value($con, 7);
			mysqli_query($con, "INSERT INTO state_tbl(state_id, state_name) VALUES ('.$state_id_x.', '$state_name')"); 
			return $state_id_x; }
	else  { while($row = mysqli_fetch_array($result))
	        {return $row['state_id'];} }
	}	

function addDistrict($con, $district_name, $state_id){
	$result = mysqli_query($con, "SELECT district_id FROM district_tbl WHERE district_name ='".$district_name."' AND state_id = '$state_id'");
  if (mysqli_num_rows($result) == 0) 
     {	
		$district_id_x = getCounter_value($con, 8);
		mysqli_query($con, "INSERT INTO district_tbl(district_id, district_name, state_id) VALUES ('.$district_id_x.', '".$district_name."', '.$state_id.')");	
		return $district_id_x;}
 else  { while($row = mysqli_fetch_array($result))
	        {return $row['district_id'];} }
	}
	
function addPin($con, $pin_id, $pin_code, $district_id){
	mysqli_query($con, "INSERT INTO pin_tbl(pin_id, pin_code, district_id) VALUES ('.$pin_id.', '".$pin_code."', '.$district_id.')");	
	}
	
function addRefferedSource($con, $source_id, $source_name){
	mysqli_query($con, "INSERT INTO source_btl(source_id, source_name) VALUES ('.$source_id.', '".$source_name."')");
	}	
function addReffered_doctor($con, $dr_id, $dr_name){	
	mysqli_query($con,"INSERT INTO dr_profile(dr_id, dr_name) VALUES('.$dr_id.', '".$dr_name."')");
	}	
function addRefferred_employee($con, $sl_no, $emp_name){
	mysqli_query($con,"INSERT INTO employee_tbl(EMP_sl, EMP_name,EMP_update_date) VALUES('.$sl_no.', '".$emp_name."', CURDATE())");
	}
function addReferral($con, $referred_id, $referred_name, $source_id){
	mysqli_query($con," INSERT INTO referred_tbl(referred_id, referred_name, source_id) VALUES ('.$referred_id.', '".$referred_name."', '.$source_id.')");	
	}


function addSource($con, $source_id, $source){
	mysqli_query($con, "INSERT INTO source_btl(source_id, source_name) VALUES ('.$source_id.', '".$source."')");	
	}
function addTest_category($con, $id, $name){
	mysqli_query($con, "INSERT INTO test_category(test_category_id, test_category_name) VALUES ('.$id.','".$name."')");	
	}
function addPrice_version($con, $version_id, $price_version){
	mysqli_query($con, "INSERT INTO price_version(version_id, version_name, version_date) VALUES ('.$version_id.', '".$price_version."', '".date('Y-m-d')."')");	
	}
function addTest($con, $test_id, $test_name, $test_category_id){
	mysqli_query($con, "INSERT INTO test_tbl(test_id, test_name, test_category_id) VALUES ('.$test_id.','".$test_name."','.$test_category_id.')");
	
		}
function addPrice($con, $price_id, $test_price, $test_id, $version_id){
	mysqli_query($con, "INSERT INTO price_tbl(price_id, test_id, price, price_version_id) VALUES ('.$price_id.','.$test_id.','.$test_price.','.$version_id.')");
	}
function addDiscount_code($con, $disc_code_id, $disc_code){
	mysqli_query($con, "INSERT INTO disc_code_tbl(disc_code_id, disc_code) VALUES ('.$disc_code_id.', '".$disc_code."')");	
	}

function addPatient_disc($con, $patient_disc_id, $disc_code_id, $disc_value_id, $disc_remark, $patient_id, $disc_type_id){
	mysqli_query($con, "INSERT INTO patient_disc_tbl(patient_disc_id, disc_code_id, disc_value_id, disc_remark, patient_id, disc_type_id) VALUES ('.$patient_disc_id.', '.$disc_code_id.', '.$disc_value_id.', '".$disc_remark."', '".$patient_id."', '.$disc_type_id.')");
   }
function addDepartment($con, $dept_id, $dept_name){
	mysqli_query($con, "INSERT INTO department_tbl(department_id, department_name) VALUES ('.$dept_id.', '".$dept_name."')");	
	}
function addDesignation($con, $designation_id, $designation_name){
	mysqli_query($con, "INSERT INTO designation_tbl(designation_id, designation_name, short_form) VALUES ('.$designation_id.', '".$designation_name."', 'Edit')");	
	}
function getDiscount_value_per($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_value FROM discount_tbl WHERE disc_receipt_no= '".$receipt_no."' AND disc_type ='1'");
	if (mysqli_num_rows($result) == 0) 
          { return "0"; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['disc_value'];} }
	}
function getDiscount_value_amt($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_value FROM discount_tbl WHERE disc_receipt_no= '".$receipt_no."' AND disc_type ='2'");
	if (mysqli_num_rows($result) == 0) 
          { return "0"; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['disc_value'];} }
	}
function addPatient_test($con, $lab_id, $id){
	$patient_test_sl = getCounter_value($con, 16);
	$current_date=date('Y-m-d');
	mysqli_query($con, "INSERT INTO patient_test(patient_test_sl, lab_id, test_id, patient_test_date) VALUES ('$patient_test_sl', '$lab_id', '$id', '$current_date')");
	}
/*
function get_resetCounter_id($con, $counter_id)
{
$result=mysqli_query($con, "SELECT counter_id, counter_value, last_updated_date FROM counter_tbl WHERE counter_id='$counter_id'");
while($row=mysqli_fetch_array($result))
{
	$database_date=$row['last_updated_date'];
	$database_counter_value=$row['counter_value'];
   }
	
	
if(strtotime($database_date) == strtotime(date('Y-m-d')))
	{
	  $updated_value=$database_counter_value+1;
	   mysqli_query($con, "UPDATE counter_tbl set counter_value='$updated_value' WHERE counter_id='$counter_id'");
	   return $database_counter_value;		
		}
		else
		{
	   $reset_value=1;
	   mysqli_query($con, "UPDATE counter_tbl set counter_value='$reset_value', last_updated_date='".date('Y-m-d')."' WHERE counter_id='$counter_id'");
	   return $reset_value;
	  }
		
	}*/

/*----------------------------------------- CALCULATION -------------------------------------------*/

function calcDiscount_EID($con, $receipt_no){
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, patient_payment.PP_total, patient_payment.PP_tax_value FROM discount_tbl LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = discount_tbl.disc_receipt_no WHERE discount_tbl.disc_receipt_no = '$receipt_no'");
	if (mysqli_num_rows($result) == 0) 
          { return "0.00"; }
	else  
	{ 
	
	while($row=mysqli_fetch_array($result)){
	       
				$disc_status = $row['disc_status'];
				$disc_type = $row['disc_type'];
				$disc_value = $row['disc_value'];
				$PP_total = $row['PP_total'];
				$tax = $row['PP_tax_value'] * 0.01 * $PP_total;
				$total = $PP_total + $tax;
				if($disc_status == '1')
				  {
					$disc = "Not Used";	
				  } 
				elseif($disc_status == '2')
				  {
					      if($disc_type == '1'){$disc = number_format(($disc_value/100)* $total, 2, '.', ',');}
					  elseif($disc_type == '2'){$disc = number_format($disc_value, 2, '.', ',');}	
				  } 
		   }
	
	return $disc;
	
	}	
}
	
	
/*----------------------------------- SHOW function ------------------------------------------------*/

function showTest_PID($con, $patient_id){
	$result = mysqli_query($con, "SELECT PT_test_name FROM patient_test WHERE PT_receipt_no = '".$patient_id."'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			$name[] = $row['PT_test_name'];
		   }
	echo implode(" | ", $name );
	}

	
function showName_usingID($con, $table_name, $column_name, $column_id_name, $id)
 {
	$result = mysqli_query($con, "SELECT $column_name FROM $table_name WHERE $column_id_name = '$id'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row[$column_name];
		   }
	return $name;
	 }

function showStateName($con, $state_id)
 {
	$result = mysqli_query($con, "SELECT state_name FROM state_tbl WHERE state_id = '$state_id'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row['state_name'];
		   }
	return $name;
	 }
function showDistrictName($con, $district_id)
 {
	$result = mysqli_query($con, "SELECT * FROM district_tbl WHERE district_id = '$district_id'"); 
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{ while($row = mysqli_fetch_array($result))
		    {  return $row['district_name']; }}
	
	 }
function showPin($con, $pin_id)
 {
	$result = mysqli_query($con, "SELECT pin_code FROM pin_tbl WHERE pin_id = '$pin_id'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row['pin_code'];
		   }
	return $name;
	 }
function showDeptName($con, $id)
 {
	$result = mysqli_query($con, "SELECT department_name FROM department_tbl WHERE department_id = '$id'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row['department_name'];
		   }
	return $name;
	 }
function showDesignation($con, $id)
 {
	$result = mysqli_query($con, "SELECT designation_name FROM designation_tbl WHERE designation_id = '$id'"); 
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row['designation_name'];
		   }
	return $name;
	 }
function showDesignation_short_form($con, $designation_id){
	$result = mysqli_query($con, "SELECT short_form FROM designation_tbl WHERE designation_id= '$designation_id'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['short_form'];}}
	}

function showSourceName($con, $source_id){
	$result = mysqli_query($con, "SELECT  source_name FROM source_btl WHERE source_id = '$source_id'");
	while($row = mysqli_fetch_array($result))
	return $row['source_name'];		
	}
function showSourceName_from_ref($con, $ref_id){
	$result = mysqli_query($con, "SELECT source_btl.source_name FROM referred_tbl LEFT JOIN source_btl ON source_btl.source_id = referred_tbl.source_id WHERE referred_id = '$ref_id'");
	while($row = mysqli_fetch_array($result))
	return $row['source_name'];		
	}
function showRef_from_ref($con, $ref_id){
	$result = mysqli_query($con, "SELECT referred_name FROM referred_tbl WHERE referred_id = '$ref_id'");
	while($row = mysqli_fetch_array($result))
	return $row['referred_name'];		
	}

function showRemark($con, $receipt_no){
	$result = mysqli_query($con, "SELECT PT_remark FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	while($row = mysqli_fetch_array($result))
	return $row['PT_remark'];	
	}
	
function showDiscount_code($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_code FROM discount_tbl WHERE disc_receipt_no= '".$receipt_no."'");
	if (mysqli_num_rows($result) == 0) 
          { return ""; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['disc_code'];} }	
	}
function showDiscount_code_sl($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_code_sl FROM discount_tbl WHERE disc_receipt_no= '".$receipt_no."'");
	if (mysqli_num_rows($result) == 0) 
          { return ""; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['disc_code_sl'];} }	
	}

function showStatus($con, $status_id){
	$result = mysqli_query($con, "SELECT status_name FROM status_tbl WHERE status_id = '$status_id'");
	while($row=mysqli_fetch_array($result))
	        {return $row['status_name'];}	
	}
	
function showDoctor_name($con, $dr_id){
	
	$result = mysqli_query($con, "SELECT dr_name FROM dr_profile WHERE dr_id = '$dr_id'");
	if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	else { while($row=mysqli_fetch_array($result))
	       {return $row['dr_name'];} }
	}


function showReferral($con, $source_id, $referred_id){
	if($source_id == 1)  // doctor
	{
	  $result = mysqli_query($con, "SELECT dr_name FROM dr_profile WHERE dr_id = '$referred_id'"); 
	  if (!$result) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return 'Dr. '.$row['dr_name'];}}
	 }
	elseif($source_id == 2) // staff
	{
	  $result = mysqli_query($con, "SELECT EMP_name FROM employee_tbl WHERE EMP_sl = '$referred_id'"); 
	  if (!$result) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return  $row['EMP_name'];}}
	}
	elseif($source_id == 3) // self
	{ return "";}
	else
	{
	  $result = mysqli_query($con, "SELECT referred_name FROM referred_tbl WHERE referred_id = '$referred_id' AND source_id = '$source_id'"); 
	  if (!$result) 
		 { return "No record in found on Referred table-error"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['referred_name'];}}
	}
}

/*------------------------------- Count Function --------------------------------------*/

function showTotal_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total_test_number FROM patient_test WHERE PT_receipt_no = '".$receipt_no."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total_test_number'];}}
	}
	
function countPending_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_status_id = '1'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
}

function showCompleted_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_status_id = '4'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function countDelivered_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_status_id = '5'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}	
function countReportAvailable_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_status_id = '11'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}
function countReturn_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_status_id = '12'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}		
	
function showAge_ext($con, $ext_id){
	
	if($ext_id =='1'){$ext ='Years';}
	elseif($ext_id =='2'){$ext ='Months';}
	elseif($ext_id =='3'){$ext ='Days';}
	else{$ext ='';}
	return $ext;
	
	}
	
function showAge_ext_short($con, $ext_id){
	
		if($ext_id =='1'){$ext ='Y';}
	elseif($ext_id =='2'){$ext ='M';}
	elseif($ext_id =='3'){$ext ='D';}
	else{$ext ='';}
	return $ext;
	
	}
	
	
function showLab_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total_test_number FROM patient_test WHERE PT_receipt_no = '".$receipt_no."' AND PT_dept_id ='5'  AND PT_status_id ='1'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total_test_number'];}}
	}

function showOverallTest_patient($con, $patient_id){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total_patient_test FROM patient_test WHERE PT_patient_id = '".$patient_id."'"); 
	  if (!$result) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total_patient_test'];}}
	}
	
/*---------------------One Day A/C statement------------------------------------*/	
function total_registration($con, $date){
	$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE DATE_FORMAT(pr_date,'%Y-%m-%d') = '".$date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
	
function total_investigation($con, $date){
	$result = mysqli_query($con, "SELECT COUNT(PT_sl) AS total FROM patient_test WHERE DATE_FORMAT(PT_status_date1,'%Y-%m-%d') = '".$date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
	
function total_expenditure($con, $date){
	$result = mysqli_query($con, "SELECT COUNT(EX_id) AS total FROM expenditure WHERE EX_date = '".$date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	


function totalDues_paid($con, $date){
	
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE DATE_FORMAT(PD_date,'%Y-%m-%d') = '".$date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}


/*---------------------B/w dates A/C statement------------------------------------*/	

function total_registration_bw($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE pr_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function total_investigation_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT COUNT(PT_sl) AS total FROM patient_test WHERE PT_status_date1 BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}		
	
function total_expenditure_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT COUNT(EX_id) AS total FROM expenditure WHERE EX_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
	
	
function totalBill_registration_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(PP_total) AS sum FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}
	
function totalTax_registration_bw($con, $start_date, $stop_date){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT PP_tax, PP_tax_value, PP_total FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $PP_total = $row['PP_total'];
			     $PP_tax = $row['PP_tax'];
			     $PP_tax_value = $row['PP_tax_value'];
			   if($PP_tax =='1')
			     {  $tax =  $PP_total * ($PP_tax_value/100);
					$total_tax = $total_tax + $tax; 
					}
		         }
			  
		       }
	return $total_tax;
	}

function totalDiscount_registration_bw($con, $start_date, $stop_date){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value FROM discount_tbl LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = discount_tbl.disc_receipt_no WHERE  patient_payment.PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."' AND discount_tbl.disc_status = '2'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $disc_status = $row['disc_status'];
			     $disc_type = $row['disc_type'];
			     $disc_value = $row['disc_value'];
				 $PP_tax = $row['PP_tax'];
				 $PP_tax_value = $row['PP_tax_value'];
				 $total = $row['PP_total'];
				 if($PP_tax =='1') {  
				    $PP_total =  $total + $total * ($PP_tax_value/100); }
				 if($PP_tax =='2') {  
				    $PP_total =  $total; }
				
				if($disc_status == '2')
				  {
					      if($disc_type == '1'){$disc = ($disc_value/100)* $PP_total; $total_disc = $total_disc + $disc;}
					  elseif($disc_type == '2'){$total_disc =  $total_disc + $disc_value;}	
				  } 			  
		       }
	   }
	return $total_disc;
	}

function totalNet_registration_bw($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(PP_net) AS sum FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}


function totalDue_registration_bw($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(PP_bal) AS sum FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function curClear_bw($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl WHERE patient_due_tbl.PD_date BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_payment.PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}	

function totalReceived_registration_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(PP_paid) AS sum FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function totalExpenditure_amount_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure WHERE EX_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}
	

function totalDues_paid_bw($con, $start, $stop){
	
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_date BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}	
	

/*--------------------- Admin Cut ------------------------------------*/	

function totalED_referral_bw($con, $referral_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE pr_date BETWEEN '".$start_date."' AND '".$stop_date."' AND pr_referred_id = '$referral_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "NO"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function totalTest_referral_bw($con, $referral_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT patient_test.PT_sl FROM patient_test JOIN patient_payment ON patient_payment.PP_receipt_no = patient_test.PT_receipt_no AND patient_payment.PP_bal <= 0 AND patient_payment.PP_disc_option = 2 WHERE patient_payment.PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}		

	
/*------------------------------- SUM Function --------------------------------------*/
	
function showTotalAmt_database($con, $receipt_no){
	$result = mysqli_query($con, "SELECT SUM(PT_test_price) AS sum FROM patient_test WHERE PT_receipt_no = '".$receipt_no."'"); 
	  if (mysqli_num_rows($result) ==0) 
		 { return "No record"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}
function showOverallAmt_patient($con, $patient_id){
	$result = mysqli_query($con, "SELECT SUM(PP_net) AS sum FROM patient_payment WHERE PP_patient_id = '".$patient_id."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}
	
function totalAmt_expenditure_oneDay($con, $date){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure WHERE DATE_FORMAT(EX_date, '%Y-%m-%d') = '".$date."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}
function totalAmt_all_expenditure($con){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure"); 
	 if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}	
	}

function totalAmt_bw_date_expenditure($con, $start, $stop){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure WHERE DATE_FORMAT(EX_date, '%Y-%m-%d %r.%i') >= '".$start."' AND DATE_FORMAT(EX_date, '%Y-%m-%d %r.%i') <= '".$stop."'"); 
	 if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}
	
function totalBill_registration($con, $date){
	$result = mysqli_query($con, "SELECT SUM(PP_total) AS sum FROM patient_payment WHERE DATE_FORMAT(PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}
	
function totalNet_registration($con, $date){
	$result = mysqli_query($con, "SELECT SUM(PP_net) AS sum FROM patient_payment WHERE DATE_FORMAT(PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	 if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}


function totalDue_registration($con, $date){
	$result = mysqli_query($con, "SELECT SUM(PP_bal) AS sum FROM patient_payment WHERE DATE_FORMAT(PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	   if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}
	
function totalTax_registration($con, $date){
	 $total_tax = 0;
	$result = mysqli_query($con, "SELECT PP_tax, PP_tax_value, PP_total FROM patient_payment WHERE DATE_FORMAT(PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	  if (!$result) 
		 { return ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $PP_total = $row['PP_total'];
			     $PP_tax = $row['PP_tax'];
			     $PP_tax_value = $row['PP_tax_value'];
			   if($PP_tax =='1')
			     {  $tax =  $PP_total * ($PP_tax_value/100);
					$total_tax = $total_tax + $tax; 
					}
		         }
			  
		       }
	return number_format($total_tax, 2, '.', ',');
	}
	
function totalDiscount_registration($con, $date){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value FROM discount_tbl LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = discount_tbl.disc_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	   if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $disc_status = $row['disc_status'];
			     $disc_type = $row['disc_type'];
			     $disc_value = $row['disc_value'];
				 $PP_tax = $row['PP_tax'];
				 $PP_tax_value = $row['PP_tax_value'];
				 $total = $row['PP_total'];
				 if($PP_tax =='1') {  
				    $PP_total =  $total + $total * ($PP_tax_value/100); }
				 if($PP_tax =='2') {  
				    $PP_total =  $total; }
				
				if($disc_status == '2')
				  {
					      if($disc_type == '1'){$disc = ($disc_value/100)* $PP_total; $total_disc = $total_disc + $disc;}
					  elseif($disc_type == '2'){$total_disc =  $total_disc + $disc_value;}	
				  } 			  
		       }
	   }
	return number_format($total_disc, 2, '.', ',');
	}

	
function totalReceived_registration($con, $date){
	$result = mysqli_query($con, "SELECT SUM(PP_paid) AS sum FROM patient_payment WHERE DATE_FORMAT(PP_paid_date,'%Y-%m-%d') = '".$date."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'] ;}
	   
	   }
	}
	
	
function totalExpenditure_amount($con, $date){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure WHERE DATE_FORMAT(EX_date,'%Y-%m-%d') = '".$date."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}
	
	
	
/*-----------------------------------------------------------------------*/

function checkDiscount($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_code_sl FROM discount_tbl WHERE disc_receipt_no = '".$receipt_no."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return "NO"; }
	   else { return "YES"; }
	}


function checkCurrent_receipt_no($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_code_sl FROM discount_tbl WHERE disc_receipt_no = '".$receipt_no."'"); 
	  if (mysqli_num_rows($result) ==0) 
		    { return "No"; }
	   else { return "Yes"; }
	}
function currentVersion_id($con){  // current version id from version table
     $result = mysqli_query($con, "SELECT PV_id FROM price_version WHERE PV_status = 'Current'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['PV_id'];}}	
	}
function currentVersion_name($con){  // current version id from version table
	$result = mysqli_query($con, "SELECT PV_name FROM price_version WHERE PV_status = 'Current'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['PV_name'];}}	
	}
	
function currentVersion_date($con){
	$result = mysqli_query($con, "SELECT PV_date FROM price_version WHERE PV_status = 'Current'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['PV_date'];}}
	}
function showVersion_name($con, $version_id){
	$result = mysqli_query($con, "SELECT PV_name FROM price_version WHERE PV_id = '$version_id'"); 
	  if (!$result) 
		 { return "No"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['PV_name'];}}
	
	}
function showCategory_name($con, $category_id){
	$result = mysqli_query($con, "SELECT test_category_name FROM test_category WHERE test_category_id = '$category_id'"); 
	  if (!$result) 
		 { return "No"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['test_category_name'];}}
	}
function showTest_name($con, $test_id){
	$result = mysqli_query($con, "SELECT test_name FROM test_tbl WHERE test_id = '$test_id'"); 
	  if (!$result) 
		 { return "No"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['test_name'];}}
	}

function countNo_of_letter($con, $EMP_sl){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total_letter FROM employee_letter WHERE EL_emp_sl = '$EMP_sl'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total_letter'];}}
	}

function checkDr_id_profile($con, $dr_id){
	$result = mysqli_query($con, "SELECT dr_id FROM dr_profile WHERE dr_id = '$dr_id'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['dr_id'];}}
	}
	
function showNumOfClinic($con, $dr_id){
	$result = mysqli_query($con, "SELECT COUNT(*) AS total_clinic FROM dr_clinic_tbl WHERE dr_id = '$dr_id'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total_clinic'];}}	
	}

function showNumOfFamily($con, $dr_id){
	$result = mysqli_query($con, "SELECT COUNT(family_id) AS total_family FROM dr_family_tbl WHERE family_dr_id = '$dr_id'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total_family'];}}	
	}

function showNumOfQualification($con, $emp_sl){
	$result = mysqli_query($con, "SELECT COUNT(emp_qualf_id) AS total_qualification FROM emp_qualification_tbl WHERE EQ_emp_sl = '$emp_sl'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total_qualification'];}}	
	}
function showNumOfExperience($con, $emp_sl){
	$result = mysqli_query($con, "SELECT COUNT(emp_prev_comp_id) AS total_experience FROM emp_prev_company WHERE PC_emp_sl = '$emp_sl'"); 
	 if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total_experience'];}}	
	}

function checkEmp_experience($con, $emp_sl){
	$result = mysqli_query($con, "SELECT emp_prev_comp_id FROM emp_prev_company WHERE PC_emp_sl = '$emp_sl'"); 
	  if (mysqli_num_rows($result) ==0) 
		 { return "No"; }
	else { mysqli_query($con, "UPDATE employee_tbl SET EMP_Q_prev_experience='1' WHERE EMP_sl = '$emp_sl'");
			return "Yes"; }
	}
function checkEmp_qualification($con, $emp_sl){
	$result = mysqli_query($con, "SELECT emp_qualf_id FROM emp_qualification_tbl WHERE EQ_emp_sl = '$emp_sl'"); 
	  if (mysqli_num_rows($result) == 0) 
		 { return "No"; }
	else { return "Yes"; }
	}

function getDr_id_from_clinic($con, $clinic_id){
	$result = mysqli_query($con, "SELECT dr_id FROM dr_clinic_tbl WHERE clinic_id = '$clinic_id'"); 
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['dr_id'];}}	
	}
function getDr_id_from_family($con, $family_id){
	$result = mysqli_query($con, "SELECT family_dr_id FROM dr_family_tbl WHERE family_id = '$family_id'"); 
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['family_dr_id'];}}	
	}

function validateUsername($con, $username, $password){	
	$result = mysqli_query($con, "SELECT * FROM user_table WHERE user_name = '".$username."' AND user_password = '".$password."' AND user_status = '1' LIMIT 1");
	if (mysqli_num_rows($result) == 0)
		 { 
		 header("location: index.php?msg=failed!"); 
		   }
	   else
	    {
		  while($row = mysqli_fetch_array($result)) 
		   {
			 $user_id = $row['user_id'];
			 $user_name = $row['user_name'];
			 $name = $row['name'];
			 $surname = $row['surname'];
			 $user_dept_id = $row['user_dept_id'];
		   }
		   if($user_dept_id == '1') //superUser
		     {
			  $_SESSION['status'] = 'login';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;			 
			  $_SESSION['surname'] = $surname;			 
			  $_SESSION['user_dept_id'] = $user_dept_id;			 
			  header("location: SAD_report_ui.php");			  
			  }
			 elseif($user_dept_id == '2') // admin
		     {
			  $_SESSION['status'] = 'login';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			 $_SESSION['name'] = $name;			 
			  $_SESSION['surname'] = $surname;			 
			  $_SESSION['user_dept_id'] = $user_dept_id;			 		 
			  header("location: admin_discount_search.php");			  
			  }
			elseif($user_dept_id == '3') //front desk
		     {
			  $_SESSION['status'] = 'login';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			 $_SESSION['name'] = $name;			 
			  $_SESSION['surname'] = $surname;			 
			  $_SESSION['user_dept_id'] = $user_dept_id;				 			 
			  header("location: fd_search.php");			  
			  }
			elseif($user_dept_id == '4') // sample collection
		     {
			  $_SESSION['status'] = 'login';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;			 
			  $_SESSION['surname'] = $surname;			 
			  $_SESSION['user_dept_id'] = $user_dept_id;	 			 
			  header("location: sample_collection_table.php");			  
			  }
			  elseif($user_dept_id == '9') // sample collection
		     {
			  $_SESSION['status'] = 'login';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;			 
			  $_SESSION['surname'] = $surname;			 
			  $_SESSION['user_dept_id'] = $user_dept_id;	 			 
			  header("location: employee_personal.php");			  
			  }
		   
		 }
}

function checkBalance($con, $receipt_no){	
	$result = mysqli_query($con, "SELECT PP_bal FROM patient_payment WHERE PP_receipt_no = '$receipt_no'");	
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['PP_bal'];}}		
	}

function countNumberOfReferred($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT COUNT(*) AS num FROM discount_tbl WHERE disc_source_id = '$source_id' AND disc_referred_id='$referred_id' AND MONTH(disc_status_date) = MONTH(NOW()) AND disc_status='2'");
	
	if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['num'];}}	
	}

function getPatient_id($con, $receipt_no){	
	$result = mysqli_query($con, "SELECT pr_patient_id FROM patient_registration WHERE pr_receipt_no = '$receipt_no'");	
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['pr_patient_id'];}}		
	}
function getSource_id($con, $receipt_no){	
	$result = mysqli_query($con, "SELECT pr_source_id FROM patient_registration WHERE pr_receipt_no = '$receipt_no'");	
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['pr_source_id'];}}		
	}
function getReffered_id($con, $receipt_no){	
	$result = mysqli_query($con, "SELECT pr_referred_id FROM patient_registration WHERE pr_receipt_no = '$receipt_no'");	
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['pr_referred_id'];}}		
	}


/*----------------------------- FD Due  -----------------------------------*/
function TotalBill_source($con, $source_id){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_total) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no =  patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'],'2','.',',');}}
	}
	
function total_EDs_source($con, $source_id){
	$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_receipt_no) AS total FROM patient_registration JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no  WHERE patient_registration.pr_source_id = '$source_id' AND patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
	
function Total_EDs_due($con){
	$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_receipt_no) AS total FROM patient_registration JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no  WHERE patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function total_investigation_source($con, $source_id){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id'  AND patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function total_investigation_due($con){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
	
function TotalPaid_source($con, $source_id){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no =  patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'],'2','.',',');}}
	}

function totalTax_source($con, $source_id){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $PP_total = $row['PP_total'];
			     $PP_tax = $row['PP_tax'];
			     $PP_tax_value = $row['PP_tax_value'];
			   if($PP_tax =='1')
			     {  $tax =  $PP_total * ($PP_tax_value/100);
					$total_tax = $total_tax + $tax; 
					}
		         }
			  
		       }
	return number_format($total_tax, 2, '.', ',');
	}



function totalDiscount_source($con, $source_id){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value, discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN discount_tbl ON discount_tbl.disc_receipt_no = patient_payment.PP_receipt_no WHERE patient_registration.pr_source_id = '$source_id'"); 
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $disc_status = $row['disc_status'];
			     $disc_type = $row['disc_type'];
			     $disc_value = $row['disc_value'];
				 $total = $row['PP_total'];
				 $PP_tax = $row['PP_tax'];
				 $PP_tax_value = $row['PP_tax_value'];
				 
				 if($PP_tax =='1') {  
				    $PP_total =  $total + $total * ($PP_tax_value/100); }
				 if($PP_tax =='2') {  
				    $PP_total =  $total; }
				 
				
				if($disc_status == '2')
				  {
					      if($disc_type == '1'){$disc = ($disc_value/100)* $PP_total; $total_disc = $total_disc + $disc;}
					  elseif($disc_type == '2'){$total_disc =  $total_disc + $disc_value;}	
				  } 			  
		       }
	   }
	return number_format($total_disc, 2, '.', ',');
	}

function TotalBal_source($con, $source_id){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_bal) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no =  patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'],'2','.',',');}}
	}

function total_balance_all($con){
	
	$result = mysqli_query($con, "SELECT SUM(PP_bal) AS sum FROM patient_payment"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'],'2','.',',');}
	}
	
	}

/*---------------------------Dues ------------------------------------------*/
function totalED_source_name($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_receipt_no) AS total FROM patient_registration JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id' AND patient_registration.pr_referred_id = '$referred_id' AND patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function totalTest_source_name($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id' AND patient_registration.pr_referred_id = '$referred_id' AND patient_payment.PP_bal !=0"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function TotalBal_source_name($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_bal) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no =  patient_registration.pr_receipt_no WHERE patient_registration.pr_source_id = '$source_id' AND patient_registration.pr_referred_id = '$referred_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'],'2','.',',');}}
	}















/*-------------------- Editing patient payment / Registration -----------------------*/

function showPaid_amount($con, $receipt_no){
	
	$result = mysqli_query($con, "SELECT t1.*, SUM(t2.PD_bal_paid) AS sum FROM patient_payment t1 LEFT JOIN patient_due_tbl t2 ON t2.PD_pp_sl = t1.PP_sl WHERE t1.PP_receipt_no = '$receipt_no'"); 
  if (mysqli_num_rows($result)==0) 
		 {return $row['PP_paid']; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'] + $row['PP_paid'] ;} }
	
	}
/*---------------------- SUPER ADMIN ------------------------------*/	

function doctorWise_registration($con, $dr_id, $start, $stop){	

$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_dr_prescription) AS total FROM patient_payment LEFT JOIN patient_registration ON  patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE pr_dr_prescription ='$dr_id' AND  DATE_FORMAT(pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_bal = 0 AND patient_payment.PP_disc_option ='2'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function sumNet_eachPerson($con, $ref, $start, $stop){
	
$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) as bill FROM patient_registration LEFT JOIN patient_payment ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_payment.PP_patient_id WHERE patient_registration.pr_dr_prescription ='$ref' AND DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_bal = 0 AND patient_payment.PP_disc_option ='2'");
	if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['bill'];}}
	}
	
function others_registration($con, $src, $ref, $start, $stop){	

$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_receipt_no) AS total FROM patient_registration INNER JOIN patient_payment ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_registration.pr_source_id ='$src' AND patient_registration.pr_referred_id ='$ref' AND DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_bal = 0 AND patient_payment.PP_disc_option ='2'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}
	
function sumNet_eachReferral($con, $src, $ref, $start, $stop){
	
$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) as bill FROM patient_registration LEFT JOIN patient_payment ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_payment.PP_patient_id WHERE patient_registration.pr_source_id ='$src' AND patient_registration.pr_referred_id ='$ref' AND DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_bal = 0 AND patient_payment.PP_disc_option ='2'");
	if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['bill'];}}
	}

/*------------ FD REPORT -------*/

function dueClear_btw_pp_sl($con, $pp_sl, $start, $stop){
	
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_pp_sl = '$pp_sl' AND PD_date BETWEEN '".$start."' AND '".$stop."'");
		if (mysqli_num_rows($result)==0) 
		 { echo ""; }
		else{while($check2 = mysqli_fetch_array($result)) {		
				  return $check2['sum']; }}
	
	}


/*------------Editing ----------------*/

function show_gender_short($con, $gender_id){	
	if($gender_id =='1'){ return "M";} elseif($gender_id =='2'){ return "F";}else{return '';}	
	}
function show_gender_long($con, $gender_id){	
	if($gender_id =='1'){ return "Male";} elseif($gender_id =='2'){ return "Female";}else{return '';}	
	}

function show_age_short($con, $age_y, $age_m, $age_d){	
		 if( $age_y !='0' && $age_m =='0' && $age_d =='0' ){return $age_y.'y';}
	else if( $age_y =='0' && $age_m !='0' && $age_d =='0' ){return $age_m.' m';} 
	else if( $age_y =='0' && $age_m =='0' && $age_d !='0' ){return $age_d.' d';} 
	else if( $age_y !='0' && $age_m !='0' && $age_d =='0' ){return $age_y.' y '.$age_m.' m';} 
	else if( $age_y !='0' && $age_m =='0' && $age_d !='0' ){return $age_y.' y '.$age_d.' d';} 
	else if( $age_y =='0' && $age_m !='0' && $age_d !='0' ){return $age_m.' m '.$age_d.' d';} 
	else if( $age_y !='0' && $age_m !='0' && $age_d !='0' ){return $age_y.'y '.$age_m.'m '.$age_d.'d';} 
	}
function show_age_long($con, $age_y, $age_m, $age_d){	
		 if( $age_y !='0' && $age_m =='0' && $age_d =='0' ){ return $age_y.' years';}
	else if( $age_y =='0' && $age_m !='0' && $age_d =='0' ){return $age_m.' months';} 
	else if( $age_y =='0' && $age_m =='0' && $age_d !='0' ){return $age_d.' days';} 
	else if( $age_y !='0' && $age_m !='0' && $age_d =='0' ){return $age_y.' years '.$age_m.' months';} 
	else if( $age_y !='0' && $age_m =='0' && $age_d !='0' ){return $age_y.' years '.$age_d.' days';} 
	else if( $age_y =='0' && $age_m !='0' && $age_d !='0' ){return $age_m.' months '.$age_d.' days';} 
	else if( $age_y !='0' && $age_m !='0' && $age_d !='0' ){return $age_y.' years '.$age_m.' months '.$age_d.' days';} 
	}

function show_marital_status($con, $marital_id){
	
$result = mysqli_query($con, "SELECT marital_name FROM marital_tbl WHERE marital_id = '$marital_id'");
		if (mysqli_num_rows($result)==0) 
		 { echo ""; }
		else{while($check2 = mysqli_fetch_array($result)) {		
				  return $check2['marital_name']; }}
	}

function checkDiscount_code($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_code FROM discount_tbl WHERE disc_receipt_no = '".$receipt_no."'");
	if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['disc_code'];}}
	}
	
/*------------------------- Payment index/detail---------------------------------------*/

function total_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE pr_referred_id = '$ref_id' AND DATE_FORMAT(pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}

function total_investigation_bw_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no WHERE DATE_FORMAT(patient_test.PT_status_date1,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}		
	
function totalBill_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_total) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'"); 
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}
	
function totalTax_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT PP_tax, PP_tax_value, PP_total FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $PP_total = $row['PP_total'];
			     $PP_tax = $row['PP_tax'];
			     $PP_tax_value = $row['PP_tax_value'];
			   if($PP_tax =='1')
			     {  $tax =  $PP_total * ($PP_tax_value/100);
					$total_tax = $total_tax + $tax; 
					}
		         }
			  
		       }
	return $total_tax;
	}

function totalDiscount_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value FROM discount_tbl LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = discount_tbl.disc_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND discount_tbl.disc_referred_id = '$ref_id' AND discount_tbl.disc_status = '2'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{
		  
		   while($row = mysqli_fetch_array($result)) {
			     $disc_status = $row['disc_status'];
			     $disc_type = $row['disc_type'];
			     $disc_value = $row['disc_value'];
				 $PP_tax = $row['PP_tax'];
				 $PP_tax_value = $row['PP_tax_value'];
				 $total = $row['PP_total'];
				 if($PP_tax =='1') {  
				    $PP_total =  $total + $total * ($PP_tax_value/100); }
				 if($PP_tax =='2') {  
				    $PP_total =  $total; }
				
				if($disc_status == '2')
				  {
					      if($disc_type == '1'){$disc = ($disc_value/100)* $PP_total; $total_disc = $total_disc + $disc;}
					  elseif($disc_type == '2'){$total_disc =  $total_disc + $disc_value;}	
				  } 			  
		       }
	   }
	return $total_disc;
	}

function totalNet_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}


function totalDue_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(PP_bal) AS sum FROM patient_payment WHERE PP_paid_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

// DUE clear on selected date with particular ref_id
function curClear_bw_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'AND patient_registration.pr_referred_id = '$ref_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}	

function oldClear_bw_ref($con, $ref_id, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_due_tbl.PD_bal_paid !='0' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') NOT BETWEEN '".$start."' AND '".$stop."' AND patient_registration.pr_referred_id = '$ref_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}	

function dueClear_btw_pp_sl_ref($con, $pp_sl, $start, $stop){
	
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_pp_sl = '$pp_sl' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'");
		if (mysqli_num_rows($result)==0) 
		 { echo ""; }
		else{while($check2 = mysqli_fetch_array($result)) {		
				  return $check2['sum']; }}
	
	}



// total dues paid bw dates	
function totalDues_paid_bw_ref($con, $ref_id, $start, $stop){
	
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_date BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	
	}	

function totalReceived_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}	

function total_reg_date($con, $start, $stop){
	$result = mysqli_query($con, "SELECT COUNT(patient_registration.pr_receipt_no) AS total FROM patient_registration WHERE DATE_FORMAT(pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	

function total_test_date($con, $start, $stop){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}	
	}	
function total_net_date($con, $start, $stop){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function curClear_date($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl WHERE DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}	
	}
	
function oldClear_date($con, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_due_tbl.PD_bal_paid !='0' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') NOT BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
}	
	
function oldClear_dateTime($con, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_due_tbl.PD_bal_paid !='0' AND patient_due_tbl.PD_date BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_paid_date NOT BETWEEN '".$start."' AND '".$stop."'"); 
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
}	

function totalReceived_registration_date($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_payment WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}	

function show_sourceType_abree($con, $source_id){
	$result = mysqli_query($con, "SELECT source_abbre FROM source_btl WHERE source_id = '$source_id'");
	 if (mysqli_num_rows($result)==0) 
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['source_abbre'].'/';}}
	}

?>