<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Doctor Info</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?>
</head>
<body>

<?php require_once("right_top_header_popup.php"); ?>
<div class="container">
 <div class="page-content">
<?php

if(isset($_GET['dr_submit']))
{

   $dr_id = mysqli_real_escape_string($con, $_GET['dr_id']);
   $dr_name = ucwords(mysqli_real_escape_string($con, $_GET['dr_name']));
   $dr_gender = $_GET['dr_gender'];
   $_dr_dob =$_GET['dr_dob'];
   if($_dr_dob !='0000-00-00'){$dr_dob = date("Y-m-d", strtotime($_GET['dr_dob']));}else{$dr_dob ='0000-00-00';}
   $dr_marital = $_GET['dr_marital'];

   $dr_email = mysqli_real_escape_string($con, $_GET['dr_email']);
   $dr_phone = mysqli_real_escape_string($con, $_GET['dr_phone']);
   $p_address = mysqli_real_escape_string($con, $_GET['permanent_address']);
   $p_state = mysqli_real_escape_string($con, $_GET['hidden_permanent_state']);
   $p_district = mysqli_real_escape_string($con, $_GET['hidden_permanent_district']);
   $p_pin = mysqli_real_escape_string($con, $_GET['permanent_pin']);


   $dr_specialization = ucwords(mysqli_real_escape_string($con, $_GET['dr_specialization']));
   $dr_designation = ucwords(mysqli_real_escape_string($con, $_GET['dr_designation']));
   $dr_institute = ucwords(mysqli_real_escape_string($con, $_GET['dr_institute']));

   $same_address = mysqli_real_escape_string($con, $_GET['same_address']);
   $work_info = mysqli_real_escape_string($con, $_GET['work_info']);
   $DCA_id = mysqli_real_escape_string($con, $_GET['DCA_id']);
   $dp_id = mysqli_real_escape_string($con, $_GET['dp_id']);


    /*------------ TRANSACTION - START ------------*/
	  mysqli_autocommit($con, false);
	  $flag = true;

	  mysqli_query($con, "UPDATE dr_info SET dr_name = '".$dr_name."', dr_phone = '".$dr_phone."', dr_email = '".$dr_email."', dr_dob = '".$dr_dob."', dr_address = '".$p_address."', dr_state = '$p_state', dr_district = '$p_district', dr_pin = '$p_pin', dr_gender = '$dr_gender', dr_marital = '$dr_marital' WHERE dr_id = '$dr_id'");
	  if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: dr_info" . mysqli_error($con) . ".";}

	if($same_address == "2")    //same address = no
	{

		$present_address = ucwords(mysqli_real_escape_string($con, $_GET['present_address']));
		$present_state_id = mysqli_real_escape_string($con, $_GET['hidden_present_state']);
		$present_district_id=mysqli_real_escape_string($con, $_GET['hidden_present_district']);
		$present_pin=mysqli_real_escape_string($con, $_GET['present_pin']);

		if($DCA_id !="")    //if YES RECORD ON C address
		{
		mysqli_query($con, "UPDATE dr_cur_address SET DCA_address = '".$present_address."', DCA_state = '$present_state_id', DCA_district = 'present_district_id', DCA_pin = '".$present_pin."' WHERE DCA_id ='$DCA_id'");
		if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: dr_cur_address" . mysqli_error($con) . ".";}
		}

		if($DCA_id =="")    //if NO RECORD ON C address
		{
		resetCounter($con, 44, 'yy'); // dr_current_address
		$DCA_id = date('y').getCounter($con, 44);
		mysqli_query($con, "INSERT INTO dr_cur_address(DCA_id, DCA_dr_id, DCA_address, DCA_state, DCA_district, DCA_pin) VALUES ('$DCA_id', '$dr_id', '".$present_address."', '$present_state_id', 'present_district_id', '".$present_pin."')");
		if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: dr_cur_address" . mysqli_error($con) . ".";}
		else updateCounter($con, 44);
		}
	}

	if($same_address == "1")    //same address = Yes
	{
		if($DCA_id !="")    //if YES RECORD ON C address
		{
			mysqli_query($con, "DELETE FROM dr_cur_address WHERE DCA_dr_id = '$dr_id'");
		  if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: dr_cur_address " . mysqli_error($con) . ".";}
		}
	}

	if($work_info == "1")    //working = Yes
	{

		$dr_specialization = ucwords(mysqli_real_escape_string($con, $_GET['dr_specialization']));
		$dr_designation = ucwords(mysqli_real_escape_string($con, $_GET['dr_designation']));
		$dr_institute = ucwords(mysqli_real_escape_string($con, $_GET['dr_institute']));

		if($dp_id !="")    //if YES RECORD ON dr_profile
		{
		mysqli_query($con, "UPDATE dr_profile SET dp_specialization = '".$dr_specialization."', dp_designation = '".$dr_designation."', dp_institute = '".$dr_institute."' WHERE dp_id ='$dp_id'");
		if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: dr_profile" . mysqli_error($con) . ".";}
		}

		if($dp_id =="")    //if NO RECORD ON dr_profile
		{
		resetCounter($con, 43, 'yy'); // dr_profile
		$dp_id_x = date('y').getCounter($con, 43);

	    mysqli_query($con, "INSERT INTO dr_profile(dp_id, dp_dr_id, dp_specialization, dp_designation, dp_institute) VALUES ('$dp_id_x', '$dr_id', '".$dr_specialization."', '".$dr_designation."', '".$dr_institute."')");
	if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: dr_profile " . mysqli_error($con) . ".";}
	 else updateCounter($con, 43);
		}
   }

	  if($work_info == '2'){ // no work selected

	  if($dp_id !="")    //if YES RECORD ON dr_profile
		  {
			mysqli_query($con, "DELETE FROM dr_profile WHERE dp_dr_id = '$dr_id'");
		  if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error: dr_profile " . mysqli_error($con) . ".";}
		  }
	  }


   // TRANSACTION - ROLL BACK
		if($flag){
			mysqli_commit($con);
			header("location: doctor_edit.php?dr_id=$dr_id");
			}
		else {
			mysqli_rollback($con);
			echo "Action failed"; http_response_code(404); }
}
?>

