<?php include("function.php");
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
<title>Payment History</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header.php"); ?>
<div class="container">
 <div class="page-content">
 
 <?php 
if (isset($_GET['receipt_no']) && $_GET['receipt_no'] != '')
{

$pass_receipt_no = $_GET['receipt_no'];

?>
 
 
 
 <div class="inv-main">        
  <div class="panel panel-success">
  
   <div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Registration Payment History
     <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?><a class="text-right pull-right navbar-link no-print" href="patient_registration_view.php?receipt_no=<?php echo $pass_receipt_no; ?>" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     </h3>
   </div>                     
                               
      <div class="row form-group">     
          <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Payment History : <?php echo $pass_receipt_no; ?></h4></label>
      </div>
     
<div class="row" style="width:50%; margin-left:25%; margin-top:15px;">
     
  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
        <thead align="left">
        <tr>
          <th style="width:30%; text-align:center;"> Sl.no. </th>
          
          <th class="text-center"> Paid Amount</th>         
           <th style="width:30%; text-align:center;"><i class="fa fa-calendar"></i> Payment Date </th>  
                   
        </tr>
        </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT `PP_sl`, `PP_receipt_no`, `PP_patient_id`, `PP_total`, `PP_tax`, `PP_tax_value`, `PP_disc_option`, `PP_net`, `PP_paid`, `PP_paid_date`, `PP_bal` FROM `patient_payment` WHERE `PP_receipt_no` = '".$pass_receipt_no."'"); 
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{   
 	$PP_net = $charge['PP_net'];
	$PP_paid = $charge['PP_paid'];
	$PP_bal = $charge['PP_bal'];
	$PP_paid_date = $charge['PP_paid_date'];  
	?>
 <tr>
    <td class="text-center"> <?php echo $sl_no; ?> </td>  
    
    <td style="text-align:right; padding-right:15%;"><?php echo number_format($PP_paid,'2','.',','); ?> </td>  
   
    <td class="text-center"> <?php echo date("d-M-Y, h:i A", strtotime($PP_paid_date)); ?> </td>  
   </tr>

 <?php
	$sl_no++;
}

?>
 
<?php 

$result2 = mysqli_query($con, "SELECT `patient_due_tbl`.`PD_bal_paid`, `patient_due_tbl`.`PD_date` FROM `patient_payment` LEFT JOIN `patient_due_tbl` ON `patient_due_tbl`.`PD_pp_sl` = `patient_payment`.`PP_sl` WHERE `patient_payment`.`PP_receipt_no` = '".$pass_receipt_no."' AND `patient_due_tbl`.`PD_pp_sl` IS NOT NULL");

if (mysqli_num_rows($result2) > 0)
{ 
$sl_no=2;
while ($second = mysqli_fetch_array($result2))
{   
 	$PD_bal_paid = $second['PD_bal_paid'];
	$PD_date = $second['PD_date'];
		
  ?>
 
 <tr>
    <td class="text-center"> <?php echo $sl_no; ?> </td>  
    
    <td style="text-align:right; padding-right:15%;"><?php echo number_format($PD_bal_paid,'2','.',','); ?> </td>     
    <td class="text-center"><?php echo  date("d-M-Y, h:i A", strtotime($PD_date)); ?> </td> 
 </tr>

 <?php
	$sl_no++;
  }
 }
?>
<?php
$result3 = mysqli_query($con, "SELECT SUM(patient_due_tbl.PD_bal_paid) AS sum FROM `patient_payment` LEFT JOIN `patient_due_tbl` ON `patient_due_tbl`.`PD_pp_sl` = `patient_payment`.`PP_sl` WHERE `PP_receipt_no` = '".$pass_receipt_no."'");

while ($third = mysqli_fetch_array($result3))
{   
 	$sum = $third['sum'];
	
}
?>

          <tr style="font-weight:bold;">
            <td class="text-center">Net :&nbsp;&nbsp;&nbsp; <span class="text-right"> <i class="fa fa-inr"></i> <?php  echo number_format($PP_net,'2','.',','); ?></span></td>
            
            <td style="text-align:right; padding-right:15%;"><i class="fa fa-inr"></i> <?php echo number_format(($PP_paid + $sum),'2','.',','); ?></td>
            
            <td class="text-center">Balance :&nbsp;&nbsp;&nbsp; <span class="text-center" style="color:#F00;"> <i class="fa fa-inr"></i> <?php  echo number_format($PP_bal,'2','.',','); ?></span></td>
           </tr>
           
    </tbody>
</table>
     
       
</div>	
        
</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ob_flush();?>
<script>

$("#exp_today_date, #start_date_exp, #stop_date_exp, #date_collective, #start_date_bw, #stop_date_bw" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-1:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

</script>

 
</body>
</html>
<?php } 

 } ?>