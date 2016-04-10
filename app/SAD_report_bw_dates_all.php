<?php require_once("check_login_super.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>No disc/dues (<?php echo date("d/m/Y") ?>)</title>
  <?php require_once("css_bootstrap_datatable_header.php");?>
  <?php require_once("print-borderless-ac.php");?> 
</head>
<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = date("Y-m-d", strtotime($_GET['start']));
	$stop = date("Y-m-d", strtotime($_GET['stop']));
	
?>
<?php require_once("right_top_header_sad.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">        
   <div class="panel panel-success">
    
    <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Report <span class="panel-subTitle"> ( No discount No dues Dated : <?php echo date("d-m-Y", strtotime($start)).' to '.date("d-m-Y", strtotime($stop)); ?> )</span>
   
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button> <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> 
    <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>       
    
     
<div class="panel-body"  id="printableArea">
 
<div>
<table class="table table-hover table-condensed width_100" id="testTable">
<thead align="left">
<tr>
  <th colspan="8" class="text-center blue_color">REPORT - NO DUE NO DISCOUNT ( <?php echo date("d-m-Y", strtotime($start)).' to '.date("d-m-Y", strtotime($stop)); ?> )</th>
</tr>

<tr>
  <th class="text-center">SL</th>
  <th>ED/</th>
  <th>Patient Name</th>
  <th>Referred by</th>
  <th>Source</th>
  <th>Investigation</th>
  <th>Date</th>
  <th class="text-center">Bill</th>  
  <th class="text-center">Net</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT y.PP_receipt_no, y.PP_total, y.PP_net, y.PP_paid, y.PP_date, i.PI_name, r.pr_dr_prescription, r.pr_source_id, r.pr_referred_id FROM patient_payment y LEFT JOIN patient_registration r ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info i ON i.PI_id = r.pr_patient_id WHERE DATE_FORMAT(y.PP_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2' ORDER BY r.pr_date ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	
	
	$PI_name = $row['PI_name'];	
	$PP_receipt_no = $row['PP_receipt_no'];
	$PP_total = $row['PP_total'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_paid_date = $row['PP_date'];
	
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$pr_dr_prescription = $row['pr_dr_prescription'];
	$dr_name = showDoctor_name($con, $pr_dr_prescription);
	$source_person = showReferral($con, $pr_source_id, $pr_referred_id);
	$source = showSourceName($con, $pr_source_id);
	
	
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $PI_name; ?></td> 
       <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.$dr_name;} ?> </td>
       <td><?php if($source_person !=''){echo $source_person;} if($source !=''){echo ' ('.$source.')';} ?> </td>
       <td><?php allTest_ED($con, $PP_receipt_no); ?></td>
       <td><?php echo date("d/m/Y", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>
        
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); ?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>

 <tbody>
 </table>
   </div>
   
   
 
</div>
<div class="clear"></div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php");?> 
<?php require_once("script_saveto_excel.php");?>
<?php require_once("script_print_bw_div.php");?>  
</body>
</html>
<?php } ob_flush();?>