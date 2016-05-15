<?php require_once("check_login_admin.php");
	 resetCounter($con, 12, 'mm');	// disc_code_sl
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Discount</title>
<?php require_once("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <!-------- start loading.. ------------>
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>

  <div class="page-content" id="divHide">
   <div class="inv-main">

<?php
if(isset($_GET['submit'])){

$total_amount =0;
$total_after_tax =0;
$total_after_disc =0;
$bal=0;
$PP_paid =0;
$db_pp_paid =0;
$db_pp_total =0;
$db_total =0;
$refund_amount=0;
$tax = 0;

	$receipt_no = $_GET['receipt_no'];

	$disc_sl = $_GET['disc_sl'];
	$disc_remark = $_GET['disc_remark'];
	$disc_type = $_GET['disc_type'];
	$disc_value = $_GET['disc_value'];

	$user_id = $_SESSION['user_id'];
	$empty = $_GET['empty'];

	$pp_sl = $_GET['pp_sl'];
	$db_pp_total = $_GET['db_pp_total'];
	$db_pp_tax = $_GET['db_pp_tax'];
	$db_pp_paid = $_GET['db_pp_paid'];

	//Tax = Yes
	if($db_pp_tax =='1'){ $tax = getTax($con, $receipt_no); $total_after_tax = $db_pp_total + ($db_pp_total * $tax * 0.01);}

	//Tax = NO
	if($db_pp_tax =='2'){ $total_after_tax = $db_pp_total;}

	if($disc_type =='1'){ $total_after_disc = $total_after_tax - ($total_after_tax * $disc_value * 0.01);}
	if($disc_type =='2'){ $total_after_disc = $total_after_tax - $disc_value;} //2=amount
	if($disc_type =='N'){ $total_after_disc = $total_after_tax;} //N=no discount

	if($db_pp_paid == $total_after_disc){$PP_paid = $total_after_disc; $bal = 0;}
	if($db_pp_paid < $total_after_disc){$PP_paid = $db_pp_paid; $bal = $total_after_disc - $db_pp_paid;}
	if($db_pp_paid > $total_after_disc)
		{
			$PP_paid = $total_after_disc;
			$bal = 0;
			$refund_amount = $db_pp_paid - $total_after_disc;

			 // REFUND - expenditure
		  $EX_id = date("ynj").getCounter($con, 29);
		  $voucher = 'SG'.$EX_id;
		  $remark = 'Disc :'.$disc_value.' (Refunded Bal Rs. '.$refund_amount.')';
		  mysqli_query($con, "INSERT INTO expenditure(EX_id, EX_voucher, EX_particular, EX_person, EX_amount, EX_date, EX_user) VALUES ('$EX_id', '".$voucher."', '".$remark."', '".$receipt_no."', '".$refund_amount."', NOW(), '$user_id')");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: Expenditure" . mysqli_error($con) . ".";}//{ $flag = false; echo "Error details: update < only " . mysqli_error($con) . ".";}
			else updateCounter($con, 29);

	}


	//------------  START - TRANSACTION  ---------
	mysqli_autocommit($con, false);
	$flag = true;

// DISC IN % OR AMOUNT
if($disc_type =='1' || $disc_type =='2'){

	// no record on discount_tbl
	if ($empty =='Y'){
	$disc_sl_x = date("ynj").getCounter($con, 12);
	mysqli_query($con, "INSERT INTO discount_tbl(disc_code_sl, disc_receipt_no, disc_type, disc_value, disc_remark, disc_user, disc_status_date) VALUES ('$disc_sl_x', '$receipt_no', '".$disc_type."', '".$disc_value."', '".$disc_remark."', '$user_id', NOW())");
	if(mysqli_affected_rows($con) <=0) { $flag = false; echo "Error: discount_tbl".mysqli_error($con);}
	else updateCounter($con, 12);

/****************************
 26 	Patient Registration - book
 27 	Patient Investigation - book
 28 	Patient Discount - book
 29 	Customer Profile - book

 22 	Add - action
 23 	Edit - action
 24 	Cancel - action
 25 	Status  - action
 21 	Swap  - action
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '28', '22', '$disc_sl_x', '30', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

	}

	// Yes record on discount_tbl
	if ($empty =='N'){
	mysqli_query($con, "UPDATE discount_tbl SET disc_type = '$disc_type', disc_value = '".$disc_value."', disc_remark = '".$disc_remark."', disc_user = '$user_id', disc_status_date = NOW() WHERE disc_code_sl = '$disc_sl'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in discount";}

/****************************
 26 	Patient Registration - book
 27 	Patient Investigation - book
 28 	Patient Discount - book
 29 	Customer Profile - book

 22 	Add - action
 23 	Edit - action
 24 	Cancel - action
 25 	Status  - action
 21 	Swap  - action
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '28', '23', '$disc_sl', '30', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

	}

  //UPDATE patient_payment - PP_disc, PP_net, PP_bal
  mysqli_query($con, "UPDATE patient_payment SET PP_disc = '1', PP_net = '".$total_after_disc."', PP_paid = '".$PP_paid."', PP_bal = '".$bal."' WHERE PP_receipt_no = '$receipt_no'");
  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in patient_payment";}
 }


	// No Disc
 if($disc_type =='N'){
	//UPDATE patient_payment - PP_disc, PP_net, PP_bal
	mysqli_query($con, "UPDATE patient_payment SET PP_disc = '2', PP_net = '".$total_after_disc."', PP_paid = '".$PP_paid."', PP_bal = '".$bal."' WHERE PP_receipt_no = '$receipt_no'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in patient_payment";}
	}


	//----- TRANSACTION-ROLLBACK
	if($flag){
			mysqli_commit($con);
			header("location:discount_create.php?receipt_no=$receipt_no");
			//echo 'done';
			} else {
			mysqli_rollback($con);
			echo "Action is failed"; http_response_code(404);
		}
}
?>

<?php
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no_x = $_GET['receipt_no'];

$patient_info = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_dr_prescription, r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_status_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_gender, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_date, p.PI_phone, p.PI_card, y.PP_sl, y.PP_total, y.PP_tax, y.PP_net, y.PP_paid, y.PP_bal, y.PP_disc, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no = '$receipt_no_x'");

if (mysqli_num_rows($patient_info)!=0){

while($row = mysqli_fetch_array($patient_info))
  {
	  $pr_patient_id = $row['pr_patient_id'];
	  $dr_letter = $row['pr_dr_prescription'];
	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
	  $pr_date = $row['pr_date'];
    $pr_status_id = $row['pr_status_id'];

  	$pr_patient_name = $row['PI_name'];
	  $pr_patient_age_y = $row['PI_age_y'];
	  $pr_patient_age_m = $row['PI_age_m'];
	  $pr_patient_age_d = $row['PI_age_d'];
  	$pr_patient_gender = $row['PI_gender'];
	  $pr_patient_address = $row['PI_address'];
	  $pr_patient_pin = $row['PI_pin'];
	  $pr_phone = $row['PI_phone'];
	  $customer_type = $row['PI_card'];

	  $PP_sl = $row['PP_sl'];
	  $PP_total = $row['PP_total'];
	  $PP_tax = $row['PP_tax'];
	  $PP_disc = $row['PP_disc'];
	  $PP_net = $row['PP_net'];
	  $PP_paid = $row['PP_paid'];
    $PP_bal = $row['PP_bal'];

	  $marital_name = $row['marital_name'];
	  $state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  $gender_name = $row['gender_name'];
	  }
 ?>
<div class="panel panel-success">
  <div class="panel-heading light_purple_color">
  <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
  Registration <span class="panel-subTitle"> ( Information ) </span>
  <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  </h3>
  </div>

 <div class="panel-body">
 	<!---------------- ROW 1 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-2 control-label text-right"> EID :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control">ED/<?php echo $receipt_no_x;?></span>
        </div>
        </div>

        <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right">DATE : </label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  <?php echo $pr_date;?></span>
          </div>
          </div>

     <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"> NET : </label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control"><i class="fa fa-inr"></i>  <?php echo $PP_net; ?></span>
          </div>
          </div>
    </div>


    <!---------------- ROW 2 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-2 control-label text-right"> Name :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo $pr_patient_name;?></span>
        </div>
        </div>

       <div class="form-control-group">
        <label for="inputName" class="col-lg-1 control-label text-right"> Address :</label>
        <div class="col-lg-2">
        <span class="input-xlarge uneditable-input text-control"><?php echo $pr_patient_address.', '.$district_name.', '.$state_name;?> <?php if($pr_patient_pin != ""){echo " - ".$pr_patient_pin;} ?></span>
        </div>
        </div>

     <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  <?php echo $gender_name.' / '.show_age_long($con, $pr_patient_age_y, $pr_patient_age_m, $pr_patient_age_d).' <br/> ('.$marital_name.')';?></span>
          </div>
          </div>
    </div>

   <!---------------- ROW 3 ---------------->
   <div class="row">
      <div class="form-control-group">
      <label for="inputReffered" class="col-lg-2 control-label text-right ">Ref. By :</label>
      <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"> <?php if($dr_letter =='NO') {echo "Self";} else{ echo "Dr. ".showDoctor_name($con, $dr_letter); } ?> </span>
      </div>
      </div>

      <div class="form-control-group">
        <label for="inputName" class="col-lg-1 control-label text-right"> Source :</label>
        <div class="col-lg-2">
       <span class="input-xlarge uneditable-input text-control">
	   <?php
		 $referral = showReferral($con, $pr_source_id, $pr_referred_id);
			if($pr_source_id =='2')
	   			{
				  $count = countDisc_staff($con, $pr_source_id, $pr_referred_id);
				   echo $referral.', <span style="color:red;">Staff Disc used : '.$count.'</span>';}
			else
	   		{ echo $referral. " (".showSourceName($con, $pr_source_id).")"; }
		 ?>
         <input type="hidden" id="hidden_count" value="<?php if($pr_source_id =='2') echo $count; ?>"></span>
        </div>
        </div>

      <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-phone"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  +91 <?php echo $pr_phone;?></span>
          </div>
          </div>
     </div>
      </div>

   <!---------------- ROW 4 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-2 control-label text-right"> Customer Type :</label>
        <div class="col-lg-2">
        <span class="input-xlarge uneditable-input text-control"><?php echo showPatient_type($con, $customer_type);?></span>
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-2 control-label text-right"> Status :</label>
        <div class="col-lg-2">
        <span class="input-xlarge uneditable-input text-control blue_color"><?php echo showStatus($con, $pr_status_id);?></span>
        <input type="hidden" id="span_status" value="<?php echo $pr_status_id; ?>">
        </div>
        </div>
    </div>

<!---------------- ROW 5 ---------->
  <!-- <div class="row">
        <div class="form-control-group">
        <label for="inputReffered" class="col-lg-2 control-label text-right "> Overall Test :</label>
        <div class="col-lg-3">
          <span class="input-xlarge uneditable-input text-control"><?php echo showOverall_test($con, $receipt_no_x); ?></span>
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputReffered" class="col-lg-2 control-label text-right" id="label_referred_by">Overall Amount :</label>
        <div class="col-lg-3">
           <span class="input-xlarge uneditable-input text-control"><i class="fa fa-inr"></i> <?php echo showOverall_amount($con, $receipt_no_x);?></span>
        </div>
        </div>
  </div> -->

<!---------------- ROW 4 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-2 control-label text-right">Sub-Total :</label>
        <div class="col-lg-1"><span><?php echo $PP_total; ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Tax :</label>
        <div class="col-lg-1-3"><span ><?php echo showTax_value($con, $receipt_no_x); ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Disc :</label>
        <div class="col-lg-1-3"><span ><?php echo showDiscount_value($con, $receipt_no_x); ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Total :</label>
        <div class="col-lg-1-3"><span ><?php echo $PP_net; ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Paid :</label>
        <div class="col-lg-1-3"><span ><?php echo $PP_paid; ?></span></div>
        </div>

          <div class="form-control-group">
          <label for="inputSex" class="col-lg-1-3 control-label text-right"> Due :</label>
          <div class="col-lg-1-3"><span ><?php echo $PP_bal;?></span></div>
          </div>
     </div>


</div>


<!--------------Discount Add/Edit -------------->
<div class="panel panel-success">

 <form class="form-horizontal inv-form" role="form" method="get" action="#" id="myform">
  <div class="panel-heading light_purple_color">

  <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
  Add / Edit <span class="panel-subTitle"> ( Discount ) </span>
  </h3>
  </div>

  <?php
	$check = mysqli_query($con, "SELECT disc_code_sl, disc_type, disc_value, disc_remark FROM discount_tbl WHERE disc_receipt_no = '$receipt_no_x'");

	if (mysqli_num_rows($check)==0){
			$dsc_type = "";
			$dsc_value = "";
 			$dsc_remark = "";
			$dsc_code_sl = date("yn").getCounter($con, 12);
			$empty='Y';
		 }
	 else{
	 		while($row_check = mysqli_fetch_array($check)){
			  $dsc_type = $row_check['disc_type'];
			  $dsc_value = $row_check['disc_value'];
			  $dsc_remark = $row_check['disc_remark'];
			  $dsc_code_sl = $row_check['disc_code_sl'];
			  $empty='N';
			}
		}
  ?>

  <div class="form-group">
  <div class="form-control-group">
    <label for="receipt_no_disc" class="col-lg-4 control-label">Registration #</label>
    <div class="col-lg-4">
    <input type="text" class="form-control" id="receipt_no_disc" name="receipt_no_disc" value="<?php echo 'EID/'.$receipt_no_x; ?>" readonly>

    <input type="hidden" name="empty" value="<?php echo $empty; ?>">
    <input type="hidden" name="disc_sl" value="<?php echo $dsc_code_sl; ?>">
    <input type="hidden" name="receipt_no" value="<?php echo $receipt_no_x; ?>">
    <input type="hidden" name="db_pp_total" value="<?php echo $PP_total; ?>">
    <input type="hidden" name="db_pp_tax" value="<?php echo $PP_tax;?>">
    <input type="hidden" name="db_pp_paid" value="<?php echo $PP_paid;?>">
    <input type="hidden" name="pp_sl" value="<?php echo $PP_sl; ?>">
     </div>
    </div>
  </div>

   <div class="form-group">
   <div class="form-control-group">
    <label for="discount_code" class="col-lg-4 control-label">Discount Code</label>
    <div class="col-lg-4">
    <input type="text" class="form-control" id="discount_code" name="discount_code" value="<?php echo 'D/'.$dsc_code_sl; ?>" readonly>
    </div>
   </div>
   </div>

 <div class="form-group">
  <div class="form-control-group">
    <label for="disc_type" class="col-lg-4 control-label">Discount Type</label>
    <div class="col-lg-8">

    <label for="disc_type_per" class="radio-inline col-lg-2">
      <input type="radio" name="disc_type" class="disc_type_per" value='1' id="disc_type_per" checked <?php if($dsc_type == '1'){echo "checked";} ?>> in percent (%)
    </label>
    <label for="disc_type_amt" class="radio-inline col-lg-2" style="margin-left:30px;">
    <input type="radio" name="disc_type" class="disc_type_amt" value='2' id="disc_type_amt" <?php if($dsc_type == '2'){echo "checked";} ?>> in Amount
    </label>

    <label for="disc_type_no" class="radio-inline col-lg-2">
      <input type="radio" name="disc_type" class="disc_type_no col-lg-2" value='N' id="disc_type_no" <?php if($PP_disc == '2'){echo "checked";} ?>> No Disc
    </label>
        </div>
        </div>
   </div>

    <div class="form-group">
    <div class="form-control-group">
      <label for="disc_value" class="col-lg-4 control-label">Discount Value</label>
        <div class="col-lg-4">
          <input type="text" class="form-control"  placeholder="e.g. 10" name="disc_value" id="disc_value" value="<?php  echo $dsc_value;?>" required>
        </div>
        </div>
    </div>

    <div class="form-group">
     <div class="form-control-group">
    <label for="disc_remark" class="col-lg-4 control-label">Remark</label>
      <div class="col-lg-4">
        <textarea class="form-control" placeholder="Remark for discount" name="disc_remark" id="disc_remark"><?php  echo $dsc_remark; ?></textarea>
      </div>
    </div>
    </div>

    <div class="form-group">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="hidden" class="btn btn-primary btn-block" id="create_disc" name="submit" style="font-size:16px;">Create Discount</button>
       </div>
  </div>
</form>
<div class="clear"></div>
</div>

<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>

<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {

    var span_status = $('#span_status').val();
   if(span_status =='4'){$('#create_disc').attr('disabled', true);}
// if(span_status =='4'){$('#div_action').hide();}


	 $("#disc_type_per, #disc_type_amt, #disc_type_no").click(function () {

		$("#disc_value").val("");

	if ($('input[name=disc_type][value=1]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', false);}
	if ($('input[name=disc_type][value=2]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', false);}
	if ($('input[name=disc_type][value=N]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', true); $("#disc_value").val(""); $('#disc_remark').val("");}
	 });

	 // Not click
	if ($('input[name=disc_type][value=1]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', false);}
	if ($('input[name=disc_type][value=2]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', false);}
	if ($('input[name=disc_type][value=N]').prop("checked")) { $('#disc_value, #disc_remark').attr('disabled', true); $('#disc_remark').val(""); $("#disc_value").val("");
	}

	$("#create_disc").click(function(event) {

       if($('#hidden_count').val() >= 2){
			alert("Oops! Already used allotted Staff discount (2), Sorry ! Unable to generate discount Code.");
			event.preventDefault();
			}
		else if( !confirm('Are you sure ?'))
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#divHide').hide();
			  $('#divWait').show();
			}
		  });
	 });

$("#myform").validate({
	ignore: "",
	//errorContainer: ".err",
	//errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,


rules: {

	receipt_no_disc: {required: true},
	discount_code: {required: true},
	disc_remark: {required: true},

	disc_type: {required: true},
    disc_value: { required: function(){
						   if ($('input[name=disc_type][value=1]').prop("checked")) { return true; }  // yes
					      if ($('input[name=disc_type][value=2]').prop("checked")) { return true; }  // no
						  if ($('input[name=disc_type][value=N]').prop("checked")) { return false; }  // no
					  },
				  number:true,
				  },
			 },

messages: {
			disc_type: "",
			receipt_no_disc: "",
			discount_code: "",
	},

errorPlacement: function(error, element) {
                 error.appendTo('.err');
             },

 	highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
    }

	});
 });
</script>
  </body>
</html>
<?php } else{echo "Unknown Registration !";} } ob_flush(); ?>