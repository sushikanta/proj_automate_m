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
<title>A/C Statement</title>
  <?php require_once("css_bootstrap_header.php");?> 
  <?php require_once("print-borderless-ac.php");?> 
  
</head>
<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = date("Y-m-d H:i", strtotime($_GET['start']));
	$stop = date("Y-m-d H:i", strtotime($_GET['stop']));
	
	/*------------------- total functions --------------------------------*/
	$total_ed = total_registration_bw($con, $start, $stop);
	$total_test = total_investigation_bw($con, $start, $stop);
	$total_bill = totalBill_registration_bw($con, $start, $stop);
	$total_tax = totalTax_registration_bw($con, $start, $stop);
	$total_discount = totalDiscount_registration_bw($con, $start, $stop);
	$total_net = totalNet_registration_bw($con, $start, $stop); 
	$cur_clear = curClear_bw($con, $start, $stop); 
	$cur_received = total_first_received_bw($con, $start, $stop);
	$old_clear = oldClear_dateTime($con, $start, $stop);
	$total_expenditure = totalExpenditure_amount_bw($con, $start, $stop);
	
	$final_due = $total_net - ($cur_clear + $cur_received);
	$acutual_received = $cur_received + $cur_clear;
	$dues_paid_all = dues_paid_all_bw($con, $start, $stop);
	$old_paid = $dues_paid_all - $cur_clear;
	$deposit = $acutual_received + $old_paid - $total_expenditure;
	
