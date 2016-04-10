<?php require_once("check_login_fd.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Royalty Card</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-receipt.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-print.css"  media="print"/>
<link href="font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet"/>
</head>
    <!-- Bootstrap -->
<?php
if(isset($_GET['pid']) && $_GET['pid'] !='')
 {
  $pid = $_GET['pid'];
  $cid = $_GET['cid'];
  $result = mysqli_query($con, "SELECT p.*, d.DH_id FROM patient_info p LEFT JOIN discount_holder d ON p.PI_id = d.DH_patient_id WHERE d.DH_id = '$pid'");

  while($row = mysqli_fetch_array($result))
        {
          $patient_name = $row['PI_name'];
					$patient_phone = $row['PI_phone'];
					$pr_patient_gender = $row['PI_gender_id'];
					$PI_marital_id = $row['PI_marital_id'];
					$patient_age_y = $row['PI_age_y'];
					$patient_age_m = $row['PI_age_m'];
					$patient_age_d = $row['PI_age_d'];
					$patient_address = $row['PI_address'];
					$state = $row['PI_state_id'];
					$district = $row['PI_district_id'];
					$pin = $row['PI_pin_id'];
					$date_added = date("d-M-Y", strtotime($row['PI_date']));
					$card_id = $row['DH_id'];
				}
			?>
<body>
<div class="container" id="print_div">

       <div class="header">
             <div class="esc-r-header-left">
              <h3 style="line-height:5pt;"><span class="pull-left text-right">Royalty Card</span></h3>
             </div>
       </div>
<div>
<div class="esc-pateint-details">  <!-----------------START of patient details------------------->
		<div class="esc-row">
			<div class="pull-left">Card No : <strong><?php echo $card_id; ?></strong></div>
			<div class="pull-right"><?php if ($patient_phone =='0'){echo "";}else{ echo '<i class="fa fa-phone-square fa-fw"></i> +91 '.$patient_phone;} ?></div>
        	<div class="clearfix"></div>
        </div>

        <div class="row text">
                <div class="esc-r-name pull-left">Name : <?php echo $patient_name; ?></div>
                <div class="esc-r-age pull-right text-right"><i class="fa fa-calendar fa-fw"></i> <?php echo $date_added; ?>
               </div>
                <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="esc-r-add pull-left">Address : <?php echo $patient_address; ?>, <?php echo showDistrictName($con, $district); ?>, <?php echo showStateName($con, $state); ?> <?php if($pin == "0"){echo "";}else{echo " - ".$pin;} ?></div>
            <div class="esc-r-contact2 pull-right text-right"> <i class="fa fa-male"></i><i class="fa fa-female"></i> : <?php $marital_status = show_marital_status($con, $PI_marital_id); if($marital_status ==''){echo '';}else{echo $marital_status;} echo ' ('.show_gender_long($con, $pr_patient_gender).'), '.show_age_long($con, $patient_age_y, $patient_age_m, $patient_age_d);?></div>
            <div class="clearfix"></div>
        </div>



</div>   <!--end patient details -->


 <!--------------------------------- Signature & Balance due-------------------------------------->
  <tr>
      <td colspan="5" style="border-bottom-left-radius: 4px; border-top-color:transparent; text-align:right;">
      <span style="font-style:italic; padding-right:33%;">Receiver's Signature (<?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?>)</span>
      <span class="pull-right">Balance Due</span>
      </td><div class="clearfix"></div>


          </tr>
       </tbody>
	</table>
     </div> <!--watermark-->


<div class="row esc-r-footer">Escent Diagnostics Pvt. Ltd Purana Rajbari, Nongmeibung, Imphal East, Manipur-795001 Regd. No. MNHCR/NO/096/DC/2012</div>

</div>   <!-- Table -->





<div class="text-center blank">
 <button type="button" class="btn btn-primary btn-large" id="print_btn" style="font-size:16px; width:20%;" onClick="window.print();return false"><i class="fa fa-print"></i> PRINT</button>

   <button type="button" class="btn btn-primary btn-large" onclick="window.close()" style="font-size:16px;width:20%;"><i class="fa fa-times fa-lg"></i> CLOSE </button>
   </a>
 </div>

 <div class="clearfix"></div>
    </div>

<?php require_once("script_bootstrap_datatable.php"); ?>
</body>
</html>
<?php } ob_flush();?>