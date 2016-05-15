<?php require_once("check_login_admin.php");
 resetCounter($con, 16, 'dd');	//  PT_sl (patient_test)
 resetCounter($con, 24, 'dd');  //  PP_sl (patient_payment)
 resetCounter($con, 34, 'dd');  //  History
 resetCounter($con, 35, 'dd');  //  Lab Note
 
 resetCounter($con, 13, 'dd');   // patient_transaction
 resetCounter($con, 36, 'dd');	// Patient_test_path
 resetCounter($con, 37, 'dd');	// tax_tbl
 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Registration</title>
  <?php require_once("css_bootstrap_datatable_header.php"); ?>
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<?php 

/*----------------UPDATE FOR PAtient Information-------------------*/
if(isset( $_GET['submit_info']))
 	{
	 	  $history_id = date("ynj").getCounter($con, 34);
		  $lab_id = date("ynj").getCounter($con, 35);
		  $user_id=$_SESSION['user_id'];
		  
		  $receipt_no = $_GET['hidden_receipt_no'];
		  $patient_id = $_GET['hidden_patient_id'];
		  $patient_name = ucwords($_GET['patient_name']);
		  $marital_status_id = $_GET['marital_status'];
		   
  if( $marital_status_id =='1' || $marital_status_id =='2' || $marital_status_id =='3' || $marital_status_id =='4' || $marital_status_id =='5'){		  
		  $patient_age_y = $_GET['patient_age_y'];
		  $patient_age_m = '0';
		  $patient_age_d = '0';
	     }
	if( $marital_status_id =='6'){		  
		  $patient_age_y = $_GET['patient_age_y'];
		  $patient_age_m = $_GET['patient_age_m'];
		  $patient_age_d = $_GET['patient_age_d'];
	     }
	if( $marital_status_id =='7'){		  
		  $patient_age_y = '0';
		  $patient_age_m = $_GET['patient_age_m'];
		  $patient_age_d = $_GET['patient_age_d'];
	     }
		 
		 $dr_letter = $_GET['dr_letter'];
		 if($dr_letter == "Y") {$dr_id = $_GET['hidden_dr_id'];}else{$dr_id='NO';}
		 
		  $src_type = $_GET['src_type'];
		  if($src_type == "W"){
			  $source_id = '3'; 
			  $referred_id = '0';
			}
		  else{		  
		  $source_id = $_GET['hidden_source_id'];
		  $referred_id = $_GET['hidden_referred_by'];
		  }
		 
		  $patient_gender = $_GET['patient_sex'];
		  $patient_phone = $_GET['patient_phone'];
		  
          $patient_address = ucwords($_GET['patient_address']);
		  $state_id = $_GET['hidden_state'];
		  $district_id = $_GET['hidden_district'];
		  $pin_id = $_GET['patient_pin'];
		 
		  $patient_history = ucwords($_GET['patient_history']);
		  $lab_note = ucwords($_GET['lab_note']);

/*-------------- START - TRANSACTION/ROLLBACK  ----------*/ 
mysqli_autocommit($con, false);
$flag = true;	
	
/*------------ UPDATE patient_registration  ------------*/
mysqli_query($con, "UPDATE patient_registration SET pr_dr_prescription='".$dr_id."', pr_source_id='$source_id', pr_referred_id='$referred_id' WHERE pr_receipt_no ='$receipt_no'");
	if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_info: " . mysqli_error($con) . ".";}
	
  /*------------ UPDATE patient_info  ------------*/
		 mysqli_query($con, "UPDATE patient_info SET PI_name='".$patient_name."', PI_age_y='$patient_age_y', PI_age_m='$patient_age_m', PI_age_d='$patient_age_d', PI_gender='$patient_gender', PI_marital_id='$marital_status_id', PI_address='".$patient_address."', PI_state_id='$state_id', PI_district_id='$district_id', PI_pin='".$pin_id."', PI_phone= '".$patient_phone."' WHERE PI_id='$patient_id'");
		 if(mysqli_affected_rows($con) < 0) { $flag = false; echo "patient_info: " . mysqli_error($con) . ".";}
		 
	/*------------ Patient History --------------*/ 
	if($patient_history !=''){
	 mysqli_query($con, "INSERT INTO patient_history(PH_id, PH_patient_id, PH_history) VALUES ('$history_id', '$patient_id', '".$patient_history."')");
	  if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "History: " . mysqli_error($con) . ".";}
	    else updateCounter($con, 34);
	}
	
	/*------------ Lab Note -----------------*/ 
	if($lab_note !=''){		
	  mysqli_query($con, "INSERT INTO lab_note(LB_id, LB_receipt_no, LB_user, LB_note, LB_date) VALUES ('$lab_id', '$receipt_no', '$user_id', '".$lab_note."', NOW())");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Lab: " . mysqli_error($con) . ".";}
	    else updateCounter($con, 35);
	 }
	
	if($flag){
			mysqli_commit($con);
			header("LOCATION: patient_receipt.php?receipt_no=$receipt_no");
			}
	 else 
			{
			mysqli_rollback($con);	
			echo " ! Action is failed".mysqli_error($con); http_response_code(404);
			}
}  // end - submit_info

