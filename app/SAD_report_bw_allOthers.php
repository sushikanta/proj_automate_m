<?php require_once("check_login_super.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Report - (<?php echo date("d/m/Y") ?>)</title>
  <?php require_once("css_bootstrap_datatable_header.php");?>
  <?php require_once("print-borderless.php");?>
 
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
	
?>
<?php require_once("right_top_header_sad.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading light_purple_color">
   
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Report <span class="panel_subTitle no-print">(<?php echo date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($stop)); ?>)</span>        
<!------------ Print & SAve------------->   
<button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
<i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
<button type="button" onclick="tableToExcel('testTable', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;">
<i class="fa fa-file-excel-o fa-fw"></i> Save
</button>    
<span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>  
     </h3>
    </div>     
     
<div class="panel-body"  id="printableArea">
 
<div>
<table class="table table-hover table-condensed">
<thead align="left">
<tr>
  <th colspan="8" class="text-center blue_color">REPORT SOURCE - NO DUE NO DISCOUNT ( <?php echo date("d-m-Y", strtotime($start)).' to '.date("d-m-Y", strtotime($stop)); ?> )</th>
</tr>

<tr>
  <th class="text-center">SL</th>
  <th>Source Person</th>
  <th>Type </th>
  <th class="text-center">EIDs (No Due/Disc)</th>
  <th class="text-center">Total Bill</th>
  <th class="text-center">View</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT DISTINCT r.pr_referred_id, r.pr_source_id FROM patient_registration r INNER JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE r.pr_source_id !='3' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2' ORDER BY r.pr_referred_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	
	$src = $row['pr_source_id'];
	$ref = $row['pr_referred_id'];
	$person = showReferral($con, $src, $ref);
	$type = showSourceName($con, $src);
	$ed_count = others_registration($con, $src, $ref, $start, $stop);
	$net_total = sumNet_eachReferral($con, $src, $ref, $start, $stop);

  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>	   
       <td><?php echo $person; ?> </td>
       <td><?php echo $type; ?> </td>
       <td class="text-center"><?php echo $ed_count; ?></td>
       <td class="text-center"><?php echo $net_total; ?></td>
       
       <td class="text-center">
       <form  action="SAD_report_bw_dates_othersDetail.php" class="form-horizontal inv-form form_1" role="form" method="get" target="_blank">      
        <input type="hidden" name="start" value="<?php echo $start;?>">
        <input type="hidden" name="stop" value="<?php echo $stop;?>">
        <input type="hidden" name="src" value="<?php echo $src;?>">
        <input type="hidden" name="ref" value="<?php echo $ref;?>">
        <button type="submit" class="btn btn-mini btn-primary"> <i class="fa fa-list fa-fw"></i> </button>
       </form>
       </td>      
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
			document.getElementById("myBody").style.margin="-10mm 0mm 0mm 0mm"
			document.getElementById("myBody").style.fontSize="5pt"
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
<?php  } ob_flush();?>