<?php require_once("check_login_admin.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Patient Info</title>
  <?php require_once("css_bootstrap_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header_popup.php"); ?>
<div class="container">
 <div class="page-content">

<?php
	if(isset($_GET['submit'])){	
	     	
	  resetCounter($con, 34, 'dd');  //  History
	  resetCounter($con, 35, 'dd');  //  Lab Note
	  resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)	
			
		
		  $patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);
		  $receipt_no = mysqli_real_escape_string($con, $_GET['receipt_no']);
		  $receipt_no = mysqli_real_escape_string($con, $_GET['reason']);
		  $reason = ucwords(mysqli_real_escape_string($con, $_GET['patient_name']));		  
		  $marital_status_id = $_GET['marital_status'];
		  $today = date("Y-m-d");	 
		 
   if( $marital_status_id =='1' || $marital_status_id =='2' || $marital_status_id =='3' || $marital_status_id =='4' || $marital_status_id =='5'){		  
		  $patient_age_y = mysqli_real_escape_string($con, $_GET['patient_age_y']);
		  $patient_age_m = '0';
		  $patient_age_d = '0';
	        }
		  if( $marital_status_id =='6'){		  
				$patient_age_y = mysqli_real_escape_string($con, $_GET['patient_age_y']);
				$patient_age_m = mysqli_real_escape_string($con, $_GET['patient_age_m']);
				$patient_age_d = mysqli_real_escape_string($con, $_GET['patient_age_d']);
			   }
		  if( $marital_status_id =='7'){		  
				$patient_age_y = '0';
				$patient_age_m = mysqli_real_escape_string($con, $_GET['patient_age_m']);
				$patient_age_d = mysqli_real_escape_string($con, $_GET['patient_age_d']);
	         }
		  $patient_gender = $_GET['patient_sex'];
		  
          $patient_name = ucwords(mysqli_real_escape_string($con, $_GET['patient_name']));
		  $patient_address = ucwords(mysqli_real_escape_string($con, $_GET['patient_address']));
		  $state_id = mysqli_real_escape_string($con, $_GET['hidden_state']);
		  $district_id = mysqli_real_escape_string($con, $_GET['hidden_district']);
		  $pin_id = mysqli_real_escape_string($con, $_GET['patient_pin']);					
		  $patient_phone = mysqli_real_escape_string($con, $_GET['patient_phone']);		 
		  
		  $user_id=$_SESSION['user_id'];          		 

	// transaction start
	mysqli_autocommit($con, false);
	$flag = true;		  
	
	mysqli_query($con, "UPDATE patient_info SET PI_name = '".$patient_name."', PI_age_y = '$patient_age_y', PI_age_m = '$patient_age_m', PI_age_d = '$patient_age_d', PI_gender='$patient_gender', PI_marital_id = '$marital_status_id', PI_address = '".$patient_address."', PI_state_id = '$state_id', PI_district_id = '$district_id', PI_pin = '".$pin_id."', PI_phone = '".$patient_phone."' WHERE PI_id = '$patient_id'");
	
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	
/****************************
 26 	Patient Registration - book
 27 	Patient Investigation - book
 28 	Patient Discount - book
 29 	Customer Profile - book
 
 22 	Add - action
 23 	Edit - action
 24 	Cancel - action
 25 	Status  - action
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '29', '23', '$receipt_no', '$reason_r', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);
	
  //--TRANSACTION-ROLLBACK 
  if($flag){
	  mysqli_commit($con);
	  header("location: patient_info_admin.php?receipt_no=$receipt_no&patient_id=$patient_id&reason=$reason");
	  } else {
	  mysqli_rollback($con);	
	  echo "Something is wrong ! Action is failed"; http_response_code(404);
	}
}  // end -submit)

if(isset($_GET['go_swap'])){

	 resetCounter($con, 42, 'dd');	//  A_id (audit_tbl)	
		  $patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);
		  $receipt_no = mysqli_real_escape_string($con, $_GET['receipt_no']);
		  $reason = mysqli_real_escape_string($con, $_GET['reason']);
		  
	// transaction start
	mysqli_autocommit($con, false);
	$flag = true;		  
	
	mysqli_query($con, "UPDATE patient_registration SET pr_patient_id = '$patient_id' WHERE pr_receipt_no = '$receipt_no'");
	
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}

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
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '29', '21', '$receipt_no', '$reason', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);
	
		  
  //--TRANSACTION-ROLLBACK 
  if($flag){
	  mysqli_commit($con);
	  header("location: patient_info_admin.php?receipt_no=$receipt_no&patient_id=$patient_id&reason=$reason");
	  } else {
	  mysqli_rollback($con);	
	  echo "Something is wrong ! Action is failed"; http_response_code(404);
	} 	  
}
?>


<?php
if(isset($_GET['patient_id']) && $_GET['patient_id'] !="" && isset($_GET['receipt_no']) && $_GET['receipt_no'] !="" && isset($_GET['reason']) && $_GET['reason'] !="")
{
	$receipt_no_x = $_GET['receipt_no'];
	$patient_id_x = $_GET['patient_id'];
	$reason = $_GET['reason'];
$patient_info = mysqli_query($con, "SELECT p.PI_name, p.PI_gender, p.PI_marital_id, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_marital_id, p.PI_address, p.PI_pin, p.PI_phone, p.PI_date, p.PI_state_id, p.PI_district_id, d.district_name, s.state_name FROM patient_info p LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id WHERE p.PI_id = '$patient_id_x'");
 
  while($row = mysqli_fetch_array($patient_info))
  {	 
	  $name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];	  
  	  $gender = $row['PI_gender'];
	  $marital = $row['PI_marital_id'];
	 
	  $pin = $row['PI_pin'];
	  $date_info = $row['PI_date'];
	  $phone = $row['PI_phone'];
	  
	   $address = $row['PI_address'];
	   $state_id = $row['PI_state_id'];
	   $district_id = $row['PI_district_id'];
	   
	   $state = $row['state_name'];
	   $district = $row['district_name'];  
	  }
 ?>

<!------------------- start loading..-------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>

<div class="inv-main" id="div_main">  
  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="card_registration">
  
  <div class="panel panel-success" >
  <div class="panel-heading light_purple_color">
  	
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Edit <span class="panel-subTitle">( Patient / Customer Info ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    
    <div class="error pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error"></span><br clear="all">
    </div>
    
     <div class="err pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span class="span-error"></span><br clear="all">
   </div> 
  </h3>
  </div>
  <div class="panel-body">
  
  <input type="hidden" name="reason" value="<?php echo $reason; ?>" required>
  <input type="hidden" name="receipt_no" value="<?php echo $receipt_no_x; ?>" required>
  
   <!----------------  ROW 1  ------------>                               
      <div class="form-group" style="padding-top:35px;">          
        <div class="form-control-group">
        <label for="patient_address" class="col-lg-2 control-label">Customer ID # </label>
        <div class="col-lg-3">
        <input type="text" class="form-control" name="patient_id" value="<?php echo $patient_id_x; ?>" readonly>
        </div> 
        </div>
        
        <div class="form-control-group">  
        <label for="state" class="col-lg-2 control-label"> Added on </label>          
        <div class="col-lg-3"> <input type="text" class="form-control" value="<?php echo date("d-m-Y h:i a", strtotime($date_info)); ?>" readonly>
        </div>
        </div>
     </div>				

  
  
  <!----------------  ROW 2  ------------>    
  	<div class="form-group">
     <div class="form-control-group">
      <label for="patient_name" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-3">
       <input type="text" class="form-control capital" id="patient_name" placeholder="Name" name="patient_name" maxlength="50" value="<?php echo $name; ?>" autofocus>
      </div>
      </div>
      
      <div class="form-control-group">
      <label for="patient_phone" class="col-lg-2 control-label">Phone</label>
      <div class="col-lg-3">
         <input type="text" class="form-control" id="patient_phone" placeholder="Phone no." name="patient_phone" maxlength="10" value="<?php echo $phone; ?>">
      </div>
      </div>  
      </div>
                
      <div class="form-group">
      <div class="form-control-group">
      <label for="patient_sex" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-3">					      
          <label for="optionsRadios1" class=" control-label radio-inline col-lg-2" style="margin-right:20px;">       
            <input type="radio" class="form-control" name="patient_sex" id="optionsRadios1" value=1 <?php if($gender ==1){echo 'checked';} ?>>MALE</label>           
          <label for="optionsRadios2" class=" control-label radio-inline col-lg-2">         
            <input type="radio" class=" form-control" name="patient_sex" id="optionsRadios2" value=2 <?php if($gender ==2){echo 'checked';} ?>>FEMALE</label>          
      </div>
     </div>	
      
      <div class="form-control-group">
      <label for="marital_status" class="col-lg-2 control-label">Marital</label>
      <div class="col-lg-2" style="margin-right:4px;">
      <select class="form-control" name="marital_status" id="marital_status">
          <option value="" class="option_select">Select</option>
          <?php 
			  $result=mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl");
			  while($row=mysqli_fetch_array($result))
			  {			
			  		$m_id = $row['marital_id'];
			   ?>
	<option value="<?php echo $m_id;?>" class="option_select" <?php if($m_id == $marital){echo 'selected';} ?>><?php echo $row['marital_name'];?></option>						 
			   <?php
			  }
			 ?>          
      </select>
      </div>
      </div>	
                      
    
        <div id="div_age_y" class="form-control-group">
        <label for="patient_age_y" class="col-lg-1-1-0 control-label" id="label_age_y">YY</label>
         <div class="col-lg-1-3">
           <input type="text" class="form-control" id="patient_age_y" placeholder="YY" name="patient_age_y" maxlength="3" value="<?php echo $age_y;?>">
        </div> 
        </div>
        
         <div id="div_age_m" class="form-control-group">
         <label for="patient_age_m" class="col-lg-1-1-0 control-label" id="label_age_m">MM</label>
         <div class="col-lg-1-2">
           <input type="text" class="form-control" id="patient_age_m" placeholder="MM" name="patient_age_m" maxlength="3" value="<?php echo $age_m;?>">
        </div> 
        </div>
         
       <div id="div_age_d" class="form-control-group">
       <label for="patient_age_d" class="col-lg-1-1-0 control-label" id="label_age_d">DD</label>   
         <div class="col-lg-1-2">
         <input type="text" class="form-control" id="patient_age_d" placeholder="DD" name="patient_age_d" maxlength="3" value="<?php echo $age_d;?>">
        </div> 
        </div>
   </div>
      
    <!----------------  ROW 3  ------------>                              
      <div class="form-group"> 
         
         <div class="form-control-group">
         <label for="patient_address" class="col-lg-2 control-label">Address</label>
          <div class="col-lg-3">
            <input type="text" class="form-control capital" id="patient_address" placeholder="Patient Address" name="patient_address" maxlength="100" value="<?php echo $address;?>">
          </div> 
          </div>
          
        <div class="form-control-group">  
        <label for="state" class="col-lg-2 control-label"> State </label>
          <div class="col-lg-3" id="div_state">
            <input type="text" class="form-control capital" id="state" placeholder="Search" name="state" maxlength="50" value="<?php echo $state;?>">
            <input type="hidden" class="form-control" id="hidden_state" name="hidden_state" value="<?php echo $state_id;?>">
          </div>  
          </div>
          </div>
        
        <!----------------  ROW 4  ------------>                              
  <div class="form-group" style="padding-bottom:35px;"> 
  <div class="form-control-group">            
  <label for="district" class="col-lg-2 control-label" id="label_state_district">District</label>
  <div class="col-lg-3" id="div_district">
  <input type="text" class="form-control capital" id="district" placeholder="Search district" name="district" maxlength="50" value="<?php echo $district;?>">
  <input type="hidden" class="form-control" id="hidden_district" name="hidden_district" value="<?php echo $district_id;?>">
  </div> 
  </div>
  
  <div class="form-control-group">    
  <label for="patient_pin" class="col-lg-2 control-label" id="label_patient_pin">PIN</label>
  <div class="col-lg-3" id="div_patient_pin">
  <input type="text" class="form-control" id="patient_pin" placeholder="PIN Code - Optional" name="patient_pin" maxlength="6" value="<?php echo $pin;?>">
  <!-- <input type="hidden" class="form-control" id="hidden_patient_pin" name="hidden_patient_pin">-->
  </div>
  </div>
  </div>				
 
 	<div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
     <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="patient_submit" name="submit">Submit</button>
    </div>
  </div>  
</form>
</div>
</div>
<div class="clear"></div>

<!----------- SWAP CUSTOMER ID ------>
<div class="panel panel-success">
      <div class="panel-heading light_purple_color">  	
      <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Swap <span class="panel-subTitle">( Saved Customer Info ) </span>
      </h3>
      </div>
  
<!--------------  ROW 1  ------------>
<div class="row">
 <form role="form" method="get" class="form-horizontal inv-form" id="form_swap">
 <div class="form-group" style="margin-bottom:100px;">
   <div class="form-control-group">
   <label for="search_cid" class="col-lg-3 control-label"></label>
      <div class="col-lg-6">
      <input type="text" class="form-control" id="search_info" name="search_info" placeholder="Swap Saved Customer by search customer id or Name" style="line-height:1.8999;" required>
      <input type="hidden" name="patient_id" id="patient_id">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no_x;?>">
      <input type="hidden" name="reason" value="<?php echo $reason; ?>" required>
      </div>      
      <button name="go_swap" id="go_swap" class="btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>      
</div>
</div>


<div class="clear"></div>
</div>
</main>
<?php require_once("footer.php");?>
<?php require_once("script_bootstrap.php"); ?>  
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

/*----------------------- Marital status - AGe boxes -----------------------*/
if ($('#marital_status').val() =='')
      { 	$('#div_age_y').show();
		   $('#div_age_m').hide();
		   $('#div_age_d').hide(); }