/*------Submit Payment Update ---------*/
if(isset($_GET['submit_pay']))
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

$check = mysqli_query($con, "SELECT patient_payment.PP_sl, patient_payment.PP_net, patient_payment.PP_paid, patient_payment.PP_bal, patient_payment.PP_paid_date, patient_registration.pr_status_id FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no  WHERE patient_payment.PP_receipt_no = '$receipt_no_payment'");	
while($row = mysqli_fetch_array($check)) {	
	
	$PP_sl = $row['PP_sl'];
	$PP_bal = $row['PP_bal'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$pr_status_id = $row['pr_status_id'];
  }		  
 	
/*--------------- Due Clearance --------------*/
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
	   mysqli_query($con, "UPDATE discount_tbl SET disc_patient_id = '$patient_id', disc_status = '2', disc_source_id='$source_id', disc_referred_id= '$referred_id' WHERE disc_code_sl = '".$_GET['hidden_disc_code_sl']."'");
      }		
	  else{
		  mysqli_query($con, "UPDATE discount_tbl SET disc_status= '1', disc_source_id='$source_id', disc_referred_id= '$referred_id' WHERE disc_code_sl = '".$_GET['hidden_disc_code_sl']."'");		  
		  }
	
header("location: patient_receipt.php?receipt_no=$receipt_no_payment&msg=1");
 }
?>

<body>
<?php require_once("right_top_header_popup.php");?>

<div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
<div class="container">
<!------------------- start loading..--------------------------------->  

 <div class="page-content" id="div_main">
 <div class="inv-main" >
<?php 
if(isset($_GET['receipt_no']))
{
$pass_receipt_no = $_GET['receipt_no'];

 $patient_info = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_dr_prescription, p.PI_name,  p.PI_age_y,  p.PI_age_m,  p.PI_age_d, p.PI_address, p.PI_pin,  p.PI_phone, y.PP_tax, y.PP_disc, y.PP_total, y.PP_net, y.PP_paid, y.PP_bal, y.PP_date, s.state_name, d.district_name, g.gender_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id  LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id WHERE r.pr_receipt_no = '$pass_receipt_no'");
 
  while($row = mysqli_fetch_array($patient_info))
  {
	  $pr_receipt_no = $row['pr_receipt_no'];
  	  $pr_patient_id = $row['pr_patient_id'];
	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	  $pr_date = $row['pr_date'];	  
	  $dr_id = $row['pr_dr_prescription'];

  	  $name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];	  
  	  $gender = $row['gender_name'];
	  $marital = $row['marital_name'];
	  $address = $row['PI_address'];
  	  $state = $row['state_name'];
	  $district = $row['district_name'];
	  $pin = $row['PI_pin'];
  	  $phone = $row['PI_phone'];
	 
	  $PP_tax = $row['PP_tax'];
	  $PP_disc_option = $row['PP_disc'];
	  $PP_total = $row['PP_total'];
	  $PP_net = $row['PP_net'];
	  $PP_paid = $row['PP_paid'];
	  $PP_bal = $row['PP_bal'];
	  $PP_paid_date = $row['PP_date'];
	  
	} 
