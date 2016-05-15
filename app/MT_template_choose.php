<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Info</title>
<?php require_once("css_bootstrap_datatable_header.php");?>
<body id="myBody">
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">

<?php

if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $pt_sl = $_GET['PT_id'];
 $test_id = $_GET['test_id'];
 
 
 $patient_info = mysqli_query($con, "SELECT r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_status_id, r.pr_dr_prescription, p.PI_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_phone, s.state_name, d.district_name, g.gender_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no = '$receipt_no'");
 
  while($row = mysqli_fetch_array($patient_info))
  {	  
  	  $patient_name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];  	  
	  $patient_id = $row['PI_id'];
	  $address = $row['PI_address'];
	  $pin_code = $row['PI_pin'];
  	  $phone = $row['PI_phone'];
	  
	  $gender_name = $row['gender_name'];
	  $marital_name = $row['marital_name'];
  	  $state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  
  	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	  $pr_date = $row['pr_date'];
	  $pr_status_id = $row['pr_status_id'];
	  $dr_letter = $row['pr_dr_prescription'];	 
	  }
 ?>
<div class="panel panel-success" id="printableArea">     
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     ED/<?php echo $receipt_no;?> <span class="panel_subTitle no-print">( Create Report )</span>
     </div>							  

<div class="panel-body" id="printableArea">
<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
      <td><label>Registration # : </label> ED/<?php echo $receipt_no;?></td>  
      <td><label>Customer ID : </label> <?php echo $patient_id;?></td>
      <td><label><i class="fa fa-calendar"></i> : </label> <?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></td>
    </tr>

  <tr>
  <td colspan="2"><label>Name : </label> <?php echo $patient_name;?></td>
  <td><label><i class="fa fa-male"></i><i class="fa fa-female"></i> : </label> <?php echo $gender_name.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ( '. $marital_name.' )';?></td>
  </tr>
  
  <tr>
  <td><label>Address : </label> 
  <?php if($pin_code !=""){$_pin = ' - '.$pin_code;}else{$_pin = "";} echo $address.', '.$district_name.', '.$state_name.$_pin; ?>
  </td>
   <td><label> <i class="fa fa-phone-square"></i> :</label> <?php if($phone !=""){ echo '+91 '.$phone;}?></td>
  </tr>
 
 <tr>
  <td><label>Dr. Letter : </label> <?php if($dr_letter =='NO'){echo "No";}else{echo "Yes";} ?></td>
  <td><label>Patient History : </label> <?php echo showHistory_patient($con, $patient_id); ?></td>
  <td><label>Lab Notes : </label> <?php echo showLab_note($con, $receipt_no); ?></td>
  </tr>

 <tr> 
  <td><label>Referred By : </label> <?php if($dr_letter =='NO'){echo " Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_letter);} ?></td>
 
  <td><label>Source : </label> 
  <?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?></td>
  </tr>
  </table>
  </div>
<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100">
   <thead align="left">
      <tr>
      <th>Sl. no. </th>
      <th>Investigation</th>
      <th>Status</th>       
      </tr>
   </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT t.PT_sl, t.PT_test_name, s.status_name FROM patient_test t LEFT JOIN status_tbl s ON s.status_id = t.PT_status_id WHERE t.PT_sl = '$pt_sl'");
$sl_no=1;
while ($row = mysqli_fetch_array($result_test))
{   
 	$PT_sl = $row['PT_sl'];
	$test_name = $row['PT_test_name'];
	$status_name = $row['status_name'];
	?>
    <tr id="<?php echo $PT_sl; ?>">
      <td> <?php echo $sl_no; ?> </td>
      <td> <?php echo $test_name; ?> </td>  
      <td><?php echo $status_name; ?> </td>
    </tr>
 <?php $sl_no++; } ?>
 </tbody>   
 </table> 
</div>
</div>

<div class="row padding_top20">
   <div class="form-group">
     <form  action="MT_template_value.php"class="form-inline inv-form" role="form" method="get" id="search_name">
    <div class="form-control-group">    
    <label for="patient_name" class="col-lg-3 control-label text-right"> Template  </label>
    <div class="col-lg-6">
    <select class="form-control" name="marital_status" id="marital_status" required>
    <option value="" class="option_select">Select</option>
    <?php 
    $result=mysqli_query($con, "SELECT TPN_name, TPN_id FROM template_name WHERE TPN_test_id = '$test_id'");
    while($row=mysqli_fetch_array($result))
    { ?>
    <option value="<?php $TPN_id = $row['TPN_id']; echo $TPN_id; ?>" class="option_select"><?php echo $row['TPN_name'];?></option>					 
    <?php } ?>          
    </select>
    <input type="hidden" name="pt_sl" id="receipt_eid" value="<?php echo $pt_sl;?>">
    <input type="hidden" name="tpn_id" value="<?php echo $TPN_id;?>">
    <input type="hidden" name="test_id" value="<?php echo $test_id;?>">
    <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>">    
    </div>
    <button name="name_go" class="btn btn-primary" type="submit">GO</button>
    </div>  
    </form>
    </div>
 
  </div>

<div class="clear"></div> 
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?>
<?php require_once("script_print_bw_div.php");?> 
  </body>
</html>
<?php } ob_flush();?>