else if (  $('#marital_status').val() =='6')
	  	{ 
		  $('#div_age_y').show();
		  $('#div_age_m').show();
		  $('#div_age_d').show(); }
else if ( $('#marital_status').val() =='7')
	  	{ 
		  $('#div_age_y').hide();
		  $('#div_age_m').show();
		  $('#div_age_d').show();  }
else 
	  	{
		  
		  $('#div_age_y').show();
		  $('#div_age_m').hide();
		  $('#div_age_d').hide(); }

$('#marital_status').change(function() {
	
	var selectvalue = $(this).val();
	
	if (selectvalue =='')
      {   $('#div_age_y').show();
		  $('#div_age_m').hide();
		  $('#div_age_d').hide(); }
else if (selectvalue =='6')
	  	{ 
		   $('#div_age_y').show();
		   $('#div_age_m').show();
		   $('#div_age_d').show(); }
else if (selectvalue =='7')
	  	{
		   $('#div_age_y').hide();
		   $('#div_age_m').show();
		   $('#div_age_d').show();  }
else 
	  	{
		 
		   $('#div_age_y').show();
		   $('#div_age_m').hide();
		   $('#div_age_d').hide();  }
		})
		
/*--------------------------------- Type Select-----------------------------------------------------*/		
if ($('#type').val() =='')
      { 	$('#div_disc').hide();
		   $('#div_validity').hide();
		   $('#div_status').hide(); 
	  }
		
