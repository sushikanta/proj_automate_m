<?php require_once("check_login_fd.php"); ?>
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
	$_start = mysqli_real_escape_string($con, $_GET['start']);
	$_stop = mysqli_real_escape_string($con, $_GET['stop']);

	$start = date("Y-m-d H:i", strtotime($_start));
	$stop = date("Y-m-d H:i", strtotime($_stop));
?>
<?php require_once("right_top_header_popup.php"); ?>

<div class="container">
 <div class="page-content">
   <div class="inv-main">

   <div class="panel panel-success">
	<div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Account Statement <span class="panel-subTitle">( Report )</span>
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('check', 'AC statement')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
     </h3>
    </div>

<div class="panel-body" id="printableArea">

<div id="dvData">
<div>
<table style="width:100%;" id="check"><tr><td>
<div>
<label style="width:100%; text-align:center; font-weight:normal;">
<span style="text-decoration: underline; font-weight:bold; font-size:11pt;" class="blue_color">Account Statement</span> <br/>
<span style="font-size:8pt;">(<?php echo date("d/m/Y h:i a", strtotime($start));?> - <?php echo date("d/m/Y h:i a", strtotime($stop));?>)</span> <br/>
<span style="font-size:7pt !important; font-style:italic;">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
</label>
<?php
$sl_no_x=1;
$total_bill=0;
$total_tax=0;
$total_disc=0;
$total_net=0;
$total_paid=0;
$total_bal=0;
$total_clear =0;
$total_expense =0;

$result1 = mysqli_query($con, "SELECT y.PP_total, y.PP_tax, y.PP_disc, y.PP_net, y.PP_paid, y.PP_bal, y.PP_date, r.pr_dr_prescription, r.pr_receipt_no, r.pr_source_id, r.pr_referred_id, r.pr_date, p.PI_name FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE r.pr_date BETWEEN '".$start."' AND '".$stop."'");

