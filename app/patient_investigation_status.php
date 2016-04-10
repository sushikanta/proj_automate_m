<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Info</title>
<?php require_once("css_bootstrap_datatable_header.php");?>
<?php require_once("print-borderless-ac.php");?>
<body id="myBody">

<?php
if(isset($_GET['submit_pay']))
{
	$receipt_no = $_GET['receipt_no'];
	$pp_sl = $_GET['pp_sl'];
	$due_old = $_GET['due_old'];
	$paid_amount = $_GET['paid_amount'];
	$due_amount = $_GET['due_amount'];
	$user_id = $_SESSION['user_id'];

  resetCounter($con, 42, 'dd'); //  A_id (audit_tbl)

	/*------ START TRANSACTION ----------*/
	mysqli_autocommit($con, false);
	$flag = true;

	if(isset($paid_amount) && $paid_amount > 0 )
	{

	resetCounter($con, 13, 'dd'); // patient_transaction
	$tr_id = date("jmy").getCounter($con, 13);

	// UPDATE ON PATIENT_PAYMENT
	mysqli_query($con, "UPDATE patient_payment SET PP_paid = PP_paid + $paid_amount, PP_bal = '".$due_amount."' WHERE PP_receipt_no = '$receipt_no'");
	if(mysqli_affected_rows($con) < 0) {$flag = false; echo "Error: PATIENT_PAYMENT update".mysqli_error($con). ".";}

	// UPDATE ON PATIENT_TRANSACTION
	mysqli_query($con, "INSERT INTO patient_transaction(TR_id, TR_pp_sl, TR_amount, TR_date, TR_user) VALUES ('$tr_id', '$pp_sl', '".$paid_amount."', NOW(), '$user_id')");
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error : Transaction".mysqli_error($con). ".";}
else updateCounter($con, 13);


	/****************************
		A_book
 26   Patient Registration
 27   Patient Investigation
 28   Patient Discount
 29   Customer Profile
 30   Expenditure


 A_action
 21   swap
 22   Add
 23   Edit
 24   Cancel
 25   Status
 31   Payment
 33   Deleted
	******************************/
		 $A_id = date("jmy").getCounter($con, 42);
		 $remark = "Dues Received : Rs. ".$paid_amount;
		 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '31', '$receipt_no', '".$remark."', '$user_id', NOW())");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		  else updateCounter($con, 42);
	}

	if($flag){
		mysqli_commit($con);
		header("LOCATION: patient_investigation_status.php?receipt_no=$receipt_no&smsg=4");
			}
	else {
		mysqli_rollback($con);
		header("LOCATION: patient_investigation_status.php?receipt_no=$receipt_no&errmsg=4");
		}
	}
?>


<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">

  <!--  start loading.. -->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_main">

<?php
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $patient_info = mysqli_query($con, "SELECT r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_status_id, r.pr_dr_prescription, p.PI_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_phone, s.state_name, d.district_name, g.gender_name, m.marital_name, y.PP_sl, y.PP_total, y.PP_tax, y.PP_disc,  y.PP_net, y.PP_paid, y.PP_bal FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN  patient_payment y ON y.PP_receipt_no=r.pr_receipt_no WHERE r.pr_receipt_no = '$receipt_no'");

  while($row = mysqli_fetch_array($patient_info))
  {
  	$patient_name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];

	  $patient_id = $row['PI_id'];

	  $address = $row['PI_address'];
	  $pin_code = $row['PI_pin'];
  	$phone = $row['PI_phone'];

	  $gender_name = $row['gender_name'];
	  $marital_name = $row['marital_name'];
  	$state_name = $row['state_name'];
	  $district_name = $row['district_name'];

  	$pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	$pr_date = $row['pr_date'];
	  $pr_status_id = $row['pr_status_id'];
	  $dr_letter = $row['pr_dr_prescription'];

	  $PP_sl = $row['PP_sl'];
	  $total = $row['PP_total'];
	  $tax_option =  $row['PP_tax'];
	  $disc_option =  $row['PP_disc'];
	  $bal =  $row['PP_bal'];
	  $paid =  $row['PP_paid'];
	  $net = $row['PP_net'];

	  $disc_value=showDiscount_value($con, $receipt_no);
	  $tax_value=showTax_value($con, $receipt_no);
	  }
 ?>
<div class="panel panel-success" id="printableArea">
     <div class="panel-heading light_purple_color"><h3 class="panel-title">
     <i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp; Registration</span>
     <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right"><i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
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

