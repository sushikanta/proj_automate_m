<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Department</title>
<?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Department ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="table_id">
<thead align="left">
<tr>
<th> Sl No.</th>
<th><i class="fa fa-pencil-square-o"></i> Department Name </th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT department_id, department_name FROM department_tbl");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
 	?>
    <tr id="<?php echo htmlspecialchars($row['department_id']);?>">
        <td class="readonly-bg"><?php echo htmlspecialchars($sl_no); ?></td>
        <td><?php echo $row['department_name'];?></td>  
    </tr>
<?php
	$sl_no++;
}

?>
</tbody>
</table>
<!--<div class="add_delete_toolbar" />-->
<form id="addDept" action="#" style="display:none;"> 
<label id="lblAddError" style="display:none;" class="error"></label>
 <div id="processing_message" style="display:none;" title="Processing">Please wait while processing....</div>
 
    <label style="margin-right:46px;" for="sl_no">#</label>
    <label style="margin-right:293px;" for="Investigation">Department</label>
 <br/> 
    <input style="width:50px; margin-right:10px; cursor:not-allowed;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" />
    <input style="width:400px; margin-right:10px;"  type="text" name="department_name" id="department_name" class="required focus" rel="1" />
    <br />       
 </form> 
 <button id="btnDeleteRow" class="no-display">Delete</button> <button id="btnAddNewRow">Add</button>
</div>   
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript">

$(document).ready(function() {	
    
  $('#table_id').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": false,
		"bFilter": false,
		"bInfo": false,
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
			
				
     }).makeEditable({
		
        sAddURL:              "department_ajax_add.php",
        sDeleteURL:           "ajax_department_delete.php",
		sUpdateURL:           "department_ajax_update.php",
		sAddNewRowFormId:     "addDept",
		//sAddDeleteToolbarSelector: ".dataTables_length",
		   
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
				title: 'Add new Designation',
				resizable: false,
				draggable: true,
				width:'auto',
				height:'auto',				
				}, 
		
	
		aoColumns: [
                    	null,                    				
					{
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  tooltip: 'Click to update department',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'OK',
					  event: 'click',
					  width: '40%', 
					  bAutoWidth: false,
					  oValidationOptions : 
						   { rules:    { value: { required: true, minlength: 2 }},
							 messages: { value: { minlength: "Enter at least 2 characters" } }
						   }
					}
                    ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed !");
								//setTimeout('window.location.reload()', 800);
                                break;
                            case "delete":
                                jAlert(message, "Delete failed !");
								//setTimeout('window.location.reload()', 900);
                                break;
                            case "add":
                               jAlert(message, "Add failed !");
                                break;
                        }
                    },
				});
});
 
</script>
</body>
</html>
<?php ob_flush() ?>