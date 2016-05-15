<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>Price Version</title>
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
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Add / Edit <span class="panel-subTitle"> ( Price Version ) </span>
     <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
    </div> 
<div class="panel-body">                                 

<div class="row" style="width:86%; margin-left:7%">
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-hover display" id="version_table">
<thead align="left">
  <tr>
      <th id="th_bg_color">Version #</th>
      <th id="th_bg_color">Added by</th>
      <th id="th_bg_color">Date</th>
      <th id="th_bg_color">Status</th>
  </tr>
</thead>
<tbody>
<?php
$user_id = $_SESSION['user_id'];
$login_user = showFull_login($con, $user_id);
$result = mysqli_query($con, "SELECT `PV_id`, `PV_user`, `PV_date`, `PV_status` FROM `price_version` ORDER BY `PV_id` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$PV_id = $row['PV_id'];
	$PV_user = $row['PV_user'];
	$PV_date = date("d/m/Y", strtotime($row['PV_date']));
	$PV_status = $row['PV_status'];
	$user = showFull_login($con, $PV_user);
?>
 <tr id="<?php echo $row['PV_id'] ; ?>">
      <td class="readonly-bg"> <?php echo $sl_no; ?> </td>    
      <td class="readonly-bg"><?php echo $user; ?></td>   
      <td><?php echo $PV_date;?></td>
      <td><?php if($PV_status ==1){echo 'Current';}; if($PV_status ==2){echo 'Old';}; ?></td>     
           
   
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<form id="formVersion" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">Version # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_no;?>" readonly rel="0" required>  
  </div>
  </div></div>
  
  <br/>  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="reason">Added By :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="reason" class="form-control" placeholder="Added by (login name)" rel="1" required value="<?php echo $login_user;?>" readonly>
  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
   </div></div></div>
  <br/>
    
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="v_date">Date :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="v_date" class="form-control" id="v_date" placeholder="Date" rel="2" required readonly>
  </div></div></div>
  <br/>
  
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="status">Status :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" value="Current" rel="3" required readonly>
  <input type="hidden" name="status" value="1">
  </div></div></div>
  <br/>
   <br/>
</form>
<button id="btnDeleteRow">Delete</button>
<button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>  
</div>
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
    
  $('#version_table').dataTable( {  
  
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
		
        sAddURL: "price_version_ajax_add.php",
		//sDeleteURL: "ajax_patient_registration_delete.php",
		sUpdateURL: "price_version_ajax_edit.php",
			
		sAddNewRowFormId:  "formVersion",
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
				resizable: false,
				draggable: false,
				autoOpen: false, 
				modal: true,
				width: '45%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,
				
		},			
		aoColumns: [
					null,
					null,
					{
					  tooltip: 'Click to update JOined date',
					  loadtext: 'loading...',
					 // indicator: 'saving...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%',
					  oValidationOptions : 
										   {     rules:{ value: { required: true, date: true } },
											 messages: { value: { date: "DD/MM/YYYY" } }		

				  
		                                   }, 
					 
					},
					null,
					/*{
					  tooltip: 'Click to update Status',
					  loadtext: 'loading...',
							cssclass: 'required',
							width: '50%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							data: "{'1':'Current','2':'Old'}",
							},*/
				],
				fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								//window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//window.location.reload();
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
								//window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_messageF").dialog();
												
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_messageF").dialog("close");    
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
	
	
		
	$( "#v_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
		changeMonth: true,
		changeYear: true,
		yearRange: "-5:+0", // Setting yearRange of 100 years ago
		dateFormat: "dd-mm-yy",
		});
	
});
 </script>
</body>
</html>
<?php ob_flush();?>