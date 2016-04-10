<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Registration</title>
  <?php require_once("css_bootstrap_datatable_header.php"); ?>
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<?php

//--------UPDATE FOR PAtient Information
if(isset( $_GET['submit_info']))
 	{
	  resetCounter($con, 34, 'dd');  //  History
	  resetCounter($con, 35, 'dd');  //  Lab Note
	  resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)

		  $receipt_no = $_GET['hidden_receipt_no'];
		  $patient_id = $_GET['hidden_patient_id'];
		  $reason = $_GET['reason'];
		  $opt_date = $_GET['opt_date'];

		  $patient_history = ucwords($_GET['patient_history']);
		  $lab_note = ucwords($_GET['lab_note']);


		 $dr_letter = $_GET['dr_letter'];
		 if($dr_letter == "Y") {$dr_id = $_GET['hidden_dr_id'];}else{$dr_id='NO';}

		  $src_type = $_GET['src_type'];
		  if($src_type == "W"){
			  $source_id = '3';
			  $referred_id = '0';
			}
		  else{
		  $source_id = $_GET['hidden_source_id'];
		  $referred_id = $_GET['hidden_referred_by'];
		  }

		  $history_id = date("jmy").getCounter($con, 34);
		  $lab_id = date("jmy").getCounter($con, 35);
		  $A_id = date("jmy").getCounter($con, 42);
		  $user_id=$_SESSION['user_id'];

  //-------------- START - TRANSACTION/ROLLBACK
  mysqli_autocommit($con, false);
  $flag = true;


  if($opt_date =='N'){
  //------------ UPDATE patient_registration
  mysqli_query($con, "UPDATE patient_registration SET pr_dr_prescription='".$dr_id."', pr_source_id='$source_id', pr_referred_id='$referred_id' WHERE pr_receipt_no ='$receipt_no'");
	  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_registration: " . mysqli_error($con) . ".";}
  }

  if($opt_date =='Y'){
	 $date_edit = date("Y-m-d H:i:s", strtotime($_GET['date_edit']));
  //------------ UPDATE patient_registration
  mysqli_query($con, "UPDATE patient_registration SET pr_dr_prescription='".$dr_id."', pr_source_id='$source_id', pr_referred_id='$referred_id', pr_date = '".$date_edit."' WHERE pr_receipt_no ='$receipt_no'");
	  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_registration: " . mysqli_error($con) . ".";}

	//------------ UPDATE date patient_payment
	  mysqli_query($con, "UPDATE patient_payment SET PP_date = '".$date_edit."' WHERE PP_receipt_no ='$receipt_no'");
	  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_payment: " . mysqli_error($con) . ".";}

	 //------------ UPDATE date patient_transaction
	  mysqli_query($con, "UPDATE patient_transaction SET TR_date = '".$date_edit."' WHERE TR_pp_sl IN (SELECT PP_sl FROM patient_payment WHERE PP_receipt_no ='$receipt_no')");
	  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_transaction: " . mysqli_error($con) . ".";}
  }

  //------------ Patient History
  if($patient_history !=''){
   mysqli_query($con, "INSERT INTO patient_history(PH_id, PH_patient_id, PH_history) VALUES ('$history_id', '$patient_id', '".$patient_history."')");
	if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "History: " . mysqli_error($con) . ".";}
	  else updateCounter($con, 34);
  }

  //------------ Lab Note
  if($lab_note !=''){
	mysqli_query($con, "INSERT INTO lab_note(LB_id, LB_receipt_no, LB_user, LB_note, LB_date) VALUES ('$lab_id', '$receipt_no', '$user_id', '".$lab_note."', NOW())");
	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Lab: " . mysqli_error($con) . ".";}
	  else updateCounter($con, 35);
   }

/****************************
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile

 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status
 ******************************/

 $remark = 'Edited: Registration # '.$receipt_no.' (Reason:'.$reason.')';
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '23', '$receipt_no', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);


	if($flag){
			mysqli_commit($con);
			header("LOCATION: patient_registration_edit.php?receipt_no=$receipt_no&reason=$reason");
			}
	 else
			{
			mysqli_rollback($con);
			echo " ! Action is failed".mysqli_error($con); http_response_code(404);
			}
 }


