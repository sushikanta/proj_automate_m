<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("header_datatable.php");?>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">           
        <div class="inv-main">
            <div class="panel panel-info">
                  <div class="panel-heading">Patient List - Search - Status</div> 
                          
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="example">
<thead align="left">
<tr>
<th style="display: none;"> Category</th>
<th> # </th>
<th> Patient ID</th>
<th> Patient Name</th>
<th> Address</th>
<th> Phone</th>
<th> Investigation</th>
<th> Total Amt</th>
<th> Paid Amt</th>
<th> Balance</th>
<th> Date</th>
<th> Status</th>
<th> Edit</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT test_tbl.test_id, test_tbl.test_name, test_tbl.test_category_id, test_tbl.price_v_id, test_category.test_category_name, price_tbl.price, price_version.version_name FROM test_category JOIN test_tbl ON test_tbl.test_category_id=test_category.test_category_id JOIN price_tbl ON price_tbl.price_version_id=test_tbl.price_v_id JOIN price_version ON test_tbl.price_v_id=price_version.version_id WHERE test_tbl.test_id=price_tbl.test_id ORDER BY test_tbl.test_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['test_id'] ; ?>">
    <td style="display:none;"> <?php echo $row['test_id']; ?></td>
    <td> <?php echo $sl_no; ?> </td>    
	<td><?php echo $row['test_category_name']; ?> </td>
	<td><?php echo  $row['test_name']; ?> </td>  
	<td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['price']; ?> </td>  
    <td><?php echo  $row['version_name']; ?> </td>
	<td><a class="table-action-EditData">Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
<!-------------------form for Edit------------------------------>

<form id="formEditData" action="testName_price_update.php" title="Update selected row"> 
 <input type="hidden" name="hidden_id" id="hidden_id" rel="0"  value="<?php echo $row['test_id']; ?>"/>
    <label for="sl_no">Sl No</label><br/>
    <input type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="1" />  
    <br/> 
   
   
  
    <label for="test_category_id">Category</label><br/>
   <?php 
	$result_category=mysqli_query($con, "SELECT `test_category_id`, `test_category_name` FROM 

`test_category`");
	?>
	
    <select name="test_category_id" id="test_category_id" rel="2" class="required">
    <option value="">Select category</option>
    <?php
       while($row=mysqli_fetch_array($result_category)) {
	?>
        <option value="<?php echo $row['test_category_id']; ?>"> <?php echo $row['test_category_name']; ?></option>          
    <?php
	  }
	?>
    </select>
    <br />   
    <label for="test_name">Investigation Name</label><br/>
    <input type="text" name="test_name" id="test_name" class="required" rel="3" />
    <br />  
    <label for="test_price">Price (Rs.)</label><br/>
    <input type="text" name="test_price" id="test_price" class="required" rel="4" />
    <br />  
    <label for="price_v_id">Price version</label><br/>
    
    <?php 
	$result_version=mysqli_query($con, "SELECT `version_id`, `version_name` FROM `price_version`");
	?>
    <select name="price_v_id" id="price_v_id" class="required" rel="5">
    <option value="">Select version</option>
    <?php
        while($row=mysqli_fetch_array($result_version))
        {
	?>
     <option value="<?php echo $row['version_id']; ?>"> <?php echo $row['version_name']; ?></option>               

 
    <?php
	   }
	?>
    </select>
    <br />      
    
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditData">Edit</a></span>
    <br />
    
    <button id="formEditDataOk" type="submit">Ok</button>
    <button id="formEditDataCancel" type="button">Cancel</button>
                
 </form>   <!-------------------End form for Edit------------------------------>
  

 <!-------------------form for new record------------------------------>

<form id="formName_price" action="#"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
    <input type="hidden" name="hidden_id" id="hidden_id" rel="0"  value="<?php echo $row['test_id']; ?>"/>


    <label for="sl_no">Sl No</label><br/>
    <input type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="1" />          
    <br/> 
    
       
    <label for="test_category_id">Category</label><br/>
   <?php 
	$result_category=mysqli_query($con, "SELECT `test_category_id`, `test_category_name` FROM 

`test_category`");
	?>	
    <select name="test_category_id" id="test_category_id" class="required" rel="2">
    <option value="">Select category</option>
    <?php
       while($row=mysqli_fetch_array($result_category)) {
	?>
        <option value="<?php echo $row['test_category_id']; ?>"> <?php echo $row['test_category_name']; ?></option>          
    <?php
	  }
	?>
    </select>
    <br />  
     
    <label for="test_name">Investigation Name</label><br/>
    <input type="text" name="test_name" id="test_name" class="required" rel="3" />
    <br />  
    
    <label for="test_price">Price (Rs.)</label><br/>
    <input type="text" name="test_price" id="test_price" class="required" rel="4" />
    <br />  
    
    <label for="price_v_id">Price version</label><br/>    
    <?php 
	$result_version=mysqli_query($con, "SELECT `version_id`, `version_name` FROM `price_version`");
	?>
    <select name="price_v_id" id="price_v_id" class="required" rel="5">
    <option value="">Select version</option>
    <?php
        while($row=mysqli_fetch_array($result_version))
        {
	?>
     <option value="<?php echo $row['version_id']; ?>"> <?php echo $row['version_name']; ?></option>               

 
    <?php
	   }
	?>
    </select>
    <br />      
    
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditData">Edit</a></span> 
               
 </form>    
  
<div class="add_delete_toolbar" />  

<div class="clear"></div>
</div>
<?php include("footer.php"); ?>   
<script charset="utf-8" type="text/javascript"> 
$(document).ready(function() {	
    
  $('#example').dataTable( {		       		

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
			
				
     } ).makeEditable({
		 
		 
		 aoTableActions: [
								{
								 sAction: "EditData",
								 sServerActionURL: "testCategory_update.php",
								 oFormOptions: { autoOpen: false, modal: true }
								}
						],
		 
		 
		sAddDeleteToolbarSelector: ".dataTables_length",
        sAddURL:              "testName_price_add.php",
        sDeleteURL:           "testName_price_delete.php",
		sUpdateURL:           "testCategory_update.php",
		sAddNewRowFormId:     "formName_price",	
		   
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
				modal: true
		
				}, 
		
	
		aoColumns: [
                    	null,
						null,
                    				
							{
							    onblur: 'cancel',
                                submit: 'Ok',
								width: '97%', 
							    type: 'select',
								fnOnCellUpdated: function(sStatus, sValue, settings) {
          					 	 alert("(Cell Callback): Cell is updated with value " + sName);
        						},
                                
									  oValidationOptions : 
										   { 
											   rules:{ 
													   value: {
															   required: true,
															   minlength: 1
															  }
											   },
											   messages: { 
													   value: {
															   minlength: "Enter at least 5 characters" 
															   } 
											   }
										   }
		 
							   					
							},
							null,
							{
							  indicator: 'Saving price version...',
							  tooltip: 'Click to select version',
							  loadtext: 'loading...',
							  type: 'select',
							  onblur: 'submit',
							  data: "{'':'Please select...', 'A':'A','B':'B','C':'C'}",
                						
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
				fnOnEditing: function(input)
                             {  
                                    cell= input.parents("tr")
                                               .children("td:first")
                                               .text();
                                    return true
                            },
                oUpdateParameters: {
                                cell: function(){ return cell; } 
                        }


    } );

 var oTable = $('#example').dataTable();
 // Hide the second column after initialisation
  oTable.fnSetColumnVis( 0, false );
} );
 
</script>
</body>
</html>