<?php

if(isset($_GET['dr_id']) && $_GET['dr_id']!='')
{
	$dr_id = $_GET['dr_id'];
	$result = mysqli_query($con, "SELECT i.dr_name, i.dr_phone, i.dr_email, i.dr_dob, i.dr_address, i.dr_state, i.dr_district, i.dr_pin, i.dr_gender, i.dr_marital, s.state_name, d.district_name, p.dp_id, p.dp_specialization, p.dp_designation, p.dp_institute, c.DCA_id, c.DCA_address, c.DCA_state, c.DCA_district, c.DCA_pin, s1.state_name AS c_state, d1.district_name AS c_district FROM dr_info i LEFT JOIN state_tbl s ON s.state_id = i.dr_state LEFT JOIN district_tbl d ON d.district_id = i.dr_district LEFT JOIN dr_profile p ON p.dp_dr_id = i.dr_id LEFT JOIN dr_cur_address c ON c.DCA_dr_id = i.dr_id LEFT JOIN state_tbl s1 ON s1.state_id = c.DCA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.DCA_district WHERE i.dr_id = '$dr_id'");
	$sl_no=1;
	while ($row = mysqli_fetch_array($result))
	{
	  $dr_name = $row['dr_name'];
	  $dr_dob = $row['dr_dob'];
	  $dr_gender = $row['dr_gender'];
	  $dr_marital = $row['dr_marital'];

	  $dr_email =  $row['dr_email'];
	  $dr_phone = $row['dr_phone'];

	  $dr_address = $row['dr_address'];
	  $dr_state = $row['dr_state'];
	  $dr_district = $row['dr_district'];
	  $dr_pin = $row['dr_pin'];

	  $state = $row['state_name'];
	  $district = $row['district_name'];

	  $dp_id = $row['dp_id'];
	  $dp_specialization = $row['dp_specialization'];
	  $dp_designation = $row['dp_designation'];
	  $dp_institute = $row['dp_institute'];

	  $DCA_id = $row['DCA_id'];
	  $DCA_address = $row['DCA_address'];
	  $DCA_state = $row['DCA_state'];
	  $DCA_district = $row['DCA_district'];
	  $DCA_pin=$row['DCA_pin'];
	  $c_state = $row['c_state'];
	  $c_district = $row['c_district'];

	}
	?>

<!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
<div class="inv-main" id="div_main">

<form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_panel1">
 <div class="panel panel-success"> <!-----------------START Doctor Information--------------->
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Doctor ) </span>
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

    <!-----ROW 1 -- -->
    <div class="form-group">

       <div class="form-control-group">
        <label for="inputDoctor_name" class="col-lg-2 control-label">Name - Dr.</label>
        <div class="col-lg-3">
   <input type="text" class="form-control capital" name="dr_name" placeholder="Doctor's name" maxlength="50" required value="<?php echo $dr_name;?>">
   <input type="hidden" name="dr_id" value="<?php echo $dr_id;?>">
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputDoctor_dob" class="col-lg-2 control-label">Date of Birth</label>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="dr_dob" name="dr_dob" readonly value="<?php if($dr_dob !='0000-00-00')echo date("d-M-Y", strtotime($dr_dob));?>">
        </div>
        </div>
        </div>

        <!-----ROW 2 -- -->
       <div class="form-group">
       <div class="form-control-group">
        <label for="inputDoctor_gender" class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-3">
        <label class="radio-inline">
            <input  type="radio" name="dr_gender" value="1" <?php if($dr_gender == "1"){echo "checked";} ?>>Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="dr_gender" value="2" <?php if($dr_gender == "2"){echo "checked";} ?>>Female
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
          <option value="<?php echo $id; ?>" <?php if($id == $dr_marital){echo "selected";} ?>> <?php echo $name; ?></option>
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
        	<input type="email" class="form-control" name="dr_email" placeholder="sample@email.com" maxlength="40" value="<?php echo $dr_email;?>">
        </div>
        </div>

        <div class="form-control-group">
        <label for="inputContact" class="col-lg-2 control-label">Contact No.</label>
        <div class="col-lg-3">
       <input type="text" class="form-control" name="dr_phone" placeholder="Contact No." maxlength="10" value="<?php if($dr_phone !='') echo $dr_phone;?>">
        </div>
        </div>
        </div>

        <div class="form-group">
        <div class="form-control-group">
        <label for="work_info" class="col-lg-2 control-label">Work Info ?</label>
        <div class="col-lg-3">
        <label class="radio-inline">
        <input  type="radio" name="work_info" id="work_yes" value="1" <?php if($dp_id != ""){echo "checked";} ?>>Yes
        </label>
        <label class="radio-inline">
        <input type="radio" name="work_info" id="work_no" value="2" <?php if($dp_id == ""){echo "checked";} ?>>No
        </label>
        </div>
        </div>
        <input type="hidden" name="dp_id" value="<?php echo $dp_id;?>">
        </div>


