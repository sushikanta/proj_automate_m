<?php

if(!file_exists('config.php'))
{
	header("location: framework/install");
	exit;
}

if(@$_REQUEST['reset']){
	session_start();
	session_destroy();
	header( 'Location: index.php' ) ;
	exit;
}
require_once("config.php"); require_once("function.php");?>
<?php

/*--------------------- COUNTERS --------------------------*/
function getCounter($con, $id){
	$result=mysqli_query($con, "SELECT counter_value FROM counter_tbl WHERE counter_id='$id' LIMIT 1");
	while($row = mysqli_fetch_array($result))
        return $row['counter_value'];
	}

function updateCounter($con, $id){
	mysqli_query($con, "UPDATE counter_tbl SET counter_value = counter_value+1, last_updated_date=CURDATE() WHERE counter_id ='$id' LIMIT 1");
	}

function resetOne($con, $id, $cur_date){
	mysqli_query($con, "UPDATE counter_tbl SET counter_value = '1', last_updated_date='$cur_date' WHERE counter_id='$id' LIMIT 1");
	}

function resetCounter($con, $id, $type){
	$cur_date=date('Y-m-d');
	$result=mysqli_query($con, "SELECT counter_id, counter_value, last_updated_date FROM counter_tbl WHERE counter_id='$id' LIMIT 1");
    while($row=mysqli_fetch_array($result))
    $last_update=$row['last_updated_date'];

   if($type =='dd') // daily reset
		 {
		   if(strtotime($last_update) != strtotime($cur_date))
		    mysqli_query($con, "UPDATE counter_tbl SET counter_value = '1', last_updated_date='$cur_date' WHERE counter_id='$id' LIMIT 1");
		 }


	if($type =='mm') // monthly reset
		 {

		   if(date('Y', strtotime($last_update)) != date('Y', strtotime($cur_date))){
			 mysqli_query($con, "UPDATE counter_tbl SET counter_value = '1', last_updated_date='$cur_date' WHERE counter_id='$id' LIMIT 1");
			 }
		  if(date('m', strtotime($last_update)) != date('m', strtotime($cur_date))){
			  mysqli_query($con, "UPDATE counter_tbl SET counter_value = '1', last_updated_date='$cur_date' WHERE counter_id='$id' LIMIT 1");
			}
	   }

	if($type =='yy') // yearly reset
		 {
			if(date('Y', strtotime($last_update)) != date('Y', strtotime($cur_date)))
			//resetOne($con, $id, $cur_date);
			mysqli_query($con, "UPDATE counter_tbl SET counter_value = '1', last_updated_date='$cur_date' WHERE counter_id='$id' LIMIT 1");
		 }
}

function validateUsername($con, $username, $password){
	$_password = md5($password);
	$result = mysqli_query($con, "SELECT user_id, user_name, user_password, name, surname, user_dept_id, user_date, user_status FROM user_table WHERE user_name = '".$username."' AND user_password = '".$_password."' LIMIT 1");
	if (mysqli_num_rows($result) == 0)
		 {
		 header("location: index.php?errmsg=1");
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
			 $status = $row['user_status'];
		   }
		 if ($status != '1')
      		 header("location: index.php?errmsg=2");
		   else{
		   if($user_dept_id == '1') //superUser
		     {
			  $_SESSION['status'] = 'okSuper';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: SAD_report_ui.php");
			  }
		   if($user_dept_id == '2') // admin
		     {
			  $_SESSION['status'] = 'okAdmin';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			 $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: search_ui_admin.php");
			  }
			if($user_dept_id == '3') //front desk
		     {
			  $_SESSION['status'] = 'okFront';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: fd_search.php");
			  }
			if($user_dept_id == '4') // sample collection
		     {
			  $_SESSION['status'] = 'okSample';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: sample_collection_table.php");
			  }
			if($user_dept_id == '9') // hr collection
		     {
			  $_SESSION['status'] = 'okHr';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: employee_add.php");
			  }
		    if($user_dept_id == '22') // MT
		     {
			  $_SESSION['status'] = 'okMt';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['user_name'] = $user_name;
			  $_SESSION['name'] = $name;
			  $_SESSION['surname'] = $surname;
			  $_SESSION['user_dept_id'] = $user_dept_id;
			  header("location: MT_test_list.php");
			  }
		 }
		}
}

function getSettings($con){
	$result = mysqli_query($con, "SELECT * FROM settings");
	if (mysqli_num_rows($result) > 0)
	{
		$settings = [];
		while($row = mysqli_fetch_array($result))
		{
			$settings[$row['setting_key']] = $row;
		}
		$_SESSION['app_settings'] = $settings;
	}
}

