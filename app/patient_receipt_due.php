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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FD - Receipt</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-receipt.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-print.css"  media="print"/>
<link href="font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet"/>
</head>
    <!-- Bootstrap -->
<?php 
$receipt_no_tbl = $_GET['receipt_no'];
if(isset($receipt_no_tbl))
 {
  $result = mysqli_query($con, "SELECT `patient_registration`.*, `patient_info`.* FROM `patient_registration` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` =  `patient_registration`.`pr_patient_id` WHERE `pr_receipt_no` = '".$receipt_no_tbl."'");

  while($row=mysqli_fetch_array($result))
                {
                   	$patient_name = $row['PI_name'];					
					$patient_phone = $row['PI_phone'];
					$pr_patient_gender = $row['PI_gender_id'];
					$patient_age = $row['PI_age'];
					$pr_date = $row['pr_date'];
					$date = date("d-M-Y", strtotime($row['pr_date']));
					$time = date("h:i A", strtotime($row['pr_date']));
					$patient_address = $row['PI_address'];
					$state = $row['PI_state_id'];
					$district = $row['PI_district_id'];
					$pin = $row['PI_pin_id'];
					$dr_letter = $row['pr_dr_prescription'];
					$source_id = $row['pr_source_id'];
					$referred_id = $row['pr_referred_id'];					
					$patient_history = $row['pr_patient_history'];
					$lab_notes = $row['pr_lab_notes'];
				}
			?>

<body>
<div class="container" id="print_div">
<div class="watermark">
                 <div class="header">                 
                       <div class="esc-r-header-left">
                        <h2 class="media-heading" style=" line-height:5px;">Escent Diagnostics Pvt. Ltd <span style="font-size:16px; font-weight:500;" class="text-right pull-right">Regd. No. MNHCR/NO/096/DC/2012</span></h2><div class="clearfix"></div>
                         <h5 class="media-heading"><span style="font-size:16px;">Purana Rajbari, Nongmeibung, Imphal East, Manipur-795001</span><span class="pull-right text-right" style="font-weight:500; font-size:16px;"><i class="fa fa-phone-square fa-fw"></i> +91 8731049609</span></h5>
                                         
                        </div>
                       <div class="clearfix"></div>
                      </div>
 
<div class="esc-pateint-details">  <!-----------------START of patient details------------------->
		<div class="esc-row">
			<div class="pull-left">Registration No : <strong><?php echo $receipt_no_tbl; ?></strong></div>
			<div class="pull-right"><i class="fa fa-calendar fa-fw"></i> <?php echo date("d/m/Y, h:i A", strtotime($pr_date)); ?></div>
        	<div class="clearfix"></div>
        </div>

        <div class="row text">
                <div class="esc-r-name pull-left">Name : <?php echo $patient_name; ?></div>
                <div class="esc-r-age pull-right text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> : <?php if($pr_patient_gender =='1'){echo "Male, ".$patient_age." years";}elseif($pr_patient_gender =='2'){echo "Female, ".$patient_age." years";} ?></div>
                <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="esc-r-add pull-left">Address : <?php echo $patient_address; ?></div>
            <div class="esc-r-contact2 pull-right text-right"><i class="fa fa-phone-square fa-fw"></i> +91 <?php echo $patient_phone; ?></div>
            <div class="clearfix"></div>
        </div>

    <div class="row">
        <div class="esc-r-add pull-left"><?php echo showDistrictName($con, $district); ?>, <?php echo showStateName($con, $state); ?> <?php if($pin == "0"){echo "";}else{echo " - ".$pin;} ?>
        </div>
<div class="pull-right text-right">Ref. By : <?php if($dr_letter =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_letter);} ?></div>                    
        <div class="clearfix"></div>
    </div>
	
</div>   <!--end patient details -->

<div class="row">

  <!-- Table -->
  <table class="table table-bordered table-hover" style="margin: 5px 0px 10px 0px;">
  	<thead class="esc-t-head">
		<tr>
		<th colspan="1" style="width:15%;">Sl. No.</th>
		<th colspan="5">Investigation</th>		
		<th colspan="1" style="width:17%; text-align:right;">Amount</th>
		</tr>
	</thead>
	<tbody>
    <?php 