$('#type').change(function() {
	
	var selectvalue = $(this).val();
	
	if (selectvalue =='')
      {   $('#div_disc').hide();
		  $('#div_validity').hide();
		  $('#div_status').hide();  }
 if (selectvalue =='1')
	  	{ 
		  $('#div_disc').show();
		  $('#div_validity').show();
		  $('#div_status').show(); }
if (selectvalue =='2')
	  	{
		  $('#div_disc').hide();
		  $('#div_validity').hide();
		  $('#div_status').hide();  }
		})
		
		
/*-------------------------------------------- START Autocomplete for state -----------------------------------*/    		
	
		
		$('#state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:0,
		  scroll: true,  
		  
		  change: function (event, ui){ 
		  			$( "#district").val("");  
					if (ui.item == null) 
					  {  $('#state').val("");
					     $('#hidden_state').val("");
						return false; }
				   else
					  { $('#state').val(ui.item.value);
					    $('#hidden_state').val(ui.item.state_id);
					    return false; } 
					},
		/* focus: function( event, ui ) {			 
                     event.preventDefault(); // without this: keyboard movements reset the input to ''
        			 $(this).val(ui.item.value);
    	   },*/
		
		}).focus(function(){
            if (this.value == "")
                {
                  $(this).autocomplete("search",'');
                }
        });
        
		  