function getTrialParams($trial_days, $installed_date)
{
	$results = [];
	if($trial_days && $installed_date){
		$now = time(); // or your date as well
		$your_date = strtotime($installed_date);
		$elaspe_seconds = $now - $your_date;

		$trial_seconds =  (($trial_days * 24) * 60) * 60;
		$diff_seconds = $trial_seconds - $elaspe_seconds;
		$remained_days = floor($diff_seconds/(60*60*24));

		$results = [
			'seconds_left' =>@$diff_seconds?$diff_seconds:0,
			'days_left' => @$remained_days?$remained_days:0
		];
	}
	return $results;

}

function error_message($con, $id){
			if ($id =='1'){ return 'Invalid Username & Password, please recheck.'; }
			if ($id =='2'){ return 'Username was disabled, please contact system admin.'; }
			if ($id =='3'){ return 'Please login first.'; }
			if ($id =='4'){ return 'Opps ! something is wrong in ADD'; }
			if ($id =='5'){ return 'Opps ! something is wrong in EDIT'; }
			if ($id =='6'){ return 'Opps ! something is wrong in DELETE'; }
			if ($id =='7'){ return 'Opps ! ADD failed, alrealy exist some information !'; }
			if ($id =='8'){ return 'No action is performed - nothing is changed !'; }
	}
function success_message($con, $id){
			if ($id =='1'){ return 'You have logout successfully.'; }
			if ($id =='2'){ return 'Username was disabled, please contact system admin.'; }
			if ($id =='3'){ return ''; }
			if ($id =='4'){ return 'Add successfully'; }
			if ($id =='5'){ return 'Edited Successfully.'; }
			if ($id =='6'){ return 'Deleted Successfully'; }
			if ($id =='7'){ return 'Password Changed Successfully'; }
	}

	function showFull_login($con, $user_id){
	$result = mysqli_query($con, "SELECT user_name, name, surname FROM user_table WHERE user_id = '$user_id' LIMIT 1");
	if (mysqli_num_rows($result) == 0)
         return "";
	else  { while($row=mysqli_fetch_array($result))
	        return $row['user_name'].' ('.$row['name'].' '.$row['surname'].')';}
	}


/*----------- Patient Registration -----------*/
function getNet_amount($con, $receipt_no, $amount, $tax){
	$result = mysqli_query($con, "SELECT disc_type, disc_value FROM discount_tbl WHERE disc_receipt_no= '$receipt_no' LIMIT 1");
	if (mysqli_num_rows($result) == 0)
        return "0";
	else  { while($row=mysqli_fetch_array($result)){
	        $disc_type=$row['disc_type'];
			$disc_value=$row['disc_value'];}

			if($disc_type =='P')
			$final = $amount - ($amount * 0.01 * $disc_value);
			return $final;
			}
	}

