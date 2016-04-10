<?php require_once("function.php");
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
<title>FD - A/C Statement till today</title>
  <?php include("css_bootstrap_header.php");?> 
</head>
<body id="myBody">
<?php 
	$start =  date("Y-m-d H:i", strtotime('0000-00-00 00:00'));
	$stop = date("Y-m-d H:i", time());
?>
<?php include("right_top_header.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading no-print" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Report - b/w dates Account Statement
   <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="FD_report_ac_statement_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<div>
<label style="width:100%; text-align:center; font-size:14pt; font-weight:normal; color:#00F;"><span style="text-decoration: underline;">Account Statement</span> </br> <span style="font-size:12px !important;">( Upto <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</span> </label>   
<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:10pt;">TOTAL</th>
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
   
<div style=" margin-top:30px;">  
<table class="table table-striped table-bordered" style="width:100%;">
<thead align="left">

	<tr>
    <th colspan="12" class="text-center" style="color:#C9002F; font-size:10pt;">REGISTRATION</th>
    </tr>
    
<tr>
  <th class="text-center">SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th class="text-center">Date</th>
  <th class="text-center">Bill</th>  
  <th class="text-center">Tax</th>
  <th class="text-center">Disc</th>
  <th class="text-center">Net</th>
  <th class="text-center">Due</th>
  <th class="text-center">Received</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_payment`.*, `patient_info`.`PI_name`, `patient_registration`.`pr_dr_prescription`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`  FROM `patient_payment` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_payment`.`PP_patient_id` WHERE `patient_payment`.`PP_paid_date` BETWEEN '".$start."' AND '".$stop."' ORDER BY `patient_payment`.`PP_paid_date` ASC");
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
	$PP_tax_value = $row['PP_tax_value'];
	$PP_disc_option = $row['PP_disc_option'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_paid_date = $row['PP_paid_date'];
	$PP_bal = $row['PP_bal'];
  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $row['PI_name']; ?></td> 
       <td><?php if($row['pr_dr_prescription'] =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $row['pr_dr_prescription']);} ?> ( <?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). " - ".showSourceName($con, $pr_source_id)."</span> )"; ?> </td>
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       <td><?php echo date("d/m/Y h:i a", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>
       
      <td class="text-right"><?php if($PP_tax =='1'){$tax = ($PP_tax_value/100) * $PP_total; echo number_format($tax, 2, '.', ',');} if($PP_tax =='2'){echo '0.00';}  ?></td>
       <td class="text-right"><?php if($PP_disc_option == '1'){echo calcDiscount_EID($con, $PP_receipt_no);}else {echo '0.00';} ?></td>
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); ?></td>
       <td class="text-right"><?php echo number_format($PP_bal, 2, '.', ','); ?></td>
	   <td class="text-right"><?php echo number_format($PP_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
   <td style="text-align:right;" class="text-right"><?php echo $totalBill_registration_bw;?> </td>     
   <td style="text-align:right;" class="text-right"><?php echo $totalTax_registration_bw;?> </td>
   <td style="text-align:right;" class="text-right"><?php echo $totalDiscount_registration_bw;?> </td>
   <td style="text-align:right;" class="text-right"><?php echo $totalNet_registration_bw;?> </td>
   <td style="text-align:right;" class="text-right"><?php echo $totalDue_registration_bw;?> </td>
   <td style="text-align:right; color:#00F;" class="text-right"><?php if($received ==""){ echo "0.00";}else{echo number_format($received,'2','.',','); } ?> </td>
  </tr>
 </tbody>
 </table>
   </div>
   
   
   <!----------------------------------Due clear collection --------------------------------------------->

<div style="margin-top:30px;">   
<table class="table table-striped table-bordered" style="width:100%;">
<thead align="left">

	<tr>
    <th colspan="7" class="text-center" style="color:#C9002F; font-size:10pt;">BALANCE DUE CLEARANCE</th>
    </tr>

<tr>
  <th class="text-center"> SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th style="width:13%;">Due paid on</th>
  <th class="text-right" style="width:13%;">Paid Amount</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_due_tbl`.`PD_bal_paid`, `patient_due_tbl`.`PD_date`, `patient_payment`.`PP_receipt_no`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`, `patient_info`.`PI_name` FROM `patient_due_tbl` LEFT JOIN `patient_payment` ON `patient_due_tbl`.`PD_pp_sl` = `patient_payment`.`PP_sl` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_registration`.`pr_patient_id` WHERE `patient_due_tbl`.`PD_date` BETWEEN '".$start."' AND '".$stop."' ORDER BY `patient_payment`.`PP_paid_date` ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$PD_bal_paid = $row['PD_bal_paid'];	
	$PD_date = $row['PD_date'];
	$PP_receipt_no = $row['PP_receipt_no'];
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$PI_name = $row['PI_name'];
	
  ?>
 	<tr>
	   <td class="text-center"><?php echo $sl_no; ?></td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $row['PI_name']; ?></td> 
       <td><?php $referral = showReferral($con, $pr_source_id, $pr_referred_id); if($pr_source_id =='1') { echo "Dr. ".$referral; } else { echo $referral. " (".showSourceName($con, $pr_source_id).")";} ?></td> 
        
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td> 
        <td><?php echo date("d/m/Y, h:i a", strtotime($PD_date)); ?></td>     
       <td class="text-right"><?php echo number_format($PD_bal_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
     
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> <?php echo number_format($due_paid,'2','.',','); ?> </td>
  </tr>
 </tbody>
 </table>
   </div>
   
   
   
 <!------------------------------- Expenditure Table ------------------------------------------->
   
<div style="margin-top:30px;">
<table class="table table-striped table-bordered font-table" style="width:100%; margin-top:8px;">
<thead align="left">

	<tr>
    <th colspan="6" class="text-center" style="color:#C9002F; font-size:10pt;">EXPENDITURE</th>
    </tr>

<tr>
  <th class="text-center"> Sl.no.</th>
  <th >Voucher no. </th>
  <th>Particulars</th>
  <th >Receiver</th>
  <th class="text-center">Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` WHERE `EX_date` BETWEEN '".$start."' AND '".$stop."' ORDER BY `EX_date` ASC");
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
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td>
       <td class="text-center"><?php echo date("d/m/Y, h:i a", strtotime($EX_date)); ?></td>  
	   <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> 
	<?php if ($totalExpenditure_amount_bw == ""){echo '0.00';} else{echo number_format($totalExpenditure_amount_bw, '2','.',',');}?>
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
<script type="text/javascript">

function printDiv(divID) {
	
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body></html>";
			//document.getElementById("myBody").style.width="100%"
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
<?php  }  ob_flush();?>