?>
<?php require_once("right_top_header.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Report <span class="panel-subTitle">( Account Statement )</span>
  
   <a class="text-right pull-right navbar-link no-print" href="FD_report_ac_statement_ui.php" style="padding-left:15px;">
   <i class="fa fa-arrow-circle-right"></i></a>
  
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('check', 'AC statement')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>    
    <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<div id="dvData">
<div>
<table id="check"><tr><td>
<label style="width:100%; text-align:center; font-weight:normal;">
<span style="text-decoration: underline; font-weight:bold; font-size:12pt;" class="blue_color">Account Statement</span> <br/> 
<span style="font-size:10pt;">(<?php echo date("d/m/Y h:i a", strtotime($start));?> - <?php echo date("d/m/Y h:i a", strtotime($stop));?>)</span> <br/>
<span style="font-size:9px !important; font-style:italic;">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
</label>   

<table class="table table-striped table-bordered" style="width:100%;">
    <thead>
    <tr>
    <th colspan="11" class="text-center blue_color" id="th_bg_color">Summary of Totals</th>
    </tr>
	<tr>
        <th style="text-align:center;">RegID</th>
        <th style="text-align:center;">Invst</th>		
		<th style="text-align:center;">Bill</th>        
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Net</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;">Received</th>
        <th style="text-align:center;">Old Clearance</th>        
        <th style="text-align:center;">Expd</th>
        <th style="text-align:center;">Deposit</th>
	</tr>
	</thead>
	<tbody>
  		<tr>
        
        <td style="text-align:center;"><?php echo $total_ed;?></td>        
        <td style="text-align:center;"><?php echo $total_test;?></td>		
        <td style="text-align:center;"><?php echo number_format($total_bill, 2, '.', ',');?></td>
        <td style="text-align:center;"><?php echo number_format($total_tax, 2, '.', ','); ?></td>        
        <td style="text-align:center;"><?php echo number_format($total_discount, 2, '.', ',');?></td>
		<td style="text-align:center;"><?php echo number_format($total_net, 2, '.', ',');?></td>        
        <td style="text-align:center; color:#F00;"><?php echo number_format($final_due, 2, '.', ',');?></td>
                
        <td style="text-align:center;">       
          <?php echo number_format($cur_received, '2','.',','); ?> +  <?php echo number_format($cur_clear, '2','.',','); ?> =  
		  <?php echo number_format($acutual_received, '2','.',','); ?>
        </td>       
        <td style="text-align:center;"><?php echo number_format($old_paid, '2','.',','); ?></td>       
        <td style="text-align:center;"><?php echo number_format($total_expenditure,'2','.',',');?></td>
        <td style="text-align:center; color: #00F; font-weight:bold;"><?php echo number_format($deposit,'2','.',',');?></td>
		</tr>     
       </tbody>   
	</table>
    </div>

<?php
$result2 = mysqli_query($con, "SELECT patient_payment.PP_sl, patient_payment.PP_receipt_no, patient_payment.PP_total, patient_payment.PP_tax, patient_payment.PP_tax_value, patient_payment.PP_disc_option, patient_payment.PP_net, patient_payment.PP_paid, patient_payment.PP_paid_date, patient_info.PI_name, patient_registration.pr_dr_prescription, patient_registration.pr_source_id, patient_registration.pr_referred_id FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_payment.PP_patient_id WHERE patient_payment.PP_paid_date BETWEEN '".$start."' AND '".$stop."' ORDER BY patient_payment.PP_paid_date ASC"); 
if (mysqli_num_rows($result2) != 0){
?>
   
<div style=" margin-top:30px;">
<table class="table table-striped table-bordered" style="width:100%; margin-top:30px;" id="testTable">
<thead align="left">

	 <tr>
    <th colspan="13" class="text-center blue_color" id="th_bg_color">Registration List</th>
    </tr>

<tr>
  <th class="text-center">SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Ref by (Source)</th>
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
       <td><?php echo $row['PI_name']; ?></td> 
       <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?> (<?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). ", ".showSourceName($con, $pr_source_id)."</span>)"; ?> </td>
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       <td><?php echo date("d/m/Y h:i a", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>
       
      <td class="text-right"><?php if($PP_tax =='1'){$tax = ($PP_tax_value/100) * $PP_total; echo number_format($tax, 2, '.', ',');} if($PP_tax =='2'){echo '0.00';}  ?></td>
       <td class="text-right"><?php if($PP_disc_option == '1'){echo calcDiscount_EID($con, $PP_receipt_no);}else {echo '0.00';} ?></td>
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); ?></td>
       <td class="text-right"><?php $dueClear_btw = dueClear_btw_pp_sl($con, $PP_sl, $start, $stop); $due_btw = $PP_net - ($PP_paid + $dueClear_btw); echo number_format($due_btw, 2, '.', ','); ?></td>
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
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_bill,'2','.',',');?> </td>     
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_tax,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_discount,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_net,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($final_due,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right blue_color"><?php echo number_format($cur_clear, '2','.',',');?> </td>
   <td style="text-align:right;" class="text-right blue_color"><?php if($cur_received ==""){ echo "0.00";}else{echo number_format($cur_received,'2','.',','); } ?> </td>
  </tr>
 <tbody>
 </table>
 </div>
 <?php }?>
   
   <!----------------------------------Due clear collection --------------------------------------------->

<?php
$result3 = mysqli_query($con, "SELECT patient_due_tbl.PD_bal_paid, patient_due_tbl.PD_date, patient_payment.PP_receipt_no, patient_registration.pr_source_id, patient_registration.pr_referred_id, patient_registration.pr_dr_prescription, patient_registration.pr_date, patient_info.PI_name FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_due_tbl.PD_bal_paid !='0' AND patient_due_tbl.PD_date BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_paid_date NOT BETWEEN '".$start."' AND '".$stop."' ORDER BY patient_due_tbl.PD_date ASC");

if(mysqli_num_rows($result3) !=0){
?>
<div style="margin-top:30px;">
<table class="table table-striped table-bordered" style="width:100%; margin-top:30px;"  id="testTable1">
<thead align="left">
	 <tr>
    <th colspan="8" class="text-center blue_color" id="th_bg_color">Balance Due Clearance</th>
    </tr>
<tr>
  <th class="text-center"> SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Ref by (Source)</th>
  <th>Investigation</th>
  <th>Date</th>
  <th style="width:13%;">Clear on</th>
  <th class="text-right" style="width:13%;">Clear Amount</th>
</tr>
</thead>
<tbody>
<?php
$sl_no=1;
while ($row3 = mysqli_fetch_array($result3))
{
	$PD_bal_paid = $row3['PD_bal_paid'];	
	$PD_date = date("d/m/Y, h:i a", strtotime($row3['PD_date']));
	$pr_date = date("d/m/Y, h:i a", strtotime($row3['pr_date']));
	$PP_receipt_no = $row3['PP_receipt_no'];
	$pr_source_id = $row3['pr_source_id'];
	$dr_prescription = $row3['pr_dr_prescription'];
	$pr_source_id = $row3['pr_source_id'];
	$PI_name = $row3['PI_name'];	
  ?>
 	<tr>
	   <td class="text-center"><?php echo $sl_no; ?></td>
	   <td>ED/<?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $PI_name; ?></td>       
       <td><?php if($dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_prescription);} ?> (<?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). ", ".showSourceName($con, $pr_source_id)."</span>)"; ?> </td>        
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td> 
       <td><?php echo $pr_date; ?></td>
       <td><?php echo $PD_date; ?></td>
       <td class="text-right"><?php echo number_format($PD_bal_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="7" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total Rs :</span>
    </td>
     
    <td style="text-align:right; color:#00F;" class="text-right"> <?php echo number_format($old_paid,'2','.',','); ?> </td>
  </tr>
 </tbody>
 </table>
   </div>
  
<?php 
}
?> 
  
   
 <!------------------------------- Expenditure Table ------------------------------------------->
   
<?php
$result1 = mysqli_query($con, "SELECT * FROM expenditure WHERE EX_date BETWEEN '".$start."' AND '".$stop."' ORDER BY EX_date ASC");

if(mysqli_num_rows($result1) !=0)
 {
?>


<div style="margin-top:30px;">   
<table class="table table-striped table-bordered font-table" style="width:100%; margin-top:8px;">
<thead align="left">

  <tr>
    <th colspan="6" class="text-center blue_color" id="th_bg_color">Expenditure</th>
    </tr>
    
<tr>
  <th class="text-center"> Sl.no.</th>
  <th >Voucher no. </th>
  <th>Particulars</th>
  <th >Receiver</th>
  <th class="text-center">Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php

$sl_no=1;
while ($row1 = mysqli_fetch_array($result1))
{
	$EX_id = $row1['EX_id'];
	$EX_voucher = $row1['EX_voucher'];
	$EX_particular = $row1['EX_particular'];
	$EX_person = $row1['EX_person'];
	$EX_date = $row1['EX_date'];
	$EX_amount = $row1['EX_amount'];
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row1['EX_voucher']; ?></td> 
       <td><?php echo $row1['EX_particular']; ?></td> 
       <td><?php echo $row1['EX_person']; ?></td>
       <td class="text-center"><?php echo date("d/m/Y, h:i a", strtotime($EX_date)); ?></td>  
	   <td class="text-right"><?php echo number_format($row1['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right"> 
	<?php if ($total_expenditure == ""){echo '0.00';} else{echo number_format($total_expenditure, '2','.',',');}?>
    </td>
  </tr>

</tbody>
</table>
   </div>
<?php 
}
?> 
<span style="font-style:italic;" class="pull-left">Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname'];?>)</span>
  </div>
</div>
</div>
</tr></td></table>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?> 
<script src="js/dataTables.tableTools.js"></script>   
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php  } } ob_flush();?>