<div class="panel-body" id="printableArea">
<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
      <td><label>Registration # : </label> <?php echo $receipt_no;?> (Status : <?php echo showStatus($con, $pr_status_id);?>)
        <input type="hidden" id="span_status" value="<?php echo $pr_status_id; ?>">
      </td>
      <td><label>Customer ID : </label> <?php echo $patient_id;?></td>
      <td><label><i class="fa fa-calendar"></i> : </label> <?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></td>
    </tr>

  <tr>
  <td colspan="2"><label>Name : </label> <?php echo $patient_name;?></td>
  <td><label><i class="fa fa-male"></i><i class="fa fa-female"></i> : </label> <?php echo $gender_name.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ( '. $marital_name.' )';?></td>
  </tr>

  <tr>
  <td><label>Address : </label>
  <?php if($pin_code !=""){$_pin = ' - '.$pin_code;}else{$_pin = "";} echo $address.', '.$district_name.', '.$state_name.$_pin; ?>
  </td>
   <td><label> <i class="fa fa-phone-square"></i> :</label> <?php if($phone !=""){ echo '+91 '.$phone;}?></td>
  </tr>

 <tr>
  <td><label>Dr. Letter : </label> <?php if($dr_letter =='NO'){echo "No";}else{echo "Yes";} ?></td>
  <td><label>Patient History : </label> <?php echo showHistory_patient($con, $patient_id); ?></td>
  <td><label>Lab Notes : </label> <?php echo showLab_note($con, $receipt_no); ?></td>
  </tr>

 <tr>
  <td><label>Referred By : </label> <?php if($dr_letter =='NO'){echo " Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_letter);} ?></td>

  <td><label>Source : </label>
  <?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?></td>
  </tr>
  </table>
  </div>

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100" id="status_table">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Investigation</th>
      <th class="blue_color"> Status <i class="fa fa-edit fa-fw"></i></th>
      <th class="text-right"> Amount</th>
      </tr>
   </thead>
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT t.PT_sl, t.PT_test_name, t.PT_test_price, s.status_name FROM patient_test t LEFT JOIN status_tbl s ON s.status_id = t.PT_status_id WHERE t.PT_receipt_no = '$receipt_no' AND t.PT_status_id !='3'");
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{
 	$PT_id = $charge['PT_sl'];
	$test_name = $charge['PT_test_name'];
	$test_price = $charge['PT_test_price'];
  $status_name = $charge['status_name'];
	?>
          <tr id="<?php echo $PT_id; ?>">
            <td> <?php echo $sl_no; ?> </td>
            <td> <?php echo $test_name; ?> </td>
            <td><?php echo $status_name; ?> </td>
            <td style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($test_price, 2, '.', ','); ?> </td>
          </tr>
       <?php
 $sl_no++;
}
?>
 </tbody>
 </table>
</div>
</div>

<!-- PAYMENT SUMMARY -->
<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100" id="status_table">
    <thead align="left">
    <tr>
    <th> Payment </th>
    <th> Date</th>
    <th>Login name (Full name)</th>
    <th style="text-align:right;">Amount</th>
    </tr>
    </thead>
  <tbody>

<!-- PAYMENT - received -->
<?php
$result2 = mysqli_query($con, "SELECT TR_amount, TR_date, TR_user FROM patient_transaction WHERE TR_pp_sl IN (select PP_sl FROM patient_payment WHERE PP_receipt_no = '$receipt_no')");
$sl_no1=1;
while ($row2 = mysqli_fetch_array($result2))
{
 	$TR_amount = $row2['TR_amount'];
	$TR_date = date("d-m-Y, h:i a", strtotime($row2['TR_date']));
	$TR_user = $row2['TR_user'];
	$user = showFull_login($con, $TR_user);
	?>
          <tr>
            <td><?php echo $sl_no1; ?> </td>
            <td><?php echo $TR_date; ?> </td>
            <td>Received By : <?php echo $user; ?> </td>
            <td style="text-align:right;"> <i class="fa fa-inr"></i> <?php echo $TR_amount; ?> </td>
          </tr>
       <?php
 $sl_no1++;
}
?>

<!-- PAYMENT - REFUND -->
<?php
$result3 = mysqli_query($con, "SELECT EX_person, EX_amount, EX_date, EX_user FROM expenditure WHERE EX_person = '$receipt_no'");
$sl_no2=$sl_no1;
if(mysqli_num_rows($result3) !=0){
while ($row3 = mysqli_fetch_array($result3))
{
 	$EX_person = $row3['EX_person'];
	$EX_amount = $row3['EX_amount'];
	$EX_date = date("d-m-Y, h:i a", strtotime($row3['EX_date']));
	$EX_user = $row3['EX_user'];
	$_EX_user = showFull_login($con, $EX_user);
	?>
          <tr>
            <td><?php echo $sl_no2; ?></td>
            <td><?php echo $EX_date; ?></td>
            <td>Refunded By : <?php echo $_EX_user; ?></td>
            <td style="text-align:right;"><i class="fa fa-inr"></i> <?php echo $EX_amount; ?></td>
          </tr>
       <?php
   $sl_no2++;
   }
}
?>
	<tr>
      <td colspan="4" class="italic_font padding_top10">
        <span class="padding_right2p">Sub-Total :  <i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ','); ?></span>
        <span class="padding_right2p">Tax <?php echo '('.$tax_value.'%)'; ?> : <i class="fa fa-inr"></i>
		<?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc;
			   echo number_format($tax_calc, 2, '.', ','); ?>
        </span>
        <span class="padding_right2p">Discount <?php if($disc_option ==1){ echo '('.$disc_value.')';} ?> : <i class="fa fa-inr"></i>
        <?php if($disc_option ==1)  // discount = Yes
				   	$disc_in_amt = showDiscount_in_amt($con, $receipt_no, $total_after_tax);
			  if($disc_option==2) // discount = NO
				    $disc_in_amt = "0.00";

			    echo number_format($disc_in_amt, 2, '.', ','); ?>
         </span>
        <span class="padding_right2p">Total : <i class="fa fa-inr"></i> <?php echo number_format($net, 2, '.', ','); ?></span>
        <span class="padding_right2p">Paid: <i class="fa fa-inr"></i> <?php echo number_format($paid, 2, '.', ','); ?></span>
        <span>Due : <i class="fa fa-inr"></i> <?php echo number_format($bal, 2, '.', ','); ?></span>
        </td>
      </tr>

