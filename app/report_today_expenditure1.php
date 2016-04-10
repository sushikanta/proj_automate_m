<?php include("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
<title>Admin - Daily Report (Expenditure)</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">
  
 <div class="inv-main">        
  <div class="panel panel-success">
  
   <div class="panel-heading">
     <h3 class="panel-title"><i class="fa fa-windows fa-fw fa-lg"></i> Reports - Today's Expenditure
     <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <?php echo date("d-M-Y", strtotime($today_date)); ?>
     <a class="text-right pull-right navbar-link no-print" href="report_daily_ui.php"> <i class="fa fa-arrow-circle-right fa-lg"></i></a>
     </span>
     <input type="button" onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px;">Print</input >   
     </h3>
   </div>                     
                               

<div>
<table class="table table-striped table-bordered" style="margin-left:2%; width:96%;" id="example">
  	<thead align="left">
<tr>
  <th style="width: 5%;"> #</th>
  <th>Voucher # </th>
  <th>Particulars</th>
  <th>Receiver</th>
  <th> Amount</th>
</tr>
</thead>
<tbody>

<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` WHERE `EX_date` = '".$today_date."' ORDER BY `EX_date` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$EX_id = $row['EX_id'];
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_amount = $row['EX_amount'];
  ?>
 	<tr id = "<?php echo $EX_id;?>">
	   <td class="readonly-bg"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td> 
	   <td><?php echo $row['EX_amount'];?></td>
     </tr>
	
<?php 
  $sl_no++;
}
?>

</tbody>
</table>
<tr>
<td colspan="4" class="price-amount" style="text-align:right; font-weight:bolder;">
    <span style="font-style:italic;" class="pull-left">Checked by : <?php echo $_SESSION['name'];?> (<?php echo date("d-m-Y", time());?>)</span>
    <span class="pull-right"> Total :</span>
    </td>
   <td style="text-align:right; color:#F00; font-weight:bold;">
    <i class="fa fa-inr"></i>
    </td>
</tr>
     
   </div>
     
        
</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ob_flush();?>
<script>

$("#exp_today_date, #prev_from_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-3:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

</script>

 
</body>
</html>
<?php } ?>