if(isset($_GET['submit_reset']))
{
  $receipt_no = $_GET['receipt_no'];
  $pp_sl = $_GET['PP_sl'];
  $sub_total = $_GET['sub_total'];
  $net_new = $_GET['net_new'];
  $paid_amount = $_GET['paid_amount'];
  $due_amount = $_GET['due_amount'];
  $user_id = $_SESSION['user_id'];
  $reason = $_GET['reason'];

  /*------ START TRANSACTION ----------*/
  mysqli_autocommit($con, false);
  $flag = true;

  if(isset($paid_amount) && $paid_amount !="")
  {

  resetCounter($con, 13, 'dd'); // patient_transaction
  resetCounter($con, 42, 'dd'); //  A_id (audit_tbl)
  $tr_id = date("jmy").getCounter($con, 13);

  // Delete all old trasation for reset
  mysqli_query($con, "DELETE FROM `patient_transaction` WHERE TR_pp_sl = '$pp_sl'");
  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error : Transaction Delete".mysqli_error($con). ".";}

  // UPDATE ON PATIENT_PAYMENT
  mysqli_query($con, "UPDATE patient_payment SET PP_paid = '".$paid_amount."', PP_date = NOW(), PP_bal = '".$due_amount."' WHERE PP_sl = '$pp_sl'");
  if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: PATIENT_PAYMENT update".mysqli_error($con). ".";}

  // INSERT ON PATIENT_TRANSACTION
  mysqli_query($con, "INSERT INTO patient_transaction(TR_id, TR_pp_sl, TR_amount, TR_date, TR_user) VALUES ('$tr_id', '$pp_sl', '".$paid_amount."', NOW(), '$user_id')");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error : Transaction Add ".mysqli_error($con). ".";}
  else updateCounter($con, 13);

  /****************************
     26   Patient Registration
     27   Patient Investigation
     28   Patient Discount
     29   Customer Profile
     36   Payment
     22   Add
     23   Edit
     24   Cancel
     25   Status
  ******************************/
 $A_id = date("jmy").getCounter($con, 42);
 $remark = 'Reset Total Paid :'.$paid_amount.' (Reason:'.$reason.')';
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '36', '23', '$receipt_no', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl" .mysqli_error($con). ".";}
  else updateCounter($con, 42);
  }

  if($flag){
    mysqli_commit($con);
    header("LOCATION: patient_registration_edit.php?receipt_no=$receipt_no&reason=$reason&smsg=5");
      }
  else {
    mysqli_rollback($con);
    header("LOCATION: patient_registration_edit.php?receipt_no=$receipt_no&reason=$reason&errmsg=5");
    }
  }
?>

<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
<!------------------- start loading..-------------------------------->
<div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
 <div class="page-content" id="div_main">
 <div class="inv-main" >
<?php
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="" && isset($_GET['reason']) && $_GET['reason'] !="")
{
$pass_receipt_no = $_GET['receipt_no'];
$reason = $_GET['reason'];
$user_id = $_SESSION['user_id'];

 $patient_info = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_dr_prescription, p.PI_name,  p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_phone, y.PP_sl, y.PP_tax, y.PP_disc, y.PP_total, y.PP_net, y.PP_paid, y.PP_bal, s.state_name, d.district_name, g.gender_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id  LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id WHERE r.pr_receipt_no = '$pass_receipt_no'");

  while($row = mysqli_fetch_array($patient_info))
  {
	  $pr_receipt_no = $row['pr_receipt_no'];
  	$pr_patient_id = $row['pr_patient_id'];
	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	$pr_date = $row['pr_date'];
	  $dr_id = $row['pr_dr_prescription'];

  	$name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];
  	$gender = $row['gender_name'];
	  $marital = $row['marital_name'];
	  $address = $row['PI_address'];
  	$state = $row['state_name'];
	  $district = $row['district_name'];
	  $pin = $row['PI_pin'];
  	$phone = $row['PI_phone'];

	  $PP_sl = $row['PP_sl'];
    $PP_tax = $row['PP_tax'];
	  $PP_disc = $row['PP_disc'];
	  $PP_total = $row['PP_total'];
	  $PP_paid = $row['PP_paid'];
	  $PP_net = $row['PP_net'];
	  $PP_bal = $row['PP_bal'];


	}
