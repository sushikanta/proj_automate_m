<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head> 
<title>Add Employee</title>
 <?php include("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_hr.php");?>
<div class="container">
 <div class="page-content">
 
    
<?php
if(isset($_GET['emp_submit']))
{  
	 $emp_sl = getCounter_value($con, 4);	
	 $emp_id = ucwords($_GET['emp_id']);
	 $emp_name = ucwords($_GET['emp_name']);
	 $emp_dob = date("Y-m-d", strtotime($_GET['emp_dob']));
	 $emp_sex = $_GET['emp_sex'];
	 $emp_marital = $_GET['emp_marital'];
	 $emp_email = $_GET['emp_email'];
	 $emp_phone = $_GET['emp_phone'];
	 $emerergency_phone = $_GET['emerergency_phone'];
	 
	 	$father_name = ucwords($_GET['father_name']);
		$father_occupation = ucwords($_GET['father_occupation']);
		$father_age = $_GET['father_age'];
		$mother_name = ucwords($_GET['mother_name']);
		$mother_occupation = ucwords($_GET['mother_occupation']);
		$mother_age = $_GET['mother_age'];  	
		$spause_name = ucwords($_GET['spause_name']);
		$spause_occupation = ucwords($_GET['spause_occupation']);
		$spause_age = $_GET['spause_age'];  	  
   
	    $emp_dept_id = $_GET['emp_dept_id'];		
	    $emp_position_id = $_GET['emp_position_id'];		
	    $emp_reportingTo_id = $_GET['emp_reportingTo_id'];
		
	  $joined_date = date("Y-m-d", strtotime($_GET['joined_date']));  
	  $emp_salary = $_GET['emp_salary'];
	  $annual_ctc = $_GET['annual_ctc'];

   if(isset($_GET['same_address']) && $_GET['same_address'] == "1")    //same address = Yes
	{   
	  $same_address = $_GET['same_address'];
	  $permanent_address = ucwords($_GET['permanent_address']);  
	  
	  if(isset($_GET['hidden_permanent_state']) && $_GET['hidden_permanent_state'] !="")
				  { $permanent_state_id = $_GET['hidden_permanent_state']; }
			else  { $permanent_state_id = getCounter_value($con, 7);
					$permanent_state = ucwords($_GET['permanent_state']);	
					addState($con, $permanent_state_id, $permanent_state); }
			if(isset($_GET['hidden_permanent_district']) && $_GET['hidden_permanent_district'] !="")
				  { $permanent_district_id=$_GET['hidden_permanent_district']; }
			   else  
			      { $permanent_district_id = getCounter_value($con, 8);
					$permanent_district = ucwords($_GET['permanent_district']);	
					addDistrict($con, $permanent_district_id, $permanent_district, $permanent_state_id); }
			
					$permanent_pin = $_GET['permanent_pin'];	
					
		
		mysqli_query($con, "INSERT INTO `employee_tbl`(`EMP_sl`, `EMP_id`, `EMP_name`, `EMP_dob`, `EMP_gender`, `EMP_marital`, `EMP_email`, `EMP_phone`, `EMP_emergency`, `EMP_Q_present_address`, `EMP_per_address`, `EMP_per_state`, `EMP_per_district`, `EMP_per_pin`, `EMP_pres_address`, `EMP_pres_state`, `EMP_pres_district`, `EMP_pres_pin`, `EMP_father_name`, `EMP_father_work`, `EMP_father_age`, `EMP_mother_name`, `EMP_mother_work`, `EMP_mother_age`, `EMP_spause_name`, `EMP_spause_work`, `EMP_spause_age`, `EMP_dept_id`, `EMP_desig_id`, `EMP_reportingOfficer_id`, `EMP_joining_date`, `EMP_salary`, `EMP_ctc`) VALUES ('.$emp_sl.', '".$emp_id."', '".$emp_name."', '$emp_dob', '.$emp_sex.', '.$emp_marital.', '".$emp_email."', '.$emp_phone.', '.$emerergency_phone.', '".$same_address."', '".$permanent_address."', '.$permanent_state_id.', '.$permanent_district_id.', '.$permanent_pin.', '', '', '', '', '".$father_name."', '".$father_occupation."', '.$father_age.', '".$mother_name."', '".$mother_occupation."', '.$mother_age.', '".$spause_name."', '".$spause_occupation."', '.$spause_age.', '.$emp_dept_id.', '.$emp_position_id.', '.$emp_reportingTo_id.', '$joined_date', '".$emp_salary."', '".$annual_ctc."')");			
			
	 }
  else if(isset($_GET['same_address']) && $_GET['same_address'] == "2")    //same address = No
   {  
      $same_address = $_GET['same_address'];
	  $present_address = ucwords($_GET['present_address']);  
	  
	if(isset($_GET['hidden_present_state']) && $_GET['hidden_present_state'] !="")
				  { $present_state_id = $_GET['hidden_present_state']; }
			else  { $present_state_id = getCounter_value($con, 7);
					$present_state = ucwords($_GET['present_state']);	
					addState($con, $present_state_id, $present_state); }
			if(isset($_GET['hidden_present_district']) && $_GET['hidden_present_district'] !="")
				  { $present_district_id=$_GET['hidden_present_district']; }
			   else  
			      { $present_district_id = getCounter_value($con, 8);
					$present_district = ucwords($_GET['present_district']);	
					addDistrict($con, $present_district_id, $present_district, $present_state_id); }
			
					$present_pin = $_GET['present_pin'];	
					
	  
	  $permanent_address = ucwords($_GET['permanent_address']);  
	  
	 		if(isset($_GET['hidden_permanent_state']) && $_GET['hidden_permanent_state'] !="")
				  { $permanent_state_id = $_GET['hidden_permanent_state']; }
			else  { $permanent_state_id = getCounter_value($con, 7);
					$permanent_state = ucwords($_GET['permanent_state']);	
					addState($con, $permanent_state_id, $permanent_state); }
			if(isset($_GET['hidden_permanent_district']) && $_GET['hidden_permanent_district'] !="")
				  { $permanent_district_id=$_GET['hidden_permanent_district']; }
			   else  
			      { $permanent_district_id = getCounter_value($con, 8);
					$permanent_district = ucwords($_GET['permanent_district']);	
					addDistrict($con, $permanent_district_id, $permanent_district, $permanent_state_id); }
			
					$permanent_pin = $_GET['permanent_pin'];	
					
		
      
mysqli_query($con, "INSERT INTO `employee_tbl`(`EMP_sl`, `EMP_id`, `EMP_name`, `EMP_dob`, `EMP_gender`, `EMP_marital`, `EMP_email`, `EMP_phone`, `EMP_emergency`, `EMP_Q_present_address`, `EMP_per_address`, `EMP_per_state`, `EMP_per_district`, `EMP_per_pin`, `EMP_pres_address`, `EMP_pres_state`, `EMP_pres_district`, `EMP_pres_pin`, `EMP_father_name`, `EMP_father_work`, `EMP_father_age`, `EMP_mother_name`, `EMP_mother_work`, `EMP_mother_age`, `EMP_spause_name`, `EMP_spause_work`, `EMP_spause_age`, `EMP_dept_id`, `EMP_desig_id`, `EMP_reportingOfficer_id`, `EMP_joining_date`, `EMP_salary`, `EMP_ctc`) VALUES ('.$emp_sl.', '".$emp_id."', '".$emp_name."', '".$emp_dob."', '.$emp_sex.', '.$emp_marital.', '".$emp_email."', '.$emp_phone.', '.$emerergency_phone.', '".$same_address."', '".$permanent_address."', '.$permanent_state_id.', '.$permanent_district_id.', '.$permanent_pin.', '".$present_address."', '.$present_state_id.', '.$present_district_id.', '.$present_pin.', '".$father_name."', '".$father_occupation."', '.$father_age.', '".$mother_name."', '".$mother_occupation."', '.$mother_age.', '".$spause_name."', '".$spause_occupation."', '.$spause_age.', '.$emp_dept_id.', '.$emp_position_id.', '.$emp_reportingTo_id.', '".$joined_date."', '".$emp_salary."', '".$annual_ctc."')");	
}
header("location: employee_table.php");
}
?> 
 <div class="inv-main">        
  <div class="panel panel-success">
 <form class="form-horizontal inv-form" role="form" method="get" action="#">			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Generate <span class="panel-subTitle"> ( Report ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>	 
   
  <div class="panel-body">
    <div class="form-group control-group">
      <label for="inputEmployee_name" class="col-lg-2-0 control-label">Employee Name</label>
      <div class="col-lg-2-0">
      		<input type="text" class="form-control capital" id="emp_name" name="emp_name" placeholder="Employee name" maxlength="50" autofocus required>
      </div>
      
      <label for="inputEmp_dob" class="col-lg-1-11 control-label">DOB</label>
      <div class="col-lg-1-11">
      		<input type="text" class="form-control" id="emp_dob" name="emp_dob" value="<?php echo date("d-m-Y", time());?>" readonly>
      </div>
      
      <label for="inputEmp_sex" class="col-lg-1-11 control-label">Gender</label>
      <div class="col-lg-1">					      
      <label class="radio-inline">
      		<input  type="radio" name="emp_sex" id="emp_male" value="1">M
      </label>
      <label class="radio-inline">
      		<input type="radio" name="emp_sex" id="emp_female" value="2">F
      </label>
      </div>	
      
      <label for="emp_marital" class="col-lg-2-0 control-label">Marital Status</label>
      <div class="col-lg-1-11">
      <select class="form-control" name="emp_marital" id="emp_marital">
        <option value="" class="select0">Select</option>         
       <?php 
		$result_marital = mysqli_query($con, "SELECT `marital_id`, `marital_name` FROM `marital_tbl` WHERE `marital_id` != '6' AND `marital_id` != '7'");
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
    
    <div class="form-group control-group">          	
         <label for="inputEmp_email" class="col-lg-2-0 control-label">Email</label>
            <div class="col-lg-2-0">
              <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="sample@email.com" maxlength="50">
            </div>
            
         <label for="inputEmp_phone" class="col-lg-1-11 control-label">Phone</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="emp_phone" name="emp_phone" placeholder="Phone no." maxlength="10">
            </div> 
            
           <label for="inputpresent_pin" class="col-lg-1-11 control-label">Emergency</label>
          <div class="col-lg-1-11">
            <input type="text" class="form-control" id="emerergency_phone" name="emerergency_phone" placeholder="Phone no." maxlength="10">
          </div>
          
        <label for="radioCheckAddress" class="col-lg-1-7 control-label">Stays at same address ?</label>
        <div class="col-lg-1-4">					      
            <label class="radio-inline">
              <input type="radio" name="same_address" id="same_address_yes" value="1" checked>Y
            </label>
            <label class="radio-inline">
              <input type="radio" name="same_address" id="same_address_no" value="2">N
            </label>
         </div>          
        </div>      
     
     <div class="form-group control-group" id="permanentAddress_div"> <!-----------------------Employee Permanent Address------------------------------>
       <label for="inputPermanent_address" class="col-lg-2-0 control-label">Permanent Address</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_address" name="permanent_address" placeholder="Permanent Address" maxlength="50">
          </div>
          
       <label for="inputPeramennt_state" class="col-lg-1-11 control-label">State</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_state" name="permanent_state" placeholder="State" value="Manipur">
            <input type="hidden" id="hidden_permanent_state" name="hidden_permanent_state" value="1">
          </div>
          
       <label for="inputPermanent_district" class="col-lg-1-3 control-label">District</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="District">
            <input type="hidden" id="hidden_permanent_district" name="hidden_permanent_district" >
          </div>
          
         <label for="inputPermanent_pin" class="col-lg-1-3 control-label">PIN</label>
        <div class="col-lg-1-5">
          <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN">
          <input type="hidden" id="hidden_permanent_pin" name="hidden_permanent_pin">
        </div> 
     </div>                     
    
     <div class="form-group control-group" id="presentAddress_div">  <!-----------------------Employee Temporary Address------------------------------->
         <label for="inputPresent_address" class="col-lg-2-0 control-label">Present Address</label>
            <div class="col-lg-2-0">
             <input type="text" class="form-control capital" id="present_address" name="present_address"  placeholder="Present Address" maxlength="50">            
            </div>
            
         <label for="inputpresent_state" class="col-lg-1-11 control-label">State</label>
            <div class="col-lg-2-0">                  
             <input type="text" class="form-control capital" id="present_state" name="present_state"  placeholder="State" value="Manipur">
             <input type="hidden" id="hidden_present_state" name="hidden_present_state" value="1">
            </div>
            
           <label for="inputpresent_state" class="col-lg-1-3 control-label">District</label>
          <div class="col-lg-2-0">                
              <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="District">
              <input type="hidden" id="hidden_present_district" name="hidden_present_district" >
            </div>
            
           <label for="inputpresent_pin" class="col-lg-1-3 control-label">PIN</label>
          <div class="col-lg-1-5">
            <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN">
            <input type="hidden" id="hidden_present_pin" name="hidden_present_pin" >
          </div> 
       </div>
       
       <span id="motherFather_span">
       <div class="form-group control-group">
          <label for="inputEmp_father" class="col-lg-2-0 control-label">Father Name</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="father_name"  name="father_name" placeholder="Father name" maxlength="50">
            </div>
            
          <label for="inputFather_occupation" class="col-lg-1-11 control-label">Occupation</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="father_occupation" name="father_occupation" placeholder="Father's occupation" maxlength="30">
            </div>
            
          <label for="inputFather_age" class="col-lg-1-3 control-label">Age</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="father_age" name="father_age" placeholder="Age" maxlength="3">
            </div>                    
         </div>
                  
        <div class="form-group control-group">
        <label for="inputEmp_Mother" class="col-lg-2-0 control-label">Mother Name</label>
        <div class="col-lg-2-0">
        <input type="text" class="form-control capital" id="mother_name"  name="mother_name" placeholder="Mother name" maxlength="50">
        </div>
        <label for="inputMother_occupation" class="col-lg-1-11 control-label">Occupation</label>
        <div class="col-lg-2-0">
        <input type="text" class="form-control capital" id="mother_occupation" name="mother_occupation" placeholder="Mother's occupation" maxlength="30">
        </div>
        <label for="inputEmpMother_age" class="col-lg-1-3 control-label">Age</label>
        <div class="col-lg-1-11">
        <input type="text" class="form-control" id="mother_age" name="mother_age" placeholder="Age" maxlength="3">
        </div>                    
        </div>
      </div>
      </span>
      
      <span id="spause_span">
       <div class="form-group control-group">
          <label for="spause_name" class="col-lg-2-0 control-label">Spause Name</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="spause_name"  name="spause_name" placeholder="Spause name" maxlength="50">
            </div>
            
          <label for="spause_occupation" class="col-lg-1-11 control-label">Occupation</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="spause_occupation" name="spause_occupation" placeholder="Spause's occupation" maxlength="30">
            </div>
            
          <label for="spuase_age" class="col-lg-1-3 control-label">Age</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="spause_age" name="spause_age" placeholder="Age" maxlength="3">
            </div>                    
         </div>
       </span>
      
      
      
      
      
         <div style="padding:5px; 0px"></div>
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-sun-o fa-spin fa-fw fa-lg success"></i> Official information</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
        <thead align="left">
        <tr>
          <th style="width:10%;"> Emp ID</th>
          <th style="width:20%;"> Department</th>
          <th style="width:20%;"> Designation</th>
          <th style="width:15%;"> Reported To</th>
          <th style="width:10%;"> Joined on</th>
          <th style="width:12%;"> Salary@PerMonth</th>
          <th style="width:10%;"> Annual CTC</th>
         </tr>
       </thead>     
  <tbody>
 <tr>
      <td class="readonly-bg"><input type="text" class="form-control emp_id" id="emp_id" placeholder="Emp ID" name="emp_id" maxlength="15"></td>  
      <td>
       <select required class="form-control" name="emp_dept_id">
          <option value="">Select Department</option>
			<?php
     $result = mysqli_query($con, "SELECT `department_id`, `department_name` FROM `department_tbl` WHERE `department_id` !='1' AND `department_id` !='2'");
               while($row=mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['department_id']; ?>" > <?php echo $row['department_name']; ?> </option>          
            <?php  } ?>
        </select> 
      </td>
      <td>
	  	<select class="form-control" name="emp_position_id">
          <option value="">Select Designation</option>
          <?php
             $result = mysqli_query($con, "SELECT `designation_id`, `designation_name`, `short_form` FROM `designation_tbl`");
             while($row=mysqli_fetch_array($result)) {
              ?>
              <option value="<?php echo $row['designation_id']; ?>" > <?php echo $row['designation_name']; ?> </option>          
          <?php } ?>
         </select> 
      </td> 
      <td>
	  <select class="form-control" name="emp_reportingTo_id">
        <option value="">Select ReportingTo</option>
        <?php
            $result = mysqli_query($con, "SELECT * FROM `designation_tbl`");
           while($row=mysqli_fetch_array($result)) {
            ?>
		<option value="<?php echo $row['designation_id']; ?>" > <?php echo $row['short_form']." (".$row['designation_name'].")"; ?> </option>           
        <?php } ?>
      </select> 
      </td>
      <td> <input type="text" class="form-control" id="joined_date" name="joined_date" value="<?php echo date("d-m-Y", time());?>" readonly> </td>		 
      <td><input type="text" class="form-control" placeholder="Salary" name="emp_salary" maxlength="6" ></td>
      <td><input type="text" class="form-control" placeholder="CTC" name="annual_ctc" maxlength="7" ></td>   
 </tr>
<tbody>
</table>    
</div>

	<div class="panel-footer">
 	<div class="row">
        <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="emp_submit" name="emp_submit" style="font-size:16px;">Submit</button>
        </div>  
    </div>    
  	</div>       
</div><!--End penel-body-->
</div>
</form>
    
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>  
<script type="text/javascript">
	$(document).ready(function() {

/*-------------------------------------------- START Autocomplete Permanent State/District/Pin -----------------------------------*/    		
		$('#permanent_state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				  $( "#permanent_state" ).val(ui.item.label);
				  return false; },
		  change: function (event, ui){   
					if (ui.item == null) 
					  { $('#hidden_permanent_state').val("");
						return false; }
				   else
					  { $('#hidden_permanent_state').val(ui.item.state_id);
					  return false; } }
		});
	
		$("#permanent_district").autocomplete({    
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_permanent_state").val() },
					 success: function(data) { response(data); }
				}); },
		  focus: function( event, ui ) {
                  $( "#permanent_district").val(ui.item.label);
                  return false; },
		 change: function (event, ui){   
				  if (ui.item == null) 
				     { $('#hidden_permanent_district').val("");
					   return false; }
				  else 
				     { $('#hidden_permanent_district').val(ui.item.district_id);
					   return false; } }
        });  

