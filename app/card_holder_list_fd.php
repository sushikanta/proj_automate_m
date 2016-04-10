<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>Card Holder List</title>
   <?php require_once("css_bootstrap_datatable_header.php");?> 
   <?php require_once("print-borderless-tbl.php");?>
</head>
<body id="myBody">
<?php require_once("right_top_header.php"); ?>
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">	
 
  <!------------- START Patient list ------------->
  <div class="panel panel-success">
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     List <span class="panel_subTitle no-print">( Card Holder )</span>
        
  <!------------ Print & SAve -------------> 
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('tbl_list', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
  
     </h3>
    </div> 
<div class="panel-body">                                 
                               
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="tbl_list">
<thead align="left">
  <tr>
      <th> # </th>
      <th>Card # </th>
      <th>Disc(%) </th>
      <th>Name </th>
      <th>Address </th>
      <th>Phone </th>
      <th>Validity </th>
      <th>Valid From - Valid Upto </th>
      <th>Status </th>
      <th class="no-print">New </th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT c.DH_id, c.DH_patient_id, c.DH_disc_per, c.DH_date, c.DH_validity, c.DH_user, p.PI_name, p.PI_address, p.PI_phone,  p.PI_card FROM card_holder c LEFT JOIN patient_info p ON c.DH_patient_id = p.PI_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$DH_id = $row['DH_id'];
	$DH_patient_id = $row['DH_patient_id'];
	$DH_disc_per = $row['DH_disc_per'];
	$DH_date = $row['DH_date'];
	$DH_validity = $row['DH_validity'];
	$DH_user = $row['DH_user'];	
	$PI_name = $row['PI_name'];
	$PI_address = $row['PI_address'];
	$PI_phone = $row['PI_phone'];
	$PI_card = $row['PI_card'];
	
	if($PI_card == 1){$status = 'Active';}
	if($PI_card == 2){$status = 'Disabled';}
	
?>
 	<tr id="<?php echo $row['DH_id'] ; ?>">
      <td> <?php echo $sl_no; ?> </td>  
      <td style="color:#00F;"><?php echo 'CD/'.$DH_id; ?> </td>
      <td><?php echo $DH_disc_per; ?></td>
      <td><?php echo $PI_name; ?> </td>
      <td><?php echo $PI_address; ?> </td>
      <td><?php if($PI_phone ==''){echo "";}else{ echo '+91 '.$PI_phone;} ?></td>
      <td><?php echo $DH_validity; ?> Months </td>
      <td><?php $valid_upto = date("d/M/Y",strtotime(date("d-M", strtotime("$DH_date")). " +$DH_validity months"));
	  			echo date("d/M/Y", strtotime($DH_date)).' - '.$valid_upto; ?> </td>
      <td style="font-style:italic; color: #33C;"><?php echo $status; ?></td>
           
   	<form action="patient_registration_card.php" role="form" method="get" target="_blank" class="form_card">
  	<input type="hidden" name="patient_id" value="<?php echo $DH_patient_id;?>"/>
    <input type="hidden" name="status" value="<?php echo $PI_card;?>"/>
  	<td class="text-center"><button class="btn btn-mini btn-primary" type="submit"><i class="fa fa-plus"></i></button></td>
   </form>
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
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>      
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {	
   
   $('.form_card').submit(function() {	
    window.open('', 'patient_registration_card.php', "width=1120,height=550,resizeable,scrollbars");
    this.target = 'patient_registration_card.php';
    });

$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'patient_registration_card.php');
	   myWindow1.close();
    });	
	
  $('#tbl_list').dataTable( {  
  
  		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter": true,
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
				
     })
});
 </script>
</body>
</html>
<?php ob_flush();?>