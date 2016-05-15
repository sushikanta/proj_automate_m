<?php require_once("check_login_fd.php");
resetCounter($con, 1, 'mm');
resetCounter($con, 33, 'dd');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Car Holder</title>
  <?php require_once("css_bootstrap_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header.php"); ?>
<main id="content" class="bs-docs-masthead" role="main">
<div class="container">
 <div class="page-content">

<?php

	if(isset($_GET['submit'])){	
	     	
		  $patient_id = date("ynj").getCounter($con, 1);
		  $patient_name = ucwords(mysqli_real_escape_string($con, $_GET['patient_name']));		  
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
		  
          $patient_address = ucwords(mysqli_real_escape_string($con, $_GET['patient_address']));
		  $state_id = mysqli_real_escape_string($con, $_GET['hidden_state']);
		  $district_id = mysqli_real_escape_string($con, $_GET['hidden_district']);
		  $pin_id = mysqli_real_escape_string($con, $_GET['patient_pin']);					
		  $patient_phone = mysqli_real_escape_string($con, $_GET['patient_phone']);
		  $type = mysqli_real_escape_string($con, $_GET['type']);
		  $status = mysqli_real_escape_string($con, $_GET['status']);          		 

// transaction start
mysqli_autocommit($con, false);
$flag = true;
		  
if($type==1)		// discounted-card holder
{
	$card_holder_id = date("yn").getCounter($con, 33);
	$disc = mysqli_real_escape_string($con, $_GET['disc']);
	$validity = mysqli_real_escape_string($con, $_GET['validity']);
	
	mysqli_query($con, "INSERT INTO patient_info(PI_id, PI_name, PI_age_y, PI_age_m, PI_age_d, PI_gender_id, PI_marital_id, PI_address, PI_state_id, PI_district_id, PI_pin_id, PI_phone, PI_date, PI_card) VALUES ('.$patient_id.', '".$patient_name."', '.$patient_age_y.', '.$patient_age_m.', '.$patient_age_d.', '$patient_gender', '$marital_status_id', '".$patient_address."', '$state_id', '$district_id', '.$pin_id.', '".$patient_phone."', NOW(), '$type')");
	
	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	else updateCounter($con, 1);
	
	mysqli_query($con, "INSERT INTO `discount_holder`(`DH_id`, `DH_patient_id`, `DH_disc_per`, `DH_status`, `DH_validity`, `DH_date`) VALUES ('$card_holder_id', '$patient_id', '".$disc."', '$status', '$validity', '".$today."')");

	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	else updateCounter($con, 33);
	}
if($type==2)		// Normal Patient Add
{
	mysqli_query($con, "INSERT INTO patient_info(PI_id, PI_name, PI_age_y, PI_age_m, PI_age_d, PI_gender_id, PI_marital_id, PI_address, PI_state_id, PI_district_id, PI_pin_id, PI_phone, PI_date, PI_card) VALUES ('.$patient_id.', '".$patient_name."', '.$patient_age_y.', '.$patient_age_m.', '.$patient_age_d.', '$patient_gender', '$marital_status_id', '".$patient_address."', '$state_id', '$district_id', '.$pin_id.', '".$patient_phone."', NOW(), '$type')");
	if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}//{ $flag = false; echo "Error details: " . mysqli_error($con) . ".";}
	else updateCounter($con, 1);	
	}
	
/*---------------- ---TRANSACTION-ROLLBACK ----------------*/
	if($flag){
			mysqli_commit($con);
			header("location: card.php?pid=$patient_id&cid=$card_holder_id");
			} else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404);
			header("location: card_holder_registration.php?errmsg=8");
			}
		
   	
//header("LOCATION: card_print.php?card=$card_holder_id");
}  // end -submit)
?>


<div class="inv-main">