<!-----ROW 4 -- -->
<div class="form-group" id="div_work">
<div class="form-control-group">
<label for="inputInstitute" class="col-lg-2 control-label">Working at</label>
<div class="col-lg-3">
<input type="text" class="form-control capital" name="dr_institute" placeholder="Institute/Hospital/Clinic" maxlength="50" value="<?php echo $dp_institute;?>">
</div>
</div>

    <div class="form-control-group">
    <label for="inputDesignation" class="col-lg-1 control-label">Position</label>
    <div class="col-lg-2">
    <input type="text" class="form-control capital" name="dr_designation" placeholder="Designation" maxlength="50" value="<?php echo $dp_designation;?>">
    </div>
    </div>

<div class="form-control-group">
<label for="inputSpecialization" class="col-lg-1 control-label">Dept/Spec</label>
<div class="col-lg-2">
<input type="text" class="form-control capital" name="dr_specialization" placeholder="Specialization" maxlength="50" value="<?php echo $dp_specialization;?>">
</div>
</div>
</div>

    <div class="form-group">
    <div class="form-control-group">
    <label for="radioCheckAddress" class="col-lg-2 control-label">Stay at same address ?</label>
    <div class="col-lg-3">
    <label class="radio-inline">
    <input  type="radio" name="same_address" id="same_address_yes" value="1" <?php if($DCA_id == ""){echo "checked";} ?>>Yes
    </label>
    <label class="radio-inline">
    <input type="radio" name="same_address" id="same_address_no" value="2" <?php if($DCA_id != ""){echo "checked";} ?>>No
    </label>
    </div>
    </div>
    <input type="hidden" name="DCA_id" value="<?php echo $DCA_id;?>">
    </div>

 <!--------- Present Address- ----------------->
  <div class="form-group" id="presentAddress_div">
  <div class="form-control-group">
  <label for="present_address" class="col-lg-1-6 control-label">Address 1</label>
  <div class="col-lg-3">
  <input type="text" class="form-control capital" id="present_address" name="present_address" placeholder="Temporary Address" maxlength="50" value="<?php echo $DCA_address;?>">
  </div>
  </div>
      <div class="form-control-group">
      <label for="present_state" class="col-lg-1-4 control-label">State</label>
      <div class="col-lg-2-0">
      <input type="text" class="form-control capital" id="present_state" name="present_state" placeholder="State" value="<?php echo $c_state;?>">
      <input type="hidden" class="form-control" id="hidden_present_state" name="hidden_present_state"  value="<?php echo $DCA_state;?>">
      </div>
      </div>

  <div class="form-control-group">
  <label for="present_district" class="col-lg-1-3 control-label">District</label>
  <div class="col-lg-1-5">
  <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="District" value="<?php echo $c_district;?>">
  <input type="hidden" class="form-control" id="hidden_present_district" name="hidden_present_district" value="<?php echo $DCA_district;?>">
  </div>
  </div>

    <div class="form-control-group">
    <label for="inputpresent_pin" class="col-lg-1-3 control-label">PIN</label>
    <div class="col-lg-1-4">
    <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN" maxlength="6" value="<?php echo $DCA_pin;?>">
    </div>
    </div>
          </div>

