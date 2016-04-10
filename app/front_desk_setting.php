<?php require_once("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')

 {
?>
<!DOCTYPE html>
<html>
<?php require_once("css_bootstrap_datatable_header.php");?> 
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<div class="panel panel-success">
      <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-cog fa-spin fa-fw fa-lg"></i> Setting <i class="fa fa-angle-double-right fa-fw"></i> User login</h3></div>
      
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="admin_user_table">
     <thead align="left">
       <tr>
         <th> # </th>
         <th><i class="fa fa-edit"></i> Username</th> 
         <th><i class="fa fa-edit"></i> Change Password</th>
         <th><i class="fa fa-edit"></i> Given Name</th>
         <th><i class="fa fa-edit"></i> Surname</th>
         <th> Department</th>
         <th> Last update on</th> 
         <th> Status</th> 
	  </tr>
    </thead>     
  <tbody>
<?php
$result_version = mysqli_query($con, "SELECT `user_table`.*, `department_tbl`.* FROM `user_table` LEFT JOIN `department_tbl` ON `department_tbl`.`department_id` =  `user_table`.`user_dept_id` WHERE `user_table`.`user_id` = '".$_SESSION['user_id']."'");
$sl_no=1;
while ($row = mysqli_fetch_array($result_version))
{
	$user_id =  $row['user_id'];
	
?>
 <tr id="<?php echo htmlspecialchars($row['user_id']);?>">
        <td class="readonly-bg"><?php echo  $sl_no; ?> </td> 
        <td><?php echo htmlspecialchars($row['user_name']);?></td>  
        <td>***</td> 
        <td><?php echo htmlspecialchars($row['name']);?></td>         
        <td><?php echo htmlspecialchars($row['surname']);?></td>
        <td class="readonly-bg"><?php echo htmlspecialchars($row['department_name']);?></td>
        <td class="readonly-bg"><?php echo  date("d-M-Y, h:i A", strtotime($row['user_date'])); ?> </td>
        <td class="readonly-bg"><?php if($row['user_status'] =='1'){echo "Active";}elseif($row['user_status'] =='2'){echo "Disabled";} ?> </td> 
 </tr>
 <?php
 $sl_no++;
}
?>
</tbody>
</table> 

<!-------------------form for new record------------------------------>
<form id="formAdd_users_admin" action="#"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
  
	<label style="margin-right:28px;display:none;" for="sl_no">#</label>
    <label style="margin-right:21px;display:none;">Username</label>
    <label style="margin-right:25px;display:none;">Password</label>
    <label style="margin-right:211px;display:none;">Name</label>
    <label style="margin-right:109px;display:none;">Surname</label>
    <label style="margin-right:0px;display:none;">Department</label>   
    <label style="margin-right:0px; display:none;">date</label>   
    <label style="margin-right:0px; display:none;">status</label> 
   </br>    
<input style="width:30px; margin-right:10px; display:none;" type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
<input style="width:100px; margin-right:10px; display:none;" type="text" name="username" 
	value="<?php echo "User".counterValueOnly($con, 27);?>" readonly rel="1" /> 
<input style="width:100px; margin-right:10px; display:none;" type="text" name="password" value="***" rel="2" /> 
<input style="width:250px; margin-right:10px; display:none;" class="capital" type="text" name="name" autofocus rel="3" /> 
<input style="width:175px; margin-right:10px; display:none;" class="capital" type="text" name="surname" rel="4" /> 
   
<select style="width:175px; margin-right:10px; display:none;" id="dept_id" name="dept_id" rel="5">
 <option value="">Select Department</option>
 <option value="3">Front Desk</option>
 <option value="4">Sample Collection</option>
 <option value="5">LAB</option>
 <option value="6">Ultrasound</option>
 <option value="7">ECG</option>
 <option value="8">X-Ray</option>
 <option value="9">HR</option>
</select> 

<input style="display:none;"  type="hidden" name="user_date" disabled rel="6" /> 
<input style="display:none;"  type="hidden" name="user_status" disabled rel="7" />  
    <br/>
 </form>    
<div class="add_delete_toolbar" style="display:none;"></div>  
<div class="clear"></div>   
</div>           <!----------------------------------------End version table ------------------------->

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {			
 
 $('#admin_user_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bInfo": false,
		"bFilter": false,
	
		
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
	 
	 var oTable = $('#admin_user_table').dataTable();
	 
	 
	 oTable.makeEditable({
		
		 
        sAddURL:              "ajax_user_table_admin_add.php",
        sDeleteURL:           "ajax_user_table_admin_delete.php",
		sUpdateURL: 		   "ajax_user_table_admin_update.php",
		
		sAddNewRowFormId:   "formAdd_users_admin",
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
				
				title: 'Add new User ( Default password: 12345 )',
				autoOpen: false,
				modal: true,
				width:'auto',
				height: 'auto',	
				cssclass: 'required',			
				}, 		
	
		aoColumns: [
					null,
					{
					 tooltip: 'Click to update',
					  loadtext: 'loading...',
					  cssclass: 'required',
					  onblur: 'cancel',
					  submit: 'ok',
					  width: '67%',
					  event: 'click',
					 oValidationOptions : 
									 {     rules:{ value: { required: true, minlength: 5 } },
									   messages: { value: { minlength: "Min. 5 characters" } }						  
									 },	
						},					
					{
					  tooltip: 'Click to update',
						loadtext: 'loading...',
						cssclass: 'required',
						width: '70%',
						type: 'text',
						onblur: 'cancel',
						submit: 'ok',
						event: 'click',
						oValidationOptions : 
									 {     rules:{ value: { required: true, minlength: 5 } },
									   messages: { value: { minlength: "Min. 5 characters" } }						  
									 },
						},
													
					{							
					  tooltip: 'Click to update',
					  loadtext: 'loading...',
					  cssclass: 'required',
					  onblur: 'cancel',
					  submit: 'ok',
					  width: '70%',
					  event: 'click',
					  oValidationOptions : 
									 {     rules:{ value: { required: true, minlength: 5 } },
									   messages: { value: { minlength: "Min. 5 characters" } }						  
									 },
						},
					{							
					  tooltip: 'Click to update',
					  loadtext: 'loading...',
					  cssclass: 'required',
					  onblur: 'cancel',
					  submit: 'ok',
					  width: 'auto',
					  event: 'click',
					  /*oValidationOptions : 
									 {     rules:{ value: { required: true, minlength: 2 } },
									   messages: { value: { minlength: "Min. 2 characters" } }						  
									 },*/
						},			
					null,
					null,
					 null,
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
							alert();
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//setTimeout('window.location.reload()', 800);
                                break;
                            case "add":
						        jAlert(message, "Add failed");
								//setTimeout('window.location.reload()', 800);
                                break;
                        }
                    },
										
   fnStartProcessingMode: function () {
                        $("#processing_message").dialog(); },
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
	fnOnEdited:function(success){
		alert();
		jAlert(success, "Delete failed");
		}
     });	
	 
	//var oTable = $('#admin_user_table').dataTable();
	    // oTable.fnSetColumnVis( 5, false );    // Hide the 6th column after initialisation
	  
});



   </script>
  </body>
</html>
<?php } ?>