?>
<!------------------- Panel 1---------------------->
<div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Registration <span class="panel-subTitle"> ( Patient Info ) </span>
       <span id="page_date" class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>
       <span id="show_date"></span></span>
        </h3>
      </div>	
  <div class="panel-body">   
  	
    <!---------------- ROW 1 ---------------->
    <div class="row">  
      
       <div class="form-control-group">
        <label for="inputSex" class="col-lg-3 control-label text-right">Registration No# : </label>
        <div class="col-lg-3">					      
        <span class="input-xlarge uneditable-input text-control"> ED/<?php echo $pr_receipt_no;?> </span>
        </div>
        </div>
        
      <div class="form-control-group">
      <label for="inputName" class="col-lg-2 control-label text-right">Customer ID :</label>
      <div class="col-lg-3">
      <span class="input-xlarge uneditable-input text-control"><?php echo $pr_patient_id;?></span>
      </div>
      </div>
    
       
     </div>    
 
    <!---------------- ROW 2 ---------------->
    <div class="row">  
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Name :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control"><?php echo $name;?></span>
        </div>
        </div> 
                
     	  <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
          <div class="col-lg-2">					      
          <span class="input-xlarge uneditable-input text-control">
		  <?php echo $gender.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ('.$marital.')';?>
          </span>
          </div>
          </div>
     </div>
       
   <!---------------- ROW 3 ---------------->
    <div class="row">     
        <div class="form-control-group">
        <label for="inputName" class="col-lg-3 control-label text-right"> Address :</label>
        <div class="col-lg-3">
        <span class="input-xlarge uneditable-input text-control">
		<?php echo $address.'<br/>'.$district.', '.$state;?> <?php if($pin != ""){echo " - ".$pin;} ?></span>
        </div>
        </div>
        
          <div class="form-control-group">
          <label for="inputSex" class="col-lg-2 control-label text-right"><i class="fa fa-phone"></i> :</label>
          <div class="col-lg-3">					      
          <span class="input-xlarge uneditable-input text-control">  +91 <?php echo $phone;?></span>
          </div>
          </div>
     </div>
     
    </div>
    </div>
    
<!---------  Panel 2 - SOURCE/REFERRAL -------->
	<div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Edit <span class="panel-subTitle"> ( Source Referral ) </span>
      </h3>
    </div>	

<div class="panel-body">
<form class="form-horizontal inv-form" role="form" method="get" id="form_patient">

<div class="form-group">    
    <div class="form-control-group" style="line-height: 1.997779;"> 
    <label for="src_type" class="col-lg-3 control-label"> Source </label>
    <div class="col-lg-4">					      
    <label for="src_walkin" class="radio-inline col-lg-1" style="padding-right:40px;">
    <input  type="radio"class="form-control" name="src_type" id="src_walkin" value='W' <?php if($pr_source_id == '3'){echo "checked";} ?>>Walkin
    </label>
    <label for="src_staff" class="radio-inline col-lg-1" style="padding-right:30px;">
    <input  type="radio"class="form-control" name="src_type" id="src_staff" value='S' <?php if($pr_source_id == '2'){echo "checked";} ?>>Staff
    </label>
    <label for="src_others" class="radio-inline col-lg-1">
    <input type="radio" class="form-control" name="src_type" id="src_others" value='O' <?php if($pr_source_id > '3'){echo "checked";} ?>>Others
    </label>
    </div>
    </div>
              
           
  <div class="form-control-group" id="div_refBy">
  <div class="col-lg-4">
  <input type="text" class="form-control" placeholder="Search & Select source Person" name="referred_by" id="referred_by" value="<?php echo showReferral($con, $pr_source_id, $pr_referred_id).' ('.showSourceName($con, $pr_source_id).')'; ?>">
  <input type="hidden" id="hidden_referred_by" name="hidden_referred_by" value="<?php echo $pr_referred_id; ?>">
  <input type="hidden" id="hidden_source_id" name="hidden_source_id" value="<?php echo $pr_source_id; ?>">
  </div> 
  </div>
  
 </div>	
  
    <div class="form-group">
    <div class="form-control-group"> 
    <label for="dr_letter" class="col-lg-3 control-label"> Doctor Prescription ?</label>
    <div class="col-lg-3">					      
    <label for="dr_letter_yes" class="radio-inline col-lg-1" style="padding-right:40px;">
    <input  type="radio" name="dr_letter" class="form-control" id="dr_letter_yes" value ="Y" <?php if($dr_id != "NO"){echo "checked";} ?>>Yes
    </label>
    <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-right:30px;">
    <input type="radio" name="dr_letter" class="form-control" id="dr_letter_no" value ="N" <?php if($dr_id == "NO"){echo "checked";} ?>>No
    </label>
    </div>
    </div>
      
      <div class="form-control-group" id="div_dr_name">          
      <label for="dr_name" class="col-lg-1 control-label" id="label_dr_name">Dr.Name</label>
      <div class="col-lg-4"><input type="text" class="form-control" name="dr_name"  id="dr_name" placeholder="Search" value="<?php if($dr_id=="NO"){echo "";}else{echo showDoctor_name($con, $dr_id);}?>">
      <input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $dr_id;?>">
      </div>
      </div>  
  </div>
  