?>
<!------------------- Panel 1---------------------->
<div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Registration <span class="panel-subTitle"> ( Info ) </span>
       <span id="page_date" class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>
       <span id="show_date"></span></span>
        </h3>
      </div>


<!-- ERROR/SUCCESS MSG -->
 <?php if(isset($_GET['errmsg']) && $_GET['errmsg'] !== ''){
      ?>
    <div class="alert alert-danger alert-error no-print">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-times-circle fa fa-lg fa-fw"></i> </strong> <?php echo error_message($con, $_GET['errmsg']); ?>
    </div>
 <?php }?>

 <?php if(isset($_GET['smsg']) && $_GET['smsg'] != ''){ ?>
    <div class="alert alert-success alert-error no-print">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-check-circle fa-lg fa-fw"></i> </strong> <?php echo success_message($con, $_GET['smsg']); ?>
    </div>
 <?php }?>


  <div class="panel-body">

    <!---------------- ROW 1 ---------------->
    <div class="row">

       <div class="form-control-group">
        <label for="inputSex" class="col-lg-3 control-label text-right">Registration No# : </label>
        <div class="col-lg-3">
        <span > ED/<?php echo $pr_receipt_no;?> </span>
        </div>
        </div>

      <div class="form-control-group">
      <label for="inputName" class="col-lg-2 control-label text-right">Customer ID :</label>
      <div class="col-lg-3">
      <span ><?php echo $pr_patient_id;?></span>
      </div>
      </div>


     </div>

    <!---------------- ROW 2 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Name :</label>
        <div class="col-lg-3">
        <span ><?php echo $name;?></span>
        </div>
        </div>

     	  <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
          <div class="col-lg-2">
          <span >
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
        <span >
		<?php echo $address; ?></span>
        </div>
        </div>

          <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-phone"></i> :</label>
          <div class="col-lg-3">
          <span >  +91 <?php echo $phone;?></span>
          </div>
          </div>
     </div>

    <!---------------- ROW 3 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"></label>
        <div class="col-lg-3">
        <span >
    <?php echo $district.', '.$state;?> <?php if($pin != ""){echo " - ".$pin;} ?></span>
        </div>
        </div>

          <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-calendar"></i> Dated :</label>
          <div class="col-lg-3">
          <span class="bold_font blue_color">  <?php echo date("d/m/Y h:i A", strtotime($pr_date));?> </span>
          </div>
          </div>
     </div>

     </div>



    </div>
    </div>

<!---------  Panel 2 - SOURCE/REFERRAL -------->
	<div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Edit <span class="panel-subTitle"> ( Source Referral ) </span>
      </h3>
    </div>

<div class="panel-body">
<form class="form-horizontal inv-form" role="form" method="get" id="form_patient">

<input type="hidden" name="hidden_receipt_no" value="<?php echo $pr_receipt_no; ?>">
<input type="hidden" name="hidden_patient_id" value="<?php echo $pr_patient_id; ?>">
<input type="hidden" name="reason" value="<?php echo $reason; ?>">

<div class="form-group">
    <div class="form-control-group" style="line-height: 1.997779;">
    <label for="src_type" class="col-lg-3 control-label"> Source </label>
    <div class="col-lg-4">
    <label for="src_walkin" class="radio-inline col-lg-1" style="padding-right:40px;">
    <input  type="radio"class="form-control" name="src_type" id="src_walkin" value='W' <?php if($pr_source_id == '3'){echo "checked";} ?>>Walkin
    </label>
    <label for="src_staff" class="radio-inline col-lg-1" style="padding-right:30px;">
    <input  type="radio"class="form-control" name="src_type" id="src_staff" value='S' <?php if($pr_source_id == '2'){echo "checked";} ?>>Staff
    </label>
    <label for="src_others" class="radio-inline col-lg-1">
    <input type="radio" class="form-control" name="src_type" id="src_others" value='O' <?php if($pr_source_id > '3'){echo "checked";} ?>>Others
    </label>
    </div>
    </div>

  <div class="form-control-group" id="div_refBy">
  <div class="col-lg-4">
  <input type="text" class="form-control" placeholder="Search & Select source Person" name="referred_by" id="referred_by" value="<?php echo showReferral($con, $pr_source_id, $pr_referred_id); ?>">
  <input type="hidden" id="hidden_referred_by" name="hidden_referred_by" value="<?php echo $pr_referred_id; ?>">
  <input type="hidden" id="hidden_source_id" name="hidden_source_id" value="<?php echo $pr_source_id; ?>">
  </div>
  </div>

 </div>

    <div class="form-group">
    <div class="form-control-group" style="line-height: 1.997779;">
    <label for="dr_letter" class="col-lg-3 control-label"> Doctor Prescription ?</label>
    <div class="col-lg-3">
    <label for="dr_letter_yes" class="radio-inline col-lg-1" style="padding-right:40px;">
    <input  type="radio" name="dr_letter" class="form-control" id="dr_letter_yes" value ="Y" <?php if($dr_id != "NO"){echo "checked";} ?>>Yes
    </label>
    <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-right:30px;">
    <input type="radio" name="dr_letter" class="form-control" id="dr_letter_no" value ="N" <?php if($dr_id == "NO"){echo "checked";} ?>>No
    </label>
    </div>
    </div>

      <div class="form-control-group" id="div_dr_name">
      <label for="dr_name" class="col-lg-1 control-label" id="label_dr_name">Dr.Name</label>
      <div class="col-lg-4"><input type="text" class="form-control" name="dr_name"  id="dr_name" placeholder="Search" value="<?php if($dr_id=="NO"){echo "";}else{echo showDoctor_name($con, $dr_id);}?>">
      <input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $dr_id;?>">
      </div>
      </div>
  </div>

