<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<title>Edit Price</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">		    
  <div class="inv-main">
  
      <div class="panel panel-success">
            <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Investigation & Price 
            <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
            
             <a href="testName_price_view_all.php"><button class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:40px; margin-top:-5px; width:150px;">View &nbsp; ALL&nbsp;&nbsp; | &nbsp;&nbsp;EDIT</button></a> <!--view button -->  
            
            
            </h3></div>                     
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="test_name_price_table">
<thead align="left">
<tr>
    <th> # </th>
    <th><i class="fa fa-pencil-square-o"></i> Investigation</th>
    <th><i class="fa fa-pencil-square-o"></i> Short form</th>
    <th><i class="fa fa-pencil-square-o"></i> Price ( <i class="fa fa-inr"></i> )</th>
    <th><i class="fa fa-pencil-square-o"></i> Category</th>
    <th> Department</th>
    <th> Version</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT t.test_id, t.test_name,t.test_short_form,t.test_price,c.test_category_name, price_version.PV_name, department_tbl.department_name FROM test_tbl t LEFT JOIN test_category c ON c.test_category_id=t.test_category_id LEFT JOIN price_version ON price_version.PV_id = t.test_version_id LEFT JOIN department_tbl ON department_tbl.department_id = c.TC_dept_id ORDER BY t.test_name ASC ");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	
     $test_id = $row['test_id'];
	
?>
 <tr id="<?php echo $row['test_id'] ; ?>">
    <td class="readonly-bg"> <?php echo $sl_no; ?> </td>    	
	<td><?php echo htmlspecialchars($row['test_name']); ?></td>  
	<td><?php echo htmlspecialchars($row['test_short_form']); ?></td>
    <td><?php echo htmlspecialchars($row['test_price']); ?></td>  
    <td><?php echo htmlspecialchars($row['test_category_name']); ?></td>
    <td class="readonly-bg"><?php echo $row['department_name']; ?></td>
    <td class="readonly-bg"><?php echo  $row['PV_name']; ?></td>
  </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
 <!-------------------form for new record------------------------------>

<form id="formName_price" action="#"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
  
    <label style="margin-right:46px;" for="sl_no">#</label>
    <label style="margin-right:293px;" >Investigation</label>
    <label style="margin-right:23px;" >Short form</label>
    <label style="margin-right:34px;" ><i class="fa fa-inr"></i> Price</label>
    <label style="margin-right:0px;" >Category</label>
    <label style="display:none;" >Department</label>
    <label style="display: none;" >Version</label>
    
    </br>    
   
    <input style="width:50px; margin-right:10px; cursor:not-allowed;"  type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
    <input style="width:400px; margin-right:10px; text-transform:capitalize;" type="text" name="test_name" rel="1" /> 
    <input style="width:100px; margin-right:10px; text-transform:capitalize;" type="text" name="short_form" rel="2" /> 
    <input style="width:85px; margin-right:10px;"  type="text" name="price" rel="3" /> 
    <?php 
	$result_category=mysqli_query($con, "SELECT test_category_id, test_category_name FROM test_category");
	?>	
    <select style="width:160px; margin-right:10px;" name="test_category_id" rel="4">
    <option value="">Select category</option>
    <?php
       while($row=mysqli_fetch_array($result_category)) {
	?>
        <option value="<?php echo $row['test_category_id']; ?>"> <?php echo $row['test_category_name']; ?></option>          
    <?php
	  }
	?>
    </select> 
    <input type="hidden" name="department" rel="5" /> 
    <input type="hidden" name="version" rel="6" />       
    <br/> 
               
 </form>    
  
<div class="add_delete_toolbar" />  

<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>    
<script type="text/javascript">

$(document).ready(function() {
 $('#test_name_price_table').dataTable( {		       		

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
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
		  }
		  			
     }).makeEditable({
		 
        sAddURL:              "ajax_testName_price_add.php",
        sDeleteURL:           "ajax_testName_price_delete.php",
		sUpdateURL: 		   "ajax_testName_price_update.php",
		
		sAddNewRowFormId:     "formName_price",	
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
					{
					 loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  tooltip: 'Click to update investigation',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '80%', 
					},
					{
					  
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  //cssclass: 'required',
					  tooltip: 'Click to update short-form',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%', 
					
					},
					{
					  
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  //cssclass: 'required',
					  tooltip: 'Click to update price',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
					  width: '50%', 
					 
					},
					{
					  
					  tooltip: 'Click to update category',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  width: '80%', 
					  bAutoWidth: false, 
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'ok',
					  event: 'click',
     				  loadurl: "ajax_custom_category_list.php",  					  
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
	
    } );
 } );

</script>
</body>
</html>
<?php ob_flush();?>