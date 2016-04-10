<?php require_once("check_login_admin.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Discount List</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">
 
<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
  List <span class="panel-subTitle"> ( Discounted EDs - Today ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  </h3>
     </div>
                               
<table cellpadding="0" cellspacing="0" border="0" class="table-bordered table-hover display" id="disc_table">
<thead align="left">
  <tr>      
      <th style="width:1%;"> # </th>
      <th> Disc Code</th>
      <th> Value</th>
      <th> Remark</th>
      <th> Date</th>
      <th> Reg. ID</th>   
      <th> Name</th>
      <th> Address</th>
      <th> Ref by (Source)</th>     
  </tr>
</thead>
<tbody>
<?php
$today = date("Y-m-d");
$result = mysqli_query($con, "SELECT d.disc_code_sl, d.disc_type, d.disc_value, d.disc_remark, d.disc_user, d.disc_status_date, d.disc_receipt_no, p.PI_name, p.PI_address, r.pr_dr_prescription, r.pr_source_id, r.pr_referred_id FROM discount_tbl d LEFT JOIN patient_registration r ON r.pr_receipt_no = d.disc_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id WHERE DATE_FORMAT(d.disc_status_date,'%Y-%m-%d') = '".$today."' ORDER BY d.disc_status_date DESC");
$sl_no=1;
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
    <td><?php	
	  if($pr_dr_prescription =='NO'){echo "Self";}
   else{echo 'Dr. '.showDoctor_name($con, $pr_dr_prescription);} ?> 
   (<?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). ", ".showSourceName($con, $pr_source_id)."</span>)"; ?> </td>
      
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

<form id="formDiscount_table" action="#"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
    <input style="display: none;" type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
    <input style="display: none;" type="text" name="disc_code" rel="1" /> 
    <input style="display: none;" type="text" name="disc_type" rel="2" /> 
    <input style="display: none;" type="text" name="disc_value" rel="3" /> 
    <input style="display: none;" type="text" name="disc_remark" rel="4" /> 
    <input style="display: none;" type="text" name="disc_status" rel="5" /> 
    <input style="display: none;" type="text" name="disc_status_date" rel="6" />       
    <input style="display: none;" type="text" name="disc_receipt_no" rel="7" />       
    <input style="display: none;" type="text" name="pr_patient_name" rel="8" />       
    <input style="display: none;" type="text" name="pr_patient_address" rel="9" />       
    <br/> 
               
 </form>    

<button id="btnDeleteRow">Delete</button>  
<button id="btnAddNewRow" style="visibility:hidden;">Add</button>


<div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript" >
$(document).ready(function() {				
 	
	$('#disc_table').dataTable( {        

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
    }).makeEditable({
		
        sDeleteURL:   "discount_table_ajax_delete.php",
			
		sAddNewRowFormId:  "formDiscount_table",
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
					
	fnShowError: function (message, action) {
                        switch (action) {
                           case "delete":
                                jAlert(message, "Delete Failed !");
								//setTimeout('window.location.reload()', 1800);
                                break;
                           }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();						
						
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						 //window.location.reload();
                    },
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                               fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
					
    } );
	// var qTable = $('#disc_table').dataTable(); 
  	// qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation

}); 

</script>
</body>
</html>
<?php ob_flush();?>