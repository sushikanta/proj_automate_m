<?php require_once("check_login_fd.php");

  resetCounter($con, 12, 'dd');	 // discount
	   resetCounter($con, 13, 'dd');    // patient_transaction
	   resetCounter($con, 14, 'dd');    // receipt_no (patient_registration)
	   resetCounter($con, 16, 'dd');	 // PT_sl (patient_test)
	   resetCounter($con, 24, 'dd');    // PP_sl (patient_payment)
	   
	   resetCounter($con, 34, 'dd');	 // patient_history
	   resetCounter($con, 35, 'dd');	 // lab_note
	   resetCounter($con, 36, 'dd');	 // Patient_test_path
	   resetCounter($con, 37, 'dd');	 // tax_tbl
?>
<!DOCTYPE html>
<html>
<head>
  <title>FD - Old Patient Registration</title>
  <?php require_once("css_bootstrap_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header.php"); ?>
<main id="content" class="bs-docs-masthead" role="main">
<div class="container">
 <div class="page-content">

<?php

 $receipt_no_only = "ED/".date( "dmy", strtotime(date("Y-m-d")))."/".CounterValueOnly($con, 14);
 

if(isset($_GET['submit'])){
	
	      $receipt_no = "ED/".date("dmy")."/".getCounter_value($con, 14);	
		  $s_patient_id = $_GET['patient_id'];	
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
		  
          $patient_address = ucwords(mysqli_real_escape_string($con, $_GET['patient_address']));
			if(isset($_GET['hidden_state']) && $_GET['hidden_state'] !="")
				  { $state_id = $_GET['hidden_state']; }
			else  { $state_id = getCounter_value($con, 7);
					$state_name = ucwords(mysqli_real_escape_string($con, $_GET['state']));	
					addState($con, $state_id, $state_name); }
			if(isset($_GET['hidden_district']) && $_GET['hidden_district'] !="")
				  { $district_id=$_GET['hidden_district']; }
			   else  
			      { $district_id = getCounter_value($con, 8);
					$district_name = ucwords(mysqli_real_escape_string($con, $_GET['district']));	
					addDistrict($con, $district_id, $district_name, $state_id); }
			
						
		  $pin_id = mysqli_real_escape_string($con, $_GET['patient_pin']);
		  $dr_presc = $_GET['dr_letter'];
		 
		  if($dr_presc == "1") { $dr_letter = $_GET['hidden_dr_id'];}	//if dr_letter = Yes, strore dr_id from autocomplete
		  if($dr_presc == "2") { $dr_letter = "NO"; }	//dif dr_letter = NO, then store NO    
		  
		  $patient_history = ucwords(mysqli_real_escape_string($con, $_GET['patient_history']));
		  $test_remark = ucwords(mysqli_real_escape_string($con, $_GET['test_remark']));
		
		  $source_id = $_GET['hidden_source'];		 
		  $referred_id = $_GET['hidden_referred_by'];
		  $patient_phone = $_GET['patient_phone'];
		  	


/*------------------------------ ADD to patient_test  - Count = 1 -------------------------------*/ 		
	if(isset($_GET['test_name']))  
	  {	
		$test_name = $_GET['test_name'];
		$test_id = $_GET['test_id'];
		$dept_id = $_GET['dept_id'];
		$test_price = $_GET['test_price'];
		$status_id = 1;	
		$num = count($test_name); 
	for($i=0; $i<$num; $i++) 
	    { 
		  $test_id_x = $test_id[$i];
		  $dept_id_x = $dept_id[$i];
		  $test_name_x = ucwords(mysqli_real_escape_string($con, $test_name[$i]));
		  $test_price_x = $test_price[$i];
		  $PT_sl = date("ymd").getCounter_value($con, 16);
		  mysqli_query($con, "INSERT INTO patient_test(PT_sl, PT_receipt_no, PT_patient_id, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id, PT_status_date1, PT_status_date2) VALUES ('$PT_sl', '".$receipt_no."', '.$s_patient_id.', '$test_id_x', '".$test_name_x."', '".$test_price_x."', '.$dept_id_x.', '.$status_id.', NOW(), NOW())");  /*--------------ADD to patient_test  - Count = 1------------*/ 
		  
	   /*-------------ADD to track_users_tbl  - Count = 2----------*/ 
	/*  
	  $TU_sl = getCounter_value($con, 11);  
	  mysqli_query($con, "INSERT INTO track_users_tbl(TU_sl, TU_PT_sl, TU_FDR_user_id, TU_FDR_date) VALUES ('$TU_sl', '$PT_sl', {$_SESSION['user_id']}, NOW())");*/
	    }	

/*-------------------UPDATE to discount_tbl  - Count = 3-----------------*/ 
	if(isset($_GET['hidden_disc_code_sl']) && $_GET['hidden_disc_code_sl'] !="" && $_GET['disc_radio'] == '1')
	  {
	   mysqli_query($con, "UPDATE discount_tbl SET disc_patient_id= '.$s_patient_id.', disc_status= '2',disc_status_date= NOW(), disc_source_id='$source_id', disc_referred_id= '$referred_id' WHERE disc_code_sl = '".$_GET['hidden_disc_code_sl']."'");
      }		
	  		
/*-------------------ADD TO patient_payment  - Count = 4-----------------*/ 
	  $pp_sl = date("ymd").getCounter_value($con, 24);
	  $total_amt = $_GET['total_amt'];
	  $tax_radio = $_GET['tax_radio'];
	  if($tax_radio =='1'){$tax = $_GET['tax'];} else{$tax = 0;}
	  $disc_radio = $_GET['disc_radio'];
	  
	  $net_amount = $_GET['net_amount'];
	  $paid_amount = mysqli_real_escape_string($con, $_GET['paid_amount']);
	  $due_amount = $_GET['due_amount'];
	  
	  mysqli_query($con, "INSERT INTO patient_payment(PP_sl, PP_receipt_no, PP_patient_id, PP_total, PP_tax, PP_tax_value, PP_disc_option, PP_net, PP_paid, PP_bal, PP_paid_date) VALUES ('.$pp_sl.', '".$receipt_no."', '.$s_patient_id.', '".$total_amt."','.$tax_radio.','".$tax."', '.$disc_radio.','".$net_amount."','".$paid_amount."','".$due_amount."', NOW())");

	 
/*-------------------Update TO patient_info  - Count = 5-----------------*/ 
mysqli_query($con, "UPDATE patient_info SET PI_name='".$patient_name."', PI_age_y = '.$patient_age_y.', PI_age_m = '.$patient_age_m.', PI_age_d = '.$patient_age_d.', PI_gender_id='.$patient_gender.', PI_marital_id ='.$marital_status_id.', PI_address ='".$patient_address."', PI_state_id ='.$state_id.', PI_district_id ='.$district_id.', PI_pin_id ='.$pin_id.', PI_phone ='.$patient_phone.' WHERE PI_id = '$s_patient_id'");


/*-------------------ADD TO patient_registration  - Count =65-----------------*/ 
	  mysqli_query($con, "INSERT INTO patient_registration(pr_receipt_no, pr_patient_id, pr_status_id, pr_status_date, pr_dr_prescription, pr_patient_history, pr_lab_notes, pr_date, pr_source_id, pr_referred_id) VALUES ('".$receipt_no."','.$s_patient_id.', '1', NOW(), '".$dr_letter."','".$patient_history."', '".$test_remark."', NOW(), '$source_id', '$referred_id')");	  
	
   }		
header("LOCATION: patient_receipt.php?receipt_no=$receipt_no&msg=1");
}  // end -submit)
?>


