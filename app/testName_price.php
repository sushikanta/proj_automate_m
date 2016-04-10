<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Investigation</title>
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
     Add / Edit <span class="panel-subTitle"> ( Investigation ) </span>
	<span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
     </div>
     
   <div class="panel-body">  
   <table cellpadding="0" cellspacing="0" border="0" class="table-hover display" id="price_tbl">
   <thead align="left">
      <tr>
        <th> # </th>
        <th><i class="fa fa-pencil-square-o"></i> Investigation</th>
        <th><i class="fa fa-pencil-square-o"></i> Short form</th>
        <th class="text-right"> Price ( <i class="fa fa-inr"></i> )</th>
        <th><i class="fa fa-pencil-square-o"></i> Category</th>
        <th> Department</th>
      </tr>
   </thead>     
  <tbody>
<?php
$result = mysqli_query($con, "SELECT t.test_id, t.test_name, t.test_short_form, t.test_price, c.test_category_name, d.department_name FROM test_tbl t LEFT JOIN test_category c ON c.test_category_id=t.test_category_id LEFT JOIN department_tbl d ON d.department_id = c.TC_dept_id ORDER BY t.test_name ASC ");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{   
 	 $test_id = $row['test_id'];
	 $test_name = $row['test_name'];
	 $test_short_form = $row['test_short_form'];
	 $test_price = $row['test_price'];
	 $test_category_name = $row['test_category_name'];
	 $department_name = $row['department_name'];
	?>
          <tr id="<?php echo $test_id; ?>">
            <td><?php echo $sl_no; ?></td>
            <td><?php echo $test_name; ?></td>
            <td><?php echo $test_short_form; ?></td>
            <td class="text-right"><?php echo $test_price; ?></td>  
            <td><?php echo $test_category_name; ?></td>
            <td><?php echo $department_name; ?></td>         
          </tr>
       <?php
 $sl_no++;
}
?>
</tbody>   
</table>
<!------  form  new ---------->
<form id="formName_price" method="post" action="#" title="Add New" style="display:none;">
 
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
  <label class="col-lg-5 control-label text-right" for="test_name">Name :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="test_name" class="form-control capital" placeholder="Investigation Name" maxlength="100" autofocus rel="1"/>
  </div></div></div>
    <br/>
    
     <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="short_form">Short Form :</label>       
  <div class="col-lg-7 padding_gap">
  <input  style="text-transform:capitalize;" type="text" name="short_form" class="form-control" placeholder="Short form" maxlength="20" rel="2"/>
  </div></div></div>
    <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="category">Category :</label>       
  <div class="col-lg-7 padding_gap">
  <select name="category" class="form-control" rel="3">
 		<option value="">Select Status</option>
	<?php $result_category=mysqli_query($con, "SELECT test_category_id, test_category_name FROM test_category");
	
          while($row3 = mysqli_fetch_array($result_category)) {?>
          <option value="<?php echo $row3['test_category_id'];?>"><?php echo $row3['test_category_name']; ?></option>          
	<?php } ?>
	</select>
   </div></div></div>
  <br/>
  <input type="hidden" name="department" rel="4" />
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="price">Price :</label>       
  <div class="col-lg-7 padding_gap">
  <input  type="text" name="price" class="form-control" placeholder="Investigation Price" maxlength="8" rel="5"/>
  </div></div></div>
    <br/>
<br/>
             
</form>
<button id="btnDeleteRow" style="display:none;">Delete</button> <button id="btnAddNewRow">Add</button>
</div>
</div>

<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>    
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
 		
		$('#price_tbl').dataTable( {		       		

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
		  			
     }).makeEditable({
		 
        sAddURL:              "testName_price_ajax_add.php",
        sDeleteURL:           "testName_price_ajax_delete.php",
		sUpdateURL: 		   "testName_price_ajax_update.php",
		
		sAddNewRowFormId:   "formName_price",
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
				title: 'Add new record',
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
					 tooltip: 'Click to update investigation',
					 placeholder:'',
					 loadtext: 'loading...',
					  //indicator: 'saving...',
					  cssclass: 'required',
					
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '80%', 
					},
					{
					  tooltip: 'Click to update short-form',
					  placeholder:'',
					  loadtext: 'loading...',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%', 
					
					},
					null,
					{
					  
					  tooltip: 'Click to update category',
					  loadtext: 'loading...',
					  //indicator: 'saving...',
					  placeholder:'',
					  cssclass: 'required',
					  width: '80%', 
					  bAutoWidth: false, 
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
     				  loadurl: "testName_price_ajax_category.php",  					  
					},	
					null,					
					null,				
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
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
                                break;
                        }
                    },
   fnStartProcessingMode: function () {
                        $("#processing_message").dialog();
						

                    },
   fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						window.location.reload();
						
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
	
	
	$('form').submit(function () {
  			if ($(this).valid()) {			  
			    //$('#div_main').hide();
			    //$('#divWait').show();
			}
		  });	
	
	$("#formName_price").validate({
	rules: {
			test_name: {required:true},
			category:{required:true},
			short_form:{required:true},
			price: {required:true, number:true},
		    },	
messages: {
			price: {number:"Only number"}
		  },
	});
	
	
	
	
	
 } );

</script>
</body>
</html>
<?php ob_flush();?>