<tr><td colspan="4">&nbsp;&nbsp;&nbsp;</td></tr>

<!--Pay balance amount -->
<tr class="no-print">
 <td colspan="4" style="padding: 15px;0px;">
  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_pay">
        <div class="form-control-group">
        <label for="paid_amount" class="col-lg-1 control-label">Collect</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Paid Dues" maxlength="10">
        <input type="hidden" id="due_old" name="due_old" value="<?php echo $bal; ?>">
        <input type="hidden" id="receipt_no" name="receipt_no" value="<?php echo $receipt_no; ?>">
        <input type="hidden" id="pp_sl" name="pp_sl" value="<?php echo $PP_sl; ?>">
        </div>
        </div>

        <div class="form-control-group">
        <label for="due_amount" class="col-lg-1 control-label">Due</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="due_amount" name="due_amount" value="<?php echo number_format($bal, 2, '.', ','); ?>" readonly>
        </div>
        </div>

        <div class="form-control-group">
        <div class="col-lg-2">
        <button type="submit" class="btn btn-primary" id="submit_pay" name="submit_pay">Pay</button>
        </div>
        </div>
  </form>
  </td>
  </tr>
  </tbody>
 </table>
</div>

<!-- CANCELLED TEST -->
<?php
$result_cancel = mysqli_query($con, "SELECT t.PT_sl, t.PT_test_name, t.PT_test_price, s.status_name FROM patient_test t LEFT JOIN status_tbl s ON s.status_id = t.PT_status_id WHERE t.PT_receipt_no = '$receipt_no' AND t.PT_status_id ='3'");
if(mysqli_num_rows($result_cancel) !='0'){
?>

<div class="row no-print" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100">
   <thead align="left">
      <tr>
      <th colspan="4"> Cancelled Investigation </th>
      </tr>
      <tr>
      <th> Sl. no. </th>
      <th> Investigation</th>
      <th> Status</th>
      <th class="text-right"> Amount</th>
      </tr>
   </thead>
  <tbody>
<?php
$sl_no1=1;
while ($row1 = mysqli_fetch_array($result_cancel))
{
	$test_name1 = $row1['PT_test_name'];
	$PT_test_price1 = $row1['PT_test_price'];
	$status_name1 = $row1['status_name'];
	?>
          <tr>
            <td><?php echo $sl_no1;?></td>
            <td><?php echo $test_name1;?></td>
            <td><?php echo $status_name1;?></td>
            <td style="text-align:right;"><i class="fa fa-inr"></i><?php echo number_format($PT_test_price1, 2, '.', ','); ?></td>
          </tr>
       <?php $sl_no1++; } ?>
 </tbody>
 </table>
 </div>
<?php } ?>


 </div>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php"); ?>
<?php require_once("script_print_bw_div.php");?>
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {

 var span_status = $('#span_status').val();
   if(span_status =='4'){$('#submit_pay').attr('disabled', true);}

$('#paid_amount').on('keyup', function() {
		var paid_amount = Number($('#paid_amount').val());
		var due_old = Number($('#due_old').val());
		var due_current = due_old - paid_amount;
		var due = due_current.toFixed(2);
		$('#due_amount').val(due);
		});

// ---- Submit - confirmation
$("#submit_pay").click(function(event) {
        if( !confirm('Are you sure ?'))
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#div_main').hide();
			  $('#divWait').show();
			}
		  });
	});

$("#form_pay").validate({
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
					   max: function(){ return Number($('#due_old').val());},
					},
			},
	messages: {
		paid_amount: { required: "",
					   number: "Oops ! Paid Amount should be numbers only",
					   min:'min.number is 0',
					   max: function(){ return 'Max.payable amount Rs. ' + Number($('#due_old').val());},
						},
			},
});


  $('#status_table').dataTable( {

  	"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
    "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter": false,
		"bInfo": false,

		"fnPreDrawCallback": function( oSettings ) {
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');
		  $('.dataTables_length select').css('margin-right', '3px');
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');  }
     }).makeEditable({
		sUpdateURL:   "patient_investigation_status_update.php",
		aoColumns: [
					null,
					null,
						{
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							width: '80%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							data: "{'1':'Pending','5':'Delivered','11':'Report Available','12':'Report Return'}",
							},

						null,
				],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Failed ! Status Update");
								//window.location.reload();
                                break;
                        }
                    },
    });
});
</script>
</body>
</html>
<?php } ob_flush();?>
