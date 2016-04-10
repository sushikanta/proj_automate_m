<?php require_once("function.php");
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
<title>Admin - all Expenditures</title>
  <?php include("css_bootstrap_header.php"); ?> 

</head>
<body id="myBody">

<?php include("right_top_header_admin.php"); ?>

<div class="container">
 <div class="page-content">		    
        <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Report - all Expenditures
     <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?><a class="text-right pull-right navbar-link no-print" href="report_daily_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
    <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>    
     </h3>
    </div>      
     
     
<div class="panel-body" id="printableArea">
<div>
<label style="width:100%; text-decoration: underline; text-align:center; font-size:16pt; font-weight:normal; color:#00F;"> All Expenditures Account Statement</label>   
<table class="table table-striped table-bordered font-table" style="margin-top: 15px; width:100%;">
<thead align="left">
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
$result = mysqli_query($con, "SELECT * FROM `expenditure` ORDER BY `EX_date` ASC");
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
 	<tr id = "<?php echo $EX_id;?>">
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td> 
       <td class="text-center"><?php echo date("d/m/Y", strtotime($row['EX_date'])); ?></td> 
	   <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("jS M Y, h:i A", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bolder;"> Total :</span>
    </td>
    <td style="text-align:right; color:#F00; font-weight:bold; padding-right:15px;" class="text-right"><i class="fa fa-inr"></i> 
    <?php $total_amount = totalAmt_all_expenditure($con); if ($total_amount == ""){echo '0';} else{echo $total_amount;}?>
    </td>
  </tr>
<tbody>
	</table>
   </div>
   
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
<?php 
  
	
} ob_flush();?>