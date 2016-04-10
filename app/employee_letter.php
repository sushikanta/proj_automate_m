<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php");?> 
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">	
   <div class="panel panel-success">  <!----------------------START Employee Information-------------->
	<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-envelope"></i> Employee Letters<a class="text-right pull-right" href="employee_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a></h3></div>  
  
<?php 
if(isset($_GET['table_emp_sl']))
 {      
   $table_emp_sl = $_GET['table_emp_sl'];                               
  ?>                             
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="letter_table">
<thead align="left">
  <tr>
        <th style="display: none;"> EL_sl</th>
        <th style="display: none;"> emp_sl</th>
        <th > # </th>
        <th > Emp ID</th>
        <th > Employee Name</th>
        <th > Letter type</th>
        <th > Detail</th>
        <th> Date</th>
        <th> Edit</th>
  </tr>
</thead>
<tbody>
<?php
 $employee_info = mysqli_query($con, "SELECT `employee_letter`.*, `employee_tbl`.* FROM `employee_letter` LEFT JOIN `employee_tbl` ON `employee_tbl`.`EMP_sl` = `employee_letter`.`EL_emp_sl` WHERE `employee_letter`.`EL_emp_sl` = '$table_emp_sl'");
 $sl_no=1;
  while($row = mysqli_fetch_array($employee_info))
  {
		$EL_sl = $row['EL_sl'];
?>
 <tr id="<?php echo $row['EL_sl']; ?>">
      <td style="display:none;"><?php echo $row['EL_sl']; ?></td>
      <td style="display:none;"><?php echo $table_emp_sl; ?></td>
      <td class="readonly-bg"><?php echo  $sl_no; ?> </td>  
      <td class="readonly-bg"><?php echo $_GET['emp_id']; ?></td>
      <td class="readonly-bg"><?php echo  $_GET['emp_name']; ?></td>
      <td class="readonly-bg"><?php echo  $row['EL_letter_type']; ?></td>
      <td class="readonly-bg"><?php echo   $row['EL_letter_detail']; ?></td> 
      <td class="readonly-bg"><?php echo  date("d-M-Y", strtotime($row['EL_date'])); ?> </td> 
      <td style="cursor:pointer;" class="readonly-bg"><a class="table-action-EditLetter navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
<!---------------------------------------- Form for new ------------------------->
<form id="formNewLetter" action="#"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
<label style="display:none;">EL_sl</label>
<label style="display:none;">emp_sl</label>
<label style="margin-right:30px;">#</label>
<label style="margin-right:9px;">Employee ID</label>
<label style="margin-right:65px;">Employee Name</label>
<label style="margin-right:91px;">Letter type</label>
<label style="margin-right:151px;">Letter Detail</label>
<label style="margin-right:0px;">Date</label>
 
 
 <br />
<input type="hidden" style="display:none;" name="hidden_EL_sl" id="hidden_EL_sl" value="<?php echo $EL_sl; ?>" rel="0"/> 
<input type="hidden" style="display:none;" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/> 
<input style="width:35px; margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />      
<input style="width:100px; margin-right:10px;" type="text" name="emp_id" id="emp_id" value="<?php echo $_GET['emp_id']; ?>" disabled rel="3" />
<input style="width:200px; margin-right:10px;" type="text" name="emp_name" id="emp_name" value="<?php echo $_GET['emp_name']; ?>" disabled rel="4" />
<select style="width:178px; margin-right:10px;" type="text" name="letter_type" id="letter_type" class="required" rel="5">
    <option value="">Select </option>
    <option value="Appointment Letter"> Appointment Letter</option>
    <option value="Approval Letter"> Approval Letter</option>
    <option value="Increment Letter"> Increment Letter</option>
    <option value="General Notice"> General Notice</option>
    <option value="Warning Letter"> Warning Letter</option>
    <option value="Releaving Letter"> Releaving Letter</option>
    <option value="Termination Letter"> Termination Letter</option>
    <option value="Others"> Others</option>
</select>
<textarea style="width:250px; margin-right:10px;" name="letter_detail" id="letter_detail" rel="6"></textarea>
<input style="width:112px; margin-right:10px;" type="text" name="letter_date" id="letter_date" readonly rel="7" />
   
   <br /> 
   <span class="datafield" style="display:none" rel="8"><a class="table-action-EditLetter"><i class="fa fa-pencil"></i> Edit</a></span>
   </form>
 <div class="add_delete_toolbar" />
 
 <!---------------------------------------- Form for Edit ------------------------->
<form id="formEditLetter" action="ajax_emp_letter_update.php" title="Update selected row"> 
<label style="display:none;">EL_sl</label>
<label style="display:none;">emp_sl</label>
<label style="margin-right:30px;">#</label>
<label style="margin-right:9px;">Employee ID</label>
<label style="margin-right:65px;">Employee Name</label>
<label style="margin-right:91px;">Letter type</label>
<label style="margin-right:151px;">Letter Detail</label>
<label style="margin-right:0px;">Date</label>
 
 
 <br />
<input type="hidden" style="display:none;" name="hidden_EL_sl" id="hidden_EL_sl" value="<?php echo $EL_sl; ?>" rel="0"/> 
<input type="hidden" style="display:none;" name="hidden_emp_sl" id="hidden_emp_sl" value="<?php echo $table_emp_sl; ?>" rel="1"/> 
<input style="width:35px; margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="2" />      
<input style="width:100px; margin-right:10px;" type="text" name="emp_id" id="emp_id" value="<?php echo $_GET['emp_id']; ?>" disabled rel="3" />
<input style="width:200px; margin-right:10px;" type="text" name="emp_name" id="emp_name" value="<?php echo $_GET['emp_name']; ?>" disabled rel="4" />
<select style="width:178px; margin-right:10px;" type="text" name="letter_type" id="letter_type" class="required" rel="5">
    <option value="">Select </option>
    
    <option value="Appointment Letter"> Appointment Letter</option>
    <option value="Approval Letter"> Approval Letter</option>
    <option value="Increment Letter"> Increment Letter</option>
    <option value="General Notice"> General Notice</option>
    <option value="Warning Letter"> Warning Letter</option>
    <option value="Releaving Letter"> Releaving Letter</option>
    <option value="Termination Letter"> Termination Letter</option>
    <option value="Others"> Others</option>
</select>
<textarea style="width:250px; margin-right:10px;" name="letter_detail" id="letter_detail" rel="6"></textarea>
<input style="width:112px; margin-right:10px;" type="text" name="letter_date" id="letter_date_edit" readonly rel="7" />
    
    <br />
    <button id="formEditLetterCancel" type="button">Cancel</button>      
    <button id="formEditLetterOk" type="submit">Confirm</button>    
   <br /> 
   <span class="datafield" style="display:none" rel="8"><a class="table-action-EditLetter"><i class="fa fa-pencil"></i> Edit</a></span>
   </form>
  
<?php } ?>

<div class="clear"></div>
</div>

<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript" >
$(document).ready(function() {	
    
  $('#letter_table').dataTable( {        

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
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');		
		 
	   }
			
				
     } ).makeEditable({
		 
		 aoTableActions: [
								{
								 sAction: "EditLetter",
								 sServerActionURL: "ajax_emp_letter_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 backdrop: 'static',
								 cssclass: 'required',				
				                 position: { my: "top", at: "centre", of: window }	
								  }
								}
						], 
		 
		 
		 

		sAddURL:              "ajax_emp_letter_add.php",
        sDeleteURL:           "ajax_emp_letter_delete.php",
		sUpdateURL:           "ajax_emp_letter_update.php",
		sAddNewRowFormId:     "formNewLetter",
		sAddDeleteToolbarSelector: ".dataTables_length",	
		   
		oAddNewRowButtonOptions: { 
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: { 
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: { 
				label: "Close",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Department',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height:'auto',	
				cssclass: 'required',
				}, 
		
	
		aoColumns: [
                    	null, 
						null, 
						null,  
						null, 
						null,                    				                  				
						null,                   				                  				
					
                    ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
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
                    }   
		});
		

$( "#letter_date, #letter_date_edit" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
changeMonth: true,
changeYear: true,
yearRange: "-5:+0", // Setting yearRange of 5 years ago
dateFormat: "dd-M-yy",
});		


var oTable = $('#letter_table').dataTable(); 
    oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
    oTable.fnSetColumnVis( 1, false );   // Hide the 2nd column after initialisation
    //oTable.fnSetColumnVis( 3, false );   // Hide the fourth column after initialisation
		
});

</script>
</body>
</html>