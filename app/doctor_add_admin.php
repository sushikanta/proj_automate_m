<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Add/Edit Doctor</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<div class="page-content">   
        
<div class="inv-main">
   <div class="panel panel-success" >
  <div class="panel-heading light_purple_color">
  	
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Add <span class="panel-subTitle">( Doctor Referral Info ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    
    <div class="error pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error"></span><br clear="all">
    </div>
    
     <div class="err pull-right" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span class="span-error"></span><br clear="all">
   </div> 
  </h3>
  </div>
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="dr_add_tbl">
<thead align="left">
<tr>
  <th> Sl No.</th>
  <th>Dr. Name</th>
  <th>Specialization</th>
  <th>Working Institute</th>
  <th>Phone Number</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT dr_id, dr_name, dr_specialization, dr_institute, dr_phone FROM `dr_profile` ORDER BY dr_name ASC ");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$dr_id = $row['dr_id'];
	?>
 	<tr id = "<?php echo $dr_id;?>">
	   <td class="readonly-bg"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['dr_name']; ?></td> 
	   <td><?php echo $row['dr_specialization'];?></td>
       <td><?php echo $row['dr_institute'];?></td>
       <td><?php echo $row['dr_phone'];?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
</tbody>
</table>

<form id="dr_form" action="#"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
    
 <label style="margin-right:48px;" >Sl no</label>
 <label style="margin-right:177px;">Dr. Name</label>
 <label style="margin-right:140px;">Specialization</label>
 <label style="margin-right:105px;">Working Institute</label>
 <label style="margin-right:0px;">Phone</label>
     <br/>
    
    <input style="width:80px; margin-right:10px;" type="text"  name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" readonly rel="0" />  
    <input style="width:250px; margin-right:10px;" type="text" name="dr_name" id="dr_name" rel="1" required />
    <input style="width:250px; margin-right:10px;" type="text" name="dr_specialized" id="dr_specialized" rel="2" />
    <input style="width:250px; margin-right:10px;" type="text" name="dr_institute" id="dr_institute" rel="3" />
    <input style="width:150px; margin-right:10px;" type="text" name="dr_phone" id="dr_phone" rel="4" maxlength="10" />    
     <br />  
    </form>
     <div class="add_delete_toolbar"/>  
<!--<button id="btnAddNewRow" class="no-print">Add</button>
<button id="btnDeleteRow" class="no-print" style="display:none;">Delete</button>  -->   
       
<div class="clear"></div>
</div>
<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
 
$(document).ready(function() {	
    
  $('#dr_add_tbl').dataTable( {		       		

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
		
        sAddURL:              "fd_add_doctor_ajax_add.php",
        sUpdateURL: 		   "fd_add_doctor_ajax_update.php",
        sDeleteURL: 		   "delete_not_authorised.php",
		sAddNewRowFormId:     "dr_form",	
		
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
				draggable: true,
				width:'auto',
				height:'auto',				
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
							  width: '40%',  
							  
							        						
							   oValidationOptions : 
                                   {   rules:{ value: { required: true, minlength: 2 } },
                                   messages: { value: { minlength: "Enter at least 2 characters" } }
                                   }		
							},
							{
							  loadtext: 'loading...',
							  indicator: 'saving...',
							  tooltip: 'click to update !',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'ok',
							  event: 'click',
							  width: '40%',  
							  
							        						
							 /*  oValidationOptions : 
                                   {   rules:{ value: { required: true, minlength: 5 } },
                                   messages: { value: { minlength: "Enter at least 5 characters" } }
                                   }		*/
							},
							{
							  loadtext: 'loading...',
							  indicator: 'saving...',
							  tooltip: 'click to update !',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'ok',
							  event: 'click',
							  width: '40%',  
							  
							        						
							 /*  oValidationOptions : 
                                   {   rules:{ value: { required: true, minlength: 5 } },
                                   messages: { value: { minlength: "Enter at least 5 characters" } }
                                   }		*/
							},
							{
							  loadtext: 'loading...',
							  indicator: 'saving...',
							  tooltip: 'click to update !',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'ok',
							  event: 'click',
							  width: '40%',  
							  
							        						
							 /*  oValidationOptions : 
                                   {   rules:{ value: { required: true, minlength: 5 } },
                                   messages: { value: { minlength: "Enter at least 5 characters" } }
                                   }		*/
							},	
                    				
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                alert();
								jAlert(message, "Update failed");
								//window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//window.location.reload();
                                break;
                            case "add":
                                jAlert(message, "Add Failed");
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();
												
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						 //sswindow.location.reload();
                    },
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    }
    } );

} );
 
</script>
</body>
</html>
<?php ob_flush();?>