function showTotalAmt_database($con, $receipt_no){
	$result = mysqli_query($con, "SELECT SUM(PT_test_price) AS sum FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	  if (mysqli_num_rows($result) ==0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function showPatient_type($con, $PI_card){
	if ($PI_card == 1){ return "Card Holder";}
	if ($PI_card == 2){ return "Normal Patient";}
	}

function showCard_status($con, $PI_card){
	if ($PI_card == 1){ return "Active";}
	if ($PI_card == 2){ return "Disabled";}
	}

/*---------------------- Patient Receipt --------------------*/
function showHistory_patient($con, $patient_id){
	$msg="";
	$result = mysqli_query($con, "SELECT PH_history FROM patient_history WHERE PH_patient_id ='$patient_id'");
  if (mysqli_num_rows($result) == 0)
     $msg="";
 else  { while($row = mysqli_fetch_array($result))

		 $msg .= $row['PH_history'].", ";
	  }
	  return $msg;
  }

 function showLab_note($con, $receipt_no){
	$msg="";
	$result = mysqli_query($con, "SELECT LB_note FROM lab_note WHERE LB_receipt_no ='$receipt_no'");
  if (mysqli_num_rows($result) == 0)
      $msg="";
 else  { while($row = mysqli_fetch_array($result))
	     $msg .= $row['LB_note'].", ";
	  }
	   return $msg;
  }

 function showTax_value($con, $receipt_no){
	$result = mysqli_query($con, "SELECT TX_value FROM tax_tbl WHERE TX_receipt_no ='$receipt_no' LIMIT 1");
  if (mysqli_num_rows($result) == 0)
      $tax="0.00";
 else  {
 		while($row = mysqli_fetch_array($result))
	     $tax=$row['TX_value'];
	  }
	   return $tax;
  }


   //------------ DISCOUNT VALUE
  function showDiscount_value($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_type, disc_value FROM discount_tbl WHERE disc_receipt_no ='$receipt_no' LIMIT 1");
  if (mysqli_num_rows($result) == 0)
      $_disc_value="0";
 else  {
 		while($row = mysqli_fetch_array($result))
	     {$disc_type=$row['disc_type'];
		 $disc_value=$row['disc_value'];}
		 if($disc_type ==1){$_disc_value = $disc_value.'%';}
		 if($disc_type ==2){$_disc_value = 'Rs. '.$disc_value;}
	  }
	   return $_disc_value;
  }

  function getDiscount_value($con, $receipt_no, $disc_type){
	$result = mysqli_query($con, "SELECT disc_value FROM discount_tbl WHERE disc_receipt_no= '".$receipt_no."' AND disc_type= '".$disc_type."'");
	if (mysqli_num_rows($result) == 0)
        return "";
	else  { while($row=mysqli_fetch_array($result))
	        return $row['disc_value'];}
	}

  function discountValue($con, $receipt_no){
	$result = mysqli_query($con, "SELECT disc_value FROM discount_tbl WHERE disc_receipt_no ='$receipt_no' LIMIT 1");
  if (mysqli_num_rows($result) == 0)
      $disc_value="0";
 else  {
 		while($row = mysqli_fetch_array($result))
	     $disc_value=$row['disc_value'];
	  }
	   return $disc_value;
  }

  function showDiscount_in_amt($con, $receipt_no, $total){
	$result = mysqli_query($con, "SELECT disc_type, disc_value FROM discount_tbl WHERE disc_receipt_no ='$receipt_no' LIMIT 1");
  if (mysqli_num_rows($result) == 0)
      $disc_amt="0.00";
 else  {
 		while($row = mysqli_fetch_array($result))
	     {$disc_value=$row['disc_value'];
		  $disc_type=$row['disc_type'];}

		  if($disc_type ==1){ $disc_amt = $total * $disc_value * 0.01; }
		  if($disc_type ==2){ $disc_amt = $disc_value; }
	  }
	   return $disc_amt;
  }

 //--------  Pending all / Test count
 function showTest_count($con, $receipt_no, $status_id){
   	if($status_id =='0')
	$result = mysqli_query($con, "SELECT COUNT(PT_sl) AS total FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	else
	$result = mysqli_query($con, "SELECT COUNT(PT_sl) AS total FROM patient_test WHERE PT_receipt_no = '$receipt_no' AND PT_status_id = '$status_id'");
    if (mysqli_num_rows($result)==0)
	   return "0";
	   else{while($row = mysqli_fetch_array($result)) return $row['total'];}
    }

/*------------------- AC STATEMENT FD  -------------------*/
function all_test_eid($con, $receipt_no){
	$sl_no=1;
	$result = mysqli_query($con, "SELECT PT_test_name FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	 while($row = mysqli_fetch_array($result))
		   {
			$name[] = $sl_no.') '.$row['PT_test_name'];
			$sl_no++;
		   }

	echo implode(", ", $name );
	}

function calcDiscount_EID($con, $receipt_no){
	$result = mysqli_query($con, "SELECT d.disc_type, d.disc_value, y.PP_total, y.PP_tax_value FROM discount_tbl d LEFT JOIN patient_payment y ON y.PP_receipt_no = d.disc_receipt_no WHERE d.disc_receipt_no = '$receipt_no'");
	if (mysqli_num_rows($result) == 0)
          { return "0.00"; }
	else
	  {
	     while($row=mysqli_fetch_array($result)){
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


function showName_usingID($con, $table_name, $column_name, $pr_id, $id)
 {
	$result = mysqli_query($con, "SELECT $column_name FROM $table_name WHERE $pr_id = '$id'");
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
function showDeptName($con, $id)
 {
	$result = mysqli_query($con, "SELECT department_name FROM department_tbl WHERE department_id = '$id'");
	 while($row = mysqli_fetch_array($result))
		   {
			 $name = $row['department_name'];
		   }
	return $name;
	 }
function showDeptName_test($con, $test_id)
 {
	$result = mysqli_query($con, "SELECT department_tbl.department_id, department_tbl.department_name, test_category.test_category_name FROM test_tbl LEFT JOIN test_category ON test_category.test_category_id = test_tbl.test_category_id LEFT JOIN department_tbl ON department_tbl.department_id = test_category.TC_dept_id WHERE test_tbl.test_id = '$test_id'");
	 while($row = mysqli_fetch_array($result))
		   {
			 $id = $row['department_id'];
			 $category = $row['test_category_name'];
			 $department = $row['department_name'];
		   }
		   if($id == 5)
		   {return "Dept : ".$department.", Category : ".$category;}
			else{return"Dept: ".$department;}
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
	$result = mysqli_query($con, "SELECT source_name FROM source_tbl WHERE source_id = '$source_id'");
	while($row = mysqli_fetch_array($result))
	return $row['source_name'];
	}
function showSourceName_from_ref($con, $ref_id){
	$result = mysqli_query($con, "SELECT source_tbl.source_name FROM referred_tbl LEFT JOIN source_tbl ON source_tbl.source_id = referred_tbl.source_id WHERE referred_id = '$ref_id'");
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

/*-------- RELATION --------*/
function showRelation($con, $relation_type){
	$result = mysqli_query($con, "SELECT RT_name FROM relation_type WHERE RT_id = '$relation_type'");
	if (mysqli_num_rows($result)==0)
		 { return ""; }
	else{
	while($row = mysqli_fetch_array($result))
	return $row['RT_name'];
	}
}


/*----------- Status Table -----------*/
function showStatus($con, $status_id){
	$result = mysqli_query($con, "SELECT status_name FROM status_tbl WHERE status_id = '$status_id'");
	if (mysqli_num_rows($result)==0)
		 { return ""; }
	else{while($row=mysqli_fetch_array($result))
	        return $row['status_name'];
	}
	}

function showStatus_tc($con, $status_id, $table_name, $column_name){
	$result = mysqli_query($con, "SELECT status_name FROM status_tbl WHERE status_id = '$status_id' AND  status_table = '".$table_name."' AND  status_column = '".$column_name."'");
	while($row=mysqli_fetch_array($result))
	        {return $row['status_name'];}
	}

function showDoctor_name($con, $dr_id){

	$result = mysqli_query($con, "SELECT dr_name FROM dr_info WHERE dr_id = '$dr_id'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	else { while($row=mysqli_fetch_array($result))
	       {return $row['dr_name'];} }
	}

function showDoctor_phone($con, $dr_id){

	$result = mysqli_query($con, "SELECT dr_phone FROM dr_info WHERE dr_id = '$dr_id'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	else { while($row=mysqli_fetch_array($result))
	       {return $row['dr_phone'];} }
	}


function showReferral($con, $source_id, $referred_id){
	if($source_id == '1')  // doctor
	{
	  $result = mysqli_query($con, "SELECT dr_name FROM dr_profile WHERE dr_id = '$referred_id'");
	  if (!$result)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return 'Dr. '.$row['dr_name'];}}
	 }
	elseif($source_id == '2') // staff
	{
	  $result = mysqli_query($con, "SELECT EI_name FROM emp_info WHERE EI_id = '$referred_id'");
	  if (!$result)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return  $row['EI_name'];}}
	}
	elseif($source_id == '3') // self
	{ return "";}
	else
	{
	  $result = mysqli_query($con, "SELECT referred_name FROM referred_tbl WHERE referred_id = '$referred_id' AND source_id = '$source_id'");
	  if (!$result)
		 { return "No record in found on Referred table-error"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['referred_name'];}}
	}
}

/*------- Count Function -------------*/
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

/*---------- discount create, Discounted EID ---------------*/

function showOverall_test($con, $receipt_no){
	$result = mysqli_query($con, "SELECT COUNT(PT_sl) AS total FROM patient_test inner join patient_registration ON patient_test.PT_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_patient_id IN (SELECT pr_patient_id FROM patient_registration WHERE pr_receipt_no = '$receipt_no')");
	 if (mysqli_num_rows($result)==0)
		  return "0";
	   else
	    {while($row = mysqli_fetch_array($result))
	     return $row['total'];}
	}
function showOverall_amount($con, $receipt_no){
	$result = mysqli_query($con, "SELECT SUM(PP_net) AS sum FROM patient_payment inner join patient_registration ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_patient_id IN (SELECT pr_patient_id FROM patient_registration WHERE pr_receipt_no = '$receipt_no')");
	  if (mysqli_num_rows($result) ==0)
		    { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return number_format($row['sum'], 2, '.', ',');}}
	}

function countDisc_staff($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT COUNT(d.disc_code_sl) AS total FROM discount_tbl d INNER JOIN patient_registration r ON r.pr_receipt_no = d.disc_receipt_no WHERE d.disc_receipt_no IN (SELECT pr_receipt_no FROM patient_registration WHERE pr_source_id = '$source_id' AND pr_referred_id='$referred_id') AND MONTH(d.disc_status_date) = MONTH(NOW())");
if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function staffDiscount_thisMonth($con, $source_id, $referred_id){
	$result = mysqli_query($con, "SELECT COUNT(disc_code_sl) AS num FROM discount_tbl WHERE disc_status='D' AND disc_receipt_no IN (SELECT pr_receipt_no FROM patient_registration WHERE pr_source_id = '$source_id' AND pr_referred_id='$referred_id' AND MONTH(pr_date) = MONTH(NOW()))");
	if (mysqli_num_rows($result)==0)
		 return "0".mysqli_error($con);
	 else{while($row = mysqli_fetch_array($result)) return $row['num'];}
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

function expenditure_amount($con, $id){
	$result = mysqli_query($con, "SELECT EX_amount FROM expenditure WHERE EX_id = '$id'");
  if (mysqli_num_rows($result)==0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['EX_amount'];}}
	}


function totalDues_paid($con, $date){

	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE DATE_FORMAT(PD_date,'%Y-%m-%d') = '".$date."'");
  if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}

	}


/*---------------------A/C statement FD_report_bw_dates_collective.php ------------------------------------*/

function total_registration_bw($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE pr_date BETWEEN '".$start_date."' AND '".$stop_date."'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function total_investigation_bw($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no WHERE PT_status_date1 BETWEEN '".$start_date."' AND '".$stop_date."'");
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
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_total) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_registration.pr_date BETWEEN '".$start_date."' AND '".$stop_date."'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function totalTax_registration_bw($con, $start_date, $stop_date){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_total FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_date BETWEEN '".$start_date."' AND '".$stop_date."'");
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
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, discount_tbl.disc_receipt_no, patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_total FROM patient_registration INNER JOIN discount_tbl ON patient_registration.pr_receipt_no = discount_tbl.disc_receipt_no INNER JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE patient_registration.pr_date BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_payment.PP_disc_option ='1' AND discount_tbl.disc_status = '2'");
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
$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_registration.pr_date BETWEEN '".$start_date."' AND '".$stop_date."'");
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

function total_first_received_bw($con, $start_date, $stop_date){
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

//patient _registration patient_edit
function totalTest_amount($con, $receipt_no){
  $result = mysqli_query($con, "SELECT SUM(PT_test_price) AS sum FROM patient_test WHERE PT_receipt_no ='$receipt_no'");
	 if (mysqli_num_rows($result)==0)
		 { return "0"; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}


	/*------------------------- Source Report - FD_report_ac_statement_ui.php ---------------------------------------*/

function registration_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE pr_referred_id = '$ref_id' AND DATE_FORMAT(pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function investigation_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no WHERE DATE_FORMAT(patient_test.PT_status_date1,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function bill_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_total) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function tax_ref($con, $ref_id, $start_date, $stop_date){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_total FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
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

function discount_ref($con, $ref_id, $start_date, $stop_date){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT discount_tbl.disc_status, discount_tbl.disc_type, discount_tbl.disc_value, discount_tbl.disc_receipt_no, patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_total FROM patient_registration INNER JOIN discount_tbl ON patient_registration.pr_receipt_no = discount_tbl.disc_receipt_no INNER JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id' AND patient_payment.PP_disc_option ='1'");
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

function net_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function paid_first_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function cur_clear_ref($con, $ref_id, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_registration INNER JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN patient_due_tbl ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl WHERE DATE_FORMAT(patient_registration.pr_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."'AND patient_registration.pr_referred_id = '$ref_id'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}






function dues_paid_all_date($con, $start, $stop){
  $result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE DATE_FORMAT(PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'");
  if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function totalDues_paid_bw_ref($con, $ref_id, $start, $stop){
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_date BETWEEN '".$start."' AND '".$stop."'");
  if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}

	}

function dueClear_btw_pp_sl_ref($con, $pp_sl, $start, $stop){
	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_pp_sl = '$pp_sl' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'");
		if (mysqli_num_rows($result)==0)
		 { echo ""; }
		else{while($check2 = mysqli_fetch_array($result)) {
				  return $check2['sum']; }}

	}

function oldClear_bw_ref($con, $ref_id, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_due_tbl.PD_bal_paid !='0' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') NOT BETWEEN '".$start."' AND '".$stop."' AND patient_registration.pr_referred_id = '$ref_id'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}

	}


function totalReceived_registration_bw_ref($con, $ref_id, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND patient_registration.pr_referred_id = '$ref_id'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function total_reg_date($con, $start, $stop){
	$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE DATE_FORMAT(pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

	/*--------------payment index -----------------*/

function total_reg_date_wo_staff_self($con, $start, $stop){
	$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE DATE_FORMAT(pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND pr_source_id !='2' AND pr_source_id !='3'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function total_test_date_wo_staff_self($con, $start, $stop){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_test LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_test.PT_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND pr_source_id !='2' AND pr_source_id !='3'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function total_net_date_wo_staff_self($con, $start, $stop){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_net) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND pr_source_id !='2' AND pr_source_id !='3'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function curClear_date_wo_staff_self($con, $start_date, $stop_date){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_registration.pr_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND pr_source_id !='2' AND pr_source_id !='3'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function totalReceived_registration_date_wo_staff_self($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE DATE_FORMAT(patient_payment.PP_paid_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$stop_date."' AND pr_source_id !='2' AND pr_source_id !='3'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function oldClear_date_wo_staff_self($con, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no WHERE patient_due_tbl.PD_bal_paid !='0' AND DATE_FORMAT(patient_due_tbl.PD_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') NOT BETWEEN '".$start."' AND '".$stop."' AND pr_source_id !='2' AND pr_source_id !='3'");
  if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
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

function dues_paid_all_bw($con, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_date BETWEEN '".$start."' AND '".$stop."'");
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
	$result = mysqli_query($con, "SELECT source_abbre FROM source_tbl WHERE source_id = '$source_id'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['source_abbre'].'/';}}
	}




	/*------------------------- SUPER monthwise -------------------------------------------*/

	function registration_month_year($con, $month, $year){
$result = mysqli_query($con, "SELECT COUNT(pr_receipt_no) AS total FROM patient_registration WHERE MONTH(pr_date) = '$month' AND YEAR(pr_date) = '$year'");
  if (mysqli_num_rows($result)==0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}


function investigation_month_year($con, $month, $year){
	$result = mysqli_query($con, "SELECT COUNT(patient_test.PT_sl) AS total FROM patient_registration LEFT JOIN patient_test ON patient_test.PT_receipt_no = patient_registration.pr_receipt_no WHERE MONTH(patient_registration.pr_date) = '$month' AND YEAR(patient_registration.pr_date) = '$year'");
  if (mysqli_num_rows($result)==0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function bill_registration_month_year($con, $month, $year){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_total) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE MONTH(patient_registration.pr_date) = '$month' AND YEAR(patient_registration.pr_date) = '$year'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function tax_month_year($con, $month, $year){
	$total_tax = 0;
	$result = mysqli_query($con, "SELECT sum(y.PP_total * x.TX_value * 0.01) as tax FROM patient_registration r LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN tax_tbl x ON x.TX_receipt_no = r.pr_receipt_no WHERE MONTH(r.pr_date) ='$month' AND YEAR(r.pr_date) = '$year' AND y.PP_tax ='1'");
	  if (mysqli_num_rows($result)==0)
		 { $total_tax = 0; }
	   else{
		   while($row = mysqli_fetch_array($result))
			     $total_tax = $row['tax'];
		       }
	return $total_tax;
	}

function discount_month_year($con, $month, $year){
	$total_disc = 0.00;
	$result = mysqli_query($con, "SELECT d.disc_type, d.disc_value, d.disc_receipt_no, y.PP_tax, y.PP_total, x.TX_value FROM patient_registration r INNER JOIN discount_tbl d ON r.pr_receipt_no = d.disc_receipt_no INNER JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN tax_tbl x ON x.TX_receipt_no = r.pr_receipt_no WHERE MONTH(r.pr_date) = '$month' AND YEAR(r.pr_date) = '$year' AND y.PP_disc ='1'");
	  if (mysqli_num_rows($result)==0)
		 { $total_disc = 0.00; }
	   else{

		   while($row = mysqli_fetch_array($result)) {

				 $disc_type = $row['disc_type'];
			     $disc_value = $row['disc_value'];
				 $PP_tax = $row['PP_tax'];
				 $tax_value = $row['TX_value'];
				 $total = $row['PP_total'];
				 if($PP_tax =='1') {
				    //$tax_value = getTax($con, $receipt_no);
				    $PP_total =  $total + $total * ($tax_value/100); }
				 if($PP_tax =='2') {
				    $PP_total =  $total; }

				if($disc_type == '1'){$disc = ($disc_value/100)* $PP_total; $total_disc = $total_disc + $disc;}
		    elseif($disc_type == '2'){$total_disc =  $total_disc + $disc_value;}
		       }
	   }
	return $total_disc;
	}

function net_month_year($con, $month, $year){
$result = mysqli_query($con, "SELECT SUM(y.PP_net) AS sum FROM patient_registration r LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no WHERE MONTH(r.pr_date) = '$month' AND YEAR(r.pr_date) = '$year'");
	  if (mysqli_num_rows($result)==0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function curClear_month_year($con, $month, $year){
$result = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM patient_registration INNER JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN patient_due_tbl ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl WHERE MONTH(patient_registration.pr_date) = '$month' AND YEAR(patient_registration.pr_date) = '$year' AND MONTH(patient_due_tbl.PD_date) BETWEEN '$start_month' AND '$end_month' AND YEAR(patient_due_tbl.PD_date) = '$year'");
  if (mysqli_num_rows($result)==0)
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}

	}

function received_first_paid($con, $start_month, $end_month, $year){
	$result = mysqli_query($con, "SELECT SUM(patient_payment.PP_paid) AS sum FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no WHERE MONTH(patient_registration.pr_date) BETWEEN '$start_month' AND '$end_month' AND YEAR(patient_registration.pr_date) = '$year'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}
	}

function dues_paid_month_year($con, $start_month, $end_month, $year){

	$result = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE MONTH(PD_date) BETWEEN '$start_month' AND '$end_month' AND YEAR(PD_date) = '$year'");
  if (mysqli_num_rows($result)===0)
		 { return "0"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'];}}

	}


function expenditure_month_year($con, $start_month, $end_month, $year){
	$result = mysqli_query($con, "SELECT SUM(EX_amount) AS sum FROM expenditure WHERE MONTH(EX_date) BETWEEN '$start_month' AND '$end_month' AND YEAR(EX_date) ='$year'");
	  if (mysqli_num_rows($result)==0)
		 { echo ""; }
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

/*------------------------ DISCOUNT - ADMIN ------------------------*/
function countVersion($con){
	$result = mysqli_query($con, "SELECT COUNT(PV_id) AS total_version FROM price_version");
	 if (mysqli_num_rows($result)==0)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total_version'];}}
	}

function getTax($con, $receipt_no){
	$result = mysqli_query($con, "SELECT TX_value FROM tax_tbl WHERE TX_receipt_no = '$receipt_no'");
	 if (mysqli_num_rows($result)==0)
		 { return "0"; }
	 else{while($row = mysqli_fetch_array($result)) { $TX_value = $row['TX_value']; }
	       return $TX_value;
		 }
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




function checkBalance($con, $receipt_no){
	$result = mysqli_query($con, "SELECT PP_bal FROM patient_payment WHERE PP_receipt_no = '$receipt_no'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	 else{while($row = mysqli_fetch_array($result)) {return $row['PP_bal'];}}
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


/*-------------------- patient_registration_edit -----------------------*/

function showPaid_amount($con, $receipt_no){

	$result = mysqli_query($con, "SELECT p.PP_paid, SUM(d.PD_bal_paid) AS sum FROM patient_payment p LEFT JOIN patient_due_tbl d ON d.PD_pp_sl = p.PP_sl WHERE p.PP_receipt_no = '$receipt_no'");
  if (mysqli_num_rows($result)==0)
		 {return $row['PP_paid']; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['sum'] + $row['PP_paid'] ;} }

	}
/*---------------------- SUPER ADMIN ------------------------------*/
function doctorWise_registration($con, $dr_id, $start, $stop){
$result = mysqli_query($con, "SELECT COUNT(r.pr_dr_prescription) AS total FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE r.pr_dr_prescription ='$dr_id' AND  DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function sumNet_eachPerson($con, $ref, $start, $stop){
$result = mysqli_query($con, "SELECT SUM(y.PP_net) as bill FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE r.pr_dr_prescription ='$ref' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['bill'];}}
	}

function others_registration($con, $src, $ref, $start, $stop){

$result = mysqli_query($con, "SELECT COUNT(r.pr_receipt_no) AS total FROM patient_registration r INNER JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE r.pr_source_id ='$src' AND r.pr_referred_id ='$ref' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2'");
	 if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function sumNet_eachReferral($con, $src, $ref, $start, $stop){

$result = mysqli_query($con, "SELECT SUM(y.PP_net) as bill FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE r.pr_source_id ='$src' AND r.pr_referred_id ='$ref' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2'");
	if (mysqli_num_rows($result)==0)
		 { echo ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['bill'];}}
	}

function allTest_ED($con, $receipt_no){
	$result = mysqli_query($con, "SELECT PT_test_name FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	 while($row = mysqli_fetch_array($result))
		   {
			$name[] = $row['PT_test_name'];
		   }
	return implode(",&nbsp;", $name );
	}

function allTestSl_ED($con, $receipt_no){
	$result = mysqli_query($con, "SELECT PT_test_name FROM patient_test WHERE PT_receipt_no = '$receipt_no'");
	$sl=1;
	 while($row = mysqli_fetch_array($result))
		   {
			$name[] = $sl.') '.$row['PT_test_name'];
			$sl=$sl+1;
		   }
	return implode(",&nbsp;", $name );
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

/*------------------------ MT -----------------------------*/

function CountNoOfTemplate($con, $test_id){
	$result = mysqli_query($con, "SELECT COUNT(TPN_id) AS total FROM template_name WHERE TPN_test_id = '$test_id'");
  	if (mysqli_num_rows($result)==0)
		 { return 0; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['total'];}}
	}

function showTemplate_Name($con, $template_id){

	$result = mysqli_query($con, "SELECT TPN_name FROM template_name WHERE TPN_id = '$template_id'");
  	if (mysqli_num_rows($result)==0)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['TPN_name'];}}
	}

function showTest_using_template($con, $template_id){

	$result = mysqli_query($con, "SELECT test_tbl.test_name FROM template_name LEFT JOIN test_tbl ON test_tbl.test_id = template_name.TPN_test_id WHERE template_name.TPN_id = '$template_id'");
  	if (mysqli_num_rows($result)==0)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['test_name'];}}
	}

function getTest_id_using_template($con, $template_id){

	$result = mysqli_query($con, "SELECT test_tbl.test_id FROM template_name LEFT JOIN test_tbl ON test_tbl.test_id = template_name.TPN_test_id WHERE template_name.TPN_id = '$template_id'");
  	if (mysqli_num_rows($result)==0)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['test_id'];}}
	}

function showDept_using_template($con, $template_id){

	$result = mysqli_query($con, "SELECT department_tbl.department_id, department_tbl.department_name, test_category.test_category_name FROM test_tbl LEFT JOIN test_category ON test_category.test_category_id = test_tbl.test_category_id LEFT JOIN department_tbl ON department_tbl.department_id = test_category.TC_dept_id LEFT JOIN template_name ON test_tbl.test_id = template_name.TPN_test_id WHERE template_name.TPN_id ='$template_id'");
	 while($row = mysqli_fetch_array($result))
		   {
			 $id = $row['department_id'];
			 $category = $row['test_category_name'];
			 $department = $row['department_name'];
		   }
		   if($id == 5)
		   {return "Dept : ".$department.", Category : ".$category;}
			else{return"Dept: ".$department;}
	}


function showData_rowColumn($con, $template_id, $row_no, $column_no){

	$result = mysqli_query($con, "SELECT TPB_name FROM template_body WHERE TPB_tpn_id = '$template_id' AND TPB_row = '$row_no' AND TPB_column = '$column_no'");
  	if (mysqli_num_rows($result)==0)
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['TPB_name'];}}

	}

function get_long_month($con, $month_int)
	{
	if ($month_int =="1") return 'January';
	if ($month_int =="2") return 'February';
	if ($month_int =="3") return 'March';
	if ($month_int =="4") return 'April';
	if ($month_int =="5") return 'May';
	if ($month_int =="6") return 'June';
	if ($month_int =="7") return 'July';
	if ($month_int =="8") return 'August';
	if ($month_int =="9") return 'September';
	if ($month_int =="10") return 'October';
	if ($month_int =="11") return 'November';
	if ($month_int =="12") return 'December';
	}


	//----------- TRACE ACTION -----------
	function addTrace_action($con, $table_id, $action_id, $prm_id, $remark, $user_id){
	resetCounter($con, 42, 'dd');
	$TT_id = date("ynj").getCounter($con, 42);

	mysqli_query($con, "INSERT INTO trace_action(TA_id, TA_table, TA_action, TA_p_id, TA_remark, TA_user, TA_date) VALUES ('$TT_id', '$table_id', '$action_id', '$prm_id', '".$remark."', '$user_id', NOW())");
	updateCounter($con, 42);
	}



?>
