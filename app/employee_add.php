<?php require_once("check_login_hr.php");
resetCounter($con, 4, 'yy');
resetCounter($con, 38, 'yy');
resetCounter($con, 39, 'yy');
resetCounter($con, 40, 'yy');
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Employee</title>
 <?php include("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_hr.php");?>
<div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
<div class="container" id="div_all">
 <div class="page-content">

<?php
if(isset($_GET['emp_submit']))
{
	 $ET_id = date("y").getCounter($con, 4); 	 // emp_tbl
	 $EI_id = date("y").getCounter($con, 38);	// emp_info

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
	  $father_info = $_GET['father_info'];
	  $mother_info = $_GET['mother_info'];
	  $spouse_info = $_GET['spouse_info'];

	  $emp_salary = $_GET['emp_salary'];
	  $annual_ctc = $_GET['annual_ctc'];
	  $emp_no = ucwords($_GET['emp_no']);
	  $emp_dept_id = $_GET['emp_dept_id'];
	  $emp_position_id = $_GET['emp_position_id'];
	  $emp_reportingTo_id = $_GET['emp_reportingTo_id'];
	  $joined_date = date("Y-m-d", strtotime($_GET['joined_date']));

	  /*------------ TRANSACTION - START ------------*/
	  mysqli_autocommit($con, false);
	  $flag = true;

	 mysqli_query($con, "INSERT INTO emp_info(EI_id, EI_name, EI_dob, EI_gender, EI_marital, EI_email, EI_phone, EI_emergency, EI_address, EI_state, EI_district, EI_pin) VALUES('$EI_id', '".$emp_name."', '".$emp_dob."', '$emp_gender', '$emp_marital', '$emp_email', '".$emp_phone."', '".$emerergency_phone."', '".$perm_address."', '$perm_state', '$perm_district', '".$perm_pin."')");

	 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: emp_info" . mysqli_error($con) . ".";}
	 else updateCounter($con, 38);

	 if($current_address_q ==1){   // present address = Yes
	 	 $ECA_id = date("y").getCounter($con, 40);	//CURRENT _ ADDRESS
		 $cur_address = ucwords($_GET['present_address']);
	 	 $cur_state = $_GET['hidden_present_state'];
	     $cur_district=$_GET['hidden_present_district'];
	     $cur_pin = $_GET['present_pin'];

		 mysqli_query($con, "INSERT INTO `emp_cur_address`(`ECA_id`, `ECA_ei_id`, `ECA_address`, `ECA_state`, `ECA_district`, `ECA_pin`) VALUES ('$ECA_id', '$EI_id',  '".$cur_address."',  '$cur_state', '$cur_district','".$cur_pin."')");
		 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_cur_address`" . mysqli_error($con) . ".";}
	 else updateCounter($con, 40);
		 }

	 if($father_info ==1){   // present address = Yes
	 	 $EF_id = date("y").getCounter($con, 39);	//emp_family
		 $father_name = ucwords($_GET['father_name']);
		 $father_occupation = ucwords($_GET['father_occupation']);
	 	 $father_dob = date("Y-m-d", strtotime($_GET['father_dob']));

		 mysqli_query($con, "INSERT INTO `emp_family`(`EF_id`, `EF_ei_id`, `EF_type`, `EF_name`, `EF_occupation`, `EF_dob`) VALUES ('$EF_id', '$EI_id', '1', '".$father_name."',  '".$father_occupation."', '".$father_dob."')");
		 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_family`" . mysqli_error($con) . ".";}
	 else updateCounter($con, 39);
		 }

	if($mother_info ==1){   // present address = Yes
	 	 $EF_id = date("y").getCounter($con, 39);	//emp_family
		 $mother_name = ucwords($_GET['mother_name']);
		 $mother_occupation = ucwords($_GET['mother_occupation']);
	 	 $mother_dob = date("Y-m-d", strtotime($_GET['mother_dob']));

		 mysqli_query($con, "INSERT INTO `emp_family`(`EF_id`, `EF_ei_id`, `EF_type`, `EF_name`, `EF_occupation`, `EF_dob`) VALUES ('$EF_id', '$EI_id', '2', '".$mother_name."',  '".$mother_occupation."', '".$mother_dob."')");
		 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_family`" . mysqli_error($con) . ".";}
	 else updateCounter($con, 39);
		 }

	 if($spouse_info ==1){   // present address = Yes
	 	 $EF_id = date("y").getCounter($con, 39);	//emp_family
		 $spause_name = ucwords($_GET['spause_name']);
		 $spause_occupation = ucwords($_GET['spause_occupation']);
	 	 $spouse_dob = date("Y-m-d", strtotime($_GET['spouse_dob']));

		 mysqli_query($con, "INSERT INTO `emp_family`(`EF_id`, `EF_ei_id`, `EF_type`, `EF_name`, `EF_occupation`, `EF_dob`) VALUES ('$EF_id', '$EI_id', '2', '".$spause_name."',  '".$spause_occupation."', '".$spouse_dob."')");
		 if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_family`" . mysqli_error($con) . ".";}
	 else updateCounter($con, 39);
		 }

	mysqli_query($con, "INSERT INTO `emp_tbl`(`ET_id`, `ET_ei_id`, ET_emp_no, `ET_dept_id`, `ET_desig_id`, `ET_report_to`, `ET_join_date`, `ET_salary`, `ET_ctc`, `ET_status`)  VALUES ('$ET_id', '$EI_id', '".$emp_no."', '$emp_dept_id', '$emp_position_id', '$emp_reportingTo_id', '".$joined_date."', '".$emp_salary."', '".$annual_ctc."', '1')");
	if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error: `emp_tbl`" . mysqli_error($con) . ".";}
	 else updateCounter($con, 4);

	// TRANSACTION - ROLL BACK
		if($flag){
			mysqli_commit($con);
			header("location: employee_view.php?ei_id=$EI_id"); }
		else {
			mysqli_rollback($con);
			echo "Something is wrong ! Action is failed"; http_response_code(404); }
}
?>

 <div class="inv-main">
 <form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_emp">

   <div class="panel panel-success">
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Add <span class="panel-subTitle"> ( Employee Info ) </span>
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
      <input type="text" class="form-control capital" id="emp_name" name="emp_name" placeholder="Employee name" maxlength="50" autofocus required>
      </div>
      </div>

      <div class="form-control-group">
      <label for="inputEmp_dob" class="col-lg-2 control-label">Date of Birth </label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="emp_dob" name="emp_dob" placeholder="DOB" readonly required>
      </div>
      </div>
     </div>

    <!---------  ROW 2 -------->
    <div class="form-group">
    <div class="form-control-group">
    <label for="emp_gender" class="col-lg-2 control-label">Gender</label>
    <div class="col-lg-3">
    <label for="emp_male" class="radio-inline col-lg-2" style="margin-left:30px;">
    <input  type="radio" name="emp_gender" id="emp_male" value="1"> Male
    </label>
    <label for="emp_female"  class="radio-inline col-lg-2" style="margin-left:30px;">
    <input type="radio" name="emp_gender" id="emp_female" value="2"> Female
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
        <option value="<?php echo $id; ?>" class="option_select"> <?php echo $name; ?></option>
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
  <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="sample@email.com" maxlength="50">
  </div>
  </div>
  </div>

     <!---------  ROW 4 -------->
      <div class="form-group">

   <div class="form-control-group">
  <label for="emp_phone" class="col-lg-2 control-label">Phone</label>
  <div class="col-lg-3">
  <input type="text" class="form-control" id="emp_phone" name="emp_phone" placeholder="Phone no." maxlength="10">
  </div>
  </div>

      <div class="form-control-group">
      <label for="emerergency_phone" class="col-lg-2 control-label"> Emergency </label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="emerergency_phone" name="emerergency_phone" placeholder="Emergency Phone no." maxlength="10">
      </div>
      </div>
      </div>

    	<!---------  ROW 5 -------->
     	<div class="form-group">
        <div class="form-control-group">
        <label for="permanent_address" class="col-lg-2 control-label"> Address </label>
        <div class="col-lg-3">
        <input type="text" class="form-control capital" id="permanent_address" name="permanent_address" placeholder="Permanent Address" maxlength="50">
        </div>
        </div>

      <div class="form-control-group">
      <label for="permanent_state" class="col-lg-2 control-label">State</label>
      <div class="col-lg-3">
      <input type="text" class="form-control capital" id="permanent_state" name="permanent_state" placeholder="Search & Select State" value="Manipur">
      <input type="hidden" id="hidden_permanent_state" name="hidden_permanent_state" value="1">
      </div>
      </div>
      </div>

        <!---------  ROW 6 -------->
        <div class="form-group">
        <div class="form-control-group">
        <label for="permanent_district" class="col-lg-2 control-label">District</label>
        <div class="col-lg-3">
        <input type="text" class="form-control capital" id="permanent_district" name="permanent_district"  placeholder="Search & Select District">
        <input type="hidden" id="hidden_permanent_district" name="hidden_permanent_district" >
        </div>
        </div>
        <div class="form-control-group">
        <label for="permanent_pin" class="col-lg-2 control-label">PIN</label>
        <div class="col-lg-3">
        <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" placeholder="PIN" maxlength="6">
        </div>
        </div>
        </div>

              <!---------  ROW 7 -------->
              <div class="form-group">
              <div class="form-control-group">
              <label for="current_address_q" class="col-lg-2 control-label">Cur. address ?</label>
              <div class="col-lg-3">
              <label for="current_address_q_no" class="radio-inline col-lg-2" style="margin-left:30px;">
              <input type="radio" name="current_address_q" id="current_address_q_no" value="2" checked>No
              </label>
              <label for="current_address_q_yes" class="radio-inline col-lg-2" style="margin-left:30px;">
              <input type="radio" name="current_address_q" id="current_address_q_yes" value="1">Yes
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
         <input type="text" class="form-control capital" id="present_address" name="present_address"  placeholder="Present Address" maxlength="50">
         </div>
         </div>

          <div class="form-control-group">
          <label for="present_state" class="col-lg-2 control-label">State</label>
          <div class="col-lg-3">
          <input type="text" class="form-control capital" id="present_state" name="present_state"  placeholder="Search & Select State" value="Manipur">
          <input type="hidden" id="hidden_present_state" name="hidden_present_state" value="1">
          </div>
          </div>
          </div>

          <!---------  ROW 9 -------->
          <div class="form-group">
          <div class="form-control-group">
          <label for="present_district" class="col-lg-2 control-label">District</label>
          <div class="col-lg-3">
          <input type="text" class="form-control capital" id="present_district" name="present_district"  placeholder="Search & Select District">
          <input type="hidden" id="hidden_present_district" name="hidden_present_district" >
          </div>
          </div>
          <div class="form-control-group">
          <label for="inputpresent_pin" class="col-lg-2 control-label">PIN</label>
          <div class="col-lg-3">
          <input type="text" class="form-control" id="present_pin" name="present_pin" placeholder="PIN" maxlength="6">
          </div>
          </div>
          </div>
          </div>

       </div>
       </div>

  <!------- family info ------>
  <div class="panel panel-success">
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Add <span class="panel-subTitle"> ( Family Info ) </span>
     </h3>
   </div>

  <div class="panel-body">
        <div class="form-group">
              <div class="form-control-group">
              <label for="father_info" class="col-lg-2 control-label">Father Info </label>
              <div class="col-lg-1-6">
              <label for="father_info_no" class="radio-inline col-lg-1">
              <input type="radio" name="father_info" id="father_info_no" value="2" checked>No
              </label>
              <label for="father_info_yes" class="radio-inline col-lg-1"  style="margin-left:30px;">
              <input type="radio" name="father_info" id="father_info_yes" value="1">Yes
              </label>
              </div>
              </div>

       <span id="father_span">
       <div class="form-control-group">
          <label for="father_name" class="col-lg-1-3 control-label">Father</label>
            <div class="col-lg-2">
              <input type="text" class="form-control capital" id="father_name"  name="father_name" placeholder="Father name" maxlength="50">
            </div>
            </div>

          <div class="form-control-group">
          <label for="father_occupation" class="col-lg-1-4 control-label">Occupation</label>
            <div class="col-lg-2-0">
              <input type="text" class="form-control capital" id="father_occupation" name="father_occupation" placeholder="Father's occupation" maxlength="50">
            </div>
            </div>

         <div class="form-control-group">
          <label for="father_dob" class="col-lg-1-2 control-label">DOB</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" id="father_dob" name="father_dob" placeholder="Date of Birth" readonly>
            </div>
         </div>
         </span>
         </div>


      <div class="form-group">
             <div class="form-control-group">
              <label for="mother_info" class="col-lg-2 control-label">Mother Info </label>
              <div class="col-lg-1-6">
              <label for="mother_info_no" class="radio-inline col-lg-1">
              <input type="radio" name="mother_info" id="mother_info_no" value="2" checked>No
              </label>
              <label for="mother_info_yes" class="radio-inline col-lg-1"  style="margin-left:30px;">
              <input type="radio" name="mother_info" id="mother_info_yes" value="1">Yes
              </label>
              </div>
              </div>

        <span id="mother_span">
        <div class="form-control-group">
        <label for="mother_name" class="col-lg-1-3 control-label">Mother</label>
        <div class="col-lg-2">
        <input type="text" class="form-control capital" id="mother_name"  name="mother_name" placeholder="Mother name" maxlength="50">
        </div>
        </div>
        <div class="form-control-group">
        <label for="mother_occupation" class="col-lg-1-4 control-label">Occupation</label>
        <div class="col-lg-2-0">
        <input type="text" class="form-control capital" id="mother_occupation" name="mother_occupation" placeholder="Mother's occupation" maxlength="50">
        </div>
        </div>
        <div class="form-control-group">
        <label for="mother_dob" class="col-lg-1-2 control-label">DOB</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="mother_dob" name="mother_dob" placeholder="Date of Birth" readonly>
        </div>
        </div>
      </span>
      </div>

     <div class="form-group">
             <div class="form-control-group">
              <label for="spouse_info" class="col-lg-2 control-label">Spouse Info </label>
              <div class="col-lg-1-6">
              <label for="spouse_info_no" class="radio-inline col-lg-1">
              <input type="radio" name="spouse_info" id="spouse_info_no" value="2" checked>No
              </label>
              <label for="spouse_info_yes" class="radio-inline col-lg-1"  style="margin-left:30px;">
              <input type="radio" name="spouse_info" id="spouse_info_yes" value="1">Yes
              </label>
              </div>
              </div>

        <span id="spouse_span">
        <div class="form-control-group">
        <label for="spouse_name" class="col-lg-1-3 control-label">Spouse</label>
        <div class="col-lg-2">
        <input type="text" class="form-control capital" id="spouse_name"  name="spouse_name" placeholder="Spouse name" maxlength="50">
        </div>
        </div>
        <div class="form-control-group">
        <label for="spouse_occupation" class="col-lg-1-4 control-label">Occupation</label>
        <div class="col-lg-2-0">
        <input type="text" class="form-control capital" id="spouse_occupation" name="spouse_occupation" placeholder="Spouse occupation" maxlength="50">
        </div>
        </div>
        <div class="form-control-group">
        <label for="spouse_dob" class="col-lg-1-2 control-label">DOB</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" id="spouse_dob" name="spouse_dob" placeholder="Date of Birth" readonly>
        </div>
        </div>
      </span>
      </div>

      </div>
      </div>

       <!------- Official info ------>
  <div class="panel panel-success">
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Add <span class="panel-subTitle"> ( Official Info ) </span>
     </h3>
   </div>

  <div class="panel-body">
     <div class="form-group">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped">
        <thead align="left">
        <tr>
          <th style="width:10%;"> Emp no #</th>
          <th style="width:20%;"> Department</th>
          <th style="width:20%;"> Designation</th>
          <th style="width:15%;"> Reporting To</th>
          <th style="width:10%;"> Join Date</th>
          <th style="width:12%;"> Salary@PerMonth</th>
          <th style="width:10%;"> Annual CTC</th>
         </tr>
       </thead>
  <tbody>
 <tr>
      <td class="readonly-bg">
      <div class="form-control-group">
      <input type="text" class="form-control emp_no" id="emp_no" placeholder="Emp ID" name="emp_no" maxlength="20">
      </div>
      </td>
      <td>
      <div class="form-control-group">
       <select required class="form-control" name="emp_dept_id">
          <option value="" class="option_select">Select Department</option>
			<?php
     $result = mysqli_query($con, "SELECT department_id, department_name FROM department_tbl WHERE department_id !='1' AND department_id !='2' ORDER BY department_name ASC");
               while($row=mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['department_id']; ?>" class="option_select"> <?php echo $row['department_name']; ?> </option>
            <?php  } ?>
        </select>
        </div>
      </td>
      <td>
	  	<div class="form-control-group">
        <select class="form-control" name="emp_position_id">
          <option value="" class="option_select">Select Designation</option>
          <?php
             $result = mysqli_query($con, "SELECT designation_id, designation_name, short_form FROM designation_tbl  ORDER BY designation_name ASC");
             while($row=mysqli_fetch_array($result)) {
              ?>
              <option value="<?php echo $row['designation_id']; ?>" class="option_select"> <?php echo $row['designation_name']; ?> </option>
          <?php } ?>
         </select>
        </div>
      </td>
      <td>
	  <div class="form-control-group">
      <select class="form-control" name="emp_reportingTo_id">
        <option value="" class="option_select">Select ReportingTo</option>
        <?php
            $result = mysqli_query($con, "SELECT * FROM designation_tbl  ORDER BY short_form ASC");
           while($row=mysqli_fetch_array($result)) {
            ?>
		<option value="<?php echo $row['designation_id']; ?>" class="option_select"> <?php echo $row['short_form']." (".$row['designation_name'].")"; ?> </option>
        <?php } ?>
      </select>
      </div>
      </td>
      <td>
      <div class="form-control-group">
      <input type="text" class="form-control" id="joined_date" name="joined_date" value="<?php echo date("d-m-Y");?>" readonly>
      </div>
      </td>
      <td>
      <div class="form-control-group">
      <input type="text" class="form-control" placeholder="Salary" name="emp_salary" maxlength="8" >
      </div>
      </td>
      <td>
      <div class="form-control-group">
      <input type="text" class="form-control" placeholder="CTC" name="annual_ctc" maxlength="10">
      </div>
      </td>
 	</tr>
