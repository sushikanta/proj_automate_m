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
<title>FD - Daily A/C Statement</title>
  <?php include("css_bootstrap_header.php");?> 
</head>
<body id="myBody">
<?php 
if(isset($_GET['today_date']) && $_GET['today_date'] !=''){
	$today_date = $_GET['today_date'];
?>
<?php include("right_top_header.php"); ob_start();
?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success no-print">  
	<div class="panel-heading no-print">
    <h3 class="panel-title" style="color:#0D9707;"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Report - One day Account Statement
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="FD_report_ac_statement_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<!----------------------------------------------- summary --------------------------------------------------------->
<div>
<label style="width:100%; text-align:center; font-size:14pt; font-weight:normal; color:#00F;"><span style="text-decoration:underline;"> Account Statement ( <?php echo date("l, d/m/Y", strtotime($today_date));?> )</span> </br> <span style="font-size:12px !important; font-style:italic;">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span></label>   
<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:10pt;">TOTALS</th>
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
        
		<td style="text-align:center;"><?php echo total_registration($con, $today_date);?></td>
        
        <td style="text-align:center;"><?php echo total_investigation($con, $today_date);?></td>		
		
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalBill_registration = totalBill_registration($con, $today_date); echo $totalBill_registration;?>
        </td>
        
        </td>
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalTax_registration = totalTax_registration($con, $today_date); echo $totalTax_registration; ?>
        </td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		<?php $totalDiscount_registration = totalDiscount_registration($con, $today_date); if($totalDiscount_registration ==""){ $totalDiscount_registration = "0.00";} echo number_format($totalDiscount_registration,'2','.',','); ?></td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalNet_registration = totalNet_registration($con, $today_date); echo $totalNet_registration;?>
        </td>
        
        <td style="text-align:center; color:#f00;"><i class="fa fa-inr"></i> 
		  <?php $totalDue_registration = totalDue_registration($con, $today_date); echo $totalDue_registration;?>
        </td>
        
        
        <td style="text-align:center; color:#00F;"><i class="fa fa-inr"></i> 
		  <?php $totalReceived_registration = totalReceived_registration($con, $today_date); if($totalReceived_registration ==""){ $totalReceived_registration = "0.00";} echo number_format($totalReceived_registration,'2','.',','); ?>
        </td>
        
        <td style="text-align:center; color:#00F;"><i class="fa fa-inr"></i> 
		  <?php $totalDues_paid = totalDues_paid($con, $today_date); if($totalDues_paid ==""){ $totalDues_paid = "0.00";}  echo number_format($totalDues_paid,'2','.',',');?>
        </td>
        
        <td style="text-align:center; color: #D43F00;"><i class="fa fa-inr"></i> 
		<?php $totalExpenditure_amount = totalExpenditure_amount($con, $today_date); echo number_format($totalExpenditure_amount,'2','.',',');?></td>
       
        <td style="text-align:center; color:#00F; font-weight:bold;"><i class="fa fa-inr"></i>
		  <?php echo number_format(($totalReceived_registration + $totalDues_paid - $totalExpenditure_amount),'2','.',','); ?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>
   
<!----------------------------------registration collection --------------------------------------------->
<div style="margin-top:30px;">

<table class="table table-striped table-bordered" style="width:100%;" id="example">
<thead align="left">

<tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:10pt;">REGISTRATION</th>
    </tr>

<tr>
  <th class="text-center">SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th class="text-center">Bill</th>  
  <th class="text-center">Tax</th>
  <th class="text-center">Disc</th>
  <th class="text-center">Net</th>
  <th class="text-center">Due</th>
  <th class="text-right">Received</th>
</tr>
</thead>
</tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_payment`.*, `patient_info`.`PI_name`, `patient_registration`.`pr_dr_prescription`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`  FROM `patient_payment` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_payment`.`PP_patient_id` WHERE DATE_FORMAT(`patient_payment`.`PP_paid_date`,'%Y-%m-%d')  = '".$today_date."' ORDER BY `patient_payment`.`PP_paid_date` ASC");
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
       
<td><?php if($row['pr_dr_prescription'] =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $row['pr_dr_prescription']);} ?> ( <?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). " - ".showSourceName($con, $pr_source_id)."</span> )"; ?> </td>
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       
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
    <td colspan="5" class="price-amount" style="text-align:right;">
    <!--<span style="font-style:italic;" class="pull-left">Checked by : <?php echo $_SESSION['name'];?></span>-->
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right;" class="text-right"><?php echo $totalBill_registration;?> </td>    
    <td style="text-align:right;" class="text-right"><?php echo $totalTax_registration;?> </td>
    <td style="text-align:right;" class="text-right"><?php echo $totalDiscount_registration;?> </td>
    <td style="text-align:right;" class="text-right"><?php echo $totalNet_registration;?> </td>
    <td style="text-align:right;" class="text-right"><?php echo $totalDue_registration;?> </td>
    <td style="text-align:right; color: #00F;" class="text-right"><?php echo number_format($totalReceived_registration,'2','.',',');?> </td>
  </tr>
 <tbody>
 </table>
 </div>
   
   
   <!----------------------------------Due clear collection --------------------------------------------->

<?php
$result = mysqli_query($con, "SELECT `patient_due_tbl`.`PD_bal_paid`, `patient_due_tbl`.`PD_date`, `patient_payment`.`PP_receipt_no`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`, `patient_registration`.`pr_dr_prescription`, `patient_info`.`PI_name` FROM `patient_due_tbl` LEFT JOIN `patient_payment` ON `patient_due_tbl`.`PD_pp_sl` = `patient_payment`.`PP_sl` LEFT JOIN `patient_registration` ON `patient_registration`.`pr_receipt_no` = `patient_payment`.`PP_receipt_no` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_registration`.`pr_patient_id` WHERE DATE_FORMAT(`patient_due_tbl`.`PD_date`,'%Y-%m-%d') = '".$today_date."' ORDER BY `patient_payment`.`PP_paid_date` ASC");

if(mysqli_num_rows($result) !=0)
 {
?>

<div style="margin-top:30px;">

<table class="table table-striped table-bordered" style="width:100%; margin-top:8px;" id="example">
<thead align="left">

	<tr>
    <th colspan="7" class="text-center" style="color:#C9002F; font-size:10pt;">BALANCE DUE CLEARANCE</th>
    </tr>

  <tr>
    <th class="text-center"> SL</th>
    <th>Reg ID</th>
    <th>Name</th>
    <th>Referred by</th>
    <th >Investigation</th>
     <th style="width:13%;">Due paid on</th>
    <th class="text-right" style="width:13%;">Paid Amount</th>
  </tr>
  
</thead>
<tbody>
<?php

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
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $row['PI_name']; ?></td> 
       
       <td><?php if($row['pr_dr_prescription'] =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $row['pr_dr_prescription']);} ?> ( <?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). " - ".showSourceName($con, $pr_source_id)."</span> )"; ?> </td>

       
       
     <!--  <td><?php $referral = showReferral($con, $pr_source_id, $pr_referred_id); if($pr_source_id =='1') { echo "Dr. ".$referral; } else { echo $referral. " (".showSourceName($con, $pr_source_id).")";} ?></td> -->
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td> 
       <td><?php echo date("d/m/Y h:i a", strtotime($PD_date)); ?></td>      
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
     
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> <?php echo number_format($totalDues_paid,'2','.',','); ?> </td>
  </tr>
 </tbody>
 </table>
   </div>  
   
 <?php 
}
?>  

  
 <!------------------------------- Expenditure Table ------------------------------------------->   

<?php
$result1 = mysqli_query($con, "SELECT * FROM `expenditure` WHERE DATE_FORMAT(`EX_date`, '%Y-%m-%d') = '".$today_date."' ORDER BY `EX_id` ASC");

if(mysqli_num_rows($result1) !=0)
 {
?>

<div style="margin-top:30px;">
<table class="table table-striped table-bordered font-table" style="width:100%; margin-top:8px;">
<thead align="left">

	<tr>
    <th colspan="6" class="text-center" style="color:#C9002F; font-size:10pt;">EXPENDITURE</th>
    </tr>

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

$sl_no=1;
while ($row = mysqli_fetch_array($result1))
{
	
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_amount = $row['EX_amount'];
	$EX_date = date("d/m/Y, h:i a", strtotime($row['EX_date']));
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td>
       <td class="text-center"><?php echo $EX_date; ?></td> 
       <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    
    <span class="pull-right" style="font-weight:bold;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> 
	<?php $total_amount = totalAmt_expenditure_oneDay($con, $today_date); if ($total_amount == ""){echo '0.00';} else{echo $total_amount;}?>
    </td>
  </tr>
</tbody>
	</table>
   </div>

<?php 
}
?> 

   
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
			document.getElementById("myBody").style.margin=".5mm .5mm .5mm .5mm";
			document.getElementById("myBody").style.marginTop="-19mm";			
			document.getElementById("myBody").style.fontSize="8pt";
			document.getElementById("myBody").style.fontWeight="normal";
			//document.getElementById("myBody").style.border ="1px solid #000";
			
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