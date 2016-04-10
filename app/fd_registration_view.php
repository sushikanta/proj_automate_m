<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2' || $_SESSION['user_dept_id'] == '3')
 {
?>
<!DOCTYPE html>
<html>
<head>
<title>ED - Registration Detail</title>
<?php require_once("css_bootstrap_datatable_header.php"); ob_start();?> 
<body>
<?php if($_SESSION['user_dept_id'] == '2'){require_once("right_top_header_admin.php");} else if($_SESSION['user_dept_id'] == '3'){require_once("right_top_header.php");}?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">

<?php

if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $patient_info = mysqli_query($con, "SELECT patient_registration.pr_source_id, patient_registration.pr_referred_id, patient_registration.pr_date, 
 patient_registration.pr_status_id, patient_registration.pr_dr_prescription, patient_registration.pr_patient_history, patient_registration.pr_lab_notes, patient_info.PI_name, patient_info.PI_gender_id, patient_info.PI_phone, patient_info.PI_address, patient_info.PI_pin_id, patient_info.PI_age_y, patient_info.PI_age_m, patient_info.PI_age_d, marital_tbl.marital_name, state_tbl.state_name, district_tbl.district_name, pin_tbl.pin_code FROM patient_registration LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id LEFT JOIN marital_tbl ON marital_tbl.marital_id = patient_info.PI_marital_id LEFT JOIN state_tbl ON state_tbl.state_id = patient_info.PI_state_id LEFT JOIN district_tbl ON district_tbl.district_id = patient_info.PI_district_id LEFT JOIN pin_tbl ON pin_tbl.pin_id = patient_info.PI_pin_id WHERE patient_registration.pr_receipt_no = '".$receipt_no."'");
 
  while($p_info = mysqli_fetch_array($patient_info))
  {
	  
  	  $pr_patient_name = $p_info['PI_name'];
	  $pr_patient_gender = $p_info['PI_gender_id'];
	  $pr_y = $p_info['PI_age_y'];
	  $pr_m = $p_info['PI_age_m'];
	  $pr_d = $p_info['PI_age_d'];
	  $pr_marital = $p_info['marital_name'];
	  $pr_patient_address = $p_info['PI_address'];
  	  $pr_patient_state = $p_info['state_name'];
	  $pr_patient_district = $p_info['district_name'];
	  $pr_patient_pin = $p_info['PI_pin_id'];
  	  $pr_patient_phone = $p_info['PI_phone'];
	  
  	  $pr_source_id = $p_info['pr_source_id'];
	  $pr_referred_id = $p_info['pr_referred_id'];
  	  $pr_date = $p_info['pr_date'];
	  $pr_status_id = $p_info['pr_status_id'];	  
	  $PT_dr_letter = $p_info['pr_dr_prescription'];
	  $PT_history = $p_info['pr_patient_history'];
	  $PT_remark = $p_info['pr_lab_notes'];	  
	  }
 
?>

<div class="panel panel-success">
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> FD - <span class="panel-subTitle"> Registration information </span>
   
    <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> 
    <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>         
<div class="row">
<label class="col-lg-2 control-label text-right">Registration ID :</label> 
<div class="col-lg-3">ED/<?php echo $receipt_no;?></div> 
<label class="col-lg-5 control-label text-right" style="margin-left:-20px;">Date <i class="fa fa-calendar"></i> :</label>
<div class="col-lg-1-7"><?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></div>
</div>

<div class="row">
<label for="inputName" class="col-lg-2 control-label text-right">Name :</label>
<div class="col-lg-3"><?php echo $pr_patient_name;?></div> 
<label for="inputName" class="col-lg-1-5 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label> 
<div class="col-lg-4">
<?php echo $pr_marital; echo ' ('.show_gender_short($con, $pr_patient_gender).'), '.show_age_long($con, $pr_y, $pr_m, $pr_d);?>
</div>
</div>

<div class="row">
  <label for="inputName" class="col-lg-2 control-label text-right">Address :</label>
  <div class="col-lg-6"><?php echo $pr_patient_address.', '.$pr_patient_district; if($pr_patient_pin =="0"){ echo ', '.$pr_patient_state;}else{echo ', '.$pr_patient_state." - ".$pr_patient_pin;}?>
  </div> 

<label class="col-lg-2 control-label text-right" style="margin-left:-20px;">Phone <i class="fa fa-phone-square"></i> :</label>
<div class="col-lg-1-6"> +91 <?php echo $pr_patient_phone;?></div>
</div>

<div class="row">
  <label for="inputName" class="col-lg-2 control-label text-right">Dr. Letter :</label> 
  <div class="col-lg-3"><?php if($PT_dr_letter =='NO'){echo "No";}else{echo "Yes";} ?></div> 
  <label for="inputName" class="col-lg-1-5 control-label text-right">Patient History :</label>
  <div class="col-lg-2"><?php echo $PT_history;?></div>
  <label for="inputName" class="col-lg-1-5 control-label text-right">Lab Notes :</label> 
  <div class="col-lg-2"><?php echo $PT_remark;?></div>
</div>

<div class="row">
<label for="inputName" class="col-lg-2 control-label text-right">Ref. By :</label> <div class="col-lg-3"><?php if($PT_dr_letter =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $PT_dr_letter);} ?></div> 

 <label for="inputName" class="col-lg-1-5 control-label text-right">Source Person :</label>
  <div class="col-lg-5"><?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?></div>
</div>

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
        <thead align="left">
        <tr>
          <th colspan="1" class="text-center" style="width:10%;"> Sl. no. </th>
          <th colspan="4" style="width:40%;"> Investigation</th>
         <th  colspan="1"class="text-center" style="width:15%;"> Status</th>             
         <th colspan="1" class="text-right" style="width:25%;"> Amount</th>             
        </tr>
        </thead>
     
  <tbody>
<?php 

$result_test = mysqli_query($con, "SELECT patient_test.PT_test_name, patient_test.PT_test_price, patient_payment.*, discount_tbl.*, status_tbl.status_name FROM patient_test LEFT JOIN  patient_payment ON patient_payment.PP_receipt_no=patient_test.PT_receipt_no LEFT JOIN discount_tbl ON discount_tbl.disc_receipt_no = patient_test.PT_receipt_no LEFT JOIN status_tbl ON status_tbl.status_id = patient_test.PT_status_id WHERE patient_test.PT_receipt_no = '".$receipt_no."'");
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{   
 	$test_name = $charge['PT_test_name'];
	$test_price = $charge['PT_test_price'];
    $total = $charge['PP_total'];
	
	$tax =  $charge['PP_tax'];
	$tax_value =  $charge['PP_tax_value'];
	
	$disc_option =  $charge['PP_disc_option'];
	$disc_value =  $charge['disc_value'];
	$disc_type =  $charge['disc_type'];
	
	$bal =  $charge['PP_bal'];
	$disc_option =  $charge['PP_disc_option'];
	$paid =  $charge['PP_paid'];	
	$net = $charge['PP_net'];
	
	?>
          <tr>
            <td colspan="1" class="text-center"> <?php echo $sl_no; ?> </td>
            <td colspan='4'> <?php echo $test_name; ?> </td>  
            <td colspan="1" class="text-center"><?php echo $charge['status_name']; ?> </td>          
            <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($test_price, 2, '.', ','); ?> </td>
          </tr>
       <?php
 $sl_no++;
}
?>
<!---------------------- Sub total ------------------------------> 
          <tr>
            
            <td colspan="6" style="text-align:right; border-top-style:none !important; border-bottom-color:transparent !important;">Sub Total</td>
            <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ','); ?> </td>
          </tr>
          
 <!---------------------- total ------------------------------>  
   <tr>
     <td colspan="6" class="text-right" style="border-top-style:none !important; border-bottom-color:transparent !important;">

	<?php if($tax == '1'){?>
     <span style="padding-right:30px;">Service Tax (<?php echo $tax_value; ?>%) :&nbsp; <i class="fa fa-inr"></i> <?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc;  echo number_format($tax_calc, 2, '.', ','); ?> </span><?php } else{$total_after_tax = $total;}?> 
            
