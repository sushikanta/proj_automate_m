﻿<?php require_once("function.php");
session_start();
ob_start();

if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Daily A/C Statement</title>
  <?php include("css_bootstrap_header.php");?> 
</head>
<body id="myBody">
<?php 
if(isset($_GET['today_date']) && $_GET['today_date'] !=''){
	$today_date = $_GET['today_date'];
?>
<?php include("right_top_header_admin.php"); ob_start();
?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success no-print">  
	<div class="panel-heading no-print">
    <h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Report - One day Account Statement
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?><a class="text-right pull-right navbar-link no-print" href="report_daily_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<div>
<label style="width:100%; text-decoration: underline; text-align:center; font-size:16pt; font-weight:normal; color:#00F;"> Daily Account Statement</label>   
<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <tr>
    <th colspan="11" class="text-center" style=" text-decoration:underline; color:#C9002F; font-size:11pt; font-weight:normal;">Summary of Totals on <?php echo date("jS F Y (l)", strtotime($today_date));?> </th>
    </tr>
	<tr>
        <th style="text-align:center; font-style: italic; text-decoration:underline;"><?php echo date("d/m/Y", strtotime($today_date));?></th>
		<th style="text-align:center;">#RegID</th>
        <th style="text-align:center;">#Invst</th>		
		<th style="text-align:center;">Bill</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Received Amt</th>
        <th style="text-align:center;">#Expd</th>
        <th style="text-align:center;">Exp-Amount</th>
		</tr>
	</thead>
	<tbody>
  		<tr>
        <td style="color:#00F;text-align:center; font-weight:bold;">Total <i class="fa fa-chevron-circle-right fa-fw"></i></td>
		<td style="text-align:center;"><?php echo total_registration($con, $today_date);?></td>
        <td style="text-align:center;"><?php echo total_investigation($con, $today_date);?></td>		
		<td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalBill_registration = totalBill_registration($con, $today_date); echo $totalBill_registration;?>
        </td>
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalDue_registration = totalDue_registration($con, $today_date); echo $totalDue_registration;?>
        </td>
        </td>
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalTax_registration = totalTax_registration($con, $today_date); echo $totalTax_registration; ?>
        </td>
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		<?php $totalDiscount_registration = totalDiscount_registration($con, $today_date); echo $totalDiscount_registration;?></td>
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalReceived_registration = totalReceived_registration($con, $today_date); echo $totalReceived_registration; ?>
        </td>
        <td style="text-align:center;"><?php $total_expenditure = total_expenditure($con, $today_date); echo $total_expenditure;?></td>
        <td style="text-align:center;"><i class="fa fa-inr"></i>
		  <?php $totalExpenditure_amount = totalExpenditure_amount($con, $today_date); echo $totalExpenditure_amount;?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>
   
<div>
<label style="margin-top: 5px; width:100%; text-decoration: underline; text-align:center; font-size:11pt; font-weight:normal; color:#00F;"><h5> Registration - Front Desk Collection</h5></label>   
<table class="table table-striped table-bordered" style="width:100%; margin-top:8px;" id="example">
<thead align="left">
<tr>
  <th class="text-center"> #</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th class="text-center">Date</th>
  <th class="text-right">Bill</th>
  <th class="text-right">Due</th>
  <th class="text-right">Tax</th>
  <th class="text-right">Disc</th>
  <th class="text-right">Amount</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_payment`.*, `patient_info`.`PI_name`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`  FROM `patient_payment` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_payment`.`PP_patient_id` WHERE DATE_FORMAT(`PP_paid_date`,'%Y-%m-%d')  = '".$today_date."' ORDER BY `PP_sl` ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$PP_sl = $row['PP_sl'];
	$PP_receipt_no = $row['PP_receipt_no'];
	$PP_patient_id = $row['PP_patient_id'];
	$PP_total = $row['PP_total'];
	$PP_tax = $row['PP_tax'];
	$PP_tax_value = $row['PP_tax_value'];
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$PP_disc_option = $row['PP_disc_option'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_paid_date = $row['PP_paid_date'];
	$PP_bal = $row['PP_bal'];
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $row['PI_name']; ?></td> 
       <td><?php $referral = showReferral($con, $pr_source_id, $pr_referred_id); if($pr_source_id =='1') { echo "Dr. ".$referral; } else { echo $referral. " (".showSourceName($con, $pr_source_id).")";} ?></td> 
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       <td class="text-center"><?php echo date("d/m/Y", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>
       <td class="text-right"><?php echo number_format($PP_bal, 2, '.', ','); ?></td>
      <td class="text-right"><?php if($PP_tax =='1'){$tax = ($PP_tax_value/100) * $PP_total; echo number_format($tax, 2, '.', ',');} if($PP_tax =='2'){echo '0.00';}  ?></td>
       <td class="text-right"><?php if($PP_disc_option == '1'){echo calcDiscount_EID($con, $PP_receipt_no);}else {echo '0.00';} ?></td>
	   <td class="text-right"><?php echo number_format($PP_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" class="price-amount" style="text-align:right;">
    <!--<span style="font-style:italic;" class="pull-left">Checked by : <?php echo $_SESSION['name'];?></span>-->
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F; font-weight:bold; class="text-right"><?php echo $totalBill_registration;?> </td>    
    <td style="text-align:right; color:#F00; font-weight:bold; class="text-right"><?php echo $totalDue_registration;?> </td>
    <td style="text-align:right; color:#000; font-weight:bold; class="text-right"><?php echo $totalTax_registration;?> </td>
    <td style="text-align:right; color:#000; font-weight:bold; class="text-right"><?php echo $totalDiscount_registration;?> </td>
    <td style="text-align:right; color:#009C0B; font-weight:bold; class="text-right"><?php echo $totalReceived_registration;?> </td>
  </tr>
 <tbody>
 </table>
   </div>
   
   
 <!------------------------------- Expenditure Table ------------------------------------------->
   
<div>
<label style="margin-top: 5px; width:100%; text-decoration: underline; text-align:center; font-size:11pt; font-weight:normal; color:#00F;"><h5> Escent Diagnostic Pvt. Ltd - Expenditure</h5></label>   
<table class="table table-striped table-bordered font-table" style="width:100%; margin-top:8px;" id="example">
<thead align="left">
<tr>
  <th class="text-center"> Sl.no.</th>
  <th>Voucher no. </th>
  <th>Particulars</th>
  <th>Receiver</th>
  <th class="text-center">Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` WHERE `EX_date` = '".$today_date."' ORDER BY `EX_id` ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$EX_id = $row['EX_id'];
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_date = $row['EX_date'];
	$EX_amount = $row['EX_amount'];
  ?>
 	<tr id = "<?php echo $EX_id;?>">
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td>
       <td class="text-center"><?php echo date("d/m/Y", strtotime($EX_date)); ?></td> 
	   <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("jS M Y, h:i A", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bold;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F; font-weight:bold;" class="text-right"><i class="fa fa-inr"></i> 
	<?php $total_amount = totalAmt_expenditure_oneDay($con, $today_date); if ($total_amount == ""){echo '0.00';} else{echo $total_amount;}?>
    </td>
  </tr>
<tbody>
	</table>
   </div>
   
</div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>    
<script type="text/javascript">

function printDiv(divID) {
	
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body></html>";
			document.getElementById("myBody").style.margin="-72px 1px 1px 1px"
			document.getElementById("myBody").style.fontSize="8pt"
			document.getElementById("myBody").style.fontWeight="normal"
			//document.getElementById("example").style.border ="1px solid #000";
			
			
			//document.body.className += 'test'
			
		
           // Print Page
            window.print();
			document.getElementById("myBody").style.marginTop="0px";
			document.getElementById("myBody").style.fontSize="14px";

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
}

</script>
</body>
</html>
<?php 
    }
	
} ob_flush();?>