if (mysqli_num_rows($result1)!= 0){
?>
<table class="table-striped" style="width:100%; margin-top:20px;" id="testTable">
<thead align="left">
  <tr><th colspan="12" class="text-center blue_color" id="th_bg_color">Registration List</th></tr>

<tr>
  <th style="width:2%;" class="text-center">#</th>
  <th style="width:8%;">Reg ID</th>
  <th style="width:12%;">Name</th>
  <th>Ref by (Source)</th>
  <th>Investigation</th>
  <th style="width:8%;" class="text-left">Date</th>
  <th style="width:6%;" class="text-right">Bill</th>
  <th style="width:6%;" class="text-right">Tax</th>
  <th style="width:6%;" class="text-right">Disc</th>
  <th style="width:6%;" class="text-right">Net</th>
  <th style="width:6%;" class="text-right">Paid</th>
  <th style="width:6%;" class="text-right">Due</th>
</tr>
</thead>
<tbody>
<?php
while ($row = mysqli_fetch_array($result1))
{
	$pr_receipt_no = $row['pr_receipt_no'];
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$pr_dr_prescription = $row['pr_dr_prescription'];
	$pr_date = $row['pr_date'];

	$PI_name = $row['PI_name'];

	$PP_total = $row['PP_total'];
	$PP_tax = $row['PP_tax'];
	$PP_disc = $row['PP_disc'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_bal = $row['PP_bal'];
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no_x; ?> </td>
	   <td><?php echo $pr_receipt_no; ?></td>
       <td><?php echo $PI_name; ?></td>
       <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?> (<?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). ", ".showSourceName($con, $pr_source_id)."</span>)"; ?> </td>
       <td><?php all_test_eid($con, $pr_receipt_no); ?></td>
       <td><?php echo date("d/m/Y h:i a", strtotime($pr_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); $total_bill = $total_bill + $PP_total; ?></td>

      <td class="text-right">
	  <?php if($PP_tax =='1'){
				$tax_value=showTax_value($con, $pr_receipt_no);
	  			$tax_calc = ($PP_total * $tax_value)/100;
				$total_after_tax = $PP_total + $tax_calc;
				echo number_format($tax_calc, 2, '.', ',');
	  		  }
			if($PP_tax =='2'){
			  $total_after_tax = $PP_total;
			  $tax_calc = '0.00';
			  echo $tax_calc;
			  }
			$total_tax = $total_tax + $tax_calc;
		?>
       </td>
       <td class="text-right">
	   <?php
	   	 // discount = Yes
	   	if($PP_disc ==1) { $disc_in_amt = showDiscount_in_amt($con, $pr_receipt_no, $total_after_tax);}

		// discount = NO
		if($PP_disc==2) { $disc_in_amt = "0.00";}
		 echo number_format($disc_in_amt, 2, '.', ',');
		 $total_disc = $total_disc + $disc_in_amt;
	   ?>
       </td>
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); $total_net = $total_net + $PP_net; ?></td>
       <td class="text-right"><?php echo number_format($PP_paid, 2, '.', ','); $total_paid = $total_paid + $PP_paid; ?></td>
	   <td class="text-right"><?php echo number_format($PP_bal, 2, '.', ','); $total_bal = $total_bal + $PP_bal;?></td>
     </tr>
<?php
$sl_no_x++;
}
?>
<tr>
    <td colspan="6" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_bill,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_tax,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_disc,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_net,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_paid,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($total_bal,'2','.',',');?> </td>
  </tr>
 <tbody>
 </table>
 </div>
 <?php }?>

<!-- due clear -->
<?php
$result2 = mysqli_query($con, "SELECT t.TR_amount, t.TR_date, y.PP_receipt_no, r.pr_source_id, r.pr_referred_id, r.pr_dr_prescription, r.pr_date, p.PI_name FROM patient_transaction t LEFT JOIN patient_payment y ON t.TR_pp_sl = y.PP_sl LEFT JOIN patient_registration r ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE t.TR_date BETWEEN '".$start."' AND '".$stop."' AND y.PP_date NOT BETWEEN '".$start."' AND '".$stop."'");

if(mysqli_num_rows($result2) !=0){
?>
<div>
<table class="table-striped" style="width:100%; margin-top:20px;">
<thead align="left">
	 <tr>
    <th colspan="8" class="text-center blue_color" id="th_bg_color">Dues Clearance</th>
    </tr>
<tr>
  <th style="width:2%;" class="text-center">#</th>
  <th style="width:8%;">Reg ID</th>
  <th style="width:12%;">Name</th>
  <th>Ref by (Source)</th>
  <th>Investigation</th>
  <th style="width:7%;">Date</th>
  <th style="width:7%;">Clear on</th>
  <th class="text-right" style="width:6%;">Amount</th>
</tr>
</thead>
<tbody>
<?php
$sl_no=1;
while ($row2 = mysqli_fetch_array($result2))
{
	$TR_amount = $row2['TR_amount'];
	$TR_date = date("d/m/Y, h:i a", strtotime($row2['TR_date']));

	$pr_date1 = date("d/m/Y, h:i a", strtotime($row2['pr_date']));
	$receipt_no = $row2['PP_receipt_no'];
	$source_id = $row2['pr_source_id'];
	$referred_id = $row2['pr_referred_id'];
	$prescription = $row2['pr_dr_prescription'];
	$patient_name = $row2['PI_name'];
  ?>
 	<tr>
	   <td class="text-center"><?php echo $sl_no; ?></td>
	   <td><?php echo $receipt_no; ?></td>
       <td><?php echo $patient_name; ?></td>
       <td>
	   <?php if($prescription =='NO')
	   			{ echo "Self";}
		    else{ echo 'Dr. '.showDoctor_name($con, $prescription);} ?>
           (<?php echo "<span style='font-style: italic;'>" .showReferral($con, $source_id, $referred_id). ", ".showSourceName($con, $source_id)."</span>)";
		?>
       </td>
       <td><?php all_test_eid($con, $receipt_no); ?></td>
       <td><?php echo $pr_date1; ?></td>
       <td><?php echo $TR_date; ?></td>
       <td class="text-right"><?php echo number_format($TR_amount, 2, '.', ','); $total_clear = $total_clear + $TR_amount; ?></td>
     </tr>

<?php
$sl_no++;
}
?>
<tr>
    <td colspan="7" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total Rs :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right"> <?php echo number_format($total_clear,'2','.',','); ?> </td>
  </tr>
 </tbody>
 </table>
   </div>

<?php
}
?>
 <!-- Expenditure Table -->

<?php
$result1 = mysqli_query($con, "SELECT e.EX_id, e.EX_voucher, e.EX_particular, e.EX_person, e.EX_amount, e.EX_date, e.EX_user, u.user_name FROM expenditure e LEFT JOIN user_table u ON u.user_id = e.EX_user WHERE e.EX_date BETWEEN '".$start."' AND '".$stop."' ORDER BY e.EX_date ASC");

if(mysqli_num_rows($result1) !=0)
 {
?>


<div style="margin-top:20px;">
<table class="table-striped font-table" style="width:100%; margin-top:8px;">
<thead align="left">

  <tr>
    <th colspan="7" class="text-center blue_color" id="th_bg_color">Expenditure</th>
    </tr>

<tr>
  <th class="text-center"> Sl.no.</th>
  <th >Voucher no. </th>
  <th>Particulars</th>
  <th >Receiver</th>
  <th>Date</th>
  <th>Added By</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php

$sl_no_ex=1;

while ($row1 = mysqli_fetch_array($result1))
{
	$EX_id = $row1['EX_id'];
	$EX_voucher = $row1['EX_voucher'];
	$EX_particular = $row1['EX_particular'];
	$EX_person = $row1['EX_person'];
	$EX_date = $row1['EX_date'];
	$EX_amount = $row1['EX_amount'];
	$username = $row1['user_name'];
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no_ex; ?> </td>
	   <td><?php echo $EX_voucher; ?></td>
       <td><?php echo $EX_particular; ?></td>
       <td><?php echo $EX_person; ?></td>
       <td><?php echo date("d/m/Y, h:i a", strtotime($EX_date)); ?></td>
       <td><?php echo $username; ?></td>
	   <td class="text-right"><?php echo number_format($EX_amount, 2, '.', ','); $total_expense = $total_expense + $EX_amount; ?></td>
     </tr>

<?php
$sl_no_ex++;
}
?>
<tr>
    <td colspan="6" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right">
	<?php echo number_format($total_expense, '2','.',','); ?>
    </td>
  </tr>

</tbody>
</table>
   </div>
<?php
}
?>

<table class="table-striped" style="width:100%; margin-top:20px;">
    <thead>
    <tr>
    <th colspan="11" class="text-center blue_color" id="th_bg_color">Summary of Totals</th>
    </tr>
	     <tr>
        <th style="text-align:center;">RegID</th>
		    <th style="text-align:center;">Bill</th>
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Net</th>
        <th style="text-align:center;">Paid</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;"  title="Receive = Paid + Due Clear">Receive</th>
        <th style="text-align:center;">Expd</th>
        <th style="text-align:center;">Deposit</th>
	   </tr>
	</thead>
	<tbody>
  		<tr>

        <td style="text-align:center;"><?php echo $sl_no_x-1;?></td>
        <td style="text-align:center;"><?php echo number_format($total_bill, 2, '.', ',');?></td>
        <td style="text-align:center;"><?php echo number_format($total_tax, 2, '.', ','); ?></td>
        <td style="text-align:center;"><?php echo number_format($total_disc, 2, '.', ',');?></td>
		<td style="text-align:center;"><?php echo number_format($total_net, 2, '.', ',');?></td>
        <td style="text-align:center;"><?php echo number_format($total_paid, 2, '.', ',');?></td>
        <td style="text-align:center; color:#F00;"><?php echo number_format($total_bal, 2, '.', ',');?></td>
         <td style="text-align:center;" title="Receive = Paid + Due Clear">
		<?php $receive = $total_paid + $total_clear; echo number_format($receive, '2','.',','); ?></td>
        <td style="text-align:center;"><?php echo number_format($total_expense,'2','.',',');?></td>
        <td style="text-align:center;"><?php $deposit = $receive-$total_expense; echo number_format($deposit,'2','.',',');?></td>

		</tr>
       </tbody>
	</table>
    </div>
<span style="font-style:italic; margin-top:10px;" class="pull-left">Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname'];?>)</span>
  </div>
</div>
</div>
</tr></td></table>
<div class="clear"></div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php  } ob_flush();?>
