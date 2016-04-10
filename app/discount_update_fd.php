<?php require_once("check_login_fd.php");
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

 $patient_info = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_dr_prescription, p.PI_name,  p.PI_age_y,  p.PI_age_m,  p.PI_age_d,  p.PI_gender,  p.PI_marital_id,  p.PI_address, p.PI_state_id,  p.PI_district_id,  p.PI_pin,  p.PI_phone, y.PP_tax, y.PP_disc,  y.PP_total, y.PP_net, y.PP_paid, y.PP_bal, y.PP_date, s.state_name, d.district_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id WHERE r.pr_receipt_no = '$pass_receipt_no'");
 
  while($row = mysqli_fetch_array($patient_info))
  {
	  $pr_receipt_no = $row['pr_receipt_no'];
  	  $pr_patient_id = $row['pr_patient_id'];
	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	  $pr_date = $row['pr_date'];	  
	  $dr_id = $row['pr_dr_prescription'];

  	  $pr_patient_name = $row['PI_name'];
	  $pr_patient_age_y = $row['PI_age_y'];
	  $pr_patient_age_m = $row['PI_age_m'];
	  $pr_patient_age_d = $row['PI_age_d'];	  
  	  $pr_patient_gender = $row['PI_gender'];	 
	  $pr_patient_address = $row['PI_address']; 
	  $pr_patient_pin = $row['PI_pin'];
  	  $pr_patient_phone = $row['PI_phone'];
	  
	  $PP_tax = $row['PP_tax'];
	  $PP_disc = $row['PP_disc'];
	  $PP_total = $row['PP_total'];
	  $PP_net = $row['PP_net'];
	  $PP_paid = $row['PP_paid'];
	  $PP_bal = $row['PP_bal'];
	  $PP_paid_date = $row['PP_date'];
	  
	  $state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  $marital_name = $row['marital_name'];
	} 
?>

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Patient Info
    <span id="page_date" class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>
    <span id="show_date"></span></span>
    </h3>
    </div>							  

<div class="panel-body">

    <div class="row">
    <label class="col-lg-2 control-label text-right">Registration # :</label> <div class="col-lg-3"><?php echo $pr_receipt_no;?></div> 
    <label class="col-lg-5 control-label text-right" style="margin-left:-20px;">Date <i class="fa fa-calendar"></i> :</label><div class="col-lg-1-7"><?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></div>
    </div>
    
    <div class="row">
    <label for="inputName" class="col-lg-2 control-label text-right">Name :</label> 
    <div class="col-lg-3"><?php echo $pr_patient_name;?></div> 
    <label for="inputName" class="col-lg-1-5 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label> 
    <div class="col-lg-5">
    <?php echo $pr_patient_gender.' / '.show_age_long($con, $pr_patient_age_y, $pr_patient_age_m, $pr_patient_age_d);?> (<?php echo $marital_name; ?>)
    </div>
    </div>

  <div class="row">
  <label for="inputName" class="col-lg-2 control-label text-right">Address :</label>
  <div class="col-lg-6"><?php echo $pr_patient_address.', '.$district_name.', '.$state_name; if($pr_patient_pin !=""){ echo ' - '.$pr_patient_pin;}?></div> 
  
  <label class="col-lg-2 control-label text-right" style="margin-left:-20px;"> <i class="fa fa-phone-square"></i> :</label>
  <div class="col-lg-1-6"> +91 <?php echo $pr_patient_phone;?></div> 
  </div>

<div class="row">
  <label for="inputName" class="col-lg-2 control-label text-right">Dr. Letter :</label> 
  <div class="col-lg-3"><?php if($dr_id =='NO'){echo "No";}else{echo "Yes";} ?></div> 
  <label for="inputName" class="col-lg-1-5 control-label text-right">Patient History :</label>
  <div class="col-lg-2"><?php  echo showHistory_patient($con, $pr_patient_id); ?></div>
  <label for="inputName" class="col-lg-1-5 control-label text-right">Lab Notes :</label> 
  <div class="col-lg-2"><?php echo showLab_note($con, $pr_receipt_no);?></div>
