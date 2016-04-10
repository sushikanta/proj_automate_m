<?php require_once("check_login_super.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Users </title>
<?php require_once("css_bootstrap_datatable_header.php");?>
</head>
<body>
<?php require_once("right_top_header_sad.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">

<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   Add / Edit <span class="panel-subTitle"> ( Users` Login Info ) </span>
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

   <table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="admin_table">
     <thead align="left">
       <tr>
         <th> # </th>
         <th> Username</th>
         <th> Reset Password</th>
         <th> Name</th>
         <th> Surname</th>
         <th> Department</th>
         <th> Last update on</th>
         <th> Status</th>
       </tr>
    </thead>
  <tbody>
<?php
$result_version = mysqli_query($con, "SELECT u.user_id, u.user_name, u.name, u.surname, u.user_date, u.user_status, d.department_name FROM user_table u LEFT JOIN department_tbl d ON d.department_id =  u.user_dept_id WHERE u.user_dept_id != '1' AND u.user_dept_id != '2'");
$sl_no=1;
while ($row = mysqli_fetch_array($result_version))
{
	$user_id =  $row['user_id'];
	$user_name =  $row['user_name'];
	$name =  $row['name'];
	$surname =  $row['surname'];
	$department_name =  $row['department_name'];
	$user_date =  $row['user_date'];
	$user_status =  $row['user_status'];
?>
 <tr id="<?php echo htmlspecialchars($user_id);?>">
        <td class="readonly-bg"><?php echo  $sl_no; ?> </td>
        <td><?php echo htmlspecialchars($user_name);?></td>
        <td>***</td>
        <td><?php echo htmlspecialchars($name);?></td>
        <td><?php echo htmlspecialchars($surname);?></td>
        <td><?php echo htmlspecialchars($department_name);?></td>
        <td class="readonly-bg"><?php echo  date("d-M-Y, h:i A", strtotime($user_date)); ?> </td>
        <td><?php if($user_status =='1'){echo "Active";}elseif($user_status =='2'){echo "Disabled";} ?> </td>
 </tr>
 <?php
 $sl_no++;
}
?>
<button id="btnDeleteRow" class="no-display">Delete</button> <button id="btnAddNewRow">Add</button>
</tbody>
</table>

<!------  form  family ---------->
<form id="formNew" method="post" action="#" title="Add New user login" style="display:none;">

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
  <label class="col-lg-5 control-label text-right" for="username">Username :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" name="username" class="form-control" value="<?php echo "User".getCounter($con, 27);?>"  maxlength="50" rel="1" required>
   </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Password :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" name="password" class="form-control capital" placeholder="12345" value="12345" maxlength="50" rel="2" required/>
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="name">Name :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control capital" name="name" placeholder="Name of the user" autofocus  maxlength="50" rel="3" required/>
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="surname">Surname :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="surname" placeholder="Surname" maxlength="20" rel="4" required />
     </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="dept_id">Department :</label>
  <div class="col-lg-7 padding_gap">
  <select name="dept_id" class="form-control" rel="5" required>
 		 <option value="" class="option_select">Select Department</option>
         <option value="2" class="option_select">Admin</option>
         <option value="3" class="option_select">Front Desk</option>
         <option value="4" class="option_select">Sample Collection</option>
         <option value="5" class="option_select">LAB</option>
         <option value="6" class="option_select">Ultrasound</option>
         <option value="7" class="option_select">ECG</option>
         <option value="8" class="option_select">X-Ray</option>
         <option value="9" class="option_select">HR</option>
         <option value="22" class="option_select">MT</option>
	</select>
   </div></div></div>
  <br/>
  <br/>
  <input style="display:none;"  type="hidden" name="user_date"  rel="6" />
<input style="display:none;"  type="hidden" name="user_status" rel="7" />
</form>
</div>
</div>

<div class="clear"></div>
</div>           <!----------------------------------------End version table ------------------------>

<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {

 $('#admin_table').dataTable({

        "bJQueryUI": true,
		"bPaginate": false,
		"bFilter": true,
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
     });

	 $('#admin_table').dataTable().makeEditable({

        sAddURL:              "user_table_admin_ajax_add.php",
        sDeleteURL:           "ajax_user_table_admin_delete.php",
		sUpdateURL: 		   "user_table_admin_ajax_update.php",

		sAddNewRowFormId:   "formNew",
		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowButtonId: "btnAddNewRow",
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
				width: '55%',
				maxHeight: 550,
				cssclass: 'required',
				overflow: 'scroll',
				minimalTopSpacingOfModalbox: 40,

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
					 oValidationOptions : { rules:{ value: { required: true, minlength: 2 } } }
					},
					{
					    tooltip: 'Click to update',
						loadtext: 'loading...',
						cssclass: 'required',
						width: 'auto',
						type: 'text',
						onblur: 'cancel',
						submit: 'ok',
						event: 'click',
						oValidationOptions : { rules:{ value: { required: true, minlength: 5 } } }
						},

					{
					  tooltip: 'Click to update',
					  loadtext: 'loading...',
					  cssclass: 'required',
					  onblur: 'cancel',
					  submit: 'ok',
					  width: '70%',
					  event: 'click',
					 oValidationOptions : { rules:{ value: { required: true, minlength: 2 } } }
						},
					{
					  placeholder: '',
					  tooltip: 'Click to update',
					  loadtext: 'loading...',
					  cssclass: 'required',
					  onblur: 'cancel',
					  submit: 'ok',
					  width: 'auto',
					  event: 'click',
						},
					{
						tooltip: 'Click to update',
						loadtext: 'loading...',
						cssclass: 'required',
						width: 'auto',
						type: 'select',
						onblur: 'cancel',
						submit: 'ok',
						event: 'click',
						data: "{'3':'Front Desk','4':'Sample Collection','5':'LAB','6':'Ultrasound','7':'ECG','8':'X-Ray', '9':'HR', '22':'MT'}",
						},
					null,
					 {
						tooltip: 'Click to update',
						loadtext: 'loading...',
						cssclass: 'required',
						width: 'auto',
						type: 'select',
						onblur: 'cancel',
						submit: 'ok',
						event: 'click',
						data: "{'1':'Active','2':'Disabled'}",
						},
				  ],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
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
               });
});
</script>
  </body>
</html>
<?php ?>