<!-- CHANGE DATE -->
 <div class="form-group">
	<div class="form-control-group" style="line-height: 1.997779;">
  	<label for="opt_date" class="col-lg-3 control-label"> Change Date ?</label>
      <div class="col-lg-3">
          <label class=" control-label radio-inline col-lg-1" style="padding-right:40px;">
           	<input  type="radio" name="opt_date" id="date_yes" class="form-control radio-inline" value ="Y">Yes
          </label>
          <label class="control-label radio-inline col-lg-1" style="padding-right:30px;">
            <input type="radio" name="opt_date" id="date_no" class="form-control radio-inline" value ="N" checked>No
          </label>
      </div>
      </div>

      <div class="form-control-group" id="div_date">
      <label for="date_edit" class="col-lg-1 control-label">Date</label>
      <div class="col-lg-4" >
      <input type="text" class="form-control" name="date_edit" id="date_edit" readonly>
      </div>
      </div>

 </div><!--end row 4-->


<div class="form-group">
  <div class="form-control-group">
  <label for="patient_history" class="col-lg-3 control-label" id="patient_history">Previous History</label>
  <div class="col-lg-3">
  <textarea class="form-control textBox_height" placeholder="Previous History - Readonly">Read Only : <?php echo showHistory_patient($con, $pr_patient_id);?></textarea>
  </div>
  </div>

    <div class="form-control-group">
    <label for="lab_note" class="col-lg-1 control-label">Previous Note</label>
    <div class="col-lg-4">
    <textarea class="form-control textBox_height" placeholder="Previous Lab notes - Readonly">Read Only : <?php echo showLab_note($con, $pr_receipt_no);?></textarea>
    </div>
    </div>

 </div>


<div class="form-group">
  <div class="form-control-group">
  <label for="patient_history" class="col-lg-3 control-label" id="patient_history">New Patient History</label>
  <div class="col-lg-3">
  <textarea class="form-control textBox_height" name="patient_history" id="patient_history" placeholder="Optional (Max.300 Characters)" maxlength="300"></textarea>
  </div>
  </div>

    <div class="form-control-group">
    <label for="lab_note" class="col-lg-1 control-label">New Lab Note</label>
    <div class="col-lg-4">
    <textarea class="form-control textBox_height" name="lab_note" placeholder="Optional (Max.300 Chars)" id="lab_note" maxlength="300"></textarea>
    </div>
    </div>

 </div>

    <div class="form-group panel-footer">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block submit_info" id="submit_info" name="submit_info" style="font-size:16px;">Update Info</button>
    </div>
    </div>
</form> <!------------ END Patient Info ------------>
</div>
</div>


  <!------------ Investigation table ------------>
  <div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Investigation <span class="panel-subTitle"> ( Cancel / Add )</span>
     </h3>
     </div>

 <div class="panel-body">
  <div class="width_90" style="padding-left:10%;">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display table-hover" id="test_table">
        <thead align="left">
        <tr>
          <th>SL</th>
          <th> Investigation</th>
          <th style="text-align:right; padding-right:50px;"> Price</th>
          <th> Status </th>
          <th class="no-print">Cancel</th>
        </tr>
        </thead>
     <tbody>