<!------------ permanet Address------------------->
  <div class="form-group control-group" id="permanentAddress_div">
  <label for="permanent_address" class="col-lg-1-6 control-label">Address 2</label>
  <div class="col-lg-3">
  <input type="text" class="form-control capital" id="permanent_address" name="permanent_address"  placeholder="permanent Address" maxlength="50"  value="<?php echo $dr_address;?>">
  </div>
  <label for="permanent_state" class="col-lg-1-4 control-label">State</label>
  <div class="col-lg-2-0">
  <input type="text" class="form-control capital" id="permanent_state" name="permanent_state" placeholder="State" value="<?php echo $state;?>">
  <input type="hidden" class="form-control" id="hidden_permanent_state" name="hidden_permanent_state" value="<?php echo $dr_state;?>">

  </div>
  <label for="permanent_district" class="col-lg-1-3 control-label">District</label>
  <div class="col-lg-1-5">
  <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="District" value="<?php echo $district;?>">
  <input type="hidden" class="form-control" id="hidden_permanent_district" name="hidden_permanent_district" value="<?php echo $dr_district;?>">

  </div>
  <label for="permanent_pin" class="col-lg-1-3 control-label">PIN</label>
  <div class="col-lg-1-4">
  <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN" maxlength="6" value="<?php echo $dr_pin;?>">
  </div>
  </div>


      <div class="form-group">
      <div class="col-lg-offset-4 col-lg-4">
      <button type="submit" class="btn btn-primary btn-block" id="dr_submit" name="dr_submit" style="font-size:16px;">Submit</button>
      </div>
      </div>
</form> <!--------------  form end  ----------------->
 </div>



<!--------------- PANEL 2 Clinic  ------------>
<div class="panel panel-success">
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Clinic ) </span>
    </h3>
    </div>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered display" id="clinic_table">
        <thead align="left">
        <tr>
          <th> # </th>
          <th> Clinic Name</th>
          <th> Address</th>
          <th> Phone</th>
         </tr>
       </thead>
  <tbody>
