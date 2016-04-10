<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Info</title>
<?php require_once("css_bootstrap_header.php");?>
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">

<?php

if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $patient_info = mysqli_query($con, "SELECT r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_status_id, r.pr_dr_prescription, p.PI_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_phone, s.state_name, d.district_name, g.gender_name, m.marital_name, y.PP_sl, y.PP_total, y.PP_tax, y.PP_disc, y.PP_net, y.PP_paid, y.PP_bal FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN  patient_payment y ON y.PP_receipt_no=r.pr_receipt_no WHERE r.pr_receipt_no = '$receipt_no'");
 
  while($row = mysqli_fetch_array($patient_info))
  {	  
  	$patient_name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];
  	  
	  $patient_id = $row['PI_id'];
	  
	  $address = $row['PI_address'];
	  $pin_code = $row['PI_pin'];
  	$phone = $row['PI_phone'];
	  
	  $gender_name = $row['gender_name'];
	  $marital_name = $row['marital_name'];
  	$state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  
  	$pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	$pr_date = $row['pr_date'];
	  $pr_status_id = $row['pr_status_id'];
	  
	  $dr_letter = $row['pr_dr_prescription'];
	  
	  $PP_sl = $row['PP_sl'];
    $total = $row['PP_total'];	
	  $tax_option =  $row['PP_tax'];
	  $disc_option =  $row['PP_disc'];
	  $bal =  $row['PP_bal'];	
	  $paid =  $row['PP_paid'];	
	  $net = $row['PP_net'];
	  
	  $disc_value=showDiscount_value($con, $receipt_no);
	  $tax_value=showTax_value($con, $receipt_no);
	  
	  }
 ?>
<div class="panel panel-success" id="printableArea" style="height">     
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Registration <span class="panel_subTitle no-print">( Add / Edit / Cancel )</span>
     </div>							  

