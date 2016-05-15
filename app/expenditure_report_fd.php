<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<title>Expenditure Report</title>
  <?php include("css_bootstrap_header.php"); ?>
  <?php require_once("print-borderless-ac.php");?>
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = date("Y-m-d H:i", strtotime($_GET['start']));
	$stop = date("Y-m-d H:i", strtotime($_GET['stop']));
?>
<?php include("right_top_header_popup.php"); ?>

<div class="container">
 <div class="page-content">		    
        <div class="inv-main">
        
  <div class="panel panel-success">  
	<div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Expenditure <span class="panel-subTitle">( Report )</span>  
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('check', 'AC statement')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
     </h3>
    </div>
     
<div class="panel-body" id="printableArea">
<table style="width:100%;" id="check"><tr><td>
<table class="table table-striped table-bordered font-table" style="margin-top:20px; width:100%;">

<thead align="left">
 <tr>
    <th colspan="6" class="text-center blue_color" id="th_bg_color">Expenditure Report (<?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?>)</th>
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
$result = mysqli_query($con, "SELECT e.EX_id, e.EX_voucher, e.EX_particular, e.EX_person, e.EX_amount, e.EX_date, e.EX_user, u.user_name FROM expenditure e LEFT JOIN user_table u ON u.user_id = e.EX_user WHERE e.EX_date BETWEEN '".$start."' AND '".$stop."' ORDER BY e.EX_date ASC");
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
</tr></td></table>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php } ob_flush();?>