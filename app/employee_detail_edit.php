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
<?php require_once("css_bootstrap_datatable_hr.php"); ob_start();?> 
<body>
<?php require_once("right_top_header_hr.php");?>
<div class="container">
 <div class="page-content">
 
<?php 
if(isset($_GET['table_emp_sl']))
{
$table_emp_sl = $_GET['table_emp_sl'];
$result_table = mysqli_query($con, "SELECT * FROM `employee_tbl` WHERE `EMP_sl` = '$table_emp_sl'");
  while ($row = mysqli_fetch_array($result_table))
   {
	   $emp_id = $row['EMP_id'];
	   $emp_name = $row['EMP_name'];
	   $emp_dob = date("d-M-Y", strtotime($row['EMP_dob']));
	   $emp_gender = $row['EMP_gender'];
	   $emp_marital_status = $row['EMP_marital'];
	   $emp_email = $row['EMP_email'];
	   $emp_phone = $row['EMP_phone'];
	   $emergency_no = $row['EMP_emergency'];
	   $EMP_Q_prev_experience = $row['EMP_Q_prev_experience'];
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
	   $emp_dept_id = $row['EMP_dept_id'];
	   $emp_desig_id = $row['EMP_desig_id'];
	   $emp_reportingOfficer_id = $row['EMP_reportingOfficer_id'];
	   $emp_joining_date = $row['EMP_joining_date'];
	   $emp_salary = $row['EMP_salary'];
	   $annual_ctc = $row['EMP_ctc'];
	   
   }
?>
 
<div class="inv-main">
 
 <div class="panel panel-success">  <!----------------------START Employee Information-------------->
    
    <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-info-circle fa-spin fa-fw fa-lg"></i> Employee information<a class="text-right pull-right navbar-link" href="employee_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a></h3></div>		 
    
    <div class="control-group">
      <label for="inputEmployee_name" class="col-lg-2-0 control-label text-right">Employee Name :</label>
      <div class="col-lg-2-0">
      	<span class="input-xlarge uneditable-input text-control"><?php echo $emp_name;?></span>
      </div>
      
      <label for="inputEmp_dob" class="col-lg-1-11 control-label text-right">DoB :</label>
      <div class="col-lg-1-11">
      	<span class="input-xlarge uneditable-input text-control"><?php echo $emp_dob;?></span>
      </div>
      
      <label for="inputEmp_sex" class="col-lg-1-11 control-label text-right">Gender :</label>
      <div class="col-lg-1">
       	<span class="input-xlarge uneditable-input text-control"><?php if ($emp_gender =='1'){echo "Male";} else if($emp_gender =='2'){echo "Female";}?></span>
      </div>	
      
      <label for="inputEmp_marital" class="col-lg-2-0 control-label text-right">Marital Status :</label>
      <div class="col-lg-1-11">
     		<span class="input-xlarge uneditable-input text-control"><?php echo $emp_marital_status;?></span>
      </div>          
    </div>
         
    <div class="control-group">          	
         <label for="inputEmp_email" class="col-lg-2-0 control-label text-right">Email :</label>
            <div class="col-lg-2-0">
              <span class="input-xlarge uneditable-input text-control"><?php echo $emp_email;?></span>
            </div>
            
         <label for="inputEmp_phone" class="col-lg-1-11 control-label text-right">Phone :</label>
            <div class="col-lg-1-11">
             <span class="input-xlarge uneditable-input text-control"><?php echo $emp_phone;?></span>
            </div> 
            
           <label for="inputpresent_pin" class="col-lg-1-11 control-label text-right">Emergency :</label>
          <div class="col-lg-1-11">
            <span class="input-xlarge uneditable-input text-control"><?php echo $emergency_no;?></span>
          </div>
         <label for="inputpresent_pin" class="col-lg-1-11 control-label text-right">Qualification :</label>
          <div class="col-lg-1-1">
            <span class="input-xlarge uneditable-input text-control"><?php echo checkEmp_qualification($con, $table_emp_sl);?></span>
          </div>
          <label for="inputpresent_pin" class="col-lg-1-11 control-label text-right">Experience :</label>
          <div class="col-lg-1-1">
            <span class="input-xlarge uneditable-input text-control"><?php echo checkEmp_experience($con, $table_emp_sl);?></span>
          </div>
    </div>
       
    <div class="control-group" id="permanentAddress_div"> <!-----------------------Employee Permanent Address------------------------------>
       <label for="inputPermanent_address" class="col-lg-2-0 control-label text-right">Permanent Address :</label>
          <div class="col-lg-9">
            <span class="input-xlarge uneditable-input text-control"><?php echo $perm_address.', '.$perm_district.', '.$perm_state.', '.$perm_pin;?></span>
          </div>    
     </div> 
         
     <div class="control-group" id="presentAddress_div">  <!-----------------------Employee Temporary Address------------------------------->
         <label for="inputPresent_address" class="col-lg-2-0 control-label text-right">Present Address :</label>
            <div class="col-lg-9">
    <span class="input-xlarge uneditable-input text-control"><?php echo $present_address.', '.$present_district.', '.$present_state.', '.$present_pin;?></span>
            </div>
     </div>    
            
      <div class="control-group">
          <label for="inputEmp_father" class="col-lg-2-0 control-label text-right">Father Name :</label>
            <div class="col-lg-4">
              <span class="input-xlarge uneditable-input text-control"><?php echo $father_name;?></span>
            </div>
            
          <label for="inputFather_occupation" class="col-lg-1-6 control-label text-right">Occupation :</label>
            <div class="col-lg-2-0">
              <span class="input-xlarge uneditable-input text-control"><?php echo $father_work;?></span>
            </div>
            
          <label for="inputFather_age" class="col-lg-1-3 control-label text-right">Age :</label>
            <div class="col-lg-2-0">
              <span class="input-xlarge uneditable-input text-control"><?php echo $father_age;?></span>
            </div>                    
       </div>
                  
         <div class="control-group">
               <label for="inputEmp_Mother" class="col-lg-2-0 control-label text-right">Mother Name :</label>
                <div class="col-lg-4">
                  <span class="input-xlarge uneditable-input text-control"><?php echo $mother_name;?></span>
                </div>
              <label for="inputMother_occupation" class="col-lg-1-6 control-label text-right">Occupation :</label>
                <div class="col-lg-2-0">
                  <span class="input-xlarge uneditable-input text-control"><?php echo $mother_work;?></span>
                </div>
              <label for="inputEmpMother_age" class="col-lg-1-3 control-label text-right">Age :</label>
                <div class="col-lg-2-0">
                  <span class="input-xlarge uneditable-input text-control"><?php echo $mother_age;?></span>
                </div> 
              </div>                             
      <div class="clear"></div> 
 </div> <!------------------------End Employee information --------------------------------->
  
  <div class="panel panel-success">    <!------------------------START Official Information --------------------------------->			  				 							   <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-sun-o"></i>&nbsp;&nbsp; Official Use only<a class="text-right pull-right navbar-link" href="employee_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a></h3></div>
         <div class="control-group">
           <label class="col-lg-2">Emp ID</label>       
           <label class="col-lg-1-7">Department</label>
           <label class="col-lg-2">Designation</label>        
           <label class="col-lg-2">Reporting To</label>       
           <label class="col-lg-1-6">Joinning Date</label>       
           <label class="col-lg-1-5">Salary/pm</label>       
           <label class="col-lg-1-5">Annual CTC</label>
         </div>
       
  <div class="control-group">
      <div class="col-lg-2">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo $emp_id;?></span>
      </div>
      <div class="col-lg-1-7">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo showDeptName($con, $emp_dept_id);?></span>
      </div>
      <div class="col-lg-2">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo showDesignation($con, $emp_desig_id);?></span>
      </div>
      <div class="col-lg-2">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo showDesignation($con, $emp_reportingOfficer_id);?></span>
      </div>
      <div class="col-lg-1-6">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo date("d-M-Y", strtotime($emp_joining_date));?></span>
      </div>
      <div class="col-lg-1-5">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo "Rs. ".number_format($emp_salary, 2, '.', ',');?></span>
      </div>
      <div class="col-lg-1-5">
      <span class="input-xlarge uneditable-input text-control text-left"><?php echo "Rs. ".number_format($annual_ctc, 2, '.', ',');?></span>
      </div>
   </div>
<div class="clear"></div>
</div> 
  
  <div class="form-group">
        <div class="col-lg-offset-5 col-lg-2">
          <a href="employee_personal_edit.php?table_emp_sl=<?php echo $table_emp_sl; ?>" style="text-decoration:none;"><button type="submit" class="btn btn-primary btn-block" id="emp_submit" name="emp_submit" style="font-size:16px;">Edit</button></a>
        </div>       
 <div class="clear"></div>
</div> <!--------------------------------------------------END Official Information -------------------------------->


 <div class="panel panel-success">   <!---------------------------------- START Employee Qualification --------------------------------->				  		 <div class="panel-heading">
 <h3 class="panel-title"><i class="fa fa-book fa-spin fa-fw fa-lg"></i> Employee Qualification
 <a class="text-right pull-right navbar-link" href="employee_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
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
$result_qualf = mysqli_query($con, "SELECT * FROM `emp_qualification_tbl` WHERE `EQ_emp_sl` = '$table_emp_sl'");
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
    <input type="text" style="width:112px; margin-right:10px;" name="emp_qualf" id="emp_qualf" rel="3" />
    <input type="text" style="width:100px; margin-right:10px;" name="faculty" id="faculty" rel="4" />
    <input type="text" style="width:140px; margin-right:10px;" name="institute" id="institute" rel="5" />
    <input type="text" style="width:140px; margin-right:10px;" name="board_univ" id="board_univ" rel="6" />
    <input type="text" style="width:71px; margin-right:10px;"  name="mark_obt" id="mark_obt" rel="7" />
    <input type="text" style="width:71px; margin-right:10px;"  name="total" id="total" rel="8" />
    <input type="text" style="width:75px; margin-right:5px;"   name="per_grade" id="per_grade" rel="9" />
    <input type="text" style="width:75px; margin-right:0px;"   name="division" id="division" rel="10" />
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
    <input type="text" style="width:112px; margin-right:10px;" name="emp_qualf" id="emp_qualf" rel="3" />
    <input type="text" style="width:100px; margin-right:10px;" name="faculty" id="faculty" rel="4" />
    <input type="text" style="width:140px; margin-right:10px;" name="institute" id="institute" rel="5" />
    <input type="text" style="width:140px; margin-right:10px;" name="board_univ" id="board_univ" rel="6" />
    <input type="text" style="width:71px; margin-right:10px;" name="mark_obt" id="mark_obt" rel="7" />
    <input type="text" style="width:71px; margin-right:10px;" name="total" id="total" rel="8" />
    <input type="text" style="width:75px; margin-right:5px;"  name="per_grade" id="per_grade" rel="9" />
    <input type="text" style="width:75px; margin-right:0px;" name="division" id="division" rel="10" />
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
<h3 class="panel-title"><i class="fa fa-book"></i>&nbsp;&nbsp; Previous Experiences
<a class="text-right pull-right navbar-link " href="employee_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
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
$result_exp = mysqli_query($con, "SELECT * FROM `emp_prev_company` WHERE `PC_emp_sl` = '$table_emp_sl'");
$sl_no=1;
while ($exp = mysqli_fetch_array($result_exp))
{
?>
 <tr id="<?php echo $exp['emp_prev_comp_id'] ; ?>">
    <td style="display:none;"><?php echo $exp['emp_prev_comp_id']; ?></td>
    <td style="display:none;"><?php echo $table_emp_sl; ?></td>
    <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $exp['company_name']; ?> </td>  
    <td class="readonly-bg"><?php echo  $exp['prev_comp_address']; ?> </td> 
	<td class="readonly-bg"><?php echo $exp['prev_depmt']; ?> </td>
    <td class="readonly-bg"><?php echo  $exp['prev_position']; ?> </td>		 
    <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($exp['prev_joined_date'])); ?> </td>
    <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($exp['prev_exit_date'])); ?> </td>   
    <td class="readonly-bg"><?php echo  $exp['total_year'];?> </td>
    <td style="cursor:pointer;"><a class="table-action-EditData navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>

