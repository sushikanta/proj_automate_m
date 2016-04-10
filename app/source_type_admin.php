<?php require_once("check_login_admin.php");?>
<!DOCTYPE html>
<html>
  <head>
  <title>Add Source type </title>
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
          Add <span class="panel_subTitle">( Source Type )</span>
          <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>          
          </h3></div>    
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="type_tbl">
<thead align="left">
<tr>
  <th> Sl No.</th>
  <th>Source Type</th>
</tr>
</thead>
<tbody>
<?php
$result1 = mysqli_query($con, "SELECT `source_id`, `source_name` FROM `source_tbl` WHERE `source_id` > '3' ORDER BY `source_id` ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result1))
{
	$dr_id = $row['source_id'];
	?>
 	<tr id ="<?php echo $dr_id;?>">
	   <td> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['source_name']; ?></td> 
     </tr>	
<?php 
$sl_no++;
}
?>
</tbody>
</table>

<form id="form_new" action="#" style="display:none;"> 
<label id="lblAddError" style="display:none;" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>    
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_no;?>" readonly rel="0">
  </div>
  </div></div>
  <br/>
 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="source_type">Source Person :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="source_type" class="form-control capital" placeholder="Type of Source" maxlength="100" required rel="1"/>
  </div></div></div>
  <br/>
  </form> 
<button id="btnAddNewRow" class="no-print">Add</button>
<button id="btnDeleteRow" class="no-print" style="display:none;">Delete</button>

</div>      
<div class="clear"></div>
</div>
<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
 
$(document).ready(function() {    
  $('#type_tbl').dataTable({		       		

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
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');	
	   }
			
     })
	 
	 $('#type_tbl').dataTable().makeEditable({
		
        sAddURL:"fd_add_source_type_ajax_add.php",
        sUpdateURL:"fd_add_source_type_ajax_update.php",
		//sDeleteURL:"delete_not_authorised.php",
		sAddNewRowFormId:"form_new",	
		
		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowButtonId: "btnAddNewRow",			
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
				title: 'Add new Category',
				resizable: false,
				draggable: false,
				autoOpen: false, 
				modal: true,
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,		
				}, 
		
	
		aoColumns: [
						null,                   				
							{
							  loadtext: 'loading...',
							  //indicator: 'saving...',
							  tooltip: 'click to update !',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'ok',
							  event: 'click',
							  width: '60%',  			
							   oValidationOptions : 
                                   {   rules:{ value: { required: true, minlength: 2 } },
                                   messages: { value: { minlength: "Enter at least 2 characters" } }
                                   }		
							},						
					  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":                             
								jAlert(message, "Update failed");								
                                break;
                          
                            case "add":
                                jAlert(message, "Add Failed");
                                break;
                        }
                    },
          });
});
 
</script>
</body>
</html>
<?php ob_flush();?>