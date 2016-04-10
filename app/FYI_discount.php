<?php require_once("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')
 {
?>
<!DOCTYPE html>
<html>
<?php require_once("css_bootstrap_datatable_header.php");?> 
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">
 
<div class="panel panel-success">  <!----------------------START Employee Information-------------->
     <div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-refresh fa-spin fa-lg fa-fw"></i> Discount table
     <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?></span>  
     
     </h3>
     </div>
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="disc_table">
<thead align="left">
  <tr>
      
      <th> # </th>
      <th> Reg. ID</th>   
      <th> Name</th>
      <th> Address</th>
      <th> Referred by</th>
      <th> Disc Code</th>
      <th> Value</th>
      <th> Remark</th>
      <th> Status</th>
      <th> <i class="fa fa-calendar"></i> Last update on</th>
      <th class="text-center">Update</th>
      
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `discount_tbl`.*, `patient_info`.`PI_name`, `patient_info`.`PI_address` FROM `discount_tbl` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `discount_tbl`.`disc_patient_id` ORDER BY `discount_tbl`.`disc_code_sl` DESC ");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$disc_code_sl = $row['disc_code_sl'];
	$receipt_no = $row['disc_receipt_no'];
	
	$patient_id = $row['disc_patient_id'];
?>
 <tr id="<?php echo $row['disc_code_sl']; ?>">
    
    <td><?php echo $sl_no; ?> </td> 
    <td style="color:#00F;"><?php echo $row['disc_receipt_no']; ?> </td>   
    <td><?php echo $row['PI_name']; ?> </td> 
    <td><?php echo $row['PI_address']; ?> </td>    
    <td><?php	
	if($row['disc_source_id'] =='2')
	   { $count = countNumberOfReferred($con, $row['disc_source_id'], $row['disc_referred_id']);}
         $referral = showReferral($con, $row['disc_source_id'], $row['disc_referred_id']);
		 if($row['disc_source_id'] =='1') 
	   { echo "Dr. ".$referral; } 
	elseif($row['disc_source_id'] =='2')
	   { echo $referral.' (Staff-'.$count.')';} 
	else 
	   { echo $referral. " (".showSourceName($con, $row['disc_source_id']).")"; } 
		 ?>
     </td>
    <td style="color:#017009;"><?php echo $row['disc_code']; ?> </td>    
  	<td style="color:#017009;"><?php if($row['disc_type'] =='1'){echo  $row['disc_value']."%";}elseif($row['disc_type'] =='2'){echo '<i class="fa fa-inr"></i> '.$row['disc_value'];} ?></td>
    <td><?php echo $row['disc_remark']; ?> </td>
    <?php if ($row['disc_status'] =='1'){echo '<td style=" font-style:italic; color:#00F;">'.'New'.'</td>';} elseif ($row['disc_status'] =='2'){echo '<td style="font-style:italic; color:#F00;">'.'Used'.'</td>';}?>
    <td><?php echo date("d-M-Y, h:i a", strtotime($row['disc_status_date'])); ?> </td>
    <td class="text-center">
    <abbr title="Click & press on 'Update Payment' to use discount">
      <?php if ($patient_id !=""){ ?> <a href="patient_registration_detail.php?receipt_no=<?php echo $receipt_no;?>"><i class="fa fa-plus-circle fa-fw fa-lg"></i></a> <?php } else {?><a href="patient_registration.php"><i class="fa fa-plus-circle fa-fw fa-lg"></i></a><?php } ?>
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

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?> 
<script charset="utf-8" type="text/javascript" >
$(document).ready(function() {				
 				
// Discount table - editable datatable

$('#disc_table').dataTable( {        

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
<?php }?>