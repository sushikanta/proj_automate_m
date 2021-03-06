﻿<?php require_once("function.php");
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
<title>FD - Expenditure b/w dates</title>
  <?php include("css_bootstrap_header.php"); ?>
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
?>
<?php include("right_top_header.php"); ?>

<div class="container">
 <div class="page-content">		    
        <div class="inv-main">
        
  <div class="panel panel-success">  
	<div class="panel-heading no-print" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Report - b/w dates Expenditures
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="FD_report_expenditure_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>     
     </h3>
    </div>      
     
<div class="panel-body" id="printableArea">


<div>
<label style="width:100%; text-align:center; font-size:14pt; font-weight:normal; color:#00F;"><span style="text-decoration: underline;">Account Statement</span> </br> <span style="font-size:12px !important;">( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</span> </label>   
<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:11pt;">REFERRAL CUTS ( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</th>
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
        <th style="text-align:center;">Due Clear</th>
        <th style="text-align:center;">Expd</th>
        <th style="text-align:center;">Deposit</th>
		</tr>
	</thead>
	<tbody>
  		<tr>
        
        <td style="text-align:center;"><?php echo total_registration_bw($con, $start, $stop);?></td>
        
        <td style="text-align:center;"><?php echo total_investigation_bw($con, $start, $stop);?></td>		
		
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalBill_registration_bw = totalBill_registration_bw($con, $start, $stop); echo $totalBill_registration_bw;?>
        </td>
        
        </td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalTax_registration_bw = totalTax_registration_bw($con, $start, $stop); echo $totalTax_registration_bw; ?>
        </td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		<?php $totalDiscount_registration_bw = totalDiscount_registration_bw($con, $start, $stop); echo $totalDiscount_registration_bw;?></td>
       		  
		<td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalNet_registration_bw = totalNet_registration_bw($con, $start, $stop); echo $totalNet_registration_bw;?>
        </td>
        
        <td style="text-align:center; color:#F00;"><i class="fa fa-inr"></i> 
		  <?php $totalDue_registration_bw = totalDue_registration_bw($con, $start, $stop); echo $totalDue_registration_bw;?>
        </td>
		  
         <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php $received = totalReceived_registration_bw($con, $start, $stop); echo number_format($received, '2','.',','); ?>
        </td>
        
         <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php $due_paid = totalDues_paid_bw($con, $start, $stop); echo number_format($due_paid, '2','.',','); ?>
        </td>
       
        <td style="text-align:center; color: #D43F00;"><i class="fa fa-inr"></i>
		  <?php $totalExpenditure_amount_bw = totalExpenditure_amount_bw($con, $start, $stop); echo number_format($totalExpenditure_amount_bw,'2','.',',');?></td>
        <td style="text-align:center; color: #00F; font-weight:bold;"><i class="fa fa-inr"></i>
		  <?php echo number_format((($received + $due_paid) - $totalExpenditure_amount_bw),'2','.',',');?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>














<table class="table table-striped table-bordered font-table" style="margin-top:15px; width:100%;">

<thead align="left">
 <tr>
    <th colspan="6" class="text-center" style="color:#C9002F; font-size:11pt;">EXPENDITURE (<?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?>)</th>
    </tr>

<tr>
  <th class="text-center"> Sl.no.</th>
  <th>Voucher no.</th>
  <th>Particulars</th>
  <th>Receiver</th>
  <th class="text-center">Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>

<tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` WHERE DATE_FORMAT(`EX_date`, '%Y-%m-%d %r.%i') >= '".$start."' AND DATE_FORMAT(`EX_date`, '%Y-%m-%d %r.%i') <= '".$stop."' ORDER BY `EX_date` ASC");
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
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td> 
       <td class="text-center"><?php echo date("d/m/Y, h:i a", strtotime($row['EX_date'])); ?></td> 
	   <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bold;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#F00; font-weight:bold;" class="text-right"><i class="fa fa-inr"></i> 
    <?php $total_amount = totalAmt_bw_date_expenditure($con, $start, $stop); if ($total_amount == ""){echo '0.00';} else{echo $total_amount;}?>
    </td>
  </tr>
  
</tbody>
</table>
  </div>
 </div>
 <div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>    

<script>
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
<?php  } } ob_flush();?>