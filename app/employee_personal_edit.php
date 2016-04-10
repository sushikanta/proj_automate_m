<?php require_once("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '9')
 {
?>
<!DOCTYPE html>
<html>
<head>
<title>HR - Edit Employee Info</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
<body>
<?php require_once("right_top_header_hr.php");?>
<div class="container">
 <div class="page-content">      
<?php
if(isset($_GET['Ssubmit']))
{  
	 $Semp_sl_x = $_GET['hidden_emp_sl'];
	 $Semp_id = $_GET['emp_id'];
	 $Semp_name = ucwords($_GET['emp_name']);
	 $Semp_dob = date("Y-m-d", strtotime($_GET['emp_dob']));
	 $Semp_sex = $_GET['emp_sex'];
	 $Semp_marital = $_GET['emp_marital'];
	 $Semp_email = $_GET['emp_email'];
	 $Semp_phone = $_GET['emp_phone'];
	 $Semerergency_phone = $_GET['emerergency_phone'];
	 
	 	$Sfather_name = ucwords($_GET['father_name']);
		$Sfather_occupation = ucwords($_GET['father_occupation']);
		$Sfather_age = $_GET['father_age'];
		$Smother_name = ucwords($_GET['mother_name']);
		$Smother_occupation = ucwords($_GET['mother_occupation']);
		$Smother_age = $_GET['mother_age']; 
		$Smother_name = ucwords($_GET['mother_name']);
		$Smother_occupation = ucwords($_GET['mother_occupation']);
		$Smother_age = $_GET['mother_age']; 
		$Sspause_name = ucwords($_GET['spause_name']);
		$Sspause_occupation = ucwords($_GET['spause_occupation']);
		$Sspause_age = $_GET['spause_age'];  	  
   
	    $Semp_dept_id = $_GET['emp_dept_id'];		
	    $Semp_position_id = $_GET['emp_position_id'];		
	    $Semp_reportingTo_id = $_GET['emp_reportingTo_id'];
		 
	  $Semp_joining_date = date("Y-m-d", strtotime($_GET['emp_joining_date']));	  
	  $Semp_salary = $_GET['emp_salary'];
	  $Sannual_ctc = $_GET['annual_ctc'];
	  $Ssame_address = $_GET['same_address'];

   if(isset($Ssame_address) && $Ssame_address =='1')    //same address = Yes
	{   
	  $Ssame_address = $_GET['same_address'];
	  $Spermanent_address = ucwords($_GET['permanent_address']);  
	  
	  if(isset($_GET['hidden_permanent_state']) && $_GET['hidden_permanent_state'] !="")
				  { $Spermanent_state_id = $_GET['hidden_permanent_state']; }
			else  { $Spermanent_state_id = getCounter_value($con, 7);
					$Spermanent_state = ucwords($_GET['permanent_state']);	
					addState($con, $Spermanent_state_id, $Spermanent_state); }
					
			if(isset($_GET['hidden_permanent_district']) && $_GET['hidden_permanent_district'] !="")
				  { $Spermanent_district_id=$_GET['hidden_permanent_district']; }
			   else  
			      { $Spermanent_district_id = getCounter_value($con, 8);
					$Spermanent_district = ucwords($_GET['permanent_district']);	
					addDistrict($con, $Spermanent_district_id, $Spermanent_district, $Spermanent_state_id); }
			
		$Spermanent_pin = $_GET['permanent_pin'];	
					
		
		mysqli_query($con, "UPDATE employee_tbl SET EMP_id = '".$Semp_id."', EMP_name = '".$Semp_name."', EMP_dob = '".$Semp_dob."', EMP_gender = '.$Semp_sex.', EMP_marital = '.$Semp_marital.', EMP_email = '".$Semp_email."', EMP_phone = '.$Semp_phone.', EMP_emergency = '.$Semerergency_phone.', EMP_Q_present_address = '.$Ssame_address.', EMP_per_address = '".$Spermanent_address."', EMP_per_state = '.$Spermanent_state_id.', EMP_per_district  = '.$Spermanent_district_id.', EMP_per_pin = '.$Spermanent_pin.', EMP_pres_address = '".$Spermanent_address."', EMP_pres_state = '.$Spermanent_state_id.', EMP_pres_district = '.$Spermanent_district_id.', EMP_pres_pin = '.$Spermanent_pin.', EMP_father_name = '".$Sfather_name."',  EMP_father_work = '".$Sfather_occupation."', EMP_father_age = '.$Sfather_age.', EMP_mother_name = '".$Smother_name."', EMP_mother_work = '".$Smother_occupation."', EMP_mother_age = '.$Smother_age.', EMP_spause_name = '".$Sspause_name."', EMP_spause_work = '".$Sspause_occupation."', EMP_spause_age = '.$Sspause_age.', EMP_dept_id = '.$Semp_dept_id.', EMP_desig_id = '.$Semp_position_id.', EMP_reportingOfficer_id = '.$Semp_reportingTo_id.', EMP_joining_date = '".$Semp_joining_date."', EMP_salary = '".$Semp_salary."', EMP_ctc = '".$Sannual_ctc."' WHERE  EMP_sl ='$Semp_sl_x'");
			
	 }
 
 if(isset($Ssame_address) && $Ssame_address =='2')    //same address = No
   {  
      
	  $Spresent_address = ucwords($_GET['present_address']);  
	  
	if(isset($_GET['hidden_present_state']) && $_GET['hidden_present_state'] !="")
				  { $Spresent_state_id = $_GET['hidden_present_state']; }
			else  { $Spresent_state_id = getCounter_value($con, 7);
					$Spresent_state = ucwords($_GET['present_state']);	
					addState($con, $Spresent_state_id, $Spresent_state); }
			if(isset($_GET['hidden_present_district']) && $_GET['hidden_present_district'] !="")
				  { $Spresent_district_id=$_GET['hidden_present_district']; }
			   else  
			      { $Spresent_district_id = getCounter_value($con, 8);
					$Spresent_district = ucwords($_GET['present_district']);	
					addDistrict($con, $Spresent_district_id, $Spresent_district, $Spresent_state_id); }
			
	  $Spresent_pin = $_GET['present_pin'];	
					
	  
	  $Spermanent_address = ucwords($_GET['permanent_address']);  
	  
	 		if(isset($_GET['hidden_permanent_state']) && $_GET['hidden_permanent_state'] !="")
				  { $Spermanent_state_id = $_GET['hidden_permanent_state']; }
			else  { $Spermanent_state_id = getCounter_value($con, 7);
					$Spermanent_state = ucwords($_GET['permanent_state']);	
					addState($con, $Spermanent_state_id, $Spermanent_state); }
			if(isset($_GET['hidden_permanent_district']) && $_GET['hidden_permanent_district'] !="")
				  { $Spermanent_district_id=$_GET['hidden_permanent_district']; }
			   else  
			      { $Spermanent_district_id = getCounter_value($con, 8);
					$Spermanent_district = ucwords($_GET['permanent_district']);	
					addDistrict($con, $Spermanent_district_id, $Spermanent_district, $Spermanent_state_id); }
			
		$Spermanent_pin = $_GET['permanent_pin'];	
					
		
      
mysqli_query($con, "UPDATE employee_tbl SET EMP_id = '".$Semp_id."', EMP_name = '".$Semp_name."', EMP_dob = '".$Semp_dob."', EMP_gender = '.$Semp_sex.', EMP_marital = '.$Semp_marital.', EMP_email = '".$Semp_email."', EMP_phone = '.$Semp_phone.', EMP_emergency = '.$Semerergency_phone.', EMP_Q_present_address = '.$Ssame_address.', EMP_per_address = '".$Spermanent_address."', EMP_per_state = '.$Spermanent_state_id.', EMP_per_district  = '.$Spermanent_district_id.', EMP_per_pin = '.$Spermanent_pin.', EMP_pres_address = '".$Spresent_address."', EMP_pres_state = '.$Spresent_state_id.', EMP_pres_district = '.$Spresent_district_id.', EMP_pres_pin = '.$Spresent_pin.', EMP_father_name = '".$Sfather_name."',  EMP_father_work = '".$Sfather_occupation."', EMP_father_age = '.$Sfather_age.', EMP_mother_name = '".$Smother_name."', EMP_mother_work = '".$Smother_occupation."', EMP_mother_age = '.$Smother_age.', EMP_spause_name = '".$Sspause_name."', EMP_spause_work = '".$Sspause_occupation."', EMP_spause_age = '.$Sspause_age.', EMP_dept_id = '.$Semp_dept_id.', EMP_desig_id = '.$Semp_position_id.', EMP_reportingOfficer_id = '.$Semp_reportingTo_id.', EMP_joining_date = '".$Semp_joining_date."', EMP_salary = '".$Semp_salary."', EMP_ctc = '".$Sannual_ctc."' WHERE  EMP_sl ='$Semp_sl_x'");

}
header("location: employee_detail.php?table_emp_sl=$Semp_sl_x");
}
?> 

<?php 
if(isset($_GET['table_emp_sl']))
{
	$table_emp_sl = $_GET['table_emp_sl'];
	
	$result_table = mysqli_query($con, "SELECT  employee_tbl .*,  marital_tbl . marital_name  FROM  employee_tbl  LEFT JOIN  marital_tbl  ON  marital_tbl . marital_id  =  employee_tbl . EMP_marital  WHERE  employee_tbl . EMP_sl  = '$table_emp_sl'");
  while ($row = mysqli_fetch_array($result_table))
   {
   
	   $emp_sl = $row['EMP_sl'];
	   $emp_id = $row['EMP_id'];
	   $emp_name = $row['EMP_name'];
	   $emp_dob = date("d-M-Y", strtotime($row['EMP_dob']));
	   $emp_gender = $row['EMP_gender'];
	   $marital_id = $row['EMP_marital'];
	   $emp_email = $row['EMP_email'];
	   $emp_phone = $row['EMP_phone'];
	   $emergency_no = $row['EMP_emergency'];
	   $perm_address = $row['EMP_per_address'];
	   $perm_state = $row['EMP_per_state'];
	   $perm_district = $row['EMP_per_district'];
	   $perm_pin = $row['EMP_per_pin'];
	   $Q_present_address = $row['EMP_Q_present_address'];
	   $present_address = $row['EMP_pres_address'];
	   $present_state = $row['EMP_pres_state'];
	   $present_district = $row['EMP_pres_district'];
	   $present_pin = $row['EMP_pres_pin'];
	   $father_name = $row['EMP_father_name'];
	   $father_work = $row['EMP_father_work'];
	   $father_age = $row['EMP_father_age'];
	   $mother_name = $row['EMP_mother_name'];
	   $mother_work = $row['EMP_mother_work'];
	   $mother_age = $row['EMP_mother_age'];  
	   $spause_name = $row['EMP_spause_name'];
	   $spause_work = $row['EMP_spause_work'];
	   $spause_age = $row['EMP_spause_age'];  
	    
	   $emp_dept_id = $row['EMP_dept_id'];
	   $emp_desig_id = $row['EMP_desig_id'];
	   $emp_reportingOfficer_id = $row['EMP_reportingOfficer_id'];
	   $emp_joining_date = $row['EMP_joining_date'];
	   $emp_salary = $row['EMP_salary'];
	   $annual_ctc = $row['EMP_ctc'];	
	  
   }
	
?>

 <div class="inv-main"> 
 
 <form class="form-horizontal inv-form" role="form" method="get" action="#">			
  <div class="panel panel-success">  <!----------------------START Employee Information-------------->
     <div class="panel-heading"><h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Employee information
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span>
    
    <a class="text-right pull-right navbar-link no-print" href="employee_detail.php?table_emp_sl=<?php echo $table_emp_sl;?>" style="padding-left:30px;"> <i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     
     </h3>
  </div>		 
   
    
 <div class="panel-body">
    <div class="form-group control-group">
      <label for="inputEmployee_name" class="col-lg-2-0 control-label">Employee Name</label>
      <div class="col-lg-2-0">
      		<input type="text" class="form-control capital" id="emp_name" name="emp_name" placeholder="Employee name" maxlength="50" required value="<?php echo $emp_name; ?>">
      </div>
      
      <label for="inputEmp_dob" class="col-lg-1-11 control-label">DOB</label>
      <div class="col-lg-1-11">
      		<input type="text" class="form-control" id="emp_dob" name="emp_dob" placeholder="Date of Birth" readonly value="<?php echo date("d-M-Y", strtotime($emp_dob)); ?>">
      </div>
      
      <label for="inputEmp_sex" class="col-lg-1-11 control-label">Gender</label>
      <div class="col-lg-1">					      
      <label class="radio-inline">
      		<input  type="radio" name="emp_sex" id="emp_male" value='1' <?php if ($emp_gender =='1'){echo "checked";} ?> >M
      </label>
      <label class="radio-inline">
      		<input type="radio" name="emp_sex" id="emp_female" value='2' <?php if ($emp_gender =='2'){echo "checked";} ?> >F
      </label>
      </div>	
      
      <label for="inputEmp_marital" class="col-lg-2-0 control-label">Marital Status</label>
      <div class="col-lg-1-11">
      <select class="form-control" name="emp_marital" id="emp_marital">
        <option value="">Select</option>         
       <?php 
		$result_marital = mysqli_query($con, "SELECT  marital_id ,  marital_name  FROM  marital_tbl  WHERE  marital_id  != '6' AND  marital_id  != '7'");
		while($marital = mysqli_fetch_array($result_marital))
		 { 
		 	$name=$marital['marital_name'];
          	$id=$marital['marital_id'];	
		 ?>          
          <option value='<?php echo $id;?>' <?php if($id == $marital_id){echo "selected";} ?>> <?php echo $name; ?></option>
        <?php }?>                           
      </select>
      </div>          
    </div>				  
    
    <div class="form-group control-group">          	
         <label for="inputEmp_email" class="col-lg-2-0 control-label">Email</label>
            <div class="col-lg-2-0">
              <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="sample@email.com" maxlength="50" value="<?php echo $emp_email; ?>">
            </div>
            
         <label for="inputEmp_phone" class="col-lg-1-11 control-label">Phone</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="emp_phone" name="emp_phone" placeholder="Phone no." maxlength="10" value="<?php echo $emp_phone; ?>">
            </div> 
            
           <label for="inputpresent_pin" class="col-lg-1-11 control-label">Emergency</label>
          <div class="col-lg-1-11">
            <input type="text" class="form-control" id="emerergency_phone" name="emerergency_phone" placeholder="Phone no." maxlength="10" value="<?php echo $emergency_no; ?>">
          </div>
          
        <label for="radioCheckAddress" class="col-lg-1-7 control-label">Stays at same address ?</label>
        <div class="col-lg-1-4">					      
            <label class="radio-inline">
              <input type="radio" name="same_address" id="same_address_yes" value='1' <?php if($Q_present_address =='1'){echo "checked";} ?>>Y
            </label>
            <label class="radio-inline">
              <input type="radio" name="same_address" id="same_address_no" value='2' <?php if($Q_present_address =='2'){echo "checked";} ?>>N
            </label>
         </div>          
        </div>      
     
     <div class="form-group control-group" id="permanentAddress_div"> <!-----------------------Employee Permanent Address------------------------------>
       <label for="inputPermanent_address" class="col-lg-2-0 control-label">Permanent Address</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_address" name="permanent_address" placeholder="Permanent Address" maxlength="50"
            	value="<?php echo $perm_address; ?>" >
          </div>
          
       <label for="inputPeramennt_state" class="col-lg-1-11 control-label">State</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_state" name="permanent_state" placeholder="State" 
             value="<?php echo showStateName($con, $perm_state); ?>">
            <input type="hidden" id="hidden_permanent_state" name="hidden_permanent_state" value='<?php echo $perm_state;?>'>
          </div>
          
       <label for="inputPermanent_district" class="col-lg-1-3 control-label">District</label>
          <div class="col-lg-2-0">
            <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="District"
            	value="<?php echo showDistrictName($con, $perm_district); ?>">
            <input type="hidden" id="hidden_permanent_district" name="hidden_permanent_district" value='<?php echo $perm_district; ?>'>
          </div>
          
         <label for="inputPermanent_pin" class="col-lg-1-3 control-label">PIN</label>
        <div class="col-lg-1-5">
          <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN" value='<?php if($perm_pin =='0'){echo "";} else{ echo $perm_pin;} ?>' maxlength="6">
          
        </div> 
     </div>                     
    
     <div class="form-group control-group" id="presentAddress_div">  <!-----------------------Employee Temporary Address------------------------------->
         <label for="inputPresent_address" class="col-lg-2-0 control-label">Present Address</label>
            <div class="col-lg-2-0">
             <input type="text" class="form-control capital" id="present_address" name="present_address" placeholder="Present Address" maxlength="50"
              value="<?php if($Q_present_address =='2'){echo $present_address;}else{echo '';} ?>">            
            </div>
            
         <label for="present_state" class="col-lg-1-11 control-label">State</label>
            <div class="col-lg-2-0">                  
             <input type="text" class="form-control capital" id="present_state" name="present_state"  placeholder="State" 
              value="<?php if($Q_present_address =='2'){echo showStateName($con, $present_state);}else{echo '';} ?>">
             <input type="hidden" id="hidden_present_state" name="hidden_present_state" value='<?php if($Q_present_address =='2'){echo $present_state;}else{echo '';} ?>'>
            </div>
            
           <label for="inputpresent_state" class="col-lg-1-3 control-label">District</label>
          <div class="col-lg-2-0">                
              <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="District" 
              value="<?php if($Q_present_address =='2'){echo showDistrictName($con, $present_district);}else{echo '';} ?>" >
              <input type="hidden" id="hidden_present_district" name="hidden_present_district" value='<?php if($Q_present_address =='2'){echo $present_district;}else{echo '';} ?>' >
            </div>
            
           <label for="inputpresent_pin" class="col-lg-1-3 control-label">PIN</label>
          <div class="col-lg-1-5">
            <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN" value='<?php if($present_pin =='0'){echo "";} else{ echo $present_pin;}?>' maxlength="6">
            
          </div> 
       </div>
      
      <span id="motherFather_span"> 
       <div class="form-group control-group">
          <label for="inputEmp_father" class="col-lg-2-0 control-label">Father Name</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="father_name"  name="father_name" placeholder="Father name" maxlength="50"
              	value="<?php echo $father_name; ?>" >
            </div>
            
          <label for="inputFather_occupation" class="col-lg-1-11 control-label">Occupation</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="father_occupation" name="father_occupation" placeholder="Father's occupation" maxlength="30"
              	value="<?php echo $father_work; ?>">
            </div>
            
          <label for="inputFather_age" class="col-lg-1-3 control-label">Age</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="father_age" name="father_age" placeholder="Age" maxlength="3"
              	value='<?php echo $father_age;?>'>
            </div>                    
         </div>
                  
         
         <div class="form-group control-group">
               <label for="inputEmp_Mother" class="col-lg-2-0 control-label">Mother Name</label>
                <div class="col-lg-2-0">
                  <input type="text" class="form-control capital" id="mother_name"  name="mother_name" placeholder="Mother name" maxlength="50"
                  	value="<?php echo $mother_name; ?>">
                </div>
              <label for="inputMother_occupation" class="col-lg-1-11 control-label">Occupation</label>
                <div class="col-lg-2-0">
                  <input type="text" class="form-control capital" id="mother_occupation" name="mother_occupation" placeholder="Mother's occupation" 
                  maxlength="30" value="<?php echo $mother_work; ?>">
                </div>
              <label for="inputEmpMother_age" class="col-lg-1-3 control-label">Age</label>
                <div class="col-lg-1-11">
                  <input type="text" class="form-control" id="mother_age" name="mother_age" placeholder="Age" maxlength="3"
                  	value='<?php echo $mother_age; ?>'>
                </div>                    
         </div>
         </span>
         
        
       <div class="form-group control-group" id="spause_span">
          <label for="spause_name" class="col-lg-2-0 control-label">Spause Name</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="spause_name"  name="spause_name" placeholder="Spause name" value="<?php echo $spause_name; ?>" maxlength="50">
            </div>
            
          <label for="spause_occupation" class="col-lg-1-11 control-label">Occupation</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="spause_occupation" name="spause_occupation" value="<?php echo $spause_work; ?>" placeholder="Spause's occupation" maxlength="30">
            </div>
            
          <label for="spuase_age" class="col-lg-1-3 control-label">Age</label>
            <div class="col-lg-1-11">
              <input type="text" class="form-control" id="spause_age" name="spause_age" value="<?php if($spause_age=='0'){echo "";} else{echo $spause_age;} ?>" placeholder="Age" maxlength="3">
            </div>                    
         </div>
                
         
         
         
<div style="padding:5px; 0px"></div>
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-sun-o fa-spin fa-fw fa-lg success"></i> Official information</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
        <thead align="left">
        <tr>
          <th style="width:10%;"> Emp ID</th>
          <th style="width:20%;"> Department</th>
          <th style="width:20%;"> Designation</th>
          <th style="width:10%;"> Reported To</th>
          <th style="width:12%;"> Joined on</th>
          <th style="width:12%;"> Salary@PerMonth</th>
          <th style="width:10%;"> Annual CTC</th>
         </tr>
       </thead>     
  <tbody>
 <tr>
      <td class="readonly-bg">
      <input type="text" class="form-control" name="emp_id" value="<?php echo  $emp_id; ?>">
      <input type="hidden" class="form-control" name="hidden_emp_sl" value='<?php echo  $emp_sl;?>'>
      </td>  
      <td>
       <select required class="form-control" name="emp_dept_id">
          <option value="">Select Department</option>
			<?php
     $result = mysqli_query($con, "SELECT  department_id ,  department_name  FROM  department_tbl  WHERE  department_id  !='1' AND  department_id  !='2'");
               while($row=mysqli_fetch_array($result)) {
                ?>
                <option value='<?php echo $row['department_id']; ?>' <?php if($row['department_id'] == $emp_dept_id){echo "selected";} ?> > 
				<?php echo $row['department_name']; ?>
                </option>          
            <?php  } ?>
        </select> 
      </td>
      <td>
	  	<select class="form-control" name="emp_position_id">
          <option value="">Select Designation</option>
          <?php
             $result = mysqli_query($con, "SELECT  designation_id ,  designation_name ,  short_form  FROM  designation_tbl ");
             while($row=mysqli_fetch_array($result)) {
              ?>
              <option value='<?php echo $row['designation_id'];?>' <?php if($row['designation_id'] == $emp_desig_id){echo "selected";} ?> >
              <?php echo $row['designation_name']; ?>
              </option>          
          <?php } ?>
         </select> 
      </td> 
      <td>
	  <select class="form-control" name="emp_reportingTo_id">
        <option value="">Select ReportingTo</option>
        <?php
            $result = mysqli_query($con, "SELECT * FROM  designation_tbl ");
           while($row=mysqli_fetch_array($result)) {
            ?>
		<option value='<?php echo $row['designation_id'];?>' <?php if($row['designation_id'] == $emp_reportingOfficer_id){echo "selected";} ?> >
			<?php echo $row['short_form']; ?>
	 	</option>           
        <?php } ?>
      </select> 
      </td>
      <td> <input type="text" class="form-control" id="emp_joining_date" placeholder="Joining Date" name="emp_joining_date" readonly
                  	value="<?php echo date("d-M-Y", strtotime($emp_joining_date)); ?>">
       </td>		 
      <td><input type="text" class="form-control" placeholder="Salary" name="emp_salary" maxlength="8" value="<?php echo $emp_salary; ?>"></td>
      <td><input type="text" class="form-control" placeholder="CTC" name="annual_ctc" maxlength="9" value="<?php echo $annual_ctc; ?>"></td>   
 </tr>
<tbody>
</table>    
</div>

	<div class="panel-footer">
 	<div class="row">
        <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="Ssubmit" name="Ssubmit" style="font-size:16px;">Update</button>
        </div>  
    </div>    
  	</div>       
</div><!--End penel-body-->
</div>
</form>
    
    
    <!---------------Start Qualification----------------->
  
 <div class="panel panel-success">   <!---------------------------------- START Employee Qualification --------------------------------->				  		  <div class="panel-heading">
 <h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-book fa-fw fa-lg"></i> Employee Qualification
  <a class="text-right pull-right navbar-link" href="employee_detail.php?table_emp_sl=<?php echo $table_emp_sl; ?>">
     <i class="fa fa-arrow-circle-right fa-lg"></i>
     </a>
 </h3>
 </div>
 
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="qualf_table">
        <thead align="left">
        <tr>
          <th style="display: none;"> emp_qualf_id</th>
          <th style="display: none;"> emp_id</th>
          <th style="width:5%;"> # </th>
          <th style="width:50%;"> Qualification</th>
          <th style="width:10%;"> Faculty</th>
          <th style="width:30%;"> Institute</th>
          <th style="width:30%;"> Board/Univ</th>
          <th style="width:10%;"> Mark Obt</th>
          <th style="width:10%;"> Total</th>
          <th style="width:10%;"> % or G</th>
          <th style="width:10%;"> Div</th> 
          <th style="width:10%;"> Pas</th> 
          <th style="width:5%;"> Dur</th>   
          <th>Edit</th>    
        </tr>
       </thead>
     
  <tbody>
<?php
$result_qualf = mysqli_query($con, "SELECT * FROM  emp_qualification_tbl  WHERE  EQ_emp_sl  = '$table_emp_sl'");
$sl_no=1;
while ($qual = mysqli_fetch_array($result_qualf))
{
?>
 <tr id="<?php echo $qual['emp_qualf_id'] ; ?>">
      <td style="display:none;" class="overflow-fixed"><?php echo $qual['emp_qualf_id']; ?></td>
      <td style="display:none;"><?php echo $table_emp_sl; ?></td>
      <td class="readonly-bg"><?php echo  $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo  $qual['emp_qualf_name']; ?></td>
      <td class="readonly-bg"><?php echo  $qual['emp_faculty']; ?> </td> 
      <td class="readonly-bg"><?php echo  $qual['emp_institute']; ?> </td>
      <td class="readonly-bg"><?php echo  $qual['emp_univ']; ?> </td>		 
      <td class="readonly-bg"><?php echo  $qual['mark_obtained']; ?> </td>
      <td class="readonly-bg"><?php echo  $qual['total_mark']; ?> </td>   
      <td class="readonly-bg"><?php echo  $qual['per_grad'];?> </td>
      <td class="readonly-bg"><?php echo  $qual['result'];?> </td>
      <td class="readonly-bg"><?php echo  $qual['passing_year'];?> </td>
      <td class="readonly-bg"><?php echo  $qual['course_duration'];?> </td>     
      <td style="cursor:pointer;"><a class="table-action-EditQualf navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>    
<!---------------------------------------- Form for Edit qualificaiton ------------------------->
<form id="formEditQualf" action="ajax_qualf_update.php" title="Update selected row">  

 <label style="display:none;">emp_qualf_id</label>
 <label style="display:none;">emp_sl</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:11px">Qualification</label>
 <label style="margin-right:48px;">Faculty</label>
 <label style="margin-right:73px;">Institute</label>
 <label style="margin-right:50px;">Board/Univ</label>
 <label style="margin-right:3px;">Mark Obt</label>
 <label style="margin-right:32px;">Total</label>
 <label style="margin-right:5px;">% or Grd</label>
 <label style="margin-right:5px;">Division</label>
 <label style="margin-right:5px;">Passing(Y)</label>
 <label style="margin-right:5px;">Duration</label>
 <br />
 	<input type="hidden" name="hidden_qualf_id" id="hidden_qualf_id" value="<?php echo $qual['emp_qualf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_emp_sl"   id="hidden_emp_sl"   value="<?php echo $table_emp_sl; ?>" rel="1"/> 
    <input type="text" style="width:45px; margin-right:10px;"  name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:112px; margin-right:10px; text-transform:capitalize;" name="emp_qualf" id="emp_qualf" rel="3" />
    <input type="text" style="width:100px; margin-right:10px; text-transform:capitalize;" name="faculty" id="faculty" rel="4" />
    <input type="text" style="width:140px; margin-right:10px; text-transform:capitalize;" name="institute" id="institute" rel="5" />
    <input type="text" style="width:140px; margin-right:10px; text-transform:capitalize;" name="board_univ" id="board_univ" rel="6" />
    <input type="text" style="width:71px; margin-right:10px;"  name="mark_obt" id="mark_obt" rel="7" />
    <input type="text" style="width:71px; margin-right:10px;"  name="total" id="total" rel="8" />
    <input type="text" style="width:75px; margin-right:5px; text-transform:capitalize;"   name="per_grade" id="per_grade" rel="9" />
    <input type="text" style="width:75px; margin-right:0px; text-transform:capitalize;"   name="division" id="division" rel="10" />
    <input type="text" style="width:95px; margin-right:4px;"   name="passing_year" id="passing_year" rel="11" />
    <input type="text" style="width:75px; margin-right:0px;"   name="course_duration" id="course_duration" rel="12" />
  <br /> 
    <span class="datafield" style="display:none" rel="13"><a class="table-action-EditQualf">Edit</a></span>
    <br />
    <button id="formEditQualfCancel" type="button">Cancel</button>      
    <button id="formEditQualfOk" type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new qualification---------------------------->
<form id="formNew_qualf" action="#"> 
<label id="lblAddError1" style="display:none" class="error"></label>
 <div id="processing_message1" style="display:none" title="Processing">Please wait while processing....</div>
 
<label style="display:none;" class="sr-only">emp_qualf_id</label>
 <label style="display:none;" class="sr-only">emp_sl</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:11px">Qualification</label>
 <label style="margin-right:48px;">Faculty</label>
 <label style="margin-right:73px;">Institute</label>
 <label style="margin-right:50px;">Board/Univ</label>
 <label style="margin-right:3px;">Mark Obt</label>
 <label style="margin-right:32px;">Total</label>
 <label style="margin-right:5px;">% or Grd</label>
 <label style="margin-right:5px;">Division</label>
 <label style="margin-right:5px;">Passing(Y)</label>
 <label style="margin-right:5px;">Duration</label>
 <br />
 	<input type="hidden" name="hidden_qualf_id" id="hidden_qualf_id" value="<?php echo $qual['emp_qualf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/> 
    <input type="text" style="width:45px; margin-right:10px;"  name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:112px; margin-right:10px; text-transform:capitalize;" name="emp_qualf" id="emp_qualf" rel="3" />
    <input type="text" style="width:100px; margin-right:10px; text-transform:capitalize;" name="faculty" id="faculty" rel="4" />
    <input type="text" style="width:140px; margin-right:10px; text-transform:capitalize;" name="institute" id="institute" rel="5" />
    <input type="text" style="width:140px; margin-right:10px; text-transform:capitalize;" name="board_univ" id="board_univ" rel="6" />
    <input type="text" style="width:71px; margin-right:10px;" name="mark_obt" id="mark_obt" rel="7" />
    <input type="text" style="width:71px; margin-right:10px;" name="total" id="total" rel="8" />
    <input type="text" style="width:75px; margin-right:5px; text-transform:capitalize;"  name="per_grade" id="per_grade" rel="9" />
    <input type="text" style="width:75px; margin-right:0px; text-transform:capitalize;" name="division" id="division" rel="10" />
    <input type="text" style="width:95px; margin-right:4px;" name="passing_year" id="passing_year" rel="11" />
    <input type="text" style="width:75px; margin-right:0px;" name="course_duration" id="course_duration" rel="12" />
 <br /> 
   <br />      
   <button id="btnAddNewRowCancel1" value="cancel">Cancel</button>
   <button id="btnAddNewRowOk1" value="Ok">Okay</button>  
     <br /> 
   <span class="datafield" style="display:none" rel="13"><a class="table-action-EditQualf">Edit</a></span>
</form>
<button id="btnDeleteRow1">Delete</button> <button id="btnAddNewRow1">Add</button>   
</div> <!------------------------------------------- END Employee Qualification -------------------------------------------->         

    
<div class="panel panel-success">    <!------------------------START Previous Experience Information ------------------>				  				 	<div class="panel-heading">
<h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-bolt fa-fw fa"></i> Previous Experiences
 <a class="text-right pull-right navbar-link" href="employee_detail.php?table_emp_sl=<?php echo $table_emp_sl; ?>">
     <i class="fa fa-arrow-circle-right fa-lg"></i>
     </a>
</h3>
</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="exp_table">
        <thead align="left">
        <tr>
          <th style="display: none;"> prev_company_id</th>
          <th style="display: none;"> emp_sl</th>
          <th> # </th>
          <th> Organisation Name</th>
          <th> Address</th>
          <th> Department</th>
          <th> Designation</th>
          <th> Joined Date</th>
          <th> Last Date</th>
          <th> Total Year</th>
          <th> Edit</th>       
        </tr>
        </thead>
     
  <tbody>
<?php
$result_exp = mysqli_query($con, "SELECT * FROM  emp_prev_company  WHERE  PC_emp_sl  = '$table_emp_sl'");
$sl_no=1;
while ($exp = mysqli_fetch_array($result_exp))
{
?>
 <tr id="<?php echo $exp['emp_prev_comp_id'] ; ?>">
    <td style="display:none;"><?php echo $exp['emp_prev_comp_id']; ?></td>
    <td style="display:none;"><?php echo $table_emp_sl; ?></td>
    <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $exp['company_name']; ?> </td>  
    <td class="readonly-bg"><?php echo $exp['prev_comp_address']; ?> </td> 
	<td class="readonly-bg"><?php echo $exp['prev_depmt']; ?> </td>
    <td class="readonly-bg"><?php echo $exp['prev_position']; ?> </td>		 
    <td class="readonly-bg"><?php echo date("d-M-Y", strtotime($exp['prev_joined_date'])); ?> </td>
    <td class="readonly-bg"><?php echo date("d-M-Y", strtotime($exp['prev_exit_date'])); ?> </td>   
    <td class="readonly-bg"><?php echo $exp['total_year'];?> </td>
    <td style="cursor:pointer;"><a class="table-action-ExpEdit navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>

<!---------------------------------------- Form for Edit experience------------------------->

<form id="formExpEdit" action="ajax_exper_update.php" title="Update selected row"> 
 <label style="display:none;" class="sr-only">emp_prev_comp_id</label>
 <label style="display:none;" class="sr-only">PC_emp_sl</label>
 <label style="margin-right:40px;">#</label>
 <label style="margin-right:36px">Company Name</label>
 <label style="margin-right:96px;">Address</label>
 <label style="margin-right:35px;">Department</label>
 <label style="margin-right:35px;">Designation</label>
 <label style="margin-right:22px;">Joined date</label>
 <label style="margin-right:42px;">Exit Date</label>
 <label style="margin-right:0px;">Total Year</label>
 <br /> 
    <input type="hidden" name="hidden_comp_id" id="hidden_comp_id" value="<?php echo $exp['emp_prev_comp_id']; ?>" rel="0"/> 
    <input type="hidden" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/> 
    <input style="width:45px;  margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:160px; margin-right:10px; text-transform:capitalize;" type="text" name="prev_comp" id="prev_comp" rel="3" />
    <input style="width:156px; margin-right:10px; text-transform:capitalize;" type="text" name="company_address" id="company_address" rel="4" />
    <input style="width:130px; margin-right:10px; text-transform:capitalize;" type="text" name="company_dept" id="company_dept" rel="5" />
    <input style="width:130px; margin-right:10px; text-transform:capitalize;" type="text" name="prev_designation" id="prev_designation" rel="6" />
    <input style="width:111px; margin-right:10px;" type="text" name="joined_date" id="joined_date_edit" rel="7" readonly />
    <input style="width:113px; margin-right:10px;" type="text" name="last_date" id="last_date_edit" rel="8" readonly />
    <input style="width:75px;  margin-right:0px; cursor:not-allowed;"  type="text" name="total_year" id="total_year_edit" readonly rel="9" />
  <br /> 
    <span class="datafield" style="display:none" rel="10"><a class="table-action-ExpEdit">Edit</a></span>
    <br />
    <button id="formExpEditCancel" type="button">Cancel</button>      
    <button id="formExpEditOk" type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new experience------------------------->
<form id="formNew_experience" action="#"> 
<label id="lblAddError2" style="display:none" class="error"></label>
 <div id="processing_message2" style="display:none" title="Processing">Please wait while processing....</div>
 
 <label style="display:none;" class="sr-only">emp_prev_comp_id</label>
 <label style="display:none;" class="sr-only">PC_emp_sl</label>
 <label style="margin-right:40px;">#</label>
 <label style="margin-right:36px">Company Name</label>
 <label style="margin-right:96px;">Address</label>
 <label style="margin-right:35px;">Department</label>
 <label style="margin-right:35px;">Designation</label>
 <label style="margin-right:22px;">Joined date</label>
 <label style="margin-right:42px;">Exit Date</label>
 <label style="margin-right:0px;">Total Year</label>
 <br /> 
    <input type="hidden" name="hidden_comp_id" id="hidden_comp_id" value="<?php echo $exp['emp_prev_comp_id']; ?>" rel="0"/> 
    <input type="hidden" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/> 
    <input style="width:45px;  margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:160px; margin-right:10px; text-transform:capitalize;" type="text" name="prev_comp" id="prev_comp" rel="3" />
    <input style="width:156px; margin-right:10px; text-transform:capitalize;" type="text" name="company_address" id="company_address" rel="4" />
    <input style="width:130px; margin-right:10px; text-transform:capitalize;" type="text" name="company_dept" id="company_dept" rel="5" />
    <input style="width:130px; margin-right:10px; text-transform:capitalize;" type="text" name="prev_designation" id="prev_designation" rel="6" />
    <input style="width:111px; margin-right:10px;" type="text" name="joined_date" id="joined_date" rel="7" readonly />
    <input style="width:113px; margin-right:10px;" type="text" name="last_date" id="last_date" rel="8" readonly />
    <input style="width:75px;  margin-right:0px; cursor:not-allowed;"  type="text" name="total_year" id="total_year" readonly rel="9" />
  <br />
   <br />      
   <button id="btnAddNewRowCancel2" value="cancel">Cancel</button>
   <button id="btnAddNewRowOk2" value="Ok">Okay</button>  
     <br /> 
   <span class="datafield" style="display:none" rel="10"><a class="table-action-ExpEdit">Edit</a></span>  
</form>
<button id="btnDeleteRow2">Delete</button> <button id="btnAddNewRow2">Add</button>     
</div>  <!------------------------------------------- END Previous Experience Information ---------------------------------------->
            
<div class="panel panel-success">    <!------------------------START Letter Information ------------------>				  				 	
<div class="panel-heading">
<h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-windows fa-fw fa"></i> Letter information
 <a class="text-right pull-right navbar-link" href="employee_detail.php?table_emp_sl=<?php echo $table_emp_sl; ?>">
     <i class="fa fa-arrow-circle-right fa-lg"></i>
     </a>
</h3>
</div>    
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="letter_table">
<thead align="left">
  <tr>
       <th style="display: none;"> EL_sl</th>
       <th style="display: none;"> emp_sl</th>
        <th > # </th>
        <th > Letter type</th>
        <th > Detail</th>
        <th> Date</th>
        <th> Edit</th>
  </tr>
</thead>
<tbody>
<?php
 $employee_info = mysqli_query($con, "SELECT  employee_letter .*,  letter_type_tbl . letter_type  FROM  employee_letter  LEFT JOIN  letter_type_tbl  ON  letter_type_tbl . letter_type_id  =  employee_letter . EL_letter_type_id  WHERE  employee_letter . EL_emp_sl  = '$table_emp_sl'");
 $sl_no=1;
  while($row = mysqli_fetch_array($employee_info))
  {
		
		$EL_sl = $row['EL_sl'];
		
?>
 <tr id="<?php echo $row['EL_sl']; ?>">
      <td style="display:none;"><?php echo $EL_sl; ?></td>
      <td style="display:none;"><?php echo $table_emp_sl; ?></td>
      <td class="readonly-bg"><?php echo  $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo  $row['letter_type']; ?></td>
      <td class="readonly-bg"><?php echo   $row['EL_letter_detail']; ?></td> 
      <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($row['EL_date'])); ?> </td> 
      <td style="cursor:pointer;" class="readonly-bg"><a class="table-action-EditLetter navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<!---------------------------------------- Form for new ------------------------->
<form id="formNewLetter" action="#"> 
<label id="lblAddError3" style="display:none" class="error"></label>
 <div id="processing_message3" style="display:none" title="Processing">Please wait while processing....</div>
 
<label style="margin-right:30px;">#</label>
<label style="margin-right:157px;">Letter type</label>
<label style="margin-right:261px;">Letter Detail</label>
<label style="margin-right:0px;">Date</label>
 
 
 <br />
<input type="hidden" style="display:none;" name="hidden_EL_sl" id="hidden_EL_sl" value="<?php echo $EL_sl; ?>" rel="0"/>
<input type="hidden" style="display:none;" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/>
<input style="width:35px; margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />      
<select required style="width:240px; margin-right:10px;" type="text" name="letter_type" id="letter_type" rel="3">
    <option value="">Select </option>
     <?php 
		$result_letter = mysqli_query($con, "SELECT  letter_type_id ,  letter_type  FROM  letter_type_tbl ");
		while($letter = mysqli_fetch_array($result_letter))
		 { ?>          
         <option value="<?php echo $letter['letter_type_id']; ?>"> <?php echo $letter['letter_type']; ?></option>
        <?php }?>    
</select>
<textarea style="width:360px; margin-right:10px;" name="letter_detail" id="letter_detail" rel="4"></textarea>
<input style="width:170px; margin-right:10px;" type="text" name="letter_date" id="letter_date" readonly rel="5" />
   <br /> 
   <span class="datafield" style="display:none" rel="6"><a class="table-action-EditLetter"><i class="fa fa-pencil"></i> Edit</a></span>
   </form>
 <button id="btnDeleteRow3">Delete</button> <button id="btnAddNewRow3">Add</button>     
 
 <!---------------------------------------- Form for Edit ------------------------->
<form id="formEditLetter" action="ajax_emp_letter_update.php" title="Update selected row"> 
<label style="margin-right:30px;">#</label>
<label style="margin-right:157px;">Letter type</label>
<label style="margin-right:261px;">Letter Detail</label>
<label style="margin-right:0px;">Date</label>
 
 
 <br />
<input type="hidden" style="display:none;" name="hidden_EL_sl" id="hidden_EL_sl" value="<?php echo $EL_sl; ?>" rel="0"/>
<input type="hidden" style="display:none;" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/>
<input style="width:35px; margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />      
<select required style="width:240px; margin-right:10px;" type="text" name="letter_type" id="letter_type" rel="3">
    <option value="">Select </option>
     <?php 
		$result_letter = mysqli_query($con, "SELECT  letter_type_id ,  letter_type  FROM  letter_type_tbl ");
		while($letter = mysqli_fetch_array($result_letter))
		 { ?>          
         <option value="<?php echo $letter['letter_type_id']; ?>"> <?php echo $letter['letter_type']; ?></option>
        <?php }?>    
</select>
<textarea style="width:360px; margin-right:10px;" name="letter_detail" id="letter_detail" rel="4"></textarea>
<input style="width:170px; margin-right:10px;" type="text" name="letter_date" id="letter_date_edit" readonly rel="5" />
    
    <br />
    <button id="formEditLetterCancel" type="button">Cancel</button>      
    <button id="formEditLetterOk" type="submit">Confirm</button>    
   <br /> 
   <span class="datafield" style="display:none" rel="6"><a class="table-action-EditLetter"><i class="fa fa-pencil"></i> Edit</a></span>
   </form>
   </div>
 
    
  <div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>  
<script src="js/employee_personal_edit.js" type="text/javascript"></script>
 </body>
</html>
<?php 
	}
 }

 ob_flush();?>