<?php
$result_clinic = mysqli_query($con, "SELECT DC_id, DC_dr_id, DC_clinic, DC_address, DC_phone FROM dr_clinic_tbl WHERE DC_dr_id = '$dr_id'");
$sl_no1=1;
while ($clinic = mysqli_fetch_array($result_clinic))
{
	$DC_id = $clinic['DC_id'];
	$DC_clinic = $clinic['DC_clinic'];
	$DC_address = $clinic['DC_address'];
	$DC_phone = $clinic['DC_phone'];
?>
 <tr id="<?php echo $clinic['DC_id'];?>">
      <td class="readonly-bg" style="width: 10%;"><?php echo $sl_no1; ?> </td>
      <td class="readonly-bg" style="width: 30%;"><?php echo  $DC_clinic; ?> </td>
      <td class="readonly-bg" style="width: 40%;"><?php echo  $DC_address; ?> </td>
      <td class="readonly-bg" style="width: 20%;"><?php echo "+91 ".$DC_phone; ?> </td>
 </tr>
 <?php
	$sl_no1++;
}
?>
</tbody>
</table>

<!---------------------------------------- Form for new clinic---------------------------->
<form id="formNewClinic" action="#"  style="display:none;">
<label id="lblAddError1" style="display:none" class="error"></label>
 <div id="processing_message1" style="display:none" title="Processing">Please wait while processing....</div>
 <label style="margin-right:43px;">#</label>
 <label style="margin-right:156px">Clinic Name</label>
 <label style="margin-right:290px;">Address</label>
 <label style="margin-right:32px;">Phone</label>
 <br />

<input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no1;?>" disabled rel="0" />
<input type="text" style="width:250px; margin-right:10px; text-transform:capitalize;" name="clinic_name"  maxlength="50" rel="1" required />
<input type="text" style="width:350px; margin-right:10px; text-transform:capitalize;" name="clinic_address" maxlength="250" rel="2" />
<input type="text" style="width:150px; margin-right:10px;" name="clinic_phone" maxlength="10" rel="3" />
<input type="hidden" name="dr_id" value="<?php echo $dr_id; ?>"/>
<br/ >
</form>
<button id="btnAddNewRow">Add</button>
<button id="btnDeleteRow">Delete</button>

<div class="clearfix"></div>
</div> <!------------------------------------------- END clinic -------------------------------------------->


<!------------------------START Doctor's Family section ------------------>
<div class="panel panel-success">
 <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Family ) </span>
   </h3>
   </div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="family_table">
     <thead align="left">
        <tr>
          <th> # </th>
          <th> Name</th>
          <th> Relation</th>
          <th> Date of Birth</th>
        </tr>
      </thead>
<tbody>
<?php
$result_family = mysqli_query($con, "SELECT f.DF_id, f.DF_name, f.DF_relation, f.DF_dob, t.RT_name FROM dr_family_tbl f LEFT JOIN relation_type t ON t.RT_id = f.DF_relation WHERE f.DF_dr_id = '$dr_id'");
$sl_no2=1;
while ($fam = mysqli_fetch_array($result_family))
{
	$DF_id = $fam['DF_id'];
	$DF_name = $fam['DF_name'];
	$DF_relation = $fam['DF_relation'];
	$RT_name = $fam['RT_name'];
	$DF_dob = $fam['DF_dob'];
?>
 <tr id="<?php echo $DF_id; ?>">
    <td class="readonly-bg" style="width: 10%;"> <?php echo $sl_no2; ?> </td>
    <td class="readonly-bg" style="width: 30%;"><?php echo $DF_name; ?> </td>
    <td class="readonly-bg" style="width: 40%;"><?php echo $RT_name; ?> </td>
	<td class="readonly-bg" style="width: 20%;"><?php echo date("d-M-Y", strtotime($DF_dob)); ?> </td>
   </tr>
 <?php
  $sl_no2++;
}
?>
</tbody>
</table>