$result_test = mysqli_query($con, "SELECT `patient_test`.`PT_test_name`, `patient_test`.`PT_test_price`, `patient_payment`.*, `discount_tbl`.* FROM `patient_test` LEFT JOIN  `patient_payment` ON `patient_payment`.`PP_receipt_no`=`patient_test`.`PT_receipt_no` LEFT JOIN `discount_tbl` ON `discount_tbl`.`disc_receipt_no` = `patient_test`.`PT_receipt_no` WHERE `patient_test`.`PT_receipt_no` = '".$receipt_no_tbl."'");
$sl_no=1;
while ($charge = mysqli_fetch_array($result_test))
{   
 	$test_name = $charge['PT_test_name'];
	$test_price = $charge['PT_test_price'];
    $total = $charge['PP_total'];
	
	$tax =  $charge['PP_tax'];
	if($tax == '1'){ $tax_value =  " : ". $charge['PP_tax_value']."%";}
	
	$disc_option =  $charge['PP_disc_option'];
	if($disc_option == '1' && $charge['disc_value'] !=NULL)
	 { 
	     if (isset($charge['disc_type']) && $charge['disc_type'] =='1')
			  { $disc_value = " : ". $charge['disc_value']."%"; }
		 else { $disc_value = " : ". '&nbsp;<i class="fa fa-inr" style="color: #A19191 !important;"></i> '.$charge['disc_value']; }
	   } 
	else{ $disc_value = '---';}
			
	$bal =  $charge['PP_bal'];
	$disc_option =  $charge['PP_disc_option'];
	$paid =  $charge['PP_paid'];	
	$net = $charge['PP_net'];
	
	?>
          <tr>
            <td colspan="1"> <?php echo $sl_no; ?> </td>
            <td colspan='5'> <?php echo $test_name; ?> </td>            
            <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($test_price, 2, '.', ','); ?> </td>
          </tr>
       <?php
 $sl_no++;
}
?>
          <tr>
            <td colspan="4" rowspan="3" ></td>
            <td colspan="2" class="price-amount" style="width:26%; text-align:right;"><span class="pull-right">Sub Total</span></td>
            <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ','); ?> </td>
          </tr>
          
          <tr>
            <td class=" inline text-right" colspan="2">
            <?php if($tax == '1'){?><span class="text-right" style="color: #A19191 !important;">Tax <?php echo $tax_value; ?>, </span><?php }?> 
            <?php if($disc_option == '1'){?><span class="text-right" style="color: #A19191 !important;">Discount <?php echo $disc_value; ?> </span><?php }?> 
            <span class="pull-right">Total </span>
            </td>
            <td colspan="1" style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format($net, 2, '.', ','); ?> </td>
          </tr>
          
          <tr>            
            <td class="price-amount" colspan="2"><span class="pull-right">Paid Amount</span></td><div class="clearfix"></div>
            <td style="text-align:right;"><i class="fa fa-inr"></i> <?php echo number_format(showPaid_amount($con, $receipt_no_tbl), 2, '.', ','); ?> </td>
          </tr>
          
      <tr>
      <td colspan="4" rowspan="1" style="border-bottom-left-radius: 4px; text-align:center; border-top-color:transparent; font-style:italic; font-weight:bold;">Receiver's Signature</td>
       <td colspan="2" style="border-bottom-left-radius: 0px; text-align:right;><span class="pull-right">Balance</span></td><div class="clearfix"></div>
	  <?php 		   
        if($bal > 0 || $bal < 0)
            { echo '<td style="background-color: #EE1217; color: #ffffff; font-weight: bold; text-align: right;">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';}
        else{ echo '<td style="background-color::#478C19; text-align: right;">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';} 
     ?>
          </tr>
       </tbody>   
	</table>
     </div> <!--watermark-->
 
<!--<div class="row">
	<div class="reciever-sign pull-right"> <strong>Reciever's Signature</strong> </div>
