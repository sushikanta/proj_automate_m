<?php require_once("check_login_admin.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Discount List</title>
  <?php include("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
 <div class="inv-main">

<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
  List <span class="panel-subTitle"> ( Discount - Today ) </span>
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  </h3>
     </div>

<?php
$today = date("Y-m-d");
$result = mysqli_query($con, "SELECT d.disc_code_sl, d.disc_type, d.disc_value, d.disc_remark, d.disc_user, d.disc_status_date, d.disc_receipt_no, p.PI_name, p.PI_address, r.pr_dr_prescription, r.pr_source_id, r.pr_referred_id FROM discount_tbl d LEFT JOIN patient_registration r ON r.pr_receipt_no = d.disc_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE DATE_FORMAT(d.disc_status_date,'%Y-%m-%d') = '".$today."' ORDER BY d.disc_status_date DESC");
$sl_no=1;

if(mysqli_num_rows($result) ==0){echo 'No Discounted ED today !';} else{
?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
<thead align="left">
  <tr>
      <th> # </th>
      <th> Disc Code</th>
      <th> Value</th>
      <th> Remark</th>
      <th> Discount Date</th>
      <th> Reg. ID</th>
      <th> Name</th>
      <th> Address</th>
      <th> Referred By</th>
      <th> Source</th>
  </tr>
</thead>
<tbody>
<?php
while ($row = mysqli_fetch_array($result))
{
	$disc_code_sl = $row['disc_code_sl'];
	$disc_type = $row['disc_type'];
	$disc_value = $row['disc_value'];
	$disc_remark = $row['disc_remark'];
	$disc_user = $row['disc_user'];
	$disc_status_date = $row['disc_status_date'];
	$disc_receipt_no = $row['disc_receipt_no'];
	$PI_name = $row['PI_name'];
	$PI_address = $row['PI_address'];
	$pr_dr_prescription = $row['pr_dr_prescription'];
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
?>
 <tr id="<?php echo $disc_code_sl; ?>">
    <td><?php echo $sl_no; ?> </td>
    <td style="color:#00F;">D/<?php echo $disc_code_sl; ?> </td>

	<td style="color:#00F;;"><?php if($disc_type =='1'){echo $disc_value."%";}elseif($disc_type =='2'){echo '<i class="fa fa-inr"></i> '.$disc_value;} ?></td>
    <td><?php echo $disc_remark; ?> </td>
    <td><?php echo date("d/m/Y, h:i a", strtotime($disc_status_date)); ?> </td>
    <td>ED/<?php echo $disc_receipt_no; ?> </td>
    <td><?php echo $PI_name; ?> </td>
    <td><?php echo $PI_address; ?> </td>
    <td><?php if($pr_dr_prescription =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?></td>
    <td><?php $referral = showReferral($con, $pr_source_id, $pr_referred_id); if ($referral !=""){echo $referral.', ';} echo showSourceName($con, $pr_source_id); ?></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
 <?php

}
?>
<div class="clear"></div>
</div>

<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php"); ?>
</body>
</html>
<?php ob_flush();?>