<?php require_once("check_login_admin.php");
	 resetCounter($con, 33, 'mm');	// card holder DH_id
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Discount</title>
<?php require_once("css_bootstrap_header.php");?>
</head>

<?php
if(isset($_GET['submit'])){

	$pi_card = $_GET['pi_card'];
	$patient_id=$_GET['patient_id'];

	if($pi_card==1){
	$disc_value = $_GET['disc_value'];
	$valid_from = date("Y-m-d", strtotime($_GET['valid_from']));
	$validity = $_GET['validity'];
	$user_id=$_SESSION['user_id'];
	$DH_id=$_GET['DH_id'];
	}
	$empty = $_GET['empty'];

	/*------------  START - TRANSACTION  ---------*/
	mysqli_autocommit($con, false);
	$flag = true;

 if ($empty =='Y'){  // no record on discount_tbl

	if ($pi_card =='1'){  // Active
	 //INSERT card_holder
	mysqli_query($con, "INSERT INTO card_holder(DH_id, DH_patient_id, DH_disc_per, DH_validity, DH_date, DH_user) VALUES ('$DH_id', '$patient_id', '".$disc_value."', '$validity', '".$valid_from."', '$user_id')");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: syntex".mysqli_error($con);}
	else if(mysqli_affected_rows($con) == 0) { $flag = false; echo "Error: Dup".mysqli_error($con);}
	else updateCounter($con, 33);

	//UPDATE patient_info
	mysqli_query($con, "UPDATE patient_info SET PI_card = '1' WHERE PI_id = '$patient_id'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in patient_info";}
	}
 }

 if ($empty =='N'){	// Yes record on card_holder

	//UPDATE patient_info
	mysqli_query($con, "UPDATE patient_info SET PI_card = '$pi_card' WHERE PI_id = '$patient_id'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in patient_info";}

	if ($pi_card =='1'){ // Active
	//UPDATE card_holder
	mysqli_query($con, "UPDATE card_holder SET DH_disc_per = '$disc_value', DH_validity = '$validity', DH_date='".$valid_from."', DH_user='$user_id' WHERE DH_id = '$DH_id'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error in card_holder";}
   }

 }
	/*---------------- ---TRANSACTION-ROLLBACK ----------------*/
	if($flag){
			mysqli_commit($con);
			//header("location: discount_table.php");
			//echo 'done';
			} else {
			mysqli_rollback($con);
			echo "Action is failed"; http_response_code(404);
		}
}
?>

