<?php require_once("check_login_admin.php");
	   resetCounter($con, 12, 'dd');	 // discount
	   resetCounter($con, 13, 'dd');    // patient_transaction
	   resetCounter($con, 14, 'dd');    // receipt_no (patient_registration)
	   resetCounter($con, 16, 'dd');	 // PT_sl (patient_test)
	   resetCounter($con, 24, 'dd');    // PP_sl (patient_payment)

	   resetCounter($con, 34, 'dd');	 // patient_history
	   resetCounter($con, 35, 'dd');	 // lab_note
	   resetCounter($con, 36, 'dd');	 // Patient_test_path
	   resetCounter($con, 37, 'dd');	 // tax_tbl
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration for Card Holder</title>
  <?php require_once("css_bootstrap_header.php"); ?>
</head>
<?php
		if(isset($_GET['submit'])){

		  $receipt_no = date("ynj").getCounter($con, 14);
		  $pp_sl = date("ynj").getCounter($con, 24);
		  $tr_id = date("ynj").getCounter($con, 13);

		  $patient_id = $_GET['patient_id'];
		  $pi_card = $_GET['pi_card'];
		  $patient_history=$_GET['patient_history'];
		  $lab_note=$_GET['lab_note'];

		  $user_id=$_SESSION['user_id'];

		  $src_type = $_GET['src_type'];
		  if($src_type == 'W'){
			  $source_id = '3';
			  $referred_id = '0';
			}
		  else{
		  	  $source_id = $_GET['hidden_source_id'];
		  	  $referred_id = $_GET['hidden_referred_by'];
		  }

	  $total_amt = $_GET['total_amt'];
	  $tax_radio = $_GET['tax_radio'];
	  if($tax_radio =='1'){$tax = $_GET['tax'];}
	  if($tax_radio =='2'){$tax = 0;}

	  $disc_option = $pi_card;
      $disc_per = $_GET['disc_per'];
	  $net_amount = $_GET['net_amount'];
	  $paid_amount = $_GET['paid_amount'];
	  $due_amount = $_GET['due_amount'];

		$dr_presc = $_GET['dr_letter'];
		  if($dr_presc == 'Y') { $dr_letter = $_GET['hidden_dr_id'];}	//if dr_letter = Yes, strore dr_id from autocomplete
		  if($dr_presc == 'N') { $dr_letter = "NO"; }					//dif dr_letter = NO, then store NO


/*-------------- START - TRANSACTION/ROLLBACK  ----------*/
mysqli_autocommit($con, false);
$flag = true;

   // 1) INSERT patient_registration
	 mysqli_query($con, "INSERT INTO patient_registration(pr_receipt_no, pr_patient_id, pr_dr_prescription, pr_status_id, pr_source_id, pr_referred_id, pr_date) VALUES ('$receipt_no','$patient_id', '".$dr_letter."', '1', '$source_id', '$referred_id', NOW())");
	 if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_registration insert ! ";}
	    else updateCounter($con, 14);

    // 2) INSERT Patient History
	if($patient_history !=''){
	  $history_id = date("ynj").getCounter($con, 34);
	  mysqli_query($con, "INSERT INTO patient_history(PH_id, PH_patient_id, PH_history) VALUES ('$history_id', '$patient_id', '".$patient_history."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in History insert !";}
	    else updateCounter($con, 34);
	  }

	// 3) INSERT Lab Note
	if($lab_note !=''){
	  $lab_id = date("ynj").getCounter($con, 35);
	  mysqli_query($con, "INSERT INTO lab_note(LB_id, LB_receipt_no, LB_note, LB_date, LB_user) VALUES ('$lab_id', '$receipt_no', '".$lab_note."', NOW(), '$user_id')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in Lab note insert ! ";}
	    else updateCounter($con, 35);
	}

 	// 4) INSERT tax
	if($tax_radio =='1' && $tax > 0){
	   $tx_id = date("ynj").getCounter($con, 37);
	   mysqli_query($con, "INSERT INTO tax_tbl(TX_id, TX_receipt_no, TX_value) VALUES ('$tx_id', '$receipt_no', '".$tax."')");
	   if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error in History insert !";}
	    else updateCounter($con, 37);
	}


  if(isset($_GET['test_name']) && $_GET['test_name'] !="")
	  {
		$test_name = $_GET['test_name'];
		$test_id = $_GET['test_id'];
		$dept_id = $_GET['dept_id'];
		$test_price = $_GET['test_price'];
		$status_id = 1;
		$action =22;
		$remark ="Investigation";
		$num = count($test_name);

	for($i=0; $i<$num; $i++)
	    {
		  $ptp_id = date("ynj").getCounter($con, 36);
		  $PT_sl = date("ynj").getCounter($con, 16);

		  $test_id_x = $test_id[$i];
		  $dept_id_x = $dept_id[$i];
		  $test_name_x = mysqli_real_escape_string($con, $test_name[$i]);
		  $test_price_x = $test_price[$i];

		   // 5) Patient_test- INSERT
		  mysqli_query($con, "INSERT INTO patient_test(PT_sl, PT_receipt_no, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id) VALUES ('$PT_sl', '$receipt_no', '$test_id_x', '".$test_name_x."', '".$test_price_x."', '$dept_id_x', '$status_id')");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in INSERT Patient_test";}
		     else updateCounter($con, 16);

		 // 6). Patient_test_path - INSERT
		 mysqli_query($con, "INSERT INTO patient_test_path(PTP_id, PTP_pt_sl, PTP_action, PTP_remark, PTP_user, PTP_date) VALUES ('$ptp_id', '$PT_sl', '$action', '".$remark."', '$user_id', NOW())");
		 if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in INSERT Test_Trace";}
		     else updateCounter($con, 36);
	    }
	  }

	 // 7) INSERT patient_payment
	   mysqli_query($con, "INSERT INTO patient_payment(PP_sl, PP_receipt_no, PP_total, PP_tax, PP_disc, PP_net, PP_paid, PP_date, PP_bal) VALUES ('$pp_sl', '$receipt_no', '".$total_amt."','$tax_radio', '$disc_option','".$net_amount."','".$paid_amount."', NOW(), '".$due_amount."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_payment insert !";}
	    else updateCounter($con, 24);

	 // 8) INSERT discount_tbl
	  if($pi_card =='1' && $disc_per > 0){

	   $disc_id = date("ynj").getCounter($con, 12);
	   mysqli_query($con, "INSERT INTO `discount_tbl`(`disc_code_sl`, `disc_receipt_no`, `disc_type`, `disc_value`, `disc_remark`, `disc_user`, `disc_status_date`) VALUES ('$disc_id', '$receipt_no', '1', '".$disc_per."', 'Card Holder', '$user_id', NOW())");
   		if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	    else updateCounter($con, 12);
	  }

		// 9) INSERT patient_transaction
	  mysqli_query($con, "INSERT INTO patient_transaction(TR_id, TR_pp_sl, TR_amount, TR_date, TR_user) VALUES ('$tr_id', '$pp_sl', '".$paid_amount."', NOW(), '$user_id')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_transaction insert !";}
	    else updateCounter($con, 13);

  if($flag){
			mysqli_commit($con);
			//echo 'Done';
			header("LOCATION: patient_receipt.php?receipt_no=$receipt_no");
			} else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			}
}  // end -submit)
?>