<?php
$result_test = mysqli_query($con, "SELECT PT_sl, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id FROM patient_test WHERE PT_receipt_no ='$pass_receipt_no'");
$sl_no_t=1;
while ($test = mysqli_fetch_array($result_test))
{
	$PT_sl = $test['PT_sl'];
	$PT_test_id = $test['PT_test_id'];
	$PT_test_name = $test['PT_test_name'];
	$PT_test_price = $test['PT_test_price'];
	$PT_dept_id = $test['PT_dept_id'];
	$PT_status_id = $test['PT_status_id'];
?>
 <tr id="<?php echo $PT_sl.' '.$reason; ?>">
    <td><?php echo $sl_no_t; ?></td>
    <td><?php echo $PT_test_name; ?></td>
    <td style="text-align:right; padding-right:50px;"><?php echo $PT_test_price; ?></td>
    <td><?php echo showStatus($con, $PT_status_id); ?> </td>
    <td class="no-print" title="Cancel Test">
      <form action="patient_test_delete.php" role="form" method="get" class="form_new">
      <input type="hidden" name="receipt_no" value="<?php echo $pass_receipt_no;?>"/>
      <input type="hidden" name="PT_sl" value="<?php echo $PT_sl;?>"/>
      <input type="hidden" name="reason" value="<?php echo $reason;?>"/>
      <button class="btn btn-small btn-primary" type="submit"><i class="fa fa-times"></i></button>
      </form>
      </td>
 </tr>
 <?php
	$sl_no_t++;
}
?>
</tbody>
</table>
</div>

	<!--------- Form for new ---------->
	<form id="formTest" method="post" action="#" title="Add New" style="display:none">

	<label id="lblAddError" style="display:none" class="error"></label>
 	<div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

    <div class="form-group">
    <div class="form-control-group">
    <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>
    <div class="col-lg-7 padding_gap">
    <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_no_t;?>" readonly rel="0" required>

  	<!---------hidden fields ---------->
    <input type="hidden" name="receipt_no" id="receipt_no" value="<?php echo $pass_receipt_no; ?>">
    <input type="hidden" name="test_id" id="hidden_test_id" value="<?php echo $PT_test_id; ?>">
    <input type="hidden" name="dept_id" id="hidden_dept_id" value="<?php echo $PT_dept_id; ?>">
    <input type="hidden" name="tax_option" id="tax_option" value="<?php echo $PP_tax; ?>">
    <input type="hidden" name="disc_option" id="disc_option" value="<?php echo $PP_disc; ?>">
    <input type="hidden" name="paid_amount" id="paid_amount" value="<?php echo $PP_paid; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="reason" value="<?php echo $reason; ?>">
  </div>
  </div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="test_name">Investigation :</label>
  <div class="col-lg-7 padding_gap">
  <input name="test_name" id="test_name" class="form-control" placeholder="Investigation" rel="1" required autofocus>
   </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="test_price">Price :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" name="test_price" id="test_price" class="form-control capital" placeholder="Price" rel="2" required readonly>
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="status">Status :</label>
  <div class="col-lg-7 padding_gap">
  <select name="status" id="status" class="form-control capital" placeholder="Price" rel="3" required>
  <option value=""  class="option_select">Select Status</option>
	<?php $select_query = mysqli_query($con, "SELECT status_id, status_name FROM status_tbl WHERE status_table ='fd_report' AND status_id !='4'");
          while($row11 = mysqli_fetch_array($select_query)) {?>
          <option value="<?php echo $row11['status_id'];?>" <?php if($row11['status_id']==1){echo 'selected';}?> class="option_select">
		  <?php echo $row11['status_name']; ?>
          </option>
<?php } ?>
  </select>
  </div></div></div>
  <br/>
  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="cancel">Cancel :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" name="cancel" id="cancel" class="form-control" placeholder="Cancel" rel="4" readonly>
  </div></div></div>
  <br/>
  <br/>

</form>
<div class="width_90" style="padding-left:10%;">
<button id="btnDeleteRow" style="display:none;">Delete</button> <button id="btnAddNewRow">Add</button>
</div>
</div>
</div>


