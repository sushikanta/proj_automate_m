<?php require_once("check_login_super.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>15 days - ALL(<?php echo date("d/m/Y") ?>)</title>
  <?php require_once("css_bootstrap_header.php");?>
   <?php require_once("print-borderless-simple.php");?>
 
 
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !='' && isset($_GET['src']) && $_GET['src'] !='' && isset($_GET['ref']) && $_GET['ref'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
	$src = $_GET['src'];
	$ref = $_GET['ref'];
	
?>
<?php require_once("right_top_header_popup.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	 <div class="panel-heading light_purple_color">
   
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Report <span class="panel_subTitle no-print">(<?php echo date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($stop)); ?>)</span>        
<!------------ Print & SAve------------->   
<button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
<i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
<!--<button type="button" onclick="tableToExcel('testTable', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;">
<i class="fa fa-file-excel-o fa-fw"></i> Save
</button>    -->
<span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>  
     </h3>
    </div>    
     
<div class="panel-body"> 
<div>
<label class="control-label text-center width_100">
	<h5 style="margin-top:5px;"><?php if($src >'3'){echo showReferral($con, $src, $ref);} ?><br/>
	( <?php echo date("jS F", strtotime($start)).' - '.date("jS F, Y", strtotime($stop)); ?> )
    </h5>
</label>

<table class="table-hover width_100" id="testTable">
<thead align="left">
<tr>
  <th class="text-center" style="width:3%;">SL</th>
  <th style="width:20%;">Name</th>
  <th style="width:10%;">Date</th>
  <th style="width:17%;">Ref by</th>
  <th>Investigation</th>
  <th class="text-right no-print">Rate</th>
  <th class="text-center" style="max-height:5px;">
  <input id="comm_per" class="pull-left text-right no-border" name="comm_per" style="width:80%; border:1px solid tranparent;" maxlength="3">
  <span>%</span></th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT y.PP_net, y.PP_date, y.PP_receipt_no, r.pr_dr_prescription, i.PI_name FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info i ON i.PI_id = r.pr_patient_id WHERE  r.pr_source_id ='$src' AND r.pr_referred_id ='$ref' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2' ORDER BY r.pr_date ASC");

$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	
	$PP_receipt_no = $row['PP_receipt_no'];	
	$PP_net = $row['PP_net'];
	$dr_prescription = $row['pr_dr_prescription'];	
	$PP_paid_date = $row['PP_date'];
	
	$PI_name = $row['PI_name'];
	
  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PI_name; ?></td> 
       <td><?php echo date("d/m/Y", strtotime($PP_paid_date)); ?></td>
       <td><?php if($dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_prescription);} ?></td>
       <td><?php allTest_ED($con, $PP_receipt_no); ?></td>       
       <td class="text-right no-print"><input id="net<?php echo $sl_no;?>" class="text-right no-border" value="<?php echo $PP_net; ?>"></td>        
       <td class="text-right" style="width:3%; padding-right:10px;">
       <input class="comm text-right no-border" id="comm<?php echo $sl_no;?>" value="<?php echo $row['PP_net'];?>" style="width:80px;" readonly>
       
       </td>
     </tr>	
<?php 
$sl_no++;
}
?>
<input type="hidden" id="count" value="<?php echo $sl_no;?>"/>
<tr>            
    <td colspan="5" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
   <td style="text-align:right;" class="text-right no-print"><input id="netSum" class="text-right" value="<?php echo sumNet_eachReferral($con, $src, $ref, $start, $stop);?>"></td>     
  
   <td style="text-align:right;">
   <input class="comm text-right no-border padding_right10" id="commSum" value="<?php echo number_format(sumNet_eachReferral($con, $src, $ref, $start, $stop),'2','.',',');?>" style="width:80px;" readonly>
   </td>
  
  </tr>
 </tbody>
 </table>
   </div>
</div>
<div class="clear"></div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php");?>
<script type="text/javascript">
$(document).ready(function() {
	var count = Number($('#count').val());
	var newCount =  new Number (count - 1);
	var i =1;	
	$('#comm_per').on('keyup', function() {
		
		for (i =1; i<count; i++)
			{
		var net = Number($('#net' + i).val());
		var comm_per = Number($('#comm_per').val());
		var amt = (comm_per/100) * net;
		$('#comm' + i).val(amt.toFixed(2));
		}
		
		var netSum = Number($('#netSum').val());
		var comm_per = Number($('#comm_per').val());
		var comAmt = (comm_per/100) * netSum;		
		$('#commSum').val(comAmt.toFixed(2));
		
	});	

});
</script>
</body>
</html>
<?php } ob_flush();?>