<!-- CHANGE DATE -->
 <div class="form-group">
	<div class="form-control-group">
  	<label for="date_change" class="col-lg-3 control-label"> Change Date ?</label>
      <div class="col-lg-3">					      
          <label class=" control-label radio-inline col-lg-1" style="padding-right:40px;">
           	<input  type="radio" name="opt_date" class="form-control radio-inline" value ="Y">Yes
          </label>
          <label class="control-label radio-inline col-lg-1" style="padding-right:30px;">
            <input type="radio" name="opt_date" class="form-control radio-inline" value ="N" checked>No
          </label>
      </div>
      </div>
      
      <div class="form-control-group">          
      <label for="date_edit" class="col-lg-1 control-label">Date</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" value="<?php echo date("d-m-Y, h:i:s a", strtotime($pr_date));?>" name="date_edit" id="date_edit" readonly>
      </div>
      </div>
       
 </div><!--end row 4-->	


<div class="form-group">  
  <div class="form-control-group">
  <label for="patient_history" class="col-lg-3 control-label" id="patient_history">Patient History</label>
  <div class="col-lg-3">
  <textarea class="form-control textBox_height" name="patient_history" id="patient_history" placeholder="Optional (Max.200 Characters)" maxlength="200"><?php echo showHistory_patient($con, $pr_patient_id);?></textarea>
  </div> 
  </div> 
  
    <div class="form-control-group">
    <label for="lab_note" class="col-lg-1 control-label">Lab Note</label>
    <div class="col-lg-4">
    <textarea class="form-control textBox_height" name="lab_note" placeholder="Optional (Max.100 Chars)" id="lab_note" maxlength="100"><?php echo showLab_note($con, $pr_receipt_no);?></textarea>
    </div> 
    </div>        
      
 </div>
    
    <div class="form-group panel-footer">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block submit_info" id="submit_info" name="submit_info" style="font-size:16px;">Update Info</button>
    </div>
    </div>
</form> <!------------ END Patient Info ------------->
</div>
</div>


  <!------------ Investigation table ------------->
  <div class="panel panel-success">  
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Investigation <span class="panel-subTitle"> ( Cancel / Add )</span>
     </h3>
     </div>
 
 <div class="panel-body">
  <div class="width_90" style="padding-left:10%;">
   <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display table-hover" id="test_table">
        <thead align="left">
        <tr>
          <th>SL</th>
          <th> Investigation</th>
          <th style=" text-align:right; padding-right:50px;"> Price</th>
        </tr>
        </thead>     
     <tbody>
