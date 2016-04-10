<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Source Person </title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php");?>
	<div class="container">
		<div class="page-content">
        
	<div class="inv-main">
    <div class="panel panel-success">
      <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Source Person <span class="panel_subTitle">( Add / Edit )</span>
      <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>      
      </h3></div>
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="person_tbl">
<thead align="left">
<tr>
  <th> Sl No.</th>
  <th>Source Person</th>
  <th>Source Type</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT r.referred_id, r.referred_name, r.source_id, s.source_name FROM referred_tbl r LEFT JOIN source_tbl s ON s.source_id = r.source_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{ $referred_id = $row['referred_id']; ?>

 	<tr id="<?php echo $referred_id;?>">
	   <td><?php echo $sl_no; ?></td>
	   <td><?php echo $row['referred_name']; ?></td>
	   <td><?php echo $row['source_name'];?></td>
     </tr>
	
<?php $sl_no++; } ?>
</tbody>
</table>

<form id="form_add" method="post" action="#" title="Add New" style="display:none;">  
<label id="lblAddError" style="display:none" class="error"></label>
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
  <label class="col-lg-5 control-label text-right" for="ref_name">Source Person :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="ref_name" class="form-control capital" placeholder="Source Person, Code Name etc" maxlength="50" required rel="1"/>
  </div></div></div>
  <br/>
 
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="source_id">Source Type :</label> 
 	<div class="col-lg-7 padding_gap">
    <Select class="form-control" name="source_id" required rel="2">
      <option value="" class="option_select">Select</option>
      <?php $result1 = mysqli_query($con, "SELECT source_id, source_name FROM source_tbl WHERE source_id > '3' ORDER BY source_name ASC");
     while($row1=mysqli_fetch_array($result1)) { ?>
      <option value="<?php echo $row1['source_id'];?>" class="option_select"><?php echo $row1['source_name'];?></option>						 
      <?php } ?>          
      </Select>
 </div></div></div>
  <br/>
    </form>
  <!--<div class="add_delete_toolbar"/> --> 
<button id="btnAddNewRow" class="no-print">Add</button>
<button id="btnDeleteRow" class="no-print" style="display:none;">Delete</button>

</div>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
$(document).ready(function(){    
  $('#person_tbl').dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":true,
		"bInfo":false,
		
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
     });
	 
	 $('#person_tbl').dataTable().makeEditable({		
        sUpdateURL:"fd_add_source_name_ajax_update.php",
		sAddURL:"fd_add_source_name_ajax_add.php",
		sAddNewRowFormId:"form_add",		
		sDeleteRowButtonId:"btnDeleteRow",
		sAddNewRowButtonId:"btnAddNewRow",
		   
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
				title: 'Add new Source Person',
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
						  placeholder : '',
						  loadtext: 'loading...',
						  indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'text',
						  onblur: 'cancel',
						  submit: 'OK',
						  event: 'click',
						  width: '40%',						
						  oValidationOptions : 
							 {  rules:{  value: { required: true, minlength: 2 } },}									  
						 },
						 
						 {
						  placeholder : '',
						  loadtext: 'loading...',
						  indicator: 'saving...',
						  cssclass: 'required',
						  tooltip: 'Click to Edit',
						  type: 'select',
						  onblur: 'cancel',
						  submit: 'ok',
						  event: 'click',
						  loadurl: "fd_add_source_name_ajax_list.php",
						 },                 				
							
				  ],
	
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
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
<?php ob_flush();?>