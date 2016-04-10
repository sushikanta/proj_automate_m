<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Category</title>
  <?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
	<div class="container">
		<div class="page-content">   
        
<div class="inv-main">
    <div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Add / Edit <span class="panel-subTitle"> ( Category ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
     </div>    
 
 <div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="example">                                  
<thead align="left">
<tr>
  <th> Sl No.</th>
  <th><i class="fa fa-pencil-square-o"></i> Investigation Category</th>
  <th><i class="fa fa-pencil-square-o"></i> Department</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT c.test_category_id, c.test_category_name, c.TC_dept_id, d.department_name FROM test_category c LEFT JOIN department_tbl d ON d.department_id =c.TC_dept_id ORDER BY c.test_category_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$category_id = $row['test_category_id'];
	$category_name = $row['test_category_name'];
	$department_id = $row['TC_dept_id'];
	$department_name = $row['department_name'];
	?>
 	<tr id="<?php echo $category_id;?>">
	   <td><?php echo $sl_no;?></td>
	   <td><?php echo $category_name;?></td> 
	   <td><?php echo $department_name;?></td>
     </tr>	
<?php 
$sl_no++;
}
?>
</tbody>
</table>

<form id="addme" method="post" action="#" title="Add New" style="display:none;"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_no;?>" readonly rel="0">
  <input type="hidden" name="emp_info" value="<?php echo '';?>">
  </div>
  </div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="category_name">Category :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="category_name" class="form-control capital" placeholder="Category Name" maxlength="50" autofocus rel="1"/>
  </div></div></div>
    <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="department">Department :</label>       
  <div class="col-lg-7 padding_gap">
  <select name="department" class="form-control" rel="2">
 		<option value="">Select Status</option>
	<?php $result_dept=mysqli_query($con, "SELECT department_id, department_name FROM department_tbl WHERE department_id ='5' OR department_id ='6' OR department_id ='7' OR department_id ='8' OR department_id ='23'");
	
          while($row3 = mysqli_fetch_array($result_dept)) {?>
          <option value="<?php echo $row3['department_id'];?>"><?php echo $row3['department_name']; ?></option>          
<?php } ?>
	</select>
   </div></div></div>
  <br/>
             
</form>
<button id="btnDeleteRow" style="display:none;">Delete</button> <button id="btnAddNewRow">Add</button>
</div>
</div>
  
<div class="clear"></div>
</div>
<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
 
$(document).ready(function() {	
    
  $('#example').dataTable( {		       		

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
			
				
     }).makeEditable({
		
        sAddURL:              "testCategory_ajax_add.php",
        sDeleteURL:           "testCategory_ajax_delete.php",
		sUpdateURL: 		   "testCategory_ajax_edit.php",
		sAddNewRowFormId:     "addme",
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
				title: 'Add new category',
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
							{
							  tooltip: 'Click to edit Category',
							  loadtext: 'loading...',
							  indicator: 'saving...',
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
							tooltip: 'Click to update department',
							loadtext: 'loading...',
							indicator: 'saving...',
							cssclass: 'required',
							width: '30%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							//loadurl: 'testCategory_ajax_dept_list.php',
							data: "{'5':'LAB','6':'Ultrasound','7':'ECG','8':'X-Ray','23':'Extra'}",
							},		
                    				
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								window.location.reload();
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
								window.location.reload();
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
    } );
	
	// VALIDATION - QUALIFICATION
$("#addme").validate({
	ignore: "",
	onkeyup: true,
	onblur: true,	
rules: {		
	category_name: {required: true},
	department: {required: true},
	
},
 	highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
    }
});
	

} );
 
</script>
</body>
</html>
<?php ob_flush();?>