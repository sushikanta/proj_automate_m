<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Discount Today</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">

<div class="panel panel-success">  <!-- START Employee Information -->
     
 <div class="panel-heading light_purple_color">
  <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
  Discount <span class="panel_subTitle no-print">( Today )</span>
  <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  </h3>
  </div>
<?php
$today_date = date("Y-m-d");
$result = mysqli_query($con, "SELECT d.disc_code_sl, d.disc_receipt_no, d.disc_type, d.disc_value, d.disc_remark, d.disc_status_date, d.disc_user, p.PI_name, p.PI_address, r.pr_dr_prescription, r.pr_patient_id, r.pr_source_id, r.pr_referred_id FROM discount_tbl d LEFT JOIN patient_registration r ON r.pr_receipt_no = d.disc_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE DATE_FORMAT(d.disc_status_date,'%Y-%m-%d')  = '".$today_date."' ORDER BY d.disc_status_date DESC");
if(mysqli_num_rows($result) ==0){ echo 'No Discount today !';} else{
?>                            
<table cellpadding="0" cellspacing="0" border="0" class=" table-striped table-hover" id="disc_table" style="width:100%;">
<thead align="left">
  <tr>      
      <th> # </th>
      <th> EID</th>   
      <th> Name</th>
      <th> Address</th>
      <th> Code</th>
      <th> Disc Value</th>
      <th> Remark</th>
      <th> Date</th>
      <th class="text-center"> Receipt</th>      
  </tr>
</thead>
<tbody>
<?php
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$disc_code_sl = $row['disc_code_sl'];
	$disc_receipt_no = $row['disc_receipt_no'];
	$disc_type = $row['disc_type'];
	$disc_remark = $row['disc_remark'];
	$disc_date = $row['disc_status_date'];
	$disc_value = $row['disc_value'];
	
	$pr_dr_letter = $row['pr_dr_prescription'];	
	$patient_id = $row['pr_patient_id'];
	$source_id=$row['pr_source_id'];
	$referred_id=$row['pr_referred_id'];
  ?>
 <tr id="<?php echo $row['disc_code_sl']; ?>">
    
    <td><?php echo $sl_no; ?> </td> 
    <td style="color:#00F;">ED/<?php echo $row['disc_receipt_no']; ?></td>   
    <td><?php echo $row['PI_name']; ?></td>
    <td><?php echo $row['PI_address']; ?></td>
    <td style="color:#017009;"><?php echo 'D/'.$disc_code_sl; ?></td>    
  	<td style="color:#017009;">
	<?php if($disc_type =='1'){echo  $disc_value."%";}
	elseif($disc_type =='2'){echo '<i class="fa fa-inr"></i> '.$disc_value;} ?>
    </td>
    <td><?php echo $disc_remark; ?></td>
    <td><?php echo date("d/m/Y, h:i a", strtotime($disc_date)); ?></td>
    
    <td class="no-print text-center" title="View Receipt">
      <form action="patient_receipt.php" role="form" method="get" target="_blank" class="form_receipt">
      <input type="hidden" name="receipt_no" value="<?php echo $disc_receipt_no;?>"/>
      <button type="submit"><i class="fa fa-print"></i></button>
      </form>
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

/*$('#disc_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,	
		"bInfo": false,		

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
    })*/
	
	//discount_link
	$('.form_disc').submit(function() {	
        window.open('', 'discount_update_fd.php', "width=750,height=450,resizeable,scrollbars");
        this.target = 'discount_update_fd.php';
    });
	$('.form_receipt').submit(function() {	
        window.open('', 'patient_receipt.php', "width=750,height=450,resizeable,scrollbars");
        this.target = 'patient_receipt.php';
    });

$('#close').click(function() {	
         window.close('', 'discount_update_fd.php');
    });
	
}); 

</script>
</body>
</html>
<?php } ob_flush();?>