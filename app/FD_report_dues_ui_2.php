<?php include("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2' || $_SESSION['user_dept_id'] == '3')
 {
	 $source_id_pass = $_GET['source_id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Dues Sheet - Name</title>
  <?php include("css_bootstrap_header.php");?> 
  <?php include("print-borderless-tbl.php");?>  
</head>
<body>
<?php if($_SESSION['user_dept_id'] == '2'){require_once("right_top_header_admin.php");} else if($_SESSION['user_dept_id'] == '3'){require_once("right_top_header.php");}?>
<div class="container">
 <div class="page-content">
 
 <div class="inv-main">        
  <div class="panel panel-success">
	 <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> FD - <span class="panel-subTitle"> Dues Sheet </span>
   
   <button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('balance_sheet_tbl', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button> <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> 
    <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>           

<div class="row" style="width:90%; margin-left:5%;">
     
     <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="balance_sheet_tbl">
        <thead align="left">
        <tr>
          <th class="text-center blue_color" colspan="6" id="th_bg_color"> Dues Sheet <span class="th_extra">( <?php echo showSourceName($con, $source_id_pass); ?>s ) </span></th>
         </tr>
        <tr>
          <th class="text-center"> Sl.no. </th>
          <th> Source Name</th>
          <th class="text-center"> No.of EDs</th>
          <th class="text-center"> No.of Investigation</th>        
         <th class="text-right"> Due Amount</th>             
         <th class="text-center no-print">Balance Sheet</th>             
        </tr>
        </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT referred_tbl.referred_id, referred_tbl.referred_name, referred_tbl.source_id AS source_id_x FROM referred_tbl LEFT JOIN source_btl ON source_btl.source_id = referred_tbl.source_id WHERE referred_tbl.source_id = '$source_id_pass' ORDER BY referred_tbl.referred_name ASC"); 
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{   
 	$source_name = $charge['referred_name'];
	$referred_id = $charge['referred_id'];
	$source_id = $charge['source_id_x'];
	$totalED = totalED_source_name($con, $source_id, $referred_id);
	$totalTest = totalTest_source_name($con, $source_id, $referred_id); 
	$TotalBal =  TotalBal_source_name($con, $source_id, $referred_id); 
	$tally_ed = total_EDs_source($con, $source_id);
	$tally_test = total_investigation_source($con, $source_id);
	$tally_bal = TotalBal_source($con, $source_id);
	
	if($totalED !='0'){
	?>
 <tr>
    <td class="text-center"> <?php echo $sl_no; ?> </td>  
    <td><?php echo $source_name; ?> </td>  
   <td class="text-center"><?php if($totalED == ''){echo '0.00';}else{ echo $totalED; } ?> </td>  
    <td class="text-center"><?php if($totalTest == ''){echo '0.00';}else{ echo $totalTest; } ?> </td>  
    <td class="text-right"><?php if($TotalBal == ''){echo '0.00';}else{ echo $TotalBal; } ?> </td>  
    <td class="text-center no-print">
     <!-- <a href="FD_report_balance_sheet.php?source_id=<?php echo $source_id;?>&referred_id=<?php echo $referred_id;?>&type=1"><i class="fa fa-list-alt"></i> Click</a>-->
      
      <button onclick="window.open('FD_report_balance_sheet.php?source_id=<?php echo $source_id;?>&referred_id=<?php echo $referred_id;?>&type=1');"> 
      <i class="fa fa-list-alt"></i> View</button>
    </td>  
 </tr>
 <?php
	$sl_no++;
}
}
?>
   <tr style="font-weight:bold;">
      <td colspan="2" class="text-right"> Total :</td>
      <td class="text-center"> <?php echo $tally_ed;?> </td>
      <td class="text-center"> <?php echo $tally_test;?> </td>
      <td class="text-right"><i class="fa fa-inr"></i> <?php echo $tally_bal;?> </td>
      <td class="text-center no-print">
      <button onclick="window.open('FD_report_balance_sheet_all.php?type=22&source_id=<?php echo $source_id;?>');"> 
      <i class="fa fa-list-alt"></i> All View</button>
      </td>  
    </tr>
  </tbody>
</table>       
       
</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>  
</body>
</html>
<?php } ob_flush(); ?>