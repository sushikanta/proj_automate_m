<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Reason</title>
<?php require_once("css_bootstrap_header.php"); ?>

<?php  if(isset( $_GET['go_eid3']))
 		{
	 	 resetCounter($con, 42, 'dd');  // reset audit id
		 resetCounter($con, 29, 'dd');  // reset EXPENDITURE
		  $user_id=$_SESSION['user_id'];		  
		  $receipt_no = $_GET['receipt_no'];
		  $reason = $_GET['reason'];

		  $pp_sl = $_GET['pp_sl'];
		  $check_refund = $_GET['refund_option'];
  		  $refund_amount = $_GET['refund_amount'];

//-------------- START - TRANSACTION/ROLLBACK
mysqli_autocommit($con, false);
$flag = true;

// Delete all old trasation for cancellation
  mysqli_query($con, "DELETE FROM `patient_transaction` WHERE TR_pp_sl = '$pp_sl'");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error : Transaction Delete".mysqli_error($con). ".";}
	
//------------ UPDATE patient_registration
mysqli_query($con, "UPDATE patient_registration SET pr_status_id='4' WHERE pr_receipt_no ='$receipt_no'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_registration: " . mysqli_error($con) . ".";}
	
//-----UPDATE TO PATIENT PAYMENT
 mysqli_query($con, "UPDATE patient_payment SET PP_total = '0', PP_tax = '2', PP_disc = '2', PP_net = '0', PP_paid = '0', PP_bal = '0' WHERE PP_receipt_no = '$receipt_no'");
  if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: update Payment " .mysqli_error($con). ".";} 
  
   //-----UPDATE TO PATIENT test
 mysqli_query($con, "UPDATE patient_test SET PT_status_id = '3' WHERE PT_receipt_no = '$receipt_no'");
 if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: update patient_test " .mysqli_error($con). ".";}
 
 /****************************
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile
 
 22 	Add
 23 	Edit
 24 	Cancel - TEST
 25 	Status 
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '26', '4', '$receipt_no', '$reason', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

if($check_refund =="Y")
      {
         // REFUND - expenditure
           $EX_id = date("ynj").getCounter($con, 29);
           $voucher = 'SG'.$EX_id;
           $remark1 = 'Cancelled : Registration # '.$receipt_no.' ( Reason'.$reason.' )';
            mysqli_query($con, "INSERT INTO expenditure(EX_id, EX_voucher, EX_particular, EX_person, EX_amount, EX_date, EX_user) VALUES ('$EX_id', '".$voucher."', '".$remark1."', '".$receipt_no."', '".$refund_amount."', NOW(), '$user_id')");
          if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: Expenditure" . mysqli_error($con) . ".";}//{ $flag = false; echo "Error details: update < only " . mysqli_error($con) . ".";}
            else updateCounter($con, 29);

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
           $A_id = date("ynj").getCounter($con, 42);
           mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '27', '24', '$receipt_no', '".$remark1."', '$user_id', NOW())");
            if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl" .mysqli_error($con). ".";}
            else updateCounter($con, 42);
      }


	if($flag){
			mysqli_commit($con);
			header("LOCATION: patient_registration_status_admin.php?receipt_no=$receipt_no");			
			}
	 else 
			{
			mysqli_rollback($con);	
			echo " ! ".mysqli_error($con); http_response_code(404);
			}
 }
?>

 
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">
 
 <!------------- loading.. ------------>
  <div id="divWait" style="display: none;" class="row text-center">
  <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_hide">

<?php
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $pp_sl = $_GET['pp_sl'];
 ?>

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Reason <span class="panel-subTitle"> ( for Cancellation ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    
    <!----- ERROR DIV -->
    <div class="row error pull-right" style="display:none; margin-right:34%; color:red; font-size:13px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error" class="span-error"></span><br clear="all">
      
      </div>
    </h3>
    </div>

<!----------- ROW 1 reg ------>
<div class="row" style="padding-bottom:200px;">
 <form  role="form" method="get" class="form-horizontal inv-form" id="form_reason">
       <div class="form-group" style="margin-top:30px;">
        <div class="form-control-group">
        <label for="reason" class="col-lg-3 control-label"></label>
        <div class="col-lg-6">
        <textarea class="form-control" id="reason" name="reason" placeholder="Reason for Cancellation - Registration # <?php echo $receipt_no; ?> "></textarea>
        <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>">
        <input type="hidden" name="pp_sl" value="<?php echo $pp_sl;?>">
        </div>
        </div>
        </div>

<div class="form-group">
        <div class="form-control-group" style="line-height: 1.997779;"> 
        <label for="refund_option" class="col-lg-4  text-right control-label"> Refund to Customer ?</label>
        <div class="col-lg-2">                
        <label for="refund_yes" class="radio-inline col-lg-1" style="padding-right:40px;">
        <input  type="radio" name="refund_option" class="form-control" id="refund_yes" value ="Y" checked>Yes
        </label>
        <label for="refund_no" class="radio-inline col-lg-1" style="padding-right:30px;">
        <input type="radio" name="refund_option" class="form-control" id="refund_no" value ="N">No
        </label>
        </div>
        </div>
       
        <div class="form-control-group" id="div_refund">          
        <label for="refund_amount" class="col-lg-1 text-right control-label">Amount</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="refund_amount" name="refund_amount" placeholder="Refund Amount" maxlength="10">
        
        </div>
        </div>
</div>

    <div class="form-group padding_top30">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="go_eid3" name="go_eid3">Confirm Cancellation & Submit</button>
    </div>
    </div>
    
 </form>      
</div>
          
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php");?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

/*--------------- show/hide of refund amount div --------------------------*/
  $("#refund_yes, #refund_no").click(function () {
    if ($('input[name=refund_option][value=Y]').prop("checked")) { $('#div_refund').show();}
    if ($('input[name=refund_option][value=N]').prop("checked")) { $('#div_refund').hide();}
    });      
    
    if ($('input[name=refund_option][value=Y]').prop("checked")) { $('#div_refund').show();}
    if ($('input[name=refund_option][value=N]').prop("checked")) { $('#div_refund').hide(); $('#refund_amount').val('0');}


$("#go_eid3").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  //$(':submit', this).attr('disabled', 'disabled');
			  $('#div_hide').hide();
			  $('#divWait').show();
			  //$('#divWait').fadeOut(2000);
			}
		  });
	});
	
	$("#form_reason").validate({
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
					  ? 'You missed 1 field. Highlighted - '
					  : 'You missed ' + errors + ' fields. Highlighted - ';
					  $("div.error").show().delay(3000).fadeOut("medium");
					  $("div.error span").html(message);
					  $("div.err").hide();
					  $("div.err span").hide();
					  $("#page_date").hide();
					  return false;
					  
					  /*$("div.errors").hide();
					  $("div.errors span").hide();*/  } 
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},
	
rules: {
		reason: { required: true,
						minlength: 5,
						maxlength: 100 },

		refund_amount: { required: function(){
                   			if ($('input[name=refund_option][value=N]').prop("checked")){return false;}
                   			if ($('input[name=refund_option][value=Y]').prop("checked")){return true;}
                               },
						  number: true,
						  minlength: 1,
						  min:0,					  
					   },
		},
		
messages: {
		reason: { required: 'Can not be blank',
				  minlength: 'Min.5 Character',
				  maxlength: 'Max.100 Character' },
		refund_amount: { required: "",
					     number: "Oops ! Refund Amount should be numbers only",				   
						},	
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
<?php } ob_flush();?>