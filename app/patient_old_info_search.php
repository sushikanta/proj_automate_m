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
<title>FD - Search & Register</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header.php"); ?>
<div class="container">
 <div class="page-content">

<div class="inv-main">	
  <div class="panel panel-success">  <!----------------------START Patient list-------------->
	<div class="panel-heading"  style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i>Registration for Old Patient
     	<span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="patient_table.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     </h3>
    </div>                                      
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="p_list_table">
<thead align="left">
  <tr>
      <th> # </th>
      <th> Name </th>
      <th style="width:6%;"> <i class="fa fa-male"></i> <i class="fa fa-female"></i></th>
      <th> <i class="fa fa-home"></i> Address </th>
      <th style="width:11%;"> <i class="fa fa-phone"></i> Phone </th>
      <th style="width:15%;"> <i class="fa fa-calendar"></i> First Registered on </th>      
      <th> <abbr title="Total Collected Amount from Patient">Col-Amt</abbr></th>
      <th style="width:3%;"> New </th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_info`.*, `district_tbl`.`district_name`, `state_tbl`.`state_name`, `pin_tbl`.`pin_code` FROM `patient_info`
LEFT JOIN `district_tbl` ON `district_tbl`.`district_id` = `patient_info`.`PI_district_id`
LEFT JOIN  `state_tbl` ON `state_tbl`.`state_id` = `patient_info`.`PI_state_id`
LEFT JOIN `pin_tbl` ON `pin_tbl`.`pin_id` = `patient_info`.`PI_pin_id` ORDER BY  `patient_info`.`PI_id` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 	<tr id="<?php echo $row['pr_receipt_no'] ; ?>">
      <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo $row['PI_name']; ?> </td>
      <td class="readonly-bg"><?php if($row['PI_gender_id'] =='1'){ echo "M / ".$row['PI_age'];} elseif($row['PI_gender_id'] =='2'){ echo "F / ".$row['PI_age'];} ?> </td>  
      <td class="readonly-bg"><?php echo $row['PI_address']; ?>, <?php echo $row['district_name'].', '.$row['state_name']; ?><?php if($row['PI_pin_id'] == "0"){echo "";}else{echo " - ".$row['PI_pin_id'];} ?></td>
      <td class="readonly-bg"><?php echo "+91 ".$row['PI_phone']; ?> </td>
      <td class="readonly-bg"><?php echo  date("d/m/Y, h:i a", strtotime($row['PI_date'])); ?> </td>      
      <td class="readonly-bg"><?php echo  '<i class="fa fa-inr"></i> <abbr title="Total Collected Amount">'.showOverallAmt_patient($con, $row['PI_id']).'</abbr>'; ?> </td>      
      <td>
      <abbr title="Click to create new registration">
      <a href="patient_registration_from_search.php?patient_id=<?php echo $row['PI_id'];?>"> <i class="fa fa-plus-square fa-lg"></i></a>
      </abbr>
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
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>     
<script charset="utf-8" type="text/javascript">
$(document).ready(function(){	
    
  $('#p_list_table').dataTable({        

		"bJQueryUI": true,
		"bPaginate": true,
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
<?php } ob_flush();?>