</div>-->
<div class="row esc-r-footer"> We provide : USG, ECG, Biochemistry, Microbiology, Serology, X-Ray, Clinical Pathology, Histopathology & other Examinations </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; And Participant of External Quality Assurance Program conducted by : Bio - Rad EQAS, USA</div>

</div>   <!-- Table -->

 <!--
	<div class="esc-r-bottom-container">
	<div class="esc-r-bottom-patint-details">
	<div class="row">
		<div class="esc-40 pull-left text-left">Registration No : <strong><?php echo $receipt_no_tbl; ?></strong></div>
		<div class="esc-30 pull-left text-center"><i class="fa fa-calendar fa-fw fa-lg"></i> <?php echo date("d-M-Y", strtotime($pr_date)); ?></div>
		<div class="esc-30 pull-right text-right"><i class="fa fa-clock-o fa-fw fa-lg"></i> <?php echo date("h:i a", strtotime($pr_date)); ?></div>
	</div>
	<div class="row">
		<div class="esc-40 pull-left text-left">Name: <?php echo $patient_name; ?></div>		
		<div class="esc-30 pull-left text-center">
      		<i class="fa fa-male"></i><i class="fa fa-female"></i> : 
			<?php if($pr_patient_gender =='1'){echo "Male, ".$patient_age." years";}
			  elseif($pr_patient_gender =='2'){echo "Female, ".$patient_age." years";} ?>
        </div>
       <div class="esc-30 pull-right text-right"><i class="fa fa-phone fa-fw fa-lg"></i>+91 <?php echo $patient_phone; ?></div>
	</div>
	<div class="row"  style="margin-bottom: 10px;">
		<div class="esc-40 pull-left text-left">Address: <?php echo $patient_address; ?></div>
        <div class="esc-30 pull-left text-center">Patient History: <?php echo $patient_history; ?></div>        
		<div class="esc-30 pull-right text-right">Lab Notes: <?php echo $lab_notes; ?> </div>
     </div>

	
	<table class="table table-bordered table-striped table-hover">
	<thead class="esc-t-head">
		<tr>
		<th style="width:12%;">Sl. No.</th>
		<th> Investigation (Short-form)</th>
		<th style="width:20%;">Category</th>
        <th style="width:10%;">Department</th>
		</tr>
	</thead>
	<tbody>
        <?php 
$result_lab = mysqli_query($con, "SELECT `patient_test`.`PT_test_name`, `test_tbl`.`test_short_form`, `test_category`.`test_category_name`, `department_tbl`.`department_name` FROM `patient_test` LEFT JOIN  `test_tbl` ON `test_tbl`.`test_id` = `patient_test`.`PT_test_id` LEFT JOIN `test_category` ON `test_category`.`test_category_id` = `test_tbl`.`test_category_id` LEFT JOIN `department_tbl` ON `department_tbl`.`department_id` = `test_category`.`TC_dept_id` WHERE `patient_test`.`PT_receipt_no` = '".$receipt_no_tbl."'");
$sl=1;
while ($lab = mysqli_fetch_array($result_lab))
{   
    ?>
          <tr>
            <td> <?php echo $sl; ?> </td>
            <td> <?php echo $lab['PT_test_name']; ?> (<?php echo $lab['test_short_form']; ?>)</td>
            <td> <?php echo $lab['test_category_name']; ?></td>
            <td> <?php echo $lab['department_name']; ?></td>
          </tr>
          <tr>
            <td><?php echo $sl; ?>. Findings </td>
            <td colspan="4"></td>
            
          </tr>
       <?php
 $sl++;
}
?>
        </tbody>	
	</table>	
	
    </div>
    </div>-->
    
<div class="clearfix"></div>
    </div>

<div class="text-center blank">
 <button type="button" class="btn btn-primary btn-large" id="print_btn" style="font-size:16px; width:20%;" onClick="window.print();return false">Print</button>
       
         <a href="patient_table.php" style="color:#FFF;">
          <button type="button" class="btn btn-primary btn-large" style="font-size:16px;width:20%;">List <i class="fa fa-angle-double-right"></i></button>
         </a>
       </div>           
	
<?php require_once("script_bootstrap.php"); ?> 
</body>
<?php } ?>
</html>
<?php } ob_flush();?>