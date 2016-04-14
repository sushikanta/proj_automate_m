<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Doctor</title>
<?php require_once("css_bootstrap_header.php"); ?>
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
 <div class="container">
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
 <div class="page-content" id="div_main">

<?php
if(isset($_GET['dr_submit']))
{
	resetCounter($con, 2, 'yy'); // dr_info

   $dr_id = date('y').getCounter($con, 2);

   $dr_name = ucwords(mysqli_real_escape_string($con, $_GET['dr_name']));
   $dr_gender = $_GET['dr_gender'];
   $dr_dob = date("Y-m-d", strtotime($_GET['dr_dob']));
   $dr_marital = $_GET['dr_marital'];

   $dr_phone = mysqli_real_escape_string($con, $_GET['dr_phone']);
   $dr_email = mysqli_real_escape_string($con, $_GET['dr_email']);
   $same_address = mysqli_real_escape_string($con, $_GET['same_address']);

	 $address = ucwords(mysqli_real_escape_string($con, $_GET['permanent_address']));
	 $state_id = mysqli_real_escape_string($con, $_GET['hidden_permanent_state']);
	 $district_id=$_GET['hidden_permanent_district'];
	 $pin=$_GET['permanent_pin'];


	 /*------------ TRANSACTION - START ------------*/
	  mysqli_autocommit($con, false);
	  $flag = true;

	  mysqli_query($con, "INSERT INTO dr_info(dr_id, dr_name, dr_phone, dr_email, dr_dob, dr_address, dr_state, dr_district, dr_pin, dr_gender, dr_marital) VALUES ('$dr_id', '".$dr_name."', '".$dr_phone."', '".$dr_email."', '".$dr_dob."', '".$address."', '$state_id', '$district_id', '".$pin."', '$dr_gender', '$dr_marital')");
	  if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: dr_info" . mysqli_error($con) . ".";}
	 else updateCounter($con, 2);


  if($same_address == "2")    //same address = no
	{
	  resetCounter($con, 44, 'yy'); // dr_current_address

	  $present_address = ucwords(mysqli_real_escape_string($con, $_GET['present_address']));
	  $present_state_id = mysqli_real_escape_string($con, $_GET['hidden_present_state']);
	  $present_district_id=mysqli_real_escape_string($con, $_GET['hidden_present_district']);
	  $present_pin=mysqli_real_escape_string($con, $_GET['present_pin']);

	  $DCA_id = date('y').getCounter($con, 44);
	  mysqli_query($con, "INSERT INTO dr_cur_address(DCA_id, DCA_dr_id, DCA_address, DCA_state, DCA_district, DCA_pin) VALUES ('$DCA_id', '$dr_id', '".$present_address."', '$present_state_id', 'present_district_id', '".$present_pin."')");
	  if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: dr_cur_address" . mysqli_error($con) . ".";}
	 else updateCounter($con, 44);
	 }

	 $work_info = mysqli_real_escape_string($con, $_GET['work_info']);

	 if($work_info == '1'){

		resetCounter($con, 43, 'yy'); // dr_current_address
		$dr_specialization = ucwords(mysqli_real_escape_string($con, $_GET['dr_specialization']));
		$dr_designation = ucwords(mysqli_real_escape_string($con, $_GET['dr_designation']));
		$dr_institute = ucwords(mysqli_real_escape_string($con, $_GET['dr_institute']));
		$dp_id = date('y').getCounter($con, 43);

	    mysqli_query($con, "INSERT INTO dr_profile(dp_id, dp_dr_id, dp_specialization, dp_designation, dp_institute) VALUES ('$dp_id', '$dr_id', '".$dr_specialization."', '".$dr_designation."', '".$dr_institute."')");
	if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: dr_profile " . mysqli_error($con) . ".";}
	 else updateCounter($con, 43);
	 }

// TRANSACTION - ROLL BACK
		if($flag){
			mysqli_commit($con);
			header("location: doctor_table.php");
			}
		else {
			mysqli_rollback($con);
			echo "Action failed"; http_response_code(404); }
}
?>