</tbody>
</table>
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
				$('#presentAddress_div').hide(); }

	  $("#current_address_q_yes, #current_address_q_no").click(function () {
			if( $('input[name=current_address_q][value=1]').prop("checked")) {
				$('#presentAddress_div').show(); }
	  else if ( $('input[name=current_address_q][value=2]').prop("checked")) {
				$('#presentAddress_div').hide(); }
		});

	 /* ------- SHOW/HIDE -father ---------*/
	  if( $('input[name=father_info][value=2]').prop("checked")) {
				$('#father_span').hide(); }
	  if( $('input[name=father_info][value=1]').prop("checked")) {
				$('#father_span').show(); }

	  $("#father_info_yes, #father_info_no").click(function () {
			if( $('input[name=father_info][value=1]').prop("checked")) {
				$('#father_span').show(); }
	  else if ( $('input[name=father_info][value=2]').prop("checked")) {
				$('#father_span').hide(); }
		});

	 /* ------- SHOW/HIDE - MOther---------*/
	  if( $('input[name=mother_info][value=2]').prop("checked")) {
				$('#mother_span').hide(); }
	  if( $('input[name=father_info][value=1]').prop("checked")) {
				$('#mother_span').show(); }

	  $("#mother_info_yes, #mother_info_no").click(function () {
			if( $('input[name=mother_info][value=1]').prop("checked")) {
				$('#mother_span').show(); }
	  else if ( $('input[name=mother_info][value=2]').prop("checked")) {
				$('#mother_span').hide(); }
		});

	  /* ------- SHOW/HIDE - spouse ---------*/
	 if( $('input[name=spouse_info][value=2]').prop("checked")) {
				$('#spouse_span').hide(); }
	  if( $('input[name=spouse_info][value=1]').prop("checked")) {
				$('#spouse_span').show(); }

	 $("#spouse_info_yes, #spouse_info_no").click(function () {
			if( $('input[name=spouse_info][value=1]').prop("checked")) {
				$('#spouse_span').show(); }
	  else if ( $('input[name=spouse_info][value=2]').prop("checked")) {
				$('#spouse_span').hide(); }
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


		father_info: "required",
		father_name:{required: function(){
								   if ($('input[name=father_info][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=father_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		father_occupation:{required: function(){
			 				       if ($('input[name=father_info][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=father_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		father_dob:{required: function(){
			 				       if ($('input[name=father_info][value=1]').prop("checked")) { return true; }  // yes
							  	   if ($('input[name=father_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },

		mother_info: "required",
		mother_name:{required: function(){
			 				     if ($('input[name=mother_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=mother_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		mother_occupation:{required: function(){
			 				     if ($('input[name=mother_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=mother_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		mother_dob:{required: function(){
			 				    if ($('input[name=mother_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=mother_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		spouse_info: "required",
		spouse_name:{required: function(){
			 				     if ($('input[name=spouse_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=spouse_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		spouse_occupation:{required: function(){
			 				     if ($('input[name=spouse_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=spouse_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },
		spouse_dob:{required: function(){
			 				      if ($('input[name=spouse_info][value=1]').prop("checked")) { return true; }  // yes
							  	 if ($('input[name=spouse_info][value=2]').prop("checked")) { return false; }  // NO
									},
						   },

		emp_no:"required",
		emp_dept_id:"required",
		emp_position_id:"required",
		emp_reportingTo_id:"required",
		joined_date:"required",
		annual_ctc:{ required: true,
						number: true, },
		emp_salary:{ required: true,
						number: true, },
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

		father_info:'',
		father_name:'',
		father_occupation:'',
		father_dob:'',
		mother_info:'',
		mother_name:'',
		mother_occupation:'',
		mother_dob:'',
		spouse_info:'',
		spouse_name:'',
		spouse_occupation:'',
		spouse_dob:'',
		emp_no:'',
		emp_dept_id:'',
		emp_position_id:"",
		emp_reportingTo_id:"",
		joined_date:"",
		annual_ctc:'',
		emp_salary:'',
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



$( "#emp_dob, #father_dob, #mother_dob, #spouse_dob" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
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