<body>
<?php require_once("right_top_header_popup.php"); ?>
<div class="container">
<!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
 <div class="page-content" id="div_main">

<?php
if(isset($_GET['patient_id']) && $_GET['patient_id'] !="")
{
	$patient_id_x = $_GET['patient_id'];
	$patient_info = mysqli_query($con, "SELECT p.PI_name, P.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_marital_id, p.PI_address, p.PI_pin, p.PI_phone, p.PI_card, p.PI_name, p.PI_date, d.district_name, s.state_name, g.gender_name, m.marital_name, h.DH_id, h.DH_disc_per FROM patient_info p LEFT JOIN card_holder h ON h.DH_patient_id = p.PI_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id WHERE p.PI_id = '$patient_id_x'");

  while($row = mysqli_fetch_array($patient_info))
  {
	  $name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];
  	  $gender = $row['gender_name'];
	  $marital = $row['marital_name'];
	  $address = $row['PI_address'];
	  $pin = $row['PI_pin'];
	  $phone = $row['PI_phone'];
	  $PI_card = $row['PI_card'];
	  $PI_date = $row['PI_date'];

  	  $state = $row['state_name'];
	  $district = $row['district_name'];

	  $DH_id = $row['DH_id'];
	  $disc_per = $row['DH_disc_per'];
	  }
 ?>

