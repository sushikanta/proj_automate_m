<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php");?> 
<body>
<?php include("right_top_header_collection.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<div class="panel panel-success">
      <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-wrench"></i>&nbsp;&nbsp; Add Users</h3></div>
      
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="admin_user_table">
        <thead align="left">
        <tr>
          <th> # </th>
          <th> Username</th>          
          <th> Full Name</th>
          <th style="display:none;"> User id</th>
        </tr>
       </thead>     
  <tbody>
<?php
$result_version = mysqli_query($con, "SELECT * FROM `user_technician_tbl` WHERE `UTC_dept_id` = '4'");
$sl_no=1;
while ($row = mysqli_fetch_array($result_version))
{
	$UTC_id =  $row['UTC_id'];
	
?>
 <tr  id="<?php echo  htmlspecialchars($row['UTC_id']); ?>">
      <td class="readonly-bg"><?php echo  htmlspecialchars($sl_no); ?> </td>  
      <td><?php echo  htmlspecialchars($row['UTC_user_name']); ?> </td>  
      <td><?php echo  htmlspecialchars($row['UTC_full_name']); ?> </td>       
      <td style="display:none;"><?php echo  htmlspecialchars($row['UTC_id']); ?> </td>            
 </tr>
 <?php
 $sl_no++;
}
?>
<tbody>
</table> 

<!-------------------form for new record------------------------------>
<form id="formAdd_users_admin" action="#"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
  
    <label style="margin-right:28px;" for="sl_no">#</label>
    <label style="margin-right:100px;" >Username</label>
    <label style="margin-right:123px;" >Full Name</label>
    <label style="display:none;" >User_id</label>   
   
    </br>    
   
    <input style="width:30px; margin-right:10px; cursor:not-allowed;"  type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
    <input style="width:180px; margin-right:10px;" type="text" name="username" rel="1" />    
    <input style="width:380px; margin-right:10px;"  type="text" name="full_name" rel="2" /> 
    <input style="display:none;"  type="hidden" name="hidden_user_id" value="<?php echo htmlspecialchars($UTC_id);?>" rel="3" /> 
     <br /> 
 </form>    
<div class="add_delete_toolbar" />  
<div class="clear"></div>   
</div>           <!----------------------------------------End version table ------------------------->

	<?php include("footer.php"); ?> 
    <?php include("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {			
 
 $('#admin_user_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
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
     }).makeEditable({
		 
        sAddURL:              "ajax_user_technician_add.php",
        sDeleteURL:           "ajax_user_technician_delete.php",
		sUpdateURL: 		   "ajax_user_technician_update.php",
		
		sAddNewRowFormId:     "formAdd_users_admin",	
		sAddNewRowButtonId: "btnAddNewRow",
		//sAddNewRowOkButtonId: "btnAddNewRowOk",
		//sAddNewRowCancelButtonId: "btnAddNewRowCancel",
		sDeleteRowButtonId: "btnDeleteRow",
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
				title: 'Add new record',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				width:'auto',
				height: 'auto',	
				cssclass: 'required',			
				}, 		
	
		aoColumns: [
					null,					
					{},					
					{},								
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								setTimeout('window.location.reload()', 800);
                                break;
                            case "add":
						        jAlert(message, "Add failed");
								setTimeout('window.location.reload()', 800);
                                break;
                        }
                    },
										
   fnStartProcessingMode: function () {
                        $("#processing_message").dialog(); },
   fnEndProcessingMode: function () {
                       		
						$("#processing_message").dialog("close");
						// window.location.reload();
						 },
	fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
     });	
	 
	 var oTable = $('#admin_user_table').dataTable();
	     oTable.fnSetColumnVis( 3, false );    // Hide the 6th column after initialisation
	  
}); 
   
   </script>
  </body>
</html>