/*-------------------------------------------- START Autocomplete for District -----------------------------------*/    		
		$("#district").autocomplete({
			minLength:0,
			scroll: true,
          	source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_state").val() },
					 success: function(data) { response(data); }
				}); },
		 change: function (event, ui){ 
		 		  if (ui.item == null) 
				     { $('#district').val("");
					   $('#hidden_district').val("");
					   return false; }
				  else 
				     { $('#district').val(ui.item.value);
					   $('#hidden_district').val(ui.item.district_id);
					   return false; } }
        }).focus(function(){
            if (this.value == "")
                {
                  $(this).autocomplete("search",'');
                }
        });

/*---------------------------------Submit - confirmation-----------------------------------------------------*/
 
$("#patient_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  //$(':submit', this).attr('disabled', 'disabled');
			  $('#div_main').hide();
			  $('#divWait').show();
			  //$('#divWait').fadeOut(2000);
			}
		  });
	});
			
$("#card_registration").validate({
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
		patient_name: { required: true,
						minlength: 3,
						maxlength: 50 },
		patient_sex: "required",
		marital_status: { required: true,},
		patient_age_y: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '1' || marital_id == '2' || marital_id == '3' || marital_id == '4' || marital_id == '5' || marital_id == '6')
								   {  return true; } else if (marital_id == '7' || marital_id == '') { return false;}
						},
					     digits: true,
						},
		patient_age_m: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '6' || marital_id == '7')
								   {  return true;} else  { return false;}
						},
					     digits: true,
						 },
	patient_age_d: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '6' || marital_id == '7')
								   {  return true; } else { return false;}
						},
					     digits: true,
						  },
						
							
		patient_phone: { required: true,
						digits: true,
						minlength: 10,
						maxlength: 10 },	
		patient_address: { required: true,
						minlength: 3,
						maxlength: 100 },
		state: { required: true,
						minlength: 2,
						maxlength: 50 },
		district: { required: true,
						minlength: 3,}
		
},