/*-------------------------------------------- START Autocomplete for Present State/District/Pin -----------------------------------*/    		
		$('#present_state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				  $( "#present_state" ).val(ui.item.label);
				  return false; },
		  change: function (event, ui){   
					if (ui.item == null) 
					  { $('#hidden_present_state').val("");
						return false; }
				   else
					  { $('#hidden_present_state').val(ui.item.state_id);
					  return false; } }
		});
		  

		$("#present_district").autocomplete({    
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_present_state").val() },
					 success: function(data) { response(data); }
				}); },
		  focus: function( event, ui ) {
                  $( "#present_district").val(ui.item.label);
                  return false; },
		 change: function (event, ui){   
				  if (ui.item == null) 
				     { $('#hidden_present_district').val("");
					   return false; }
				  else 
				     { $('#hidden_present_district').val(ui.item.district_id);
					   return false; } }
        });  

/* -------------SHOW/HIDE on click/unclick--------------*/
	
	  if($('#same_address_yes').is(':checked'))  
			{ $('#presentAddress_div').hide(); }
	   else { $('#presentAddress_div').show(); } 			
				  
	  $("#same_address_yes, #same_address_no").click(function () {
			if( $('input[name=same_address][value=1]').prop("checked")) {
				$('#presentAddress_div').hide(); }
	  else if ( $('input[name=same_address][value=2]').prop("checked")) {
				$('#presentAddress_div').show(); }	 
		});  
		
		
		
   /* -------------SHOW/HIDE on Select/unselect of Marital status --------------*/
	
		  if ($('#emp_marital option:eq(0)').prop('selected'))
				{  
				  $('#spause_span').hide();
				  $('#motherFather_span').show();		
				}
		  
		  //On change function 	   
		  $('#emp_marital').change(function() {	
				  
			//No Select at marital box		
			if ($('#emp_marital option:eq(0)').prop('selected'))					
				{ 
				
				$('#spause_span').hide();
				  $('#motherFather_span').show();	}
			 
			// 1 - single
			if ($('#emp_marital option:eq(1)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show();
				  }
			
			// 2 -  Married
			if ($('#emp_marital option:eq(2)').prop('selected'))
				{ $('#spause_span').show(); 
				  $('#motherFather_span').hide(); }
			
			// 3 -divorcee
			if ($('#emp_marital option:eq(3)').prop('selected'))
				{ $('#spause_span').hide(); 
				  $('#motherFather_span').show(); }
		   
			// 4 - widow
			if ($('#emp_marital option:eq(4)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
				  
			 // 5 - widower
			if ($('#emp_marital option:eq(5)').prop('selected'))
				{ $('#spause_span').show();
				  $('#motherFather_span').hide(); }
			 
		  }) 

 
	});
	

$( "#emp_dob" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // Setting yearRange of 50 years ago
		dateFormat: "dd-mm-yy",
		});

$( "#joined_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-10:+0", // Setting yearRange of 5 years ago
		dateFormat: "dd-mm-yy",
		});


</script>
 </body>
</html>
<?php ob_flush();?>