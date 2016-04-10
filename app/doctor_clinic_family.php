<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php"); ob_start();?> 
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">        
<?php
if(isset($_GET['dr_submit']))
{
 $dr_id_pass = $_GET['dr_id'];
if($_GET['dr_clinicOption'] == "Yes" && $_GET['dr_familyOption'] == "Yes")
{   $dr_clinicOption = $_GET['dr_clinicOption'];
	$dr_familyOption = $_GET['dr_familyOption'];
	mysqli_query($con, "UPDATE `dr_profile` SET `clinic_Q` = '$dr_clinicOption', `family_Q` = '$dr_familyOption' WHERE `dr_id` = '$dr_id_pass'");
	}		
else if ($_GET['dr_clinicOption'] == "Yes" && $_GET['dr_familyOption'] == "No")
 {  $dr_clinicOption = $_GET['dr_clinicOption'];
	$dr_familyOption = $_GET['dr_familyOption'];
	mysqli_query($con, "UPDATE `dr_profile` SET `clinic_Q` = '$dr_clinicOption', `family_Q` = '$dr_familyOption' WHERE `dr_id` = '$dr_id_pass'");
	}	 
else if($_GET['dr_clinicOption'] == "No" && $_GET['dr_familyOption'] == "Yes")
{  $dr_clinicOption = $_GET['dr_clinicOption'];
	$dr_familyOption = $_GET['dr_familyOption'];
	mysqli_query($con, "UPDATE `dr_profile` SET `clinic_Q` = '$dr_clinicOption', `family_Q` = '$dr_familyOption' WHERE `dr_id` = '$dr_id_pass'");
	} 
else if(isset($_GET['dr_clinicOption']) && $_GET['dr_clinicOption'] == "No" && isset($_GET['dr_familyOption']) && $_GET['dr_familyOption'] == "No")
{ $dr_clinicOption = $_GET['dr_clinicOption'];
	$dr_familyOption = $_GET['dr_familyOption'];
	mysqli_query($con, "UPDATE `dr_profile` SET `clinic_Q` = '$dr_clinicOption', `family_Q` = '$dr_familyOption' WHERE `dr_id` = '$dr_id_pass'");
	} 
header("location: doctor_table.php");
   
}
?>        
      
       
<div class="inv-main">
<?php 

