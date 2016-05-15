<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Designation</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Designation ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>  
                         
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="desig_table_id">
<thead align="left">
<tr>
<th> Sl No.</th>
<th><i class="fa fa-pencil-square-o"></i> Designation </th>
<th><i class="fa fa-pencil-square-o"></i> Short Form </th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT designation_id, designation_name, short_form FROM designation_tbl");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
 	?>
    <tr id="<?php echo $row['designation_id'];?>">
    <td class="readonly-bg"> <?php echo $sl_no; ?></td>
	<td><?php echo $row['designation_name']; ?></td>
    <td><?php echo $row['short_form'];?></td>
    </tr>
    <?php
	$sl_no++;
}
?>
<tbody>
</table>

<form id="addDesig" action="#" style="display:none;"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

    <label for="sl_no">Sl No</label><br/>
    <input type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" />
    <br/> 
    <label for="category_name">Designation</label><br/>
    <input type="text" name="designation_name" id="designation_name" class="capital" autofocus rel="1" required />
    <br />  
    <label for="short_form">Short Form</label><br/>
    <input type="text" name="short_form" id="short_form" style="text-transform:uppercase;" rel="2" required/>
    <br />       
 </form> 
<!-- <div class="add_delete_toolbar" />-->  
<button id="btnDeleteRow" class="no-display">Delete</button> <button id="btnAddNewRow">Add</button>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>  

<script charset="utf-8" type="text/javascript">
 
$(document).ready(function() {    
		$('#desig_table_id').dataTable({

		"bJQueryUI": true,
		"bPaginate": false,
		"bFilter": true,
		"bInfo": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
        /*"sScrollY": "350px",
		"sScrollX": "101%",
        "bScrollInfinite": true,
        "bScrollCollapse": true,*/
		
		
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
	   });
	 
	 $('#desig_table_id').dataTable().makeEditable({		
        sAddURL:              "designation_ajax_add.php",
        //sDeleteURL:           "ajax_designation_delete.php",
		sUpdateURL:           "designation_ajax_update.php",
		sAddNewRowFormId:     "addDesig",
		sAddNewRowButtonId: "btnAddNewRow",	
		sDeleteRowButtonId: "btnDeleteRow",	
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
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height: 'auto',	
				cssclass: 'required',	
				}, 
	
		aoColumns: [
					null,                    				
							{
							  placeholder : 'Alert ! Empty -click to update',
							  loadtext: 'loading...',
							  //indicator: 'saving...',
							  cssclass: 'required',
							  tooltip: 'Click to update designation',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'OK',
							  event: 'click',
							  width: '40%', 
							  bAutoWidth: false,	          						
							 
							  oValidationOptions : 
                                   { rules:{ value: { required: true, minlength: 5 }} },			
							 },
							
							{
							 placeholder : 'Alert ! Empty -click to update',
							  loadtext: 'loading...',
							 // indicator: 'saving...',
							  cssclass: 'required',
							  tooltip: 'Click to update short-form',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'OK',
							  event: 'click',
							  width: '20%', 
							  bAutoWidth: false,	          						
							        						
							  oValidationOptions : 
                                  { rules:{ value: { required: true, minlength: 5 }} },							   					
							}		
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
                              jAlert(message, "Add failed");
                                break;
                        }
                    },
			});
	});
</script>
</body>
</html>
<?php ob_flush() ?>