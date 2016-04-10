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
<meta charset="utf-8" />
<title>FD - Expenditure b/w dates</title>
  <?php include("css_bootstrap_header.php"); ?>
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
?>

<?php include("right_top_header.php"); ?>

<div class="container">
 <div class="page-content">		    
        <div class="inv-main">
        
  <div class="panel panel-success">  
	<div class="panel-heading no-print" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Report - b/w dates Expenditures
    <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="FD_report_expenditure_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:100px;">Print</button>     
     </h3>
    </div>      
     
<div class="panel-body" id="printableArea">


<div>
<label style="width:100%; text-align:center; font-size:14pt; font-weight:normal; color:#00F;"><span style="text-decoration: underline;">Referral's Commission</span> </br> <span style="font-size:12px !important;">( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</span> </label>   

<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <!--<tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:11pt;">REFERRAL CUTS ( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</th>
    </tr>-->
	<tr>
        <th style="text-align:center;">SL</th>
        <th>Referal Name</th>		
		<th>Source</th>        
        <th style="text-align:center;">Total - ED</th>
        <th style="text-align:center;">Total - Invst</th>
        <th style="text-align:center;">Received</th>        
        <th style="text-align:center;">Cut %</th>
        <th style="text-align:center;">Cut Rs.</th>
        <th style="text-align:center; width:13%;">Cut Date</th>
        <th style="text-align:center;">Status</th>
       
        
        
      </tr>
	</thead>
	<tbody>
  		
<?php
$result = mysqli_query($con, "SELECT DISTINCT `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id` FROM `patient_registration` JOIN `patient_payment` ON `patient_payment`.`PP_receipt_no` = `patient_registration`.`pr_receipt_no` AND `patient_payment`.`PP_bal` <= 0 AND `patient_payment`.`PP_disc_option` = 2 WHERE `patient_payment`.`PP_paid_date` BETWEEN '".$start."' AND '".$stop."'");

if(mysqli_num_rows($result)==0){echo 'no result';}else{

$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$source_id = $row['pr_source_id'];
	$referred_id = $row['pr_referred_id'];
	
  ?>
        
        <tr>
        
        <td style="text-align:center;"><?php echo $sl_no;?></td>
        
        <td><?php echo showReferral($con, $source_id, $referred_id); ?></td>		
		
        <td><?php echo showSourceName($con, $source_id);?>
        </td>
        
        </td>
        
        <td style="text-align:center;"> <?php echo totalED_referral_bw($con, $referred_id, $start, $stop); ?>
        </td>
        
        <td style="text-align:center;"> <?php echo totalTest_referral_bw($con, $referred_id, $start, $stop); ?></td>
       		  
		<td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php echo $referred_id; //$totalNet_registration_bw = totalNet_registration_bw($con, $start, $stop); echo $totalNet_registration_bw;?>
        </td>
        
        <td style="width:100px;">
        
           
        <input type="text" class="form-control" id="cut_per" placeholder="e.g. 20" name="cut_per" maxlength="5">
        
        
        </td>
		  
         <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php echo $referred_id; //$received = totalReceived_registration_bw($con, $start, $stop); echo number_format($received, '2','.',','); ?>
        </td>
         <td style="text-align:center;"> <?php echo date("d/m/Y, h:i a"); ?>
        </td>
        
         <td style="text-align:center; color: #00F; width:110px;">
         
        <select class="form-control" name="emp_marital">
            <option value="">Select</option>         
            <option value="1">OK</option>    
            <option value="2">HOLD</option>               
            <option value="3">NO</option>               
     	</select>
         
         
        </td>
	</tr>
        
   <?php 
$sl_no++;
}}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bold;"> Total (Rs) :</span>
    </td>
     <td colspan="2" style="text-align:left; color:#F00; font-weight:bold;"><i class="fa fa-inr"></i> 
    <?php $total_amount = totalAmt_bw_date_expenditure($con, $start, $stop); if ($total_amount == ""){echo '0.00';} else{echo $total_amount;}?>
    </td>
    <td colspan="3" style="text-align:left; color:#F00; font-weight:bold;"><i class="fa fa-inr"></i> 
    <?php $total_amount = totalAmt_bw_date_expenditure($con, $start, $stop); if ($total_amount == ""){echo '0.00';} else{echo $total_amount;}?>
    </td>
  </tr>    
    
        
             
       </tbody>   
	</table>
    </div>



<table class="table table-striped table-bordered" style="margin-top:15px; width:100%;">
    <thead>
    <!--<tr>
    <th colspan="11" class="text-center" style="color:#C9002F; font-size:11pt;">REFERRAL CUTS ( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</th>
    </tr>-->
	<tr>
        <th style="text-align:center;">SL</th>
        <th>Referal Name</th>		
		<th>Source</th>        
        <th style="text-align:center;">Total - ED</th>
        <th style="text-align:center;">Total - Invst</th>
        <th style="text-align:center;">Received</th>        
        <th style="text-align:center;">Cut %</th>
        <th style="text-align:center;">Cut Rs.</th>
        <th style="text-align:center; width:13%;">Cut Date</th>
        <th style="text-align:center;">Status</th>
       
        
        
      </tr>
	</thead>
	<tbody>
  		
<?php
$result1 = mysqli_query($con, "SELECT `patient_registration`.`pr_receipt_no`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`, `patient_payment`.`PP_bal`, `patient_payment`.`PP_disc_option` FROM `patient_registration`  JOIN `patient_payment` ON `patient_payment`.`PP_receipt_no` = `patient_registration`.`pr_receipt_no` AND `patient_payment`.`PP_bal` <= 0 AND `patient_payment`.`PP_disc_option` = 2 WHERE `patient_payment`.`PP_paid_date` BETWEEN '".$start."' AND '".$stop."'");

if(mysqli_num_rows($result1)==0){echo 'no result';}else{

$sl_no=1;
while ($row = mysqli_fetch_array($result1))
{
	$source_id = $row['pr_source_id'];
	$referred_id = $row['pr_referred_id'];
	
  ?>
        
        <tr>
        
        <td style="text-align:center;"><?php echo $sl_no;?></td>
        
        <td><?php echo showReferral($con, $source_id, $referred_id); ?></td>		
		
        <td><?php echo showSourceName($con, $source_id);?>
        </td>
        
        </td>
        
        <td style="text-align:center;"> <?php echo $row['pr_receipt_no']; ?>
        </td>
        
        <td style="text-align:center;"> <?php echo $row['pr_receipt_no']; ?></td>
       		  
		<td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php echo "Received";?>
        </td>
        
        <td style="width:100px;">
        
           
        <input type="text" class="form-control" id="cut_per" placeholder="e.g. 20" name="cut_per" maxlength="5">
        
        
        </td>
		  
         <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php echo $referred_id; //$received = totalReceived_registration_bw($con, $start, $stop); echo number_format($received, '2','.',','); ?>
        </td>
         <td style="text-align:center;"> <?php echo date("d/m/Y, h:i a"); ?>
        </td>
        
         <td style="text-align:center; color: #00F; width:110px;">
         
        <select class="form-control" name="emp_marital">
            <option value="">Select</option>         
            <option value="1">OK</option>    
            <option value="2">HOLD</option>               
            <option value="3">NO</option>               
     	</select>
         
         
        </td>
	</tr>
        
   <?php 
$sl_no++;
}}
?>
      
             
       </tbody>   
	</table>



 <div class="clear"></div>
  </div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>    

<script>
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
<?php  } } ob_flush();?>