<?php 
if(isset($_GET['patient_id']))
{
$patient_id = $_GET['patient_id'];
$receipt_no = $_GET['receipt_no'];
$msg = $_GET['msg'];

 $patient_info = mysqli_query($con, "SELECT patient_info.*, district_tbl.district_name, state_tbl.state_name FROM patient_info 
LEFT JOIN district_tbl ON district_tbl.district_id = patient_info.PI_district_id LEFT JOIN  state_tbl ON state_tbl.state_id = patient_info.PI_state_id WHERE PI_id = '$patient_id'");
 
  while($p_info = mysqli_fetch_array($patient_info))
  {	 
  	  $pr_patient_name = $p_info['PI_name'];
	  $pr_patient_age_y = $p_info['PI_age_y'];
	  $pr_patient_age_m = $p_info['PI_age_m'];
	  $pr_patient_age_d = $p_info['PI_age_d'];
	  
  	  $pr_patient_gender = $p_info['PI_gender_id'];
	  $pr_marital_id = $p_info['PI_marital_id'];
	  $pr_patient_address = $p_info['PI_address'];
  	  $state_name = $p_info['state_name'];
	  $pr_patient_state_id = $p_info['PI_state_id'];
	  $pr_patient_district_id = $p_info['PI_district_id'];
	  $district_name = $p_info['district_name'];
	  $pr_patient_pin = $p_info['PI_pin_id'];
	  $pr_patient_phone = $p_info['PI_phone'];   	  
	  
	  }
 
?>


<div class="inv-main">
 
  <form class="form-horizontal inv-form" role="form" method="get" action="#" id="patient_registration">
  
  <div class="panel panel-success">
  <div class="panel-heading" style="color:#0D9707;">
  	<h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> New Registration <span class="panel_subTitle"> ( Old Patient ) </span>
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span>
    
  <?php if ($msg =='1'){?>
  <a class="text-right pull-right navbar-link no-print" href="fd_search_result.php?receipt_no=<?php echo $receipt_no;?>&msg=1" style="padding-left:30px;">
   <?php }
   else if ($msg =='2'){?> <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px;"> <?php } 
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
   </div> 
      </h3>
  </div>
          							 
     <div class="form-group">
     <div class="form-control-group">
      <label for="patient_name" class="col-lg-1-4 control-label">Name</label>
      <div class="col-lg-2-5">
          <input type="text" class="form-control capital" id="patient_name" placeholder="Patient name" name="patient_name" maxlength="50" value="<?php echo $pr_patient_name;?>">
          <input type="hidden" class="form-control" name="patient_id" value="<?php echo $patient_id;?>">
      </div>
      </div>
                
      <div class="form-control-group">
      <label for="patient_sex" class="col-lg-1-3 control-label">Gender</label>
      <div class="col-lg-1-4">					      
          <label for="optionsRadios1" class="radio-inline col-lg-1" style="margin-left: 10px;">
            <input type="radio" class="form-control" name="patient_sex" id="optionsRadios1" value=1 <?php if($pr_patient_gender == "1"){ echo "checked";} ?> >Male
          </label>
          <label for="optionsRadios2" class="radio-inline col-lg-1" style="padding-left:30px;">
            <input type="radio" class="form-control" name="patient_sex" id="optionsRadios2" value=2 <?php if($pr_patient_gender == "2"){ echo "checked";} ?> >Female
          </label>
      </div>
      </div>	
      
      <div class="form-control-group">
      <label for="marital_status" class="col-lg-1-3 control-label">Marital</label>
      <div class="col-lg-1-4" style="margin-right:4px;">
      <select class="form-control" name="marital_status" id="marital_status">
          <option value="">Select</option>
          <?php 
			  $result=mysqli_query($con, "SELECT marital_id, marital_name FROM marital_tbl");
			  while($row=mysqli_fetch_array($result))
			  {					
			   ?>
				<option value="<?php echo $row['marital_id'];?>" <?php if($row['marital_id'] == $pr_marital_id){echo "selected";}?>><?php echo $row['marital_name'];?></option>						 
			   <?php
			  }
			 ?>          
      </select>
      </div>
      </div>	
                      
      <div id="div_age_y" class="form-control-group">
        <label for="patient_age_y" class="col-lg-1-1-0 control-label" id="label_age_y">YY</label>
         <div class="col-lg-1-2">
           <input type="text" class="form-control" id="patient_age_y" placeholder="YY" name="patient_age_y" value="<?php echo $pr_patient_age_y;?>" maxlength="3">
        </div> 
        </div>
        
         <div id="div_age_m" class="form-control-group">
         <label for="patient_age_m" class="col-lg-1-1-0 control-label" id="label_age_m">MM</label>
         <div class="col-lg-1-2">
           <input type="text" class="form-control" id="patient_age_m" placeholder="MM" name="patient_age_m" value="<?php echo $pr_patient_age_m;?>" maxlength="3">
        </div> 
        </div>
         
       <div id="div_age_d" class="form-control-group">
       <label for="patient_age_d" class="col-lg-1-1-0 control-label" id="label_age_d">DD</label>   
         <div class="col-lg-1-2">
         <input type="text" class="form-control" id="patient_age_d" placeholder="DD" name="patient_age_d" value="<?php echo $pr_patient_age_d;?>" maxlength="3">
        </div> 
        </div>
           		
      <div class="form-control-group">
      <label for="patient_phone" class="col-lg-1-3 control-label">Phone</label>
      <div class="col-lg-1-4">
         <input type="text" class="form-control" id="patient_phone" placeholder="Phone no" name="patient_phone" maxlength="10" value="<?php echo $pr_patient_phone;?>">
      </div>
      </div>       
   </div>
                               
      <div class="form-group"> 
         <div class="form-control-group">
         <label for="patient_address" class="col-lg-1-4 control-label">Address</label>
          <div class="col-lg-2-5">
            <input type="text" class="form-control capital" id="patient_address" placeholder="Address" name="patient_address" maxlength="50" value="<?php echo $pr_patient_address;?>">
          </div> 
          </div>
          
        <div class="form-control-group">  
        <label for="state" class="col-lg-1-3 control-label">State</label>
          <div class="col-lg-2-1" id="div_state">
            <input type="text" class="form-control capital" id="state" placeholder="State - Search/Add" name="state" value="<?php echo $state_name;?>" maxlength="20" value="<?php echo $state_name;?>">
            <input type="hidden" class="form-control" id="hidden_state" name="hidden_state" value="<?php echo $pr_patient_state_id;?>">
          </div>  
          </div>
        
         <div class="form-control-group">            
         <label for="district" class="col-lg-1-3 control-label" id="label_state_district">District</label>
          <div class="col-lg-2-1" id="div_district">
            <input type="text" class="form-control capital" id="district" placeholder="District - Search/Add" name="district" maxlength="20" value="<?php echo $district_name;?>">
            <input type="hidden" class="form-control" id="hidden_district" name="hidden_district" value="<?php echo $pr_patient_district_id;?>">
          </div> 
          </div>
          
          <div class="form-control-group">    
          <label for="patient_pin" class="col-lg-1-3 control-label" id="label_patient_pin">PIN</label>
          <div class="col-lg-2-1" id="div_patient_pin">
            <input type="text" class="form-control" id="patient_pin" placeholder="PIN Code - Optional" name="patient_pin" maxlength="6" 
            value="<?php if( $pr_patient_pin ==0){echo "";}else{ echo $pr_patient_pin;} ?>">
            
          </div>
          </div>
      </div>				

      <div class="form-group">   
         
         <div class="form-control-group"> 
           <label for="dr_letter" class="col-lg-1-4 control-label"><!--<i class="fa fa-user-md fa-fw fa-lg"></i>--> Dr. Letter ?</label>
            <div class="col-lg-2-5">					      
                <label for="dr_letter_yes" class="radio-inline col-lg-1" style="margin-left:30px;">
                  <input  type="radio"class="form-control" name="dr_letter" id="dr_letter_yes" value=1 checked>Yes
                </label>
                <label for="dr_letter_no" class="radio-inline col-lg-1" style="padding-left:35px;">
                  <input type="radio" class="form-control" name="dr_letter" id="dr_letter_no" value=2>No
                </label>
            </div>
            </div>
            
        <div class="form-control-group" id="div_dr_name">          
        <label for="dr_name" class="col-lg-1-3 control-label" id="label_dr_name">Dr. Name</label>
          <div class="col-lg-2-1" >
           <input type="text" class="form-control" name="dr_name" placeholder="Search Dr. name" id="dr_name">
           <input type="hidden" name="hidden_dr_id" id="hidden_dr_id">
          </div>
          </div>   
         
          <div class="form-control-group">
         <label for="source" class="col-lg-1-3 control-label">Src Type</label>
          <div class="col-lg-2-1">
            <input type="text" class="form-control" id="source" placeholder="e.g. Hospital" name="source" maxlength="50">
            <input type="hidden" id="hidden_source" name="hidden_source">
          </div>  
          </div>
         
         <div class="form-control-group">          
        <label for="referred_by" class="col-lg-1-3 control-label" id="label_referred_by">Src Name</label>
          <div class="col-lg-2-1" id="div_refBy">
           <input type="text" class="form-control" name="referred_by" placeholder="e.g. Advance Hospital" id="referred_by">
           <input type="hidden" name="hidden_referred_by" id="hidden_referred_by">
          </div> 
            </div>	
          </div>	      

      <div class="form-group">         
             
          <div class="form-control-group">
           <label for="patient_history" class="col-lg-1-4 control-label">Patient History</label>
          <div class="col-lg-2-5">
           <textarea class="form-control textBox_height" name="patient_history" id="patient_history" placeholder="Optional (max.50 characters)" maxlength="50" ></textarea>
          </div> 
          </div>
          
          <div class="form-control-group"> 
         <label for="test_remark" class="col-lg-1-3 control-label" id="label_referred_by">Lab Note</label>
          <div class="col-lg-2-1">
           <textarea class="form-control textBox_height" id="test_remark" name="test_remark" placeholder="Optional (max.30 chars)" maxlength="30" ></textarea>
          </div> 
          </div>  
          
          <div class="form-control-group">          
     <label for="reg_id" class="col-lg-1-3 control-label">Reg. ID</label>
      <div class="col-lg-2-1">
           <input type="text" class="form-control" value="<?php echo "ED/".date( "dmy", strtotime(date("Y-m-d")))."/".counterValueOnly($con, 14);?>" name="receipt_no" readonly> 
      </div>
     </div> 
      
	<div class="form-control-group">          
    <label for="current_date" class="col-lg-1-3 control-label">Date</label>
      <div class="col-lg-2-1"><span class="form-control" id="long_date_time"></span></div>
     </div>
          
                
      </div>	
</div> <!----------------------------- END Patientn info------------------------------->
    
<div class="panel panel-success" id="test_div">  <!----------------------------- START Investigation Details------------------------------->
       <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-pagelines fa-fw fa-lg"></i> Investigation information
        <?php if ($msg =='1'){?>
  <a class="text-right pull-right navbar-link no-print" href="fd_search_result.php?receipt_no=<?php echo $receipt_no;?>&msg=1" style="padding-left:30px; font-size:14px;"> <?php } 
  else if ($msg =='2'){?> <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px; font-size:14px;"> <?php }
  else if ($msg =='9'){?> <a class="text-right pull-right navbar-link no-print" href="fd_pending_all.php" style="padding-left:30px;"> <?php } ?>
  
  <i class="fa fa-arrow-circle-right fa-lg"></i></a>
       </h3></div>       
      
         <div class="row">
         <label for="ext_1" class="col-lg-1-3"></label>
         <label for="ext_2" class="col-lg-2">SL</label>
         <label for="ext_3" class="col-lg-6">Investigation Name</label>
         <label for="ext_4" class="col-lg-1-4"></label>
         <label for="ext_5" class="col-lg-1-6 text-center">Price</label>
         </div>       
        
        
        <div class="form-group clonedInput" id="entry1">       
         <label for="ext_6" class="col-lg-1-3"></label>
         <label id="sl_no1" name="sl_no" class="col-lg-1 sl_no">1.</label>
          
           <div class="form-control-group">
           <label for="test_name" class="col-lg-1 control-label label_test_name"></label>
                <div class="col-lg-6">
                  <input type="text" class="form-control test_name" id="test_name" placeholder="Search & Select Investigation" name="test_name[]" required>
                  <input type="hidden" class="form-control test_id" id="hidden_test_id" name="test_id[]">                  
                  <input type="hidden" class="form-control dept_id" id="hidden_dept_id" name="dept_id[]">                  
                </div>
          </div>
                
            <div class="form-control-group">
            <label for="test_price" class="col-lg-1-4 control-label label_test_price"></label>
            <div class="col-lg-1-6" id="price_div">
              <input type="text" class="form-control text-right test_price" style="padding-right:36%;" id="test_price" placeholder="Rs." name="test_price[]" readonly>                  
            </div>
            </div>
                        
       </div>
           
        <div class="form-group">
        <label id="reference" name="reference" class="col-lg-1-3"></label>    
        <div id="addDelButtons">
        <input type="button" id="btnAdd" class="btn btn-mini btn-primary addIcon">&nbsp;
        <input type="button" id="btnDel" class="btn btn-mini btn-danger deleteIcon">
        </div>
        </div>
	   
  </div>   <!------------------------------------------------------- END Investigation Details ------------------------------------>
  
    <div class="panel panel-success">   <!------------------------------------------------------ Start Payment Details ---------------> 
        <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-money fa-fw fa-lg"></i> Payment information
       
        <?php if ($msg =='1'){?>
  <a class="text-right pull-right navbar-link no-print" href="fd_search_result.php?receipt_no=<?php echo $receipt_no;?>&msg=1" style="padding-left:30px; font-size:14px;"> <?php } 
  else if ($msg =='2'){?> <a class="text-right pull-right navbar-link no-print" href="fd_search.php" style="padding-left:30px; font-size:14px;"> <?php } 
  else if ($msg =='9'){?> <a class="text-right pull-right navbar-link no-print" href="fd_pending_all.php" style="padding-left:30px;"> <?php } ?>
  
  <i class="fa fa-arrow-circle-right fa-lg"></i></a>
       </h3></div>
          
        <div class="form-group">   
          
          <div class="form-control-group">
             <label for="total_amt" class="col-lg-2 control-label">Total Amount</label>
              <div class="col-lg-2">
              <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly>
              </div>
          </div>
            
         <div class="form-control-group">
            <label for="tax_radio" class="col-lg-1-5 control-label">Service Tax</label>
            <div class="col-lg-2-1">
            <label for="tax_no" class="radio-inline col-lg-1" style="margin-left:15px;">
              <input type="radio" class="form-control" name="tax_radio" id="tax_no" value="2" checked>No
            </label>
            <label for="tax_yes" class="radio-inline col-lg-1"style="padding-left:30px;">
              <input type="radio" class="form-control" name="tax_radio" id="tax_yes" value="1">Yes
            </label>
           </div> 
           </div>
              
          <div class="form-control-group">
              <label for="tax" class="col-lg-1-3 control-label" id="label_tax" style="margin-left:12px;">Tax (%)</label>
              <div class=" form-inline col-lg-2-1" id="div_tax">
               <input type="text" class="form-control" id="tax" name="tax" placeholder="12" value="12" maxlength="8">
              </div> 
           </div> 
          </div>        
                          
   <div class="form-group">  
         
         <div class="form-control-group">
           <label for="Discount" class="col-lg-2 control-label">Discount</label>
           <div class="col-lg-2">
            <label for="disc_no" class="radio-inline col-lg-1" style="margin-left:30px;">
              <input type="radio" class="form-control" name="disc_radio" id="disc_no" value="2" checked>No
            </label>
             <label for="disc_yes" class="radio-inline col-lg-1" style="padding-left:30px;">
              <input type="radio" class="form-control" name="disc_radio" id="disc_yes" value="1">Yes
            </label>               
           </div> 
         </div>
                    
       <div class="form-control-group"> 
        <div class="form-inline" id="discount">
            
            <label for="disc_code" class="col-lg-1-4 control-label" id="label_disc_code">Disc Code</label>
            <div class="col-lg-2-1" id="div_disc_code">
            <input type="text" class="form-control" id="disc_code" name="disc_code" placeholder="Disc Code" 
            value="<?php $receipt_no_only = "ED/".date( "dmy", strtotime(date("Y-m-d")))."/".CounterValueOnly($con, 14); 
            $disc_code=showDiscount_code($con, $receipt_no_only); if($disc_code!=""){echo $disc_code;}?>" readonly>
            <input type="hidden" class="form-control" id="hidden_disc_code_sl" name="hidden_disc_code_sl" value="<?php echo showDiscount_code_sl($con, $receipt_no_only);?>">
            </div>
            
            <label for="disc_amt" class="col-lg-1-4 control-label" id="label_disc_amt">Disc (Rs) (<i class="fa fa-inr fa-fw"></i>)</label>
            <div class="col-lg-2-1" id="div_disc_amt">
            <input type="text" class="form-control" id="disc_amt" name="disc_amt" value="<?php $amt = getDiscount_value_amt($con, $receipt_no_only); 
            if($amt == '0'){echo "";} else{ echo $amt;} ?>" readonly>
            </div>  
            
            <label for="disc_per" class="col-lg-1-4 control-label" id="label_disc_per">Disc Per(%)</label>
            <div class="col-lg-2-1" id="div_disc_per">
            <input type="text" class="form-control" id="disc_per" name="disc_per" value="<?php $per = getDiscount_value_per($con, $receipt_no_only);
            if($per == '0'){echo "";}else{echo $per;} ?>" readonly>
            </div>          
       </div>     <!--------- End Discount Row--------------> 
      </div> <!---------First Row-------------->  
   </div>
   
   
    <div class="form-group">  
       <div class="form-control-group">          
          <label for="net_amount" class="col-lg-2 control-label">Net Amount</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" id="net_amount" name="net_amount" placeholder="Rs." readonly>
            </div>
       </div>
            
        <div class="form-control-group">          
          <label for="paid_amount" class="col-lg-1-4 control-label">Paid Amount</label>
            <div class="col-lg-2-1">
              <input type="text" class="form-control paid_amount" id="paid_amount" name="paid_amount" placeholder="Rs." maxlength="10">
            </div>
        </div>
            
        <div class="form-control-group">            
          <label for="due_amount" class="col-lg-1-4 control-label">Due Amount</label>
            <div class="col-lg-2-1">
              <input type="text" class="form-control" id="due_amount" name="due_amount"placeholder="Rs." readonly>
            </div>
         </div>
               
    </div> <!--------------------- END 2nd row -------------->
 
 <div class="clear"></div>
 
   </div> <!--------------------- END Payment Details-------------->
  
  <div class="clear"></div>
  
  <div class="form-group ">
    <div class="col-lg-offset-4 col-lg-4">
     <button type="submit" class="btn btn-primary btn-block patient_submit" id="patient_submit" name="submit"  style="font-size:16px;">Submit</button>
    </div>
  </div>
  
  
</form>
  
   </div>
<div class="clear"></div>
</div>
</main>
<?php require_once("footer.php");?> 
<?php require_once("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>
<script src="js/patient_registration.js" type="text/javascript"></script>
</body>
</html>
<?php } ob_flush();?>