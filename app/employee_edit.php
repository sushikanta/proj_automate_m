<?php require_once("check_login_hr.php");
resetCounter($con, 39, 'yy');
resetCounter($con, 40, 'yy');
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Employee</title>
 <?php include("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_hr.php");?>

<div class="container">

 <div class="page-content">

<?php
if(isset($_GET['emp_submit']))
{

	 $emp_name = ucwords($_GET['emp_name']);
	 $emp_dob = date("Y-m-d", strtotime($_GET['emp_dob']));
	 $emp_gender = $_GET['emp_gender'];
	 $emp_marital = $_GET['emp_marital'];
	 $emp_email = $_GET['emp_email'];
	 $emp_phone = $_GET['emp_phone'];
	 $emerergency_phone = $_GET['emerergency_phone'];
	 $perm_address = ucwords($_GET['permanent_address']);
	 $perm_state = $_GET['hidden_permanent_state'];
	 $perm_district=$_GET['hidden_permanent_district'];
	 $perm_pin = $_GET['permanent_pin'];

	  $current_address_q = $_GET['current_address_q'];
	  $ei_id = $_GET['ei_id'];
      $cur_address_id = $_GET['cur_address_id'];



	  /*------------ TRANSACTION - START ------------*/
	  mysqli_autocommit($con, false);
	  $flag = true;

	 mysqli_query($con, "UPDATE `emp_info` SET `EI_name`='".$emp_name."', `EI_dob`='".$emp_dob."', `EI_gender`='$emp_gender', `EI_marital`='$emp_marital', `EI_email`='$emp_email', `EI_phone`='".$emp_phone."', `EI_emergency`='".$emerergency_phone."', `EI_address`='".$perm_address."', `EI_state`='$perm_state', `EI_district`='$perm_district', `EI_pin`='".$perm_pin."' WHERE EI_id = '$ei_id'");
	 if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: emp_info" . mysqli_error($con) . ".";}

	 // present address = Yes & no record in current address tbl
	 if($current_address_q ==1 && $cur_address_id ==""){
		 resetCounter($con, 40, 'yy');
		 $cur_address = ucwords($_GET['present_address']);
	 	 $cur_state = $_GET['hidden_present_state'];
	     $cur_district=$_GET['hidden_present_district'];
	     $cur_pin = $_GET['present_pin'];
		 $ECA_id = date("y").getCounter($con, 40);

		 mysqli_query($con, "INSERT INTO `emp_cur_address`(`ECA_id`, `ECA_ei_id`, `ECA_address`, `ECA_state`, `ECA_district`, `ECA_pin`) VALUES ('$ECA_id', '$ei_id',  '".$cur_address."', '$cur_state', '$cur_district', '".$cur_pin."')");
		 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_cur_address`" . mysqli_error($con) . ".";}
			else updateCounter($con, 40);
		 }

	// present address = Yes & Record in current address tbl
	if($current_address_q ==1 && $cur_address_id !=""){
		 $cur_address = ucwords($_GET['present_address']);
	 	 $cur_state = $_GET['hidden_present_state'];
	     $cur_district=$_GET['hidden_present_district'];
	     $cur_pin = $_GET['present_pin'];

		 mysqli_query($con, "UPDATE `emp_cur_address` SET `ECA_address`='".$cur_address."',`ECA_state`='$cur_state', `ECA_district`='$cur_district', `ECA_pin`='".$cur_pin."' WHERE `ECA_id` ='$cur_address_id'");
		 if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: `emp_cur_address`" . mysqli_error($con) . ".";}
		 }


	  // present address = NO & Record in current address tbl
	 if($current_address_q ==2 && $cur_address_id !=""){
	 	mysqli_query($con, "DELETE FROM `emp_cur_address` WHERE `ECA_id` ='$cur_address_id'");
		 if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: `emp_cur_address`" . mysqli_error($con) . ".";}
	 }


	// TRANSACTION - ROLL BACK
		if($flag){
			mysqli_commit($con);
			header("location: employee_view.php?ei_id=$ei_id"); }
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404); }
}
?>

<?php
if(isset($_GET['ei_id']) && $_GET['ei_id'] !="")
	{
 		$ei_id = $_GET['ei_id'];

 $result1 = mysqli_query($con, "SELECT e.EI_name, e.EI_dob, e.EI_email, e.EI_gender, e.EI_marital, e.EI_phone, e.EI_emergency, e.EI_address, e.EI_district, e.EI_state, e.EI_pin, c.ECA_id, c.ECA_ei_id, c.ECA_address, c.ECA_district, c.ECA_state, c.ECA_pin, s.state_name AS perm_state, d.district_name AS perm_district, s1.state_name AS cur_state, d1.district_name AS cur_district FROM emp_info e LEFT JOIN emp_cur_address c ON e.EI_id = c.ECA_ei_id LEFT JOIN state_tbl s ON s.state_id = e.EI_state LEFT JOIN district_tbl d ON d.district_id = e.EI_district LEFT JOIN state_tbl s1 ON s1.state_id = c.ECA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.ECA_district WHERE e.EI_id = '$ei_id'");
if(mysqli_num_rows($result1) !=0){
  while($row1 = mysqli_fetch_array($result1))
  {
  	  $EI_name = $row1['EI_name'];
	  $EI_dob = date("d-M-Y", strtotime($row1['EI_dob']));
	  $EI_gender = $row1['EI_gender'];
	  $EI_marital = $row1['EI_marital'];
	  $EI_email = $row1['EI_email'];

	  $EI_phone = $row1['EI_phone'];
	  $EI_emergency = $row1['EI_emergency'];
  	  $EI_address = $row1['EI_address'];

	  $perm_state_id = $row1['EI_state'];
	  $perm_state = $row1['perm_state'];
	  $perm_district = $row1['perm_district'];
	  $perm_district_id = $row1['EI_district'];
  	  $EI_pin = $row1['EI_pin'];

	  $ECA_id = $row1['ECA_id'];
	  if($ECA_id !="")
	  	{
		  $ECA_address = $row1['ECA_address'];
		  $cur_state_id = $row1['ECA_state'];
		  $cur_state = $row1['cur_state'];
		  $cur_district = $row1['cur_district'];
		  $cur_district_id = $row1['ECA_district'];
		  $ECA_pin = $row1['ECA_pin'];
		}
 }
 ?>
<div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
 <div class="inv-main" id="div_all">

 <form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_emp">

   <div class="panel panel-success">
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Edit <span class="panel-subTitle"> ( Employee Info ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>

     <!----- ERROR DIV -->
     <div class="error pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error"></span><br clear="all">
    </div>
     <div class="err pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span class="span-error"></span><br clear="all">

     </h3>
   </div>

  <div class="panel-body">
    <!---------  ROW 1 -------->
    <div class="form-group">
       <div class="form-control-group">
      <label for="inputEmployee_name" class="col-lg-2 control-label"> Name </label>
      <div class="col-lg-3">
      <input type="text" class="form-control capital" id="emp_name" name="emp_name" placeholder="Employee name" maxlength="50" autofocus required
      value="<?php echo $EI_name; ?>">
      <input type="hidden" name="ei_id" value="<?php echo $ei_id; ?>">
      <input type="hidden" name="check_cur_yes" value="<?php if( $ECA_id !="") {echo '1';}else{echo '2';}?>">
      <input type="hidden" name="cur_address_id" value="<?php if( $ECA_id !="") {echo $ECA_id;}else{echo '';}?>">
      </div>
      </div>

      <div class="form-control-group">
      <label for="inputEmp_dob" class="col-lg-2 control-label">Date of Birth </label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="emp_dob" name="emp_dob" placeholder="DOB" readonly required value="<?php echo $EI_dob; ?>">
      </div>
      </div>
     </div>

    <!---------  ROW 2 -------->
    <div class="form-group">
    <div class="form-control-group">
    <label for="emp_gender" class="col-lg-2 control-label">Gender</label>
    <div class="col-lg-3">
    <label for="emp_male" class="radio-inline col-lg-2" style="margin-left:30px;">
    <input  type="radio" name="emp_gender" id="emp_male" value="1" <?php if($EI_gender =='1'){echo 'checked';} ?>> Male
    </label>
    <label for="emp_female"  class="radio-inline col-lg-2" style="margin-left:30px;">
    <input type="radio" name="emp_gender" id="emp_female" value="2" <?php if($EI_gender =='2'){echo 'checked';} ?>> Female
    </label>
    </div>
    </div>

        <div class="form-control-group">
        <label for="emp_marital" class="col-lg-2 control-label">Marital Status</label>
        <div class="col-lg-3">
        <select class="form-control" name="emp_marital" id="emp_marital">
        <option value="" class="option_select">Select</option>
        <?php
        $result_marital = mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl WHERE marital_id != '6' AND marital_id != '7'");
        while($marital = mysqli_fetch_array($result_marital))
        {
          $name=$marital['marital_name'];
          $id=$marital['marital_id'];
        ?>
        <option value="<?php echo $id; ?>" <?php if($id == $EI_marital){echo "selected";}?> class="option_select"> <?php echo $name; ?></option>
        <?php }?>
        </select>
        </div>
        </div>
        </div>

  <!---------  ROW 3 -------->
  <div class="form-group">
  <div class="form-control-group">
  <label for="emp_email" class="col-lg-2 control-label">Email</label>
  <div class="col-lg-3">
  <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="sample@email.com" maxlength="50" value="<?php echo $EI_email;?>">
  </div>
  </div>
  </div>

     <!---------  ROW 4 -------->
      <div class="form-group">

   <div class="form-control-group">
  <label for="emp_phone" class="col-lg-2 control-label">Phone</label>
  <div class="col-lg-3">
  <input type="text" class="form-control" id="emp_phone" name="emp_phone" placeholder="Phone no." maxlength="10" value="<?php echo $EI_phone;?>">
  </div>
  </div>

      <div class="form-control-group">
      <label for="emerergency_phone" class="col-lg-2 control-label"> Emergency </label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="emerergency_phone" name="emerergency_phone" placeholder="Emergency Phone no." maxlength="10" value="<?php echo $EI_emergency;?>">
      </div>
      </div>
      </div>

    	<!---------  ROW 5 -------->
     	<div class="form-group">
        <div class="form-control-group">
        <label for="permanent_address" class="col-lg-2 control-label"> Address </label>
        <div class="col-lg-3">
        <input type="text" class="form-control capital" id="permanent_address" name="permanent_address" placeholder="Permanent Address" maxlength="50" value="<?php echo $EI_address;?>">
        </div>
        </div>

      <div class="form-control-group">
      <label for="permanent_state" class="col-lg-2 control-label">State</label>
      <div class="col-lg-3">
      <input type="text" class="form-control capital" id="permanent_state" name="permanent_state" placeholder="Search & Select State" value="Manipur" value="<?php echo $perm_state;?>">
      <input type="hidden" id="hidden_permanent_state" name="hidden_permanent_state" value="<?php echo $perm_state_id;?>">
      </div>
      </div>
      </div>

        <!---------  ROW 6 -------->
        <div class="form-group">
        <div class="form-control-group">
        <label for="permanent_district" class="col-lg-2 control-label">District</label>
        <div class="col-lg-3">
        <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="Search & Select District" value="<?php echo $perm_district;?>">
        <input type="hidden" id="hidden_permanent_district" name="hidden_permanent_district" value="<?php echo $perm_district_id;?>">
        </div>
        </div>
        <div class="form-control-group">
        <label for="permanent_pin" class="col-lg-2 control-label">PIN</label>
        <div class="col-lg-3">
        <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN" maxlength="6" value="<?php echo $EI_pin;?>">
        </div>
        </div>
        </div>

              <!---------  ROW 7 -------->
              <div class="form-group">
              <div class="form-control-group">
              <label for="current_address_q" class="col-lg-2 control-label">Cur. address ?</label>
              <div class="col-lg-3">
              <label for="current_address_q_no" class="radio-inline col-lg-2" style="margin-left:30px;">
              <input type="radio" name="current_address_q" id="current_address_q_no" value="2" <?php if( $ECA_id =="") {echo 'checked';}?> checked>No
              </label>
              <label for="current_address_q_yes" class="radio-inline col-lg-2" style="margin-left:30px;">
              <input type="radio" name="current_address_q" id="current_address_q_yes" value="1" <?php if( $ECA_id !="") {echo 'checked';}?>>Yes
              </label>

              </div>
              </div>
              </div>

        <!---------  ROW 8 -------->
        <div id="presentAddress_div">
         <div class="form-group">
         <div class="form-control-group">
         <label for="present_address" class="col-lg-2 control-label">Present Address</label>
         <div class="col-lg-3">
         <input type="text" class="form-control capital" id="present_address" name="present_address"  placeholder="Present Address" maxlength="50" value="<?php if( $ECA_id !="") {echo $ECA_address;}?>">
         </div>
         </div>

          <div class="form-control-group">
          <label for="present_state" class="col-lg-2 control-label">State</label>
          <div class="col-lg-3">
          <input type="text" class="form-control capital" id="present_state" name="present_state"  placeholder="Search & Select State" value="<?php if( $ECA_id !="") {echo $cur_state;}?>">
          <input type="hidden" id="hidden_present_state" name="hidden_present_state" value="<?php echo $cur_state_id;?>">
          </div>
          </div>
          </div>

          <!---------  ROW 9 -------->
          <div class="form-group">
          <div class="form-control-group">
          <label for="present_district" class="col-lg-2 control-label">District</label>
          <div class="col-lg-3">
          <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="Search & Select District" value="<?php if( $ECA_id !="") {echo $cur_district;}?>">
          <input type="hidden" id="hidden_present_district" name="hidden_present_district" value="<?php echo $cur_district_id;?>">
          </div>
          </div>
          <div class="form-control-group">
          <label for="inputpresent_pin" class="col-lg-2 control-label">PIN</label>
          <div class="col-lg-3">
          <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN" maxlength="6" value="<?php if( $ECA_id !="") {echo $ECA_pin;}?>">
          </div>
          </div>
          </div>
          </div>

       </div>
       </div>

    <div class="row" style="margin-bottom:50px;">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" id="emp_submit" name="emp_submit" style="font-size:16px;">Submit</button>
    </div>
    </div>
 </form>
</div><!--End penel-body-->
</div>


<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		/*------  Autocomplete ---------*/

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


	 /* ------- SHOW/HIDE - Current address ---------*/
	  if( $('input[name=current_address_q][value=2]').prop("checked")) {
				$('#presentAddress_div').hide(); }
	  if( $('input[name=current_address_q][value=1]').prop("checked")) {
				$('#presentAddress_div').show(); }

	  $("#current_address_q_yes, #current_address_q_no").click(function () {
			if( $('input[name=current_address_q][value=1]').prop("checked")) {
				$('#presentAddress_div').show(); }
	  else if ( $('input[name=current_address_q][value=2]').prop("checked")) {
				$('#presentAddress_div').hide(); }
		});

// form-submit
$("#emp_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?'))
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#div_all').hide();
			  $('#divWait').show();
			}
		  });
	});

//  VALIDATION
$("#form_emp").validate({
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
					  ? 'You missed 1 field. It has been highlighted'
					  : 'You missed ' + errors + ' fields. They have been highlighted';
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
		emp_name: { required: true,
					minlength: 3,
					maxlength: 50 },
		emp_dob: "required",
		emp_gender:"required",
		emp_marital: "required",
		emp_email: {  required: true,
				      email: true},
		emp_phone: { required: true,
						digits: true,
						minlength: 10,
						maxlength: 10 },
		emerergency_phone: { required: true,
						digits: true,
						minlength: 10,
						maxlength: 10 },
		permanent_address:"required",
		permanent_state:"required",
		permanent_district:"required",
		permanent_pin:{ required: true,
						digits: true,
						minlength: 6,
						maxlength: 6 },

		current_address_q:"required",

		present_address:{required: function(){
								   if ($('input[name=current_address_q][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=current_address_q][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		present_state:{required: function(){
			 				       if ($('input[name=current_address_q][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=current_address_q][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		present_district:{required: function(){
			 				      if ($('input[name=current_address_q][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=current_address_q][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		present_pin: {required: function(){
			 				        if ($('input[name=current_address_q][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=current_address_q][value=2]').prop("checked")) { return false; }  // NO
									},
						digits: function(){
			 				       if ($('input[name=current_address_q][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=current_address_q][value=2]').prop("checked")) { return false; }  // NO
									},
						minlength: 6,
						maxlength: 6 },


		},

messages: {
			emp_name: '',
		emp_dob: '',
		emp_gender:'',
		emp_marital: '',
		emp_email:'',
		emp_phone: '',
		emerergency_phone:'',
		permanent_address:'',
		permanent_state:'',
		permanent_district:'',
		permanent_pin:'',

		current_address_q:'',

		present_address:'',
		present_state:'',
		present_district:'',
		present_pin:'',
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



$( "#emp_dob" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // Setting yearRange of 50 years ago
		dateFormat: "dd-mm-yy",
		});

</script>
 </body>
</html>
<?php } }ob_flush();?>