<!---------  Panel 4 - RESET PAYMENT -->
  <div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Reset <span class="panel-subTitle"> ( Paid Amount ) </span>
      </h3>
      </div>

<div class="panel-body">

<!---------------- ROW 4 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right">Current Summary : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sub-Total :</label>
        <div class="col-lg-1"><span><?php echo $PP_total; ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Tax :</label>
        <div class="col-lg-1-3"><span ><?php echo showTax_value($con, $pr_receipt_no); ?></span></div>
        </div>

        <div class="form-control-group">
        <label for="inputName" class="col-lg-1-2 control-label text-right"> Disc :</label>
        <div class="col-lg-1-3"><span ><?php echo showDiscount_value($con, $pr_receipt_no); ?></span></div>
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

<form class="form-horizontal inv-form" role="form" method="get" id="form_reset">
  <div class="form-group padding_top30">
      <div class="form-control-group">
      <label for="paid_amount" class="col-lg-2 control-label">Reset Total Paid</label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Total Paid Amount" maxlength="10">
      </div>
      </div>

      <div class="form-control-group">
      <label for="due_amount" class="col-lg-2 text-right control-label">Due</label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="due_amount" name="due_amount" readonly>
      </div>
      </div>
 </div>

      <input type="hidden" id="sub_total" name="sub_total" value="<?php echo $PP_total;?>">
      <input type="hidden" id="net_new" name="net_new" value="<?php echo $PP_net;?>">
      <input type="hidden" name="receipt_no" value="<?php echo $pass_receipt_no;?>"/>
      <input type="hidden" name="PP_sl" value="<?php echo $PP_sl;?>"/>
      <input type="hidden" name="reason" value="<?php echo $reason;?>"/>

    <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" id="submit_reset" name="submit_reset" style="font-size:16px;">Reset Payment</button>
    </div>
    </div>
</form> <!------------ END Payment ------------>
</div>

</div></div>

  <div class="clear" style="padding-bottom:50px;"></div>
  </div>