</div>

<div class="row">
<label for="inputName" class="col-lg-2 control-label text-right">Ref. By :</label> 
<div class="col-lg-3"><?php if($dr_id =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $PT_dr_letter);} ?>
</div>
 <label for="inputName" class="col-lg-1-5 control-label text-right">Source :</label>
 <div class="col-lg-5"><?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?>
 </div>
</div>

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-condensed" id="status_table">
    <thead align="left">
    <tr>
      <th class="text-center" style="width:10%;"> Sl. no. </th>
      <th style="width:40%;"> Investigation</th>
     <th style="width:15%;"> Status</th>             
     <th class="text-right" style="width:25%;"> Amount</th>             
    </tr>
    </thead>     
    <tbody>
    <?php 
    
    $result_test = mysqli_query($con, "SELECT patient_test.PT_sl, patient_test.PT_test_name, patient_test.PT_test_price, status_tbl.status_name FROM patient_test LEFT JOIN status_tbl ON status_tbl.status_id = patient_test.PT_status_id WHERE patient_test.PT_receipt_no = '$pr_receipt_no'");
    $sl_no=1;
    while ($charge = mysqli_fetch_array($result_test))
    {   
    $PT_id = $charge['PT_sl'];
    $test_name = $charge['PT_test_name'];
    $test_price = $charge['PT_test_price'];    
    ?>
      <tr id="<?php echo $PT_id; ?>">
        <td class="text-center"> <?php echo $sl_no; ?> </td>
        <td> <?php echo $test_name; ?> </td>  
        <td><?php echo $charge['status_name']; ?> </td>          
        <td style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($test_price, 2, '.', ','); ?> </td>
      </tr>
    <?php
    $sl_no++;
    }
    ?>
    </tbody>   
    </table>
</div>
</div>
</div>

<!------------------ Start Payment  --------------->
<div class="panel panel-success">  
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Payment <span class="panel_subTitle"> ( Edit Tax / Discount )</span> </h3>      
   </div>
   		
  <div class="panel-body">           
  <form class="form-horizontal inv-form" role="form" method="get" id="form_pay">        
  <div class="form-group">
  <div class="form-control-group">           
  <label for="Total_amount" class="col-lg-2 control-label">Total Amount</label>
  <div class="col-lg-2">
  <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly value="<?php echo $PP_total; ?>">
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
  <input type="text" class="form-control" id="tax" name="tax" placeholder="12" value="<?php if($PP_tax == "Y"){echo showTax_value($con, $pr_receipt_no);}?>" readonly> 
  </div> 
  </div>          
  </div>     
        
    <div class="form-group">
        <div class="form-control-group">
        <label for="disc_radio" class="col-lg-2 control-label">Discount</label>
        <div class="col-lg-2">
        <label for="disc_no" class="radio-inline col-lg-1" style="margin-left:30px;">
        <input type="radio" class="form-control" name="disc_radio" id="disc_no" value="N" <?php if($PP_disc == "N"){echo "checked";} ?>>No
        </label>
        <label for="disc_yes" class="radio-inline col-lg-1" style="padding-left:30px;">
        <input type="radio" class="form-control" name="disc_radio" id="disc_yes" value="Y" <?php if($PP_disc == "Y"){echo "checked";} ?>>Yes
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
      <input type="text" class="form-control" id="disc_amt" name="disc_amt" value="<?php if($disc_sl !=""){ echo getDiscount_value($con, $pass_receipt_no, 'A'); }?>" readonly>
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
    <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Rs." value="<?php echo $PP_paid;?>" readonly>
    <input type="hidden" class="form-control" id="hidden_paid_amount" name="hidden_paid_amount" value="<?php echo $PP_paid;?>">
   
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
<?php require_once("script_bootstrap.php"); ?>
<script src="js/discount_update_fd.js" type="text/javascript"></script>
</body>
</html>
<?php } ob_flush();?>