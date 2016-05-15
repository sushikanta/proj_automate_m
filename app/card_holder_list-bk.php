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
        
        <!------------ Print & SAve------------->     
   
   <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>    
    <button type="button" onclick="tableToExcel('p_list_table', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
  
     </h3>
    </div> 
<div class="panel-body">                                 
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover display" id="p_list_table">
<thead align="left">
  <tr>
      <th id="th_bg_color"> # </th>
      <th id="th_bg_color"> Card #</th>
      <th id="th_bg_color"> Name </th>
      <th id="th_bg_color"><i class="fa fa-male"></i><i class="fa fa-female"></i> </th>
      <th id="th_bg_color"> <i class="fa fa-home"></i> Address </th>
      <th id="th_bg_color"> <i class="fa fa-phone"></i> Phone </th>
      <th id="th_bg_color"> <i class="fa fa-calendar"></i> Date </th>      
      <th>Disc(%) </th>
      <th id="th_bg_color"> Status </th>     
      <th class="no-print">New </th>
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
           
   <form action="patient_registration_card.php" role="form" method="get" target="_blank" class="form_card">
  	<input type="hidden" name="patient_id" value="<?php echo $row['DH_patient_id'];?>"/>
    <input type="hidden" name="status" value="<?php echo $row['DH_status'];?>"/>
  	<td class="text-center"><button class="btn-info btn_count" type="submit"><i class="fa fa-plus"></i></button></td>
   </form>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<form id="formPatient_list" action="#">  
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
    <label style="display:none; ">Sl No</label><br/>
    <input type="text" name="sl_no" id="sl_no" style="display:none; " value="<?php echo $sl_no;?>" disabled rel="0" />      
    <br/>        
    <label style="display:none; " >Receipt No.</label><br/>
    <input type="text" name="receipt_no" style="display:none;" id="receipt_no" class="required" rel="1" />
    <br />  
    
     <label style="display:none; ">Patient Name</label><br/>
    <input type="text" name="patient_name" id="patient_name" style="display:none; " rel="2" />
    <br />  
    
     <label style="display:none; ">Sex_age</label><br/>
    <input type="text" name="patient_sex_age" id="patient_sex_age" style="display:none;" rel="3" />
    <br />  
    
     <label style="display:none; ">Address</label><br/>
    <input type="text" name="patient_address" id="patient_address" style="display:none;" rel="4" />
    <br />  
    
    <label style="display:none; ">Phone</label><br/>
    <input type="text" name="patient_phone" id="patient_phone" style="display:none;" rel="5" />
    <br />  
    
    <label style="display:none;">Date</label><br/>
    <input type="text" name="patient_date" id="patient_date" style="display:none;" rel="6" />
     <br />      
       
    <label style="display:none;">tes_number</label><br/>
    <input type="text" name="tes_number" id="tes_number" style="display:none;" rel="7" />    
    <br />  
      <label style="display:none;">test_status</label><br/>
    <select name="test_status" id="test_status" style="display:none;" rel="8" >
      <option value="1">Pending</option>
      <option value="5">Delivered</option>
      <option value="6">Blocked</option>
    </select>
    <br />  
    <label style="display:none; ">Balance</label><br/>
    <input type="text" name="balance_amt" id="balance_amt" style="display:none;" rel="9" />
    <br />  
    <label style="display:none; ">Receipt Print</label><br/>
      <input style="display:none" name="print_receipt" rel="10"/>
     <br />  
     <label style="display:none;">Detail</label>
      <input style="display:none" name="detail" rel="11"/> 
 </form> 
<button id="btnDeleteRow" style="visibility:hidden; display:none">Delete</button>  
<button id="btnAddNewRow" style="visibility:hidden; display:none">Add</button>

</div>
<div class="clear"></div>
</div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?> 
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>      
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {	
    
  $('#p_list_table').dataTable( {  
  
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
				
     } ).makeEditable({
		
        sDeleteURL:   "ajax_patient_registration_delete.php",
		sUpdateURL:   "ajax_patient_table_update.php",
			
		sAddNewRowFormId:  "formPatient_list",
		sAddNewRowButtonId: "btnAddNewRow",	
		sDeleteRowButtonId: "btnDeleteRow",
			   
		oDeleteRowButtonOptions: {
                                label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
		},			
		aoColumns: [
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,	
				  null,  
				],
	});
});
 </script>
</body>
</html>
<?php ob_flush();?>