<div class="inv-main">
<form class="form-horizontal inv-form" role="form" method="get" action="#">
 <div class="panel panel-success"> <!-----------------START Doctor Information-------------->
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Doctor ) </span>
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

    <!-----ROW 1 -- -->
    <div class="form-group">

       <div class="form-control-group">
        <label for="inputDoctor_name" class="col-lg-2 control-label">Name - Dr.</label>
        <div class="col-lg-3">
            <input type="text" class="form-control capital" name="dr_name" placeholder="Doctor's name" autofocus maxlength="50" required>
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputDoctor_dob" class="col-lg-2 control-label">Date of Birth</label>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="dr_dob" name="dr_dob" value="<?php echo date("d-m-Y"); ?>" readonly>
        </div>
        </div>
        </div>

        <!-----ROW 2 -- -->
       <div class="form-group">
       <div class="form-control-group">
        <label for="inputDoctor_gender" class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-3">
        <label class="radio-inline">
            <input  type="radio" name="dr_gender" value="1">Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="dr_gender" value="2">Female
        </label>
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputDoctor_marital" class="col-lg-2 control-label">Marital Status</label>
        <div class="col-lg-3">
        <select class="form-control" name="dr_marital">
          <option value=""> Select</option>
        <?php
		$result_marital = mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl WHERE marital_id != '6' AND marital_id != '7'");
		while($marital = mysqli_fetch_array($result_marital))
		 {
		 	$name=$marital['marital_name'];
          	$id=$marital['marital_id'];
		 ?>
          <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
        <?php }?>
          </select>
        </div>
        </div>
    </div>

     <!-----ROW 3 -- -->
    <div class="form-group">
        <div class="form-control-group">
        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-3">
        	<input type="email" class="form-control" name="dr_email" placeholder="sample@email.com" maxlength="40">
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputContact" class="col-lg-2 control-label">Contact No.</label>
        <div class="col-lg-3">
        	<input type="text" class="form-control" name="dr_phone" placeholder="Contact No." maxlength="10">
        </div>
        </div>
        </div>

         <div class="form-group">
        <div class="form-control-group">
        <label for="work_info" class="col-lg-2 control-label">Work Info ?</label>
            <div class="col-lg-3">
                  <label class="radio-inline">
                    <input  type="radio" name="work_info" id="work_yes" value="1" checked>Yes
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="work_info" id="work_no" value="2">No
                  </label>
            </div>
            </div>
          </div>


     <!-----ROW 4 -- -->
    <div class="form-group" id="div_work">
    	 <div class="form-control-group">
        <label for="inputInstitute" class="col-lg-2 control-label">Working at</label>
        <div class="col-lg-3">
        	<input type="text" class="form-control capital" name="dr_institute" placeholder="Institute/Hospital/Clinic" maxlength="50">
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputDesignation" class="col-lg-1 control-label">Position</label>
        <div class="col-lg-2">
        	<input type="text" class="form-control capital" name="dr_designation" placeholder="Designation" maxlength="50">
        </div>
        </div>



        <div class="form-control-group">
        <label for="inputSpecialization" class="col-lg-1 control-label">Dept/Spec</label>
        <div class="col-lg-2">
        	<input type="text" class="form-control capital" name="dr_specialization" placeholder="Specialization" maxlength="50">
        </div>
        </div>
        </div>

         <div class="form-group">
        <div class="form-control-group">
        <label for="radioCheckAddress" class="col-lg-2 control-label">Stay at same address ?</label>
            <div class="col-lg-3">
                  <label class="radio-inline">
                    <input  type="radio" name="same_address" id="same_address_yes" value="1" checked>Yes
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="same_address" id="same_address_no" value="2">No
                  </label>
            </div>
            </div>
      </div>

<!-----------------------Present Address-  ---------->
          <div class="form-group" id="presentAddress_div">
               <div class="form-control-group">
               <label for="inputPresent_address" class="col-lg-1-6 control-label">Address 1</label>
                  <div class="col-lg-3">
                   <input type="text" class="form-control capital" id="present_address" name="present_address" placeholder="Temporary Address" maxlength="50">
                  </div>
                  </div>
               <div class="form-control-group">
               <label for="inputpresent_state" class="col-lg-1-4 control-label">State</label>
                  <div class="col-lg-2-0">
                   <input type="text" class="form-control capital" id="present_state" name="present_state" placeholder="State" value="Manipur" >
                   <input type="hidden" class="form-control" id="hidden_present_state" name="hidden_present_state" value="1">
                  </div>
                  </div>

                  <div class="form-control-group">
                 <label for="inputpresent_state" class="col-lg-1-3 control-label">District</label>
                <div class="col-lg-1-5">
                    <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="District">
                    <input type="hidden" class="form-control" id="hidden_present_district" name="hidden_present_district" >
                  </div>
                  </div>
                 <div class="form-control-group">
                 <label for="inputpresent_pin" class="col-lg-1-3 control-label">PIN</label>
                <div class="col-lg-1-4">
                  <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN" maxlength="6">
                </div>
          </div>
          </div>