if(isset($_GET['dr_id']))
{
	
	$dr_id_pass = $_GET['dr_id'];
?>

<div class="panel panel-success" id="dr_clinic_infoPanel">   <!---------------------------------- START Clinic section --------------------------------->				  	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-medkit"></i> Clinic Information</h3>
    </div>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="clinic_table">
        <thead align="left">
        <tr>
          <th style="display: none;"> clinic_id</th>
          <th style="display: none;"> dr_id</th>
          <th> # </th>
          <th> Clinic Name</th>          
          <th> Address</th>
          <th> Phone</th>
          <th><i class="fa fa-edit"></i> Edit</th>    
        </tr>
       </thead>     
  <tbody>
<?php
$result_clinic = mysqli_query($con, "SELECT * FROM `dr_clinic_tbl` WHERE `dr_id` = '$dr_id_pass'");
$sl_no=1;
while ($clinic = mysqli_fetch_array($result_clinic))
{
?>
 <tr id="<?php echo $clinic['clinic_id'] ; ?>">
      <td style="display:none;"> <?php echo $clinic['clinic_id']; ?></td>
      <td style="display:none;"> <?php echo $clinic['dr_id']; ?></td>
      <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo  $clinic['clinic_name']; ?> </td>  
      <td class="readonly-bg"><?php echo  $clinic['clinic_address']; ?> </td> 
      <td class="readonly-bg"><?php echo  $clinic['clinic_phone']; ?> </td>
      <td><a class="table-action-EditClinic navbar-link" style="cursor:pointer;"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>    
<!---------------------------------------- Form for Edit clinic ------------------------->
<form id="formEditClinic" action="ajax_clinic_update.php" title="Update selected row">  

 <label style="display:none;">Clinic_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:43px;">#</label>
 <label style="margin-right:97px">Clinic Name</label>
 <label style="margin-right:130px;">Address</label>
 <label style="margin-right:32px;">Phone</label>
 <br />
    <input type="hidden" name="hidden_clinic_id" id="hidden_clinic_id" value="<?php echo $clinic['emp_clinicf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $clinic['dr_id']; ?>" rel="1"/>   
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_name" id="clinic_name" rel="3" />
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_address" id="clinic_address" rel="4" />
    <input type="text" style="width:110px; margin-right:10px;" name="clinic_phone" id="clinic_phone" rel="5" />  
 <br /> 
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditClinic navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
    <br />
    <button id="formEditClinicCancel" type="button">Cancel</button>      
    <button id="formEditClinicOk"     type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new clinic---------------------------->
<form id="formNewClinic" action="#"> 
<label id="lblAddError1" style="display:none" class="error"></label>
 <div id="processing_message1" style="display:none" title="Processing">Please wait while processing....</div>
 
 <label style="display:none;">Clinic_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:43px;">#</label>
 <label style="margin-right:97px">Clinic Name</label>
 <label style="margin-right:290px;">Address</label>
 <label style="margin-right:32px;">Phone</label>
 <br />
    <input type="hidden" name="hidden_clinic_id" id="hidden_clinic_id" value="<?php echo $clinic['emp_clinicf_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $dr_id_pass; ?>" rel="1"/>   
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input type="text" style="width:190px; margin-right:10px;" name="clinic_name" id="clinic_name" rel="3" />
    <input type="text" style="width:350px; margin-right:10px;" name="clinic_address" id="clinic_address" rel="4" />
    <input type="text" style="width:110px; margin-right:10px;" name="clinic_phone" id="clinic_phone" rel="5" />  
    <br/ >
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditClinic">Edit</a></span>
    <br/ >
    <button id="btnAddNewRowCancel1" type="button">Cancel</button>      
    <button id="btnAddNewRowOk1" type="submit">Confirm</button> 
   </form> 
<button id="btnDeleteRow1">Delete</button> <button id="btnAddNewRow1">Add</button>
</div> <!------------------------------------------- END clinic -------------------------------------------->   

<div class="panel panel-success" id="dr_family_infoPanel">   <!------------------------START Doctor's Family section ------------------>				  				 <div class="panel-heading"> <h3 class="panel-title"><i class="fa fa-home"></i> Doctor's Dear ones Info</h3></div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="family_table">
     <thead align="left">
        <tr>
          <th style="display: none;"> dr_family_id</th>
          <th style="display: none;"> dr_id</th>
          <th > # </th>
          <th> Name</th>
          <th> Relation</th>
          <th> Date of Birth</th>
          <th><i class="fa fa-edit"></i> Edit</th>       
        </tr>
      </thead>     
<tbody>
<?php
$result_family = mysqli_query($con, "SELECT * FROM `dr_family_tbl` WHERE `family_dr_id` = '$dr_id_pass'");
$sl_no=1;
while ($fam = mysqli_fetch_array($result_family))
{
?>
 <tr id="<?php echo $fam['family_id'] ; ?>">
    <td style="display:none;"> <?php echo $fam['family_id']; ?></td>
    <td style="display:none;"> <?php echo $fam['family_dr_id']; ?></td>
    <td class="readonly-bg"> <?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $fam['family_name']; ?> </td>  
    <td class="readonly-bg"><?php echo  $fam['family_relation']; ?> </td> 
	<td class="readonly-bg"><?php echo date("d-M-Y", strtotime($fam['family_dob'])); ?> </td>
    <td><a class="table-action-EditFamily navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

<!---------------------------------------- Form for Edit experience------------------------->

<form id="formEditFamily" action="ajax_family_update.php" title="Update selected row"> 

 <label style="display:none;">Family_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:210px">Name</label>
 <label style="margin-right:96px;">Relation</label>
 <label style="margin-right:0px;">DOB</label>
 <br />
	<input type="hidden" name="hidden_family_id" id="hidden_family_id" value="<?php echo $fam['family_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id"    id="hidden_dr_id"    value="<?php echo $fam['dr_id']; ?>" rel="1"/> 
    <input style="width:45px; margin-right:10px;"  type="text" name="sl_no" id="sl_no"  value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:250px; margin-right:10px;" type="text" name="family_name" id="family_name" rel="3" />
    <input style="width:156px; margin-right:10px;" type="text" name="family_relation" id="family_relation" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="family_dob" id="family_dob_edit" readonly rel="5" />
 <br /> 
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditData navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
    <br />
    <button id="formEditFamilyCancel" type="button">Cancel</button>      
    <button id="formEditFamilyOk" type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new family------------------------->
<form id="formNewFamily" action="#"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
 <label style="display:none;">Family_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:210px">Name</label>
 <label style="margin-right:96px;">Relation</label>
 <label style="margin-right:0px;">Date of Birth</label>
 <br />
	<input type="hidden" name="hidden_family_id" id="hidden_family_id" value="<?php echo $fam['family_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $dr_id_pass; ?>" rel="1"/> 
    <input style="width:45px; margin-right:10px;"  type="text" name="sl_no" id="sl_no"  value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:250px; margin-right:10px;" type="text" name="family_name" id="family_name" rel="3" />
    <input style="width:156px; margin-right:10px;" type="text" name="family_relation" id="family_relation" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="family_dob" id="family_dob" readonly rel="5" />
   <br />      
     <span class="datafield" style="display:none" rel="6"><a class="table-action-EditFamily navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
           <br />
    <button id="btnAddNewRowCancel2" type="button">Cancel</button>      
    <button id="btnAddNewRowOk2" type="submit">Confirm</button> 
</form>
<button id="btnDeleteRow2">Delete</button> <button id="btnAddNewRow2">Add</button>

</div>  <!------------------------------------------- END FAMILY ----------------------------------------> 

<form class="form-horizontal inv-form" role="form" name="doctor_profile_form" method="get" action="#">
 <div class="panel panel-success"> <!-----------------START Doctor Information--------------->
     <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user-md"></i> Extra Information</h3>
     </div>
    <div class="form-group">
        <input type="hidden" name="dr_id" value="<?php echo $_GET['dr_id'];?>" />
     
        <label for="inputClinic" class="col-lg-3 control-label">Does ' Dr. <?php if(isset($_GET['dr_name'])){echo $_GET['dr_name'];} ?> ' has clinic ?</label>
        <div class="col-lg-3">					      
        <label class="radio-inline">
            <input  type="radio" name="dr_clinicOption" id="clinic_yes" value="Yes">Yes
        </label>
        <label class="radio-inline">
            <input type="radio" name="dr_clinicOption" id="clinic_no" value="No" checked>No
        </label>
        </div>	
        
        <label for="inputFamily" class="col-lg-3 control-label">Does ' Dr. <?php if(isset($_GET['dr_name'])){echo $_GET['dr_name'];}?> ' has dear ones ?</label>
        <div class="col-lg-3">					      
        <label class="radio-inline">
            <input  type="radio" name="dr_familyOption" id="family_yes" value="Yes">Yes
        </label>
        <label class="radio-inline">
            <input type="radio" name="dr_familyOption" id="family_no" value="No" checked>No
        </label>
        </div>	
    </div>
 </div>  	   	
      <div class="form-group">
        <div class="col-lg-offset-5 col-lg-2">
          <button type="submit" class="btn btn-primary btn-block" id="dr_submit" name="dr_submit" style="font-size:16px;">Submit</button>
        </div>  
      </div>         
</form> <!------------------------------------------- form end ------------------------------------------------->



<?php } ?>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>     
 <script src="js/doctor_clinic_family.js"  type="text/javascript"></script>
</body>
</html>