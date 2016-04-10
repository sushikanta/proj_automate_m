﻿<?php require_once("function.php");
ob_start();
session_start();

if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2' || $_SESSION['user_dept_id'] == '3')
 {
	 $type = $_GET['type'];
	 if($type =='22'){$pass_source_id = $_GET['source_id'];}
?>
<!DOCTYPE html>
<html>
<head>
<title>Balance Sheet All</title>
  <?php require_once("css_bootstrap_datatable_header.php");?> 
  <?php require_once("print-borderless-tbl.php"); ?>  
</head>
<body>
<?php if($_SESSION['user_dept_id'] == '2'){require_once("right_top_header_admin.php");} else if($_SESSION['user_dept_id'] == '3'){require_once("right_top_header.php");}?>
<div class="container">
 <div class="page-content">
 <div class="inv-main">        
  <div class="panel panel-success">
  
  <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> FD - <span class="panel-subTitle">  Balance Sheet All</span>
   
   <button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
    <button type="button" onclick="tableToExcel('p_list_table', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button> <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> 
    <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
   
     </h3>
   </div>

   <div class="panel-body">                             
  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="p_list_table">
  <thead align="left">
	 <tr>
      <th colspan="11" class="text-center" id="th_bg_color">Balance Sheet ( <?php if($type =='22'){ echo showSourceName($con, $pass_source_id).'s, on'; } else{ echo 'ALL, on';} ?> <?php echo date("d/m/Y h:i a", time());?> )</th>
     </tr>
  <tr>
      <th class="text-center">SL</th>
      <th>Referred by</th>
      <th>Src Name (Type)</th>
      <th>Reg ID</th>
      <th>Name</th>
      <th class="text-center"><i class="fa fa-male"></i><i class="fa fa-female"></i></th>
      <th><i class="fa fa-home"></i> Address</th>
      <th class="no-print"><i class="fa fa-phone"></i> Phone</th>
      <th><i class="fa fa-calendar"></i> Date</th>    
      <th class="text-right"> Bal </th>
      <th class="no-print text-center"> <i class="fa fa-edit"></i> </th>
  </tr>
</thead>
<tbody>
<?php
if($type =='11'){
$result = mysqli_query($con, "SELECT patient_registration.pr_receipt_no, patient_registration.pr_date, patient_registration.pr_dr_prescription, patient_registration.pr_source_id, patient_registration.pr_referred_id, patient_info.PI_name, patient_info.PI_marital_id,  patient_info.PI_gender_id, patient_info.PI_age_y, patient_info.PI_age_m, patient_info.PI_age_d, patient_info.PI_address, patient_info.PI_district_id, patient_info.PI_state_id, patient_info.PI_pin_id, patient_info.PI_phone, patient_payment.PP_bal FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN patient_info ON patient_info.PI_id =  patient_registration.pr_patient_id WHERE patient_payment.PP_bal !=0 ORDER BY patient_registration.pr_source_id ASC");
}

if($type =='22'){
$result = mysqli_query($con, "SELECT patient_registration.pr_receipt_no, patient_registration.pr_date, patient_registration.pr_dr_prescription, patient_registration.pr_source_id, patient_registration.pr_referred_id, patient_info.PI_name, patient_info.PI_marital_id,  patient_info.PI_gender_id, patient_info.PI_age_y, patient_info.PI_age_m, patient_info.PI_age_d, patient_info.PI_address, patient_info.PI_district_id, patient_info.PI_state_id, patient_info.PI_pin_id, patient_info.PI_phone, patient_payment.PP_bal FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_payment.PP_bal !=0 AND patient_registration.pr_source_id = '$pass_source_id' ORDER BY patient_registration.pr_source_id ASC");
}


$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
      <td class="readonly-bg text-center"><?php echo $sl_no; ?></td>  
     
<td style="color:#00F;"><?php if ($row['pr_dr_prescription'] =='NO'){echo "Self";} else{echo 'Dr. '.showDoctor_name($con, $row['pr_dr_prescription']);} ?></td>  
      
<td><?php echo  showReferral($con, $row['pr_source_id'], $row['pr_referred_id']); ?><br/> (<?php echo showSourceName($con, $row['pr_source_id']);?>) </td>  
      <td style="cursor:not-allowed;">ED/<?php echo $row['pr_receipt_no']; ?></td>  
      <td class="readonly-bg"><?php echo $row['PI_name']; ?></td>
       <td style="cursor:not-allowed;"><?php $marital_status = show_marital_status($con, $row['PI_marital_id']); if($marital_status ==''){echo '';}else{echo $marital_status;} echo '('.show_gender_short($con, $row['PI_gender_id']).')<br/>'.show_age_long($con, $row['PI_age_y'], $row['PI_age_m'], $row['PI_age_d']);?></td>  
      <td class="readonly-bg"> <?php echo $row['PI_address']; ?>, <?php $district = showDistrictName($con, $row['PI_district_id']); if($district == "0"){echo "";}else{echo " - ".$district;} ?>, <?php echo showStateName($con,$row['PI_state_id']); ?> <?php if($row['PI_pin_id'] == "0"){echo "";}else{echo " - ".$row['PI_pin_id'];} ?>
      <td class="readonly-bg no-print"><?php if($row['PI_phone'] == "0"){echo "";}else{echo "+91".$row['PI_phone'];} ?></td>
      <td class="readonly-bg"><?php echo  date("d/m/Y", strtotime($row['pr_date'])); ?> </td>      
      
   
   <?php $bal = $row['PP_bal']; 
   		if($bal > 0 || $bal < 0)
			{ echo '<td style="color:#EE1217; text-align: right;">'.number_format($bal,'2','.','').'</td>';}
		else{ echo '<td style="color:#478C19;">'."0.00".'</td>';}?>
      <td class="no-print text-center">
      <button onclick="window.open('fd_registration_view.php?receipt_no=<?php echo $row['pr_receipt_no'];?>&type=<?php echo $type;?>');"> <i class="fa fa-stack-exchange"></i></button>
      </td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>
<?php require_once("script_saveto_excel.php"); ?>  
<script>
// JavaScript Document - patient_table

$(document).ready(function() {	
    
  $('#p_list_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
		"bScrollY": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,

		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');  }
	   		
	})
});

</script> 
</body>
</html>
<?php ob_flush(); } ?>