<?php
if(isset($_GET['patient_id']) && $_GET['patient_id'] !="")
{
 $patient_id_x = $_GET['patient_id'];

$patient_info = mysqli_query($con, "SELECT p.PI_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_date, p.PI_phone,  p.PI_card, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_info p LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE p.PI_id = '$patient_id_x'");

if (mysqli_num_rows($patient_info)!=0){

while($row = mysqli_fetch_array($patient_info))
  {
	  $PI_id = $row['PI_id'];
	  $PI_name = $row['PI_name'];
	  $PI_age_y = $row['PI_age_y'];
	  $PI_age_m = $row['PI_age_m'];
	  $PI_age_d = $row['PI_age_d'];
	  $gender_name = $row['gender_name'];

  	  $PI_address = $row['PI_address'];
	  $state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  $PI_pin = $row['PI_pin'];
	  $PI_phone = $row['PI_phone'];
	  $PI_date = $row['PI_date'];
	  $PI_card = $row['PI_card'];

	  $marital_name = $row['marital_name'];
	  }
?>

<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">

 <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>

 <div class="page-content"  id="div_inprocess">
   <div class="inv-main">
	<div class="panel panel-success">

  <div class="panel-heading light_purple_color">
  <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Patient Info
  <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  </h3>
  </div>

 <div class="panel-body">
 	<!---------------- ROW 1 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Customer ID :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control">CD/<?php echo $PI_id;?></span>
        </div>
        </div>

        <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right">DATE : </label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  <?php echo $PI_date;?></span>
          </div>
          </div>
    </div>


    <!---------------- ROW 2 ---------------->
    <div class="row">
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Name :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo $PI_name;?></span>
        </div>
        </div>



     <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  <?php echo $gender_name.' / '.show_age_long($con, $PI_age_y, $PI_age_m, $PI_age_d).' ('.$marital_name.')';?></span>
          </div>
          </div>
    </div>

   <!---------------- ROW 3 ---------------->
   <div class="row">
      <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Address :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo $PI_address.'<br/>'.$district_name.', '.$state_name;?> <?php if($PI_pin != ""){echo " - ".$PI_pin;} ?></span>
        </div>
        </div>

      <div class="form-control-group">
          <label for="inputSex" class="col-lg-1 control-label text-right"><i class="fa fa-phone"></i> :</label>
          <div class="col-lg-2">
          <span class="input-xlarge uneditable-input text-control">  +91 <?php echo $PI_phone;?></span>
          </div>
          </div>

     </div>

      <!---------------- ROW 3 ---------------->
   <div class="row">
      <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Type :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo showPatient_type($con, $PI_card); ?></span>
        </div>
        </div>

     </div>
     </div>
</div>


<!--------------Card Add/Edit -------------->
<div class="panel panel-success">

 <form class="form-horizontal inv-form" role="form" method="get" action="#" id="myform">
  <div class="panel-heading light_purple_color">

  <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Card Holder <span class="panel-subTitle">( Add / Edit / Remove )</span></h3>
  </div>

  <?php
	$check = mysqli_query($con, "SELECT DH_id, DH_disc_per, DH_validity, DH_date, DH_user FROM card_holder WHERE DH_patient_id = '$patient_id_x'");

	if (mysqli_num_rows($check)==0){
			$DH_id = date("yn").getCounter($con, 33);
			$DH_disc_per = "";
			$DH_validity = "";
			$DH_date = date("d-M-Y");
			$empty='Y';
		 }
	 else{
	 		while($row_check = mysqli_fetch_array($check)){
			  $DH_id = $row_check['DH_id'];
			  $DH_disc_per = $row_check['DH_disc_per'];
			  $DH_validity = $row_check['DH_validity'];
			  $DH_date = date("d-M-Y", strtotime($row_check['DH_date']));
			  $empty='N';
			}
		}
  ?>

   <div class="form-group">
   <div class="form-control-group">
    <label for="card_no" class="col-lg-4 control-label">Card Number # </label>
    <div class="col-lg-4">
    <input type="text" class="form-control" id="card_no" name="card_no" value="<?php echo 'DH/'.$DH_id; ?>" readonly>

    <input type="hidden" id="empty" name="empty" value="<?php echo $empty; ?>">
    <input type="hidden" id="DH_id" name="DH_id" value="<?php echo $DH_id; ?>">
    <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id_x; ?>">
    </div>
   </div>
   </div>

    <div class="form-group">
    <div class="form-control-group">
    <label for="disc_type" class="col-lg-4 control-label">Card Status </label>
    <div class="col-lg-8">
    <label for="pi_card_yes" class="radio-inline col-lg-2">
    <input type="radio" name="pi_card" class="pi_card_yes" value='1' id="pi_card_yes" checked <?php if($PI_card == '1'){echo "checked";} ?>> Active
    </label>
    <label for="pi_card_no" class="radio-inline col-lg-2" style="margin-left:30px;">
    <input type="radio" name="pi_card" class="pi_card_no" value='2' id="pi_card_no" <?php if($PI_card == '2'){echo "checked";} ?>> Disable
    </label>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="form-control-group">
      <label for="disc_value" class="col-lg-4 control-label">Discount (%)</label>
        <div class="col-lg-4">
          <input type="text" class="form-control" placeholder="e.g. 10" name="disc_value" id="disc_value" value="<?php echo $DH_disc_per;?>" required>
        </div>
        </div>
    </div>

    <div class="form-group">
    <div class="form-control-group">
      <label for="valid_from" class="col-lg-4 control-label">Valid From</label>
        <div class="col-lg-4">
          <input type="text" class="form-control" placeholder="Date" name="valid_from" id="valid_from" value="<?php echo $DH_date;?>" required readonly>
        </div>
        </div>
    </div>

    <div class="form-group">
    <div class="form-control-group" id="div_validity">
    <label for="validity" class="col-lg-4 control-label">Validity</label>
    <div class="col-lg-4">
    <select class="form-control" name="validity" id="validity">
    <option value="" class="option_select">Select</option>
    <?php
    $result=mysqli_query($con, "SELECT CV_id, CV_validity FROM card_validity");
    while($row=mysqli_fetch_array($result))
    {
     ?>
      <option value="<?php echo $row['CV_id'];?>" class="option_select" <?php if($row['CV_id'] == $DH_validity){echo "selected";}?>><?php echo $row['CV_validity'];?></option>
     <?php
    }
    ?>
    </select>
    </div>
    </div>
    </div>

    <div class="form-group">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="hidden" class="btn btn-primary btn-block" id="create_disc" name="submit" style="font-size:16px;">Create Discount</button>
       </div>
  </div>
</form>
 </div>

<div class="clear"></div>
</div>

<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>

<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {

	 // CLICK ON CARD STATUS
	 $("#pi_card_no, #pi_card_yes").click(function () {

	if ($('input[name=pi_card][value=1]').prop("checked")) {
		$('#disc_value, #valid_from, #validity').attr('disabled', false);}
	if ($('input[name=pi_card][value=2]').prop("checked")) {
		$('#disc_value, #valid_from, #validity').attr('disabled', true);
		$("#disc_value").val("");
		$("#valid_from").val("");
		$("#validity").val("");
		}
	 });

	 // Not click
	if ($('input[name=pi_card][value=1]').prop("checked")) {
		 $('#disc_value, #valid_from, #validity').attr('disabled', false);}
	if ($('input[name=pi_card][value=2]').prop("checked")) {
		$('#disc_value, #valid_from, #validity').attr('disabled', true);
		$("#disc_value").val("");
		$("#valid_from").val("");
		$("#validity").val("");
	}


// DATE
$("#valid_from" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-3:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

	// SUBMIT
	$("#create_disc").click(function(event) {
	   if( !confirm('Are you sure to submit ?'))
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {

			  $('#div_inprocess').hide();
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

	card_no: {required: true},
	pi_card: {required: true},

    disc_value: { required: function(){
						   if ($('input[name=pi_card][value=1]').prop("checked")) { return true; }  // yes
					       if ($('input[name=pi_card][value=2]').prop("checked")) { return false; }  // no
					  		},
				 number:function(){
						   if ($('input[name=pi_card][value=1]').prop("checked")) { return true; }  // yes
					      if ($('input[name=pi_card][value=2]').prop("checked")) { return false; }  // no
				  			},
				 },

	valid_from: {required: true},
	validity:{required: true},
},

messages: {
			card_no: "",
			pi_card: "",
			disc_value: "",
			valid_from: "",
			validity: "",
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
<?php } else{echo "Unknown Customer No. !";} } ob_flush(); ?>