<?php require_once("check_login_super.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Months Report</title>
  <?php require_once("css_bootstrap_datatable_header.php");?>
   <?php require_once("print-borderless.php");?>
 
 
</head>

<body id="myBody">
<?php 
if(isset($_GET['month']) && $_GET['month'] !='' && isset($_GET['year']) && $_GET['year'] !='' && isset($_GET['type']) && $_GET['type'] !=''){
	$month = $_GET['month'];
	$type = $_GET['type'];
	$year = $_GET['year'];	
?>
<?php require_once("right_top_header_sad.php"); ?>

<div class="container" id="printableArea">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading no-print" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Report <span style="font-size: 14px; font-style:italic; color:#000000;">( Months Report of all EDs : <?php echo $month.', '.$year; ?>)</span>
   
     
  <button  onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;"><i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('month_year', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>    
    <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> 

<span id="show_date"></span></span>  
     </h3>
    </div>      
     
<div class="panel-body">
 
<div>
<table class="table table-striped table-borderless" style="width:100%;" id="month_year">
<thead align="left">
<thead>
    <tr>
    <th colspan="14" class="text-center">Months Totals <span style="font-style:italic;">( <?php echo get_long_month($con, $month).', '.$year?>)</span></th>
    </tr>
	<tr>
        <th style="text-align:center;">EDs</th>
        <th style="text-align:center;">Invst</th>		
		<th style="text-align:center;">Bill</th>        
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Net</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;">Recieved</th>       
        <th style="text-align:center;">Expd</th>
        <th style="text-align:center;">Deposit</th>
	</tr>
	</thead>
	<tbody>
  		<tr>
        
        <td style="text-align:center;"><?php echo registration_month_year($con, $month, $year);?></td>
        
        <td style="text-align:center;"><?php echo investigation_month_year($con, $month, $year);?></td>		
		
        <td style="text-align:center;">
		  <?php $totalBill = bill_registration_month_year($con, $month, $year); echo number_format($totalBill, 2, '.', ',');?>
        </td>
        
        </td>
        
        <td style="text-align:center;"><?php $tax = tax_month_year($con, $month, $year); echo number_format($tax, 2, '.', ','); ?>
        </td>
        
        <td style="text-align:center;"><?php $discount = discount_month_year($con, $month, $year); echo number_format($discount, 2, '.', ',');?></td>
       		  
		<td style="text-align:center;"><?php $net = net_month_year($con, $month, $year); $curClear = curClear_month_year($con, $month, $year); $received = received_first_paid($con, $month, $year); echo number_format($net, 2, '.', ',');?>
        </td>
        
        <td style="text-align:center; color:#F00;"><?php $final_due = $net - ($curClear + $received); echo number_format($final_due, 2, '.', ',');?>
        </td>
        
        <td style="text-align:center; color: #00F;"><?php echo number_format($received, '2','.',','); ?> +  <?php echo number_format($curClear, '2','.',','); ?> = <?php $acutual_received = $received + $curClear; echo number_format($acutual_received, '2','.',','); ?>
        </td>
        
        
        
        
        
         <td style="text-align:center; color: #00F;"><?php $dues_paid_all = dues_paid_month_year($con, $month, $year); $pastClear = $dues_paid_all - $curClear; 
		  echo number_format($pastClear, '2','.',','); ?>
        </td>
        <td style="text-align:center; color: #00F;"><?php $total_received = $acutual_received + $pastClear; echo number_format($total_received, '2','.',','); ?>
        </td>
       
        <td style="text-align:center; color: #D43F00;"><?php $totalExpenditure = expenditure_month_year($con, $month, $year); echo number_format($totalExpenditure,'2','.',',');?></td>
        <td style="text-align:center; color: #00F; font-weight:bold;"><?php echo number_format((($acutual_received + $pastClear) - $totalExpenditure),'2','.',',');?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>
   </div> 
</div>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>    
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php  } ob_flush();?>