<?php if($disc_option == '1' && $disc_value !=NULL)
	{ 
	     if (isset($disc_type) && $disc_type =='1') // disc in percentage
			  { ?>
              <span style=" padding-right:30px;">
              Discount (<?php echo $disc_value; ?>%) :&nbsp; <i class="fa fa-inr"></i> <?php $disc_calc = ($total_after_tax * $disc_value)/100;
			  echo number_format($disc_calc, 2, '.', ','); ?></span>
              
        <?php } 
            
        if (isset($disc_type) && $disc_type =='2') // disc in Amount
			  { ?>
                 <span style=" padding-right:30px;">
                 Discount :&nbsp; <i class="fa fa-inr"></i> <?php echo number_format($disc_value, 2, '.', ','); ?></span>
        <?php }
		
	}?>
   <span class="pull-right">Total Amount</span>
   </td>
   
   <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($net, 2, '.', ','); ?> </td>
   </tr>
          
 <!---------------------- Amount Received ------------------------------>    
    <tr>            
      <td colspan="6" style="vertical-align:bottom; text-align:right; border-top-style:none !important; border-bottom-color:transparent !important;">Amount Received</td><div class="clearfix"></div>      
 
 <?php 
$check = mysqli_query($con, "SELECT patient_due_tbl.PD_bal_paid, patient_due_tbl.PD_date FROM patient_payment LEFT JOIN patient_due_tbl ON patient_payment.PP_sl = patient_due_tbl.PD_pp_sl WHERE patient_payment.PP_receipt_no = '".$receipt_no."'  AND patient_due_tbl.PD_bal_paid !='0' AND patient_due_tbl.PD_pp_sl IS NOT NULL ORDER BY patient_due_tbl.PD_date ASC");     
     if (mysqli_num_rows($check) != 0)       
   { ?>
     
<td colspan="1" style="padding:0; margin:0;">    

<!---------- PAYMENT HISTORY IF due paid on different dates----------->
<table border="1" frame="void" rules="all" style="width:100%;">
   
  <tr>
    <td style="border-right-color:transparent; border-bottom-color:#DDDDDD;">Date</td>
    <td style="text-align:right; border-bottom-color:#DDDDDD;">Payment</td>
  </tr>
 
 <?php  
 $check1 = mysqli_query($con,"SELECT PP_paid, PP_paid_date FROM patient_payment WHERE PP_receipt_no = '".$receipt_no."'");
 while($row1=mysqli_fetch_array($check1)){ 
 				
				$paid_date1 = $row1['PP_paid_date'];
				$paid1 = $row1['PP_paid'];
 	    	}?>
 
 
  <tr>
    <td style="border-right-color:transparent; border-bottom-color:#DDDDDD;"><?php echo date("d/m/Y, h:i a", strtotime($paid_date1)); ?></td>
    <td style="text-align:right; border-bottom-color:#DDDDDD;"><i class="fa fa-inr"></i> <?php echo number_format($paid1,'2','.',','); ?></td>
  </tr>
   
 <?php  while($row=mysqli_fetch_array($check)){ ?>

<tr>
<td style="border-right-color:transparent; border-bottom-color:#DDDDDD;"> <?php echo date("d/m/Y, h:i a", strtotime($row['PD_date'])); ?></td>
<td style="text-align:right; border-bottom-color:#DDDDDD;"><i class="fa fa-inr"></i> <?php echo number_format($row['PD_bal_paid'],'2','.',','); ?></td>
</tr>	

<?php } 
	
 ?>

<tr>
<td colspan="2" style="text-align:right !important;"><i class="fa fa-inr"></i> <?php echo number_format(showPaid_amount($con, $receipt_no), 2, '.', ','); ?>
</td> 

</table> 
</td>
<?php } 
 else {
	
 ?>
<td colspan="1" style="text-align:right !important;"><i class="fa fa-inr"></i> <?php echo number_format(showPaid_amount($con, $receipt_no), 2, '.', ','); ?> </td>
</tr>
          
 <?php } 
	
 ?>

          
       <tr>
       <td colspan="6" style="border-bottom-left-radius: 0px; text-align:right;"><span class="pull-right">Balance Due</span></td><div class="clearfix"></div>
	  <?php 		   
        if($bal > 0 || $bal < 0)
            { echo '<td style="background-color: #EE1217; color: #ffffff; font-weight: bold; text-align: right;">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';}
        else{ echo '<td style="background-color::#478C19; text-align: right;">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';} 
     ?>
          </tr>
       </tbody>   
	</table>

