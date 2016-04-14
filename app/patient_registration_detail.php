<?php require_once("check_login_fd.php");
 resetCounter($con, 16, 'dd');	//  PT_sl (patient_test)
 resetCounter($con, 24, 'dd');  //  PP_sl (patient_payment)
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Registration</title>
<?php require_once("css_bootstrap_datatable_header.php");?>
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">
 <div class="inv-main">

<?php 

/*----------------UPDATE FOR PAtient Information-------------------*/
if(isset( $_GET['submit-info'])){
		  $receipt_no = $_GET['hidden_receipt_no'];
		  $patient_id = $_GET['hidden_patient_id'];
		  $patient_name = ucwords(mysqli_real_escape_string($con, $_GET['patient_name']));
		  $marital_status_id = $_GET['marital_status'];
		   
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
		  $patient_phone = $_GET['patient_phone'];		  
		  
          $patient_address = ucwords(mysqli_real_escape_string($con, $_GET['patient_address']));
			if(isset($_GET['hidden_state']) && $_GET['hidden_state'] !="")
				  { $state_id = $_GET['hidden_state']; }
			else  { 
					$state_name = ucwords(mysqli_real_escape_string($con, $_GET['state']));	
					$state_id = addState($con, $state_name); }
			if(isset($_GET['hidden_district']) && $_GET['hidden_district'] !="")
				  { $district_id = $_GET['hidden_district']; }
			   else  
			      { 
					$district_name = ucwords(mysqli_real_escape_string($con, $_GET['district']));	
					$district_id =  addDistrict($con, $district_name, $state_id); }
			
		   $pin_id = mysqli_real_escape_string($con, $_GET['patient_pin']);
		 
		  /*-------------------------------------Doctor - Refferred by ---------------------------------------*/
		  $dr_presc = $_GET['dr_letter'];
		 
		  if($dr_presc == "1") { $dr_letter = $_GET['hidden_dr_id'];}	//if dr_letter = Yes, strore dr_id from autocomplete
		  if($dr_presc == "2") { $dr_letter = "NO"; }	//dif dr_letter = NO, then store NO    
		  
		  $patient_history = ucwords(mysqli_real_escape_string($con, $_GET['patient_history']));
		  $test_remark = ucwords(mysqli_real_escape_string($con, $_GET['test_remark']));
		
		  $source_id = $_GET['hidden_source_id']; 
		  $referred_id = $_GET['hidden_referred_by'];
		  
		  $date_edit = date("y-m-d h:i:s A", strtotime($_GET['date_edit']));
		  $opt_date = $_GET['opt_date'];
		  
		  if($opt_date == '1'){   // Date change == Yes
			  
			  
		/*------------ UPDATE patient_registration TABLE -------------*/
mysqli_query($con, "UPDATE patient_registration SET pr_dr_prescription = '".$dr_letter."', pr_patient_history = '".$patient_history."', pr_lab_notes = '".$test_remark."', pr_status_date = '".$date_edit."', pr_date = '".$date_edit."', pr_source_id = '$source_id', pr_referred_id = '$referred_id' WHERE pr_receipt_no = '$receipt_no'");

/*------------ UPDATE patient_info TABLE -------------*/
mysqli_query($con, "UPDATE patient_info SET PI_name='".$patient_name."', PI_age_y = '.$patient_age_y.', PI_age_m = '.$patient_age_m.', PI_age_d = '.$patient_age_d.', PI_gender_id ='.$patient_gender.', PI_marital_id ='.$marital_status_id.', PI_address ='".$patient_address."', PI_state_id ='.$state_id.', PI_district_id ='.$district_id.', PI_pin_id ='.$pin_id.', PI_phone ='.$patient_phone.', PI_date = '".$date_edit."' WHERE PI_id = '$patient_id'");

/*------------UPDATE Patient Test tbl ----------*/
mysqli_query($con, "UPDATE patient_test SET PT_status_date1 = '".$date_edit."', PT_status_date2 = '".$date_edit."' WHERE PT_receipt_no = '$receipt_no'");

/*------------------------------ Update Patient payment date ----------------------------------*/
 mysqli_query($con, "UPDATE patient_payment SET PP_paid_date = '".$date_edit."' WHERE PP_receipt_no = '$receipt_no'");

header("location: patient_receipt.php?receipt_no=$receipt_no&msg=1");			  
			  
	}
if($opt_date == '2')   // Date change == no
	 {	
/*------------ UPDATE patient_registration TABLE -------------*/
mysqli_query($con, "UPDATE patient_registration SET pr_dr_prescription = '".$dr_letter."', pr_patient_history='".$patient_history."', pr_lab_notes='".$test_remark."', pr_source_id = '$source_id', pr_referred_id = '$referred_id' WHERE pr_receipt_no='$receipt_no'");

/*------------ UPDATE patient_info TABLE -------------*/
mysqli_query($con, "UPDATE patient_info SET PI_name = '".$patient_name."', PI_age_y = '.$patient_age_y.', PI_age_m = '.$patient_age_m.', PI_age_d = '.$patient_age_d.', PI_gender_id='.$patient_gender.', PI_marital_id ='.$marital_status_id.', PI_address ='".$patient_address."', PI_state_id ='.$state_id.', PI_district_id ='.$district_id.', PI_pin_id ='.$pin_id.', PI_phone ='.$patient_phone.' WHERE PI_id = '$patient_id'");

header("location: patient_receipt.php?receipt_no=$receipt_no&msg=1");
			}
}
/*------Submit Payment Update ---------*/
if(isset($_GET['payment-update']))
 {
	  $receipt_no_payment = $_GET['pph_receipt_no'];
	  $patient_id = $_GET['pph_patient_id'];
	  $source_id = $_GET['pph_source_id'];
	  $referred_id = $_GET['pph_referred_id'];
	  $total_amt = $_GET['total_amt'];
	  $tax_radio = $_GET['tax_radio'];
	  if($tax_radio =='1'){$tax = $_GET['tax'];} else{$tax = 0;}
	  $disc_radio = $_GET['disc_radio'];	  
	  $net_amount = $_GET['net_amount'];
	  
	  $submit_paid = mysqli_real_escape_string($con, $_GET['paid_amount']);
	  $due_amount = mysqli_real_escape_string($con, $_GET['due_amount']);	  


$check = mysqli_query($con, "SELECT y.PP_sl, y.PP_net, y.PP_paid, y.PP_bal, y.PP_paid_date, r.pr_status_id FROM patient_payment y LEFT JOIN patient_registration r ON r.pr_receipt_no = y.PP_receipt_no  WHERE y.PP_receipt_no = '$receipt_no_payment'");	
while($row = mysqli_fetch_array($check)) {	
	
	$PP_sl = $row['PP_sl'];
	$PP_bal = $row['PP_bal'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$pr_status_id = $row['pr_status_id'];
	
  }		  
 	
/*----------------------- Due Clearance -------------------------------*/
 if($submit_paid !=""){	 

	resetCounter_value($con, 30);

    //CHECKING IF already created in patient_due_tbl
	$check_pd_sl = mysqli_query($con, "SELECT PD_sl, PD_bal_paid FROM patient_due_tbl WHERE PD_pp_sl = '$PP_sl' AND PD_pp_sl IS NOT NULL"); 
	  
	  if (mysqli_num_rows($check_pd_sl) == 0)  // NO id on Due table
		  { 
			
			$PD_sl = date("ymd").getCounter_value($con, 30);
			$PD_bal_paid = $submit_paid - $PP_paid;
	
			mysqli_query($con, "INSERT INTO patient_due_tbl(PD_sl, PD_pp_sl, PD_bal_paid, PD_date) VALUES ('$PD_sl', '$PP_sl', '".$PD_bal_paid."', NOW())");
		}
	   else  // id on Due table
	      { 
			while($row = mysqli_fetch_array($check_pd_sl)) {		
			$PD_sl = $row['PD_sl'];
			$paid = $row['PD_bal_paid']; }		
			
		$check1 = mysqli_query($con, "SELECT SUM(PD_bal_paid) AS sum FROM patient_due_tbl WHERE PD_pp_sl = '$PP_sl'");
		
			while($check2 = mysqli_fetch_array($check1)) {		
				  $sum = $check2['sum']; }
			
			
			$PD_sl_x = date("ymd").getCounter_value($con, 30);	  
		    $PD_bal_paid_x = $submit_paid - ($PP_paid + $sum);
			
		mysqli_query($con, "INSERT INTO patient_due_tbl(PD_sl, PD_pp_sl, PD_bal_paid, PD_date) VALUES ('$PD_sl_x', '$PP_sl', '".$PD_bal_paid_x."', NOW())");		
	 }
	 mysqli_query($con, "UPDATE patient_payment SET PP_total ='$total_amt', PP_tax='$tax_radio', PP_tax_value = '".$tax."', PP_disc_option ='".$disc_radio."', PP_net ='$net_amount', PP_bal ='$due_amount' WHERE PP_receipt_no = '$receipt_no_payment'");
}
	  
 if(isset($_GET['hidden_disc_code_sl']) && $_GET['hidden_disc_code_sl'] !="" && $_GET['disc_radio'] == '1')
	  {
	   mysqli_query($con, "UPDATE discount_tbl SET disc_patient_id = '$patient_id', disc_status = '2', disc_source_id='$source_id', disc_referred_id= '$referred_id', disc_status_date = '".$date_edit."' WHERE disc_code_sl = '".$_GET['hidden_disc_code_sl']."'");
      }		
	  else{
		  mysqli_query($con, "UPDATE discount_tbl SET disc_status= '1', disc_source_id='$source_id', disc_referred_id= '$referred_id', disc_status_date = '".$date_edit."' WHERE disc_code_sl = '".$_GET['hidden_disc_code_sl']."'");		  
		  }
	
header("location: patient_receipt.php?receipt_no=$receipt_no_payment&msg=1");
 }
?>

<?php 
if(isset($_GET['receipt_no']))
{
$pass_receipt_no = $_GET['receipt_no'];
$msg = 1;

 $patient_info = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_dr_prescription,
 
 
  p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_gender, p.PI_address, p.PI_pin, p.PI_phone, p.PI_marital_id, p.PI_state_id, p.PI_district_id,
  
  
  y.PP_tax, y.PP_disc, y.PP_net, y.PP_paid, y.PP_bal, y.PP_date, 
  
  
  t.* FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_test t ON t.PT_receipt_no = r.pr_receipt_no WHERE r.pr_receipt_no = '$pass_receipt_no'");
 
  while($p_info = mysqli_fetch_array($patient_info))
  {
	  $pr_receipt_no = $p_info['pr_receipt_no'];
  	  $pr_patient_id = $p_info['pr_patient_id'];
	  $pr_source_id = $p_info['pr_source_id'];
	  $pr_referred_id = $p_info['pr_referred_id'];
  	  $pr_date = $p_info['pr_date'];
	  $pr_dr_prescription = $p_info['pr_dr_prescription'];

  	  $pr_patient_name = $p_info['PI_name'];
	  $pr_patient_age_y = $p_info['PI_age_y'];
	  $pr_patient_age_m = $p_info['PI_age_m'];
	  $pr_patient_age_d = $p_info['PI_age_d'];	  
  	  $pr_patient_gender = $p_info['PI_gender'];
	  $pr_patient_address = $p_info['PI_address'];
	  $pr_patient_pin = $p_info['PI_pin'];
  	  $pr_patient_phone = $p_info['PI_phone'];
	  
	  $marital_id = $p_info['PI_marital_id'];	  
  	  $pr_patient_state_id = $p_info['PI_state_id'];
	  $pr_patient_district_id = $p_info['PI_district_id'];
	    
	  $PP_tax = $p_info['PP_tax'];
	  $PP_disc_option = $p_info['PP_disc'];
	  $PP_net = $p_info['PP_net'];
	  $PP_paid = $p_info['PP_paid'];
	  $PP_bal = $p_info['PP_bal'];
	  $PP_paid_date = $p_info['PP_date'];	  
	} 
?>


<form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_patient_info">
<div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Patient Info
       <span id="page_date" class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>
       <span id="show_date"></span>
 
  <?php if ($msg =='1'){?>
  <a class="text-right pull-right navbar-link no-print" href="fd_search_result.php?receipt_no=<?php echo $pass_receipt_no;?>&msg=1" style="padding-left:30px;">
   <?php } 
   else if ($msg =='2'){?> <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px;"> <?php } 
   else if ($msg =='3'){?> <a class="text-right pull-right navbar-link no-print" href="patient_discount_FD.php" style="padding-left:30px;"> <?php } 
   else if ($msg =='9'){?> <a class="text-right pull-right navbar-link no-print" href="fd_pending_all.php" style="padding-left:30px;"> <?php } ?>
   
   
   <i class="fa fa-arrow-circle-right fa-lg"></i></a>
       </span>
         
      
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

<div class="form-group" style="padding-bottom:30px;">
  <div class="form-control-group"> 
  
  <div class="form-control-group">
  <label for="referred_by" class="col-lg-1-4 control-label" id="label_referred_by">Source Person</label>
  <div class="col-lg-5" id="div_refBy">
     <input type="text" class="form-control" placeholder="Search & Select Source Person" id="referred_by" name="referred_by" value="<?php echo showReferral($con, $pr_source_id, $pr_referred_id).' ('.showSourceName($con, $pr_source_id).')'; ?>" maxlength="100">
     <input type="hidden" class="form-control" name="hidden_referred_by" id="hidden_referred_by" value="<?php echo $pr_referred_id ;?>">
     <input type="hidden" class="form-control" id="hidden_source_id" name="hidden_source_id" value="<?php echo $pr_source_id;?>">
  </div>
  </div> 
  
  <label for="dr_letter" class="col-lg-1-3 control-label"><i class="icon-user-md icon-large icon-white fa-fw"></i> Dr. Ref ?</label>
      <div class="col-lg-2-1">					      
          <label for="dr_letter_yes" class="radio-inline col-lg-1" style="margin-left:30px;">
            <input  type="radio" name="dr_letter" class="form-control" id="dr_letter_yes" value ="1" <?php if($pr_dr_prescription != "NO"){echo "checked";} ?>>Yes
          </label>
          <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-left:35px;">
            <input type="radio" name="dr_letter" class="form-control" id="dr_letter_no" value ="2" <?php if($pr_dr_prescription == "NO"){echo "checked";} ?>>No
          </label>
      </div>
      </div>
      
       <div class="form-control-group" id="div_dr_name">          
     <label for="dr_name" class="col-lg-1-3 control-label" id="label_dr_name">Dr. Name</label>
     <div class="col-lg-2-1" >
      <input type="text" class="form-control" name="dr_name" placeholder="Search Dr. Name" id="dr_name" value="<?php if($pr_dr_prescription =="NO"){echo "";}else{echo showDoctor_name($con, $pr_dr_prescription);} ?>">
      <input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php if($pr_dr_prescription =="NO"){echo "";}else{ echo $pr_dr_prescription;}?>">
     </div>
    </div>   
 </div><!--end row 2-->		 



<div class="form-group">   
   <div class="form-control-group">
   <label for="patient_name" class="col-lg-1-4 control-label">Name</label>
   <div class="col-lg-2-5">
      <input type="text" class="form-control capital" placeholder="* Patient name" id="patient_name" name="patient_name" value="<?php echo $pr_patient_name;?>" maxlength="50">
      <input type="hidden" name="hidden_receipt_no" value="<?php echo $pr_receipt_no;?>">
      <input type="hidden" name="hidden_patient_id" value="<?php echo $pr_patient_id;?>">
   </div>
   </div>
    
  
  <div class="form-control-group">
  <label for="patient_sex" class="col-lg-1-3 control-label">Gender</label>
    <div class="col-lg-1-4">					      
   <label for="optionsRadios1" class="radio-inline col-lg-1" style="margin-left: 10px;">
 <input  type="radio" class="form-control" name="patient_sex" class="" id="optionsRadios1" value="1" <?php if($pr_patient_gender == "1"){echo "checked";} ?>>M
    </label>
 <label for="optionsRadios2" class="radio-inline col-lg-1" style="padding-left:30px;">
  <input type="radio" class="form-control" name="patient_sex" id="optionsRadios2" value="2" <?php if($pr_patient_gender == "2"){echo "checked";} ?>>F
 </label>
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
				<option value="<?php echo $row['marital_id'];?>" <?php if($row['marital_id'] == $marital_id){echo "selected";}?> class="option_select">
				<?php echo $row['marital_name'];?>
                </option>						 
			   <?php
			  }
			  ?>    			   
    </select>
  </div>	
  </div>
 
  
  <div id="div_age_y" class="form-control-group">
  <label for="patient_age_y" class="col-lg-1-1-0 control-label" id="label_age_y">YY</label>
   <div class="col-lg-1-2">
     <input type="text" class="form-control" id="patient_age_y" placeholder="YY" name="patient_age_y" value="<?php if($pr_patient_age_y =='0'){echo '';}else{ echo $pr_patient_age_y;}?>" maxlength="3">
  </div> 
  </div>
  
   <div id="div_age_m" class="form-control-group">
   <label for="patient_age_m" class="col-lg-1-1-0 control-label" id="label_age_m">MM</label>
   <div class="col-lg-1-2">
     <input type="text" class="form-control" id="patient_age_m" placeholder="MM" name="patient_age_m" value="<?php if($pr_patient_age_m =='0'){echo '';}else{ echo $pr_patient_age_m;}?>" maxlength="3">
  </div> 
  </div>
   
<div id="div_age_d" class="form-control-group">
 <label for="patient_age_d" class="col-lg-1-1-0 control-label" id="label_age_d">DD</label>   
   <div class="col-lg-1-2">
   <input type="text" class="form-control" id="patient_age_d" placeholder="DD" name="patient_age_d" value="<?php if($pr_patient_age_d =='0'){echo '';}else{echo $pr_patient_age_d;}?>" maxlength="3">
  </div> 
  </div>

 
  
  
  <div class="form-control-group">
  <label for="patient_phone" class="col-lg-1-3 control-label">Phone</label>
  <div class="col-lg-1-4">
    <input type="text" class="form-control" placeholder="* Phone no" name="patient_phone" id="patient_phone" value="<?php if($pr_patient_phone =='0'){echo '';}else{echo $pr_patient_phone;}?>" maxlength="10">
 </div>
 </div>         
</div> <!--END div1-->
                         
  <div class="form-group"> 
  
  <div class="form-control-group">
  <label for="patient_address" class="col-lg-1-4 control-label">Address</label>
  <div class="col-lg-2-5">
  <input type="text" class="form-control capital" placeholder="* Address" id="patient_address" name="patient_address" value="<?php echo $pr_patient_address;?>" maxlength="50">
  </div> 
  </div>
  
  <div class="form-control-group">
  <label for="state" class="col-lg-1-3 control-label">State</label>
  <div class="col-lg-2-1" id="div_state">
  <input type="text" class="form-control capital" id="state" placeholder="Search/Add State" name="state" value="<?php echo showStateName($con, $pr_patient_state_id);?>" maxlength="20">
  <input type="hidden" class="form-control" id="hidden_state" name="hidden_state" value="<?php echo $pr_patient_state_id;?>" maxlength="20">
  </div> 
  </div>
  
  <div class="form-control-group">             
  <label for="district" class="col-lg-1-3 control-label" id="label_state_district">District</label>
  <div class="col-lg-2-1" id="div_district">
  <input type="text" class="form-control capital" id="district" placeholder="Search/Add district" name="district" value="<?php echo showDistrictName($con, $pr_patient_district_id);?>">
  <input type="hidden" class="form-control" id="hidden_district" name="hidden_district" value="<?php echo $pr_patient_district_id;?>">
  </div> 
  </div>
  
  <div class="form-control-group">    
  <label for="patient_pin" class="col-lg-1-3 control-label" id="label_patient_pin">PIN</label>
  <div class="col-lg-2-1" id="div_patient_pin">
  <input type="text" class="form-control" id="patient_pin" placeholder="PIN Code - Optional" name="patient_pin" 
  	value="<?php if($pr_patient_pin =="0"){ echo "";}else{ echo $pr_patient_pin;}?>" maxlength="6">
 <!-- <input type="hidden" class="form-control" id="hidden_patient_pin" name="hidden_patient_pin" value="<?php echo $pr_patient_pin;?>">-->
  </div> 
  </div>
  </div>
  

<div class="form-group">
  <div class="form-control-group">
  <label for="patient_history" class="col-lg-1-4 control-label" id="patient_history">Patient History</label>
  <div class="col-lg-2-5">
    <textarea class="form-control textBox_height" name="patient_history" id="patient_history" placeholder="Optional (Max.50 Characters)" maxlength="50"><?php echo htmlspecialchars($PT_history);?></textarea>
  </div> 
  </div> 
  
  <div class="form-control-group">
  <label for="test_remark" class="col-lg-1-3 control-label" id="label_referred_by">Remark</label>
    <div class="col-lg-2-1">
  <textarea class="form-control textBox_height" name="test_remark" placeholder="Optional (Max.30 Chars)" id="test_remark" maxlength="30"><?php echo htmlspecialchars($PT_remark) ;?></textarea>
    </div> 
    </div> 
    
 <label for="inputID" class="col-lg-1-3 control-label">Reg. ID</label>
 <div class="col-lg-2-1">
 <input type="text" class="form-control" value="<?php echo show_sourceType_abree($con, $pr_source_id).$pass_receipt_no;?>" name="receipt_no" readonly> 
 </div> 
</div><!--end row 3-->

<div class="form-group">
	<div class="form-control-group" style="line-height:1.999999">
  
  <label for="date_change" class="col-lg-1-4 control-label"> Change Date ?</label>
      <div class="col-lg-2-1">					      
          <label for="date_change_yes" class="radio-inline col-lg-1" style="margin-left:30px;">
            <input  type="radio" name="opt_date" class="form-control" id="date_change_yes" value ="1">Yes
          </label>
          <label for="date_change_no" class="radio-inline col-lg-1" style="padding-left:35px;">
            <input type="radio" name="opt_date" class="form-control" id="date_change_no" value ="2" checked>No
          </label>
      </div>
      </div>
      
      
       <div class="form-control-group" id="div_date">          
      <label for="inputRdate" class="col-lg-1-3 control-label">Date</label>
  <div class="col-lg-2-1">
   <input type="text" class="form-control" value="<?php echo date("d-m-Y, h:i:s a", strtotime($pr_date));?>" name="date_edit" id="date_edit" readonly>
  </div>
</div>
    </div>   
 </div><!--end row 4-->	



</div> <!--end pannel body-->
<div class="form-group panel-footer">
  <div class="col-lg-offset-4 col-lg-4">
   <button type="submit" class="btn btn-primary btn-block submit-info" id="submit-info" name="submit-info" style="font-size:16px;">Update Info</button>
  </div>
</div>
</div>
</form> <!---------------End form Patient Information form-->

<!----------------------------- START Investigation ----------------------------->
<div class="panel panel-success">  
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Investigation
    <?php if ($msg =='1'){?>
  <a class="text-right pull-right navbar-link no-print" href="fd_search_result.php?receipt_no=<?php echo $pass_receipt_no;?>&msg=1" style="padding-left:30px;">
   <?php } 
   else if ($msg =='2'){?> <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px;"> <?php } 
   else if ($msg =='3'){?> <a class="text-right pull-right navbar-link no-print" href="patient_discount_FD.php" style="padding-left:30px;"> <?php } 
   else if ($msg =='9'){?> <a class="text-right pull-right navbar-link no-print" href="fd_pending_all.php" style="padding-left:30px;"> <?php } ?>
  
  <i class="fa fa-arrow-circle-right"></i></a>
      
      </h3>      
   </div>
 
 <div class="panel-body">       
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="PT_edit_table">
        <thead align="left">
        <tr>
          <th style="display: none;"> receipt_no</th>
          <th style="display: none;"> patient_id</th>
          <th style="display: none;"> test_id</th>
           <th style="display: none;"> dept_id</th>
          <th> SL </th>
          <th> Investigation</th>
          <th style=" text-align:right; padding-right:50px;"> Price</th>             
        </tr>
        </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT PT_sl, PT_test_id, PT_test_name, PT_test_price, PT_dept_id FROM patient_test t WHERE PT_receipt_no ='$pass_receipt_no'");
$sl_no=1;
while ($test = mysqli_fetch_array($result_test))
{
	$PT_sl = $test['PT_sl'];
	$PT_test_id = $test['PT_test_id'];		
	$PT_dept_id = $test['PT_dept_id'];		
?>
 <tr id="<?php echo $PT_sl; ?>">
    <td style="display:none;"> <?php echo $pass_receipt_no; ?></td>
    <td style="display:none;"> <?php echo $pr_patient_id; ?></td>
    <td style="display:none;"> <?php echo $PT_test_id; ?></td>
    <td style="display:none;"> <?php echo $PT_dept_id; ?></td>
    <td><?php echo $sl_no; ?> </td>  
    <td><?php echo $test['PT_test_name']; ?> </td>  
    <td style="text-align:right; padding-right:50px;"><?php echo $test['PT_test_price']; ?> </td> 	
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
</div>
<!---------------------------------------- Form for new investigation---------------------------->
<form id="formNewPatientTest" action="#"> 
    <label id="lblAddError" style="display:none" class="error"></label>
    <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
    
    <label style="margin-right:10px;">Sl No</label>
    <label style="margin-right:443px">Investigation</label>
    <label style="margin-right:0px;">Price</label>
    <br />
    <input type="hidden" name="hidden_receipt_no" id="hidden_receipt_no" value="<?php echo $pass_receipt_no; ?>" rel="0"/> 
    <input type="hidden" name="hidden_patient_id" id="hidden_patient_id" value="<?php echo $pr_patient_id; ?>" rel="1"/> 
    <input type="hidden" name="hidden_test_id"    id="hidden_test_id"    value="<?php echo $PT_test_id; ?>" rel="2"/> 
    <input type="hidden" name="hidden_dept_id"    id="hidden_dept_id"    value="<?php echo $PT_dept_id; ?>" rel="3"/> 
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no"      id="sl_no" value="<?php echo $sl_no;?>" disabled rel="4" />        
    <input type="text" style="width:550px; margin-right:10px;" name="test_name"  id="test_name"  rel="5" />
    <input type="text" style="width:95px;  margin-right:10px;" name="test_price" id="test_price" rel="6"  readonly/>
   
    <br />
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button>
<div class="clearfix"></div> 
</div>  

   
 <?php
    }
 ?>            

<div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>
<script src="js/patient_registration_detail.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>
<?php ob_flush(); ?>