<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	//-------------- show/hide of Source
	$("#src_walkin, #src_staff, #src_others").click(function (){

	 $("#referred_by").val("");

	 //Others
	  if ($('input[name=src_type][value=O]').prop("checked")) {
	   $('#div_refBy').show();
	   $("#referred_by").autocomplete({
		  source: "autocomplete_reffered_by.php",
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					   {
						  $("#referred_by").val("");
						  $('#hidden_referred_by').val("");
						  $('#hidden_source_id').val("");
						  return false;}
				   else
					   { $("#referred_by").val(ui.item.value);
						 $('#hidden_referred_by').val(ui.item.referred_id);
						 $('#hidden_source_id').val(ui.item.source_id);
						 return false;} },
			}).focus(function() {
		  $(this).autocomplete("search");
	  });
	  }

	  //Staff
	  if ($('input[name=src_type][value=S]').prop("checked")) {
		   $('#div_refBy').show();
		   $("#referred_by").autocomplete({
			  source: "autocomplete_staff.php",
			  minLength:0,
			  scroll:true,
			  change: function (event, ui){
						if (ui.item == null)
						   {
							  $("#referred_by").val("");
							  $('#hidden_referred_by').val("");
							  $('#hidden_source_id').val("");
							  return false;}
					   else
						   { $("#referred_by").val(ui.item.value);
							 $('#hidden_referred_by').val(ui.item.referred_id);
							 $('#hidden_source_id').val(ui.item.source_id);
							 return false;} },
				}).focus(function() {
			  $(this).autocomplete("search");
		  });
		}

	if ($('input[name=src_type][value=S]').prop("checked")) { $('#div_refBy').show();}
	if ($('input[name=src_type][value=O]').prop("checked")) { $('#div_refBy').show();}

	//Walkin
	if ($('input[name=src_type][value=W]').prop("checked")) {
		$('#div_refBy').hide();
		$('#hidden_referred_by').val("");
		$('#hidden_source_id').val("");
		}
   });

	//Not on Click
	if ($('input[name=src_type][value=W]').prop("checked")) { $('#div_refBy').hide();}
	//if ($('input[name=src_type][value=S]').prop("checked")) { $('#div_refBy').show();}
	//if ($('input[name=src_type][value=O]').prop("checked")) { $('#div_refBy').show();}

	//Others
	  if ($('input[name=src_type][value=O]').prop("checked")) {
	   $('#div_refBy').show();
	   $("#referred_by").autocomplete({
		  source: "autocomplete_reffered_by.php",
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					   {
						  $("#referred_by").val("");
						  $('#hidden_referred_by').val("");
						  $('#hidden_source_id').val("");
						  return false;}
				   else
					   { $("#referred_by").val(ui.item.value);
						 $('#hidden_referred_by').val(ui.item.referred_id);
						 $('#hidden_source_id').val(ui.item.source_id);
						 return false;} },
			}).focus(function() {
		  $(this).autocomplete("search");
	  });
	  }

	  //Staff
	  if ($('input[name=src_type][value=S]').prop("checked")) {
		   $('#div_refBy').show();
		   $("#referred_by").autocomplete({
			  source: "autocomplete_staff.php",
			  minLength:0,
			  scroll:true,
			  change: function (event, ui){
						if (ui.item == null)
						   {
							  $("#referred_by").val("");
							  $('#hidden_referred_by').val("");
							  $('#hidden_source_id').val("");
							  return false;}
					   else
						   { $("#referred_by").val(ui.item.value);
							 $('#hidden_referred_by').val(ui.item.referred_id);
							 $('#hidden_source_id').val(ui.item.source_id);
							 return false;} },
				}).focus(function() {
			  $(this).autocomplete("search");
		  });
		}

  /*--------------- show/hide of Dr.name  --------------------------*/
  $("#dr_letter_yes, #dr_letter_no").click(function () {
	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val("");}
    });

	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();}
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide();}

  /*--------------- show/hide of Date Change --------------------------*/
  $("#date_yes, #date_no").click(function () {
    if ($('input[name=opt_date][value=Y]').prop("checked")) { $('#div_date').show();}
    if ($('input[name=opt_date][value=N]').prop("checked")) { $('#div_date').hide();}
    });

    if ($('input[name=opt_date][value=Y]').prop("checked")) { $('#div_date').show();}
    if ($('input[name=opt_date][value=N]').prop("checked")) { $('#div_date').hide();}

	/*------------- Doctor autocomplete -----------*/
 	$('#dr_name').autocomplete({
		  source:'autocomplete_dr.php',
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
				  if (ui.item == null)
					{ $("#dr_name").val("");
					  $('#hidden_dr_id').val("");
					  return false;}
			  else
				   { $("#dr_name").val(ui.item.value);
					 $('#hidden_dr_id').val(ui.item.dr_id);
					 return false; }
			},
		}).focus(function() {
                $(this).autocomplete("search");
            });

	// Submit form
	$("#submit_info").click(function(event) {
			if( !confirm('Are you sure to submit ?'))
				event.preventDefault();
				$('form').submit(function (){
				if ($(this).valid()){
				  $('#div_main').hide();
				  $('#divWait').show();
				}
			  });
		});