<!------------------- permanet Address---------->
     <div class="form-group control-group" id="permanentAddress_div">
               <label for="inputpermanent_address" class="col-lg-1-6 control-label">Address 2</label>
                  <div class="col-lg-3">
                   <input type="text" class="form-control capital" id="permanent_address" name="permanent_address"  placeholder="permanent Address" maxlength="50">
                  </div>
               <label for="inputpermanent_state" class="col-lg-1-4 control-label">State</label>
                  <div class="col-lg-2-0">
                   <input type="text" class="form-control capital" id="permanent_state" name="permanent_state"  placeholder="State" value="Manipur">
                   <input type="hidden" class="form-control" id="hidden_permanent_state" name="hidden_permanent_state" value="1" >

                  </div>
                 <label for="inputpermanent_state" class="col-lg-1-3 control-label">District</label>
                <div class="col-lg-1-5">
                    <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="District">
                    <input type="hidden" class="form-control" id="hidden_permanent_district" name="hidden_permanent_district" >

                  </div>
                 <label for="inputpermanent_pin" class="col-lg-1-3 control-label">PIN</label>
                <div class="col-lg-1-4">
                  <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN" maxlength="6">
                </div>
          </div>
        </div>

      <div class="form-group">
        <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="dr_submit" name="dr_submit" style="font-size:16px;">Submit</button>
        </div>
      </div>
</form> <!--------------  form end  -------------->

<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<script type="text/javascript">
$(document).ready(function() {

/*-------------- Autocomplete Permanent -------------*/

		$('#permanent_state').autocomplete({
		  source:'autocomplete_state.php',
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#permanent_state').val("");
					    $('#hidden_permanent_state').val("");
						return false; }
				   else
					  { $('#permanent_state').val(ui.item.value);
					    $('#hidden_permanent_state').val(ui.item.state_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });

		$("#permanent_district").autocomplete({
		minLength:0,
		scroll:true,
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_permanent_state").val() },
					 success: function(data) { response(data); }
				}); },
		 change: function (event, ui){
		 		  if (ui.item == null)
				     { $('#permanent_district').val("");
					   $('#hidden_permanent_district').val("");
					   return false; }
				  else
				     { $('#permanent_district').val(ui.item.value);
					   $('#hidden_permanent_district').val(ui.item.district_id);
					   return false; }
			}
        }).focus(function() {
                $(this).autocomplete("search");
            });


		$('#present_state').autocomplete({
		  source:'autocomplete_state.php',
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#present_state').val("");
					    $('#hidden_present_state').val("");
						return false; }
				   else
					  { $('#present_state').val(ui.item.value);
					    $('#hidden_present_state').val(ui.item.state_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });

		$("#present_district").autocomplete({
		minLength:0,
		scroll:true,
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_present_state").val() },
					 success: function(data) { response(data); }
				}); },
		 change: function (event, ui){
		 		  if (ui.item == null)
				     { $('#present_district').val("");
					   $('#hidden_present_district').val("");
					   return false; }
				  else
				     { $('#present_district').val(ui.item.value);
					   $('#hidden_present_district').val(ui.item.district_id);
					   return false; }
			}
        }).focus(function() {
                $(this).autocomplete("search");
            });




/*-------show/Hide ADDRESS-------*/

if($('#same_address_yes').is(':checked'))
      { $('#presentAddress_div').hide(); }
if($('#same_address_no').is(':checked'))
	  { $('#presentAddress_div').show(); }

$("#same_address_yes, #same_address_no").click(function () {
	  if($('input[name=same_address][value=1]').prop("checked")) {
		  $('#presentAddress_div').slideUp('fast'); }
     if($('input[name=same_address][value=2]').prop("checked")) {
          $('#presentAddress_div').slideDown('fast'); }
  });


  /*-------show/Hide  WORK --------*/

if($('#work_yes').is(':checked'))
      { $('#div_work').show();}
 if($('#work_no').is(':checked'))
 	{ $('#div_work').hide();}

$("#work_yes, #work_no").click(function () {
	  if( $('input[name=work_info][value=1]').prop("checked")) {
		  $('#div_work').slideDown('fast'); }
     if ( $('input[name=work_info][value=2]').prop("checked")) {
          $('#div_work').slideUp('fast'); }
  });

$( "#dr_dob").datepicker({   //Dr. DOB
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 100 years ago
dateFormat: "dd-M-yy",
   });


$("#dr_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?'))
            event.preventDefault();
$('form').submit(function () {
        
        $('#div_main').hide();
        $('#divWait').show();
   
});

	});



});

</script>

</body>
</html>
<?php ob_flush() ?>