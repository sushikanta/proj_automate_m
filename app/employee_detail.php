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
<title>HR - Employee Detail</title>
<?php require_once("css_bootstrap_datatable_header.php"); ob_start();?> 
<body>
<?php require_once("right_top_header_hr.php");?>
<div class="container">
 <div class="page-content">
 
<?php 
if(isset($_GET['table_emp_sl']))
{
$table_emp_sl = $_GET['table_emp_sl'];
$result_table = mysqli_query($con, "SELECT `employee_tbl`.*, `marital_tbl`.`marital_name` FROM `employee_tbl` LEFT JOIN `marital_tbl` ON `marital_tbl`.`marital_id` = `employee_tbl`.`EMP_marital` WHERE `employee_tbl`.`EMP_sl` = '$table_emp_sl'");
  while ($row = mysqli_fetch_array($result_table))
   {
	   $emp_id = $row['EMP_id'];
	   $emp_name = $row['EMP_name'];
	   $emp_dob = date("d-M-Y", strtotime($row['EMP_dob']));
	   $emp_gender = $row['EMP_gender'];
	    $emp_marital = $row['EMP_marital'];
	   $marital_name = $row['marital_name'];
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
 
<div class="panel panel-success">  <!----------------------START Employee Information-------------->
    
    <div class="panel-heading"><h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-cubes fa-fw fa-lg"></i> Employee information
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span>
    <a class="text-right pull-right navbar-link no-print" href="employee_table.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
    </h3></div>		 
    
 <div class="panel-body">       
    <div class="row">
      <label for="inputEmployee_name" class="col-lg-2-0 control-label text-right">Employee Name :</label>
      <div class="col-lg-2"><?php if($emp_name ==""){echo "";}else{ echo $emp_name;}?></div>
     
      <label for="inputEmp_dob" class="col-lg-1-4 control-label text-right">DoB :</label>
      <div class="col-lg-1-6"><?php if($emp_dob ==""){echo "";}else{ echo $emp_dob;}?></div>
     
      <label for="inputEmp_sex" class="col-lg-1-4 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
      <div class="col-lg-1-5"><?php if ($emp_gender =='1'){echo "Male";} else if($emp_gender =='2'){echo "Female";}?></div>
           
      <label for="inputEmp_marital" class="col-lg-1-5 control-label text-right">Marital Status :</label>
      <div class="col-lg-1-4"><?php if($marital_name==""){echo "";}else{echo $marital_name;}?></div>           
    </div>
         
    
    <div class="row">          	
         <label for="inputEmp_email" class="col-lg-2-0 control-label text-right">Email :</label>
            <div class="col-lg-2"><?php if($emp_email==""){echo "";}else{ echo $emp_email;}?></div>
                      
         <label for="inputEmp_phone" class="col-lg-1-4 control-label text-right"><i class="fa fa-phone-square fa-lg"></i> :</label>
            <div class="col-lg-1-4"><?php if($emp_phone=="0"){echo "";}else{ echo "+91 ".$emp_phone;}?></div>
                       
         <label for="inputpresent_pin" class="col-lg-1-6 control-label text-right">Emergency <i class="fa fa-phone-square fa-lg"></i> :</label>
         <div class="col-lg-1-5"><?php if($emergency_no=="0"){echo "";}else{echo "+91 ".$emergency_no;}?></div>
         
         <label for="inputpresent_pin" class="col-lg-1-5 control-label text-right">Qualification :</label>
         <div class="col-lg-1-1"><?php $qual_no = showNumOfQualification($con, $table_emp_sl); if($qual_no > 0){echo "Yes";}else{echo "No";}?></div>
     </div>
    
  		<?php if($emp_marital =='0' OR $emp_marital =='1' OR $emp_marital =='3' OR $emp_marital =='6' OR $emp_marital =='7') { ?>
        <div class="row">
          
          <label for="inputEmp_father" class="col-lg-2-0 control-label text-right">Father Name :</label>
            <div class="col-lg-2"><?php echo $father_name;?></div>
            
          <label for="inputFather_occupation" class="col-lg-1-4 control-label text-right">Occupation :</label>
            <div class="col-lg-1-6"><?php echo $father_work;?></div>
            
          <label for="inputFather_age" class="col-lg-1-4 control-label text-right">Age :</label>
            <div class="col-lg-1-5"><?php if($father_age=="0"){echo "";}else{ echo $father_age;}?></div>  
            
           <label for="inputpresent_pin" class="col-lg-1-5 control-label text-right">Experience :</label>
         <div class="col-lg-1-6"><?php $exper_no = showNumOfExperience($con, $table_emp_sl); if($exper_no > 0){echo "Yes";}else{echo "No";} ?></div>           
       </div>
                  
         <div class="row">
               <label for="inputEmp_Mother" class="col-lg-2-0 control-label text-right">Mother Name :</label>
               <div class="col-lg-2"><?php echo $mother_name;?></div>
                
              <label for="inputMother_occupation" class="col-lg-1-4 control-label text-right">Occupation :</label>
                <div class="col-lg-1-6"><?php echo $mother_work;?></div>
                
              <label for="inputEmpMother_age" class="col-lg-1-4 control-label text-right">Age :</label>
                <div class="col-lg-1-5"><?php if($mother_age=="0"){echo "";}else{ echo $mother_age;}?></div> 
              <label for="inputpresent_pin" class="col-lg-1-5 control-label text-right">Letters sent :</label>
         <div class="col-lg-1-6"><?php $letter_no = countNo_of_letter($con, $table_emp_sl); if($letter_no > 0){echo "Yes";}else{echo "No";} ?></div>   
         </div> 
         <?php }?>
         
          <?php if($emp_marital =='2' OR $emp_marital =='4' OR $emp_marital =='5') { ?>
         <div class="row">
               <label for="spause_name" class="col-lg-2-0 control-label text-right">Spause Name :</label>
               <div class="col-lg-2"><?php echo $spause_name;?></div>
                
              <label for="spause_work" class="col-lg-1-4 control-label text-right">Occupation :</label>
                <div class="col-lg-1-6"><?php echo $spause_work;?></div>
                
              <label for="spause_age" class="col-lg-1-4 control-label text-right">Age :</label>
                <div class="col-lg-1-5"><?php if($spause_age=="0"){echo "";}else{ echo $spause_age;}?></div> 
                
         </div> 
         
         <div class="row">
           <label for="inputpresent_pin" class="col-lg-2-0 control-label text-right">Experience :</label>
           <div class="col-lg-2"><?php $exper_no = showNumOfExperience($con, $table_emp_sl); if($exper_no > 0){echo "Yes";}else{echo "No";} ?></div>
           <label for="inputpresent_pin" class="col-lg-1-4 control-label text-right">Letters sent :</label>
           <div class="col-lg-1-6"><?php $letter_no = countNo_of_letter($con, $table_emp_sl); if($letter_no > 0){echo "Yes";}else{echo "No";} ?></div>   
         </div> 
          <?php }?>
      
        <?php 
if($Q_present_address =='1')
{ 

?>   
    <div class="row" id="permanentAddress_div"> <!-----------------------Employee Permanent Address------------------------------>
       <label for="inputPermanent_address" class="col-lg-2-0 control-label text-right">Permanent Address :</label>
          <div class="col-lg-9">
           	  <address>
				<?php echo $perm_address;?><br>
            	<?php if ( $perm_district =='0'){echo "";}else{echo showDistrictName($con, $perm_district);} ?><br>
                <?php echo showStateName($con, $perm_state); if($perm_pin =='0'){echo "";}else{echo ' - '.$perm_pin;}?>
              </address>
           </div>    
     </div> 
     <?php }
	 elseif($Q_present_address =='2')
{ 
?>             
  <div class="row" id="presentAddress_div">  <!-----------------------Employee Temporary Address------------------------------->
    <label for="inputPresent_address" class="col-lg-2-0 control-label text-right">Present Address :</label>
    <div class="col-lg-4">
    <address>
    <?php echo $present_address;?><br>
    <?php if ( $present_district =='0'){echo "";}else{ echo showDistrictName($con, $present_district); }?><br>
    <?php echo showStateName($con, $present_state); if($present_pin =='0'){echo "";}else{echo ' - '.$present_pin; } ?>
    </address>
    </div>
    
    <label for="inputPermanent_address" class="col-lg-1-7 control-label text-right">Permanent Address :</label>
      <div class="col-lg-3">
         <address>
            <?php echo $perm_address;?><br>
            <?php if ( $perm_district =='0'){echo "";}else{ echo showDistrictName($con, $perm_district); } ?><br>
            <?php echo showStateName($con, $perm_state); if($present_pin =='0'){echo "";}else{ echo ' - '.$perm_pin;}?>
          </address>
        </div>    
   </div>    
         <?php }?>     
</div><!--------END Panel-body----->

<div style="padding:5px;0px;"></div>

<?php if($qual_no > 0)
{ 
	?>
<!----------------------Qualificaiton TABLE---------->
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-book fa-fw fa-lg success"></i> Qualification information</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="qualf_table">
        <thead align="left">
        <tr>
          <th style="width:2%;"> # </th>
          <th style="width:10%;"> Qualification</th>
          <th style="width:10%;"> Faculty</th>
          <th style="width:10%;"> Institute</th>
          <th style="width:10%;"> Board/University</th>
          <th style="width:8%;"> Mark Obtained</th>
          <th style="width:5%;"> Total</th>
          <th style="width:6%;"> Per(%)/Grade</th>
          <th style="width:6%;"> Division</th> 
          <th style="width:7%;"> Passing yr</th> 
          <th style="width:3%;"> Duration</th>   
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
      <td class="readonly-bg"><?php echo  $qual['course_duration']." years";?> </td>     
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>    
</div>
<?php } 

if($exper_no > 0)
 {
   ?>
<!----------------START Employee Experience------------------>
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-bolt fa-fw fa-lg success"></i> Previous Experiences</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="exp_table">
        <thead align="left">
        <tr>
          <th style="width:2%;"> # </th>
          <th style="width:10%;"> Prev. Organisation</th>
          <th style="width:20%;"> Address</th>
          <th style="width:10%;"> Department</th>
          <th style="width:10%;"> Designation</th>
          <th style="width:10%;"> Joined Date</th>
          <th style="width:10%;"> Last Date</th>
          <th style="width:6%;"> Total</th>
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
    <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $exp['company_name']; ?> </td>  
    <td class="readonly-bg"><?php echo  $exp['prev_comp_address']; ?> </td> 
	<td class="readonly-bg"><?php echo $exp['prev_depmt']; ?> </td>
    <td class="readonly-bg"><?php echo  $exp['prev_position']; ?> </td>		 
    <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($exp['prev_joined_date'])); ?> </td>
    <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($exp['prev_exit_date'])); ?> </td>   
    <td class="readonly-bg"><?php echo  $exp['total_year']." years";?> </td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
</div>
<?php }