<?php
$result_test = mysqli_query($con, "SELECT PT_sl, PT_test_id, PT_test_name, PT_test_price, PT_dept_id FROM patient_test WHERE PT_receipt_no ='$pass_receipt_no'");
$sl_no=1;
while ($test = mysqli_fetch_array($result_test))
{
	$PT_sl = $test['PT_sl'];
	$PT_test_id = $test['PT_test_id'];		
	$PT_dept_id = $test['PT_dept_id'];		
?>
 <tr id="<?php echo $PT_sl; ?>">
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
<form id="formTest" action="#" style="display:none;">	
    <input type="hidden" name="receipt_no" id="receipt_no" value="<?php echo $pass_receipt_no; ?>">
    <input type="hidden" name="test_id" id="test_id" value="<?php echo $PT_test_id; ?>">
    <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $PT_dept_id; ?>">
    <input type="hidden" name="tax_option" id="tax_option" value="<?php echo $PP_tax; ?>">
    <input type="hidden" name="tax_value" id="tax_value" value="<?php echo $PP_tax_value; ?>">    
    <input type="hidden" name="disc_option" id="disc_option" value="<?php echo $PP_disc_option; ?>">
    <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $PP_total; ?>">
    <input type="hidden" name="paid_amount" id="paid_amount" value="<?php echo $PP_paid; ?>">
    <input type="hidden" name="net_amount" id="net_amount" value="<?php echo $PP_net;?>">
    <input type="hidden" name="bal_amount" id="bal_amount" value="<?php echo $PP_bal;?>">   
    
    <label id="lblAddError" style="display:none" class="error"></label>
    <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
    
    <label style="margin-right:10px;">Sl No</label>
    <label style="margin-right:443px">Investigation</label>
    <label style="margin-right:0px;">Price</label>
    <br />
    <input type="text" style="width:45px;  margin-right:10px;" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" />        
    <input type="text" style="width:550px; margin-right:10px;" name="test_name"  id="test_name"  rel="1" />
    <input type="text" style="width:95px;  margin-right:10px;" name="test_price" id="test_price" rel="2"  readonly/>   
    <br />
</form>
<div class="width_90" style="padding-left:10%;">
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button>
</div>
</div>  
</div>

<!------------------ Start Payment  --------------->
<div class="panel panel-success">  
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Payment <span class="panel_subTitle"> ( Edit Tax / Discount )</span> </h3>      
   </div>
   		
      <div class="panel-body"> 
           
       <form class="form-horizontal inv-form" role="form" method="get" id="form_pay">
        
  <div class="form-group">
  <div class="form-control-group">           
  <label for="Total_amount" class="col-lg-2 control-label">Total Amount</label>
  <div class="col-lg-2">
  <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly value="<?php $total = showTotalAmt_database($con, $pr_receipt_no); echo number_format($total, 2,'.','');;?>">
  </div>
  </div>
  
  <div class="form-control-group">
  <label for="service_tax" class="col-lg-1-5 control-label">Service Tax</label>
  <div class="col-lg-2-1">
  <label for="tax_no" class="radio-inline col-lg-1" style="margin-left:15px;">
    <input type="radio" class="form-control" name="tax_radio" id="tax_no" value="N" <?php if($PP_tax == "N"){echo "checked";} ?>>No
  </label>
  <label for="tax_yes" class="radio-inline col-lg-1"style="padding-left:30px;">
    <input type="radio" class="form-control" name="tax_radio" id="tax_yes" value="Y" <?php if($PP_tax == "Y"){echo "checked";} ?>>Yes
  </label>
  </div> 
  </div>
    
  <div class="form-control-group">
  <label for="tax" class="col-lg-1-3 control-label" id="label_tax"  style="margin-left:12px;">Tax (%)</label>
  <div class=" form-inline col-lg-2-1" id="div_tax">
  <input type="text" class="form-control" id="tax" name="tax" placeholder="12" value="<?php if($PP_tax == "Y" && $PP_tax_value !=""){echo $PP_tax_value;} else{ echo "12";}?>" maxlength="8"> 
  </div> 
  </div>          
  </div>     
        
    <div class="form-group">
        <div class="form-control-group" style="line-height:1.9999;">
        <label for="disc_radio" class="col-lg-2 control-label">Discount</label>
        <div class="col-lg-2">
        <label for="disc_no" class="radio-inline col-lg-1" style="margin-left:30px;">
        <input type="radio" class="form-control" name="disc_radio" id="disc_no" value="N" <?php if($PP_disc_option == "N"){echo "checked";} ?>>No
        </label>
        <label for="disc_yes" class="radio-inline col-lg-1" style="padding-left:30px;">
        <input type="radio" class="form-control" name="disc_radio" id="disc_yes" value="Y" <?php if($PP_disc_option == "Y"){echo "checked";} ?>>Yes
        </label>               
        </div> 
        </div>
	
       <div class="form-inline" id="discount">
        
        <div class="form-control-group">
        <label for="disc_code" class="col-lg-1-4 control-label" id="label_disc_code">Disc Code</label>
            <div class="col-lg-2-1" id="div_disc_code">
            <input type="text" class="form-control" id="disc_code" name="disc_code" placeholder="Disc Code" readonly value="<?php $disc_sl = showDiscount_code($con, $pass_receipt_no); if($disc_sl != ""){echo 'D/'.$disc_sl;}?>">
            <input type="hidden" id="hidden_disc_code_sl" name="hidden_disc_code_sl" value="<?php echo $disc_sl;?>">
            </div>
          </div>

       <div class="form-control-group">        
      <label for="disc_amt" class="col-lg-1-4 control-label" id="label_disc_amt">Disc in Amt (<i class="fa fa-inr fa-fw"></i>)</label>
      <div class="col-lg-2-1" id="div_disc_amt">
      <input type="text" class="form-control" id="disc_amt" name="disc_amt" value="<?php if($disc_sl !="") echo getDiscount_value($con, $pass_receipt_no, 'A'); ?>" readonly>
      </div>  
      </div>
        
         <div class="form-control-group">
        <label for="disc_per" class="col-lg-1-4 control-label" id="label_disc_per">Disc Per(%)</label>
        <div class="col-lg-2-1" id="div_disc_per">
        <input type="text" class="form-control" id="disc_per" name="disc_per" value="<?php if($disc_sl !="") echo getDiscount_value($con, $pass_receipt_no, 'P');?>" readonly>
        </div>          
      </div>
       </div>
     </div>  <!--------- form-control --------------> 
             
<div class="form-group">
  <input type="hidden" value="<?php echo $pass_receipt_no;?>" name="pph_receipt_no">
  <input type="hidden" value="<?php echo $pr_patient_id; ?>" name="pph_patient_id">
  <input type="hidden" value="<?php echo $pr_source_id;?>" name="pph_source_id">
  <input type="hidden" value="<?php echo $pr_referred_id;?>" name="pph_referred_id">
    
  <label for="inputTestName" class="col-lg-2 control-label">Net Amount</label>
  <div class="col-lg-2">
  <input type="text" class="form-control" id="net_amount" name="net_amount" placeholder="Rs." readonly value="<?php echo $PP_net ;?>">
  </div>
 
            
    
    <label for="paid_amount" class="col-lg-1-4 control-label">Paid Amount</label>
    <div class="col-lg-2-1">
    <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Rs." value="<?php $paid_amount = showPaid_amount($con, $pass_receipt_no); echo $paid_amount;?>" readonly>
    <input type="hidden" class="form-control" id="hidden_paid_amount" name="hidden_paid_amount" value="<?php echo $paid_amount;?>">
   
    </div>
            
      
      <label for="due_amount" class="col-lg-1-4 control-label">Due Amount</label>
      <div class="col-lg-2-1">
      <input type="text" class="form-control" id="due_amount" name="due_amount"placeholder="Rs." readonly value="<?php echo $PP_bal;?>">
      </div>
    
 </div>
 
 <div class="form-group">
 <div class="form-control-group">
    <label for="pay_amount" class="col-lg-2 control-label">Pay Amount</label>
    <div class="col-lg-2">
    <input type="text" class="form-control" id="pay_amount" name="pay_amount" placeholder="Rs." maxlength="10">
    </div>
    </div>
    </div> 
    
    <div class="form-group panel-footer">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" id="submit_pay" name="submit_pay" style="font-size:16px;">Update Payment</button>
    </div>
    </div>
   
  </form>
  </div></div>
  <div class="clear" style="padding-bottom:50px;"></div>
  </div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>
<script src="js/patient_registration_edit.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>
<?php } ob_flush();?>