<?php include("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search for Discount - Admin</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head> 
<body>
<?php include("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">

<div class="inv-main">	
  <div class="panel panel-success">  <!----------------------START Employee Information-------------->
	<div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Search & Add Discount
	<span class="text-right pull-right" style="font-size:14px !important; color:#A400DF; width:58%;"><i class="fa fa-calendar"></i> <span id="show_date"></span>
	<?php 
	$current_receipt_no = "ED/".date( "dmy", strtotime(date("Y-m-d")))."/".CounterValueOnly($con, 14); 
	$check = checkCurrent_receipt_no($con, $current_receipt_no); 
	if($check === "Yes"){} 
	else{?><a  class="text-left pull-left" href="discount_create.php?receipt_no=<?php echo $current_receipt_no;?>" style="color:#F00A61; font-weight:bold;"><?php echo "Current Registration ID : ".$current_receipt_no;?></a>
	<?php }?>
    </span>
    
    
    </h3>    
</div>                     
                    
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-bordered display" id="p_list_table">
<thead align="left">
<tr>
<th style="width:1%;"> # </th>
<th style="width:1%;"> Reg. ID</th>
<th> Name</th>
<th style="width:5%;"> <i class="fa fa-male"></i><i class="fa fa-female"></i></th>
<th> <i class="fa fa-home"></i> Address</th>
<th style="width:14%;"> <i class="fa fa-calendar"></i> Registered on</th>
<th style="width:1%;"><i class="fa fa-flask fa-lg"></th>
<th style="width:7%;">Amount</th>
<th> Ref By (Source)</th>
<th style="width:7%;"> Status</th>
<th style="width:1%;">Add</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `patient_registration`.*, `patient_info`.`PI_name`, `patient_info`.`PI_address`, `patient_info`.`PI_age`, `patient_info`.`PI_gender_id`, `patient_payment`.* FROM `patient_registration` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_registration`.`pr_patient_id` LEFT JOIN `patient_payment` ON `patient_payment`.`PP_receipt_no` = `patient_registration`.`pr_receipt_no` LEFT JOIN `discount_tbl` ON `discount_tbl`.`disc_receipt_no` = `patient_payment`.`PP_receipt_no` WHERE `discount_tbl`.`disc_receipt_no` IS NULL ORDER BY  `patient_registration`.`pr_date` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$pr_patient_id = $row['pr_patient_id'];
	$pr_receipt_no = $row['pr_receipt_no'];
	$pr_dr_letter = $row['pr_dr_prescription'];
	
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
    <td class="readonly-bg"><?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $row['pr_receipt_no']; ?> </td>  
	<td class="readonly-bg"><?php echo $row['PI_name']; ?> </td>
    <td class="readonly-bg"><?php if($row['PI_gender_id'] =='1'){ echo "M/".$row['PI_age'];} else if($row['PI_gender_id'] =='2'){ echo "F/".$row['PI_age'];} ?> </td>  
    <td class="readonly-bg"><?php echo $row['PI_address']; ?> </td>   
    <td class="readonly-bg"><?php echo date("d/m/Y, h:i a", strtotime($row['pr_date'])); ?> </td>
	<td class="readonly-bg"><abbr title="No.of Investigation"><?php echo showTotal_test($con, $row['pr_receipt_no']); ?></abbr></td>  
    <td class="readonly-bg"><?php echo '<i class="fa fa-inr"></i> '.$row['PP_net']; ?> </td>  
	<td class="readonly-bg">
	<?php 
	
	if($pr_dr_letter =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $pr_dr_letter);} 
		
	if($row['pr_source_id'] =='2')
	   {	   
	   echo  " (".showReferral($con, $row['pr_source_id'], $row['pr_referred_id']). " <span style='font-style:italic; color: #00f;'> ".showSourceName($con, $row['pr_source_id'])."</span> - ".'<span style="color:red; font-weight: bold;">'.countNumberOfReferred($con, $row['pr_source_id'], $row['pr_referred_id']).'</span>)';	   
	   } 
	else 
	   { echo " (".showReferral($con, $row['pr_source_id'], $row['pr_referred_id']). " <span style='font-style:italic; color: #00f;'> ".showSourceName($con, $row['pr_source_id'])."</span>)"; } 
	
	?>
    </td>    
    <td class="readonly-bg"><?php echo showStatus($con, $row['pr_status_id']); ?> </td>    
    
    <td><a href="discount_create.php?patient_id=<?php echo $pr_patient_id ;?>&receipt_no=<?php echo $pr_receipt_no;?>"><i class="fa fa-plus-square fa-lg"></i> </a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<div class="clear"></div>
</div>

<?php include("footer.php"); ob_flush();?> 
<?php include("script_bootstrap_datatable.php"); ?>     
<script charset="utf-8" type="text/javascript">

$(document).ready(function() {	
    
  $('#p_list_table').dataTable( {        

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
		  $('.dataTables_length select').css('float', 'left');		 
	   }
				
     })
});

</script>
</body>
</html>
<?php } ?>