<!---------------------------------------- Form for Edit experience------------------------->

<form id="formEditData" action="ajax_exper_update.php" title="Update selected row"> 
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
    <input style="width:160px; margin-right:10px;" type="text" name="prev_comp" id="prev_comp" rel="3" />
    <input type="text" name="company_address" id="company_address" style="width:156px; margin-right:10px;" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="company_dept" id="company_dept" rel="5" />
    <input type="text" name="prev_designation" id="prev_designation" style="width:130px; margin-right:10px;" rel="6" />
    <input style="width:111px; margin-right:10px;" type="text" name="joined_date" id="joined_date_edit" rel="7" readonly />
    <input style="width:113px; margin-right:10px;" type="text" name="last_date" id="last_date_edit" rel="8" readonly />
    <input style="width:75px;  margin-right:0px; cursor:not-allowed;"  type="text" name="total_year" id="total_year_edit" readonly rel="9" />
  <br /> 
    <span class="datafield" style="display:none" rel="10"><a class="table-action-EditData">Edit</a></span>
    <br />
    <button id="formEditDataCancel" type="button">Cancel</button>      
    <button id="formEditDataOk" type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new experience------------------------->
<form id="formNew_experience" action="#"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
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
    <input style="width:160px; margin-right:10px;" type="text" name="prev_comp" id="prev_comp" rel="3" />
    <input type="text" name="company_address" id="company_address" style="width:156px; margin-right:10px;" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="company_dept" id="company_dept" rel="5" />
    <input type="text" name="prev_designation" id="prev_designation" style="width:130px; margin-right:10px;" rel="6" />
    <input style="width:111px; margin-right:10px;" type="text" name="joined_date" id="joined_date" readonly rel="7" />
    <input style="width:113px; margin-right:10px;" type="text" name="last_date" id="last_date" readonly rel="8" />
    <input style="width:75px;  margin-right:0px; cursor:not-allowed;"  type="text" name="total_year" id="total_year" readonly rel="9" />
  <br />
   <br />      
   <button id="btnAddNewRowCancel2" value="cancel">Cancel</button>
   <button id="btnAddNewRowOk2" value="Ok">Okay</button>  
     <br /> 
   <span class="datafield" style="display:none" rel="10"><a class="table-action-EditData">Edit</a></span>  
</form>
<button id="btnDeleteRow2">Delete</button> <button id="btnAddNewRow2">Add</button>     
</div>  <!------------------------------------------- END Previous Experience Information ---------------------------------------->
         

<?php
}
?>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ob_flush(); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
<script src="js/employee_detail.js" type="text/javascript"></script>
</body>
</html>
<?php } ob_flush();?>