<div class="inv-main">

  <div class="panel panel-success">
     <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Patient Profile <span class="panel_subTitle no-print"> ( Customer Information )</span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span>
 <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i> Back</a>
    </span>
    </h3>
    </div>

  <!------------------- Panel 1---------------------->
  <div class="panel-body">

    <!---------------- ROW 1 ---------------->
    <div class="row">
      <div class="form-control-group">
      <label for="inputName" class="col-lg-3 control-label text-right"> Customer ID :</label>
      <div class="col-lg-3">
      <span class="input-xlarge uneditable-input text-control"><?php echo $patient_id_x;?></span>
      </div>
      </div>

        <div class="form-control-group">
        <label for="inputSex" class="col-lg-1 control-label text-right">DATE : </label>
        <div class="col-lg-2">
        <span class="input-xlarge uneditable-input text-control">  <?php echo date("jS, F Y", strtotime($PI_date));?></span>
        </div>
        </div>
     </div>

    <!---------------- ROW 2 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Name :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo $name;?></span>
        </div>
        </div>

     	  <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">
		  <?php echo $gender.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ('.$marital.')';?>
          </span>
          </div>
          </div>
     </div>

   <!---------------- ROW 3 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Address :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control">
		<?php echo $address.'<br/>'.$district.', '.$state;?> <?php if($pin != ""){echo " - ".$pin;} ?></span>
        </div>
        </div>

          <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right"><i class="fa fa-phone"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  +91 <?php echo $phone;?></span>
          </div>
          </div>
     </div>

     <!---------------- ROW 4 ---------------->
     <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Type :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control">
		<?php
		if($PI_card ==1){$card_status = 'Active';}
		if($PI_card ==2){$card_status = 'Disabled';}

		if($DH_id !=""){
		   echo "Card Holder"; ?>
		  <span class='panel-subTitle'> ( Card No.# <?php echo $DH_id.' - '.$card_status; ?> ) </span>
          <?php
		 }
		  else
			{ echo "Normal Patient";}
		?>
        </span>
        </div>
        </div>

          <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right">Discount :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control" style="color: #F00;">
		  <?php
		  		if($DH_id !="")
				{ echo $disc_per.'% ( '.$card_status.' )';}else{echo 'No disc';}
			?>
          </span>
          </div>
          </div>
      </div>

    </div>
    </div>

  <!----------- PANEL 2 -------------->
  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="patient_registration">
  <div class="panel panel-success ">

  <div class="panel-heading light_purple_color">
  <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Registration <span class="panel-subTitle">( Source, Referred by )</span></h3>
  </div>

  <div class="panel-body">
 <!----------- ROW 1-------------->
  <div class="form-group">

         <div class="form-control-group">
        <label for="reg_id" class="col-lg-2 control-label">Reg. ID</label>
        <div class="col-lg-3">
        <input type="text" class="form-control" name="receipt_no" value="<?php echo 'ED/'.date("ynj").getCounter($con, 14);?>" readonly>
        <input type="hidden"  name="pi_card" value="<?php echo $PI_card;?>">
        <input type="hidden"  name="patient_id" value="<?php echo $patient_id_x;?>">
        </div>
        </div>

          <div class="form-control-group">
          <label for="current_date" class="col-lg-2 control-label">Date</label>
           <div class="col-lg-3"><span class="form-control" id="long_date_time"></span></div>
          </div>
          </div>
    </div> <!----------- END ROW 1-------------->

    <div class="form-group">
        <div class="form-control-group" style="line-height: 1.997779;">
            <label for="src_type" class="col-lg-2 control-label"> Source </label>
            <div class="col-lg-3">
            <label for="src_walkin" class="radio-inline col-lg-1" style="padding-right:40px; padding-left:50px;">
            <input  type="radio"class="form-control" name="src_type" id="src_walkin" value='W' checked>Walkin
            </label>
            <label for="src_others" class="radio-inline col-lg-1" style="padding-right:40px; padding-left:40px;">
            <input  type="radio"class="form-control" name="src_type" id="src_others" value='S'>Staff
            </label>
            <label for="src_staff" class="radio-inline col-lg-1" style="padding-right:40px;">
            <input type="radio" class="form-control" name="src_type" id="src_staff" value='O'>Others
            </label>
            </div>
         </div>

         <div class="form-control-group" id="div_refBy">
          <label for="dr_letter" class="col-lg-2 control-label"> Name </label>
            <div class="col-lg-3">
            <input type="text" class="form-control" name="referred_by" placeholder="Search & Select source Person" id="referred_by">
            <input type="hidden" name="hidden_referred_by" id="hidden_referred_by">
            <input type="hidden" name="hidden_source_id" id="hidden_source_id">
            </div>
         </div>
         </div>

        <!----------- ROW 2-------------->
         <div class="form-group">
         <div class="form-control-group" style="line-height: 1.997779;">
            <label for="dr_letter" class="col-lg-2 control-label"> Dr.Letter </label>
            <div class="col-lg-3">
            <label for="dr_letter_yes" class="radio-inline col-lg-1" style="padding-right:40px; padding-left:50px;">
            <input  type="radio"class="form-control" name="dr_letter" id="dr_letter_yes" value='Y' checked>Yes
            </label>
            <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-left:40px;">
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
    </div><!---- end ROW 2-------------->

   <!----------- ROW 3-------------->
   <div class="form-group">
          <div class="form-control-group">
           <label for="patient_history" class="col-lg-2 control-label">Patient History</label>
          <div class="col-lg-3">
           <textarea class="form-control textBox_height" name="patient_history" id="patient_history"
            placeholder="Optional (max.200 characters)" maxlength="200"></textarea>
          </div>
          </div>

          <div class="form-control-group">
         <label for="lab_note" class="col-lg-2 control-label">Lab Note</label>
          <div class="col-lg-3">
           <textarea class="form-control textBox_height" id="lab_note" name="lab_note" placeholder="Optional (max.100 chars)" maxlength="100"></textarea>
          </div>
          </div>
  </div> <!-----------END ROW 3-------------->

  </div>



    <!----------- PANEL 3 - INVESTIGATION -------------->
    <div class="panel panel-success" id="test_div">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Investigation </h3>
     </div>

  	<div class="panel-body">
    	<!----- LABEL ------>
         <div class="row">
         <label for="ext_1" class="col-lg-1"></label>
         <label for="ext_2" class="col-lg-1">SL</label>
         <label for="ext_3" class="col-lg-6">Investigation Name</label>
         <label for="ext_5" class="col-lg-2 text-center">Price</label>
         </div>

        <!----- ROW 2-->
        <div class="form-group clonedInput" id="entry1">
         <label for="ext_6" class="col-lg-1"></label>
         <label id="sl_no1" name="sl_no" class="col-lg-1 sl_no">1.</label>

        <div class="form-control-group">
        <div class="col-lg-6">
        <input type="text" class="form-control test_name" id="test_name" placeholder="Search & Select Investigation" name="test_name[]" required>
        <input type="hidden" class="form-control test_id" id="hidden_test_id" name="test_id[]">
        <input type="hidden" class="form-control dept_id" id="hidden_dept_id" name="dept_id[]">
        </div>
        </div>

    <div class="form-control-group">
    <div class="col-lg-2" id="price_div">
    <input type="text" class="form-control text-right test_price" style="padding-right:36%;" id="test_price" placeholder="Rs." name="test_price[]" required readonly>
    </div>
    </div>
  </div> <!----- END ROW 2-->

        <div class="form-group">
        <label id="reference" name="reference" class="col-lg-1-3"></label>
        <div id="addDelButtons">
        <input type="button" id="btnAdd" class="btn btn-mini btn-primary addIcon">&nbsp;
        <input type="button" id="btnDel" class="btn btn-mini btn-danger deleteIcon">
        </div>
        </div>

	</div>
  </div>   <!--------- END Investigation Details  ----------->


    <!-------------- PANEL 4 Start Payment Details ------->
    <div class="panel panel-success">
        <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Payment </h3></div>

        <div class="panel-body">
        <!---------------------1nd row -------------->
        <div class="form-group">
          <div class="form-control-group">
             <label for="total_amt" class="col-lg-2 control-label">Total Amount</label>
              <div class="col-lg-2">
              <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly>
              </div>
          </div>

          <div class="form-control-group" style="line-height: 1.997779;">
            <label for="tax_radio" class="col-lg-1-5 control-label">Service Tax</label>
            <div class="col-lg-2-1">
            <label for="tax_no" class="radio-inline col-lg-1" style="margin-left:15px;">
              <input type="radio" class="form-control tax_radio" name="tax_radio" id="tax_no" value='2' checked>No
            </label>
            <label for="tax_yes" class="radio-inline col-lg-1"style="padding-left:30px;">
              <input type="radio" class="form-control tax_radio" name="tax_radio" id="tax_yes" value='1'>Yes
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

   <!------------- 2nd row -------------->
   <div class="form-group">
      <div class="form-control-group" style="line-height: 1.99999;">
      <label for="Discount" class="col-lg-2 control-label">Discount</label>
      <div class="col-lg-2">
      <label for="disc_no" class="radio-inline col-lg-1" style="margin-left:30px;">
      <input type="radio" class="form-control" name="disc_radio" id="disc_no" value='2' <?php if($PI_card == "2"){echo "checked";} ?> disabled>No
      </label>
      <label for="disc_yes" class="radio-inline col-lg-1" style="padding-left:30px;">
      <input type="radio" class="form-control" name="disc_radio" id="disc_yes" value='1' <?php if($PI_card == "1"){echo "checked";} ?> disabled>Yes
      </label>

      </div>
      </div>

          <div class="form-control-group">
          <div class="form-inline" id="discount">
          <label for="disc_code" class="col-lg-1-4 control-label" id="label_disc_code">Disc Code</label>
          <div class="col-lg-2-1" id="div_disc_code">
          <input type="text" class="form-control" id="disc_code" name="disc_code" placeholder="Disc Code" value="<?php if($PI_card == "1"){ echo 'D/'.date("ynj").getCounter($con, 12);} ?>" readonly>
          </div>

          <label for="disc_per" class="col-lg-1-4 control-label" id="label_disc_per">Disc Per(%)</label>
          <div class="col-lg-2-1" id="div_disc_per">
          <input type="text" class="form-control" id="disc_per" name="disc_per" value="<?php if($PI_card == "1"){ echo $disc_per;} ?>" readonly>
          </div>
          </div>
          </div>
   </div>

    <!--------------------- 3nd row -------------->
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
    </div> <!----- END 3nd row  ------>
 	</div>
   </div> <!------ END Payment Details --------->

    <div class="form-group" style="margin-bottom:50px;">
    <div class="col-lg-offset-4 col-lg-4">
     <button type="submit" class="btn btn-primary btn-block btn-large" style="font-size:16px;" id="patient_submit" name="submit">Submit</button>

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
<script src="js/patient_registration_card.js" type="text/javascript"></script>
</body>
</html>
<?php } ob_flush();?>