if($letter_no > 0)
{
?>
<!----------------START Employee Letters------------------>
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-envelope fa-fw fa-lg success"></i> Letter information</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="exp_table">
        <thead align="left">
        <tr>
          <th style="width: 10%;"> # </th>
          <th style="width: 30%;"> Letter Type</th>
          <th style="width: 40%;"> Remark</th>
          <th style="width: 20%;"> Date</th>
        </tr>
        </thead>
  <tbody>
<?php

$result_letter = mysqli_query($con, "SELECT `employee_letter`.*, `letter_type_tbl`.`letter_type` FROM `employee_letter` LEFT JOIN `letter_type_tbl` ON `letter_type_tbl`.`letter_type_id` = `employee_letter`.`EL_letter_type_id` WHERE `employee_letter`.`EL_emp_sl` = '$table_emp_sl'");
$sl_no=1;
while ($letter = mysqli_fetch_array($result_letter))
{
?>
 <tr>
    <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $letter['letter_type']; ?> </td>  
    <td class="readonly-bg"><?php echo $letter['EL_letter_detail']; ?> </td> 
	<td class="readonly-bg"><?php echo date("d-M-Y", strtotime($letter['EL_date'])); ?> </td>
   
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
</div>
<?php }?>


<!-----------------Official information------------>
<div class="row zero-margin">
<div style="color:#0D9707;"><h3 class="page-title"><i class="fa fa-sun-o fa-spin fa-fw fa-lg success"></i> Official information</h3></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="qualf_table">
        <thead align="left">
        <tr>
          <th style="width:10%;"> Emp ID</th>
          <th style="width:13%;"> Department</th>
          <th style="width:15%;"> Designation</th>
          <th style="width:15%;"> Reported To</th>
          <th style="width:12%;"> Joined on</th>
          <th style="width:12%;"> Salary@PerMonth</th>
          <th style="width:12%;"> Annual CTC</th>
         </tr>
       </thead>
     
  <tbody>
 <tr>
      <td class="readonly-bg"><?php echo  $emp_id; ?> </td>  
      <td class="readonly-bg"><?php if ($emp_dept_id=="0"){echo "";} else{ echo  showDeptName($con, $emp_dept_id);} ?></td>
      <td class="readonly-bg"><?php if ($emp_desig_id=="0"){echo "";} else{ echo  showDesignation($con, $emp_desig_id);} ?></td> 
      <td class="readonly-bg"><?php if ($emp_reportingOfficer_id=="0"){echo "";} else{ echo  showDesignation($con, $emp_reportingOfficer_id);} ?></td>
      <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($emp_joining_date)); ?></td>		 
      <td class="readonly-bg"><?php if ($emp_salary==""){echo "";} else{echo  "Rs. ".number_format($emp_salary, 2, '.', ',');} ?></td>
      <td class="readonly-bg"><?php if ($annual_ctc==""){echo "";} else{echo  "Rs. ".number_format($annual_ctc, 2, '.', ','); } ?></td>   
 </tr>
<tbody>
</table>    
</div>
<div class="panel-footer">
<div class="row">
	<div class="col-lg-offset-2 col-lg-8">
          <a href="employee_personal_edit.php?table_emp_sl=<?php echo $table_emp_sl; ?>"><button type="submit" class="btn btn-primary btn-block" id="emp_submit" name="emp_submit" style="font-size:16px;">Add / Edit &nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp;&nbsp; Employee Informaion | Qualification | Experience | Letter</button></a>
        </div>  
         </div> 
</div>

</div> <!------------------------End Panel --------------------------------->

<?php
}
?>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ob_flush(); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
</body>
</html>
<?php } ob_flush();?>