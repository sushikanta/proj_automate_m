<?php require_once("check_login_fd.php");
 resetCounter($con, 1, 'dd');    // PI_id (patient_info)
 resetCounter($con, 13, 'dd');   // patient_transaction
 resetCounter($con, 14, 'dd');   // receipt_no (patient_registration)
 resetCounter($con, 16, 'dd');	// PT_sl (patient_test)
 resetCounter($con, 24, 'dd');   // PP_sl (patient_payment)
 resetCounter($con, 34, 'dd');	// patient_history
 resetCounter($con, 35, 'dd');	// lab_note
 //resetCounter($con, 36, 'dd');	// Patient_test_path
 resetCounter($con, 37, 'dd');	// tax_tbl
 resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)
 $receipt_no_only = date("jmy").getCounter($con, 14);
?>
<!DOCTYPE html>
<html>
<head>
  <title>New Registration</title>
  <?php require_once("css_bootstrap_header.php"); ?>
</head>

<?php
	if(isset($_GET['submit'])){



		  $tr_id = date("jmy").getCounter($con, 13);

		  $receipt_no = date("jmy").getCounter($con, 14);
		  $patient_id = date("jmy").getCounter($con, 1);
		  $pp_sl = date("jmy").getCounter($con, 24);
		  $history_id = date("jmy").getCounter($con, 34);
		  $lab_id = date("jmy").getCounter($con, 35);

		  $marital_status_id = $_GET['marital_status'];

   		if($marital_status_id =='1' || $marital_status_id =='2' || $marital_status_id =='3' || $marital_status_id =='4' || $marital_status_id =='5'){
		   $patient_age_y = mysqli_real_escape_string($con, $_GET['patient_age_y']);
		   $patient_age_m = '0';
		   $patient_age_d = '0';
	       }
		if($marital_status_id =='6'){
				$patient_age_y = mysqli_real_escape_string($con, $_GET['patient_age_y']);
				$patient_age_m = mysqli_real_escape_string($con, $_GET['patient_age_m']);
				$patient_age_d = mysqli_real_escape_string($con, $_GET['patient_age_d']);
			   }
		if($marital_status_id =='7'){
				$patient_age_y = '0';
				$patient_age_m = mysqli_real_escape_string($con, $_GET['patient_age_m']);
				$patient_age_d = mysqli_real_escape_string($con, $_GET['patient_age_d']);
	         }

		  $patient_name = ucwords(mysqli_real_escape_string($con, $_GET['patient_name']));
		  $patient_gender = $_GET['patient_sex'];
          $patient_address = ucwords(mysqli_real_escape_string($con, $_GET['patient_address']));
		  $state_id = mysqli_real_escape_string($con, $_GET['hidden_state']);
		  $district_id = mysqli_real_escape_string($con, $_GET['hidden_district']);
		  $pin_id = $_GET['patient_pin'];
		  $patient_phone = mysqli_real_escape_string($con, $_GET['patient_phone']);

		  $patient_history = mysqli_real_escape_string($con, $_GET['patient_history']);
		  $lab_note = mysqli_real_escape_string($con, $_GET['lab_note']);
		  $user_id=$_SESSION['user_id'];

		  $src_type = $_GET['src_type'];

		  if($src_type == 'W'){$source_id = '3'; $referred_id = '0';}
		  else{
		  $source_id = $_GET['hidden_source_id'];
		  $referred_id = $_GET['hidden_referred_by'];
		  }

		  $dr_presc = $_GET['dr_letter'];
		  if($dr_presc == 'Y') { $dr_letter = $_GET['hidden_dr_id'];}
		  if($dr_presc == 'N') { $dr_letter = "NO"; }

	  $total_amt = $_GET['total_amt'];
	  $tax_radio = $_GET['tax_radio'];
	  if($tax_radio =='1'){$tax = $_GET['tax'];}
	  $net_amount = $_GET['net_amount'];
	  $paid_amount = mysqli_real_escape_string($con, $_GET['paid_amount']);
	  $due_amount = $_GET['due_amount'];

 	/*------------ START - TRANSACTION  ---------*/
	mysqli_autocommit($con, false);
	$flag = true;

	/*------------4) INSERT patient_info -----------------*/
	 mysqli_query($con, "INSERT INTO patient_info(PI_id, PI_name, PI_age_y, PI_age_m, PI_age_d, PI_gender, PI_marital_id, PI_address, PI_state_id, PI_district_id, PI_pin, PI_phone, PI_date, PI_card, PI_user) VALUES ('$patient_id', '".$patient_name."', '.$patient_age_y.', '.$patient_age_m.', '.$patient_age_d.', '.$patient_gender.', '$marital_status_id', '".$patient_address."', '$state_id', '$district_id', '".$pin_id."', '".$patient_phone."', NOW(), '2', '$user_id')");
	   if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_info insert ! ";}
	    else updateCounter($con, 1);

	/*------------5) INSERT patient_registration  ---------------*/
	 mysqli_query($con, "INSERT INTO patient_registration(pr_receipt_no, pr_patient_id, pr_dr_prescription, pr_status_id, pr_source_id, pr_referred_id, pr_date) VALUES ('$receipt_no','$patient_id', '".$dr_letter."', '1', '$source_id', '$referred_id', NOW())");
	 if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_registration insert ! ";}
	    else updateCounter($con, 14);

    // INSERT Patient History --------------*/
	if($patient_history !=''){
	  mysqli_query($con, "INSERT INTO patient_history(PH_id, PH_patient_id, PH_history) VALUES ('$history_id', '$patient_id', '".$patient_history."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in History insert !";}
	    else updateCounter($con, 34);
	}

/*------------7) INSERT Lab Note -----------------*/
	if($lab_note !=''){
	  mysqli_query($con, "INSERT INTO lab_note(LB_id, LB_receipt_no, LB_note, LB_date, LB_user) VALUES ('$lab_id', '$receipt_no', '".$lab_note."', NOW(), '$user_id')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in Lab note insert ! ";}
	    else updateCounter($con, 35);
	}

 // INSERT tax --------------*/
	if($tax_radio =='1'){

	  $tx_id = date("jmy").getCounter($con, 37);
	  mysqli_query($con, "INSERT INTO tax_tbl(TX_id, TX_receipt_no, TX_value) VALUES ('$tx_id', '$receipt_no', '".$tax."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in History insert !";}
	    else updateCounter($con, 37);
	}


  if(isset($_GET['test_name']))
	  {
		$test_name = $_GET['test_name'];
		$test_id = $_GET['test_id'];
		$dept_id = $_GET['dept_id'];
		$test_price = $_GET['test_price'];
		$status_id =1;
		$num = count($test_name);
	for($i=0; $i<$num; $i++)
	    {
		 // $ptp_id = date("ynj").getCounter($con, 36);
		  $PT_sl = date("ymj").getCounter($con, 16);
		  $test_id_x = $test_id[$i];
		  $dept_id_x = $dept_id[$i];
		  $test_name_x = mysqli_real_escape_string($con, $test_name[$i]);
		  $test_price_x = $test_price[$i];

		  // 2. Patient_test
		  mysqli_query($con, "INSERT INTO patient_test(PT_sl, PT_receipt_no, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id) VALUES ('$PT_sl', '$receipt_no', '$test_id_x', '".$test_name_x."', '".$test_price_x."', '$dept_id_x', '$status_id')");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in INSERT Patient_test";}
		     else updateCounter($con, 16);
	    }
	  }

	   /*--------- 3) INSERT patient_payment ----------*/
	  mysqli_query($con, "INSERT INTO patient_payment(PP_sl, PP_receipt_no, PP_total, PP_tax, PP_disc, PP_net, PP_paid, PP_date, PP_bal) VALUES ('$pp_sl', '$receipt_no', '".$total_amt."','.$tax_radio.', '2','".$net_amount."','".$paid_amount."', NOW(), '".$due_amount."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_payment insert !";}
	    else updateCounter($con, 24);

	  /*--------- 8) INSERT patient_transaction ----------*/
	  mysqli_query($con, "INSERT INTO patient_transaction(TR_id, TR_pp_sl, TR_amount, TR_date, TR_user) VALUES ('$tr_id', '$pp_sl', '".$paid_amount."', NOW(), '$user_id')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_transaction insert !";}
	    else updateCounter($con, 13);

/****************************
audit_record
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile

 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status
 ******************************/
 $A_id = date("jmy").getCounter($con, 42);
 $remark = 'Registration ID : '.$receipt_no.', Received Rs. : '.$paid_amount;
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '22', '$receipt_no', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

  if($flag){
			mysqli_commit($con);
			header("LOCATION: patient_receipt.php?receipt_no=$receipt_no");
			} else {
			mysqli_rollback($con);
			echo "! "; http_response_code(404);
			}
} // END SUBMIT IF
?>
<body>
<?php require_once("right_top_header.php"); ?>

  <!-- loading.. -->

 <div class="container">
 <div class="page-content">

 <!-- start loading..-->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
 <div class="inv-main" id="div_main">

  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="patient_registration">

  <!-- PANEL 1 -->
  <div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Patient Info <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>

     <!-- ERROR VALIDATION -->
    <div class="row error err pull-right" style="display:none; margin-right:34%; color:red; font-size:13px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error" class="span-error"></span><br clear="all">
      </div>
   </h3>
   </div>

   <!--  ROW 1 -->
   <div class="panel-body">

    <div class="form-group" style="padding-top:10px;">
    <div class="form-control-group">
    <label for="reg_id" class="col-lg-2 control-label">Reg. ID : </label>
    <div class="col-lg-3">
    <input type="text" class="form-control" value="<?php echo $receipt_no_only;?>" name="receipt_no" readonly>
    </div>
    </div>
    <div class="form-control-group">
    <label for="current_date" class="col-lg-2 control-label">Date</label>
    <div class="col-lg-3"><span class="form-control" id="long_date_time"></span></div>
    </div>
    </div>

  <!-- ROW 2 -->
  <div class="form-group">
  <div class="form-control-group" style="line-height: 1.997779;">
  <label for="src_type" class="col-lg-2 control-label"> Source </label>
  <div class="col-lg-5">
  <label for="src_walkin" class="radio-inline col-lg-1" style="padding-right:40px;">
  <input  type="radio"class="form-control" name="src_type" id="src_walkin" value='W' checked>Walkin
  </label>
  <label for="src_others" class="radio-inline col-lg-1" style="padding-right:30px;">
  <input  type="radio"class="form-control" name="src_type" id="src_others" value='S'>Staff
  </label>
  <label for="src_staff" class="radio-inline col-lg-1">
  <input type="radio" class="form-control" name="src_type" id="src_staff" value='O'>Others
  </label>
  </div>
  </div>
  <div class="form-control-group" id="div_refBy">
  <div class="col-lg-3">
  <input type="text" class="form-control" name="referred_by" placeholder="Search & Select source Person" id="referred_by">
  <input type="hidden" name="hidden_referred_by" id="hidden_referred_by">
  <input type="hidden" name="hidden_source_id" id="hidden_source_id">
  </div>
  </div>
  </div>
        <!------- ROW 3 ------>
        <div class="form-group">
        <div class="form-control-group" style="line-height: 1.997779;">
        <label for="dr_letter" class="col-lg-2 control-label"> Dr. Ref ?</label>
        <div class="col-lg-3">
        <label for="dr_letter_yes" class="radio-inline col-lg-1" style="padding-right:40px;">
        <input  type="radio"class="form-control" name="dr_letter" id="dr_letter_yes" value='Y' checked>Yes
        </label>
        <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-right:30px;">
        <input type="radio" class="form-control" name="dr_letter" id="dr_letter_no" value='N'>No
        </label>
        </div>
        </div>

        <div class="form-control-group" id="div_dr_name">
        <label for="dr_name" class="col-lg-2 control-label" id="label_dr_name">Dr. Name</label>
        <div class="col-lg-3" >
        <input type="text" class="form-control" name="dr_name" placeholder="Search Dr. name only" id="dr_name">
        <input type="hidden" name="hidden_dr_id" id="hidden_dr_id">
        </div>
        </div>
        </div>

    <!------- ROW 4 ------>
  	 <div class="form-group">
     <div class="form-control-group">
      <label for="patient_name" class="col-lg-2 control-label">Patient Name</label>
      <div class="col-lg-3">
       <input type="text" class="form-control capital" id="patient_name" placeholder="Patient name" name="patient_name" maxlength="50">
      </div>
      </div>
      <div class="form-control-group">
      <label for="patient_phone" class="col-lg-2 control-label">Phone</label>
      <div class="col-lg-3">
         <input type="text" class="form-control" id="patient_phone" placeholder="Phone no." name="patient_phone" maxlength="10">
      </div>
      </div>
      </div>

       <div class="form-group">
       <div class="form-control-group" style="line-height: 1.997779;">
        <label for="dr_letter" class="col-lg-2 control-label"> Gender</label>
        <div class="col-lg-2">
        <label for="optionsRadios1" class="radio-inline col-lg-1" style="padding-right:40px;">
        <input  type="radio"class="form-control" name="patient_sex" id="optionsRadios1" value='1'>Male
        </label>
        <label for="optionsRadios2" class="radio-inline col-lg-1" style="padding-right:30px;">
        <input type="radio" class="form-control" name="patient_sex" id="optionsRadios2" value='2'>Female
        </label>
        </div>
        </div>

      <!------- ROW 5 ------>
      <div class="form-control-group">
      <label for="marital_status" class="col-lg-1 control-label">Marital</label>
      <div class="col-lg-2">
      <select class="form-control" name="marital_status" id="marital_status">
      <option value="" class="option_select">Select</option>
      <?php
      $result=mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl");
      while($row=mysqli_fetch_array($result))
      { ?>
      <option value="<?php echo $row['marital_id'];?>" class="option_select"><?php echo $row['marital_name'];?></option>
      <?php } ?>
      </select>
      </div>
      </div>

      <div id="div_age_y" class="form-control-group">
      <label for="patient_age_y" class="col-lg-1-1 control-label" id="label_age_y">YY</label>
      <div class="col-lg-1-2">
      <input type="text" class="form-control" id="patient_age_y" placeholder="YY" name="patient_age_y" maxlength="3">
      </div>
      </div>

      <div id="div_age_m" class="form-control-group">
      <label for="patient_age_m" class="col-lg-1-1 control-label" id="label_age_m">MM</label>
      <div class="col-lg-1-2">
      <input type="text" class="form-control" id="patient_age_m" placeholder="MM" name="patient_age_m" maxlength="3">
      </div>
      </div>

      <div id="div_age_d" class="form-control-group">
      <label for="patient_age_d" class="col-lg-1-1 control-label" id="label_age_d">DD</label>
      <div class="col-lg-1-2">
      <input type="text" class="form-control" id="patient_age_d" placeholder="DD" name="patient_age_d" maxlength="3">
      </div>
      </div>
      </div>

       <!------- ROW 6 ------>
      <div class="form-group">
      <div class="form-control-group">
      <label for="patient_address" class="col-lg-2 control-label">Address</label>
      <div class="col-lg-3">
      <input type="text" class="form-control capital" id="patient_address" placeholder="Patient Address" name="patient_address" maxlength="100">
      </div>
      </div>
      <div class="form-control-group">
      <label for="state" class="col-lg-2 control-label"> State </label>
      <div class="col-lg-3" id="div_state">
      <input type="text" class="form-control capital" id="state" placeholder="Search state" name="state" value="Manipur" maxlength="50">
      <input type="hidden" class="form-control" id="hidden_state" name="hidden_state" value="1">
      </div>
      </div>
      </div>

    <!------- ROW 7 ------>
    <div class="form-group">
    <div class="form-control-group">
    <label for="district" class="col-lg-2 control-label" id="label_state_district">District</label>
    <div class="col-lg-3" id="div_district">
    <input type="text" class="form-control capital" id="district" placeholder="Search district" name="district" maxlength="50">
    <input type="hidden" class="form-control" id="hidden_district" name="hidden_district">
    </div>
    </div>
    <div class="form-control-group">
    <label for="patient_pin" class="col-lg-2 control-label" id="label_patient_pin">PIN</label>
    <div class="col-lg-3">
    <input type="text" class="form-control" id="patient_pin" placeholder="PIN Code - Optional" name="patient_pin" maxlength="6">
    </div>
    </div>
    </div>

  <!------- ROW 8 ------>
  <div class="form-group">
  <div class="form-control-group">
  <label for="patient_history" class="col-lg-2 control-label">Patient History</label>
  <div class="col-lg-3">
  <textarea class="form-control textBox_height" name="patient_history" id="patient_history" placeholder="Optional (max.300 characters)" maxlength="300"></textarea>
  </div>
  </div>
  <div class="form-control-group">
  <label for="lab_note" class="col-lg-2 control-label" id="label_referred_by">Lab Note</label>
  <div class="col-lg-3">
  <textarea class="form-control textBox_height" id="lab_note" name="lab_note" placeholder="Optional (max.300 chars)" maxlength="300"></textarea>
  </div>
  </div>
  </div>

    </div>
  </div> <!--------- END PANEL 1 ---------->

 <!----------- PANEL 2 - Investigation ---------->
 <div class="panel panel-success" id="test_div">
   <div class="panel-heading light_purple_color">
   <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp; Investigation </h3>
   </div>
   <div class="row">
   <label for="ext_1" class="col-lg-1"></label>
   <label for="ext_2" class="col-lg-1">SL</label>
   <label for="ext_3" class="col-lg-4">Investigation Name</label>
   <label for="ext_4" class="col-lg-2"></label>
   <label for="ext_5" class="col-lg-2 text-center">Price</label>
   </div>

      <div class="form-group clonedInput" id="entry1">
      <label for="ext_6" class="col-lg-1"></label>
      <label id="sl_no1" name="sl_no" class="col-lg-1 sl_no">1.</label>

      <div class="form-control-group">
      <div class="col-lg-5">
      <input type="text" class="form-control test_name" id="test_name" placeholder="Search & Select Investigation" name="test_name[]" required>
      <input type="hidden" class="form-control test_id" id="hidden_test_id" name="test_id[]">
      <input type="hidden" class="form-control dept_id" id="hidden_dept_id" name="dept_id[]">
      </div>
      </div>

    <div class="form-control-group">
    <label for="test_price" class="col-lg-1 control-label label_test_price"></label>
    <div class="col-lg-2" id="price_div">
    <input type="text" class="form-control text-right test_price" style="padding-right:36%;" id="test_price" placeholder="Rs." name="test_price[]" required readonly>
    </div>
    </div>
    </div>

    <div class="form-group">
    <label id="reference" name="reference" class="col-lg-1-3"></label>
    <div id="addDelButtons">
    <input type="button" id="btnAdd" class="btn btn-mini btn-primary addIcon">&nbsp;
    <input type="button" id="btnDel" class="btn btn-mini btn-danger deleteIcon">
    </div>
    </div>
  </div>  <!-------- END PANEL 2 --------->

    <!----------- PANEL 3 - PAYMENT------------>
    <div class="panel panel-success">
        <div class="panel-heading light_purple_color">
        <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp; Payment </h3>
        </div>

      <div class="form-group">
      <div class="form-control-group">
      <label for="total_amt" class="col-lg-2 control-label">Total Amount</label>
      <div class="col-lg-2">
      <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly>
      </div>
      </div>

      <div class="form-control-group">
      <label for="service_tax" class="col-lg-1-5 control-label">Service Tax</label>
      <div class="col-lg-2-1">
      <label for="tax_no" class="radio-inline col-lg-1" style="margin-left:15px;">
      <input type="radio" class="form-control" name="tax_radio" id="tax_no" value="2" checked>No
      </label>
      <label for="tax_yes" class="radio-inline col-lg-1"style="padding-left:30px;">
      <input type="radio" class="form-control" name="tax_radio" id="tax_yes" value="1">Yes
      </label>
      </div>
      </div>

      <div class="form-control-group">
      <label for="tax" class="col-lg-1-3 control-label" id="label_tax"  style="margin-left:12px;">Tax (%)</label>
      <div class=" form-inline col-lg-2-1" id="div_tax">
      <input type="text" class="form-control" id="tax" name="tax" placeholder="12" value="12" maxlength="8">
      </div>
      </div>
      </div>

        <div class="form-group">
        <div class="form-control-group">
        <label for="net_amount" class="col-lg-2 control-label">Net Amount</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="net_amount" name="net_amount" placeholder="Rs." readonly>
        </div>
        </div>

        <div class="form-control-group">
        <label for="paid_amount" class="col-lg-1-4 control-label">Paid Amount</label>
        <div class="col-lg-2-1">
        <input type="text" class="form-control paid_amount" id="paid_amount" name="paid_amount" placeholder="Rs." maxlength="10">
        </div>
        </div>

        <div class="form-control-group">
        <label for="due_amount" class="col-lg-1-4 control-label">Due Amount</label>
        <div class="col-lg-2-1">
        <input type="text" class="form-control" id="due_amount" name="due_amount"placeholder="Rs." readonly>
        </div>
        </div>
        </div>
 </div> <!-------- PANEL 3------------>

    <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="patient_submit" name="submit">Submit</button>
    </div>
    </div>
</form>
 </div>
 </div>

<div class="clear"></div>
</div>
<?php require_once("footer.php");?>
<?php require_once("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>
<script src="js/patient_registration.js" type="text/javascript"></script>
</body>
</html>
<?php ob_flush();?>