<div class="panel-body" id="printableArea">

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
      <td><label>Registration # : </label> ED/<?php echo $receipt_no;?></td>  
      <td><label>Customer ID : </label> <?php echo $patient_id;?></td>
      <td><label><i class="fa fa-calendar"></i> : </label> <?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></td>
    </tr>

  <tr>
  <td colspan="2"><label>Name : </label> <?php echo $patient_name;?></td>
  <td><label><i class="fa fa-male"></i><i class="fa fa-female"></i> : </label> <?php echo $gender_name.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ( '. $marital_name.' )';?></td>
  </tr>
  
  
  <tr>
  <td><label>Address : </label> 
  <?php if($pin_code !=""){$_pin = ' - '.$pin_code;}else{$_pin = "";} echo $address.', '.$district_name.', '.$state_name.$_pin; ?>
  </td>
   <td><label> <i class="fa fa-phone-square"></i> :</label> <?php if($phone !=""){ echo '+91 '.$phone;}?></td>
  </tr>
 
 <tr>
  <td><label>Dr. Letter : </label> <?php if($dr_letter =='NO'){echo "No";}else{echo "Yes";} ?></td>
  <td><label>Patient History : </label> <?php echo showHistory_patient($con, $patient_id); ?></td>
  <td><label>Lab Notes : </label> <?php echo showLab_note($con, $receipt_no); ?></td>
  </tr>

 <tr> 
  <td><label>Referred By : </label> <?php if($dr_letter =='NO'){echo " Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_letter);} ?></td>
 
  <td><label>Source : </label> 
  <?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?></td>
   <td><label>Status : </label> 
   <span class="bold_font blue_color"> <?php echo showStatus($con, $pr_status_id); ?></span>
   <input type="hidden" id="span_status" value="<?php echo $pr_status_id; ?>">
   </td>
  </tr>
  </table>
  </div>

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-striped table-hover width_100">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Investigation</th>
      <th> Status</th>             
      <th class="text-right"> Amount</th>             
      </tr>
   </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT patient_test.PT_sl, patient_test.PT_test_name, patient_test.PT_test_price, status_tbl.status_name FROM patient_test LEFT JOIN status_tbl ON status_tbl.status_id = patient_test.PT_status_id WHERE patient_test.PT_receipt_no = '".$receipt_no."'");
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{   
 	$PT_id = $charge['PT_sl'];
	$test_name = $charge['PT_test_name'];
	$test_price = $charge['PT_test_price'];	
	?>
          <tr id="<?php echo $PT_id; ?>">
            <td> <?php echo $sl_no; ?> </td>
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
  
  <div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100">
    <thead align="left">
    <tr>
    <th>Payment</th>
    <th>Date</th>
    <th>Login name (Full name)</th> 
    <th style="text-align:right;">Amount</th>             
    </tr>
    </thead>    
  <tbody>

<!-- PAYMENT - received -->
<?php
$result2 = mysqli_query($con, "SELECT TR_amount, TR_date, TR_user FROM patient_transaction WHERE TR_pp_sl IN (select PP_sl FROM patient_payment WHERE PP_receipt_no = '$receipt_no')");
$sl_no1=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$TR_amount = $row2['TR_amount'];
	$TR_date = date("d-m-Y, h:i a", strtotime($row2['TR_date']));
	$TR_user = $row2['TR_user'];
	$user = showFull_login($con, $TR_user);	
	?>
          <tr>
            <td><?php echo $sl_no1; ?> </td>
            <td><?php echo $TR_date; ?> </td>  
            <td>Received By : <?php echo $user; ?> </td>          
            <td style="text-align:right;"> <i class="fa fa-inr"></i> <?php echo $TR_amount; ?> </td>
          </tr>
       <?php
 $sl_no1++;
}
?>


<!--------- PAYMENT - REFUND -------------->
<?php
$result3 = mysqli_query($con, "SELECT EX_person, EX_amount, EX_date, EX_user FROM expenditure WHERE EX_person = '$receipt_no'");
$sl_no2=$sl_no1;
if(mysqli_num_rows($result3) !=0){
while ($row3 = mysqli_fetch_array($result3))
{   
 	$EX_person = $row3['EX_person'];
	$EX_amount = $row3['EX_amount'];
	$EX_date = date("d-m-Y, h:i a", strtotime($row3['EX_date']));
	$EX_user = $row3['EX_user'];
	$_EX_user = showFull_login($con, $EX_user);	
	?>
          <tr>
            <td><?php echo $sl_no2; ?></td>
            <td><?php echo $EX_date; ?></td>  
            <td>Refunded By : <?php echo $_EX_user; ?></td>          
            <td style="text-align:right;"><i class="fa fa-inr"></i> <?php echo $EX_amount; ?></td>
          </tr>
       <?php
 $sl_no2++;
}
}
?>
	<!--------- PAYMENT SUMMARY -------------->
    <tr>
        <td colspan="4" class="italic_font padding_top10">
        <span class="padding_right2p">Sub-Total :  <i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ','); ?></span>
        <span class="padding_right2p">Tax <?php echo '('.$tax_value.'%)'; ?> : <i class="fa fa-inr"></i> 
		<?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc;  
			   echo number_format($tax_calc, 2, '.', ','); ?>
        </span>
        <span class="padding_right2p">Discount <?php if($disc_option ==1){ echo '('.$disc_value.'%)';} ?> : <i class="fa fa-inr"></i>
        <?php if($disc_option ==1)  // discount = Yes	
				   	$disc_in_amt = showDiscount_in_amt($con, $receipt_no, $total_after_tax);						
			  if($disc_option==2) // discount = NO
				    $disc_in_amt = "0.00";
				  		   
			    echo number_format($disc_in_amt, 2, '.', ','); ?>
         </span>
        <span class="padding_right2p">Total : <i class="fa fa-inr"></i> <?php echo number_format($net, 2, '.', ','); ?></span>
        <span class="padding_right2p">Paid: <i class="fa fa-inr"></i> <?php echo number_format($paid, 2, '.', ','); ?></span>
        <span>Due : <i class="fa fa-inr"></i> <?php echo number_format($bal, 2, '.', ','); ?></span>
        </td>
      </tr>
	</tbody>   
 </table>  
  </div>
  
  <div class="text-center padding_top20" id="div_action">
   
   <form class="form-horizontal inv-form" role="form" method="get" action="reason_ui_EID1.php" id="myform">
   <div class="form-group">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="btn1" name="submit1"><i class="fa fa-edit"></i> &nbsp;&nbsp; Patient Info + SWAP</button>
       </div>    
  </div>   
   <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>">
   <input type="hidden"  name="patient_id" value="<?php echo $patient_id; ?>">
   </form>
   
   <form class="form-horizontal inv-form" role="form" method="get" action="reason_ui_EID2.php">
   <div class="form-group">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="btn2" name="submit2"><i class="fa fa-edit"></i> &nbsp;&nbsp; Investigation (Add | Remove) + Source + Payment</button>
       </div>    
  </div>   
   <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>">
   </form>

   <form class="form-horizontal inv-form" role="form" method="get" action="reason_ui_EID3.php">
   <div class="form-group">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block" id="btn3" name="submit3"><i class="fa fa-times"></i> &nbsp;&nbsp; CANCEL Registration</button>
       </div>    
  </div>   
   <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>">
  <input type="hidden" name="pp_sl" value="<?php echo $pp_sl; ?>">  
   </form>
 </div> 
  
 </div> 
<div class="clear"></div> 
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
var span_status = $('#span_status').val();
if(span_status =='4'){$('#btn1, #btn2, #btn3').attr('disabled', true);}
// if(span_status =='4'){$('#div_action').hide();}
});
</script>
  </body>
</html>
<?php } ob_flush();?>