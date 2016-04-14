<?php require_once("function.php");
session_start();
ob_start();

if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')
 {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Payment Index - Each</title>
  <?php require_once("css_bootstrap_header.php");?> 
  <?php require_once("print-borderless-ac.php");?> 
  
</head>
<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !='' && isset($_GET['ref']) && $_GET['ref'] !=''){
	$start = date("Y-m-d", strtotime($_GET['start']));
	$stop = date("Y-m-d", strtotime($_GET['stop']));
	$ref = $_GET['ref'];
	
	$EDs = registration_ref($con, $ref, $start, $stop);
	$test_nos = investigation_ref($con, $ref, $start, $stop);
	$bill = bill_ref($con, $ref, $start, $stop);
	$tax = tax_ref($con, $ref, $start, $stop);
	$discount = discount_ref($con, $ref, $start, $stop);
	$net = net_ref($con, $ref, $start, $stop);
	$cur_clear = cur_clear_ref($con, $ref, $start, $stop);
	$cur_received = paid_first_ref($con, $ref, $start, $stop);
	$final_due = $net - ($cur_clear + $cur_received);
	
?>

<?php require_once("right_top_header.php"); 
$result2 = mysqli_query($con, "SELECT patient_payment.PP_sl, patient_payment.PP_receipt_no, patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_disc_option, patient_payment.PP_net, patient_payment.PP_paid, patient_payment.PP_paid_date, patient_info.PI_name, patient_registration.pr_dr_prescription, patient_registration.pr_source_id, patient_registration.pr_referred_id FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_payment.PP_patient_id WHERE DATE_FORMAT(patient_payment.PP_paid_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND patient_registration.pr_referred_id = '$ref' ORDER BY patient_payment.PP_paid_date ASC");
?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Payment Sheet <span class="panel-subTitle"> ( <?php echo showRef_from_ref($con, $ref);?>, <?php echo showSourceName_from_ref($con, $ref);?> )</span>
    
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('check', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>    
    <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<div id="dvData">
<div>

<table id="check"><tr><td>
   
<table class="table table-striped table-bordered" style="width:100%;" id="payment_detail_tbl">
  <thead>
   <tr>
    <th colspan="8" class="text-center blue_color" id="th_bg_color">Total (<?php echo showRef_from_ref($con, $ref);?>, <?php echo showSourceName_from_ref($con, $ref);?> Date: <?php echo date("d/m/Y", strtotime($start));?> - <?php echo date("d/m/Y", strtotime($stop));?>)</th>
    </tr>
	<tr>
        <th style="text-align:center;">REGs</th>
        <th style="text-align:center;">Invst</th>
		<th style="text-align:center;">Bill</th>      
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Net</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;">Received</th>
	</tr>
	</thead>
	<tbody>
  		<tr>
        <td style="text-align:center;"><?php echo $EDs; ?></td>
        <td style="text-align:center;"><?php echo $test_nos; ?></td>
        <td style="text-align:center;"><?php echo number_format($bill, 2, '.', ',');?></td>
        <td style="text-align:center;"><?php echo number_format($tax, 2, '.', ','); ?></td>        
        <td style="text-align:center;"><?php echo number_format($discount, 2, '.', ',');?></td>
		<td style="text-align:center;"><?php echo number_format($net, 2, '.', ',');?></td>   
        <td style="text-align:center; color:#F00;"><?php echo number_format($final_due, 2, '.', ',');?></td>
        <td style="text-align:center;">
		  <?php echo number_format($cur_received, '2','.',','); ?> +  <?php echo number_format($cur_clear, '2','.',','); ?> = 
          <?php echo number_format($cur_received + $cur_clear, '2','.',','); ?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>
   
   
<?php 
if (mysqli_num_rows($result2) != 0){
?>
<div style=" margin-top:30px;">
<table class="table table-striped table-bordered" style="width:100%; margin-top:30px;">
<thead align="left">

	 <tr>
    <th colspan="13" class="text-center blue_color" id="th_bg_color">Registration List</th>
    </tr>

<tr>
  <th class="text-center">SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th class="text-left" style="width:9%;">Date</th>
  <th class="text-right">Bill</th>  
  <th class="text-right">Tax</th>
  <th class="text-right">Disc</th>
  <th class="text-right">Net</th>
  <th class="text-right">Due</th>
  <th class="text-right">Clear</th>
  <th class="text-right">Cur.Recvd</th>
</tr>
</thead>
<tbody>
<?php

$sl_no=1;
while ($row = mysqli_fetch_array($result2))
{
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$pr_dr_prescription = $row['pr_dr_prescription'];
	
	$PI_name = $row['PI_name'];	
	
	$PP_sl = $row['PP_sl'];
	$PP_receipt_no = $row['PP_receipt_no'];
	$PP_total = $row['PP_total'];
	$PP_tax = $row['PP_tax'];
	$PP_tax_value = $row['PP_tax_value'];	
	$PP_disc_option = $row['PP_disc_option'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_paid_date = $row['PP_paid_date'];
	
  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td>ED/<?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $PI_name; ?></td> 
       <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?></td>
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       <td><?php echo date("d/m/Y h:i a", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>      
      <td class="text-right"><?php if($PP_tax =='1'){$tax = ($PP_tax_value/100) * $PP_total; echo number_format($tax, 2, '.', ',');} if($PP_tax =='2'){echo '0.00';}  ?></td>
       <td class="text-right"><?php if($PP_disc_option == '1'){echo calcDiscount_EID($con, $PP_receipt_no);}else {echo '0.00';} ?></td>
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); ?></td>
       <td class="text-right"><?php $dueClear_btw = dueClear_btw_pp_sl_ref($con, $PP_sl, $start, $stop); $due_btw = $PP_net - ($PP_paid + $dueClear_btw); echo number_format($due_btw, 2, '.', ','); ?></td>
       <td class="text-right"><?php  if($dueClear_btw ==''){ echo '0.00';}else{echo number_format($dueClear_btw, 2, '.', ',');} ?></td>
       
	   <td class="text-right"><?php echo number_format($PP_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right;" class="text-right"><?php echo number_format($bill,'2','.',',');?> </td>     
    <td style="text-align:right;" class="text-right"><?php echo number_format($tax,'2','.',',');?> </td>
    <td style="text-align:right;" class="text-right"><?php echo number_format($discount,'2','.',',');?> </td>
    <td style="text-align:right;" class="text-right"><?php echo number_format($net,'2','.',',');?> </td>
    <td style="text-align:right;" class="text-right"><?php echo number_format($final_due,'2','.',',');?> </td>
    <td style="text-align:right;" class="text-right blue_color"><?php echo number_format($cur_clear, '2','.',',');?> </td>
    <td style="text-align:right;" class="text-right blue_color"><?php if($cur_received ==""){ echo "0.00";}else{echo number_format($cur_received,'2','.',','); } ?> </td>
  </tr>
 </tbody>
 </table>
   </div>
  <?php }?> 
	<span style="font-style:italic;" class="pull-left">Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname'];?>)</span>
  </div>
</div>
</div>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?> 
<script src="js/dataTables.tableTools.js"></script>
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php  } } ob_flush();?>