<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
 ?>
<!DOCTYPE html>
<html>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">          
 <div class="inv-main">

<?php 
$table_dr_id = $_GET['table_dr_id'];

if(isset($table_dr_id))
{   
   	$result = mysqli_query($con, "SELECT * FROM `dr_profile` WHERE `dr_id` = '$table_dr_id'");
	$sl_no=1;
	while ($row = mysqli_fetch_array($result))
	{
	?>
	
	 <div class="panel panel-success"> <!-----------------START Doctor Information--------------->
		 <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user-md"></i> Personal Information
            <a class="text-right pull-right navbar-link" href="doctor_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
            </h3>
		 </div>
		 
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Doctor Name :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_name'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">Specialisation :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_specialization'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">Designation :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_designation'];?></span>
			  </div>  
		</div>
		
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Working at :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_institute'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">Email :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_email'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">Contact Number :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_phone'];?></span>
			  </div>  
		</div>
		
		<div class="control-group">
			  <label for="inputName" class="col-lg-2 control-label text-right">Address :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_pres_address'].", ".$row['dr_pres_district'];?></span>
			  </div>
			   <label for="inputSex" class="col-lg-2 control-label text-right">State :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"> <?php echo $row['dr_pres_state'];?></span>
			  </div>
			  <label for="inputAdress" class="col-lg-2 control-label text-right">PIN Code :</label>
			  <div class="col-lg-2">
				<span class="input-xlarge uneditable-input text-control"><?php echo $row['dr_pres_pin'];?></span>
			  </div>  
		</div>   
		
	<div class="clear"></div>
	</div>  	  
	<?php } ?> 	
         

<div class="panel panel-success" id="dr_family_infoPanel">   <!------------------------START Doctor's Family section ------------------>				  				 <div class="panel-heading"> 
 <h3 class="panel-title"><i class="fa fa-home"></i> Doctor's Dear ones Info
  <a class="text-right pull-right navbar-link" href="doctor_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
 </h3>
</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="family_table">
     <thead align="left">
        <tr>
          <th style="display: none;"> dr_family_id</th>
          <th style="display: none;"> dr_id</th>
          <th > # </th>
          <th> Name</th>
          <th> Relation</th>
          <th> Date of Birth</th>
          <th><i class="fa fa-edit"></i> Edit</th>       
        </tr>
      </thead>     
<tbody>
<?php
$result_family = mysqli_query($con, "SELECT * FROM `dr_family_tbl` WHERE `family_dr_id` = '$table_dr_id'");
$sl_no=1;
while ($fam = mysqli_fetch_array($result_family))
{
?>
 <tr id="<?php echo $fam['family_id'] ; ?>">
    <td style="display:none;"> <?php echo $fam['family_id']; ?></td>
    <td style="display:none;"> <?php echo $fam['family_dr_id']; ?></td>
    <td class="readonly-bg"> <?php echo $sl_no; ?> </td>  
    <td class="readonly-bg"><?php echo $fam['family_name']; ?> </td>  
    <td class="readonly-bg"><?php echo  $fam['family_relation']; ?> </td> 
	<td class="readonly-bg"><?php echo date("d-M-Y", strtotime($fam['family_dob'])); ?> </td>
    <td><a class="table-action-EditFamily navbar-link"><i class="fa fa-pencil"></i> Edit</a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

<!---------------------------------------- Form for Edit experience------------------------->

<form id="formEditFamily" action="ajax_family_update.php" title="Update selected row"> 

 <label style="display:none;">Family_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:210px">Name</label>
 <label style="margin-right:96px;">Relation</label>
 <label style="margin-right:0px;">DOB</label>
 <br />
	<input type="hidden" name="hidden_family_id" id="hidden_family_id" value="<?php echo $fam['family_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id"    id="hidden_dr_id"    value="<?php echo $fam['dr_id']; ?>" rel="1"/> 
    <input style="width:45px; margin-right:10px;"  type="text" name="sl_no" id="sl_no"  value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:250px; margin-right:10px;" type="text" name="family_name" id="family_name" rel="3" />
    <input style="width:156px; margin-right:10px;" type="text" name="family_relation" id="family_relation" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="family_dob" id="family_dob_edit" readonly rel="5" />
 <br /> 
    <span class="datafield" style="display:none" rel="6"><a class="table-action-EditData navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
    <br />
    <button id="formEditFamilyCancel" type="button">Cancel</button>      
    <button id="formEditFamilyOk" type="submit">Confirm</button>                  
</form>

<!---------------------------------------- Form for new family------------------------->
<form id="formNewFamily" action="#"> 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
 
 <label style="display:none;">Family_id</label>
 <label style="display:none;">Dr_id</label>
 <label style="margin-right:42px;">#</label>
 <label style="margin-right:210px">Name</label>
 <label style="margin-right:96px;">Relation</label>
 <label style="margin-right:0px;">Date of Birth</label>
 <br />
	<input type="hidden" name="hidden_family_id" id="hidden_family_id" value="<?php echo $fam['family_id']; ?>" rel="0"/> 
	<input type="hidden" name="hidden_dr_id" id="hidden_dr_id" value="<?php echo $table_dr_id; ?>" rel="1"/> 
    <input style="width:45px; margin-right:10px;"  type="text" name="sl_no" id="sl_no"  value="<?php echo $sl_no;?>" disabled rel="2" />        
    <input style="width:250px; margin-right:10px;" type="text" name="family_name" id="family_name" rel="3" />
    <input style="width:156px; margin-right:10px;" type="text" name="family_relation" id="family_relation" rel="4" />
    <input style="width:130px; margin-right:10px;" type="text" name="family_dob" id="family_dob" readonly rel="5" />
   <br />      
     <span class="datafield" style="display:none" rel="6"><a class="table-action-EditFamily navbar-link"><i class="fa fa-pencil"></i> Edit</a></span>
           <br />
    <button id="btnAddNewRowCancel2" type="button">Cancel</button>      
    <button id="btnAddNewRowOk2" type="submit">Confirm</button> 
</form>
<button id="btnDeleteRow2">Delete</button> <button id="btnAddNewRow2">Add</button>

</div>  <!------------------------------------------- END FAMILY ---------------------------------------->

<?php } ?>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>     
 <script type="text/javascript">
 $(document).ready(function() {
	
	/*----------------------------------START Family dataeditable ---------------------------------------------------------*/
$('#family_table').dataTable( {	       		

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
								 sAction: "EditFamily",
								 sAddNewRowFormId:  "formEditFamily",
								 sAddNewRowOkButtonId: "formEditFamilyOk",
								 sAddNewRowCancelButtonId: "formEditFamilyCancel",
								 sServerActionURL: "ajax_family_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto', }
								}
						], 
		 
		 
		 
		sAddURL:           "ajax_family_add.php",
        sDeleteURL:        "ajax_family_delete.php",
		sUpdateURL:        "ajax_family_update.php",
		
		sAddNewRowFormId:  "formNewFamily",			
		sAddNewRowButtonId: "btnAddNewRow2",
		sDeleteRowButtonId: "btnDeleteRow2",
		sAddNewRowOkButtonId: "btnAddNewRowOk2",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel2",		
		
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
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add Dear ones info',
				resizable: false,
				draggable: true, 
				modal: true,
				width:'auto',
				height: 'auto',
				}, 		
	
			aoColumns: [
                    	null,                    				
						null,
						null,                    				
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
 
 var oTable = $('#family_table').dataTable(); 
  oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  oTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
  
$( "#family_dob, #family_dob_edit" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

event.preventDefault();
	 
 });
 
 
 </script>
</body>
</html>
<?php } ob_flush(); ?>