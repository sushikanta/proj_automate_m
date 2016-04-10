<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title> Walkin Report</title>
  <?php require_once("css_bootstrap_header.php");?>
  <?php require_once("print-borderless-ac.php");?>

</head>
<body id="myBody">
<?php
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !='' && isset($_GET['src_id']) && $_GET['src_id'] !=''){
	$_start = mysqli_real_escape_string($con, $_GET['start']);
	$_stop = mysqli_real_escape_string($con, $_GET['stop']);
	$source_id = mysqli_real_escape_string($con, $_GET['src_id']);
	$referred_id = mysqli_real_escape_string($con, $_GET['ref_id']);

	$start = date("Y-m-d", strtotime($_start));
	$stop = date("Y-m-d", strtotime($_stop));
?>
<?php require_once("right_top_header_popup.php"); ?>

<div class="container">
 <div class="page-content">
   <div class="inv-main">

   <div class="panel panel-success">
	<div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Source Person <span class="panel-subTitle">( Collection Report )</span>
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
<span style="text-decoration: underline; font-weight:bold; font-size:11pt;" class="blue_color">Collection Report ( <?php $src_name = showSourceName($con, $source_id); $ref_name = showReferral($con, $source_id, $referred_id); echo $ref_name.' , '.$src_name; ?> )</span> <br/>
<span style="font-size:8pt;">(<?php echo $_start;?> to <?php echo $_stop;?>)</span> <br/>
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

$result1 = mysqli_query($con, "SELECT y.PP_total, y.PP_tax, y.PP_disc, y.PP_net, y.PP_paid, y.PP_bal, y.PP_date, r.pr_dr_prescription, r.pr_receipt_no, r.pr_source_id, r.pr_referred_id, r.pr_date, p.PI_name FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE DATE_FORMAT(r.pr_date, '%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND r.pr_source_id = '$source_id' AND r.pr_referred_id = '$referred_id' ORDER BY r.pr_date ASC");

if (mysqli_num_rows($result1)!= 0){
?>
<table class="table-hover width_100" style="margin-top:20px;">
<thead align="left">
  <tr><th colspan="12" class="text-center blue_color" id="th_bg_color">Registration List</th></tr>

<tr>
  <th style="width:2%;" class="text-center">SL</th>
  <th style="width:8%;">Reg ID</th>
  <th style="width:12%;">Name</th>
  <th>Ref by</th>
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
	   <td>ED/<?php echo $pr_receipt_no; ?></td>
       <td><?php echo $PI_name; ?></td>
       <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?> </td>
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
 </tbody>
 </table>
 </div>
 <?php }?>

 </div>
<span style="font-style:italic; margin-top:10px;" class="pull-left">Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname'];?>)</span>
  </div>
</div>
</div>
</tr></td></table>
<div class="clear"></div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php  } ob_flush();?>