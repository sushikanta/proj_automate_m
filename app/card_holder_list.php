<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>Card Holder List</title>
   <?php require_once("css_bootstrap_datatable_header.php"); ?> 
   <?php require_once("print-borderless-tbl.php"); ?>  
</head>
<body id="myBody">
<?php require_once("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">	
 
  <div class="panel panel-success">  <!----------------------START Patient list-------------->
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> List  <span class="panel_subTitle no-print">( Card Holder )</span>
        
        <!------------ Print & SAve------------>     
   
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('p_list_table', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
  
     </h3>
    </div> 
<div class="panel-body">                              
                               
<table cellpadding="0" cellspacing="0" border="0" class="table-condensed table-hover table-striped width_100">
<thead align="left">
  <tr>
      <th>#</th>
      <th>Card #</th>
      <th>Name</th>
      <th><i class="fa fa-male"></i><i class="fa fa-female"></i></th>
      <th><i class="fa fa-home"></i> Address</th>
      <th><i class="fa fa-phone"></i> Phone</th>
      <th><i class="fa fa-calendar"></i> Date</th>      
      <th>Disc(%)</th>
      <th>Status</th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT c.DH_id, c.DH_patient_id, c.DH_disc_per, c.DH_user, c.DH_validity, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_pin, p.PI_address, p.PI_phone, p.PI_date,  p.PI_card, m.marital_name, g.gender_name, s.state_name, d.district_name FROM card_holder c LEFT JOIN patient_info p ON c.DH_patient_id = p.PI_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$DH_id = $row['DH_id'];
	$DH_user = $row['DH_user'];
	$PI_age_m = $row['PI_age_m'];
	$PI_age_y = $row['PI_age_y'];
	$PI_age_d = $row['PI_age_d'];
	$PI_name = $row['PI_name'];
	$gender_name = $row['gender_name'];
	$marital_name = $row['marital_name'];
	
	$PI_address = $row['PI_address'];
	$state = $row['state_name'];
	$district = $row['district_name'];
	$PI_pin = $row['PI_pin'];
	$PI_card = $row['PI_card'];
?>
 <tr id="<?php echo $DH_id ; ?>">
      <td class="readonly-bg"> <?php echo $sl_no; ?> </td>  
      <td style="color:#00F; cursor:not-allowed;"><?php echo 'LC/'.$DH_id; ?> </td>  
      <td class="readonly-bg"><?php echo $PI_name; ?> </td>
      <td style="cursor:not-allowed;">
	  <?php echo show_age_long($con, $PI_age_y, $PI_age_m, $PI_age_d);?> / <?php echo $gender_name; ?> (<?php echo $marital_name; ?>)
      </td>  
  <td class="readonly-bg"><?php echo $row['PI_address'].', '.$district.', '.$state ?> <?php if($PI_pin !=''){echo ' - '.$PI_pin;} ?> </td>
  
      <td class="readonly-bg"><?php if ($row['PI_phone'] =='0'){echo "";}else{ echo '+91 '.$row['PI_phone'];} ?></td>
      <td class="readonly-bg"><?php echo date("d/m/Y", strtotime($row['PI_date'])); ?> </td>      
      <td class="bold_font text-center"><?php echo $row['DH_disc_per']; ?></td>
      <td style="font-style:italic; color: #33C;"><?php echo showCard_status($con, $PI_card);?></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

</div>
<div class="clear"></div>
</div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?> 
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>      
</body>
</html>
<?php ob_flush();?>