<!---------------------------------------- Form for new family------------------------>
<form id="formNewFamily" action="#" style="display:none;">
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

 <label style="margin-right:42px;">#</label>
 <label style="margin-right:358px">Name</label>
 <label style="margin-right:140px;">Relation</label>
 <label style="margin-right:0px;">Date of Birth</label>
 <br />
    <input style="width:45px; margin-right:10px;" type="text" value="<?php echo $sl_no2;?>" readonly rel="0" />
    <input style="width:400px; margin-right:10px; text-transform:capitalize;" type="text" name="family_name"  maxlength="50" rel="1">
    <select style="width:200px; margin-right:10px;" name="family_relation" rel="2">
    <option value="">Select Status</option>
	<?php $result3 = mysqli_query($con, "SELECT RT_id, RT_name FROM relation_type");
          while($row3 = mysqli_fetch_array($result3)) {?>
          <option value="<?php echo $row3['RT_id'];?>"><?php echo $row3['RT_name']; ?></option>
	<?php } ?>

     </select>
    <input style="width:150px; margin-right:10px;" type="text" name="family_dob" id="family_dob" value="<?php echo date("d-m-Y"); ?>" rel="3">
   <input type="hidden" name="hidden_dr_id"value="<?php echo $dr_id; ?>">
   <br />
      <br />
     <button id="btnAddNewRowCancel2" type="button">Cancel</button>
    <button id="btnAddNewRowOk2" type="submit">Confirm</button>
    <br />
</form>
<button id="btnAddNewRow2">Add</button>
<button id="btnDeleteRow2">Delete</button>

</div>  <!------------------------------------------- END FAMILY ---------------------------------------->
<?php
 }  // end tag of Isset(table_Dr_id)
?>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php"); ?>
<script type="text/javascript">
$(document).ready(function() {

	 /*----------------------------------START CLINIC dataeditable ---------------------------------------------------------*/
$('#clinic_table').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bFilter": false,
		"bInfo":false,

		"fnPreDrawCallback": function( oSettings ) {
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');
		  $('.dataTables_filter input').css('height', '33px');
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');
		  $('.dataTables_length select').css('margin-right', '3px');
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
	   }
       }).makeEditable({

		sAddURL:           "doctor_clinic_ajax_add.php",
        sDeleteURL:        "doctor_clinic_ajax_delete.php",

		sAddNewRowFormId:  "formNewClinic",
		//sAddDeleteToolbarSelector: ".dataTables_length",


		oAddNewRowButtonOptions: {
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: {
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: {
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Clinic Information',
				resizable: false,
				draggable: true,
				modal: true,
				width:'auto',
				height: 'auto',
				cssclass: 'required',
				},

			aoColumns: [
                    	null,
						null,
						null,
						null
					   ],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError1").html(message);
                                $("#lblAddError1").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message1").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message1").dialog("close");
						//window.location.reload();

                    },

                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected Clinic', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
					}
	});
/*----------------------------------START Family dataeditable ---------------------------------------------------------*/
$('#family_table').dataTable( {

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bInfo": false,
		"bFilter": false,

		"fnPreDrawCallback": function( oSettings ) {
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');
		  $('.dataTables_length select').css('margin-right', '3px');
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
	   }


     } ).makeEditable({

		sAddURL:           "doctor_family_ajax_add.php",
        sDeleteURL:        "doctor_family_ajax_delete.php",

		sAddNewRowFormId:  "formNewFamily",
		sAddNewRowButtonId: "btnAddNewRow2",
		sDeleteRowButtonId: "btnDeleteRow2",
		sAddNewRowOkButtonId: "btnAddNewRowOk2",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel2",

		oAddNewRowButtonOptions: {
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: {
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: {
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add Dear ones info',
				resizable: false,
				draggable: true,
				modal: true,
				width:'auto',
				height: 'auto',
				},

			aoColumns: [
                    	null,
						null,
						null,
						null,
						],


	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");
						//window.location.reload();

                    },

                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
    	});

/*-------show/Hide ADDRESS--------*/

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

$("#dr_dob, #family_dob").removeClass('hasDatepicker').datepicker({   //Dr. DOB
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 100 years ago
dateFormat: "dd-M-yy",
});

/*-------------- Autocomplete Permanent ------------------*/

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

	$("#dr_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?'))
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
<?php ob_flush(); ?>