$("#form_patient").validate({
	//debug: true,
	ignore: "",
	errorContainer: ".err",
	errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,

	invalidHandler: function(event, validator) {
				//errorClass: "control-group error"
				errorContainer: ".error"
				errorLabelContainer: '#submit-error'

				var errors = validator.numberOfInvalids();
				if (errors)
					{ var message = errors == 1
					  ? 'Missed 1 field. Highlighted - '
					  : 'Missed ' + errors + ' fields. Highlighted - ';
					  $("div.error").show().delay(3000).fadeOut("medium");
					  $("div.error span").html(message);
					  $("div.err").hide();
					  $("div.err span").hide();
					  $("#page_date").hide();
					  return false;}
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},
rules: {
		dr_letter: "required",
		dr_name: {   required: function(){
						var dr_letter = $('#dr_letter').val();
						var hidden_dr_id = $('#hidden_dr_id').val();
						if ($('input[name=dr_letter][value=Y]').prop("checked") && hidden_dr_id =="")
						 {
							 return true;
						  }else  {
							 return false;
						 }
                   },
					     minlength: 3,
					     maxlength: 100 },

		src_type: {   required: true,
					},

		referred_by: {   required: function(){

								   var referred_by = $('#referred_by').val();
								   if ($('input[name=src_type][value=W]').prop("checked") && referred_by =='' || referred_by !='')
								   {
									   return false;
								   }else {
									   return true;
								   }
						},
					     minlength: 3,
					     maxlength: 100 },

		patient_history: {
							required: false,
							maxlength: 200 },

		lab_note: { required: false,
					   maxlength: 100 },
    date_edit: {   required: function(){
            if ($('input[name=opt_date][value=Y]').prop("checked"))
                  { return true;}
            else  { return false;}
                },
               },
},

messages: {
			dr_letter: "",
			dr_name: { required: "",
							minlength: "Dr.Name should be at least 3 characters",
							maxlength: "Dr.Name should be max.of 100 characters" },
			src_type: { required: "",},
			referred_by: {required: "",
							minlength: "Referred By should be at least 3 characters",
							maxlength: "Referred By should be max.of 100 characters" },
			patient_history: {maxlength:"Patient History should be max.of 100 characters" },
		    lab_note: {maxlength: "Lab Notes should be max.of 50 characters" },
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

/*-------------------- autocomplete - 1ST Test --------------------*/
 $('#test_name').autocomplete({
	    source:'autocomplete_test.php',
		minLength:0,
		scroll:true,

		change: function (event, ui){
				if (ui.item == null)
				{ $('#test_name').val("");
				  $('#hidden_test_id').val("");
				  $('#hidden_dept_id').val("");
				  $('#test_price').val("");
				  return false; }
		     else
		        { $('#test_name').val(ui.item.value);
				  $('#hidden_test_id').val(ui.item.test_id);
				  $('#hidden_dept_id').val(ui.item.dept_id);
				  $('#test_price').val(ui.item.test_price);
				  return false; }
		        },
			}).focus(function() {
            $(this).autocomplete("search");
        });

/*--------------- test table ------------------*/
$('#test_table').dataTable( {

    "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
    "bStateSave": true,
		"bBootstrap": true,
		"bInfo": false,
		"bFilter": false,

		"fnPreDrawCallback": function( oSettings ) {
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');
		  $('.dataTables_length select').css('margin-right', '3px');
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
		}
     }).makeEditable({

		sAddURL:           "patient_registration_edit_add.php",
   // sDeleteURL:        "patient_registration_edit_delete.php",

		sAddNewRowFormId:  "formTest",
		sAddDeleteToolbarSelector: ".dataTables_length",

		oAddNewRowButtonOptions: {
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: {
				label: "Cancel Test",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: {
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
				},

			aoColumns: [
                    	null,
						null,
						null,
						],


	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                               jAlert(message, "Add failed");
                                break;
                        }
                    },

	fnStartProcessingMode: function () {
                        $("#processing_message").dialog();

                    },
   fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");
						            setTimeout('window.location.reload()', 10);
                    },

    });

//---------- TEST FORM VALIDATION
	$("#test_table").validate({
	ignore: "",
	onkeyup: true,
	onblur: true,
	rules: {
		test_name: "required",
		test_price: { required: true,
				 number: true, },
		status: {  required: true,},
	  },

	});

	// DATE FOR REGISTRATION
	 $('#date_edit').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),
            });

// ------- PAYMENT RESET

$('#paid_amount').on('keyup', function() {
    var paid_amount = Number($('#paid_amount').val());
    var net_new = Number($('#net_new').val());
    var due_current = net_new - paid_amount;
    var due = due_current.toFixed(2);
    $('#due_amount').val(due);
    });

// ---- click reset
$("#submit_reset").click(function(event) {
    if( !confirm('Are you sure to Reset Total Paid Amount ?'))
            event.preventDefault();
    $('form').submit(function () {
    if ($(this).valid()) {
        $('#div_main').hide();
        $('#divWait').show();
      }
    });
  });

$("#form_reset").validate({
  ignore: "",
  errorContainer: ".err",
  errorLabelContainer: '.span-error',
  onkeyup: true,
  onblur: true,

  rules: {
   paid_amount: { required: true,
             number: true,
             minlength: 1,
             min:0,
             max: function(){ return Number($('#net_new').val());},
          },
      },
  messages: {
    paid_amount: { required: "",
           number: "Numbers only",
           min:'min.number is 0',
           max: function(){ return 'Max.payable amount Rs. ' + Number($('#net_new').val());},
             },
      },
});


});
</script>

</body>
</html>
<?php } ob_flush();?>