messages: {
			patient_name: { required: "",
							minlength: "Name should be at least 3 characters",
							maxlength: "Name should be max.of 50 characters" },
			patient_sex: { required:""},
			marital_status: { required: "",},
			
			patient_age_y:{required: "",
							digits:"Years should be only digits",
													
							},
			patient_age_m:{required: "",
							digits:"Months should be only digits",	
							
							},
			patient_age_d:{required: "",
							digits:"Days should be only digits",			
							},
			patient_phone: { required: "",
							  digits: "Oops ! Phone no. should be digits only",
							  minlength: "Phone no. should be at least 10 digits",
							  maxlength: "Phone no. should be max.of 10 digits" },
			patient_address: { required: "",
							minlength: "Address should be at least 3 characters",
							maxlength: "Address should be max.of 100 characters" },	
			state: { required: "",
							minlength: "State should be at least 2 characters",
							maxlength: "State should be max.of 50 characters" },	
			district: { required: "",
							minlength: "District should be at least 3 characters",
							maxlength: "District should be max.of 50 characters" },
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
	
	
	//--------------- SWAP CUSTOMER INFO
	
	$('#search_info').autocomplete({
		  source:'fd_search_auto_patient_info.php', 
		  minLength:0,
		  scroll: true,  
		  
		  change: function (event, ui){ 
					if (ui.item == null) 
					  {  $('#search_info').val("");
					     $('#patient_id').val("");
						return false; }
				   else
					  { $('#search_info').val(ui.item.value);
					    $('#patient_id').val(ui.item.patient_id);
					    return false; } 
					},
		
		}).focus(function(){
            if (this.value == "")
                {
                  $(this).autocomplete("search",'');
                }
        });
	
	$("#go_swap").click(function(event) {
        if( !confirm('Are you sure to swap customer info ?')) 
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#div_main').hide();
			  $('#divWait').show();
			}
		  });
	});
	
  });

</script>
</body>
</html>
<?php } ob_flush();?>