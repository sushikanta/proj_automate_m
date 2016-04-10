<?php require_once("function.php");
ob_start();
session_start();

if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2' || $_SESSION['user_dept_id'] == '3')
 {
?>
<!DOCTYPE html>
<html>
<head>
<title> All payment w/o StaffWalkin</title>
  <?php include("css_bootstrap_header.php");?> 
  <?php include("print-borderless-tbl.php");?>  
</head>
<body>
<?php if($_SESSION['user_dept_id'] == '2'){require_once("right_top_header_admin.php");} else if($_SESSION['user_dept_id'] == '3'){require_once("right_top_header.php");}?>
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = date("Y-m-d", strtotime($_GET['start']));
	$stop = date("Y-m-d", strtotime($_GET['stop']));
?>
<div class="container">
 <div class="page-content">
 
 <div class="inv-main">        
  <div class="panel panel-success">
  
  <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> FD - <span class="panel-subTitle">All Payment without Staff and Walkin</span>
   
   <button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('due_ui', 'W3C Example Table')" 
    class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button> 
    <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> 
    <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>                              
     
<div class="row">
     
     <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="due_ui">
        <thead align="left">
        <tr>
          <th class="text-center blue_color" colspan="13"> Payment Index - All <span class="italic_font" style=" font-weight:normal;">( <?php echo date("d/m/Y", strtotime($start));?> - <?php echo date("d/m/Y", strtotime($stop));?> )</span> </th>
         </tr>
        <tr>
            <th class="text-center"> Sl.no. </th>
            <th> Source</th>
            <th class="text-center">EIDs</th>
            <th class="text-center">Invst</th>        
            <th class="text-right"> Bill </th>
            <th class="text-right"> Tax </th>
            <th class="text-right"> Disc </th>
            <th class="text-right"> Net </th>      
            <th class="text-right"> Due </th>
            <th class="text-right"> Received </th>   
            <th class="text-center no-print">View</th>
        </tr>
        </thead>     
  <tbody>
<?php
$result11 = mysqli_query($con, "SELECT referred_tbl.referred_id, referred_tbl.referred_name, referred_tbl.source_id, source_btl.source_name FROM referred_tbl LEFT JOIN source_btl ON source_btl.source_id = referred_tbl.source_id ORDER BY referred_name ASC"); 
$sl_no=1;
while ($row11 = mysqli_fetch_array($result11))
{   
 	$ref_name = $row11['referred_name'];
	$ref_id = $row11['referred_id'];
	$source_id = $row11['source_id'];
	
	$TotalBal_source = TotalBal_source($con, $source_id);
	
	$EDs = registration_ref($con, $ref_id, $start, $stop);
	$total_test = investigation_ref($con, $ref_id, $start, $stop);
	$bill = bill_ref($con, $ref_id, $start, $stop);
	$tax = tax_ref($con, $ref_id, $start, $stop);
	$discount = discount_ref($con, $ref_id, $start, $stop);
	$net = net_ref($con, $ref_id, $start, $stop);
	$cur_clear = cur_clear_ref($con, $ref_id, $start, $stop);
	$cur_received = paid_first_ref($con, $ref_id, $start, $stop);
	$received = $cur_clear + $cur_received;
	$final_due = $net - ($cur_clear + $cur_received);
	   
	if($EDs !='0'){
	?>
 <tr>
    <td class="text-center"> <?php echo $sl_no; ?> </td>  
    <td><?php echo $ref_name;?> <span class="italic_font"> (Type - <?php echo $row11['source_name']; ?>) </span></td>  
   <td class="text-center"><?php if($EDs == ''){echo '0.00';}else{ echo $EDs; }  ?> </td>  
    <td class="text-center"><?php if($total_test == ''){echo '0.00';}else{ echo $total_test; }  ?> </td>  
    <td class="text-right"><?php if($bill == ''){echo '0.00';}else{ echo number_format($bill, 2, '.', ','); } ?> </td>
    <td class="text-right"><?php if($tax == ''){echo '0.00';}else{ echo number_format($tax, 2, '.', ','); } ?> </td>
    <td class="text-right"><?php if($discount == ''){echo '0.00';}else{ echo number_format($discount, 2, '.', ','); } ?> </td>
    <td class="text-right"><?php if($net == ''){echo '0.00';}else{ echo number_format($net, 2, '.', ','); } ?> </td>
    <td class="text-right"><?php if($final_due == ''){echo '0.00';}else{ echo number_format($final_due, 2, '.', ','); } ?> </td>
    <td class="text-right"><?php if($received == ''){echo '0.00';}else{ echo number_format($received, 2, '.', ','); } ?> </td>
    <td class="text-center no-print"><button onclick="window.open('payment_each_source_name_bw.php?ref=<?php echo $ref_id;?>&start=<?php echo $start;?>&stop=<?php echo $stop;?>&dir=2');">View</button>
    </td>  
 </tr>
 <?php
	$sl_no++;
}
}
?>
 </tbody>
</table>
     
       
</div>	
        
</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>  
</body>
</html>
<?php } } ob_flush(); ?>