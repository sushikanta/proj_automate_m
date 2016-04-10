<?php require_once("check_login_fd.php"); ?>

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
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !='')
 {
  $receipt_no_tbl = $_GET['receipt_no'];
  $result_patient = mysqli_query($con, "SELECT r.pr_date, r.pr_dr_prescription,r.pr_source_id,r.pr_date,r.pr_referred_id, p.PI_id, p.PI_name, p.PI_phone, g.gender_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, s.state_name, d.district_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no = '$receipt_no_tbl'");

  $result_test = mysqli_query($con, "SELECT t.PT_test_name, t.PT_test_price, y.PP_total, y.PP_tax, y.PP_disc,  y.PP_net, y.PP_paid, y.PP_bal FROM patient_test t LEFT JOIN  patient_payment y ON y.PP_receipt_no=t.PT_receipt_no WHERE t.PT_receipt_no = '$receipt_no_tbl' AND t.PT_status_id !='3'");
  while($row1 = mysqli_fetch_array($result_patient))
                {
          			$patient_id = $row1['PI_id'];
					$patient_name = $row1['PI_name'];
					$patient_phone = $row1['PI_phone'];
					$patient_age_y = $row1['PI_age_y'];
					$patient_age_m = $row1['PI_age_m'];
					$patient_age_d = $row1['PI_age_d'];
					$patient_address = $row1['PI_address'];
					$pin = $row1['PI_pin'];

					$pr_date = $row1['pr_date'];
					$dr_letter = $row1['pr_dr_prescription'];
					$source_id = $row1['pr_source_id'];
					$referred_id = $row1['pr_referred_id'];

					$state = $row1['state_name'];
					$district = $row1['district_name'];
					$marital_name = $row1['marital_name'];
					$gender_name = $row1['gender_name'];
				}
			?>

<body>

<div class="container" id="print_div">

       <div class="header">
             <div class="esc-r-header-left">
              <h3 style="line-height:5pt;"><span class="pull-left text-right">Escent Diagnostics Pvt. Ltd</span>
              <span style="font-size:12pt;" class="text-right pull-right"><i class="fa fa-phone-square fa-fw"></i> +91 8731049609</span>
              </h3>
              <div class="clearfix"></div>
              <h5 class="media-heading"><span style="font-size:11pt;">Purana Rajbari, Nongmeibung, Imphal East, Manipur-795001</span>
              <span class="pull-right text-right" style="font-size:10pt;">Regd. No. MNHCR/NO/096/DC/2012</span>
              </h5>

              </div>

            </div>
<div class="watermark">
<div class="esc-pateint-details">  <!-----------------START of patient details------------------>
		<div class="esc-row">
			<div class="pull-left">Registration No : <strong><?php echo 'ED/'.$receipt_no_tbl; ?></strong></div>
			<div class="pull-right"><?php if($patient_phone != ""){echo ' <i class="fa fa-phone-square fa-fw"></i>  +91 '.$patient_phone;} ?></div>
        	<div class="clearfix"></div>
        </div>

        <div class="row text">
                <div class="esc-r-name pull-left">Name : <?php echo $patient_name; ?></div>
                <div class="esc-r-age pull-right text-right"><i class="fa fa-calendar fa-fw"></i> <?php echo date("d/m/Y, h:i a", strtotime($pr_date)); ?>
               </div>
                <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="esc-r-add pull-left">Address : <?php echo $patient_address; ?>, <?php echo $district; ?>, <?php echo $state; ?> <?php if($pin != ""){echo " - ".$pin;} ?></div>
            <div class="esc-r-contact2 pull-right text-right"> <i class="fa fa-male"></i><i class="fa fa-female"></i> : <?php $age =show_age_long($con, $patient_age_y, $patient_age_m, $patient_age_d);
			  echo $gender_name.' / '.$age;  echo ' ('.$marital_name.')'; ?></div>
            <div class="clearfix"></div>
        </div>

    <div class="row">
        <div class="esc-r-add pull-left">Ref. By : <?php if($dr_letter =='NO') {echo "Self"; $dr_phone = "";} else{ $dr_name = showDoctor_name($con, $dr_letter); $dr_phone = showDoctor_phone($con, $dr_letter); echo "Dr. ". $dr_name;} ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>   <!--end patient details -->

<div class="row">
  <!-- Table -->
  <table class="table table-bordered" style="margin: 5px 0px 10px 0px;">
  	<thead class="esc-t-head">
		<tr>
		<th colspan="2" style="padding-left:30px; width:18%">Sl. No.</th>
		<th colspan="3" style="width: 51%;">Investigation</th>
		<th colspan="3" style="text-align:right; width:51%; padding-right:20px;">Amount</th>
		</tr>
	</thead>
	<tbody>
<?php
$sl_no=1;
$_disc_value=showDiscount_value($con, $receipt_no_tbl);
$tax_value=showTax_value($con, $receipt_no_tbl);

while ($rowt = mysqli_fetch_array($result_test))
{
 	$test_name = $rowt['PT_test_name'];
	$test_price = $rowt['PT_test_price'];

	$total = $rowt['PP_total'];
	$tax_option =  $rowt['PP_tax'];
	$disc_option =  $rowt['PP_disc'];
	$bal =  $rowt['PP_bal'];
	$paid =  $rowt['PP_paid'];
	$net = $rowt['PP_net'];

	?>
          <tr>
            <td colspan="2" style="padding-left:30px;"> <?php echo $sl_no; ?>. </td>
            <td colspan='3'> <?php echo $test_name; ?> </td>
            <td colspan="3" style="text-align:right; padding-right:20px;"><i class="fa fa-inr"></i> <?php echo number_format($test_price, 2, '.', ','); ?> </td>
          </tr>
       <?php
 $sl_no++;
}
?>
<!------- Sub total  ------>
          <tr >
           <!-- <td colspan="2" rowspan="3" ></td>-->
            <td colspan="5" style="width:55%; text-align:right;">Sub Total</td>
            <td colspan="3" style="text-align:right; padding-right:20px;"><i class="fa fa-inr"></i> <?php echo number_format($total, 2, '.', ','); ?> </td>
          </tr>

 <!--------TAx ------->
          <tr >
           <!-- <td colspan="2" rowspan="3" ></td>-->
            <td colspan="5" style="width:55%; text-align:right;">Tax <?php echo '('.$tax_value.'%)'; ?></td>
            <td colspan="3" style="text-align:right; padding-right:20px;"><i class="fa fa-inr"></i> <?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc; echo number_format($tax_calc, 2, '.', ','); ?> </td>
          </tr>

     <!----- DISC ---->
          <tr >
           <!-- <td colspan="2" rowspan="3" ></td>-->
            <td colspan="5" style="width:55%; text-align:right;">Discount <?php if($disc_option ==1){ echo '('.$_disc_value.')';} ?></td>
            <td colspan="3" style="text-align:right; padding-right:20px;"><i class="fa fa-inr"></i>
			<?php if($disc_option ==1)  // discount = Yes
				   		$disc_in_amt = showDiscount_in_amt($con, $receipt_no_tbl, $total_after_tax);
					 if($disc_option==2) // discount = NO
					  	{$disc_in_amt = "0.00";}
				$total_after_disc = $total_after_tax - $disc_in_amt;

			    echo number_format($disc_in_amt, 2, '.', ','); ?>
             </td>
          </tr>

 <!-------  Total Amount  ------>
    <tr>
      <td colspan="5" style="border-top-color:transparent; text-align:right;">
        <span class="pull-right" style="color:#333 !important;">Total Amount</span>
     </td>

   <td colspan="3" style="text-align:right;  padding-right:20px;"><i class="fa fa-inr"></i> <?php echo number_format($total_after_disc, 2, '.', ','); ?> </td>
   </tr>

   <!----------- PAID AMOUNT ------>
    <tr>
      <td colspan="5" style="border-top-color:transparent; text-align:right;">
        <span class="pull-right" style="color:#333 !important;">Amount Received</span>
     </td>

   <td colspan="3" style="text-align:right;  padding-right:20px;"><i class="fa fa-inr"></i> <?php echo number_format($paid, 2, '.', ','); ?> </td>
   </tr>

 <!--------- Signature & Balance due ---->
  <tr>
      <td colspan="5" style="border-bottom-left-radius: 4px; border-top-color:transparent; text-align:right;">
      <span style="font-style:italic; padding-right:33%;">Receiver's Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?>)</span>
      <span class="pull-right">Balance Due</span>
      </td><div class="clearfix"></div>

	  <?php
        if($bal > 0 || $bal < 0)
            { echo '<td colspan="3" style="background-color: #EE1217; color: #ffffff; font-weight: bold; font-size: 20px; text-align: right; padding-right:17px">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';}
        else{ echo '<td colspan="3" style="background-color::#478C19; text-align: right; padding-right:20px">'.'<i class="fa fa-inr"></i> '.number_format($bal, 2, '.', ',').'</td>';}
     ?>
          </tr>
       </tbody>
	</table>
     </div> <!--watermark-->


<div class="row esc-r-footer"> We provide : USG, ECG, Biochemistry, Microbiology, Serology, X-Ray, Clinical Pathology, Histopathology & other Examinations </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; And Participant of External Quality Assurance Program conducted by : Bio - Rad EQAS, USA</div>

</div>   <!-- Table -->



<!-- TEST REQUISITION FORM -->

<div>

<label style="margin-top:20px; border-top: 2px dotted #000000; font-weight:bold; font-size:16px; text-decoration: underline;" class="text-center"><br/>TEST REQUISITION FORM</label>
<div>
<table style="margin: 5px 0px 10px 0px;" border="color:transparent;" class="table">
<thead class="esc-t-head">
<tr>
<div class="esc-pateint-details">  <!-----------------START of patient details------------------>

      <div class="row">
      <div class="pull-left line_height2" style="width:16%;">Name of Patient : </div>
      <div class="pull-left line_height2" style="letter-spacing:2px; width: 83%;"><?php echo strtoupper($patient_name); ?></div>
      </div>

      <div class="row">
      <div class="pull-left line_height2" style="width:16%;">Address : </div>
      <div class="pull-left line_height2" style="letter-spacing:2px; width: 83%;">
      <?php echo strtoupper($patient_address); ?>, <?php echo strtoupper($district); ?>, <?php echo strtoupper($state); ?> <?php if($pin != ""){echo " - ".$pin;} ?>
      </div>
      </div>

      <div class="row">
      <div class="pull-left line_height2" style="width:16%;">ED NO. : </div>
      <div class="pull-left line_height2" style="letter-spacing:2px; width: 83%;"> <strong><?php echo $receipt_no_tbl; ?></strong></div>
      </div>

      <div class="row">
      <div class="pull-left line_height2" style="width:16%;">Age : </div>
      <div class="pull-left line_height2" style="width: 30%;"> <?php echo $patient_age_y .' / '.$patient_age_m .' / '.$patient_age_d; ?> &nbsp&nbsp&nbsp yrs/m/days</div>

      <div class="pull-left line_height2" style="width:5%;">Sex : </div>
      <div class="pull-left line_height2" style="width: 18%;"> <?php echo $gender_name; ?></div>

      <div class="pull-left text-right line_height2" style="width:12%;">Contact No. : </div>
      <div class="pull-left text-right line_height2" style="width: 15%;"> <?php if($patient_phone != ""){echo '+91 '.$patient_phone;} ?></div>
      </div>


       <div class="row" style="padding-top: 10px;">
      <div class="pull-left" style="width:16%;">Refd. By : </div>
      <div class="pull-left" style="letter-spacing:2px; width: 83%;"><?php if($dr_letter =='NO') {echo "Self";} else{ echo "Dr. ". $dr_name;} ?>
      </div>
      </div>

       <div class="row">
      <div class="pull-left line_height2" style="width:16%;">Contact No.: </div>
      <div class="pull-left line_height2" style="width: 83%;"><?php if($dr_letter =='NO'){ echo '_________________';} else {$dr_phone = showDoctor_phone($con, $dr_letter); if($dr_phone !='')echo '_________________'; else echo "+91".$dr_phone; }?>
      </div>
      </div>

       <div class="row" style="padding-top: 10px;">
      <div class="pull-left line_height2" style="width:16%;">Sample Description : </div>
      <div class="pull-left line_height2" style="width: 83%;">PLAIN / EDTA / FLUORIDE / CITRATE / AND _________________________________________________
      </div>
      </div>

      <div class="row">
      <div class="pull-left line_height2" style="width:25%;">Date and Time of Collection : </div>
      <div class="pull-left line_height2" style="width: 20%;">_____/_______/________ </div>
      <div class="pull-left line_height2" style="width: 20%;"> AT ____ : ____ &nbsp AM / PM</div>
      </div>

      <div class="row" style="padding-top: 20px;">
      <div class="pull-left line_height2" style="width:16%;">Test / Investigation : </div>
      <div class="pull-left line_height2" style="width: 83%; text-decoration: underline;"><?php echo allTestSl_ED($con, $receipt_no_tbl); ?></div>
      </div>

      <div class="row">
      <div class="pull-left line_height2" style="width:16%; padding-top: 10px;">CASE HISTORY : </div>
      <div class="pull-left line_height2" style="width: 83%; text-decoration: underline;  padding-top: 10px;""><?php  $lab_note = showLab_note($con, $receipt_no_tbl);  $case_history = showHistory_patient($con, $patient_id); if($case_history !=""){echo $case_history;} else{ echo  "______________________________________________________________________________________";} ?></div>
      </div>

    <div class="row" style="padding-top: 30px;">
      <div class="pull-left line_height2" style="width:30%;">Signature of Phlebotomist : </div>
      <div class="pull-left line_height2" style="width:20%;">LAB Receipt Time : </div>
      <div class="pull-left line_height2" style="width:30%;">Signature of Receiving Person : </div>
      <div class="pull-left line_height2" style="width:20%;">Date : </div>
     </div>


    <div class="row">

      <!--<div class="pull-left" style="width:30%;"><?php echo date("d/m/Y, h:i A", strtotime($pr_date));?> </div>-->
      </div>


<?php if($lab_note !=""){ ?>
        <div class="row">

        <div class="pull-left" style="width:25%;">Lab Note : </div>
      <div class="pull-left" style="width:30%;"><?php echo showLab_note($con, $receipt_no_tbl); ?> </div>
    </div>
    <?php }?>
    </th>
    </thead>
    </table>
</div>   <!--end patient details -->


     </div>

<div class="clearfix"></div>
    </div>

<div class="text-center blank">
 <button type="button" class="btn btn-primary btn-large" id="print_btn" style="font-size:16px; width:20%;" onClick="window.print();return false"><i class="fa fa-print"></i> PRINT</button>
   <button type="button" class="btn btn-primary btn-large" onclick="window.close()" style="font-size:16px;width:20%;"><i class="fa fa-times"></i> CLOSE </button>
   <a style="color:#FFF;" href="patient_registration.php">
    <button type="button" class="btn btn-primary btn-large" style="font-size:16px;width:20%;"> BACK <i class="fa fa-angle-double-right"></i> </button>
    </a>
 </div>

 <div class="clearfix"></div>
    </div>

<?php require_once("script_bootstrap.php"); ?>
</body>
</html>
<?php } ob_flush();?>