</div>

<!-- <div class="row col-lg-offset-2">
  
  <div class="col-lg-3">
  <a style="color:#FFF; text-decoration:none;" <?php if($pr_status_id =='5'){ ?> href="#"><?php } else{?> href="patient_registration_detail.php?receipt_no=<?php echo $receipt_no;?>"><?php }?>
  <button type="submit" class="btn btn-primary btn-block" style="font-size:17px;" <?php if($pr_status_id =='5'){ echo "disabled";} else{echo "";}?>><i class="fa fa-pencil"></i> EDIT </button>
  </a>
  </div>  
  
  <div class="col-lg-3">
   <a  style="color:#FFF; text-decoration:none;" href="patient_receipt.php?receipt_no=<?php echo $receipt_no; ?>">
      <button type="button" class="btn btn-primary btn-block" style="font-size:17px;"><i class="fa fa-ticket"></i> RECEIPT </button>
   </a>
  </div>
 
  <div class="col-lg-3">
  <a style="color:#FFF; text-decoration:none;" href="fd_search_result.php?receipt_no=<?php echo $receipt_no; ?>">  
    
  <button type="button" class="btn btn-primary btn-block" style="font-size:17px;"> BACK <i class="fa fa-angle-double-right fa-fw"></i></button>
  </a>
  </div>-->
  
</div>   
    <?php 
    }
  ?>            
  


 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>   
  </body>
</html>
<?php } ob_flush();?>