<!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
    <img src="images/loading-1.gif" alt="Please wait while loading data" style="width:300px;" />
  </div>
 
  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="card_registration">
  
  <div class="panel panel-success">
  <div class="panel-heading light_purple_color">
  	
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Registration <span class="panel-subTitle">( Card Holder ) </span>
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
  
  <!--------------------------- FIRST ROW ------------------------------>     
  	<div class="form-group">
     <div class="form-control-group">
      <label for="patient_name" class="col-lg-1-4 control-label">Name</label>
      <div class="col-lg-2-5">
       <input type="text" class="form-control capital" id="patient_name" placeholder="Name" name="patient_name" maxlength="50" autofocus>
      </div>
      </div>
                
      <div class="form-control-group">
      <label for="patient_sex" class="col-lg-1-3 control-label">Gender</label>
      <div class="col-lg-1-4">					      
          <label for="optionsRadios1" class="radio-inline col-lg-1" style="margin-left: 10px;">
            <input type="radio" class="form-control" name="patient_sex" id="optionsRadios1" value=1>M</label>
          <label for="optionsRadios2" class="radio-inline col-lg-1" style="padding-left:30px;">
            <input type="radio" class="form-control" name="patient_sex" id="optionsRadios2" value=2>F</label>
      </div>
     </div>	
      
      <div class="form-control-group">
      <label for="marital_status" class="col-lg-1-3 control-label">Marital</label>
      <div class="col-lg-1-4" style="margin-right:4px;">
      <select class="form-control" name="marital_status" id="marital_status">
          <option value="" class="option_select">Select</option>
          <?php 
			  $result=mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl");
			  while($row=mysqli_fetch_array($result))
			  {					
			   ?>
				<option value="<?php echo $row['marital_id'];?>" class="option_select"><?php echo $row['marital_name'];?></option>						 
			   <?php
			  }
			 ?>          
      </select>
      </div>
      </div>	
                      
    
        <div id="div_age_y" class="form-control-group">
        <label for="patient_age_y" class="col-lg-1-1-0 control-label" id="label_age_y">YY</label>
         <div class="col-lg-1-2">
           <input type="text" class="form-control" id="patient_age_y" placeholder="YY" name="patient_age_y" maxlength="3">
        </div> 
        </div>
        
         <div id="div_age_m" class="form-control-group">
         <label for="patient_age_m" class="col-lg-1-1-0 control-label" id="label_age_m">MM</label>
         <div class="col-lg-1-2">
           <input type="text" class="form-control" id="patient_age_m" placeholder="MM" name="patient_age_m" maxlength="3">
        </div> 
        </div>
         
       <div id="div_age_d" class="form-control-group">
       <label for="patient_age_d" class="col-lg-1-1-0 control-label" id="label_age_d">DD</label>   
         <div class="col-lg-1-2">
         <input type="text" class="form-control" id="patient_age_d" placeholder="DD" name="patient_age_d" maxlength="3">
        </div> 
        </div>
    
           		
      <div class="form-control-group">
      <label for="patient_phone" class="col-lg-1-3 control-label">Phone</label>
      <div class="col-lg-1-4">
         <input type="text" class="form-control" id="patient_phone" placeholder="Phone no." name="patient_phone" maxlength="10">
      </div>
      </div>  
   </div>
      
      <!----------------------------- 2ND ROW ---------------------------->                               
      <div class="form-group" style="padding-bottom:35px;"> 
         
         <div class="form-control-group">
         <label for="patient_address" class="col-lg-1-4 control-label">Address</label>
          <div class="col-lg-2-5">
            <input type="text" class="form-control capital" id="patient_address" placeholder="Patient Address" name="patient_address" maxlength="100">
          </div> 
          </div>
          
        <div class="form-control-group">  
        <label for="state" class="col-lg-1-3 control-label"> State </label>
          <div class="col-lg-2-1" id="div_state">
            <input type="text" class="form-control capital" id="state" placeholder="Search" name="state" value="Manipur" maxlength="50">
            <input type="hidden" class="form-control" id="hidden_state" name="hidden_state" value="1">
          </div>  
          </div>
        
         <div class="form-control-group">            
         <label for="district" class="col-lg-1-3 control-label" id="label_state_district">District</label>
          <div class="col-lg-2-1" id="div_district">
            <input type="text" class="form-control capital" id="district" placeholder="Search district" name="district" maxlength="50">
            <input type="hidden" class="form-control" id="hidden_district" name="hidden_district">
          </div> 
          </div>
          
          <div class="form-control-group">    
          <label for="patient_pin" class="col-lg-1-3 control-label" id="label_patient_pin">PIN</label>
          <div class="col-lg-2-1" id="div_patient_pin">
            <input type="text" class="form-control" id="patient_pin" placeholder="PIN Code - Optional" name="patient_pin" maxlength="6">
           <!-- <input type="hidden" class="form-control" id="hidden_patient_pin" name="hidden_patient_pin">-->
          </div>
          </div>
      </div>				

	      

      <div class="form-group">             
          <div class="form-control-group">
           <label for="type" class="col-lg-1-4 control-label">Type</label>
          <div class="col-lg-2-5">
           <select class="form-control" name="type" id="type">
            <option value="" class="option_select">Select</option>        
            <option value="1" class="option_select" selected>Card Holder (Discounted)</option> 
            <option value="2" class="option_select">Normal Patient</option>   
          </select>
          </div> 
          </div>
          
          <div class="form-control-group" id="div_disc"> 
         <label for="disc" class="col-lg-1-3 control-label">Disc (%)</label>
          <div class="col-lg-2-1">
           <input class="form-control" id="disc" name="disc" placeholder="Disc in %" maxlength="30"></input>
          </div> 
          </div>  
          
     <div class="form-control-group" id="div_validity">          
     <label for="validity" class="col-lg-1-3 control-label">Validity</label>
      <div class="col-lg-2-1">
          <select class="form-control" name="validity" id="validity">
             <option value="" class="option_select">Select</option>
          <?php 
			  $result=mysqli_query($con, "SELECT `status_id`, `status_name` FROM `status_tbl` WHERE `status_table` ='discount_holder' AND `status_column` = 'DH_validity'");
			  while($row=mysqli_fetch_array($result))
			  {					
			   ?>
				<option value="<?php echo $row['status_id'];?>" class="option_select"><?php echo $row['status_name'];?></option>						 
			   <?php
			  }
			 ?>          
           </select>
      </div>
     </div>
      
	<!--<div class="form-control-group"  id="div_status">          
    <label for="current_date" class="col-lg-1-3 control-label">Date</label>
     <div class="col-lg-2-1"><span class="form-control" id="long_date_time"></span></div>
    </div> -->  
    
    <div class="form-control-group" id="div_status">          
     <label for="status" class="col-lg-1-3 control-label">Status</label>
      <div class="col-lg-2-1">
          <select class="form-control" name="status" id="status">
             <option value="" class="option_select">Select</option>
          <?php 
			  $result=mysqli_query($con, "SELECT `status_id`, `status_name` FROM `status_tbl` WHERE `status_table` ='discount_holder' AND `status_column` = 'DH_status'");
			  while($row=mysqli_fetch_array($result))
			  {					
			   ?>
				<option value="<?php echo $row['status_id'];?>" class="option_select"><?php echo $row['status_name'];?></option>						 
			   <?php
			  }
			 ?>          
           </select>
      </div>
     </div>
     
   	</div>	
  </div> 
 
 </div> <!----------------------------- END Patientn info (Panel-body)------------------------------->
  
  <div class="clear"></div>  
  <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
     <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="patient_submit" name="submit">Submit</button>
    </div>
  </div>  
</form>
  
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
			  $('#card_registration').hide();
			  $('#div_submit').hide();
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
						minlength: 3,
						maxlength: 50 },
		type: "required",		
		disc: { required: function(){
			 				       var type = $('#type').val();
								   if (type == '1' )
								   {  return true; } else { return false;}
						},
					     number: true,
		},
		
		validity: { required: function(){
			 				       var type = $('#type').val();
								   if (type == '1' )
								   {  return true; } else { return false;}
						},
					     number: true,
		},
		status: { required: function(){
			 				       var type = $('#type').val();
								   if (type == '1' )
								   {  return true; } else { return false;}
						},
					     number: true,
		},
		
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
			type: { required: ''},
			disc:{required: "",
							number:"Disc should be only numbers",							
							},
			validity: { required: ''},
			status: { required: ''},				

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
<?php ob_flush();?>